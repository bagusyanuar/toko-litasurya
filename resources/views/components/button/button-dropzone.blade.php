<div
    x-data="{ loading: false }"
    x-on:{{ $loadingKey  }}-start.window="loading = true;"
    x-on:{{ $loadingKey }}-end.window="loading = false;"
>
    <button
        x-on:click="{{ $dropEvent }}"
        :disabled="loading"
        class="flex gap-1 text-[0.675rem] px-[1.25rem] py-[0.65rem] rounded-[4px] bg-brand-500 border border-brand-500 text-white cursor-pointer transition duration-300 ease-in-out hover:bg-brand-700 hover:border-brand-700 disabled:cursor-default disabled:bg-brand-700 disabled:border-brand-700"
    >
        <template x-if="!loading">
            {{ $slot }}
        </template>
        <template x-if="loading">
            <div class="w-full flex items-center justify-center">
                <svg class="w-4 h-4 animate-spinner me-1 text-inherit" xmlns="http://www.w3.org/2000/svg"
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
                <span>Loading</span>
            </div>
        </template>
    </button>
</div>
