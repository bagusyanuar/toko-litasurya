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

            <!-- modal body -->
            <div class="p-4">
                @if(isset($body))
                    {{ $body }}
                @endif
            </div>
        </div>
    </div>
</div>
