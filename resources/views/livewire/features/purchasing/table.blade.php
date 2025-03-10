<section
    id="section-table-purchasing"
    data-component-id="table-purchasing"
>
    <div class="w-full flex items-center justify-between mb-3">
        <p class="text-neutral-700 font-semibold">Purchasing Data</p>
        <div class="flex items-center gap-3">
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.filterPurchasingStore.show()"
            >
                <div wire:ignore>
                    <i data-lucide="filter"
                       class="text-white h-4 aspect-[1/1]"></i>
                </div>
            </x-gxui.button.button>
        </div>
    </div>
    <x-gxui.table.table
        class="mb-1"
        store="purchasingTableStore"
    >
        <x-slot name="header">
            <x-gxui.table.th
                title="Date"
                className="w-[100px]"
            ></x-gxui.table.th>
            <x-gxui.table.th
                title="Store"
                className="min-w-[120px]"
            ></x-gxui.table.th>
            <x-gxui.table.th
                title="Sales"
                className="min-w-[150px]"
                align="left"
            ></x-gxui.table.th>
            <x-gxui.table.th
                title="Total"
                className="w-[100px]"
                align="right"
            ></x-gxui.table.th>
            <x-gxui.table.th
                title="Action"
                className="w-[80px]"
            ></x-gxui.table.th>
        </x-slot>
        <x-slot name="rows">
            <tr class="border-b border-neutral-300">
                <x-gxui.table.td className="flex justify-center">
                    <span x-text="data.date"></span>
                </x-gxui.table.td>
                <x-gxui.table.td className="flex justify-center">
                    <span x-text="data.customer.name"></span>
                </x-gxui.table.td>
                <x-gxui.table.td>
                    <span x-text="data.user.sales.name"></span>
                </x-gxui.table.td>
                <x-gxui.table.td className="flex justify-end">
                    <span x-text="data.total.toLocaleString('id-ID')"></span>
                </x-gxui.table.td>
                <x-gxui.table.td className="flex justify-center relative">
                    <x-gxui.table.action store="purchasingTableStore"></x-gxui.table.action>
                </x-gxui.table.td>
            </tr>
        </x-slot>
    </x-gxui.table.table>
    <x-gxui.table.pagination
        store="purchasingTableStore"
        dispatcher="onFindAll"
    ></x-gxui.table.pagination>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const componentProps = {
                component: null,
                filterStore: null,
                toastStore: null,
                transactionStore: null,
                processStore: null,
                paginationStore: null,
                store: '',
                sales: '',
                dateStart: '',
                dateEnd: '',
                actions: [
                    // {
                    //     label: 'Edit',
                    //     icon: 'pencil',
                    //     dispatch: function (id) {
                    //         this.onEdit(id)
                    //     }
                    // },
                    // {
                    //     label: 'Delete',
                    //     icon: 'trash',
                    //     dispatch: function (id) {
                    //         this.onDelete(id)
                    //     }
                    // },
                    {
                        label: 'Process',
                        icon: 'send',
                        dispatch: function (id) {
                            this.onProcess(id)
                        }
                    },
                    {
                        label: 'Cancel',
                        icon: 'undo-2',
                        dispatch: function (id) {
                            // this.onDelete(id)
                        }
                    },
                ],
                init: function () {
                    const componentID = document.querySelector('[data-component-id="table-purchasing"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                            this.filterStore = Alpine.store('filterPurchasingStore');
                            this.processStore = Alpine.store('processPurchasingStore');
                            this.transactionStore = Alpine.store('transactionStore');
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.paginationStore = Alpine.store('gxuiPaginationStore');
                            this.actions.forEach((action, key) => {
                                action.dispatch = action.dispatch.bind(this);
                            });
                            this.onFindAll();
                        }

                    })
                },
                onFindAll() {
                    this.loading = true;
                    const query = {
                        param: this.param,
                        page: this.page,
                        per_page: this.perPage,
                        store: this.store,
                        sales: this.sales,
                        dateStart: this.dateStart,
                        dateEnd: this.dateEnd,
                    };
                    this.component.$wire.call('findAll', query)
                        .then(response => {
                            const {success, data, meta} = response;
                            if (success) {
                                this.data = data;
                                const totalRows = meta['pagination'] ? meta['pagination']['total_rows'] : 0;
                                const page = meta['pagination'] ? meta['pagination']['page'] : 1;
                                this.totalRows = totalRows;
                                this.page = page;
                                this.paginationStore.paginate(totalRows, this.perPage, this.page);
                                this.totalPages = this.paginationStore.totalPages;
                                this.shownPages = this.paginationStore.shownPages;
                            } else {
                                this.toastStore.failed('failed to load data');
                            }
                        }).finally(() => {
                        this.loading = false;
                    })
                },
                hydrateQuery(q) {
                    this.store = q['store'];
                    this.sales = q['sales'];
                    this.dateStart = q['dateStart'];
                    this.dateEnd = q['dateEnd'];
                    this.onFindAll();
                },
                onProcess(id) {
                    this.transactionStore.showLoading('processing purchase...');
                    this.component.$wire.call('findByID', id)
                        .then(response => {
                            const {success, data, message} = response;
                            console.log(response);
                            if (success) {
                                this.processStore.hydrateForm(data);
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.transactionStore.closeLoading();
                    })
                },
                onEdit(id) {
                    this.customerStore.showLoading('Finding Item Process...');
                    this.component.$wire.call('findByID', id)
                        .then(response => {
                            const {success, data, message} = response;
                            console.log(response);
                            if (success) {
                                this.formStore.hydrateForm(data);
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.customerStore.closeLoading();
                    })
                }
            };
            const props = Object.assign({}, window.TableStore, componentProps);
            Alpine.store('purchasingTableStore', props);
        });
    </script>
@endpush
