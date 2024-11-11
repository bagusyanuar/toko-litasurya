<div class="relative"
     x-data="{ {{ $modalID }}: false }"
>
    <!-- modal trigger -->
@if(isset($trigger))
    {{ $trigger }}
@endif
<!-- modal backdrop -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-50 z-[150]"
         x-cloak
         x-show="{{ $modalID }}"
         x-on:click="{{ $modalID }} = false"
    ></div>
    <!-- modal container -->
    <div
        class="fixed inset-0 z-[151] flex items-center justify-center"
        x-cloak
        x-show="{{ $modalID }}"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-y-[-100%] opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="translate-y-[-100%] opacity-0"
        x-on:click.self="{{ $modalID }} = false"
    >
        <div class="bg-white rounded shadow-lg w-full max-w-md max-h-full">
            <!-- modal header -->
            <div
                class="flex items-center justify-between px-4 py-3 border-b border-neutral-300 rounded-t">
                <span class="text-neutral-700 text-sm font-semibold">{{ $formTitle }}</span>
                <button
                    type="button"
                    x-on:click="{{ $modalID }} = false;"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-4 h-4 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                >
                    <svg class="w-2 h-2" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- modal body -->
            <div class="p-4">
                @if(isset($body))
                    {{ $body }}
                @endif
            </div>
        </div>
    </div>
</div>
