<div x-data="{ open: false, initIcon() {
    setTimeout(() => { lucide.createIcons(); }, 0);
} }"
     class="w-full relative flex items-center justify-center cursor-pointer"
     x-init="initIcon()"
     x-effect="initIcon()"
>
        <!-- dropdown trigger -->
        <div
            x-on:click="open = true"
            x-transition
            class="flex items-center justify-center text-neutral-700">
            <i data-lucide="ellipsis-vertical" class="h-3 aspect-[1/1]"></i>
        </div>

        <!-- dropdown content -->
        <div
            x-show="open"
            x-on:click.away="open = false"
            class="absolute right-0 top-0 translate-y-1/2 w-48 bg-white border border-gray-300 shadow-md rounded-md">
            <div class="w-full text-left px-4 py-2 hover:bg-gray-100">
                Edit
            </div>
            <div class="w-full text-left px-4 py-2 hover:bg-gray-100">
                Delete
            </div>
        </div>
</div>

{{--<div class="flex items-center justify-center gap-1"--}}
{{--     x-data="{--}}
{{--        initIcons() {--}}
{{--           setTimeout(() => { lucide.createIcons(); }, 0);--}}
{{--        }--}}
{{--    }"--}}
{{--     x-init="initIcons()"--}}
{{--     x-effect="initIcons()"--}}
{{-->--}}
{{--    <div--}}
{{--        class="w-6 aspect-[1/1] flex items-center justify-center bg-warning-400 text-neutral-900 hover:text-white hover:bg-warning-500 transition-all duration-200 ease-in rounded-[4px] cursor-pointer"--}}
{{--        wire:ignore--}}
{{--    >--}}
{{--        <i data-lucide="pencil" class="h-3 aspect-[1/1]"></i>--}}
{{--    </div>--}}
{{--    <div--}}
{{--        class="w-6 aspect-[1/1] flex items-center justify-center bg-danger-500 text-white hover:bg-danger-700 transition-all duration-200 ease-in rounded-[4px] cursor-pointer"--}}
{{--        wire:ignore--}}
{{--    >--}}
{{--        <i data-lucide="trash-2" class="h-3 aspect-[1/1]"></i>--}}
{{--    </div>--}}
{{--</div>--}}
