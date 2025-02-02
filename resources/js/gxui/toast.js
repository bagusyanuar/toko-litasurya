document.addEventListener('alpine:init', () => {
    Alpine.store('gxuiToastStore', {
        open: false,
        timeToClose: 1000,
        type: 'success',
        message: '',
        failed(message = 'internal server error') {
            this.open = true;
            this.type = 'error';
            this.message = message;
        },
        success(message = 'success') {
            this.open = true;
            this.type = 'success';
            this.message = message;
        },
        close() {
            this.open = false;
        }
    })
});
