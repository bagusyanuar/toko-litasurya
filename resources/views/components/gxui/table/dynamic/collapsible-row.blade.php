<div
    class="w-full"
    x-bind="gxuiCollapsibleRow"
    x-init="initIcons()"
    x-effect="initIcons()"
>
    <div class="w-full flex items-center text-xs border-b last:border-b-0">
        {{ $slot }}
    </div>
    @if(isset($collapsible))
        {{ $collapsible }}
    @endif
</div>
