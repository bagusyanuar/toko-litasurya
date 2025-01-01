<div class="{{ $parentClassName }}">
    <label for="{{ $id }}" class="text-xs text-neutral-700 block mb-1">{{ $label }}</label>
    <input
        id="{{ $id }}"
        {{ $attributes->merge(['class' => $baseClass]) }}
        x-bind:class="{{ $validatorKey !== '' ? "{ '!border-danger-500' : '{$validatorField}' in {$validatorKey} }" : "{}" }}"
    >
    @if($validatorKey !== '')
        <template x-if="'{{ $validatorField }}' in {{ $validatorKey }}">
            <span class="text-xs text-danger-500 mt-1 block" x-text="{{ $validatorKey }}.{{ $validatorField }}[0]"></span>
        </template>
    @endif
</div>
