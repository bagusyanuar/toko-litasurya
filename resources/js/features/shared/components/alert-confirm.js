document.addEventListener('alpine:init', () => {
    Alpine.store('uiAlertConfirmStore', {
        open: false,
        title: 'Title',
        message: 'Message',
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
