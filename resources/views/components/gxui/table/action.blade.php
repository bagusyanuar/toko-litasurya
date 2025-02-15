<x-gxui.popper.popper>
    <div
        x-bind="gxuiPopperTrigger"
        class="cursor-pointer w-fit"
        wire:ignore
    >
        <i data-lucide="ellipsis-vertical"
           class="text-neutral-500 group-focus-within:text-neutral-900 h-3 aspect-[1/1]">
        </i>
    </div>
    <div
        x-bind="gxuiPopperContent"
        class="fixed z-50 text-sm w-[130px] text-gray-500 bg-white border border-gray-200 rounded-md shadow-sm dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800"
    >
        <div class="flex flex-col py-1 justify-start items-start">
            <template x-for="(entry, index) in $store.{{ $store }}.actions" :key="index">
                <div
                    class="flex items-center justify-start gap-2 w-full text-sm px-2 py-1.5 cursor-pointer hover:bg-neutral-50"
                    x-on:click="open = false; entry.dispatch(data.id)"
                >
                    <div wire:ignore>
                        <i :data-lucide="entry.icon" class="text-neutral-500 h-4 aspect-[1/1]"></i>
                    </div>
                    <span x-text="entry.label"></span>
                </div>
            </template>
        </div>
    </div>
</x-gxui.popper.popper>
