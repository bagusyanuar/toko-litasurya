document.addEventListener('alpine:init', () => {
    Alpine.store('alertConfirmStore', {
        open: false,
        title: 'Confirmation',
        message: '',
        buttonCancelText: 'Cancel',
        buttonSubmitText: 'Submit',
        submitProcess: false,
        showConfirm(title = 'Confirmation', message = 'Are you sure?') {
            this.title = title;
            this.message = message;
            this.open = true;
        },
        close() {
            this.open = false;
        }
    })
});
