<div
    x-show="{{ $show }}"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-300 transform"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="translate-x-full opacity-0"
    class="fixed top-5 right-5 bg-white h-16 w-72 flex rounded shadow-lg z-[200]"
    style="display: none;"
>
    <div
        class="w-1.5 h-full bg-green-500 rounded-tl rounded-bl"
    ></div>
    <div class="flex-1 flex p-2 gap-2">
        <div
            wire:ignore
        >
            <i data-lucide="circle-check" class="text-green-500 h-6 aspect-[1/1]"></i>
        </div>
        <div class="flex-1 flex flex-col">
            <span class="block font-semibold text-sm">Success</span>
            <span class="text-xs text-neutral-700">Berhasil Menyimpan Data...</span>
        </div>
        <div
            wire:ignore
            class="cursor-pointer text-neutral-500 hover:text-neutral-700 transition ease-out duration-300"
            x-on:click="{{ $handleClose }}"
        >
            <i data-lucide="x" class="h-4 aspect-[1/1]"></i>
        </div>
    </div>
</div>
