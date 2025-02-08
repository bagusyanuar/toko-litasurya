<div
    {{ $attributes->merge(['class' => 'w-fit']) }}
    x-bind="gxuiPopper"
    x-data
>
    {{ $slot }}
</div>
