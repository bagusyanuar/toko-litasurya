<div class="{{ $parentClassName }}">
    <label for="{{ $id }}" class="text-sm text-neutral-700 {{ $label !== '' ? 'block mb-1' : '' }}">{{ $label }}</label>
    <div class="relative group w-full">
        <div wire:ignore class="h-full flex items-center px-[0.5rem] absolute inset-y-0 start-0">
            <i data-lucide="calendar-days" class="text-neutral-500 group-focus-within:text-neutral-900 h-3 aspect-[1/1]"></i>
        </div>
        <input
            id="{{ $id }}"
            {{ $attributes->merge(['class' => $baseClass]) }}
            x-bind:class="{{ $validatorKey !== '' ? "{ '!border-danger-500' : '{$validatorField}' in {$validatorKey} }" : "{}" }}"
        >
    </div>
    @if($validatorKey !== '')
        <template x-if="'{{ $validatorField }}' in {{ $validatorKey }}">
            <span class="text-xs text-danger-500 mt-1 block" x-text="{{ $validatorKey }}['{{ $validatorField }}'][0]"></span>
        </template>
    @endif
</div>
