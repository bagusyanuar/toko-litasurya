<div class="relative group {{ $parentClassName }}">
    <div wire:ignore class="h-full flex items-center px-[0.5rem] absolute inset-y-0 start-0">
        <i data-lucide="{{ $iconName }}" class="text-neutral-500 group-focus-within:text-neutral-900 h-3 aspect-[1/1]"></i>
    </div>
    <input {{ $attributes->merge(['class' => $baseClass]) }}>
</div>
