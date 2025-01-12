<div>
    <div class="w-full flex items-center justify-between mb-3">
        <div class="flex items-center">
            <span class="text-xs text-neutral-500 me-2">Menampilkan</span>
            <select
                class="border border-neutral-500 rounded-[4px] text-xs px-1 py-1 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500"
                x-on:change="{{ $onPerPageChange }}"
            >
                <template x-for="value in {{ $pageLength }}">
                    <option :value="value" x-text="value"></option>
                </template>
            </select>
            <span class="text-xs text-neutral-500 ms-2">Data</span>
        </div>
    </div>
    <div class="w-full border border-neutral-300 rounded-md overflow-x-auto">
        <table class="w-full">
            @if(isset($header))
                <thead>
                {{ $header }}
                </thead>
            @endif
            @if(isset($rows))
                <tbody>
                {{ $rows }}
                </tbody>
            @endif
        </table>
        <div
            class="w-full"
            x-show="{{ $loading }}"
            x-cloak
        >
            <x-table.server.components.ui-table-loader></x-table.server.components.ui-table-loader>
        </div>
    </div>
</div>
