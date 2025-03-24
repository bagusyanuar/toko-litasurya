<div
    wire:ignore
    class="w-full {{ $parentClassName }}"
>
    <label for="{{ $selectID }}" class="text-sm text-neutral-700 {{ $label !== '' ? 'block mb-1' : '' }}">{{ $label }}</label>
    <select
        id="{{ $selectID }}"
        {{ $attributes->merge(['class' => 'form-control w-full text-[0.825rem] text-neutral-700 border border-neutral-300 rounded-[4px] focus:ring-0 focus:outline-none focus:border-neutral-500 transition duration-300 ease-in-out']) }}
        x-bind:class="{{ $validatorKey !== '' ? "{ '!border-danger-500' : '{$validatorField}' in {$validatorKey} }" : "{}" }}"
        multiple="multiple"
    >

    </select>
    @if($validatorKey !== '')
        <template x-if="'{{ $validatorField }}' in {{ $validatorKey }}">
            <span class="text-xs text-danger-500 mt-1 block"
                  x-text="{{ $validatorKey }}.{{ $validatorField }}[0]"></span>
        </template>
    @endif
</div>


{{--        <template x-for="(data, index) in $store.{{ $store }}.{{ $options }}" :key="index">--}}
{{--            <option :value="data.id" x-text="data.text"></option>--}}
{{--        </template>--}}
