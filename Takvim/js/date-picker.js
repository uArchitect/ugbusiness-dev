/**
 * Modern Date Picker Component
 * Production-ready, accessible, and scalable date input component
 * 
 * @class DatePicker
 * @version 1.0.0
 */

class DatePicker {
    constructor(containerId, options = {}) {
        this.container = document.getElementById(containerId);
        if (!this.container) {
            throw new Error(`Container with id "${containerId}" not found`);
        }

        this.config = this._mergeConfig(options);
        this.state = {
            selectedDate: null,
            currentView: 'calendar', // 'calendar' | 'input'
            isOpen: false,
            viewDate: new Date()
        };

        this.validator = new DateValidator(this.config);
        this.formatter = new DateFormatter(this.config.locale);
        this.keyboardHandler = new KeyboardHandler(this);
        this.eventEmitter = new EventEmitter();

        this._init();
    }

    _mergeConfig(options) {
        const defaults = {
            locale: 'tr-TR',
            format: 'dd.MM.yyyy',
            minDate: null,
            maxDate: null,
            placeholder: 'Tarih seçiniz',
            showToday: true,
            showClear: true,
            allowKeyboardInput: true,
            autoClose: true,
            firstDayOfWeek: 1, // Monday
            disabledDates: [],
            disabledDays: [],
            theme: 'default',
            position: 'auto',
            zIndex: 1000
        };
        return { ...defaults, ...options };
    }

    _init() {
        this._createHTML();
        this._attachEvents();
        this._renderCalendar();
        this._setupAccessibility();
    }

    _createHTML() {
        this.container.innerHTML = `
            <div class="pt-date-picker-wrapper">
                <div class="pt-date-input-container">
                    <input 
                        type="text" 
                        class="pt-date-input" 
                        id="${this.config.id || 'pt-date-input'}"
                        placeholder="${this.config.placeholder}"
                        readonly="${!this.config.allowKeyboardInput}"
                        aria-label="Tarih seçici"
                        aria-haspopup="true"
                        aria-expanded="false"
                    />
                    <button 
                        class="pt-date-trigger" 
                        type="button"
                        aria-label="Takvimi aç"
                        tabindex="0"
                    >
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </button>
                </div>
                <div class="pt-date-picker-dropdown" role="dialog" aria-modal="true" aria-label="Tarih seçici">
                    <div class="pt-date-picker-header">
                        <button class="pt-nav-btn-prev" type="button" aria-label="Önceki ay">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </button>
                        <div class="pt-date-picker-month-year">
                            <button class="pt-month-year-btn" type="button" aria-label="Ay ve yıl seç">
                                <span class="pt-month-display"></span>
                                <span class="pt-year-display"></span>
                            </button>
                        </div>
                        <button class="pt-nav-btn-next" type="button" aria-label="Sonraki ay">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>
                    </div>
                    <div class="pt-date-picker-weekdays"></div>
                    <div class="pt-date-picker-days" role="grid" aria-label="Takvim"></div>
                    <div class="pt-date-picker-footer">
                        ${this.config.showToday ? '<button class="pt-today-btn" type="button">Bugün</button>' : ''}
                        ${this.config.showClear ? '<button class="pt-clear-btn" type="button">Temizle</button>' : ''}
                    </div>
                </div>
            </div>
        `;

        this.elements = {
            input: this.container.querySelector('.pt-date-input'),
            trigger: this.container.querySelector('.pt-date-trigger'),
            dropdown: this.container.querySelector('.pt-date-picker-dropdown'),
            prevBtn: this.container.querySelector('.pt-nav-btn-prev'),
            nextBtn: this.container.querySelector('.pt-nav-btn-next'),
            monthYearBtn: this.container.querySelector('.pt-month-year-btn'),
            monthDisplay: this.container.querySelector('.pt-month-display'),
            yearDisplay: this.container.querySelector('.pt-year-display'),
            weekdays: this.container.querySelector('.pt-date-picker-weekdays'),
            days: this.container.querySelector('.pt-date-picker-days'),
            todayBtn: this.container.querySelector('.pt-today-btn'),
            clearBtn: this.container.querySelector('.pt-clear-btn')
        };
    }

