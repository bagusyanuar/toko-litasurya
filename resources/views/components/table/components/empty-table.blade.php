<div
    x-data="{
        initIcons() {
           setTimeout(() => { lucide.createIcons(); }, 0);
        }
    }"
    class="w-full flex flex-col justify-center items-center h-64"
    wire:ignore
>
    <i data-lucide="hard-drive" class="text-neutral-300 group-focus-within:text-neutral-900 h-12 aspect-[1/1]"></i>
    <p class="text-xs italic text-neutral-300">There are no data to display</p>
</div>
