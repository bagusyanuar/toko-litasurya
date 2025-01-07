document.addEventListener('alpine:init', () => {
    lucide.createIcons();
    Alpine.store('alertStore', {
        open: false,
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
