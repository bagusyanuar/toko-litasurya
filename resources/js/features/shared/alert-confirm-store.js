document.addEventListener('alpine:init', () => {
    Alpine.store('alertConfirmStore', {
        open: false,
        title: 'Are you sure?',
        message: 'Do you want leave this page?',
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
        },
        setProcess(value = false){
            this.submitProcess = value;
        }
    })
});
