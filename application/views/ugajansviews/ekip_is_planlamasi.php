<?php
$resources = [];
if (isset($kullanicilar_data) && is_array($kullanicilar_data)) {
    foreach ($kullanicilar_data as $user) {
        $resources[] = [
            'name' => $user->ugajans_kullanici_ad_soyad ?? 'Personel',
            'id'   => (string)($user->ugajans_kullanici_id ?? '')
        ];
    }
}
if (empty($resources)) {
    $resources = [
        ['name' => 'Personel A', 'id' => 'A'],
        ['name' => 'Personel B', 'id' => 'B'],
        ['name' => 'Personel C', 'id' => 'C'],
        ['name' => 'Personel D', 'id' => 'D']
    ];
}

$events = [];
if (isset($is_planlamasi_data) && is_array($is_planlamasi_data)) {
    foreach ($is_planlamasi_data as $plan) {
        $start = ($plan->planlama_tarihi ?? date('Y-m-d')) . 'T' . ($plan->baslangic_saati ?? '09:00');
        $end   = ($plan->planlama_tarihi ?? date('Y-m-d')) . 'T' . ($plan->bitis_saati ?? '17:00');
        $events[] = [
            'start'    => $start,
            'end'      => $end,
            'resource' => (string)($plan->kullanici_no ?? ''),
            'id'       => $plan->is_planlamasi_id ?? uniqid('event_', true),
            'text'     => $plan->is_notu ?? 'Görev',
        ];
    }
}
?>

<link rel="stylesheet" href="<?=base_url('ugajansassets/calendar/css/metronic-integration.css')?>">
<link rel="stylesheet" href="<?=base_url('ugajansassets/calendar/css/date-picker.css')?>">

