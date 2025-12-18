<?php

//sa
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
        // Aktiflik durumu 1 (aktif) ve 2 (tamamlandı) olanları al
        if (isset($plan->aktif) && $plan->aktif != 1 && $plan->aktif != 2) {
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
        $isHighPriority = ($oncelik === 'yüksek' || $oncelik === 'yuksek' || $oncelik === 'acil' || $oncelik === 'high');
        
        // Aktiflik durumunu al (1: aktif, 2: tamamlandı)
        $aktif_durumu = isset($plan->aktif) ? (int)$plan->aktif : 1;
        $isCompleted = ($aktif_durumu === 2);
        
        // Müşteri bilgisini al
        $musteri_adi = '';
        $musteri_id = null;
        if (isset($plan->musteri_ad_soyad) && !empty($plan->musteri_ad_soyad)) {
            $musteri_adi = $plan->musteri_ad_soyad;
        }
        if (isset($plan->musteri_no) && !empty($plan->musteri_no) && $plan->musteri_no != '0') {
            $musteri_id = $plan->musteri_no;
        }
        
        $events[] = [
            'start'    => $start,
            'end'      => $end,
            'resource' => (string)$plan->kullanici_no,
            'id'       => (string)$plan->is_planlamasi_id,
            'text'     => isset($plan->is_notu) && !empty($plan->is_notu) ? $plan->is_notu : (isset($plan->yapilacak_is) && !empty($plan->yapilacak_is) ? $plan->yapilacak_is : 'Görev'),
            'oncelik'  => $oncelik,
            'isHighPriority' => $isHighPriority,
            'aktif'    => $aktif_durumu,
            'isCompleted' => $isCompleted,
            'musteri_adi' => $musteri_adi,
            'musteri_id' => $musteri_id,
            'yapilacak_is' => isset($plan->yapilacak_is) ? $plan->yapilacak_is : '',
        ];
    }
}
?>

<link rel="stylesheet" href="<?=base_url('ugajansassets/calendar/css/metronic-integration.css')?>">
<link rel="stylesheet" href="<?=base_url('ugajansassets/calendar/css/date-picker.css')?>">

