<div class="relative group" x-data="{ param: $wire.entangle('{{ $paramModel }}') }">
    <div wire:ignore class="h-full flex items-center px-[0.5rem] absolute inset-y-0 start-0">
        <i data-lucide="search" class="text-neutral-500 group-focus-within:text-neutral-900 h-3 aspect-[1/1]"></i>
    </div>
    <input
        {{ $attributes->merge(['class' => $baseClass]) }}
        x-on:input.debounce.500ms="$wire.set('{{ $paramModel }}', $event.target.value); $wire.{{ $dispatcher }}()"
    >
</div>
