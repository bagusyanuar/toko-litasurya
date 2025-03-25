document.addEventListener('alpine:init', () => {
    Alpine.store('gxuiActionLoader', {
        show: false,
        text: 'Loading...',
        start(text = 'Loading...') {
            this.text = text;
            this.show = true;
        },
        end() {
            this.show = false;
            this.text = 'Loading...';
        }
    })
});
