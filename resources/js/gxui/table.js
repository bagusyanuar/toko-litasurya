document.addEventListener('alpine:init', () => {
    Alpine.bind('gxuiCollapsibleRow', () => ({
        'x-data': () => ({
            isOpen: false,
            toggleIcon() {
                this.isOpen = !this.isOpen;
                this.initIcons();
            },
            initIcons() {
                setTimeout(() => { lucide.createIcons(); }, 0);
            }
        })
    }));
});