<style>
    /* Ek tam yükseklik düzeni */
    #personel-takvim-container { min-height: 80vh; }
    #personel-takvim-container .pt-calendar-wrapper { min-height: 60vh; }

    /* Modal */
    .plan-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.25);
        backdrop-filter: blur(4px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 90;
        padding: 24px;
    }
    .plan-modal {
        width: 100%;
        max-width: 720px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.25);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .plan-modal__header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 20px 24px;
        border-bottom: 1px solid #eef1f6;
    }
    .plan-modal__icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #e8f4ff;
        color: #0b64c0;
        display: grid;
        place-items: center;
        font-size: 22px;
    }
    .plan-modal__title {
        font-weight: 700;
        font-size: 18px;
        color: #0f172a;
        margin: 0;
    }
    .plan-modal__subtitle {
        margin: 2px 0 0 0;
        color: #475569;
        font-size: 14px;
    }
    .plan-modal__close {
        margin-left: auto;
        background: transparent;
        border: none;
        color: #94a3b8;
        font-size: 20px;
        cursor: pointer;
    }
    .plan-modal__body {
        padding: 20px 24px 12px;
        max-height: calc(90vh - 140px);
        overflow-y: auto;
    }
    .plan-section {
        border: 1px solid #eef1f6;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 14px;
        background: #fafbff;
    }
    .plan-section__title {
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
        letter-spacing: 0.3px;
        margin-bottom: 12px;
    }
    .plan-grid {
        display: grid;
        gap: 12px;
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
        color: #0f172a;
    }
    .plan-required { color: #ef4444; margin-left: 4px; }
    .plan-input,
    .plan-select,
    .plan-textarea {
        width: 100%;
        border: 1px solid #d8dee9;
        border-radius: 10px;
        padding: 10px 12px;
        font-size: 14px;
        color: #0f172a;
        background: #fff;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .plan-input:focus,
    .plan-select:focus,
    .plan-textarea:focus {
        outline: none;
        border-color: #0b64c0;
        box-shadow: 0 0 0 3px rgba(11, 100, 192, 0.12);
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
    }
    .plan-btn {
        border-radius: 10px;
        padding: 10px 16px;
        font-weight: 700;
        font-size: 14px;
        border: 1px solid transparent;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .plan-btn--secondary {
        background: #f8fafc;
        border-color: #d8dee9;
        color: #0f172a;
    }
    .plan-btn--primary {
        background: #0b64c0;
        color: #fff;
        border-color: #0b64c0;
    }
    @media (max-width: 640px) {
        .plan-modal { max-width: 100%; }
        .plan-modal__body { max-height: calc(90vh - 120px); }
    }
</style>

<div id="personel-takvim-container">
    <div class="pt-nav-bar">
        <div class="pt-nav-left">
            <button type="button" class="pt-nav-btn" id="pt-btnPrev">
                <span class="pt-nav-icon">&#9664;</span>Önceki
            </button>
        </div>

        <div class="pt-nav-center">
            <input type="date" id="pt-date-input" class="pt-date-input-field" aria-label="Tarih seç" />
        </div>

        <div class="pt-nav-right">
            <button type="button" class="pt-nav-btn" id="pt-btnNext">
                Sonraki<span class="pt-nav-icon">&#9654;</span>
            </button>
        </div>

        <div class="pt-nav-personel">
            <select id="pt-personel-select" class="pt-personel-select">
                <option value="">Tüm Personeller</option>
                <?php foreach ($resources as $res): ?>
                    <option value="<?=$res['id']?>"><?=$res['name']?></option>
                <?php endforeach; ?>
            </select>
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
                <h3 class="plan-modal__title">Yeni İş Planı Ekle</h3>
                <p class="plan-modal__subtitle">İş planı bilgilerini doldurunuz</p>
            </div>
            <button class="plan-modal__close" type="button" onclick="togglePlanModal(false)">×</button>
        </div>

        <div class="plan-modal__body">
            <!-- Personel & Date -->
            <div class="plan-section">
                <div class="plan-section__title">PERSONEL VE TARİH</div>
                <div class="plan-grid">
                    <div class="plan-field">
                        <label class="plan-label">Personel<span class="plan-required">*</span></label>
                        <select class="plan-select" name="modal_kullanici_no" id="modal_kullanici_no" required>
                            <option value="">Seçiniz</option>
                            <?php foreach ($resources as $res): ?>
                                <option value="<?=$res['id']?>"><?=$res['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="plan-field">
                        <label class="plan-label">Tarih<span class="plan-required">*</span></label>
                        <input type="date" class="plan-input" name="modal_planlama_tarihi" id="modal_planlama_tarihi" required>
                    </div>
                </div>
            </div>

            <!-- Time Planning -->
            <div class="plan-section">
                <div class="plan-section__title">ZAMAN PLANLAMASI</div>
                <div class="plan-grid">
                    <div class="plan-field">
                        <label class="plan-label">Başlangıç Saati<span class="plan-required">*</span></label>
                        <input type="time" class="plan-input" name="modal_baslangic_saati" id="modal_baslangic_saati" required>
                    </div>
                    <div class="plan-field">
                        <label class="plan-label">Bitiş Saati<span class="plan-required">*</span></label>
                        <input type="time" class="plan-input" name="modal_bitis_saati" id="modal_bitis_saati" required>
                    </div>
                </div>
            </div>

            <!-- Category & Priority -->
            <div class="plan-section">
                <div class="plan-section__title">KATEGORİ VE ÖNCELİK</div>
                <div class="plan-grid">
                    <div class="plan-field">
                        <label class="plan-label">Planlama Tipi<span class="plan-required">*</span></label>
                        <select class="plan-select" name="modal_planlama_tipi" id="modal_planlama_tipi" required>
                            <option value="">Seçiniz</option>
                            <option value="Haftalık">Haftalık</option>
                            <option value="Aylık">Aylık</option>
                            <option value="Günlük">Günlük</option>
                        </select>
                    </div>
                    <div class="plan-field">
                        <label class="plan-label">Öncelik</label>
                        <select class="plan-select" name="modal_oncelik" id="modal_oncelik">
                            <option value="Normal">Normal</option>
                            <option value="Yüksek">Yüksek</option>
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
                        <select class="plan-select" name="modal_musteri" id="modal_musteri">
                            <option value="">Seçiniz</option>
                            <?php if (isset($musteriler_data) && is_array($musteriler_data)): ?>
                                <?php foreach ($musteriler_data as $m): ?>
                                    <option value="<?=$m->musteri_id ?? ''?>"><?=$m->musteri_ad ?? 'Müşteri'?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="plan-field">
                        <label class="plan-label">Yapılacak İş</label>
                        <input type="text" class="plan-input" name="modal_yapilacak_is" id="modal_yapilacak_is" placeholder="İş başlığı">
                    </div>
                </div>
                <div class="plan-field" style="margin-top:12px;">
                    <label class="plan-label">İş Notu<span class="plan-required">*</span></label>
                    <textarea class="plan-textarea" name="modal_is_notu" id="modal_is_notu" placeholder="İş planı detaylarını giriniz" required></textarea>
                </div>
            </div>
        </div>

        <div class="plan-actions">
            <button type="button" class="plan-btn plan-btn--secondary" onclick="togglePlanModal(false)">İptal</button>
            <button type="button" class="plan-btn plan-btn--primary"><i class="ki-filled ki-check"></i>Kaydet</button>
        </div>
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

    // Modal toggle helper
    function togglePlanModal(show = true) {
        const el = document.getElementById("planModal");
        if (!el) return;
        el.style.display = show ? "flex" : "none";
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
                    onClick: (args) => calendar.events.remove(args.source)
                }
            ]
        }),
        onTimeRangeSelected: async (args) => {
            const normalizedResource = app.getValidResource(args.resource);
            if (!normalizedResource) {
                calendar.clearSelection();
                return;
            }
            const data = {
                start: args.start,
                end: args.end,
                id: DayPilot.guid(),
                resource: normalizedResource,
                text: "Yeni görev"
            };
            const result = await app.editEvent(data);
            calendar.clearSelection();
            if (result) {
                calendar.events.add(result);
            }
        },
        onEventClick: async (args) => {
            const result = await app.editEvent(args.e.data);
            if (result) calendar.events.update(result);
        },
        onColumnHeaderClick: async (args) => {
            const resourceId = args.column?.id || args.resource || args.column?.resource || args.column?.data?.id || args.column?.value;
            if (!resourceId) return;
            const normalizedId = app.getValidResource(resourceId);
            const resource = RESOURCES.find(r => r.id === normalizedId);
            const resourceName = resource ? resource.name : String(normalizedId);
            const modal = await DayPilot.Modal.prompt(`${resourceName} için yeni görev oluştur:`, "Yeni görev");
            if (modal.canceled || !modal.result || !modal.result.trim()) return;
            const selectedDate = app.currentDate;
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

    calendar.init();

    const app = {
        currentDate: getToday(),
        getValidResource(resourceId) {
            const fallback = RESOURCES[0]?.id || "";
            if (!resourceId) return fallback;
            const normalized = typeof resourceId === "object"
                ? resourceId.id || resourceId.value || resourceId.key || resourceId.toString?.()
                : resourceId;
            if (!normalized) return fallback;
            const found = RESOURCES.find(r => r.id == normalized);
            return found ? found.id : fallback;
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
            const mapped = (INITIAL_EVENTS || []).map(evt => ({
                start: evt.start,
                end: evt.end,
                resource: this.getValidResource(evt.resource),
                id: evt.id,
                text: evt.text || "Görev"
            }));
            calendar.update({ events: mapped });
        },
        init() {
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
</script>
