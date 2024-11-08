<div x-data="{open: '{{ $active }}' }">
    <div
        x-on:click="open = !open"
        class="w-full rounded-md flex items-center justify-between gap-2 text-xs font-light {{ $active ? 'text-white bg-brand-500' : 'text-neutral-400' }} p-3 cursor-pointer transition-all ease-in duration-200 hover:bg-brand-500 hover:text-white">
        <div class="w-full flex items-center gap-2">
            <i data-lucide="{{ $icon }}" class="h-4 aspect-[1/1]"></i>
            <span class="w-full flex items-center">
                {{ $title }}
            </span>
        </div>
        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>
    <div class="w-full mt-1" x-show="open" x-collapse>
        {{ $slot }}
    </div>
</div>

{{--<div x-data="{open: false}" >--}}
{{--    <div class="item-tree" @click="open = !open">--}}
{{--        <div class="flex items-center gap-[0.5rem]">--}}
{{--            <span class="material-symbols-outlined">{{ $materialIcon }}</span>--}}
{{--            <span>{{ $title }}</span>--}}
{{--        </div>--}}
{{--        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">--}}
{{--            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />--}}
{{--        </svg>--}}
{{--    </div>--}}
{{--    <div--}}
{{--        x-show="open"--}}
{{--        x-cloak--}}
{{--        x-transition:enter="transition ease-in-out duration-180"--}}
{{--        x-transition:enter-start="opacity-0 max-h-0"--}}
{{--        x-transition:enter-end="opacity-100 max-h-screen"--}}
{{--        x-transition:leave="transition ease-in duration-180"--}}
{{--        x-transition:leave-start="opacity-100 max-h-screen"--}}
{{--        x-transition:leave-end="opacity-0 max-h-0"--}}
{{--        class="overflow-hidden transition-all">--}}
{{--        {{ $slot }}--}}
{{--    </div>--}}
{{--</div>--}}
