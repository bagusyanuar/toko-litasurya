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
                class="!rounded !px-1.5"
            >
                <div wire:ignore>
                    <i data-lucide="filter"
                       class="text-white h-3 aspect-[1/1]"></i>
                </div>
            </x-gxui.button.button>
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
                            <div class="w-full rounded-lg border border-neutral-300 overflow-x-auto">
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
                                <template x-for="(cart, index) in data.carts" :key="index">
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
                                            <span x-text="cart.qty.toLocaleString('id-ID')"></span>
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

                        </div>
                        <x-gxui.table.dynamic.td
                            class="w-[120px]"
                        ></x-gxui.table.dynamic.td>
                    </div>
                </x-slot>
            </x-gxui.table.dynamic.collapsible-row>
        </x-slot>
    </x-gxui.table.dynamic.table>
{{--    <x-gxui.table.table--}}
{{--        class="mb-1"--}}
{{--        store="purchasingTableStore"--}}
{{--    >--}}
{{--        <x-slot name="header">--}}
{{--            <x-gxui.table.th--}}
{{--                title="Date"--}}
{{--                className="w-[100px]"--}}
{{--            ></x-gxui.table.th>--}}
{{--            <x-gxui.table.th--}}
{{--                title="Store"--}}
{{--                className="min-w-[120px]"--}}
{{--            ></x-gxui.table.th>--}}
{{--            <x-gxui.table.th--}}
{{--                title="Sales"--}}
{{--                className="min-w-[150px]"--}}
{{--                align="left"--}}
{{--            ></x-gxui.table.th>--}}
{{--            <x-gxui.table.th--}}
{{--                title="Total"--}}
{{--                className="w-[100px]"--}}
{{--                align="right"--}}
{{--            ></x-gxui.table.th>--}}
{{--            <x-gxui.table.th--}}
{{--                title="Action"--}}
{{--                className="w-[80px]"--}}
{{--            ></x-gxui.table.th>--}}
{{--        </x-slot>--}}
{{--        <x-slot name="rows">--}}
{{--            <tr class="border-b border-neutral-300">--}}
{{--                <x-gxui.table.td className="flex justify-center">--}}
{{--                    <span x-text="data.date"></span>--}}
{{--                </x-gxui.table.td>--}}
{{--                <x-gxui.table.td className="flex justify-center">--}}
{{--                    <span x-text="data.customer.name"></span>--}}
{{--                </x-gxui.table.td>--}}
{{--                <x-gxui.table.td>--}}
{{--                    <span x-text="data.user.sales.name"></span>--}}
{{--                </x-gxui.table.td>--}}
{{--                <x-gxui.table.td className="flex justify-end">--}}
{{--                    <span x-text="data.total.toLocaleString('id-ID')"></span>--}}
{{--                </x-gxui.table.td>--}}
{{--                <x-gxui.table.td className="flex justify-center relative">--}}
{{--                    <x-gxui.table.action store="purchasingTableStore"></x-gxui.table.action>--}}
{{--                </x-gxui.table.td>--}}
{{--            </tr>--}}
{{--        </x-slot>--}}
{{--    </x-gxui.table.table>--}}
{{--    <x-gxui.table.pagination--}}
{{--        store="purchasingTableStore"--}}
{{--        dispatcher="onFindAll"--}}
{{--    ></x-gxui.table.pagination>--}}
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const componentProps = {
                component: null,
                filterStore: null,
                toastStore: null,
                transactionStore: null,
                store: '',
                sales: '',
                dateStart: '',
                dateEnd: '',
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
                    this.dateStart = q['dateStart'];
                    this.dateEnd = q['dateEnd'];
                    this.onFindAll();
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
