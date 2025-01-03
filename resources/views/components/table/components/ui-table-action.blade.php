<div
    x-data="{
        open: false,
        buttonRect: {},
        popEl: null,
        popWidth: 0,
        updatePosition() {
            this.buttonRect = this.$refs.button.getBoundingClientRect();
        },
        initIcons() {
           setTimeout(() => { lucide.createIcons(); }, 0);
        },
        togglePopover() {
            this.open = !this.open;
        },
    }"
    x-init="initIcons(); buttonRect = $refs.button.getBoundingClientRect(); "
    x-on:resize.window="updatePosition"
    class="w-fit"
>
    <div
        x-ref="button"
        x-on:click="togglePopover(); buttonRect = $refs.button.getBoundingClientRect();"
        class="cursor-pointer"
    >
        <i data-lucide="ellipsis-vertical"
           class="text-neutral-500 group-focus-within:text-neutral-900 h-3 aspect-[1/1]"></i>
    </div>
    <div
        x-ref="popover"
        x-show="open"
        x-on:click.away="open = false"
        x-transition
        x-cloak
        class="fixed z-50 text-sm text-gray-500 bg-white border border-gray-200 rounded-md shadow-sm dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800"
        x-bind:style="{
            top: buttonRect.bottom + 10 + window.scrollY + 'px',
            right: window.innerWidth - buttonRect.right + 'px'
        }"
    >
        {{ $slot }}
    </div>
</div>
