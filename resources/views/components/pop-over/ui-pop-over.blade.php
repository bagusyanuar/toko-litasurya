<div
    {{ $attributes->merge(['class' => '']) }}
    x-bind="uiPopOver"
    class="w-fit"
    x-data
>
    @if(isset($trigger))
        {{$trigger}}
    @endif
    {{ $slot }}
</div>
