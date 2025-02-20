<div>
    <div
        class="fixed inset-0 bg-gray-500 bg-opacity-50 z-[250]"
        x-cloak
        x-show="{{ $show }}"
        x-on:click=""
    ></div>
    <div
        x-cloak
        x-show="{{ $show }}"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-y-[-100%] opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="translate-y-[-100%] opacity-0"
        class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-[251] flex items-center justify-center w-full h-[100dvh]"
    >
        <div class="bg-white rounded flex flex-col shadow-lg max-h-full" style="width: {{ $width }};">
            {{ $slot }}
        </div>
    </div>
</div>
