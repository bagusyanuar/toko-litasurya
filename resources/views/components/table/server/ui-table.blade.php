<div>
    <!--table headings -->
    <div class="w-full flex items-center justify-between mb-3">
        <div class="flex items-center">
            <span class="text-sm text-neutral-500 me-2">Menampilkan</span>
            <select
                class="border border-neutral-500 rounded-[4px] text-sm px-1 py-1 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500"
                x-on:change="{{ $onPerPageChange }}"
            >
                <template x-for="value in {{ $pageLength }}">
                    <option :value="value" x-text="value"></option>
                </template>
            </select>
            <span class="text-xs text-neutral-500 ms-2">Data</span>
        </div>
    </div>
    <!-- table content -->
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
    <!-- table pagination -->
    <div class="mt-3 flex items-center justify-end">
{{--        <div class="">--}}
{{--            <span class="text-sm text-neutral-500">Menampilkan <span--}}
{{--                    x-text="(({{ $currentPage }} - 1) * {{ $perPage }} + 1)"></span> sampai <span--}}
{{--                    x-text="{{ $perPage }}"></span> dari <span x-text="{{ $totalRows }}"></span></span>--}}
{{--        </div>--}}
        <div class="flex gap-1 items-center">
            <span>Rows Per Page</span>
        </div>
        <div class="flex items-center gap-1 py-1.5 px-1.5">
            <a href="#" x-on:click.prevent=""
               class="text-brand-500 cursor-pointer h-6 w-6 rounded-[4px] flex items-center justify-center hover:text-white hover:bg-brand-500 transition-all duration-300 ease-in-out">
                <i data-lucide="chevrons-left"
                   class="text-neutral-500 group-focus-within:text-neutral-900 h-4 aspect-[1/1]">
                </i>
            </a>
            <a href="#" x-on:click.prevent=""
               class="text-brand-500 cursor-pointer h-6 w-6 rounded-[4px] flex items-center justify-center hover:text-white hover:bg-brand-500 transition-all duration-300 ease-in-out">
                <i data-lucide="chevron-left"
                   class="text-neutral-500 group-focus-within:text-neutral-900 h-4 aspect-[1/1]">
                </i>
            </a>
            <a href="#" x-on:click.prevent=""
               class="text-brand-500 cursor-pointer h-6 w-6 rounded-[4px] flex items-center justify-center hover:text-white hover:bg-brand-500 transition-all duration-300 ease-in-out">
                <i data-lucide="chevron-right"
                   class="text-neutral-500 group-focus-within:text-neutral-900 h-4 aspect-[1/1]">
                </i>
            </a>
            <a href="#" x-on:click.prevent=""
               class="text-brand-500 cursor-pointer h-6 w-6 rounded-[4px] flex items-center justify-center hover:text-white hover:bg-brand-500 transition-all duration-300 ease-in-out">
                <i data-lucide="chevrons-right"
                   class="text-neutral-500 group-focus-within:text-neutral-900 h-4 aspect-[1/1]">
                </i>
            </a>
        </div>
    </div>
</div>
