document.addEventListener('alpine:init', () => {
    Alpine.store('gxuiDatepickerStore', {
        datepicker: null,
        initDatepicker(element, callback, config = {}) {
            if (element) {
                const baseConfig = {format: 'yyyy-mm-dd', autohide: true};
                const cfg = Object.assign({}, baseConfig, config);
                this.datepicker = new Datepicker(element, cfg);
                element.addEventListener('changeDate', (event) => {
                    const value = event.target.value;
                    callback(value);
                });
            }
            return this;
        },
        clear() {
            // this.datepicker.setDate(null);
            // console.log(this.datepicker);
            // this.datepicker.setDate('2024-03-10');
        }
    });
});
