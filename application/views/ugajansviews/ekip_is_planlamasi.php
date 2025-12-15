<?php


$resources = [];
if (isset($kullanicilar_data) && is_array($kullanicilar_data) && !empty($kullanicilar_data)) {
    foreach ($kullanicilar_data as $user) {
        if (isset($user->ugajans_kullanici_id) && isset($user->ugajans_kullanici_ad_soyad)) {
            $resources[] = [
                'name' => $user->ugajans_kullanici_ad_soyad,
                'id'   => (string)$user->ugajans_kullanici_id
            ];
        }
    }
}

$events = [];
if (isset($is_planlamasi_data) && is_array($is_planlamasi_data) && !empty($is_planlamasi_data)) {
    foreach ($is_planlamasi_data as $plan) {
        // Sadece aktif kayıtları al
        if (isset($plan->aktif) && $plan->aktif != 1) {
            continue;
        }
        
        // Gerekli alanların varlığını kontrol et
        if (!isset($plan->is_planlamasi_id) || !isset($plan->kullanici_no) || !isset($plan->planlama_tarihi)) {
            continue;
        }
        
        $planlama_tarihi = $plan->planlama_tarihi;
        $baslangic_saati = isset($plan->baslangic_saati) && !empty($plan->baslangic_saati) ? $plan->baslangic_saati : '09:00';
        $bitis_saati = isset($plan->bitis_saati) && !empty($plan->bitis_saati) ? $plan->bitis_saati : '17:00';
        
        // Tarih formatını düzelt (datetime ise sadece tarih kısmını al)
        if (strpos($planlama_tarihi, ' ') !== false) {
            $planlama_tarihi = explode(' ', $planlama_tarihi)[0];
        }
        // Tarih formatını temizle (sadece YYYY-MM-DD formatında olmalı)
        $planlama_tarihi = preg_replace('/\s+/', '', $planlama_tarihi);
        
        // Saat formatını düzelt (datetime ise sadece saat kısmını al)
        if (strpos($baslangic_saati, ' ') !== false) {
            $baslangic_saati = explode(' ', $baslangic_saati)[1] ?? $baslangic_saati;
        }
        if (strpos($bitis_saati, ' ') !== false) {
            $bitis_saati = explode(' ', $bitis_saati)[1] ?? $bitis_saati;
        }
        
        // Saat formatını düzelt - DayPilot saniye kısmını bekliyor
        // Eğer saniye yoksa ekle (14:37 -> 14:37:00)
        if (strlen($baslangic_saati) === 5 && substr_count($baslangic_saati, ':') === 1) {
            $baslangic_saati .= ':00';
        }
        if (strlen($bitis_saati) === 5 && substr_count($bitis_saati, ':') === 1) {
            $bitis_saati .= ':00';
        }
        
        // Eğer saat "00:00:00" ise varsayılan saat kullan
        if ($baslangic_saati === '00:00:00' || $baslangic_saati === '00:00' || empty($baslangic_saati)) {
            $baslangic_saati = '09:00:00';
        }
        if ($bitis_saati === '00:00:00' || $bitis_saati === '00:00' || empty($bitis_saati)) {
            $bitis_saati = '17:00:00';
        }
        
        // ISO 8601 formatına çevir (YYYY-MM-DDTHH:MM:SS) - DayPilot bu formatı bekliyor
        $start = $planlama_tarihi . 'T' . $baslangic_saati;
        $end   = $planlama_tarihi . 'T' . $bitis_saati;
        
        // Öncelik bilgisini al
        $oncelik = isset($plan->oncelik) ? strtolower(trim($plan->oncelik)) : 'normal';
        $isHighPriority = ($oncelik === 'yüksek' || $oncelik === 'acil' || $oncelik === 'high');
        
        $events[] = [
            'start'    => $start,
            'end'      => $end,
            'resource' => (string)$plan->kullanici_no,
            'id'       => (string)$plan->is_planlamasi_id,
            'text'     => isset($plan->is_notu) && !empty($plan->is_notu) ? $plan->is_notu : (isset($plan->yapilacak_is) && !empty($plan->yapilacak_is) ? $plan->yapilacak_is : 'Görev'),
            'oncelik'  => $oncelik,
            'isHighPriority' => $isHighPriority,
        ];
    }
}
?>

<link rel="stylesheet" href="<?=base_url('ugajansassets/calendar/css/metronic-integration.css')?>">
<link rel="stylesheet" href="<?=base_url('ugajansassets/calendar/css/date-picker.css')?>">

