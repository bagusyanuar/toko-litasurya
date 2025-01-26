<div {{ $attributes->merge(['class' => 'w-full rounded-lg border border-neutral-300 overflow-x-auto']) }}>
    <table class="w-full ">
        @if(isset($header))
            <thead>
            <tr class="border-b border-neutral-300 bg-brand-50">
                {{ $header }}
            </tr>
            </thead>
        @endif
        @if(isset($rows))
            <tbody x-show="!{{ $isLoading }}">
            {{ $rows }}
            </tbody>
        @endif
    </table>
    <div x-show="{{ $isLoading }}">
        <x-gxui.table.loader></x-gxui.table.loader>
    </div>
</div>
