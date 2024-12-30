<div
    class="w-full flex justify-center"
    x-data="{
        initIcons() {
           setTimeout(() => { lucide.createIcons(); }, 0);
        }
    }"
    x-init="initIcons()"
>
    <x-table.components.ui-table-action>
        <div class="flex flex-col py-1 justify-start items-start">
            <div
                class="flex items-center justify-start gap-1 w-full text-xs px-2 py-1.5 cursor-pointer hover:bg-neutral-50"
                x-on:click="open = false;"
            >
                <div wire:ignore>
                    <i data-lucide="pencil" class="text-neutral-500 h-3 aspect-[1/1]"></i>
                </div>
                <span>Edit</span>
            </div>
            <div class="flex items-center justify-start gap-1 w-full text-xs px-2 py-1.5 cursor-pointer hover:bg-neutral-50">
                <div wire:ignore>
                    <i data-lucide="trash" class="text-neutral-500 h-3 aspect-[1/1]"></i>
                </div>
                <span>Delete</span>
            </div>
        </div>
    </x-table.components.ui-table-action>
</div>
