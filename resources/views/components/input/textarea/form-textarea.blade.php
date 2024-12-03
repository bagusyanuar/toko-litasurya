<div  class="{{ $parentClassName }}">
    <label for="{{ $id }}" class="text-xs text-neutral-700 block mb-1">{{ $label }}</label>
    <textarea {{ $attributes->merge(['class' => $baseClass, 'id' => $id]) }}></textarea>
</div>
