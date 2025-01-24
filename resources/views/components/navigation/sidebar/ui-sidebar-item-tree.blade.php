<div x-data="{open: '{{ $active }}' }">
    <div
        x-on:click="open = !open"
        class="w-full flex items-center gap-3 rounded-md px-4 py-3.5 cursor-pointer {{ $active ? 'text-brand-500 bg-brand-50' : 'text-neutral-500' }} hover:text-brand-500 hover:bg-brand-50 transition-all ease-in duration-200">
        <div class="w-full flex items-center gap-2">
            <i data-lucide="{{ $icon }}" class="h-6 aspect-[1/1]"></i>
            <span class="">
                {{ $title }}
            </span>
        </div>
        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>
    <div class="w-full mt-1 flex flex-col gap-1" x-show="open" x-collapse>
        {{ $slot }}
    </div>
</div>
