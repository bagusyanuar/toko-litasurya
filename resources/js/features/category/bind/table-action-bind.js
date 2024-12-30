document.addEventListener('alpine:init', () => {
    Alpine.bind('tableActionBind', () => ({
        'x-data': () => ({
            open: false,
            triggerRect: {},
            initIcons() {
                setTimeout(() => { lucide.createIcons(); }, 0);
            },
            togglePopOver() {
                this.open = !this.open;
            },
        }),
        'x-init': 'initIcons();',
    }));

    Alpine.bind('triggerBind', () => ({
        'x-data': () => ({}),
        '@click': 'togglePopOver(); triggerRect = $el.getBoundingClientRect();',
    }));

    Alpine.bind('popOverBind', () => ({
        'x-show': 'open',
        'x-on:click.away': 'open = false;',
        'x-transition': true,
        'x-cloak': true,
        ':style': `
            {
                top: triggerRect.bottom + 10 + window.scrollY + 'px',
                right: window.innerWidth - triggerRect.right + 'px'
            }
        `,
    }));
});
