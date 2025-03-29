@props([
'id',
'store',
'dispatcher' => '',
'parentClassName' => '',
'label' => '',
'validatorKey' => '',
'validatorField' => ''
])

<div class="{{ $parentClassName }}">
    <label for="{{ $id }}" class="text-xs text-neutral-700 {{ $label !== '' ? 'block mb-1' : '' }}">{{ $label }}</label>
    <div class="relative group w-full">
        <div wire:ignore class="h-full flex items-center px-[0.5rem] absolute inset-y-0 start-0">
            <i data-lucide="calendar-days" class="text-neutral-500 group-focus-within:text-neutral-900 h-3 aspect-[1/1]"></i>
        </div>
        <input
            id="{{ $id }}"
            {{ $attributes->merge(['class' => 'w-full text-xs ps-[2.05rem] pe-[0.825rem] py-[0.5rem] rounded-[4px] rounded-[4px] text-neutral-700 border border-neutral-300 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 transition duration-300 ease-in-out']) }}
            x-bind:class="{{ $validatorKey !== '' ? "{ '!border-danger-500' : '{$validatorField}' in {$validatorKey} }" : "{}" }}"
            x-bind:store-name="'{{ $store }}'"
            x-bind:dispatcher="'{{ $dispatcher }}'"
            x-bind="gxuiDatepickerBind"
            x-init="initDatepicker()"
        >
    </div>
    @if($validatorKey !== '')
        <template x-if="'{{ $validatorField }}' in {{ $validatorKey }}">
            <span class="text-xs text-danger-500 mt-1 block" x-text="{{ $validatorKey }}['{{ $validatorField }}'][0]"></span>
        </template>
    @endif
</div>
