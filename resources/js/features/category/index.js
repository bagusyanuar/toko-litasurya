document.addEventListener('alpine:init', () => {
    Alpine.store('categoryIndex', {
        notification: false,
        setNotification(value) {
            this.notification = value;
        }
    })
});
