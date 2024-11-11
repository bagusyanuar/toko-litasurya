<div class="{{ $parentClassName }}">
    <label for="{{ $id }}" class="text-xs text-neutral-700">{{ $label }}</label>
    <input {{ $attributes->merge(['class' => $baseClass, 'id' => $id]) }}>
</div>
