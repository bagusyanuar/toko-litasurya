<section
    id="section-table-categories"
    data-component-id="table-category"
>
    <div class="bg-white w-full p-6 rounded-lg shadow-md">
        <div class="w-full flex items-center justify-between mb-3">
            <p class="text-neutral-700 font-semibold">Category Data</p>
            <div class="flex items-center gap-3">
                <x-gxui.table.search></x-gxui.table.search>
                <x-gxui.button.button
                    wire:ignore
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
                            <span x-text="data.name"></span>
                        </x-gxui.table.td>
                    </tr>
                </template>
            </x-slot>
        </x-gxui.table.table>
        <x-gxui.table.pagination
            shownPages="$store.categoryTableStore.shownPages"
            currentPage="$store.categoryTableStore.page"
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
                param: '',
                data: [],
                componentID: document.querySelector('[data-component-id="table-category"]')?.getAttribute('wire:id'),
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === this.componentID) {
                            component.$wire.call('findAll', this.param, this.page, this.perPage)
                                .then(response => {
                                    if (response['success']) {
                                        this.data = response['data'];
                                        const totalRecords = response['meta']['total_rows'];
                                        Alpine.store('gxuiPaginationStore').paginate(totalRecords, this.perPage, this.page, 5);
                                        this.shownPages = Alpine.store('gxuiPaginationStore').shownPages;
                                    } else {
                                        console.error(response);
                                    }
                                }).finally(() => {
                                this.loading = false;
                            })
                        }
                    })
                },
            })
        })
    </script>
@endpush
