<button
    {{ $attributes->merge(['class' => $baseClass]) }}
>
    {{ $slot }}
</button>
