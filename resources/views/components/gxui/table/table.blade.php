<div
    {{ $attributes->merge(['class' => 'w-full rounded-lg border border-neutral-300 overflow-x-auto']) }}
>
    <table class="w-full ">
        @if(isset($header))
            <thead>
            <tr class="border-b border-neutral-300 bg-brand-50">
                {{ $header }}
            </tr>
            </thead>
        @endif
        @if(isset($rows))
            <tbody x-show="!$store.{{ $store }}.loading && $store.{{ $store }}.data.length > 0">
            {{ $rows }}
            </tbody>
        @endif
    </table>
    <div x-show="$store.{{ $store }}.loading">
        <x-gxui.table.loader></x-gxui.table.loader>
    </div>
    <div x-show="!$store.{{ $store }}.loading && $store.{{ $store }}.data.length <= 0">
        <x-gxui.table.empty-row></x-gxui.table.empty-row>
    </div>
</div>
