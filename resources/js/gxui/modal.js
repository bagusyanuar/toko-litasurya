document.addEventListener('alpine:init', () => {
    Alpine.store('gxuiModalConfirmationStore', {
        element: null,
        show: false,
        showConfirmation() {
            this.show = true;
        },
        closeConfirmation() {
            this.show = false;
        }
    });
    Alpine.bind('gxuiModalConfirmation', () => ({
        'x-data': () => ({
            element: null,
            show: false,
            storeName: '',
            dispatcher: '',
            onCloseDispatcher: '',
            initModal() {
                this.$nextTick(() => {
                    this.element = $(this.$el);
                    this.storeName = this.$el.getAttribute("store") || '';
                    this.dispatcher = this.$el.getAttribute("dispatcher") || '';
                    this.onCloseDispatcher = this.$el.getAttribute("on-close-dispatcher") || '';
                });
            },
            cancel() {
                this.show = false;
            },
            showConfirmation() {
                this.show = true;
            },
            closeConfirmation() {
                this.show = false;
                if (this.storeName && this.onCloseDispatcher !== '') {
                    let store = Alpine.store(this.storeName);
                    if (store && typeof store[this.onCloseDispatcher] === "function") {
                        store[this.onCloseDispatcher]();
                    }
                }
            },
            onSubmit() {
                if (this.storeName && this.dispatcher) {
                    let store = Alpine.store(this.storeName);
                    if (store && typeof store[this.dispatcher] === "function") {
                        store[this.dispatcher]();
                    }
                }
            }
        }),
        'x-init': "initModal()"
    }))
});
