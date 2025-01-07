<div
    class="w-full flex justify-center"
    x-bind="tableActionBind"
    x-ref="actionRef"
>
    <div
        x-ref="trigger"
        x-bind="triggerBind"
        class="cursor-pointer"
    >
        <i data-lucide="ellipsis-vertical"
           class="text-neutral-500 group-focus-within:text-neutral-900 h-3 aspect-[1/1]"></i>
    </div>
    <div
        x-bind="popOverBind"
        class="fixed z-50 text-sm text-gray-500 bg-white border border-gray-200 rounded-md shadow-sm dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800"
    >
        <div class="flex flex-col py-1 justify-start items-start">
            <div
                class="flex items-center justify-start gap-1 w-full text-xs px-2 py-1.5 cursor-pointer hover:bg-neutral-50"
                x-on:click="open = false; $store.formCategoryStore.getCategory('my-id');"
            >
                <div wire:ignore>
                    <i data-lucide="pencil" class="text-neutral-500 h-3 aspect-[1/1]"></i>
                </div>
                <span>Edit</span>
            </div>
            <div
                class="flex items-center justify-start gap-1 w-full text-xs px-2 py-1.5 cursor-pointer hover:bg-neutral-50"
                x-on:click="open = false; $store.formCategoryStore.delete();"
            >
                <div wire:ignore>
                    <i data-lucide="trash" class="text-neutral-500 h-3 aspect-[1/1]"></i>
                </div>
                <span>Delete</span>
            </div>
        </div>
    </div>
</div>
