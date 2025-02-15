document.addEventListener('alpine:init', () => {
    Alpine.bind('gxuiPopper', () => ({
        'x-data': () => ({
            open: false,
            triggerRect: {},
            initIcons() {
                setTimeout(() => {
                    lucide.createIcons();
                }, 0);
            },
            togglePopOver() {
                this.open = !this.open;
            },
        }),
        'x-init': `initIcons();`,
    }));

    Alpine.bind('gxuiPopperTrigger', () => ({
        'x-data': () => ({}),
        '@click': `togglePopOver(); triggerRect = $el.getBoundingClientRect();`,
    }));

    Alpine.bind('gxuiPopperContent', () => ({
        'x-show': `open`,
        'x-on:click.away': `open = false;`,
        'x-transition': true,
        'x-cloak': true,
        ':style': `
            {
                top: triggerRect.bottom + 10 +'px',
                // right: window.innerWidth - triggerRect.right - triggerRect.width + 'px'
                right: window.innerWidth - triggerRect.right + 'px'
            }
        `,
    }));
});
