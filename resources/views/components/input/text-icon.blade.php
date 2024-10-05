<div class="relative group">
    <span
        class="material-symbols-outlined absolute inset-y-0 start-0 flex items-center pointer-events-none text-neutral-500 group-focus-within:text-neutral-900 {{ $iconClass }}">
        {{ $materialIcon }}
    </span>
    <input {{ $attributes->merge(['class' => $baseClass]) }}>
</div>
