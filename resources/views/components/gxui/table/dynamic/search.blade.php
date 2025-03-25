@props([
'store',
'dispatcher',
'parentClassName' => '',
'stateParam' => 'param',
'stateCurrentPage' => 'currentPage',
'debounceTime' => 500
])
<div
    class="relative group {{ $parentClassName }}"
    x-bind="gxuiTableSearch"
    x-bind:store-name="'{{ $store }}'"
    x-bind:dispatcher="'{{ $dispatcher }}'"
    x-bind:state-param="'{{ $stateParam }}'"
    x-bind:state-current-page="'{{ $stateCurrentPage }}'"
    x-bind:state-debounce-time="'{{ $debounceTime }}'"
>
    <div wire:ignore class="h-full flex items-center px-[0.5rem] absolute inset-y-0 start-0">
        <i data-lucide="search" class="text-neutral-500 group-focus-within:text-neutral-900 h-3 aspect-[1/1]"></i>
    </div>
    <input
        {{ $attributes->merge([
    'class' => 'w-full text-xs ps-[2.05rem] pe-[0.825rem] py-[0.5rem] rounded text-neutral-700 border border-neutral-300 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 transition duration-300 ease-in',
    'placeholder' => 'Search...'
    ]) }}
        x-on:input="onInput"
    >
</div>
