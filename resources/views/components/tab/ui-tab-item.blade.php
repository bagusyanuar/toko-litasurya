<div
    class="relative cursor-pointer"
    x-on:click="{{ $handleChange }}"
>
    <div
        class="flex items-center px-3 py-3.5 gap-1"
        x-bind:class="{{ $active }} ? 'text-brand-500' : 'text-neutral-500'"

    >
        <i data-lucide="{{ $icon }}" class="h-4 aspect-[1/1]"></i>
        <span class="text-sm">{{ $title }}</span>
    </div>
    <div
        class="absolute bottom-0 left-1/2 -translate-x-1/2 h-0.5 bg-brand-500 w-[75%]"
        x-bind:class="{{ $active }} ? '' : 'hidden'"
    ></div>
</div>
