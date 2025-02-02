<div class="w-full h-full flex">
    <div class="w-1.5 h-full bg-red-500 rounded-tl rounded-bl"></div>
    <div class="flex-1 flex p-2 gap-3">
        <div class="w-8" wire:ignore>
            <i data-lucide="circle-x" class="text-red-500 h-8 w-8"></i>
        </div>
        <div class="flex-1 flex flex-col">
            <span class="block font-semibold text-neutral-700 leading-none mb-1">Error</span>
            <span
                x-text="$store.gxuiToastStore.message"
                class="block text-sm text-neutral-500 leading-none"
                style="overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2;"
            ></span>
        </div>
        <div
            wire:ignore
            class="w-3 cursor-pointer text-neutral-500 hover:text-neutral-700 transition ease-out duration-300"
            x-on:click="$store.gxuiToastStore.close();"
        >
            <i data-lucide="x" class="h-3 w-3"></i>
        </div>
    </div>
</div>
