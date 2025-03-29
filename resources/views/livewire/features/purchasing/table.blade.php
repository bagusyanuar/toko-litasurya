<section
    id="section-table-purchasing"
    data-component-id="table-purchasing"
>
    <div class="w-full flex items-center justify-between mb-3">
        <p class="text-neutral-700 font-semibold">Purchasing Data</p>
        <div class="flex items-center gap-1">
            <div class="flex items-center justify-between gap-1">
                <x-gxui.input.date.datepicker
                    id="filterPurchasingDateStart"
                    store="purchasingTableStore"
                    placeholder="dd/mm/yyyy"
                    class="!w-[120px]"
                    x-model="$store.purchasingTableStore.dateStart"
                    x-init="initDatepicker({format: 'dd/mm/yyyy'})"
                    dispatcher="onDateChange"
                ></x-gxui.input.date.datepicker>
                <span class="text-sm text-neutral-700">-</span>
                <x-gxui.input.date.datepicker
                    id="filterPurchasingDateEnd"
                    store="purchasingTableStore"
                    placeholder="dd/mm/yyyy"
                    class="!w-[120px]"
                    x-model="$store.purchasingTableStore.dateEnd"
                    x-init="initDatepicker({format: 'dd/mm/yyyy'})"
                    dispatcher="onDateChange"
                ></x-gxui.input.date.datepicker>
            </div>
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.filterPurchasingStore.show()"
                class="!rounded !px-1.5"
            >
                <div wire:ignore>
                    <i data-lucide="filter"
                       class="text-white h-3 aspect-[1/1]"></i>
                </div>
            </x-gxui.button.button>
            <div x-data="{ open: false }" class="relative">
                <x-gxui.button.button
                    wire:ignore
                    x-on:click="open = true"
                    class="!rounded !px-1.5 bg-white !border-brand-500 !text-brand-500 hover:!bg-white"
                >
                    <div wire:ignore>
                        <i data-lucide="settings"
                           class="text-brand-500 h-3 aspect-[1/1]"></i>
                    </div>
                </x-gxui.button.button>
                <div
                    x-show="open"
                    class="absolute right-0 bottom-[-6.5rem] transform"
                    x-on:click.away="open = false;"
                    x-cloak
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="translate-y-[-100%] opacity-0"
                    x-transition:enter-end="translate-y-0 opacity-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="translate-y-0 opacity-100"
                    x-transition:leave-end="translate-y-[-100%] opacity-0"
                >
                    <div
                        class="w-44 px-1 py-1 bg-white rounded shadow-md text-sm text-neutral-700"
                    >
                        <div
                            class="rounded px-3 py-1.5 flex items-center gap-1 cursor-pointer hover:bg-neutral-100 transition-all ease-in duration-200"
                            x-on:click="open = false; $store.purchasingTableStore.onFindAll()"
                        >
                            <div wire:ignore>
                                <i data-lucide="refresh-cw"
                                   class="text-neutral-700 h-4 aspect-[1/1]"></i>
                            </div>
                            <span class="text-xs text-neutral-700">Refresh</span>
                        </div>
                        <div
                            class="rounded px-3 py-1.5 flex items-center gap-1 cursor-pointer hover:bg-neutral-100 transition-all ease-in duration-200"
                            x-on:click=""
                        >
                            <div wire:ignore>
                                <i data-lucide="file"
                                   class="text-neutral-700 h-4 aspect-[1/1]"></i>
                            </div>
                            <span class="text-xs text-neutral-700">Export as PDF</span>
                        </div>
                        <div
                            class="rounded px-3 py-1.5 flex items-center gap-1 cursor-pointer hover:bg-neutral-100 transition-all ease-in duration-200"
                            x-on:click=""
                        >
                            <div wire:ignore>
                                <i data-lucide="file-spreadsheet"
                                   class="text-neutral-700 h-4 aspect-[1/1]"></i>
                            </div>
                            <span class="text-xs text-neutral-700">Export as Excel</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-gxui.table.dynamic.table
        store="purchasingTableStore"
        dispatcher="onFindAll"
        statePerPageOptions="perPageOptions"
        pagination="true"
    >
        <x-slot name="header">
            <x-gxui.table.dynamic.th
                contentClass="justify-center"
                class="w-[40px]"
            ></x-gxui.table.dynamic.th>
            <x-gxui.table.dynamic.th
                contentClass="justify-center"
                class="w-[100px]"
            >
                <span>Date</span>
            </x-gxui.table.dynamic.th>
            <x-gxui.table.dynamic.th
                contentClass="justify-center"
                class="w-[170px]"
            >
                <span>Invoice ID</span>
            </x-gxui.table.dynamic.th>
            <x-gxui.table.dynamic.th
                class="flex-1 min-w-[150px]"
            >
                <span>Store</span>
            </x-gxui.table.dynamic.th>
            <x-gxui.table.dynamic.th
                class="flex-1 min-w-[150px]"
            >
                <span>Sales</span>
            </x-gxui.table.dynamic.th>
            <x-gxui.table.dynamic.th
                contentClass="justify-end"
                class="w-[120px]"
            >
                <span>Total (Rp.)</span>
            </x-gxui.table.dynamic.th>
        </x-slot>
        <x-slot name="rows">
            <x-gxui.table.dynamic.collapsible-row>
                <x-gxui.table.dynamic.td
                    contentClass="justify-center"
                    class="w-[40px]"
                >
                    <div
                        wire:ignore
                        @click="toggleOpen"
                        class="flex items-center justify-center p-1 cursor-pointer hover:bg-neutral-100 transition-all ease-in duration-200"
                    >
                        <i x-bind:data-lucide="isOpen ? 'chevron-up' : 'chevron-down'"
                           class="text-neutral-700 h-3 aspect-[1/1]"></i>
                    </div>
                </x-gxui.table.dynamic.td>
                <x-gxui.table.dynamic.td
                    contentClass="justify-center"
                    class="w-[100px]"
                >
                    <span
                        x-text="new Date(data.date).toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' })">
                    </span>
                </x-gxui.table.dynamic.td>
                <x-gxui.table.dynamic.td
                    contentClass="justify-center"
                    class="w-[170px]"
                >
                    <span x-text="data.reference_number"></span>
                </x-gxui.table.dynamic.td>
                <x-gxui.table.dynamic.td
                    class="flex-1 min-w-[150px]"
                >
                    <span x-text="data.customer ? data.customer?.name : '-'"></span>
                </x-gxui.table.dynamic.td>
                <x-gxui.table.dynamic.td
                    class="flex-1 min-w-[150px]"
                >
                   <span
                       x-text="data.user?.sales ? data.user?.sales?.name : '-'"
                       class="capitalize"
                   ></span>
                </x-gxui.table.dynamic.td>
                <x-gxui.table.dynamic.td
                    contentClass="justify-end"
                    class="w-[120px]"
                >
                    <span x-text="data.total.toLocaleString('id-ID')"></span>
                </x-gxui.table.dynamic.td>
                <x-slot name="collapsible">
                    <div class="w-full flex items-start border-b">
                        <x-gxui.table.dynamic.td
                            contentClass="justify-center"
                            class="w-[40px]"
                        ></x-gxui.table.dynamic.td>
                        <div class="py-3 px-2.5 flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-xs text-neutral-700 font-semibold mb-1">Cart List</p>
                                <div
                                    class="flex items-center gap-1"
                                    x-show="data.user?.sales !== null"
                                >
                                    <span class="text-xs text-neutral-700">Sales :</span>
                                    <span
                                        class="text-xs font-semibold text-neutral-700"
                                        x-text="data.user?.sales !== null ? data.user?.sales.name : '-' "
                                    >Team Sales</span>
                                </div>
                            </div>
                            <div class="w-full rounded-lg border border-neutral-300 overflow-x-auto mb-3">
                                <div class="flex items-center bg-brand-50 w-full text-xs">
                                    <x-gxui.table.dynamic.th
                                        class="flex-1 min-w-[150px]"
                                    >
                                        <span>Product</span>
                                    </x-gxui.table.dynamic.th>
                                    <x-gxui.table.dynamic.th
                                        contentClass="justify-center"
                                        class="w-[80px]"
                                    >
                                        <span>Qty</span>
                                    </x-gxui.table.dynamic.th>
                                    <x-gxui.table.dynamic.th
                                        contentClass="justify-center"
                                        class="w-[80px]"
                                    >
                                        <span>Unit</span>
                                    </x-gxui.table.dynamic.th>
                                    <x-gxui.table.dynamic.th
                                        contentClass="justify-end"
                                        class="w-[120px]"
                                    >
                                        <span>Price (Rp)</span>
                                    </x-gxui.table.dynamic.th>
                                    <x-gxui.table.dynamic.th
                                        contentClass="justify-end"
                                        class="w-[120px]"
                                    >
                                        <span>Total (Rp)</span>
                                    </x-gxui.table.dynamic.th>
                                </div>
                                <template x-for="(cart, idxCart) in data.carts" :key="idxCart">
                                    <div
                                        class="w-full flex items-center text-xs text-neutral-700 border-b last:border-b-0"
                                    >
                                        <x-gxui.table.dynamic.td
                                            class="flex-1 min-w-[150px]"
                                        >
                                            <span x-text="cart.item.name"></span>
                                        </x-gxui.table.dynamic.td>
                                        <x-gxui.table.dynamic.td
                                            contentClass="justify-center"
                                            class="w-[80px]"
                                        >
                                            <div x-data="{error: false}">
                                                <input
                                                    class="w-10 px-1 py-1 text-xs text-center rounded text-neutral-700 border border-neutral-300 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 transition duration-300 ease-in"
                                                    x-model="cart.qty"
                                                    x-on:input="
                                                    $store.purchasingTableStore.updateCart(data.id, cart.id, $event.target.value);
                                                    error = $event.target.value.trim() === '';"
                                                    :class="error ? 'border-red-500 focus:border-red-500' : 'border-neutral-300 focus:border-neutral-500'"
                                                />
                                            </div>
                                        </x-gxui.table.dynamic.td>
                                        <x-gxui.table.dynamic.td
                                            contentClass="justify-center"
                                            class="w-[80px]"
                                        >
                                            <span x-text="cart.unit" class="capitalize"></span>
                                        </x-gxui.table.dynamic.td>
                                        <x-gxui.table.dynamic.td
                                            contentClass="justify-end"
                                            class="w-[120px]"
                                        >
                                            <span x-text="cart.price.toLocaleString('id-ID')"></span>
                                        </x-gxui.table.dynamic.td>
                                        <x-gxui.table.dynamic.td
                                            contentClass="justify-end"
                                            class="w-[120px]"
                                        >
                                            <span x-text="cart.total.toLocaleString('id-ID')"></span>
                                        </x-gxui.table.dynamic.td>
                                    </div>
                                </template>
                            </div>
                            <div class="w-full flex justify-end">
                                <x-gxui.button.button
                                    wire:ignore
                                    x-on:click="$store.purchasingTableStore.onSubmitPurchase(data, index)"
                                    x-bind:disabled="$store.purchasingTableStore.loadingSubmit"
                                    class="!px-6"
                                >
                                    <template x-if="!$store.purchasingTableStore.loadingSubmit">
                                        <div class="w-full flex justify-center items-center gap-1 text-xs">
                                            <span>Submit</span>
                                        </div>
                                    </template>
                                    <template x-if="$store.purchasingTableStore.loadingSubmit">
                                        <x-gxui.loader.button-loader></x-gxui.loader.button-loader>
                                    </template>
                                </x-gxui.button.button>
                            </div>
                        </div>
                    </div>

                </x-slot>
            </x-gxui.table.dynamic.collapsible-row>
        </x-slot>
    </x-gxui.table.dynamic.table>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const today = new Date().toLocaleDateString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
            const componentProps = {
                component: null,
                filterStore: null,
                toastStore: null,
                transactionStore: null,
                store: '',
                sales: '',
                dateStart: today,
                dateEnd: today,
                loadingSubmit: false,
                actions: [
                    {
                        label: 'Process',
                        icon: 'send',
                        dispatch: function (data) {
                            this.onProcess(data)
                        }
                    },
                    {
                        label: 'Cancel',
                        icon: 'undo-2',
                        dispatch: function (data) {
                            // this.onDelete(data)
                        }
                    },
                ],
                init: function () {
                    const componentID = document.querySelector('[data-component-id="table-purchasing"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                            this.filterStore = Alpine.store('filterPurchasingStore');
                            this.transactionStore = Alpine.store('transactionStore');
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.actions.forEach((action, key) => {
                                action.dispatch = action.dispatch.bind(this);
                            });
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
                            const {success, data, meta, message} = response;
                            if (success) {
                                this.data = data;
                                const totalRows = meta['pagination'] ? meta['pagination']['total_rows'] : 0;
                                const page = meta['pagination'] ? meta['pagination']['page'] : 1;
                                this.totalRows = totalRows;
                                this.page = page;
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.loading = false;
                    })
                },
                hydrateQuery(q) {
                    this.store = q['store'];
                    this.sales = q['sales'];
                    this.onFindAll();
                },
                updateCart(id, cartID, qty) {
                    let purchaseItem = this.data.find(purchase => purchase.id === id);
                    if (purchaseItem) {
                        let carts = purchaseItem['carts'];
                        let selectedCart = carts.find(cart => cart.id === cartID);
                        if (selectedCart) {
                            selectedCart.qty = qty;
                            let intQty = qty.trim() === '' ? 0 : qty;
                            selectedCart.total = intQty * selectedCart.price;
                            purchaseItem.total = carts.reduce((sum, c) => sum + c.total, 0);
                        }
                    }
                },
                onDateChange() {
                    this.onFindAll();
                },
                onSubmitPurchase(data, index) {
                    const id = data['id'];
                    this.loadingSubmit = true;
                    const carts = this.data[index].carts;
                    const form = {
                        id: id,
                        carts: carts
                    };
                    this.component.$wire.call('submitPurchase', form)
                        .then(response => {
                            const {success, data, message} = response;
                            if (success) {
                                this.onFindAll();
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.loadingSubmit = false;
                    })
                },
                onProcess(data) {
                    const id = data['id'];
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
            };
            const props = Object.assign({}, window.TableStore, componentProps);
            Alpine.store('purchasingTableStore', props);
        });
    </script>
@endpush