<style>
    /* CSS Variables for consistent colors across all br2owsers */
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
    
    /* Tamamlanan event animasyonu (yeşil) */
    .calendar_default_event_completed {
        animation: pulse-green 2s ease-in-out infinite;
        border: 2px solid #10b981 !important;
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%) !important;
    }
    
    @keyframes pulse-green {
        0%, 100% {
            opacity: 1;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        }
        50% {
            opacity: 0.85;
            box-shadow: 0 0 0 8px rgba(16, 185, 129, 0);
        }
    }
    
    .calendar_default_event_completed .calendar_default_event_inner {
        color: #065f46 !important;
        font-weight: 600 !important;
    }
    
    /* Modern Event HTML Tasarımı */
    .dp-event-modern {
        padding: 8px 10px;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        gap: 6px;
        min-height: 50px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
    }
    
    .dp-event-modern:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        transform: translateY(-1px);
    }
    
    .dp-event-header {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .dp-event-title {
        font-weight: 600;
        font-size: 13px;
        line-height: 1.4;
        color: #1f2937;
        flex: 1;
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    
    .dp-event-meta {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
        font-size: 11px;
        color: #6b7280;
    }
    
    .dp-event-musteri {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: rgba(59, 130, 246, 0.1);
        color: #2563eb;
        padding: 3px 8px;
        border-radius: 12px;
        font-weight: 500;
        font-size: 10px;
    }
    
    .dp-event-musteri-icon {
        width: 14px;
        height: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .dp-event-time {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        color: #6b7280;
        font-size: 10px;
    }
    
    .dp-event-priority-badge {
        display: inline-flex;
        align-items: center;
        padding: 2px 6px;
        border-radius: 10px;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .dp-event-priority-high {
        background: rgba(239, 68, 68, 0.15);
        color: #dc2626;
    }
    
    .dp-event-priority-normal {
        background: rgba(107, 114, 128, 0.1);
        color: #6b7280;
    }
    
    .dp-event-priority-low {
        background: rgba(34, 197, 94, 0.1);
        color: #16a34a;
    }
    
    .dp-event-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 2px 6px;
        border-radius: 10px;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .dp-event-status-completed {
        background: rgba(16, 185, 129, 0.15);
        color: #059669;
    }
    
    .dp-event-content {
        font-size: 11px;
        line-height: 1.5;
        color: #4b5563;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    
    /* Yüksek öncelikli event'ler için özel stil */
    .calendar_default_event_high_priority .dp-event-modern {
        border-left: 3px solid #ef4444;
    }
    
    /* Tamamlanan event'ler için özel stil */
    .calendar_default_event_completed .dp-event-modern {
        border-left: 3px solid #10b981;
        opacity: 0.9;
    }
    
    .calendar_default_event_completed .dp-event-title {
        text-decoration: line-through;
        opacity: 0.7;
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


    .pt-5 {
   padding-top: 0px  !important;
}

    /* ============================================
       DayPilot Calendar Text Colors - Important Overrides
       ============================================ */
    #pt-calendar,
    #pt-calendar * {
        color: #1f2937 !important;
    }
    
    /* Takvim başlıkları ve saatler */
    #pt-calendar .calendar_default_header,
    #pt-calendar .calendar_default_header_inner,
    #pt-calendar .calendar_default_corner,
    #pt-calendar .calendar_default_corner_inner,
    #pt-calendar .calendar_default_columnheader,
    #pt-calendar .calendar_default_columnheader_inner,
    #pt-calendar .calendar_default_timecolumn,
    #pt-calendar .calendar_default_timecolumn_inner,
    #pt-calendar .calendar_default_cell,
    #pt-calendar .calendar_default_cell_inner {
        color: #1f2937 !important;
    }
    
    /* Event metinleri */
    #pt-calendar .calendar_default_event,
    #pt-calendar .calendar_default_event_inner,
    #pt-calendar .calendar_default_event_text {
        color: #1f2937 !important;
    }
    
    /* Modern event HTML içindeki tüm metinler */
    #pt-calendar .dp-event-modern,
    #pt-calendar .dp-event-modern *,
    #pt-calendar .dp-event-title,
    #pt-calendar .dp-event-content,
    #pt-calendar .dp-event-meta,
    #pt-calendar .dp-event-time {
        color: #1f2937 !important;
    }
    
    /* Yüksek öncelikli event metinleri */
    #pt-calendar .calendar_default_event_high_priority,
    #pt-calendar .calendar_default_event_high_priority *,
    #pt-calendar .calendar_default_event_high_priority .dp-event-modern,
    #pt-calendar .calendar_default_event_high_priority .dp-event-modern * {
        color: #991b1b !important;
    }
    
    /* Tamamlanan event metinleri */
    #pt-calendar .calendar_default_event_completed,
    #pt-calendar .calendar_default_event_completed *,
    #pt-calendar .calendar_default_event_completed .dp-event-modern,
    #pt-calendar .calendar_default_event_completed .dp-event-modern * {
        color: #065f46 !important;
    }
    
    /* Takvim hücreleri ve grid çizgileri */
    #pt-calendar .calendar_default_cell {
        background-color: #ffffff !important;
        border-color: #e5e7eb !important;
    }
    
    /* Hover durumları */
    #pt-calendar .calendar_default_cell:hover {
        background-color: #f9fafb !important;
    }
    
    /* Bugünün hücresi */
    #pt-calendar .calendar_default_today {
        background-color: #f0f9ff !important;
    }
    
    /* Seçili hücre */
    #pt-calendar .calendar_default_selected {
        background-color: #e0e7ff !important;
    }

    /* ============================================
       Modern Navigation Bar Styles - Important Overrides
       ============================================ */
    #personel-takvim-container .pt-nav-bar {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 1rem !important;
        padding: 1rem 1.5rem !important;
        min-height: 4rem !important;
        
        /* Modern Glassmorphism Effect */
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 1) 100%) !important;
        backdrop-filter: blur(10px) saturate(180%) !important;
        -webkit-backdrop-filter: blur(10px) saturate(180%) !important;
        
        /* Modern Border */
        border-bottom: 1px solid rgba(229, 231, 235, 0.8) !important;
        
        /* Advanced Shadow System */
        box-shadow: 
            0 1px 3px rgba(0, 0, 0, 0.05),
            0 4px 12px rgba(0, 0, 0, 0.03),
            inset 0 1px 0 rgba(255, 255, 255, 0.9) !important;
        -webkit-box-shadow: 
            0 1px 3px rgba(0, 0, 0, 0.05),
            0 4px 12px rgba(0, 0, 0, 0.03),
            inset 0 1px 0 rgba(255, 255, 255, 0.9) !important;
        
        flex-shrink: 0 !important;
        flex-wrap: wrap !important;
        position: relative !important;
        z-index: 10 !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        margin-bottom: 0 !important;
    }

    /* Subtle gradient overlay for depth */
    #personel-takvim-container .pt-nav-bar::before {
        content: '' !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        height: 1px !important;
        background: linear-gradient(90deg, 
            transparent 0%, 
            rgba(99, 87, 100, 0.2) 50%, 
            transparent 100%) !important;
        pointer-events: none !important;
        z-index: 1 !important;
    }

    /* Hover effect for entire nav bar */
    #personel-takvim-container .pt-nav-bar:hover {
        box-shadow: 
            0 2px 6px rgba(0, 0, 0, 0.06),
            0 8px 16px rgba(0, 0, 0, 0.04),
            inset 0 1px 0 rgba(255, 255, 255, 0.95) !important;
        -webkit-box-shadow: 
            0 2px 6px rgba(0, 0, 0, 0.06),
            0 8px 16px rgba(0, 0, 0, 0.04),
            inset 0 1px 0 rgba(255, 255, 255, 0.95) !important;
    }

    /* Navigation Sections */
    #personel-takvim-container .pt-nav-left,
    #personel-takvim-container .pt-nav-right {
        display: flex !important;
        align-items: center !important;
        gap: 0.5rem !important;
        flex-shrink: 0 !important;
        white-space: nowrap !important;
    }

    #personel-takvim-container .pt-nav-center {
        display: flex !important;
        flex: 1 1 0% !important;
        min-width: 0 !important;
        margin: 0 1rem !important;
        justify-content: stretch !important;
        align-items: stretch !important;
    }

    #personel-takvim-container .pt-nav-personel {
        display: flex !important;
        align-items: center !important;
        gap: 0.5rem !important;
        margin-left: auto !important;
        flex-shrink: 0 !important;
    }

    /* Modern Buttons */
    #personel-takvim-container .pt-nav-btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 0.375rem !important;
        padding: 0.5rem 1rem !important;
        min-height: 44px !important;
        background: #635764 !important;
        color: #ffffff !important;
        border: 1px solid #635764 !important;
        border-radius: 0.5rem !important;
        font-size: 0.875rem !important;
        font-weight: 500 !important;
        line-height: 1.5 !important;
        cursor: pointer !important;
        white-space: nowrap !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        font-family: inherit !important;
        outline: none !important;
        user-select: none !important;
        -webkit-tap-highlight-color: transparent !important;
        position: relative !important;
        overflow: hidden !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
    }

    #personel-takvim-container .pt-nav-btn:hover {
        background: #4d4350 !important;
        border-color: #4d4350 !important;
        color: #ffffff !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15) !important;
    }

    #personel-takvim-container .pt-nav-btn:active {
        background: #3a3139 !important;
        border-color: #3a3139 !important;
        transform: translateY(0) !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) !important;
    }

    #personel-takvim-container .pt-nav-btn:focus-visible {
        outline: 2px solid #635764 !important;
        outline-offset: 2px !important;
        box-shadow: 0 0 0 3px rgba(99, 87, 100, 0.15) !important;
    }

    /* Modern Date Input */
    #personel-takvim-container .pt-date-input-field {
        width: 100% !important;
        min-width: 200px !important;
        padding: 0.5rem 1rem !important;
        min-height: 44px !important;
        border: 1px solid #d1d5db !important;
        border-radius: 0.5rem !important;
        background: #635764 !important;
        color: #1f2937 !important;
        font-size: 0.875rem !important;
        font-weight: 400 !important;
        line-height: 1.5 !important;
        cursor: pointer !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        font-family: inherit !important;
        outline: none !important;
        box-sizing: border-box !important;
        flex: 1 1 auto !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
    }

    #personel-takvim-container .pt-date-input-field:hover {
        border-color: #9ca3af !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
    }

    #personel-takvim-container .pt-date-input-field:focus {
        border-color: #635764 !important;
        box-shadow: 0 0 0 3px rgba(99, 87, 100, 0.15) !important;
        outline: none !important;
    }

    /* Modern Select */
    #personel-takvim-container .pt-personel-select {
        min-width: 180px !important;
        padding: 0.5rem 2.5rem 0.5rem 1rem !important;
        min-height: 44px !important;
        border: 1px solid #d1d5db !important;
        border-radius: 0.5rem !important;
        background: #ffffff !important;
        background-image: url("data:image/svg+xml,%3Csvg width='14' height='14' viewBox='0 0 14 14' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M3.5 5.25L7 8.75L10.5 5.25' stroke='%231f2937' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") !important;
        background-repeat: no-repeat !important;
        background-position: right 0.75rem center !important;
        background-size: 14px !important;
        color: #1f2937 !important;
        font-size: 0.875rem !important;
        font-weight: 400 !important;
        line-height: 1.5 !important;
        cursor: pointer !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        font-family: inherit !important;
        outline: none !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
    }

    #personel-takvim-container .pt-personel-select:hover {
        border-color: #9ca3af !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08) !important;
    }

    #personel-takvim-container .pt-personel-select:focus {
        border-color: #635764 !important;
        box-shadow: 0 0 0 3px rgba(99, 87, 100, 0.15) !important;
        outline: none !important;
    }

    /* Responsive - Tablet */
    @media (max-width: 1023px) {
        #personel-takvim-container .pt-nav-bar {
            flex-wrap: wrap !important;
            gap: 0.75rem !important;
            padding: 0.75rem 1rem !important;
        }
        
        #personel-takvim-container .pt-nav-center {
            order: 3 !important;
            flex: 1 1 100% !important;
            margin: 0.5rem 0 0 0 !important;
            width: 100% !important;
        }
        
        #personel-takvim-container .pt-nav-personel {
            order: 4 !important;
            flex: 1 1 100% !important;
            margin-left: 0 !important;
            margin-top: 0.5rem !important;
            justify-content: flex-end !important;
        }
    }

    /* Responsive - Mobile */
    @media (max-width: 767px) {
        #personel-takvim-container .pt-nav-bar {
            padding: 0.75rem 0.5rem !important;
            gap: 0.5rem !important;
        }
        
        #personel-takvim-container .pt-nav-btn {
            padding: 0.5rem 0.75rem !important;
            font-size: 0.8125rem !important;
        }
        
        #personel-takvim-container .pt-nav-personel {
            flex-direction: column !important;
            width: 100% !important;
            gap: 0.5rem !important;
        }
        
        #personel-takvim-container .pt-personel-select,
        #personel-takvim-container .pt-nav-btn {
            width: 100% !important;
        }
    }
    
    /* Sürükle-bırak ve genişletme için görsel geri bildirim */
    #pt-calendar .calendar_default_event {
        cursor: move !important;
        user-select: none !important;
    }
    
    #pt-calendar .calendar_default_event:hover {
        opacity: 0.9 !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2) !important;
        transform: translateY(-1px) !important;
        transition: all 0.2s ease !important;
    }
    
    /* Sürükleme sırasında görsel geri bildirim */
    #pt-calendar .calendar_default_event_drag {
        opacity: 0.7 !important;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3) !important;
        transform: scale(1.02) !important;
        z-index: 1000 !important;
    }
    
    /* Genişletme için cursor */
    #pt-calendar .calendar_default_event_resize {
        cursor: ns-resize !important;
    }
    
    /* Event'in alt ve üst kenarlarında genişletme alanı */
    #pt-calendar .calendar_default_event_inner {
        position: relative !important;
    }
    
    #pt-calendar .calendar_default_event_inner::before {
        content: '' !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        height: 4px !important;
        cursor: ns-resize !important;
        z-index: 10 !important;
    }
    
    #pt-calendar .calendar_default_event_inner::after {
        content: '' !important;
        position: absolute !important;
        bottom: 0 !important;
        left: 0 !important;
        right: 0 !important;
        height: 4px !important;
        cursor: ns-resize !important;
        z-index: 10 !important;
    }
