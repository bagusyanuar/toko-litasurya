import "flatpickr/dist/flatpickr.min.css";
import monthSelectPlugin from "flatpickr/dist/plugins/monthSelect"
document.addEventListener('alpine:init', () => {
    Alpine.bind('gxuiDatepickerBind', () => ({
        'x-data': () => ({
            dateValue: '',
            datepicker: null,
            dispatcher: '',
            storeName: '',
            initDatepicker(config = {}) {
                const baseConfig = {
                    format: 'yyyy-mm-dd',
                    autohide: true,
                    autoSelectToday: true
                };
                const cfg = Object.assign({}, baseConfig, config);
                this.$nextTick(() => {
                    this.storeName = this.$el.getAttribute("store-name") || '';
                    this.dispatcher = this.$el.getAttribute("dispatcher") || '';
                    this.datepicker = new Datepicker(this.$el, cfg);
                    const modelValue = this.$el._x_model?.get();
                    if (modelValue) {
                        this.$el.value = modelValue; // Set sebagai default value
                    }
                    this.$el.addEventListener('changeDate', (event) => {
                        this.dateValue = event.target.value;
                        this.$el._x_model.set(event.target.value);
                        let store = Alpine.store(this.storeName);
                        if (store && typeof store[this.dispatcher] === "function") {
                            store[this.dispatcher]();
                        }
                    });

                    this.$watch(() => {
                        return this.$el._x_model.get();
                    }, (val) => {
                        this.$el._x_model.set(val);
                        if (val === '') {
                            this.datepicker.setDate(null);
                        }
                    });
                })
            },
        }),
    }));

    Alpine.bind('gxuiYearPickerBind', () => ({
        'x-data': () => ({
            yearPicker: null,
            initYearPicker(config = {}){
                const baseConfig = {
                    dateFormat: "Y", // untuk value yang disimpan
                    altInput: true,
                    altFormat: "Y", // untuk tampilan yang ditampilkan
                    allowInput: true,
                    onReady: function(selectedDates, dateStr, instance) {
                        const monthElement = instance?.monthElements?.[0] || instance?.calendarContainer?.querySelector('.flatpickr-monthDropdown-months');
                        if (monthElement) {
                            monthElement.style.display = "none"; // Hide bulan
                        }

                        const yearElement = instance?.currentYearElement || instance?.calendarContainer?.querySelector('.flatpickr-current-year');
                        if (yearElement) {
                            yearElement.removeAttribute("disabled");
                            yearElement.focus();
                        }
                    },
                    onChange: function(selectedDates, dateStr, instance) {
                        instance.close();
                    },
                };
                const cfg = Object.assign({}, baseConfig, config);
                this.$nextTick(() => {
                    this.datepicker = flatpickr(this.$el, cfg);
                });
            },
        })
    }));
});