    _attachEvents() {
        // Input events
        this.elements.input.addEventListener('click', () => this.open());
        this.elements.input.addEventListener('focus', () => this.open());
        this.elements.input.addEventListener('blur', (e) => {
            if (!this.dropdown.contains(e.relatedTarget)) {
                this.close();
            }
        });
        this.elements.input.addEventListener('keydown', (e) => this.keyboardHandler.handleInputKeydown(e));

        // Trigger button
        this.elements.trigger.addEventListener('click', () => this.toggle());

        // Navigation
        this.elements.prevBtn.addEventListener('click', () => this._navigateMonth(-1));
        this.elements.nextBtn.addEventListener('click', () => this._navigateMonth(1));
        this.elements.monthYearBtn.addEventListener('click', () => this._toggleMonthYearView());

        // Footer buttons
        if (this.elements.todayBtn) {
            this.elements.todayBtn.addEventListener('click', () => this.selectToday());
        }
        if (this.elements.clearBtn) {
            this.elements.clearBtn.addEventListener('click', () => this.clear());
        }

        // Outside click
        document.addEventListener('click', (e) => {
            if (!this.container.contains(e.target) && this.state.isOpen) {
                this.close();
            }
        });

        // Keyboard navigation
        this.elements.days.addEventListener('keydown', (e) => this.keyboardHandler.handleCalendarKeydown(e));
    }

    _setupAccessibility() {
        // ARIA attributes
        this.elements.input.setAttribute('aria-expanded', 'false');
        this.elements.input.setAttribute('autocomplete', 'off');
        
        // Focus management
        this.elements.days.setAttribute('tabindex', '0');
    }

    _renderCalendar() {
        this._renderWeekdays();
        this._renderDays();
        this._updateMonthYearDisplay();
    }

    _renderWeekdays() {
        const weekdays = this.formatter.getWeekdayNames('short');
        const firstDay = this.config.firstDayOfWeek;
        const orderedWeekdays = [...weekdays.slice(firstDay), ...weekdays.slice(0, firstDay)];

        this.elements.weekdays.innerHTML = orderedWeekdays
            .map(day => `<div class="pt-weekday" role="columnheader">${day}</div>`)
            .join('');
    }