</style>

<div id="personel-takvim-container">
    <div class="pt-nav-bar">
        <div class="pt-nav-left">
            <button type="button" class="pt-nav-btn" id="pt-btnPrev">
                <span class="pt-nav-icon">◄</span>Önceki
            </button>
        </div>

        <div class="pt-nav-center" style="flex: 1 1 0%; min-width: 0; width: 100%;">
            <input type="date" id="pt-date-input" class="pt-date-input-field" aria-label="Tarih seç" style="width: 100%; min-width: 100%; box-sizing: border-box;" />
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

        <form id="planModalForm" method="post" action="<?=base_url('ugajans_ekip/is_planlamasi_ekle')?>" onsubmit="return validatePlanForm();">
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
                <div class="plan-grid">
                    <div class="plan-field">
                        <label class="plan-label">Öncelik seçiniz</label>
                        <select class="plan-select" name="oncelik" id="modal_oncelik">
                        <option value="Düşük">Düşük</option>
                            <option value="Normal">Normal</option>
                            <option value="yuksek">Yüksek</option>
                            <option value="Acil">Acil</option>
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

            <!-- Tekrarlama (Recurrence) -->
            <div class="plan-section">
                <div class="plan-section__title">TEKRARLAMA</div>
                <div class="plan-grid">
                    <div class="plan-field">
                        <label class="plan-label">Tekrar Tipi</label>
                        <select class="plan-select" name="tekrar_tipi" id="modal_tekrar_tipi" onchange="toggleRecurrenceOptions()">
                            <option value="tek_seferlik">Tek Seferlik</option>
                            <option value="haftalik">Haftalık</option>
                            <option value="aylik">Aylık</option>
                            <option value="yillik">Yıllık</option>
                        </select>
                    </div>
                </div>

                <!-- Haftalık Tekrar Seçenekleri -->
                <div id="haftalik_tekrar_options" style="display: none; margin-top: 12px;">
                    <div class="plan-field">
                        <label class="plan-label">Haftanın Günleri</label>
                        <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 8px;">
                            <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                                <input type="checkbox" name="tekrar_gunleri[]" value="1" class="recurrence-day-checkbox">
                                <span>Pazartesi</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                                <input type="checkbox" name="tekrar_gunleri[]" value="2" class="recurrence-day-checkbox">
                                <span>Salı</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                                <input type="checkbox" name="tekrar_gunleri[]" value="3" class="recurrence-day-checkbox">
                                <span>Çarşamba</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                                <input type="checkbox" name="tekrar_gunleri[]" value="4" class="recurrence-day-checkbox">
                                <span>Perşembe</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                                <input type="checkbox" name="tekrar_gunleri[]" value="5" class="recurrence-day-checkbox">
                                <span>Cuma</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                                <input type="checkbox" name="tekrar_gunleri[]" value="6" class="recurrence-day-checkbox">
                                <span>Cumartesi</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                                <input type="checkbox" name="tekrar_gunleri[]" value="7" class="recurrence-day-checkbox">
                                <span>Pazar</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Aylık Tekrar Seçenekleri -->
                <div id="aylik_tekrar_options" style="display: none; margin-top: 12px;">
                    <div class="plan-grid">
                        <div class="plan-field">
                            <label class="plan-label">Tekrar Şekli</label>
                            <select class="plan-select" name="aylik_tekrar_sekli" id="aylik_tekrar_sekli" onchange="toggleAylikTekrarSekli()">
                                <option value="ay_gunu">Ayın Belirli Bir Günü</option>
                                <option value="hafta_gunu">Ayın Belirli Bir Haftası</option>
                            </select>
                        </div>
                    </div>
                    <div id="ay_gunu_options" style="margin-top: 12px;">
                        <div class="plan-field">
                            <label class="plan-label">Ayın Kaçıncı Günü (1-31)</label>
                            <input type="number" class="plan-input" name="tekrar_ay_gunu" id="modal_tekrar_ay_gunu" min="1" max="31" placeholder="Örn: 15">
                        </div>
                    </div>
                    <div id="hafta_gunu_options" style="display: none; margin-top: 12px;">
                        <div class="plan-grid">
                            <div class="plan-field">
                                <label class="plan-label">Haftanın Günü</label>
                                <select class="plan-select" name="tekrar_hafta_gunu" id="modal_tekrar_hafta_gunu">
                                    <option value="1">Pazartesi</option>
                                    <option value="2">Salı</option>
                                    <option value="3">Çarşamba</option>
                                    <option value="4">Perşembe</option>
                                    <option value="5">Cuma</option>
                                    <option value="6">Cumartesi</option>
                                    <option value="7">Pazar</option>
                                </select>
                            </div>
                            <div class="plan-field">
                                <label class="plan-label">Hafta Sırası</label>
                                <select class="plan-select" name="tekrar_hafta_sira" id="modal_tekrar_hafta_sira">
                                    <option value="1">İlk</option>
                                    <option value="2">İkinci</option>
                                    <option value="3">Üçüncü</option>
                                    <option value="4">Dördüncü</option>
                                    <option value="-1">Son</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Yıllık Tekrar Seçenekleri -->
                <div id="yillik_tekrar_options" style="display: none; margin-top: 12px;">
                    <div class="plan-grid">
                        <div class="plan-field">
                            <label class="plan-label">Ay</label>
                            <select class="plan-select" name="tekrar_yil_ay" id="modal_tekrar_yil_ay">
                                <option value="1">Ocak</option>
                                <option value="2">Şubat</option>
                                <option value="3">Mart</option>
                                <option value="4">Nisan</option>
                                <option value="5">Mayıs</option>
                                <option value="6">Haziran</option>
                                <option value="7">Temmuz</option>
                                <option value="8">Ağustos</option>
                                <option value="9">Eylül</option>
                                <option value="10">Ekim</option>
                                <option value="11">Kasım</option>
                                <option value="12">Aralık</option>
                            </select>
                        </div>
                        <div class="plan-field">
                            <label class="plan-label">Gün (1-31)</label>
                            <input type="number" class="plan-input" name="tekrar_yil_gun" id="modal_tekrar_yil_gun" min="1" max="31" placeholder="Örn: 15">
                        </div>
                    </div>
                </div>

                <!-- Tekrarlama Tarih Aralığı -->
                <div id="tekrar_tarih_araligi" style="display: none; margin-top: 12px;">
                    <div class="plan-grid">
                        <div class="plan-field">
                            <label class="plan-label">Başlangıç Tarihi</label>
                            <input type="date" class="plan-input" name="tekrar_baslangic_tarihi" id="modal_tekrar_baslangic_tarihi">
                        </div>
                        <div class="plan-field">
                            <label class="plan-label">Bitiş Tarihi (Opsiyonel)</label>
                            <input type="date" class="plan-input" name="tekrar_bitis_tarihi" id="modal_tekrar_bitis_tarihi" placeholder="Sınırsız için boş bırakın">
                        </div>
                    </div>
                    <div class="plan-field" style="margin-top: 12px;">
                        <label class="plan-label">Tekrar Sayısı (Opsiyonel)</label>
                        <input type="number" class="plan-input" name="tekrar_sayisi" id="modal_tekrar_sayisi" min="1" placeholder="Kaç kez tekrarlanacak? (Boş bırakılırsa bitiş tarihine kadar)">
                    </div>
                </div>
            </div>
        </div>

        <div class="plan-actions">
            <div style="display: flex; gap: 10px; width: 100%;">
                <button type="button" id="modal_delete_btn" class="plan-btn" style="background: #ef4444; color: #fff; border-color: #ef4444; display: none;" onclick="deletePlan()">
                    <i class="ki-filled ki-trash"></i>Sil
                </button>
                <button type="button" id="modal_complete_btn" class="plan-btn" style="background: #10b981; color: #fff; border-color: #10b981; display: none;" onclick="completePlan()">
                    <i class="ki-filled ki-check-circle"></i>Tamamlandı
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
    // Tekrarlama seçeneklerini göster/gizle
    function toggleRecurrenceOptions() {
        const tekrarTipi = document.getElementById('modal_tekrar_tipi').value;
        const haftalikOptions = document.getElementById('haftalik_tekrar_options');
        const aylikOptions = document.getElementById('aylik_tekrar_options');
        const yillikOptions = document.getElementById('yillik_tekrar_options');
        const tarihAraligi = document.getElementById('tekrar_tarih_araligi');
        
        // Tüm seçenekleri gizle
        haftalikOptions.style.display = 'none';
        aylikOptions.style.display = 'none';
        yillikOptions.style.display = 'none';
        tarihAraligi.style.display = 'none';
        
        // Seçilen tipe göre göster
        if(tekrarTipi === 'haftalik') {
            haftalikOptions.style.display = 'block';
            tarihAraligi.style.display = 'block';
        } else if(tekrarTipi === 'aylik') {
            aylikOptions.style.display = 'block';
            tarihAraligi.style.display = 'block';
        } else if(tekrarTipi === 'yillik') {
            yillikOptions.style.display = 'block';
            tarihAraligi.style.display = 'block';
        }
        
        // Başlangıç tarihini varsayılan olarak planlama tarihine ayarla
        const planlamaTarihi = document.getElementById('modal_planlama_tarihi').value;
        if(planlamaTarihi && !document.getElementById('modal_tekrar_baslangic_tarihi').value) {
            document.getElementById('modal_tekrar_baslangic_tarihi').value = planlamaTarihi;
        }
    }
    
    // Aylık tekrar şeklini değiştir
    function toggleAylikTekrarSekli() {
        const sekil = document.getElementById('aylik_tekrar_sekli').value;
        const ayGunuOptions = document.getElementById('ay_gunu_options');
        const haftaGunuOptions = document.getElementById('hafta_gunu_options');
        
        if(sekil === 'ay_gunu') {
            ayGunuOptions.style.display = 'block';
            haftaGunuOptions.style.display = 'none';
            // Hafta günü alanlarını temizle
            document.getElementById('modal_tekrar_hafta_gunu').value = '';
            document.getElementById('modal_tekrar_hafta_sira').value = '';
        } else {
            ayGunuOptions.style.display = 'none';
            haftaGunuOptions.style.display = 'block';
            // Ay günü alanını temizle
            document.getElementById('modal_tekrar_ay_gunu').value = '';
        }
    }
    
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
    
    // Event'lerdeki tüm kullanıcı no'larını topla ve resources listesinde olmayanları ekle
    const allUserIds = new Set();
    INITIAL_EVENTS.forEach(evt => {
        if (evt.resource) {
            allUserIds.add(String(evt.resource));
        }
    });
    
    // Resources listesindeki mevcut ID'leri topla
    const existingResourceIds = new Set(RESOURCES.map(r => String(r.id)));
    
    // Eksik kullanıcıları resources listesine ekle
    allUserIds.forEach(userId => {
        if (!existingResourceIds.has(userId)) {
            // Eksik kullanıcıyı resources listesine ekle (isim bilgisi yok, sadece ID)
            RESOURCES.push({
                id: userId,
                name: 'Kullanıcı #' + userId
            });
            console.log('Eksik kullanıcı resources listesine eklendi:', userId);
        }
    });

    const getToday = () => new DayPilot.Date();
    const getTodayString = () => getToday().toString("yyyy-MM-dd");

    // Modern event HTML içeriği oluştur
    function createModernEventHTML(event) {
        const text = event.text || 'Görev';
        const musteriAdi = event.musteri_adi || '';
        const yapilacakIs = event.yapilacak_is || '';
        const oncelik = (event.oncelik || '').toLowerCase().trim();
        const isCompleted = event.isCompleted || event.aktif === 2;
        const isHighPriority = oncelik === 'yuksek' || oncelik === 'yüksek' || oncelik === 'acil' || oncelik === 'high';
        
        // Öncelik badge class'ı
        let priorityClass = 'dp-event-priority-normal';
        let priorityText = 'Normal';
        if (oncelik === 'yuksek' || oncelik === 'yüksek' || oncelik === 'high') {
            priorityClass = 'dp-event-priority-high';
            priorityText = 'Yüksek';
        } else if (oncelik === 'düşük' || oncelik === 'dusuk' || oncelik === 'low') {
            priorityClass = 'dp-event-priority-low';
            priorityText = 'Düşük';
        }
        
        // Başlık - yapılacak iş varsa onu kullan, yoksa text'i kullan
        const title = yapilacakIs || text;
        
        // Saat bilgisi
        const startTime = event.start ? new DayPilot.Date(event.start).toString("HH:mm") : '';
        const endTime = event.end ? new DayPilot.Date(event.end).toString("HH:mm") : '';
        const timeStr = startTime && endTime ? `${startTime} - ${endTime}` : '';
        
        let html = '<div class="dp-event-modern">';
        
        // Header: Başlık ve badge'ler
        html += '<div class="dp-event-header">';
        html += `<div class="dp-event-title">${escapeHtml(title)}</div>`;
        if (!isCompleted && isHighPriority) {
            html += `<span class="dp-event-priority-badge ${priorityClass}">${priorityText}</span>`;
        }
        if (isCompleted) {
            html += '<span class="dp-event-status-badge dp-event-status-completed">✓ Tamamlandı</span>';
        }
        html += '</div>';
        
        // Meta: Müşteri ve saat
        html += '<div class="dp-event-meta">';
        if (musteriAdi) {
            html += `<span class="dp-event-musteri">`;
            html += `<span class="dp-event-musteri-icon">👤</span>`;
            html += `<span>${escapeHtml(musteriAdi)}</span>`;
            html += `</span>`;
        }
        if (timeStr) {
            html += `<span class="dp-event-time">🕐 ${timeStr}</span>`;
        }
        html += '</div>';
        
        // Content: İş notu (eğer yapılacak iş varsa ve farklıysa)
        if (text && text !== title) {
            html += `<div class="dp-event-content">${escapeHtml(text)}</div>`;
        }
        
        html += '</div>';
        
        return html;
    }
    
    // HTML escape helper
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Resource validation helper (app tanımlanmadan önce kullanılabilir)
    function getValidResource(resourceId) {
        // Eğer resourceId yoksa, ilk resource'u kullan
        if (!resourceId) {
            return RESOURCES.length > 0 ? RESOURCES[0].id : "";
        }
        
        const normalized = typeof resourceId === "object"
            ? resourceId.id || resourceId.value || resourceId.key || resourceId.toString?.()
            : String(resourceId);
        
        if (!normalized) {
            return RESOURCES.length > 0 ? RESOURCES[0].id : "";
        }
        
        // Resource'u bul
        const found = RESOURCES.find(r => String(r.id) === String(normalized));
        
        // Eğer bulunamazsa, resourceId'yi olduğu gibi döndür (takvimde gösterilebilmesi için)
        // Ama eğer RESOURCES boşsa, boş string döndür
        if (!found) {
            // Resource bulunamadı ama yine de event'i göstermek için resourceId'yi kullan
            // Ancak takvimde bu resource yoksa event gösterilmeyecek
            // Bu durumda, ilk resource'u kullan veya resourceId'yi olduğu gibi kullan
            console.warn('Resource bulunamadı:', normalized, 'Mevcut resources:', RESOURCES.map(r => r.id));
            // Resource'u olduğu gibi kullan - takvimde bu resource yoksa event gösterilmeyecek
            // Ama en azından deneyelim
            return normalized;
        }
        
        return found.id;
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
            oncelik = "Normal",
            musteri = "",
            yapilacakIs = "",
            isNotu = "",
            eventId = "",
            aktif = 1
        } = data;

        // Form alanlarını doldur
        const kullaniciNoEl = document.getElementById("modal_kullanici_no");
        const planlamaTarihiEl = document.getElementById("modal_planlama_tarihi");
        const baslangicSaatiEl = document.getElementById("modal_baslangic_saati");
        const bitisSaatiEl = document.getElementById("modal_bitis_saati");
        const oncelikEl = document.getElementById("modal_oncelik");
        const musteriEl = document.getElementById("modal_musteri");
        const yapilacakIsEl = document.getElementById("modal_yapilacak_is");
        const isNotuEl = document.getElementById("modal_is_notu");
        const eventIdEl = document.getElementById("modal_is_planlamasi_id");
        
        if (kullaniciNoEl) kullaniciNoEl.value = resource || '';
        if (planlamaTarihiEl) planlamaTarihiEl.value = date || '';
        if (baslangicSaatiEl) baslangicSaatiEl.value = startTime || '09:00';
        if (bitisSaatiEl) bitisSaatiEl.value = endTime || '17:00';
        
        // Öncelik - değeri doğru şekilde set et
        if (oncelikEl) {
            oncelikEl.value = oncelik || 'Normal';
            // Eğer değer select'te yoksa, Normal'i seç
            if (!Array.from(oncelikEl.options).some(opt => opt.value === oncelikEl.value)) {
                oncelikEl.value = 'Normal';
            }
        }
        
        // Müşteri - değeri doğru şekilde set et
        if (musteriEl) {
            musteriEl.value = musteri || '';
            // Eğer değer select'te yoksa, boş seç
            if (musteri && !Array.from(musteriEl.options).some(opt => opt.value === musteri)) {
                console.warn('Müşteri bulunamadı:', musteri);
                musteriEl.value = '';
            }
        }
        
        if (yapilacakIsEl) yapilacakIsEl.value = yapilacakIs || '';
        if (isNotuEl) isNotuEl.value = isNotu || '';
        if (eventIdEl) eventIdEl.value = eventId || '';
        
        // Debug: Set edilen değerleri konsola yazdır
        console.log('fillPlanModal - Set edilen değerler:', {
            oncelik: oncelikEl ? oncelikEl.value : 'N/A',
            musteri: musteriEl ? musteriEl.value : 'N/A',
            resource: kullaniciNoEl ? kullaniciNoEl.value : 'N/A'
        });
        
        // Silme ve tamamlandı butonlarını göster/gizle ve başlığı güncelle
        const deleteBtn = document.getElementById("modal_delete_btn");
        const completeBtn = document.getElementById("modal_complete_btn");
        const modalTitle = document.getElementById("modal_title");
        const modalSubtitle = document.getElementById("modal_subtitle");
        
        // Aktiflik durumunu kontrol et (1: aktif, 2: tamamlandı)
        const aktifDurumu = parseInt(aktif) || 1;
        const isCompleted = (aktifDurumu === 2);
        
        if (eventId && eventId !== "") {
            // Güncelleme modu
            if (deleteBtn) deleteBtn.style.display = "inline-flex";
            // Tamamlandı butonu sadece aktif durumu 1 ise görünsün (tamamlanmamışsa)
            if (completeBtn) {
                completeBtn.style.display = isCompleted ? "none" : "inline-flex";
            }
            if (modalTitle) modalTitle.textContent = "İş Planı Düzenle";
            if (modalSubtitle) modalSubtitle.textContent = "İş planı bilgilerini güncelleyiniz";
        } else {
            // Yeni kayıt modu
            if (deleteBtn) deleteBtn.style.display = "none";
            if (completeBtn) completeBtn.style.display = "none";
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
    
    function completePlan() {
        const eventId = document.getElementById("modal_is_planlamasi_id").value;
        if (!eventId || eventId === "") {
            alert('Tamamlanacak kayıt bulunamadı.');
            return;
        }
        
        if (confirm('Bu iş planını tamamlandı olarak işaretlemek istediğinize emin misiniz?')) {
            window.location.href = "<?=base_url('ugajans_ekip/is_planlamasi_tamamla/')?>" + eventId;
        }
    }
    
    // Form submit edilmeden önce tekrar günlerini işle
    function prepareRecurrenceData() {
        const tekrarTipi = document.getElementById('modal_tekrar_tipi').value;
        
        // Haftalık tekrar için günleri topla
        if(tekrarTipi === 'haftalik') {
            const checkedDays = Array.from(document.querySelectorAll('.recurrence-day-checkbox:checked'))
                .map(cb => cb.value)
                .sort((a, b) => parseInt(a) - parseInt(b));
            
            // Hidden input oluştur veya güncelle
            let hiddenInput = document.querySelector('input[name="tekrar_gunleri"]');
            if(!hiddenInput) {
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'tekrar_gunleri';
                document.getElementById('planModalForm').appendChild(hiddenInput);
            }
            hiddenInput.value = checkedDays.join(',');
        } else {
            // Haftalık değilse tekrar_gunleri'ni temizle
            const hiddenInput = document.querySelector('input[name="tekrar_gunleri"]');
            if(hiddenInput) {
                hiddenInput.remove();
            }
        }
        
        // Tek seferlik ise tüm tekrar alanlarını temizle
        if(tekrarTipi === 'tek_seferlik') {
            // Tüm tekrar alanlarını temizle
            const recurrenceInputs = document.querySelectorAll('[name^="tekrar_"]');
            recurrenceInputs.forEach(input => {
                if(input.type === 'hidden') {
                    input.remove();
                } else {
                    input.value = '';
                }
            });
        }
    }
    
    function validatePlanForm() {
        // Tekrarlama verilerini hazırla
        prepareRecurrenceData();
        const form = document.getElementById("planModalForm");
        if (!form) return false;
        
        // Debug: Form verilerini konsola yazdır
        const formData = new FormData(form);
        console.log('Form submit - Öncelik:', formData.get('oncelik'));
        console.log('Form submit - Müşteri:', formData.get('musteri_no'));
        console.log('Form submit - Tüm form data:', Object.fromEntries(formData));
        
        return true;
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
        // Sürükle-bırak özelliğini aktif et
        eventMoveHandling: "Update",
        // Genişletme özelliğini aktif et
        eventResizeHandling: "Update",
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
                const response = await fetch('<?=base_url("ugajans_ekip/ajax_get_events")?>', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    credentials: 'same-origin'
                });
                
                if (!response.ok) {
                    throw new Error('HTTP error! status: ' + response.status);
                }
                
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
                        
                        // Öncelik değerini normalize et - veritabanından gelen değeri kullan
                        let oncelik = event.oncelik || 'Normal';
                        if (oncelik) {
                            oncelik = String(oncelik).trim();
                            const oncelikLower = oncelik.toLowerCase();
                            // Veritabanında "yuksek" olarak kayıtlı, select'te value="yuksek" var
                            if (oncelikLower === 'yuksek' || oncelikLower === 'yüksek' || oncelikLower === 'high') {
                                oncelik = 'yuksek';
                            } else if (oncelikLower === 'acil' || oncelikLower === 'urgent') {
                                oncelik = 'Acil';
                            } else if (oncelikLower === 'düşük' || oncelikLower === 'dusuk' || oncelikLower === 'low') {
                                oncelik = 'Düşük';
                            } else {
                                oncelik = 'Normal';
                            }
                        } else {
                            oncelik = 'Normal';
                        }
                        
                        // Müşteri no - null, 0, boş string kontrolü
                        let musteri = '';
                        if (event.musteri_no !== null && event.musteri_no !== undefined && event.musteri_no !== '' && event.musteri_no !== 0) {
                            musteri = String(event.musteri_no);
                        }
                        
                        // Aktiflik durumunu al
                        const aktifDurumu = event.aktif !== undefined ? parseInt(event.aktif) : 1;
                        
                        console.log('Modal açılıyor - Öncelik:', oncelik, 'Müşteri:', musteri, 'Aktif:', aktifDurumu, 'Event:', event);
                        
                        openPlanModal({
                            resource: String(event.kullanici_no || ''),
                            date: startDate,
                            startTime: startTime,
                            endTime: endTime,
                            oncelik: oncelik,
                            musteri: musteri,
                            yapilacakIs: event.yapilacak_is || '',
                            isNotu: event.is_notu || '',
                            eventId: String(event.is_planlamasi_id),
                            aktif: aktifDurumu
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
        },
        // Event sürükle-bırak (taşıma) işlemi
        onEventMove: async (args) => {
            const eventId = args.e.data.id;
            const newResource = getValidResource(args.newResource);
            const newDate = args.newStart.toString("yyyy-MM-dd");
            const newStartTime = args.newStart.toString("HH:mm");
            const newEndTime = args.newEnd.toString("HH:mm");
            
            // Eski değerleri al
            const oldDate = args.e.data.start ? new DayPilot.Date(args.e.data.start).toString("yyyy-MM-dd") : '';
            const oldStartTime = args.e.data.start ? new DayPilot.Date(args.e.data.start).toString("HH:mm") : '';
            const oldEndTime = args.e.data.end ? new DayPilot.Date(args.e.data.end).toString("HH:mm") : '';
            const oldResource = args.e.data.resource;
            
            console.log('Event move başladı:', {
                eventId: eventId,
                oldResource: oldResource,
                newResource: newResource,
                oldDate: oldDate,
                newDate: newDate,
                oldStartTime: oldStartTime,
                newStartTime: newStartTime,
                oldEndTime: oldEndTime,
                newEndTime: newEndTime
            });
            
            // Eğer hiçbir şey değişmediyse, güncelleme yapmaya gerek yok
            if (newResource === oldResource && 
                newDate === oldDate && 
                newStartTime === oldStartTime && 
                newEndTime === oldEndTime) {
                console.log('Değişiklik yok, güncelleme atlanıyor');
                return;
            }
            
            // Eğer sadece saat değiştiyse (tarih ve resource aynı), resize kullan
            if (newResource === oldResource && newDate === oldDate && 
                (newStartTime !== oldStartTime || newEndTime !== oldEndTime)) {
                console.log('Sadece saat değişti, resize kullanılıyor');
                // Resize işlemini tetikle
                try {
                    const formData = new FormData();
                    formData.append('event_id', eventId);
                    formData.append('start_time', newStartTime);
                    formData.append('end_time', newEndTime);
                    
                    const response = await fetch('<?=base_url("ugajans_ekip/ajax_event_resize")?>', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData,
                        credentials: 'same-origin'
                    });
                    
                    if (!response.ok) {
                        throw new Error('HTTP error! status: ' + response.status);
                    }
                    
                    const result = await response.json();
                    console.log('Resize AJAX yanıtı:', result);
                    
                    if (result.status === 'success') {
                        args.e.data.start = args.newStart;
                        args.e.data.end = args.newEnd;
                        args.e.data.html = createModernEventHTML(args.e.data);
                        calendar.events.update(args.e);
                        // Sayfayı yenile
                        setTimeout(() => {
                            window.location.reload();
                        }, 300);
                    } else {
                        args.preventDefault();
                        alert(result.message || 'Görev süresi değiştirilemedi');
                        calendar.events.update(args.e);
                    }
                } catch (error) {
                    console.error('Resize hatası:', error);
                    args.preventDefault();
                    alert('Görev süresi değiştirilirken bir hata oluştu: ' + error.message);
                    calendar.events.update(args.e);
                }
                return;
            }
            
            // Tarih veya resource değiştiyse, move kullan
            try {
                const formData = new FormData();
                formData.append('event_id', eventId);
                formData.append('person_id', newResource);
                formData.append('date', newDate);
                // Saat bilgisini de gönder (eğer değiştiyse)
                if (newStartTime !== oldStartTime || newEndTime !== oldEndTime) {
                    formData.append('start_time', newStartTime);
                    formData.append('end_time', newEndTime);
                }
                
                console.log('Move AJAX isteği gönderiliyor:', {
                    event_id: eventId,
                    person_id: newResource,
                    date: newDate,
                    start_time: newStartTime,
                    end_time: newEndTime
                });
                
                const response = await fetch('<?=base_url("ugajans_ekip/ajax_event_move")?>', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData,
                    credentials: 'same-origin'
                });
                
                // Response'un başarılı olup olmadığını kontrol et
                if (!response.ok) {
                    throw new Error('HTTP error! status: ' + response.status);
                }
                
                const result = await response.json();
                console.log('Move AJAX yanıtı:', result);
                
                if (result.status === 'success') {
                    // Event'i güncelle
                    args.e.data.resource = newResource;
                    args.e.data.start = args.newStart;
                    args.e.data.end = args.newEnd;
                    args.e.data.html = createModernEventHTML(args.e.data);
                    calendar.events.update(args.e);
                    // Sayfayı yenile
                    setTimeout(() => {
                        window.location.reload();
                    }, 300);
                } else {
                    // Hata durumunda eski konuma geri döndür
                    args.preventDefault();
                    console.error('Event move hatası:', result.message);
                    alert(result.message || 'Görev taşınamadı');
                    calendar.events.update(args.e);
                }
            } catch (error) {
                console.error('Event move hatası:', error);
                args.preventDefault();
                alert('Görev taşınırken bir hata oluştu: ' + error.message);
                calendar.events.update(args.e);
            }
        },
        // Event genişletme (süre değiştirme) işlemi
        onEventResize: async (args) => {
            const eventId = args.e.data.id;
            // Saat formatını HH:mm olarak al (saniye kısmını kaldır)
            const newStartTime = args.newStart.toString("HH:mm");
            const newEndTime = args.newEnd.toString("HH:mm");
            
            console.log('Event resize başladı:', {
                eventId: eventId,
                newStartTime: newStartTime,
                newEndTime: newEndTime
            });
            
            try {
                const formData = new FormData();
                formData.append('event_id', eventId);
                formData.append('start_time', newStartTime);
                formData.append('end_time', newEndTime);
                
                console.log('AJAX isteği gönderiliyor:', {
                    event_id: eventId,
                    start_time: newStartTime,
                    end_time: newEndTime
                });
                
                const response = await fetch('<?=base_url("ugajans_ekip/ajax_event_resize")?>', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData,
                    credentials: 'same-origin'
                });
                
                // Response'un başarılı olup olmadığını kontrol et
                if (!response.ok) {
                    throw new Error('HTTP error! status: ' + response.status);
                }
                
                const result = await response.json();
                console.log('AJAX yanıtı:', result);
                
                if (result.status === 'success') {
                    // Event'i güncelle
                    args.e.data.start = args.newStart;
                    args.e.data.end = args.newEnd;
                    // Modern HTML içeriğini yeniden oluştur
                    args.e.data.html = createModernEventHTML(args.e.data);
                    calendar.events.update(args.e);
                    // Sayfayı yenile
                    setTimeout(() => {
                        window.location.reload();
                    }, 300);
                } else {
                    // Hata durumunda eski süreye geri döndür
                    args.preventDefault();
                    console.error('Event resize hatası:', result.message);
                    alert(result.message || 'Görev süresi değiştirilemedi');
                    calendar.events.update(args.e);
                }
            } catch (error) {
                console.error('Event resize hatası:', error);
                args.preventDefault();
                alert('Görev süresi değiştirilirken bir hata oluştu: ' + error.message);
                calendar.events.update(args.e);
            }
        }
    });

    // Calendar'ı başlat
    calendar.init();
    
    // Eğer RESOURCES güncellendiyse, calendar'ın columns'ını da güncelle
    if (RESOURCES.length > 0) {
        calendar.update({ columns: RESOURCES });
    }

    const app = {
        currentDate: getToday(),
        eventCache: new Map(), // Event cache - tarih aralığına göre saklanır
        loadingDebounceTimer: null, // Debounce timer
        isLoading: false, // Loading state
        
        getValidResource(resourceId) {
            // Global getValidResource fonksiyonunu kullan
            return getValidResource(resourceId);
        },
        
        // Görünen tarih aralığını hesapla (haftalık görünüm için)
        getVisibleDateRange() {
            try {
                // DayPilot calendar'dan görünen tarih aralığını al
                const visibleStart = calendar.visibleStart();
                const visibleEnd = calendar.visibleEnd();
                
                if (visibleStart && visibleEnd) {
                    return {
                        start: visibleStart.toString("yyyy-MM-dd"),
                        end: visibleEnd.toString("yyyy-MM-dd")
                    };
                }
            } catch (e) {
                console.warn('Görünen tarih aralığı alınamadı, varsayılan aralık kullanılıyor:', e);
            }
            
            // Fallback: Seçili tarihten önce 3 gün, sonra 3 gün
            const start = new DayPilot.Date(this.currentDate).addDays(-3);
            const end = new DayPilot.Date(this.currentDate).addDays(3);
            return {
                start: start.toString("yyyy-MM-dd"),
                end: end.toString("yyyy-MM-dd")
            };
        },
        
        // Cache key oluştur
        getCacheKey(startDate, endDate) {
            return `${startDate}_${endDate}`;
        },
        
        // Cache'den eventleri kontrol et
        getCachedEvents(startDate, endDate) {
            const cacheKey = this.getCacheKey(startDate, endDate);
            return this.eventCache.get(cacheKey) || null;
        },
        
        // Eventleri cache'e kaydet
        cacheEvents(startDate, endDate, events) {
            const cacheKey = this.getCacheKey(startDate, endDate);
            this.eventCache.set(cacheKey, {
                events: events,
                timestamp: Date.now()
            });
            
            // Cache'i temizle - 10 dakikadan eski kayıtları sil
            const maxAge = 10 * 60 * 1000; // 10 dakika
            for (const [key, value] of this.eventCache.entries()) {
                if (Date.now() - value.timestamp > maxAge) {
                    this.eventCache.delete(key);
                }
            }
        },
        
        // Loading state'i göster/gizle
        setLoading(loading) {
            this.isLoading = loading;
            const calendarContainer = document.getElementById("pt-calendar");
            if (calendarContainer) {
                if (loading) {
                    calendarContainer.style.opacity = "0.6";
                    calendarContainer.style.pointerEvents = "none";
                } else {
                    calendarContainer.style.opacity = "1";
                    calendarContainer.style.pointerEvents = "auto";
                }
            }
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
            
            // Debouncing: Hızlı tarih değişikliklerinde gereksiz istekleri önle
            if (this.loadingDebounceTimer) {
                clearTimeout(this.loadingDebounceTimer);
            }
            
            this.loadingDebounceTimer = setTimeout(() => {
                this.loadData();
            }, 300); // 300ms debounce
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
            // Görünen tarih aralığını al
            const dateRange = this.getVisibleDateRange();
            
            // Önce cache'i kontrol et
            const cached = this.getCachedEvents(dateRange.start, dateRange.end);
            if (cached && cached.events) {
                console.log('Cache\'den eventler yükleniyor:', dateRange);
                const mapped = this.mapEvents(cached.events);
                calendar.update({ events: mapped });
                return;
            }
            
            // Önce INITIAL_EVENTS'i kontrol et
            if (INITIAL_EVENTS && INITIAL_EVENTS.length > 0) {
                // INITIAL_EVENTS'i görünen tarih aralığına göre filtrele
                const filteredEvents = INITIAL_EVENTS.filter(evt => {
                    if (!evt.start) return false;
                    const eventDate = evt.start.split('T')[0];
                    return eventDate >= dateRange.start && eventDate <= dateRange.end;
                });
                
                if (filteredEvents.length > 0) {
                    console.log('INITIAL_EVENTS\'ten filtrelenmiş eventler yükleniyor:', filteredEvents.length);
                    const mapped = this.mapEvents(filteredEvents);
                    calendar.update({ events: mapped });
                    // Cache'e kaydet
                    this.cacheEvents(dateRange.start, dateRange.end, filteredEvents);
                    return;
                }
            }
            
            // Loading state'i göster
            this.setLoading(true);
            
            // AJAX ile yükle - tarih aralığı parametresi ekle
            const url = new URL('<?=base_url("ugajans_ekip/ajax_get_events")?>', window.location.origin);
            url.searchParams.append('start_date', dateRange.start);
            url.searchParams.append('end_date', dateRange.end);
            
            fetch(url.toString(), {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                credentials: 'same-origin'
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('HTTP error! status: ' + response.status);
                    }
                    return response.json();
                })
                .then(result => {
                    this.setLoading(false);
                    if (result.status === 'success' && result.events && result.events.length > 0) {
                        // Tarih aralığına göre filtrele (backend'den gelen tüm eventler olabilir)
                        const filteredEvents = result.events.filter(evt => {
                            if (!evt.planlama_tarihi) return false;
                            const eventDate = evt.planlama_tarihi.split(' ')[0];
                            return eventDate >= dateRange.start && eventDate <= dateRange.end;
                        });
                        
                        console.log('AJAX\'tan yüklenen eventler:', filteredEvents.length, 'Tarih aralığı:', dateRange);
                        const mapped = this.mapEventsFromAjax(filteredEvents);
                        calendar.update({ events: mapped });
                        // Cache'e kaydet
                        this.cacheEvents(dateRange.start, dateRange.end, filteredEvents);
                    } else {
                        // Event yoksa boş array gönder
                        calendar.update({ events: [] });
                        this.cacheEvents(dateRange.start, dateRange.end, []);
                    }
                })
                .catch(error => {
                    this.setLoading(false);
                    console.error('Event verileri yüklenemedi:', error);
                    // Hata durumunda INITIAL_EVENTS'i kullan (fallback)
                    if (INITIAL_EVENTS && INITIAL_EVENTS.length > 0) {
                        const filteredEvents = INITIAL_EVENTS.filter(evt => {
                            if (!evt.start) return false;
                            const eventDate = evt.start.split('T')[0];
                            return eventDate >= dateRange.start && eventDate <= dateRange.end;
                        });
                        const mapped = this.mapEvents(filteredEvents);
                        calendar.update({ events: mapped });
                    }
                });
        },
        
        // INITIAL_EVENTS'i map'le
        mapEvents(events) {
            return events.map(evt => {
                    // Aktiflik durumu kontrolü
                    const aktifDurumu = evt.aktif !== undefined ? parseInt(evt.aktif) : 1;
                    const isCompleted = (aktifDurumu === 2);
                    
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
                        text: evt.text || "Görev",
                        musteri_adi: evt.musteri_adi || '',
                        yapilacak_is: evt.yapilacak_is || '',
                        oncelik: evt.oncelik || 'normal',
                        isCompleted: isCompleted,
                        aktif: aktifDurumu
                    };
                    
                    // Modern HTML içeriği ekle
                    eventObj.html = createModernEventHTML(eventObj);
                    
                    // Tamamlanan event'lere CSS class ekle (öncelikten önce kontrol et)
                    if (isCompleted) {
                        eventObj.cssClass = "calendar_default_event_completed";
                        eventObj.backColor = "#d1fae5";
                        eventObj.borderColor = "#10b981";
                    }
                    // Yüksek öncelikli event'lere CSS class ekle (tamamlanan değilse)
                    else if (isHighPriority) {
                        eventObj.cssClass = "calendar_default_event_high_priority";
                        eventObj.backColor = "#fee2e2";
                        eventObj.borderColor = "#ef4444";
                    }
                    
                    return eventObj;
                }).filter(evt => {
                    // Event null değilse ve resource varsa (boş string bile olsa) göster
                    if (evt === null) return false;
                    // Resource kontrolü - eğer resource yoksa veya boş string ise, yine de göster
                    // Çünkü takvim resource'u dinamik olarak ekleyebilir
                    return true;
                });
        },
        
        // AJAX'tan gelen eventleri map'le
        mapEventsFromAjax(events) {
            return events.map(evt => {
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
                
                // Aktiflik durumu kontrolü
                const aktifDurumu = evt.aktif !== undefined ? parseInt(evt.aktif) : 1;
                const isCompleted = (aktifDurumu === 2);
                
                // Öncelik kontrolü
                const oncelik = (evt.oncelik || '').toLowerCase().trim();
                const isHighPriority = oncelik === 'yuksek' || oncelik === 'yüksek' || oncelik === 'acil' || oncelik === 'high';
                
                // Müşteri bilgisini al
                const musteriAdi = evt.musteri_ad_soyad || '';
                
                const eventObj = {
                    start: startDate + 'T' + startTime,
                    end: startDate + 'T' + endTime,
                    resource: this.getValidResource(String(evt.kullanici_no)),
                    id: String(evt.is_planlamasi_id),
                    text: evt.is_notu || evt.yapilacak_is || "Görev",
                    musteri_adi: musteriAdi,
                    yapilacak_is: evt.yapilacak_is || '',
                    oncelik: oncelik,
                    isCompleted: isCompleted,
                    aktif: aktifDurumu
                };
                
                // Modern HTML içeriği ekle
                eventObj.html = createModernEventHTML(eventObj);
                
                // Tamamlanan event'lere CSS class ekle (öncelikten önce kontrol et)
                if (isCompleted) {
                    eventObj.cssClass = "calendar_default_event_completed";
                    eventObj.backColor = "#d1fae5";
                    eventObj.borderColor = "#10b981";
                }
                // Yüksek öncelikli event'lere CSS class ekle (tamamlanan değilse)
                else if (isHighPriority) {
                    eventObj.cssClass = "calendar_default_event_high_priority";
                    eventObj.backColor = "#fee2e2";
                    eventObj.borderColor = "#ef4444";
                }
                
                return eventObj;
            }).filter(evt => {
                // Event null değilse göster
                if (evt === null) return false;
                // Resource kontrolü - eğer resource yoksa veya boş string ise, yine de göster
                // Çünkü takvim resource'u dinamik olarak ekleyebilir
                return true;
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
                    
                    // Tarih geçerliliğini kontrol et
                    try {
                        // JavaScript Date ile kontrol et
                        const jsDate = new Date(dateValue);
                        if (isNaN(jsDate.getTime())) {
                            // Geçersiz tarih
                            this.updateDateInput();
                            return;
                        }
                        
                        // DayPilot.Date nesnesi oluştur
                        const selectedDate = new DayPilot.Date(dateValue);
                        
                        // DayPilot.Date'nin geçerli olup olmadığını kontrol et (toString ile)
                        const dateString = selectedDate.toString("yyyy-MM-dd");
                        if (dateString && dateString !== "Invalid Date" && dateString.length === 10) {
                            this.updateDate(selectedDate);
                        } else {
                            this.updateDateInput();
                        }
                    } catch (error) {
                        console.error('Tarih işleme hatası:', error);
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
            
                    // Aktiflik durumu kontrolü
                    const aktifDurumu = evt.aktif !== undefined ? parseInt(evt.aktif) : 1;
                    const isCompleted = (aktifDurumu === 2);
                    
                    // Öncelik kontrolü
                    const oncelik = (evt.oncelik || '').toLowerCase().trim();
                    const isHighPriority = oncelik === 'yuksek' || oncelik === 'yüksek' || oncelik === 'acil' || oncelik === 'high';
                    
                    const eventObj = {
                        start: start,
                        end: end,
                        resource: app.getValidResource(evt.resource),
                        id: evt.id,
                        text: evt.text || "Görev",
                        musteri_adi: evt.musteri_adi || '',
                        yapilacak_is: evt.yapilacak_is || '',
                        oncelik: evt.oncelik || 'normal',
                        isCompleted: isCompleted,
                        aktif: aktifDurumu
                    };
                    
                    // Modern HTML içeriği ekle
                    eventObj.html = createModernEventHTML(eventObj);
                    
                    // Tamamlanan event'lere CSS class ekle (öncelikten önce kontrol et)
                    if (isCompleted) {
                        eventObj.cssClass = "calendar_default_event_completed";
                        eventObj.backColor = "#d1fae5";
                        eventObj.borderColor = "#10b981";
                    }
                    // Yüksek öncelikli event'lere CSS class ekle (tamamlanan değilse)
                    else if (isHighPriority) {
                        eventObj.cssClass = "calendar_default_event_high_priority";
                        eventObj.backColor = "#fee2e2";
                        eventObj.borderColor = "#ef4444";
                    }
                    
                    return eventObj;
                });
                calendar.update({ events: mapped });
            }
</script>
