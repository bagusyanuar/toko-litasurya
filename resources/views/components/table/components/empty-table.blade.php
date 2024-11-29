<div
    x-data="{
        initIcons() {
           lucide.createIcons();
        }
    }"
    x-init="initIcons()"
    class="w-full flex flex-col justify-center items-center h-64"
    wire:ignore
>
    <div>
        <i data-lucide="hard-drive" class="text-neutral-300 h-[24px] aspect-[1/1]"></i>
    </div>
    <p class="text-xs italic text-neutral-300">There are no data to display</p>
</div>
