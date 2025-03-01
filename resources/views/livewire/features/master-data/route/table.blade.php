<section
    id="section-table-route"
    data-component-id="table-route"
>
    <div class="bg-white w-full p-6 rounded-lg shadow-md">
        <div class="w-full flex items-center justify-between mb-3">
            <p class="text-neutral-700 font-semibold">Route Data</p>
            <div class="flex items-center gap-3">
                <x-gxui.table.search
                    placeholder="Search..."
                    store="routeTableStore"
                    dispatcher="onFindAll"
                ></x-gxui.table.search>
                <x-gxui.button.button
                    wire:ignore
                    x-on:click="$store.routeFormStore.showModal()"
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
            store="routeTableStore"
        >
            <x-slot name="header">
                <x-gxui.table.th
                    title="Name"
                    className="w-[150px]"
                ></x-gxui.table.th>
                <x-gxui.table.th
                    title="Route"
                    align="left"
                ></x-gxui.table.th>
                <x-gxui.table.th
                    title="Action"
                    className="w-[80px]"
                ></x-gxui.table.th>
            </x-slot>
            <x-slot name="rows">
                <tr class="border-b border-neutral-300">
                    <x-gxui.table.td className="flex justify-center">
                        <span x-text="data.name"></span>
                    </x-gxui.table.td>
                    <x-gxui.table.td>
                        <span x-text="data.address"></span>
                    </x-gxui.table.td>
                    <x-gxui.table.td className="flex justify-center relative">
                        <x-gxui.table.action store="customerStoreTableStore"></x-gxui.table.action>
                    </x-gxui.table.td>
                </tr>
            </x-slot>
        </x-gxui.table.table>
        <x-gxui.table.pagination
            store="routeTableStore"
            dispatcher="onFindAll"
        ></x-gxui.table.pagination>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const componentProps = {
                component: null,
                formStore: null,
                toastStore: null,
                customerStore: null,
                paginationStore: null,
                actions: [
                    {
                        label: 'Edit',
                        icon: 'pencil',
                        dispatch: function (id) {
                            this.onEdit(id)
                        }
                    },
                    {
                        label: 'Delete',
                        icon: 'trash',
                        dispatch: function (id) {
                            this.onDelete(id)
                        }
                    },
                ],
                init: function () {
                    const componentID = document.querySelector('[data-component-id="table-route"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            // this.formStore = Alpine.store('customerStoreFormStore');
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.customerStore = Alpine.store('customerStore');
                            this.paginationStore = Alpine.store('gxuiPaginationStore');
                            this.actions.forEach((action, key) => {
                                action.dispatch = action.dispatch.bind(this);
                            });
                            this.component = component;
                            this.onFindAll();
                        }

                    })
                },
                onFindAll() {
                    this.loading = true;
                    const query = {
                        type: this.type,
                        param: this.param,
                        page: this.page,
                        per_page: this.perPage
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
                onDelete(id) {
                    this.customerStore.showLoading('Deleting Process...');
                    this.component.$wire.call('delete', id)
                        .then(response => {
                            const {success} = response;
                            if (success) {
                                this.toastStore.success('success delete customer');
                                this.onFindAll();
                            } else {
                                this.toastStore.failed('failed to delete customer');
                            }
                        }).finally(() => {
                        this.customerStore.closeLoading();
                    })
                },
                onEdit(id) {
                    this.customerStore.showLoading('Finding Item Process...');
                    this.component.$wire.call('findByID', id)
                        .then(response => {
                            const {success, data, message} = response;
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
            Alpine.store('routeTableStore', props);
        });
    </script>
@endpush