    _renderDays() {
        const year = this.state.viewDate.getFullYear();
        const month = this.state.viewDate.getMonth();
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const startDate = new Date(firstDay);
        
        // Adjust to first day of week
        const dayOfWeek = (firstDay.getDay() - this.config.firstDayOfWeek + 7) % 7;
        startDate.setDate(startDate.getDate() - dayOfWeek);

        const days = [];
        const currentDate = new Date(startDate);

        // Generate 42 days (6 weeks)
        for (let i = 0; i < 42; i++) {
            const date = new Date(currentDate);
            const isCurrentMonth = date.getMonth() === month;
            const isToday = this._isToday(date);
            const isSelected = this.state.selectedDate && this._isSameDay(date, this.state.selectedDate);
            const isDisabled = this._isDateDisabled(date);

            days.push({
                date,
                isCurrentMonth,
                isToday,
                isSelected,
                isDisabled,
                day: date.getDate()
            });

            currentDate.setDate(currentDate.getDate() + 1);
        }

        this.elements.days.innerHTML = days
            .map((day, index) => {
                const classes = [
                    'pt-day',
                    !day.isCurrentMonth && 'pt-day-other-month',
                    day.isToday && 'pt-day-today',
                    day.isSelected && 'pt-day-selected',
                    day.isDisabled && 'pt-day-disabled'
                ].filter(Boolean).join(' ');

                return `
                    <button 
                        class="${classes}"
                        type="button"
                        data-date="${day.date.toISOString()}"
                        ${day.isDisabled ? 'disabled' : ''}
                        tabindex="${day.isSelected ? '0' : '-1'}"
                        aria-label="${this.formatter.formatDate(day.date, 'full')}"
                        role="gridcell"
                    >
                        ${day.day}
                    </button>
                `;
            })
            .join('');

        // Attach click handlers
        this.elements.days.querySelectorAll('.pt-day:not(.pt-day-disabled)').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const date = new Date(e.target.dataset.date);
                this.selectDate(date);
            });
        });
    }

    _updateMonthYearDisplay() {
        const monthName = this.formatter.getMonthName(this.state.viewDate.getMonth(), 'long');
        const year = this.state.viewDate.getFullYear();
        
        this.elements.monthDisplay.textContent = monthName;
        this.elements.yearDisplay.textContent = year;
    }

    _navigateMonth(direction) {
        const newDate = new Date(this.state.viewDate);
        newDate.setMonth(newDate.getMonth() + direction);
        this.state.viewDate = newDate;
        this._renderCalendar();
    }

    _isToday(date) {
        return this._isSameDay(date, new Date());
    }

    _isSameDay(date1, date2) {
        return date1.getFullYear() === date2.getFullYear() &&
               date1.getMonth() === date2.getMonth() &&
               date1.getDate() === date2.getDate();
    }

    _isDateDisabled(date) {
        if (this.config.minDate && date < this.config.minDate) return true;
        if (this.config.maxDate && date > this.config.maxDate) return true;
        if (this.config.disabledDates.some(d => this._isSameDay(date, d))) return true;
        if (this.config.disabledDays.includes(date.getDay())) return true;
        return false;
    }

    _toggleMonthYearView() {
        // Future: Implement month/year picker view
        console.log('Month/Year view - to be implemented');
    }

    // Public API
    open() {
        if (this.state.isOpen) return;
        this.state.isOpen = true;
        this.elements.dropdown.classList.add('pt-open');
        this.elements.input.setAttribute('aria-expanded', 'true');
        this._updatePosition();
        this.eventEmitter.emit('open');
    }

    close() {
        if (!this.state.isOpen) return;
        this.state.isOpen = false;
        this.elements.dropdown.classList.remove('pt-open');
        this.elements.input.setAttribute('aria-expanded', 'false');
        this.eventEmitter.emit('close');
    }

    toggle() {
        this.state.isOpen ? this.close() : this.open();
    }

    selectDate(date) {
        if (!this.validator.isValid(date)) {
            this.eventEmitter.emit('error', { message: 'Geçersiz tarih' });
            return;
        }

        this.state.selectedDate = new Date(date);
        this.elements.input.value = this.formatter.formatDate(this.state.selectedDate);
        this._renderCalendar();
        
        if (this.config.autoClose) {
            this.close();
        }

        this.eventEmitter.emit('change', this.state.selectedDate);
    }

    selectToday() {
        this.selectDate(new Date());
    }

    clear() {
        this.state.selectedDate = null;
        this.elements.input.value = '';
        this._renderCalendar();
        this.eventEmitter.emit('change', null);
    }

    getDate() {
        return this.state.selectedDate ? new Date(this.state.selectedDate) : null;
    }

    setDate(date) {
        if (date && this.validator.isValid(date)) {
            this.selectDate(date);
        }
    }

    _updatePosition() {
        // Auto-position dropdown
        const rect = this.elements.input.getBoundingClientRect();
        const dropdown = this.elements.dropdown;
        const spaceBelow = window.innerHeight - rect.bottom;
        const spaceAbove = rect.top;

        if (spaceBelow < 300 && spaceAbove > spaceBelow) {
            dropdown.classList.add('pt-position-top');
        } else {
            dropdown.classList.remove('pt-position-top');
        }
    }

    // Event handling
    on(event, callback) {
        this.eventEmitter.on(event, callback);
    }

    off(event, callback) {
        this.eventEmitter.off(event, callback);
    }

    destroy() {
        this.eventEmitter.removeAllListeners();
        this.container.innerHTML = '';
    }
}

/**
 * Date Validator
 */
class DateValidator {
    constructor(config) {
        this.config = config;
    }

