document.addEventListener('alpine:init', () => {
    Alpine.store('categoryPageStore', {
        notification: false,
        type: 'success',
        setNotification(value) {
            this.notification = value;
        },
        setErrorNotification() {
            this.notification = true;
            this.type = 'error';
        }
    })
});
