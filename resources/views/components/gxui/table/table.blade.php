<div
    {{ $attributes->merge(['class' => 'w-full rounded-lg border border-neutral-300 overflow-x-auto']) }}
>
    <table class="w-full overflow-x-auto">
        @if(isset($header))
            <thead>
            <tr class="border-b border-neutral-300 bg-brand-50">
                {{ $header }}
            </tr>
            </thead>
        @endif
        @if(isset($rows))
            <tbody x-cloak x-show="!$store.{{ $store }}.loading && $store.{{ $store }}.data.length > 0">
                <template x-for="(data, index) in $store.{{ $store }}.data" :key="index">
                    {{ $rows }}
                </template>
            </tbody>
        @endif
    </table>
    <div x-show="$store.{{ $store }}.loading">
        <x-gxui.table.loader></x-gxui.table.loader>
    </div>
    <div x-cloak x-show="!$store.{{ $store }}.loading && $store.{{ $store }}.data.length <= 0">
        <x-gxui.table.empty-row></x-gxui.table.empty-row>
    </div>
</div>
