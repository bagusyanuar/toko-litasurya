<section
    id="section-table-items"
    data-component-id="table-item"
>
    <div class="bg-white w-full px-6 py-4 rounded-lg shadow-md">
        <div class="w-full flex items-center justify-between mb-3">
            <p class="text-neutral-700 font-semibold">Item Data</p>
            <div class="flex items-center gap-3">
                <x-gxui.table.dynamic.search
                    store="itemTableStore"
                    dispatcher="onFindAll"
                ></x-gxui.table.dynamic.search>
                <x-gxui.button.button
                    wire:ignore
                    x-on:click="$store.itemFormStore.showModal()"
                >
                    <div class="w-full flex justify-center items-center gap-1 text-xs">
                        <i data-lucide="plus" class="h-3" style="width: fit-content;"></i>
                        <span>Create New</span>
                    </div>
                </x-gxui.button.button>
            </div>
        </div>
        <x-gxui.table.dynamic.table
            store="itemTableStore"
            dispatcher="onFindAll"
            pagination="true"
        >
            <x-slot name="header">
                <x-gxui.table.dynamic.th
                    class="w-[120px]"
                    contentClass="justify-center"
                >
                    <span>Category</span>
                </x-gxui.table.dynamic.th>
                <x-gxui.table.dynamic.th
                    class="flex-1 min-w-[120px]"
                >
                    <span>Name</span>
                </x-gxui.table.dynamic.th>
                <x-gxui.table.dynamic.th
                    contentClass="justify-end"
                    class="w-[100px]"
                >
                    <span>Price (Rp)</span>
                </x-gxui.table.dynamic.th>
                <x-gxui.table.dynamic.th
                    contentClass="justify-center"
                    class="w-[50px]"
                >
                    <span>Action</span>
                </x-gxui.table.dynamic.th>
            </x-slot>
            <x-slot name="rows">
                <x-gxui.table.dynamic.row>
                    <x-gxui.table.dynamic.td
                        class="w-[120px]"
                        contentClass="justify-center"
                    >
                        <span x-text="data.category.name"></span>
                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td
                        class="flex-1 min-w-[120px]"
                    >
                        <div class="flex items-center gap-3">
                            <img
                                x-data
                                alt="product-image"
                                class="w-10 h-10 rounded-lg border border-neutral-200"
                                x-bind:src="data.image"
                            >
                            <span x-text="data.name"></span>
                        </div>
                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td
                        contentClass="justify-end"
                        class="w-[100px]"
                    >
                        <span x-text="data.retail_price?.price.toLocaleString('id-ID') ?? '-'"></span>
                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td
                        contentClass="justify-center"
                        class="w-[50px]"
                    >
                        <x-gxui.table.dynamic.action store="itemTableStore"></x-gxui.table.dynamic.action>
                    </x-gxui.table.dynamic.td>
                </x-gxui.table.dynamic.row>
            </x-slot>
        </x-gxui.table.dynamic.table>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const COMPONENT_PROPS = {
                component: null,
                formStore: null,
                priceListStore: null,
                toastStore: null,
                actionLoaderStore: null,
                actions: [
                    {
                        label: 'Edit',
                        icon: 'pencil',
                        dispatch: function (data) {
                            this.onEdit(data)
                        }
                    },
                    {
                        label: 'Delete',
                        icon: 'trash',
                        dispatch: function (data) {
                            this.onDelete(data)
                        }
                    },
                    {
                        label: 'Pricing',
                        icon: 'circle-dollar-sign',
                        dispatch: function (data) {
                            this.onPriceList(data);
                        }
                    },
                ],
                init: function () {
                    const componentID = document.querySelector('[data-component-id="table-item"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                            this.formStore = Alpine.store('itemFormStore');
                            this.priceListStore = Alpine.store('priceListStore');
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.actionLoaderStore = Alpine.store('gxuiActionLoader');
                            this.actions.forEach((action, key) => {
                                action.dispatch = action.dispatch.bind(this);
                            });
                        }
                    })
                },
                onFindAll() {
                    this.loading = true;
                    this.component.$wire.call('findAll', this.param, this.page, this.perPage)
                        .then(response => {
                            const {success, data, meta} = response;
                            if (success) {
                                this.data = data;
                                const totalRows = meta['pagination'] ? meta['pagination']['total_rows'] : 0;
                                const page = meta['pagination'] ? meta['pagination']['page'] : 1;
                                this.totalRows = totalRows;
                                this.page = page;
                            } else {
                                this.toastStore.failed('failed to load item data');
                            }
                        }).finally(() => {
                        this.loading = false;
                    })
                },
                onDelete(data) {
                    const id = data['id'];
                    this.actionLoaderStore.start('Deleting Process...');
                    this.component.$wire.call('delete', id)
                        .then(response => {
                            const {success, message} = response;
                            if (success) {
                                this.toastStore.success(message);
                                this.onFindAll();
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.actionLoaderStore.end();
                    })
                },
                onEdit(data) {
                    const id = data['id'];
                    this.actionLoaderStore.start('Find Item Process...');
                    this.component.$wire.call('findByID', id)
                        .then(response => {
                            const {success, data, message} = response;
                            if (success) {
                                this.formStore.hydrateForm(data);
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.actionLoaderStore.end();
                    })
                },
                onPriceList(data) {
                    const id = data['id'];
                    this.actionLoaderStore.start('Find Item Process...');
                    this.component.$wire.call('findByID', id)
                        .then(response => {
                            const {success, data, message} = response;
                            if (success) {
                                this.priceListStore.hydrateForm(data);
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.actionLoaderStore.end();
                    })
                }
            };
            const PROPS = Object.assign({}, window.TableStore, COMPONENT_PROPS);
            Alpine.store('itemTableStore', PROPS);
        });
    </script>
@endpush
