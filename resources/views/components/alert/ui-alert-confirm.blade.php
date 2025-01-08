<div class="relative">
    <div x-show="$store.alertConfirmStore.open"
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
        <div class="bg-white rounded shadow-lg w-[350px] max-h-full">
            <div class="px-4 py-6 flex flex-col justify-center items-center">
                <div
                    wire:ignore
                    class="h-20 aspect-[1/1] rounded-full bg-orange-400 flex items-center justify-center mb-5">
                    <i data-lucide="circle-help" class="text-white aspect-[1/1]" style="width: 48px; height: 48px;"></i>
                </div>
                <p class="text-orange-500 text-2xl font-bold" x-text="$store.alertConfirmStore.title"></p>
                <p class="text-neutral-900 text-sm mb-7 text-center w-full" x-text="$store.alertConfirmStore.message"></p>
                <div class="flex items-center justify-center w-full gap-3">
                    <button
                        x-bind:disabled="$store.alertConfirmStore.submitProcess"
                        x-on:click="$store.alertConfirmStore.close()"
                        class="w-full rounded-md px-5 py-2.5 text-sm bg-white border border-brand-500 text-brand-500 cursor-pointer transition duration-300 ease-in-out hover:bg-neutral-50 hover:border-brand-500 disabled:cursor-default disabled:bg-neutral-50 disabled:border-brand-500"
                    >
                        <span x-text="$store.alertConfirmStore.buttonCancelText"></span>
                    </button>
                    <button
                        x-bind:disabled="$store.alertConfirmStore.submitProcess"
                        x-on:click="{{ $handleSubmit }}"
                        class="w-full rounded-md px-5 py-2.5 text-sm bg-brand-500 border border-brand-500 text-white cursor-pointer transition duration-300 ease-in-out hover:bg-brand-700 hover:border-brand-700 disabled:cursor-default disabled:bg-brand-700 disabled:border-brand-700"
                    >
                        <span x-text="$store.alertConfirmStore.buttonSubmitText"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
