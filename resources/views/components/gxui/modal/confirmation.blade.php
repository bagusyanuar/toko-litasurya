@props([
'store',
'dispatcher',
'onCloseDispatcher' => '',
'title' => "Are you sure?",
'message' => "Are you sure you want to delete this item? This action cannot be undone"
])
<div>
    <div
        class="fixed inset-0 bg-gray-500 bg-opacity-50 z-[250]"
        x-cloak
        x-show="$store.gxuiModalConfirmationStore.show"
        x-on:click="$store.gxuiModalConfirmationStore.closeConfirmation()"
    ></div>
    <div
        x-cloak
        x-show="$store.gxuiModalConfirmationStore.show"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-y-[-100%] opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="translate-y-[-100%] opacity-0"
        class="fixed top-8 left-1/2 transform -translate-x-1/2 z-[251] flex items-center justify-center"
    >
        <div class="bg-white rounded shadow-lg w-[20rem] max-h-full">
            <div class="px-6 py-4">
                <div class="w-full flex items-start gap-3">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <div
                            class="w-fit"
                            wire:ignore
                        >
                            <i data-lucide="trash"
                               class="text-red-500 group-focus-within:text-neutral-900 h-6 aspect-[1/1]">
                            </i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-neutral-900 text-sm font-bold mb-0">{{ $title }}</p>
                        <p class="text-xs text-neutral-700">{{ $message }}</p>
                    </div>
                </div>
            </div>
            <div class="w-full border-t px-6 py-4 flex justify-end items-center gap-1">
                <x-gxui.button.button
                    wire:ignore
                    x-on:click="{{ $onCloseDispatcher }}"
                    class="!px-6 bg-white !border-transparent !text-red-500 hover:!text-red-600 hover:!bg-red-100"
                >
                    <div class="w-full flex justify-center items-center gap-1 text-xs">
                        <span>Cancel</span>
                    </div>
                </x-gxui.button.button>
                <x-gxui.button.button
                    wire:ignore
                    x-on:click="{{ $dispatcher }}"
                    class="!px-6 bg-red-500 hover:!bg-red-600 !border-red-500 hover:!border-red-600"
                >
                    <div class="w-full flex justify-center items-center gap-1 text-xs">
                        <span>Submit</span>
                    </div>
                </x-gxui.button.button>
            </div>
        </div>
    </div>
</div>
