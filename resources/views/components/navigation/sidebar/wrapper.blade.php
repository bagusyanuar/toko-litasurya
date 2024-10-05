<div class="sidebar-wrapper">
    <div class="header">
        @if(isset($header))
        @endif
    </div>
    <div class="item-wrapper">
        {{ $slot }}
    </div>
</div>