<style>
    /* CSS Variables for consistent colors across all browsers */
    :root {
        --plan-primary: #0b64c0;
        --plan-primary-hover: #0954a0;
        --plan-primary-light: #e8f4ff;
        --plan-text-primary: #0f172a;
        --plan-text-secondary: #475569;
        --plan-text-muted: #94a3b8;
        --plan-border: #eef1f6;
        --plan-border-input: #d8dee9;
        --plan-bg: #ffffff;
        --plan-bg-section: #fafbff;
        --plan-bg-secondary: #f8fafc;
        --plan-error: #ef4444;
        --plan-shadow: rgba(15, 23, 42, 0.25);
        --plan-backdrop: rgba(15, 23, 42, 0.25);
    }

    /* Ek tam yükseklik düzeni - Cross-browser compatible */
    #personel-takvim-container { 
        min-height: 80vh;
        min-height: calc(100vh - 200px); /* Fallback for older browsers */
    }
    #personel-takvim-container .pt-calendar-wrapper { 
        min-height: 60vh;
        min-height: calc(100vh - 300px); /* Fallback */
    }

    /* Modal - Cross-browser compatible with vendor prefixes */
    .plan-modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: var(--plan-backdrop);
        -webkit-backdrop-filter: blur(4px);
        backdrop-filter: blur(4px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 90;
        padding: 24px;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
    }
    
    .plan-modal {
        width: 100%;
        max-width: 720px;
        background: var(--plan-bg);
        border-radius: 16px;
        box-shadow: 0 24px 60px var(--plan-shadow);
        -webkit-box-shadow: 0 24px 60px var(--plan-shadow);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        margin: auto;
        max-height: 95vh;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    
    .plan-modal__header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 20px 24px;
        border-bottom: 1px solid var(--plan-border);
        flex-shrink: 0;
    }
    
    .plan-modal__icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--plan-primary-light);
        color: var(--plan-primary);
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    
    .plan-modal__title {
        font-weight: 700;
        font-size: 18px;
        line-height: 1.4;
        color: var(--plan-text-primary);
        margin: 0;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    
    .plan-modal__subtitle {
        margin: 2px 0 0 0;
        color: var(--plan-text-secondary);
        font-size: 14px;
        line-height: 1.4;
    }
    
    .plan-modal__close {
        margin-left: auto;
        background: transparent;
        border: none;
        color: var(--plan-text-muted);
        font-size: 24px;
        line-height: 1;
        cursor: pointer;
        padding: 4px;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }
    
    .plan-modal__close:hover {
        background: var(--plan-bg-secondary);
        color: var(--plan-text-primary);
    }
    
    .plan-modal__body {
        padding: 20px 24px 12px;
        max-height: calc(90vh - 140px);
        overflow-y: auto;
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
        flex: 1;
    }
    
    .plan-section {
        border: 1px solid var(--plan-border);
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 14px;
        background: var(--plan-bg-section);
    }
    
    .plan-section__title {
        font-size: 13px;
        font-weight: 700;
        color: var(--plan-text-primary);
        letter-spacing: 0.3px;
        margin-bottom: 12px;
        text-transform: uppercase;
        -webkit-font-smoothing: antialiased;
    }
    
    .plan-grid {
        display: -ms-grid;
        display: grid;
        gap: 12px;
        -ms-grid-columns: repeat(auto-fit, minmax(240px, 1fr));
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    }
    
    .plan-field {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    
    .plan-label {
        font-weight: 600;
        font-size: 13px;
        color: var(--plan-text-primary);
        line-height: 1.4;
        -webkit-font-smoothing: antialiased;
    }
    
    .plan-required { 
        color: var(--plan-error); 
        margin-left: 4px; 
    }
    
    .plan-input,
    .plan-select,
    .plan-textarea {
        width: 100%;
        border: 1px solid var(--plan-border-input);
        border-radius: 10px;
        padding: 10px 12px;
        font-size: 14px;
        line-height: 1.5;
        color: var(--plan-text-primary);
        background: var(--plan-bg);
        -webkit-transition: border-color 0.15s ease, box-shadow 0.15s ease;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
        font-family: inherit;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    
    .plan-select {
        background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L6 6L11 1' stroke='%230f172a' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 12px;
        padding-right: 36px;
    }
    
    .plan-input:focus,
    .plan-select:focus,
    .plan-textarea:focus {
        outline: none;
        border-color: var(--plan-primary);
        box-shadow: 0 0 0 3px rgba(11, 100, 192, 0.12);
        -webkit-box-shadow: 0 0 0 3px rgba(11, 100, 192, 0.12);
    }
    
    .plan-textarea {
        min-height: 100px;
        resize: vertical;
    }
    
    .plan-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding: 0 24px 20px;
        flex-shrink: 0;
        border-top: 1px solid var(--plan-border);
        margin-top: 8px;
        padding-top: 16px;
    }
    
    .plan-btn {
        border-radius: 10px;
        padding: 10px 16px;
        font-weight: 700;
        font-size: 14px;
        line-height: 1.5;
        border: 1px solid transparent;
        cursor: pointer;
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
        font-family: inherit;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    
    .plan-btn--secondary {
        background: var(--plan-bg-secondary);
        border-color: var(--plan-border-input);
        color: var(--plan-text-primary);
    }
    
    .plan-btn--secondary:hover {
        background: #f1f5f9;
        border-color: var(--plan-text-muted);
    }
    
    .plan-btn--primary {
        background: var(--plan-primary);
        color: #fff;
        border-color: var(--plan-primary);
    }
    
    .plan-btn--primary:hover {
        background: var(--plan-primary-hover);
        border-color: var(--plan-primary-hover);
    }
    
    .plan-btn:active {
        -webkit-transform: translateY(1px);
        transform: translateY(1px);
    }
    
    .plan-btn[style*="background: #ef4444"]:hover {
        background: #dc2626 !important;
        border-color: #dc2626 !important;
    }
    
    /* Yüksek öncelikli event animasyonu */
    .calendar_default_event_high_priority {
        animation: pulse-red 2s ease-in-out infinite;
        border: 2px solid #ef4444 !important;
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%) !important;
    }
    
    @keyframes pulse-red {
        0%, 100% {
            opacity: 1;
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
        }
        50% {
            opacity: 0.85;
            box-shadow: 0 0 0 8px rgba(239, 68, 68, 0);
        }
    }
    
    .calendar_default_event_high_priority .calendar_default_event_inner {
        color: #991b1b !important;
        font-weight: 600 !important;
    }
    
    /* Responsive Design - Desktop focused but flexible */
    @media (max-width: 1400px) {
        .plan-modal {
            max-width: 680px;
        }
        .plan-grid {
            -ms-grid-columns: repeat(auto-fit, minmax(220px, 1fr));
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }
    }
    
    @media (max-width: 1200px) {
        .plan-modal {
            max-width: 640px;
        }
        .plan-grid {
            -ms-grid-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
    }
    
    @media (max-width: 1024px) {
        .plan-modal {
            max-width: 90%;
            margin: 20px auto;
        }
        .plan-modal__header {
            padding: 16px 20px;
        }
        .plan-modal__body {
            padding: 16px 20px 12px;
            max-height: calc(90vh - 120px);
        }
        .plan-actions {
            padding: 0 20px 16px;
        }
    }
    
    @media (max-width: 768px) {
        .plan-modal-backdrop {
            padding: 16px;
        }
        .plan-modal {
            max-width: 100%;
            max-height: 98vh;
            border-radius: 12px;
        }
        .plan-modal__header {
            padding: 16px;
        }
        .plan-modal__body {
            padding: 16px;
            max-height: calc(95vh - 140px);
        }
        .plan-grid {
            -ms-grid-columns: 1fr;
            grid-template-columns: 1fr;
        }
        .plan-actions {
            flex-direction: column-reverse;
            padding: 0 16px 16px;
        }
        .plan-btn {
            width: 100%;
            justify-content: center;
        }
    }
    
    /* Mac specific font rendering improvements */
    @media screen and (-webkit-min-device-pixel-ratio: 2) {
        .plan-modal__title,
        .plan-label,
        .plan-section__title {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    }
    
    /* High contrast mode support */
    @media (prefers-contrast: high) {
        .plan-modal {
            border: 2px solid var(--plan-text-primary);
        }
        .plan-input,
        .plan-select,
        .plan-textarea {
            border-width: 2px;
        }
    }
    
    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {
        .plan-modal-backdrop,
        .plan-input,
        .plan-select,
        .plan-textarea,
        .plan-btn {
            -webkit-transition: none;
            transition: none;
        }
    }
    
    /* Print styles */
    @media print {
        .plan-modal-backdrop {
            display: none;
        }
    }
</style>

<div id="personel-takvim-container">
    <div class="pt-nav-bar">
        <div class="pt-nav-left">
            <button type="button" class="pt-nav-btn" id="pt-btnPrev">
                <span class="pt-nav-icon">◄</span>Önceki
            </button>
        </div>

        <div class="pt-nav-center">
            <input type="date" id="pt-date-input" class="pt-date-input-field" aria-label="Tarih seç" />
        </div>

        <div class="pt-nav-right">
            <button type="button" class="pt-nav-btn" id="pt-btnNext">
                Sonraki<span class="pt-nav-icon">►</span>
            </button>
        </div>

        <div class="pt-nav-personel">
            <select id="pt-personel-select" class="pt-personel-select">
                <option value="">Tüm Personeller</option>
                <?php foreach ($resources as $res): ?>
                    <option value="<?=$res['id']?>"><?=$res['name']?></option>
                <?php endforeach; ?>
            </select>
            <button type="button" class="pt-nav-btn" style="margin-left:10px" onclick="openPlanModal()">Yeni Plan</button>
        </div>
    </div>

    <div class="pt-calendar-wrapper">
        <div id="pt-calendar"></div>
    </div>
</div>

<!-- Yeni İş Planı Ekle Modal -->
<div class="plan-modal-backdrop" id="planModal">
    <div class="plan-modal">
        <div class="plan-modal__header">
            <div class="plan-modal__icon">
                <i class="ki-filled ki-calendar-tick"></i>
            </div>
            <div>
                <h3 class="plan-modal__title" id="modal_title">Yeni İş Planı Ekle</h3>
                <p class="plan-modal__subtitle" id="modal_subtitle">İş planı bilgilerini doldurunuz</p>
            </div>
            <button class="plan-modal__close" type="button" onclick="togglePlanModal(false)">×</button>
        </div>

        <form id="planModalForm" method="post" action="<?=base_url('ugajans_ekip/is_planlamasi_ekle')?>" onsubmit="return true;">
        <div class="plan-modal__body">
            <input type="hidden" name="planlama_durumu" value="0">
            <input type="hidden" name="is_planlamasi_id" id="modal_is_planlamasi_id" value="">
            <!-- Personel & Date -->
            <div class="plan-section">
                <div class="plan-section__title">PERSONEL VE TARİH</div>
                <div class="plan-grid">
                    <div class="plan-field">
                        <label class="plan-label">Personel<span class="plan-required">*</span></label>
                        <select class="plan-select" name="kullanici_no" id="modal_kullanici_no" required>
                            <option value="">Seçiniz</option>
                            <?php if (!empty($resources)): ?>
                                <?php foreach ($resources as $res): ?>
                                    <option value="<?=$res['id']?>"><?=$res['name']?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="plan-field">
                        <label class="plan-label">Tarih<span class="plan-required">*</span></label>
                        <input type="date" class="plan-input" name="planlama_tarihi" id="modal_planlama_tarihi" required>
                    </div>
                </div>
            </div>

            <!-- Time Planning -->
            <div class="plan-section">
                <div class="plan-section__title">ZAMAN PLANLAMASI</div>
                <div class="plan-grid">
                    <div class="plan-field">
                        <label class="plan-label">Başlangıç Saati<span class="plan-required">*</span></label>
                        <input type="time" class="plan-input" name="baslangic_saati" id="modal_baslangic_saati" required>
                    </div>
                    <div class="plan-field">
                        <label class="plan-label">Bitiş Saati<span class="plan-required">*</span></label>
                        <input type="time" class="plan-input" name="bitis_saati" id="modal_bitis_saati" required>
                    </div>
                </div>
            </div>

            <!-- Category & Priority -->
            <div class="plan-section">
                <div class="plan-section__title">KATEGORİ VE ÖNCELİK</div>
                <div class="plan-grid">
                    <div class="plan-field">
                        <label class="plan-label">Planlama Tipi<span class="plan-required">*</span></label>
                        <select class="plan-select" name="planlama_tipi" id="modal_planlama_tipi" required>
                            <option value="">Seçiniz</option>
                            <option value="Haftalık">Haftalık</option>
                            <option value="Aylık">Aylık</option>
                            <option value="Günlük">Günlük</option>
                        </select>
                    </div>
                    <div class="plan-field">
                        <label class="plan-label">Öncelik</label>
                        <select class="plan-select" name="oncelik" id="modal_oncelik">
                            <option value="Normal">Normal</option>
                            <option value="yuksek">Yüksek</option>
                            <option value="Acil">Acil</option>
                            <option value="Düşük">Düşük</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Job Details -->
            <div class="plan-section">
                <div class="plan-section__title">İŞ DETAYLARI</div>
                <div class="plan-grid">
                    <div class="plan-field">
                        <label class="plan-label">Müşteri</label>
                        <select class="plan-select" name="musteri_no" id="modal_musteri">
                            <option value="">Seçiniz</option>
                            <?php if (isset($musteriler_data) && is_array($musteriler_data) && !empty($musteriler_data)): ?>
                                <?php foreach ($musteriler_data as $m): ?>
                                    <?php
                                        $mid = isset($m->musteri_id) ? $m->musteri_id : '';
                                        $mname = isset($m->musteri_ad_soyad) && !empty($m->musteri_ad_soyad)
                                            ? $m->musteri_ad_soyad
                                            : (isset($m->musteri_ad) && !empty($m->musteri_ad) ? $m->musteri_ad : 'Müşteri');
                                        $mname = trim($mname);
                                    ?>
                                    <?php if (!empty($mid) && !empty($mname)): ?>
                                        <option value="<?=$mid?>"><?=$mname?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="plan-field">
                        <label class="plan-label">Yapılacak İş</label>
                        <input type="text" class="plan-input" name="yapilacak_is" id="modal_yapilacak_is" placeholder="İş başlığı">
                    </div>
                </div>
                <div class="plan-field" style="margin-top:12px;">
                    <label class="plan-label">İş Notu<span class="plan-required">*</span></label>
                    <textarea class="plan-textarea" name="is_notu" id="modal_is_notu" placeholder="İş planı detaylarını giriniz" required></textarea>
                </div>
            </div>
        </div>

        <div class="plan-actions">
            <div style="display: flex; gap: 10px; width: 100%;">
                <button type="button" id="modal_delete_btn" class="plan-btn" style="background: #ef4444; color: #fff; border-color: #ef4444; display: none;" onclick="deletePlan()">
                    <i class="ki-filled ki-trash"></i>Sil
                </button>
                <div style="margin-left: auto; display: flex; gap: 10px;">
                    <button type="button" class="plan-btn plan-btn--secondary" onclick="togglePlanModal(false)">İptal</button>
                    <button type="submit" class="plan-btn plan-btn--primary"><i class="ki-filled ki-check"></i>Kaydet</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

<script src="<?=base_url('ugajansassets/calendar/js/daypilot-all.min.js')?>"></script>
<script src="<?=base_url('ugajansassets/calendar/js/date-picker.js')?>"></script>
<script src="<?=base_url('ugajansassets/calendar/js/task-manager.js')?>"></script>

<script type="text/javascript">
    DayPilot.Locale.register("tr-tr", {
        dayNames: ["Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi"],
        dayNamesShort: ["Paz", "Pzt", "Sal", "Çar", "Per", "Cum", "Cmt"],
        monthNames: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
        monthNamesShort: ["Oca", "Şub", "Mar", "Nis", "May", "Haz", "Tem", "Ağu", "Eyl", "Eki", "Kas", "Ara"],
        timePattern: "HH:mm",
        datePattern: "dd.MM.yyyy",
        dateTimePattern: "dd.MM.yyyy HH:mm",
        timeFormat: "Clock24Hours",
        weekStarts: 1
    });

    const RESOURCES = <?php echo json_encode($resources); ?>;
    const INITIAL_EVENTS = <?php echo json_encode($events); ?>;

    const getToday = () => new DayPilot.Date();
    const getTodayString = () => getToday().toString("yyyy-MM-dd");

    // Resource validation helper (app tanımlanmadan önce kullanılabilir)
    function getValidResource(resourceId) {
        const fallback = RESOURCES[0]?.id || "";
        if (!resourceId) return fallback;
        const normalized = typeof resourceId === "object"
            ? resourceId.id || resourceId.value || resourceId.key || resourceId.toString?.()
            : resourceId;
        if (!normalized) return fallback;
        const found = RESOURCES.find(r => r.id == normalized);
        return found ? found.id : fallback;
    }

    // Modal toggle helper
    function togglePlanModal(show = true) {
        const el = document.getElementById("planModal");
        if (!el) return;
        el.style.display = show ? "flex" : "none";
    }

    function fillPlanModal(data = {}) {
        const {
            resource = "",
            date = getTodayString(),
            startTime = "09:00",
            endTime = "17:00",
            planlamaTipi = "",
            oncelik = "Normal",
            musteri = "",
            yapilacakIs = "",
            isNotu = "",
            eventId = ""
        } = data;

        // Form alanlarını doldur
        const kullaniciNoEl = document.getElementById("modal_kullanici_no");
        const planlamaTarihiEl = document.getElementById("modal_planlama_tarihi");
        const baslangicSaatiEl = document.getElementById("modal_baslangic_saati");
        const bitisSaatiEl = document.getElementById("modal_bitis_saati");
        const planlamaTipiEl = document.getElementById("modal_planlama_tipi");
        const oncelikEl = document.getElementById("modal_oncelik");
        const musteriEl = document.getElementById("modal_musteri");
        const yapilacakIsEl = document.getElementById("modal_yapilacak_is");
        const isNotuEl = document.getElementById("modal_is_notu");
        const eventIdEl = document.getElementById("modal_is_planlamasi_id");
        
        if (kullaniciNoEl) kullaniciNoEl.value = resource || '';
        if (planlamaTarihiEl) planlamaTarihiEl.value = date || '';
        if (baslangicSaatiEl) baslangicSaatiEl.value = startTime || '09:00';
        if (bitisSaatiEl) bitisSaatiEl.value = endTime || '17:00';
        if (planlamaTipiEl) planlamaTipiEl.value = planlamaTipi || '';
        if (oncelikEl) oncelikEl.value = oncelik || 'Normal';
        if (musteriEl) musteriEl.value = musteri || '';
        if (yapilacakIsEl) yapilacakIsEl.value = yapilacakIs || '';
        if (isNotuEl) isNotuEl.value = isNotu || '';
        if (eventIdEl) eventIdEl.value = eventId || '';
        
        // Silme butonunu göster/gizle ve başlığı güncelle
        const deleteBtn = document.getElementById("modal_delete_btn");
        const modalTitle = document.getElementById("modal_title");
        const modalSubtitle = document.getElementById("modal_subtitle");
        
        if (eventId && eventId !== "") {
            // Güncelleme modu
            if (deleteBtn) deleteBtn.style.display = "inline-flex";
            if (modalTitle) modalTitle.textContent = "İş Planı Düzenle";
            if (modalSubtitle) modalSubtitle.textContent = "İş planı bilgilerini güncelleyiniz";
        } else {
            // Yeni kayıt modu
            if (deleteBtn) deleteBtn.style.display = "none";
            if (modalTitle) modalTitle.textContent = "Yeni İş Planı Ekle";
            if (modalSubtitle) modalSubtitle.textContent = "İş planı bilgilerini doldurunuz";
        }
        
        // Form action'ını güncelle (yeni kayıt mı güncelleme mi?)
        const form = document.getElementById("planModalForm");
        if (form) {
            if (eventId && eventId !== "") {
                form.action = "<?=base_url('ugajans_ekip/is_planlamasi_guncelle/')?>" + eventId;
            } else {
                form.action = "<?=base_url('ugajans_ekip/is_planlamasi_ekle')?>";
            }
        }
    }

    function openPlanModal(prefill = {}) {
        fillPlanModal(prefill);
        togglePlanModal(true);
    }
    
    function deletePlan() {
        const eventId = document.getElementById("modal_is_planlamasi_id").value;
        if (!eventId || eventId === "") {
            alert('Silinecek kayıt bulunamadı.');
            return;
        }
        
        if (confirm('Bu iş planını silmek istediğinize emin misiniz?')) {
            window.location.href = "<?=base_url('ugajans_ekip/is_planlamasi_sil/')?>" + eventId;
        }
    }

    const calendar = new DayPilot.Calendar("pt-calendar", {
        locale: "tr-tr",
        startDate: getTodayString(),
        viewType: "Resources",
        headerHeight: 50,
        eventBorderRadius: 8,
        eventHeight: 30,
        businessBeginsHour: 9,
        businessEndsHour: 19,
        columns: RESOURCES,
        contextMenu: new DayPilot.Menu({
            items: [
                {
                    text: "Düzenle",
                    onClick: async (args) => {
                        const result = await app.editEvent(args.source.data);
                        if (result) calendar.events.update(result);
                    }
                },
                { text: "-" },
                {
                    text: "Sil",
                    onClick: async (args) => {
                        const eventId = args.source.data.id;
                        if (confirm('Bu iş planını silmek istediğinize emin misiniz?')) {
                            try {
                                const response = await fetch('<?=base_url("ugajans_ekip/is_planlamasi_sil/")?>' + eventId, {
                                    method: 'GET'
                                });
                                if (response.ok) {
                                    calendar.events.remove(args.source);
                                    // Sayfayı yenile
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 500);
                                } else {
                                    alert('Silme işlemi başarısız oldu.');
                                }
                            } catch (error) {
                                console.error('Silme hatası:', error);
                                alert('Bir hata oluştu.');
                            }
                        }
                    }
                }
            ]
        }),
        onTimeRangeSelected: (args) => {
            const normalizedResource = getValidResource(args.resource);
            if (!normalizedResource) {
                calendar.clearSelection();
                return;
            }
            const startDateStr = args.start.toString("yyyy-MM-dd");
            const startTimeStr = args.start.toString("HH:mm");
            const endTimeStr   = args.end.toString("HH:mm");
            openPlanModal({
                resource: normalizedResource,
                date: startDateStr,
                startTime: startTimeStr,
                endTime: endTimeStr
            });
            calendar.clearSelection();
        },
        onEventClick: async (args) => {
            // Gerçek event verilerini modal'a yükle
            const eventData = args.e.data;
            const eventId = eventData.id;
            
            // AJAX ile event detaylarını al
            try {
                const response = await fetch('<?=base_url("ugajans_ekip/ajax_get_events")?>');
                const result = await response.json();
                
                if (result.status === 'success' && result.events) {
                    const event = result.events.find(e => String(e.is_planlamasi_id) === String(eventId));
                    if (event) {
                        // Debug: Event verilerini konsola yazdır
                        console.log('Event data:', event);
                        // Tarih formatını düzelt
                        let startDate = event.planlama_tarihi || getTodayString();
                        if (startDate.indexOf(' ') !== -1) {
                            startDate = startDate.split(' ')[0];
                        }
                        
                        // Saat formatını düzelt
                        let startTime = event.baslangic_saati || '09:00';
                        let endTime = event.bitis_saati || '17:00';
                        
                        // DateTime formatından sadece saat kısmını al
                        if (startTime && startTime.indexOf(' ') !== -1) {
                            startTime = startTime.split(' ')[1] || startTime;
                        }
                        if (endTime && endTime.indexOf(' ') !== -1) {
                            endTime = endTime.split(' ')[1] || endTime;
                        }
                        
                        // Saniye kısmını kaldır (HH:MM:SS -> HH:MM)
                        if (startTime && startTime.length > 5) {
                            startTime = startTime.substring(0, 5);
                        }
                        if (endTime && endTime.length > 5) {
                            endTime = endTime.substring(0, 5);
                        }
                        
                        // Öncelik değerini normalize et (yuksek -> yuksek, acil -> Acil)
                        let oncelik = event.oncelik || 'Normal';
                        const oncelikLower = oncelik.toLowerCase().trim();
                        if (oncelikLower === 'yuksek' || oncelikLower === 'yüksek' || oncelikLower === 'high') {
                            oncelik = 'yuksek';
                        } else if (oncelikLower === 'acil' || oncelikLower === 'urgent') {
                            oncelik = 'Acil';
                        } else if (oncelikLower === 'düşük' || oncelikLower === 'dusuk' || oncelikLower === 'low') {
                            oncelik = 'Düşük';
                        } else {
                            oncelik = 'Normal';
                        }
                        
                        // Planlama tipi değerini normalize et
                        let planlamaTipi = event.planlama_tipi || '';
                        const planlamaTipiLower = planlamaTipi.toLowerCase().trim();
                        if (planlamaTipiLower === 'haftalik' || planlamaTipiLower === 'haftalık' || planlamaTipiLower === 'weekly') {
                            planlamaTipi = 'Haftalık';
                        } else if (planlamaTipiLower === 'aylik' || planlamaTipiLower === 'aylık' || planlamaTipiLower === 'monthly') {
                            planlamaTipi = 'Aylık';
                        } else if (planlamaTipiLower === 'gunluk' || planlamaTipiLower === 'günlük' || planlamaTipiLower === 'daily') {
                            planlamaTipi = 'Günlük';
                        }
                        
                        openPlanModal({
                            resource: String(event.kullanici_no || ''),
                            date: startDate,
                            startTime: startTime,
                            endTime: endTime,
                            planlamaTipi: planlamaTipi,
                            oncelik: oncelik,
                            musteri: event.musteri_no ? String(event.musteri_no) : '',
                            yapilacakIs: event.yapilacak_is || '',
                            isNotu: event.is_notu || '',
                            eventId: String(event.is_planlamasi_id)
                        });
                    }
                }
            } catch (error) {
                console.error('Event detayları alınamadı:', error);
                // Fallback: Basit modal aç
                openPlanModal({
                    resource: String(eventData.resource || ''),
                    date: eventData.start ? new DayPilot.Date(eventData.start).toString("yyyy-MM-dd") : getTodayString(),
                    startTime: eventData.start ? new DayPilot.Date(eventData.start).toString("HH:mm") : '09:00',
                    endTime: eventData.end ? new DayPilot.Date(eventData.end).toString("HH:mm") : '17:00',
                    isNotu: eventData.text || '',
                    eventId: String(eventData.id || '')
                });
            }
        },
        onColumnHeaderClick: async (args) => {
            const resourceId = args.column?.id || args.resource || args.column?.resource || args.column?.data?.id || args.column?.value;
            if (!resourceId) return;
            const normalizedId = getValidResource(resourceId);
            const resource = RESOURCES.find(r => r.id === normalizedId);
            const resourceName = resource ? resource.name : String(normalizedId);
            const modal = await DayPilot.Modal.prompt(`${resourceName} için yeni görev oluştur:`, "Yeni görev");
            if (modal.canceled || !modal.result || !modal.result.trim()) return;
            const selectedDate = app ? app.currentDate : getToday();
            const start = selectedDate.addHours(9);
            const end = start.addHours(2);
            calendar.events.add({
                start,
                end,
                resource: normalizedId,
                id: DayPilot.guid(),
                text: modal.result.trim()
            });
        }
    });

    // Calendar'ı başlat
    calendar.init();

    const app = {
        currentDate: getToday(),
        getValidResource(resourceId) {
            // Global getValidResource fonksiyonunu kullan
            return getValidResource(resourceId);
        },
        updateDate(newDate) {
            if (!newDate || !(newDate instanceof DayPilot.Date)) return;
            this.currentDate = newDate;
            const dateString = newDate.toString("yyyy-MM-dd");
            calendar.update({ startDate: dateString });
            if (typeof calendar.scrollTo === "function") {
                calendar.scrollTo(dateString);
            }
            this.updateDateInput();
            this.loadData();
        },
        updateDateInput() {
            const input = document.getElementById("pt-date-input");
            if (input) {
                input.value = this.currentDate.toString("yyyy-MM-dd");
            }
        },
        navigate(days) {
            const nextDate = new DayPilot.Date(this.currentDate).addDays(days);
            this.updateDate(nextDate);
        },
        filterByPersonel(personelId) {
            const currentEvents = calendar.events.list;
            if (!personelId) {
                calendar.update({ columns: RESOURCES, events: currentEvents });
            } else {
                const selectedResource = RESOURCES.find(r => r.id == personelId);
                if (selectedResource) {
                    calendar.update({ columns: [selectedResource], events: currentEvents });
                }
            }
        },
        async editEvent(data) {
            if (!data) return null;
            data.resource = this.getValidResource(data.resource);
            const resourceOptions = RESOURCES.map(r => ({ text: r.name, id: r.id }));
            const form = [
                { name: "Görev Adı", id: "text", required: true },
                { name: "Başlangıç", id: "start", type: "datetime" },
                { name: "Bitiş", id: "end", type: "datetime" },
                { name: "Personel", id: "resource", options: resourceOptions }
            ];
            const modal = await DayPilot.Modal.form(form, data);
            if (modal.canceled || !modal.result) return null;
            if (!modal.result.text || !modal.result.text.trim()) return null;
            modal.result.resource = this.getValidResource(modal.result.resource);
            return modal.result;
        },
        loadData() {
            // Önce INITIAL_EVENTS'i kontrol et
            if (INITIAL_EVENTS && INITIAL_EVENTS.length > 0) {
                // Mevcut INITIAL_EVENTS'i kullan - tarih formatını kontrol et
                const mapped = INITIAL_EVENTS.map(evt => {
                    let start = evt.start;
                    let end = evt.end;
                    
                    // Eğer saniye yoksa ekle (2025-12-12T09:00 -> 2025-12-12T09:00:00)
                    if (start && start.indexOf('T') !== -1) {
                        const timePart = start.split('T')[1];
                        if (timePart && timePart.length === 5 && timePart.split(':').length === 2) {
                            start = start.replace('T' + timePart, 'T' + timePart + ':00');
                        }
                    }
                    if (end && end.indexOf('T') !== -1) {
                        const timePart = end.split('T')[1];
                        if (timePart && timePart.length === 5 && timePart.split(':').length === 2) {
                            end = end.replace('T' + timePart, 'T' + timePart + ':00');
                        }
                    }
                    
                    // Öncelik kontrolü
                    const oncelik = (evt.oncelik || '').toLowerCase().trim();
                    const isHighPriority = oncelik === 'yuksek' || oncelik === 'yüksek' || oncelik === 'acil' || oncelik === 'high';
                    
                    const eventObj = {
                        start: start,
                        end: end,
                        resource: this.getValidResource(evt.resource),
                        id: evt.id,
                        text: evt.text || "Görev"
                    };
                    
                    // Yüksek öncelikli event'lere CSS class ekle
                    if (isHighPriority) {
                        eventObj.cssClass = "calendar_default_event_high_priority";
                        eventObj.backColor = "#fee2e2";
                        eventObj.borderColor = "#ef4444";
                    }
                    
                    return eventObj;
                });
                calendar.update({ events: mapped });
                return;
            }
            
            // Eğer INITIAL_EVENTS yoksa veya boşsa, AJAX ile yükle
            fetch('<?=base_url("ugajans_ekip/ajax_get_events")?>')
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success' && result.events && result.events.length > 0) {
                        const mapped = result.events.map(evt => {
                            // Tarih formatını düzelt
                            let startDate = evt.planlama_tarihi || getTodayString();
                            if (startDate.indexOf(' ') !== -1) {
                                startDate = startDate.split(' ')[0];
                            }
                            
                            // Saat formatını düzelt - DayPilot saniye kısmını bekliyor
                            let startTime = evt.baslangic_saati || '09:00:00';
                            let endTime = evt.bitis_saati || '17:00:00';
                            
                            // DateTime formatından sadece saat kısmını al
                            if (startTime && startTime.indexOf(' ') !== -1) {
                                startTime = startTime.split(' ')[1] || startTime;
                            }
                            if (endTime && endTime.indexOf(' ') !== -1) {
                                endTime = endTime.split(' ')[1] || endTime;
                            }
                            
                            // Eğer saniye yoksa ekle (14:37 -> 14:37:00)
                            if (startTime && startTime.length === 5 && startTime.split(':').length === 2) {
                                startTime += ':00';
                            }
                            if (endTime && endTime.length === 5 && endTime.split(':').length === 2) {
                                endTime += ':00';
                            }
                            
                            // Eğer saat 00:00:00 ise varsayılan saat kullan
                            if (!startTime || startTime === '00:00:00' || startTime === '00:00') {
                                startTime = '09:00:00';
                            }
                            if (!endTime || endTime === '00:00:00' || endTime === '00:00') {
                                endTime = '17:00:00';
                            }
                            
                            // Öncelik kontrolü
                            const oncelik = (evt.oncelik || '').toLowerCase().trim();
                            const isHighPriority = oncelik === 'yuksek' || oncelik === 'yüksek' || oncelik === 'acil' || oncelik === 'high';
                            
                            const eventObj = {
                                start: startDate + 'T' + startTime,
                                end: startDate + 'T' + endTime,
                                resource: this.getValidResource(String(evt.kullanici_no)),
                                id: String(evt.is_planlamasi_id),
                                text: evt.is_notu || evt.yapilacak_is || "Görev"
                            };
                            
                            // Yüksek öncelikli event'lere CSS class ekle
                            if (isHighPriority) {
                                eventObj.cssClass = "calendar_default_event_high_priority";
                                eventObj.backColor = "#fee2e2";
                                eventObj.borderColor = "#ef4444";
                            }
                            
                            return eventObj;
                        });
                        calendar.update({ events: mapped });
                    }
                })
                .catch(error => {
                    console.error('Event verileri yüklenemedi:', error);
                });
        },
        init() {
            // İlk veri yüklemesi
            this.loadData();
            
            // Tarihi bugüne ayarla
            this.updateDate(getToday());
            
            const btnPrev = document.getElementById("pt-btnPrev");
            const btnNext = document.getElementById("pt-btnNext");
            const dateInput = document.getElementById("pt-date-input");
            const personelSelect = document.getElementById("pt-personel-select");
            if (btnPrev) btnPrev.addEventListener("click", () => this.navigate(-1));
            if (btnNext) btnNext.addEventListener("click", () => this.navigate(1));
            if (dateInput) {
                dateInput.addEventListener("change", (e) => {
                    const dateValue = e.target.value;
                    if (!dateValue) return;
                    const selectedDate = new DayPilot.Date(dateValue);
                    if (selectedDate && selectedDate.isValid()) {
                        this.updateDate(selectedDate);
                    } else {
                        this.updateDateInput();
                    }
                });
            }
            if (personelSelect) {
                personelSelect.addEventListener("change", (e) => {
                    this.filterByPersonel(e.target.value);
                });
            }
        }
    };

    app.init();
    
    // İlk yüklemede verileri göster (app tanımlandıktan sonra)
    if (INITIAL_EVENTS && INITIAL_EVENTS.length > 0) {
        const mapped = INITIAL_EVENTS.map(evt => {
            // Tarih formatını kontrol et ve saniye ekle (DayPilot saniye bekliyor)
            let start = evt.start;
            let end = evt.end;
            
            // Eğer saniye yoksa ekle (2025-12-12T09:00 -> 2025-12-12T09:00:00)
            if (start && start.indexOf('T') !== -1) {
                const timePart = start.split('T')[1];
                if (timePart && timePart.length === 5 && timePart.split(':').length === 2) {
                    start = start.replace('T' + timePart, 'T' + timePart + ':00');
                }
            }
            if (end && end.indexOf('T') !== -1) {
                const timePart = end.split('T')[1];
                if (timePart && timePart.length === 5 && timePart.split(':').length === 2) {
                    end = end.replace('T' + timePart, 'T' + timePart + ':00');
                }
            }
            
                    // Öncelik kontrolü
                    const oncelik = (evt.oncelik || '').toLowerCase().trim();
                    const isHighPriority = oncelik === 'yuksek' || oncelik === 'yüksek' || oncelik === 'acil' || oncelik === 'high';
                    
                    const eventObj = {
                        start: start,
                        end: end,
                        resource: app.getValidResource(evt.resource),
                        id: evt.id,
                        text: evt.text || "Görev"
                    };
                    
                    // Yüksek öncelikli event'lere CSS class ekle
                    if (isHighPriority) {
                        eventObj.cssClass = "calendar_default_event_high_priority";
                        eventObj.backColor = "#fee2e2";
                        eventObj.borderColor = "#ef4444";
                    }
                    
                    return eventObj;
                });
                calendar.update({ events: mapped });
            }
</script>
