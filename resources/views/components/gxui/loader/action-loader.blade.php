
<div>
    <div
        class="fixed inset-0 bg-gray-500 bg-opacity-50 z-[250]"
        x-cloak
        x-show="$store.gxuiActionLoader.show"
        x-on:click=""
    ></div>
    <div
        x-cloak
        x-show="$store.gxuiActionLoader.show"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-y-[-100%] opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="translate-y-[-100%] opacity-0"
        class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-[251] flex items-center justify-center"
    >
        <div class="bg-white rounded shadow-lg w-[30rem] max-h-full">
            <div class="h-24 w-full flex flex-col gap-1 items-center justify-center">
                <svg class="w-6 h-6 animate-spinner me-1 text-brand-500" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24">
                    <g>
                        <circle cx="3" cy="12" r="1.5" class="fill-current"/>
                        <circle cx="21" cy="12" r="1.5" class="fill-current"/>
                        <circle cx="12" cy="21" r="1.5" class="fill-current"/>
                        <circle cx="12" cy="3" r="1.5" class="fill-current"/>
                        <circle cx="5.64" cy="5.64" r="1.5" class="fill-current"/>
                        <circle cx="18.36" cy="18.36" r="1.5" class="fill-current"/>
                        <circle cx="5.64" cy="18.36" r="1.5" class="fill-current"/>
                        <circle cx="18.36" cy="5.64" r="1.5" class="fill-current"/>
                    </g>
                </svg>
                <p class="text-sm text-brand-500" x-text="$store.gxuiActionLoader.text"></p>
            </div>
        </div>
    </div>
</div>
