<div class="relative" x-cloak>
    <div
        x-show="$store.alertConfirmStore.open"
        class="fixed inset-0 bg-gray-500 bg-opacity-50 z-[250]">
    </div>
    <div
        x-show="$store.alertConfirmStore.open"
        x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="scale-75 opacity-0"
        x-transition:enter-end="scale-100 opacity-100"
        x-transition:leave="transition ease-in duration-100 transform"
        x-transition:leave-start="scale-100 opacity-100"
        x-transition:leave-end="scale-75 opacity-0"
        class="fixed inset-0 z-[251] flex items-center justify-center"
    >
        <div class="bg-white rounded shadow-lg w-[450px] max-h-full">
            <div class="w-full h-1 bg-brand-500 rounded-tl rounded-tr"></div>
            <div class="px-4 py-6 flex items-start gap-3">
                <div wire:ignore>
                    <i data-lucide="circle-alert" class="text-brand-500 aspect-[1/1]" style="width: 48px; height: 48px;"></i>
                </div>
                <div class="flex-grow-1">
                    <p class="text-neutral-500 text-xl font-bold" x-text="$store.alertConfirmStore.title"></p>
                    <p class="text-neutral-400 text-sm text-center w-full" x-text="$store.alertConfirmStore.message"></p>
                </div>
            </div>
            <div class="w-full border-t border-neutral-400 px-4 py-3.5">
                <div class="flex items-center justify-end w-full gap-2">
                    <button
                        x-bind:disabled="$store.alertConfirmStore.submitProcess"
                        x-on:click="$store.alertConfirmStore.close()"
                        class="rounded-md px-5 py-2 text-xs bg-white border border-brand-500 text-brand-500 cursor-pointer transition duration-300 ease-in-out hover:bg-neutral-50 hover:border-brand-500 disabled:cursor-default disabled:bg-neutral-50 disabled:border-brand-500"
                    >
                        <span x-text="$store.alertConfirmStore.buttonCancelText"></span>
                    </button>
                    <button
                        x-bind:disabled="$store.alertConfirmStore.submitProcess"
                        x-on:click="{{ $handleSubmit }}"
                        class="rounded-md px-5 py-2 text-xs bg-brand-500 border border-brand-500 text-white cursor-pointer transition duration-300 ease-in-out hover:bg-brand-700 hover:border-brand-700 disabled:cursor-default disabled:bg-brand-700 disabled:border-brand-700"
                    >
                        <div x-show="$store.alertConfirmStore.submitProcess" x-cloak class="w-full flex">
                            <x-loader.button-loader></x-loader.button-loader>
                        </div>
                        <span  x-show="!$store.alertConfirmStore.submitProcess" x-text="$store.alertConfirmStore.buttonSubmitText"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
