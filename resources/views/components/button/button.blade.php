@if($loadingTarget !== '')
    <button {{ $attributes->merge(['class' => $baseClass]) }} wire:loading.attr="disabled">
        <div wire:target="{{ $loadingTarget }}" wire:loading.remove>
            {{ $slot }}
        </div>
        <div wire:target="{{ $loadingTarget }}" wire:loading class="w-full flex">
            <div class="w-full flex items-center justify-center">
                <svg class="w-4 h-4 animate-spinner me-1 {{ $spinnerClass }}" xmlns="http://www.w3.org/2000/svg"
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
                <span class="leading-[0]">Loading</span>
            </div>
        </div>

    </button>
@else
    <button {{ $attributes->merge(['class' => $baseClass]) }}>
        {{ $slot }}
    </button>
@endif