    isValid(date) {
        if (!(date instanceof Date) || isNaN(date.getTime())) {
            return false;
        }

        if (this.config.minDate && date < this.config.minDate) {
            return false;
        }

        if (this.config.maxDate && date > this.config.maxDate) {
            return false;
        }

        if (this.config.disabledDates.some(d => this._isSameDay(date, d))) {
            return false;
        }

        if (this.config.disabledDays.includes(date.getDay())) {
            return false;
        }

        return true;
    }

    _isSameDay(date1, date2) {
        return date1.getFullYear() === date2.getFullYear() &&
               date1.getMonth() === date2.getMonth() &&
               date1.getDate() === date2.getDate();
    }
}

/**
 * Date Formatter
 */
class DateFormatter {
    constructor(locale = 'tr-TR') {
        this.locale = locale;
        this.monthNames = {
            long: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 
                   'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
            short: ['Oca', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 
                    'Tem', 'Ağu', 'Eyl', 'Eki', 'Kas', 'Ara']
        };
        this.weekdayNames = {
            long: ['Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi'],
            short: ['Paz', 'Pzt', 'Sal', 'Çar', 'Per', 'Cum', 'Cmt']
        };
    }

    formatDate(date, format = 'dd.MM.yyyy') {
        if (!(date instanceof Date) || isNaN(date.getTime())) {
            return '';
        }

        if (format === 'full') {
            return `${this.weekdayNames.long[date.getDay()]}, ${date.getDate()} ${this.monthNames.long[date.getMonth()]} ${date.getFullYear()}`;
        }

        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();

        return format
            .replace('dd', day)
            .replace('MM', month)
            .replace('yyyy', year);
    }

    getMonthName(month, type = 'long') {
        return this.monthNames[type][month];
    }

    getWeekdayNames(type = 'short') {
        return this.weekdayNames[type];
    }
}

/**
 * Keyboard Handler
 */
class KeyboardHandler {
    constructor(datePicker) {
        this.datePicker = datePicker;
    }

    handleInputKeydown(e) {
        switch (e.key) {
            case 'Enter':
            case ' ':
                e.preventDefault();
                this.datePicker.open();
                break;
            case 'Escape':
                this.datePicker.close();
                break;
        }
    }

    handleCalendarKeydown(e) {
        const days = Array.from(this.datePicker.elements.days.querySelectorAll('.pt-day:not(.pt-day-disabled)'));
        const currentIndex = days.findIndex(day => day === document.activeElement);
        let newIndex = currentIndex;

        switch (e.key) {
            case 'ArrowRight':
                e.preventDefault();
                newIndex = (currentIndex + 1) % days.length;
                break;
            case 'ArrowLeft':
                e.preventDefault();
                newIndex = (currentIndex - 1 + days.length) % days.length;
                break;
            case 'ArrowDown':
                e.preventDefault();
                newIndex = Math.min(currentIndex + 7, days.length - 1);
                break;
            case 'ArrowUp':
                e.preventDefault();
                newIndex = Math.max(currentIndex - 7, 0);
                break;
            case 'Home':
                e.preventDefault();
                newIndex = 0;
                break;
            case 'End':
                e.preventDefault();
                newIndex = days.length - 1;
                break;
            case 'Enter':
            case ' ':
                e.preventDefault();
                if (document.activeElement.classList.contains('pt-day')) {
                    document.activeElement.click();
                }
                return;
            case 'Escape':
                e.preventDefault();
                this.datePicker.close();
                this.datePicker.elements.input.focus();
                return;
        }

        if (newIndex !== currentIndex && days[newIndex]) {
            days[newIndex].focus();
        }
    }
}

/**
 * Simple Event Emitter
 */
class EventEmitter {
    constructor() {
        this.events = {};
    }

    on(event, callback) {
        if (!this.events[event]) {
            this.events[event] = [];
        }
        this.events[event].push(callback);
    }

    off(event, callback) {
        if (this.events[event]) {
            this.events[event] = this.events[event].filter(cb => cb !== callback);
        }
    }

    emit(event, data) {
        if (this.events[event]) {
            this.events[event].forEach(callback => callback(data));
        }
    }

    removeAllListeners() {
        this.events = {};
    }
}

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { DatePicker, DateValidator, DateFormatter };
}

