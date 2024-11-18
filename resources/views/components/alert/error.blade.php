<div
    class="relative"
    x-data="{ open: $wire.entangle('hasError') }"
    x-cloak
    @page-error.window="$wire.set('hasError', true)"
>
    <div x-show="open"
         class="fixed inset-0 bg-gray-500 bg-opacity-50 z-[250]">
    </div>
    <div
        x-show="open"
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
                    class="h-20 aspect-[1/1] rounded-full bg-danger-500 flex items-center justify-center mb-5">
                    <i data-lucide="x" class="text-white h-36 aspect-[1/1]"></i>
                </div>
                <p class="text-danger-500 text-2xl font-bold">{{ $title }}</p>
                <p class="text-neutral-900 text-sm mb-5 text-center w-full">{{ $message }}</p>
                <button
                    x-on:click="$wire.set('hasError', false)"
                    class="rounded-md px-5 py-2.5 text-sm bg-danger-500 border border-danger-500 text-white cursor-pointer transition duration-300 ease-in-out hover:bg-danger-700 hover:border-danger-700 disabled:cursor-default disabled:bg-danger-700 disabled:border-danger-700">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
