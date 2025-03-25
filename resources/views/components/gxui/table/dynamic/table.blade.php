@props([
'store',
'dispatcher',
'stateData' => 'data',
'stateLoader' => 'loading',
'pagination' => 'false',
'stateTotalRows' => 'totalRows',
'statePerPageOptions' => '',
'statePerPage' => 'perPage',
'stateCurrentPage' => 'currentPage',
])

@if(empty($store))
    @php
        throw new Exception('The "store" property is required.');
    @endphp
@endif

<div
    class="w-full"
    x-bind:store="'{{ $store }}'"
    x-bind:dispatcher="'{{ $dispatcher }}'"
    x-bind:state-data="'{{ $stateData }}'"
    x-bind:state-loader="'{{ $stateLoader }}'"
    x-bind:state-total-rows="'{{ $stateTotalRows }}'"
    x-bind:state-per-page-options="'{{ $statePerPageOptions }}'"
    x-bind:state-per-page="'{{ $statePerPage }}'"
    x-bind:state-current-page="'{{ $stateCurrentPage }}'"
    x-bind="gxuiTablePagination"
>
    <div class="w-full rounded-lg border border-neutral-300 overflow-x-auto">
        <!--    header   -->
        @if(isset($header))
            <div class="flex items-center rounded-t-lg bg-brand-50 w-full text-xs">
                {{ $header }}
            </div>
        @endif

    <!--   rows   -->
        @if(isset($rows))
            <div x-show="loading">
                <x-gxui.table.loader></x-gxui.table.loader>
            </div>
            <div class="w-full" x-cloak x-show="!loading && rows.length > 0">
                <template x-for="(data, index) in rows" :key="index">
                    {{ $rows }}
                </template>
            </div>
            <div x-cloak x-show="!loading && rows.length <= 0">
                <x-gxui.table.empty-row></x-gxui.table.empty-row>
            </div>
        @endif

        @if(isset($footer))
            <div class="flex items-center rounded-t-lg bg-brand-50 w-full text-xs">
                {{ $footer }}
            </div>
        @endif
    </div>
    <div x-cloak x-show="{{ $pagination }}" class="flex items-center justify-between gap-3 mt-1">
        <div x-show="loading" class="flex items-center gap-1">
            <x-gxui.loader.shimmer class="!w-24"></x-gxui.loader.shimmer>
            <x-gxui.loader.shimmer class="!w-8"></x-gxui.loader.shimmer>
        </div>
        <div x-show="!loading" x-cloak class="text-xs text-neutral-500">Total Data: <span
                x-text="totalRows" class="font-semibold"></span>
        </div>
        <div class="flex items-center">
            <div x-show="loading" class="flex gap-2 items-center">
                <x-gxui.loader.shimmer></x-gxui.loader.shimmer>
                <x-gxui.loader.shimmer class="!w-8 !h-6"></x-gxui.loader.shimmer>
            </div>
            <div x-show="loading" class="flex gap-1 items-center ms-2">
                <template x-for="i in 3">
                    <x-gxui.loader.shimmer class="!h-4 !w-4"></x-gxui.loader.shimmer>
                </template>
            </div>
            <div x-show="!loading" x-cloak class="flex gap-2 items-center text-xs text-neutral-500">
                <span>Lines per page</span>
                <select
                    class="border border-neutral-500 w-fit appearance-none rounded-[4px] text-xs pl-2 !pr-[1.5rem] py-1 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 cursor-pointer"
                    style="
                        background-position: right 0.5rem center;
                        background-image: url('data:image/svg+xml,%3csvg aria-hidden=%27true%27 xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 16 16%27%3e%3cpath stroke=%27%236B7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27m2 6 6-6 6 6 m-12 4 6 6 6-6%27/%3e%3c/svg%3e');
                        "
                    x-on:change="onPerPageChange($event.currentTarget.value);"
                >
                    <template x-for="value in perPageOptions">
                        <option :value="value" x-text="value"></option>
                    </template>
                </select>
            </div>
            <div x-show="!loading" x-cloak class="flex items-center gap-1 py-1.5 ps-1.5" wire:ignore>
                <button
                    class="h-6 aspect-[1/1] rounded-full flex items-center justify-center text-brand-500 cursor-pointer hover:bg-brand-50 transition-all ease-in duration-200 disabled:text-neutral-300 disabled:cursor-default disabled:hover:bg-transparent"
                    x-bind:disabled="(currentPage == 1 || totalPages <= 0)"
                    x-on:click="onPrevious()"
                >
                    <i data-lucide="chevron-left"
                       class="h-4 aspect-[1/1]">
                    </i>
                </button>
                <template x-for="value in shownPages">
                    <a href="#"
                       x-on:click.prevent=""
                       x-on:click="onPageChange(value);"
                       class="text-xs cursor-pointer h-6 aspect-[1/1] rounded-full flex items-center justify-center"
                       x-bind:class="value === currentPage ? 'bg-brand-500 text-white' : 'bg-transparent text-brand-500 hover:bg-brand-50 transition-all ease-in duration-200'"
                       x-text="value"
                    ></a>
                </template>
                <button
                    x-on:click="onNext()"
                    class="h-6 aspect-[1/1] rounded-full flex items-center justify-center text-brand-500 cursor-pointer hover:bg-brand-50 transition-all ease-in duration-200 disabled:text-neutral-300 disabled:cursor-default disabled:hover:bg-transparent"
                    x-bind:disabled="(currentPage == totalPages || totalPages <= 0)"
                >
                    <i data-lucide="chevron-right"
                       class="h-4 aspect-[1/1]">
                    </i>
                </button>
            </div>
        </div>
    </div>
</div>
