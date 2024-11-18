<div class="flex items-center justify-center gap-1"
     x-data="{
        initIcons() {
           setTimeout(() => { lucide.createIcons(); }, 0);
        }
    }"
     x-init="initIcons()"
     x-effect="initIcons()"
>
    <div
        class="w-6 aspect-[1/1] flex items-center justify-center bg-warning-400 text-neutral-900 hover:text-white hover:bg-warning-500 transition-all duration-200 ease-in rounded-[4px] cursor-pointer"
        wire:ignore
    >
        <i data-lucide="pencil" class="h-3 aspect-[1/1]"></i>
    </div>
    <div
        class="w-6 aspect-[1/1] flex items-center justify-center bg-danger-500 text-white hover:bg-danger-700 transition-all duration-200 ease-in rounded-[4px] cursor-pointer"
        wire:ignore
    >
        <i data-lucide="trash-2" class="h-3 aspect-[1/1]"></i>
    </div>
</div>
