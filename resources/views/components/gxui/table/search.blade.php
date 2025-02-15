<div
    class="relative group {{ $parentClassName }}"
    x-data="{
        debounce: null,
        onInput(event) {
            let store = Alpine.store('{{ $store }}');
            clearTimeout(this.debounce);
            this.debounce = setTimeout(() => {
                store.page = 1;
                store['{{ $storeKey }}'] = event.target.value;
                store['{{ $dispatcher }}']();
            }, {{ $debounceTime }});
        }
    }"
>
    <div wire:ignore class="h-full flex items-center px-[0.5rem] absolute inset-y-0 start-0">
        <i data-lucide="search" class="text-neutral-500 group-focus-within:text-neutral-900 h-3 aspect-[1/1]"></i>
    </div>
    <input
        {{ $attributes->merge(['class' => 'w-full text-sm ps-[2.05rem] pe-[0.825rem] py-[0.5rem] rounded text-neutral-700 border border-neutral-300 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 transition duration-300 ease-in']) }}
        x-bind:value="$store.{{$store}}.{{ $storeKey }}"
        x-on:input="onInput"
    >
</div>
