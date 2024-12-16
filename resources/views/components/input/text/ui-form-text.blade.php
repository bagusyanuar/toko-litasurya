<div class="{{ $parentClassName }}">
    <label for="{{ $id }}" class="text-xs text-neutral-700 block mb-1">{{ $label }}</label>
    <input id="{{ $id }}" {{ $attributes->merge(['class' => $baseClass]) }}>
</div>
