<section
    id="section-table-categories"
    data-component-id="table-category"
>
    <div class="bg-white w-full p-6 rounded-lg shadow-md">
        <div class="w-full flex items-center justify-between mb-3">
            <p class="text-neutral-700 font-semibold">Category Data</p>
            <div class="flex items-center gap-3">
                <x-gxui.table.search
                    placeholder="Search..."
                    x-bind:value="$store.categoryTableStore.param"
                    x-on:input="$store.categoryTableStore.onSearch($event.target.value)"

                ></x-gxui.table.search>
                <x-gxui.button.button
                    wire:ignore
                    x-on:click="$store.categoryFormStore.setOpenModalForm()"
                >
                    <div class="w-full flex justify-center items-center gap-1 text-sm">
                        <i data-lucide="plus" class="h-3" style="width: fit-content;"></i>
                        <span>Create New</span>
                    </div>
                </x-gxui.button.button>
            </div>
        </div>
        <x-gxui.table.table
            class="mb-1"
            isLoading="$store.categoryTableStore.loading"
            storeData="$store.categoryTableStore.data"
        >
            <x-slot name="header">
                <x-gxui.table.th
                    title="Name"
                    align="left"
                ></x-gxui.table.th>
                <x-gxui.table.th
                    title="Action"
                    className="w-[80px]"
                ></x-gxui.table.th>
            </x-slot>
            <x-slot name="rows">
                <template x-for="(data, index) in $store.categoryTableStore.data" :key="index">
                    <tr class="border-b border-neutral-300">
                        <x-gxui.table.td>
                            <div class="flex items-center gap-3">
                                <img
                                    x-data
                                    alt="category-image"
                                    class="w-10 h-10 rounded-full border border-neutral-200"
                                    x-bind:src="data.image"
                                >
                                <span x-text="data.name"></span>
                            </div>
                        </x-gxui.table.td>
                        <x-gxui.table.td className="flex justify-center">
                            <x-gxui.popper.popper>
                                <div
                                    x-bind="gxuiPopperTrigger"
                                    class="cursor-pointer w-fit"
                                    wire:ignore
                                >
                                    <i data-lucide="ellipsis-vertical"
                                       class="text-neutral-500 group-focus-within:text-neutral-900 h-3 aspect-[1/1]">
                                    </i>
                                </div>
                                <div
                                    x-bind="gxuiPopperContent"
                                    class="fixed z-50 text-sm w-[130px] text-gray-500 bg-white border border-gray-200 rounded-md shadow-sm dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800"
                                >
                                    <div class="flex flex-col py-1 justify-start items-start">
                                        <div
                                            class="flex items-center justify-start gap-2 w-full text-sm px-2 py-1.5 cursor-pointer hover:bg-neutral-50"
                                            x-on:click="open = false;"
                                        >
                                            <div wire:ignore>
                                                <i data-lucide="pencil" class="text-neutral-500 h-4 aspect-[1/1]"></i>
                                            </div>
                                            <span>Edit</span>
                                        </div>
                                        <div
                                            class="flex items-center justify-start gap-2 w-full text-sm px-2 py-1.5 cursor-pointer hover:bg-neutral-50"
                                            x-on:click="open = false;"
                                        >
                                            <div wire:ignore>
                                                <i data-lucide="trash" class="text-neutral-500 h-4 aspect-[1/1]"></i>
                                            </div>
                                            <span>Delete</span>
                                        </div>
                                    </div>
                                </div>
                            </x-gxui.popper.popper>
                        </x-gxui.table.td>
                    </tr>
                </template>
            </x-slot>
        </x-gxui.table.table>
        <x-gxui.table.pagination
            isLoading="$store.categoryTableStore.loading"
            shownPages="$store.categoryTableStore.shownPages"
            currentPage="$store.categoryTableStore.page"
            perPageOptions="$store.categoryTableStore.perPageOptions"
            handlePerPageChange="$store.categoryTableStore.perPageChange"
            handlePageChange="$store.categoryTableStore.onPageChange"
            handlePreviousPageChange="$store.categoryTableStore.onPreviousPage()"
            handleNextPageChange="$store.categoryTableStore.onNextPage()"
            totalPages="$store.categoryTableStore.totalPages"
            totalRows="$store.categoryTableStore.totalRows"
        ></x-gxui.table.pagination>
    </div>

</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('categoryTableStore', {
                loading: true,
                page: 1,
                perPage: 10,
                shownPages: [],
                perPageOptions: [10, 25, 50],
                totalPages: 0,
                totalRows: 0,
                param: '',
                data: [],
                timeoutDebounce: null,
                componentID: document.querySelector('[data-component-id="table-category"]')?.getAttribute('wire:id'),
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === this.componentID) {
                            component.$wire.call('findAll', this.param, this.page, this.perPage)
                                .then(response => {
                                    if (response['success']) {
                                        this.data = response['data'];
                                        const totalRecords = response['meta']['pagination']['total_rows'];
                                        this.totalRows = totalRecords;
                                        Alpine.store('gxuiPaginationStore').paginate(totalRecords, this.perPage, this.page, 5);
                                        this.shownPages = Alpine.store('gxuiPaginationStore').shownPages;
                                        this.totalPages = Alpine.store('gxuiPaginationStore').totalPages;
                                    } else {
                                        Alpine.store('gxuiToastStore').failed('failed to load data');
                                    }
                                }).catch(error => {
                                Alpine.store('gxuiToastStore').failed('failed to load data');
                            })
                                .finally(() => {
                                    this.loading = false;
                                })
                        }
                    })
                },
                perPageChange(value) {
                    this.perPage = value;
                    this.onFindAll();
                },
                onPageChange(value) {
                    this.page = value;
                    this.onFindAll();
                },
                onPreviousPage() {
                    this.page = this.page - 1;
                    this.onFindAll();
                },
                onNextPage() {
                    this.page = this.page + 1;
                    this.onFindAll();
                },
                onFindAll() {
                    this.loading = true;
                    window.Livewire
                        .find(this.componentID).call('findAll', this.param, this.page, this.perPage)
                        .then(response => {
                            if (response['success']) {
                                this.data = response['data'];
                                const totalRecords = response['meta']['pagination']['total_rows'];
                                this.totalRows = totalRecords;
                                Alpine.store('gxuiPaginationStore').paginate(totalRecords, this.perPage, this.page, 5);
                                this.shownPages = Alpine.store('gxuiPaginationStore').shownPages;
                                this.totalPages = Alpine.store('gxuiPaginationStore').totalPages;
                            } else {
                                Alpine.store('gxuiToastStore').failed('failed to load data');
                            }
                        }).catch(error => {
                        Alpine.store('gxuiToastStore').failed('failed to load data');
                    }).finally(() => {
                        this.loading = false;
                    })
                },
                onSearch(value) {
                    clearTimeout(this.timeoutDebounce);
                    this.timeoutDebounce = setTimeout(() => {
                        Alpine.store('categoryTableStore').page = 1;
                        Alpine.store('categoryTableStore').param = value;
                        Alpine.store('categoryTableStore').onFindAll();
                    }, 500)
                },
            })
        })
    </script>
@endpush
