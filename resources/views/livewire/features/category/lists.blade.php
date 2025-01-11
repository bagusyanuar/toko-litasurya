<section
    id="section-table-categories"
    data-component-id="category-list"
>
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
                    <td class="py-3 px-3 text-center">
                        <div class="w-full justify-items-center">
                            <x-pop-over.ui-pop-over>
                                <div
                                    x-bind="uiPopOverTrigger"
                                    class="cursor-pointer w-fit"
                                >
                                    <i data-lucide="ellipsis-vertical"
                                       class="text-neutral-500 group-focus-within:text-neutral-900 h-3 aspect-[1/1]"></i>
                                </div>
                                <div
                                    x-bind="uiPopOverContent"
                                    class="fixed z-50 text-sm w-[130px] text-gray-500 bg-white border border-gray-200 rounded-md shadow-sm dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800"
                                >
                                    <div class="flex flex-col py-1 justify-start items-start">
                                        <div
                                            class="flex items-center justify-start gap-2 w-full text-sm px-2 py-1.5 cursor-pointer hover:bg-neutral-50"
                                            x-on:click="open = false; $store.formCategoryStore.getCategory('my-id');"
                                        >
                                            <div wire:ignore>
                                                <i data-lucide="pencil" class="text-neutral-500 h-4 aspect-[1/1]"></i>
                                            </div>
                                            <span>Edit</span>
                                        </div>
                                        <div
                                            class="flex items-center justify-start gap-2 w-full text-sm px-2 py-1.5 cursor-pointer hover:bg-neutral-50"
                                            x-on:click="open = false; $store.formCategoryStore.delete();"
                                        >
                                            <div wire:ignore>
                                                <i data-lucide="trash" class="text-neutral-500 h-4 aspect-[1/1]"></i>
                                            </div>
                                            <span>Delete</span>
                                        </div>
                                    </div>
                                </div>
                            </x-pop-over.ui-pop-over>
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
</section>
@push('scripts')
    @vite(['resources/js/features/category/list.js'])
@endpush
