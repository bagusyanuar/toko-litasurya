<section
    id="section-table-categories"
    data-component-id="category-list"
>
    <span x-text="$store.categoryList.shownPages"></span>
    <x-table.ui-table
        onLoading="$store.categoryList.loading"
        onPerPageChange="$store.categoryList.setPerPage($event.target.value)"
        currentPage="$store.categoryList.page"
        totalPage="$store.categoryList.totalPage"
    >
        <x-slot name="header">
            <tr class="bg-brand-50">
                <th class="py-4 px-3 text-center text-xs font-semibold w-[50px]">No</th>
                <th class="py-4 px-3 text-center text-xs font-semibold w-[8rem]">Gambar</th>
                <th class="py-4 px-3 text-start text-xs font-semibold">Nama Kategori</th>
                <th class="py-4 px-3 text-center text-xs font-semibold w-[120px]">Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="rows">
            @foreach($data as $datum)
                <tr class="border-b border-neutral-300" wire:key="{{ uniqid('table-categories-row-') }}">
                    <td class="text-xs py-3 px-3 text-center">
                        {{ ($currentPage - 1) * $perPage + ($loop->index + 1) }}
                    </td>
                    <td class="text-xs py-3 px-3 text-center w-[4rem]">
                        <div class="w-full flex items-center justify-center">
                            <div
                                class="w-12 aspect-[1/1] border border-neutral-300 rounded-sm p-1 flex items-center justify-center">
                                <img
                                    src="{{ asset($datum->image) }}"
                                    alt=""
                                    class="w-full h-full object-cover object-center cursor-pointer"
                                >
                            </div>
                        </div>
                    </td>
                    <td class="text-xs py-3 px-3 text-start">
                        {{ $datum->name }}
                    </td>
                    <td>
                        <button data-popover-target="popover-click" data-popover-trigger="click" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Click popover</button>
                        <div data-popover id="popover-click" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                            <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                <h3 class="font-semibold text-gray-900 dark:text-white">Popover click</h3>
                            </div>
                            <div class="px-3 py-2">
                                <p>And here's some amazing content. It's very engaging. Right?</p>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-slot>
        <x-slot name="pagination">
            <x-table.components.ui-pagination
                currentPage="$store.categoryList.page"
                totalPage="$store.categoryList.totalPage"
                onFirstPageChange="$store.categoryList.onFirstPageHandler()"
                onPreviousPageChange="$store.categoryList.onPreviousPageHandler()"
                onNextPageChange="$store.categoryList.onNextPageHandler()"
                onLastPageChange="$store.categoryList.onLastPageHandler()"
                onPageChange="$store.categoryList.onPageChangeHandler(page)"
                shownPages="$store.categoryList.shownPages"
            ></x-table.components.ui-pagination>
        </x-slot>
    </x-table.ui-table>
    {{--    <x-table.table--}}
    {{--        x-init="$nextTick(() => {--}}
    {{--                $wire.getDataCategories();--}}
    {{--            })"--}}
    {{--        @fetch-categories.window="$wire.set('onLoading', true)"--}}
    {{--        :pageLength="$pageLength"--}}
    {{--        :totalRows="$totalRows"--}}
    {{--        :currentPage="$currentPage"--}}
    {{--        :perPage="$perPage"--}}
    {{--        perPageModel="perPage"--}}
    {{--        currentPageModel="currentPage"--}}
    {{--        onPerPageChange="$wire.onPerPageChange()"--}}
    {{--        onPageChange="$wire.onPageChange()"--}}
    {{--        onNextPageChange="$wire.onNextPage()"--}}
    {{--        onLastPageChange="$wire.onLastPage(lastPage)"--}}
    {{--        onPreviousPageChange="$wire.onPreviousPage()"--}}
    {{--        onFirstPageChange="$wire.onFirstPage()"--}}
    {{--    >--}}
    {{--        <x-slot name="extensions">--}}
    {{--            <x-table.components.search--}}
    {{--                paramModel="param"--}}
    {{--                dispatcher="onSearch"--}}
    {{--                placeholder="cari..."--}}
    {{--            ></x-table.components.search>--}}
    {{--        </x-slot>--}}
    {{--        <x-slot name="header">--}}
    {{--            <tr class="bg-brand-50">--}}
    {{--                <th class="py-4 px-3 text-center text-xs font-semibold w-[50px]">No</th>--}}
    {{--                <th class="py-4 px-3 text-center text-xs font-semibold w-[8rem]">Gambar</th>--}}
    {{--                <th class="py-4 px-3 text-start text-xs font-semibold">Nama Kategori</th>--}}
    {{--                <th class="py-4 px-3 text-center text-xs font-semibold w-[120px]">Aksi</th>--}}
    {{--            </tr>--}}
    {{--        </x-slot>--}}
    {{--        <x-slot name="rows">--}}
    {{--            @forelse($data as $datum)--}}
    {{--                <tr class="border-b border-neutral-300">--}}
    {{--                    <td class="text-xs py-3 px-3 text-center">--}}
    {{--                        {{ ($currentPage - 1) * $perPage + ($loop->index + 1) }}--}}
    {{--                    </td>--}}
    {{--                    <td class="text-xs py-3 px-3 text-center w-[4rem]">--}}
    {{--                        <div class="w-full flex items-center justify-center">--}}
    {{--                            <div--}}
    {{--                                class="w-12 aspect-[1/1] border border-neutral-300 rounded-sm p-1 flex items-center justify-center">--}}
    {{--                                <img--}}
    {{--                                    src="{{ asset($datum->image) }}"--}}
    {{--                                    alt=""--}}
    {{--                                    class="w-full h-full object-cover object-center cursor-pointer"--}}
    {{--                                >--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </td>--}}
    {{--                    <td class="text-xs py-3 px-3 text-start">--}}
    {{--                        {{ $datum->name }}--}}
    {{--                    </td>--}}
    {{--                    <td class="text-xs py-3 px-3 text-center">--}}
    {{--                        <livewire:features.category.table-action--}}
    {{--                            :idx="$loop->index"--}}
    {{--                            :category="$datum"--}}
    {{--                            wire:key="{{ uniqid('diagnosis-icd10-'. $loop->index) }}"--}}
    {{--                        />--}}
    {{--                    </td>--}}
    {{--                </tr>--}}
    {{--            @empty--}}
    {{--                <tr>--}}
    {{--                    <td colspan="4">--}}
    {{--                        <x-table.components.empty-table></x-table.components.empty-table>--}}
    {{--                    </td>--}}
    {{--                </tr>--}}
    {{--            @endforelse--}}
    {{--        </x-slot>--}}
    {{--    </x-table.table>--}}
</section>
@push('scripts')
    @vite('resources/js/features/category/list.js')
@endpush
