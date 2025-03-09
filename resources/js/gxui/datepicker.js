document.addEventListener('alpine:init', () => {
    Alpine.bind('gxuiDatepickerBind', () => ({
        'x-data': () => ({
            dateValue: '',
            datepicker: null,
            initDatepicker(config = {}) {
                const baseConfig = {format: 'yyyy-mm-dd', autohide: true};
                const cfg = Object.assign({}, baseConfig, config);
                this.$nextTick(() => {
                    this.datepicker = new Datepicker(this.$el, cfg);
                    const modelValue = this.$el._x_model?.get();
                    if (modelValue) {
                        this.$el.value = modelValue; // Set sebagai default value
                    }
                    this.$el.addEventListener('changeDate', (event) => {
                        this.dateValue = event.target.value;
                        this.$el._x_model.set(event.target.value);
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
    }))
});
