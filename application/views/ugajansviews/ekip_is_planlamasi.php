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
