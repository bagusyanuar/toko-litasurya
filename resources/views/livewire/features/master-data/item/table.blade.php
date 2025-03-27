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
                    class="w-[140px]"
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
                <x-gxui.table.dynamic.collapsible-row>
                    <x-gxui.table.dynamic.td
                        class="w-[140px]"
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
                        <span
                            x-text="data.retail_price?.price.toLocaleString('id-ID') ?? '-'"
                            class="cursor-pointer transition-all ease-in duration-300 hover:underline"
                            x-on:click="toggleOpen()"
                        ></span>
                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td
                        contentClass="justify-center"
                        class="w-[50px]"
                    >
                        <x-gxui.table.dynamic.action store="itemTableStore"></x-gxui.table.dynamic.action>
                    </x-gxui.table.dynamic.td>
                    <x-slot name="collapsible">
                        <div class="w-full flex items-start border-b">
                            <x-gxui.table.dynamic.td
                                contentClass="justify-center"
                                class="w-[140px]"
                            ></x-gxui.table.dynamic.td>
                            <x-gxui.table.dynamic.td
                                class="flex-1 min-w-[120px]"
                            >
                                <div class="w-full">
                                    <template x-for="(unit, idx) in $store.itemTableStore.units" :key="idx">
                                        <div
                                            class="w-full flex items-center gap-3 py-1.5 border-b last:border-b-0 text-neutral-700">
                                            <div class="w-[80px] flex items-center justify-between text-xs">
                                                <span x-text="unit.label"></span>
                                                <span>:</span>
                                            </div>
                                            <div class="flex-1 flex items-center gap-2">
                                                <x-gxui.input.text.text
                                                    placeholder="PLU"
                                                    parentClassName="w-full"
                                                    x-model="$store.itemTableStore.prices[index].prices[idx].plu"
                                                ></x-gxui.input.text.text>
                                                <x-gxui.input.text.text
                                                    placeholder="Price"
                                                    parentClassName="w-full"
                                                    x-model="$store.itemTableStore.prices[index].prices[idx].price"
                                                    x-mask:dynamic="$money($input, ',')"
                                                ></x-gxui.input.text.text>
                                            </div>
                                        </div>
                                    </template>
                                    <div class="w-full flex justify-end mt-1">
                                        <x-gxui.button.button
                                            wire:ignore
                                            x-on:click="$store.itemTableStore.updatePrice(data.id)"
                                            class="!px-6"
                                            x-bind:disabled="$store.itemTableStore.loading"
                                        >
                                            <template x-if="!$store.itemTableStore.loading">
                                                <div
                                                    class="w-full flex justify-center items-center gap-1 text-xs">
                                                    <span>Submit</span>
                                                </div>
                                            </template>
                                            <template x-if="$store.itemTableStore.loading">
                                                <x-gxui.loader.button-loader></x-gxui.loader.button-loader>
                                            </template>
                                        </x-gxui.button.button>
                                    </div>
                                </div>
                            </x-gxui.table.dynamic.td>
                        </div>
                    </x-slot>
                </x-gxui.table.dynamic.collapsible-row>
            </x-slot>
        </x-gxui.table.dynamic.table>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const AVAILABLE_UNITS = [
                {key: 'retail', label: 'Retail'},
                {key: 'dozen', label: 'Dozen'},
                {key: 'carton', label: 'Carton'},
                {key: 'trader', label: 'Trader'}
            ];
            const COMPONENT_PROPS = {
                component: null,
                formStore: null,
                priceListStore: null,
                toastStore: null,
                actionLoaderStore: null,
                units: [...AVAILABLE_UNITS],
                prices: [],
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
                            console.log(data);
                            if (success) {
                                this.data = data;
                                const totalRows = meta['pagination'] ? meta['pagination']['total_rows'] : 0;
                                const page = meta['pagination'] ? meta['pagination']['page'] : 1;
                                this.totalRows = totalRows;
                                this.page = page;
                                this._generatePrices();
                            } else {
                                this.toastStore.failed('failed to load item data');
                            }
                        }).finally(() => {
                        this.loading = false;
                    })
                },
                _generatePrices() {
                    this.data.forEach((item, key) => {
                        const prices = item['prices'];
                        const itemID = item['id'];
                        let arrPrices = [];
                        this.units.forEach((unit, kUnit) => {
                            let tmpPrice = {
                                item_price_id: '',
                                unit: unit.key,
                                plu: '',
                                price: 0
                            };
                            const singlePrice = prices.find((p) => p.unit === unit.key);
                            if (singlePrice) {
                                tmpPrice.item_price_id = singlePrice['id'];
                                tmpPrice.plu = singlePrice['price_list_unit'];
                                tmpPrice.price = singlePrice['price']
                            }
                            arrPrices.push(tmpPrice);
                        });
                        this.prices.push({
                            item_id: itemID,
                            prices: arrPrices
                        });
                    });
                },
                updatePrice(itemID) {
                    const selectedPrice = this.prices.find((p) => p.item_id === itemID);
                    if (selectedPrice) {
                        this.component.$wire.call('updatePrice', selectedPrice)
                            .then(response => {
                                const {success, message} = response;
                                console.log(response);
                                // if (success) {
                                //     this.toastStore.success(message);
                                //     this.onFindAll();
                                // } else {
                                //     this.toastStore.failed(message);
                                // }
                            }).finally(() => {
                            this.actionLoaderStore.end();
                        })
                    }
                    console.log(selectedPrice);
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
