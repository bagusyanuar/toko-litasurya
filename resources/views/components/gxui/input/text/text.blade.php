<div  class="{{ $parentClassName }}">
    <label for="{{ $id }}" class="text-sm text-neutral-700 {{ $label !== '' ? 'block mb-1' : '' }}">{{ $label }}</label>
    <input
        id="{{ $id }}"
        {{ $attributes->merge(['class' => 'w-full text-sm px-[0.625rem] py-[0.5rem] rounded text-neutral-700 border border-neutral-300 outline-none disabled:bg-neutral-200 focus:outline-none focus:ring-0 focus:border-neutral-500 transition-[border] duration-200 ease-in']) }}
        x-bind:class="{{ $validatorKey !== '' ? "{ '!border-danger-500' : '{$validatorField}' in {$validatorKey} }" : "{}" }}"
    >
    @if($validatorKey !== '')
        <template x-if="'{{ $validatorField }}' in {{ $validatorKey }}">
            <span class="text-xs text-danger-500 mt-1 block" x-text="{{ $validatorKey }}.{{ $validatorField }}[0]"></span>
        </template>
    @endif
</div>
