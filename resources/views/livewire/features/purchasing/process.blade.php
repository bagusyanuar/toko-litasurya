<section
    id="section-process-purchasing"
    data-component-id="process-purchasing"
>
    <x-gxui.modal.form
        show="$store.processPurchasingStore.showModal"
        {{--        show="true"--}}
        width="80%"
    >
        <div
            class="modal-header flex items-center justify-between px-4 py-3 border-b border-neutral-300 rounded-t">
            <span class="text-neutral-700 font-semibold">Data Purchasing</span>
            <button
                type="button"
                x-on:click="$store.processPurchasingStore.close()"
                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-4 h-4 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            >
                <svg class="w-2 h-2" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <div class="modal-body p-6 overflow-y-scroll flex-grow-1">
            <div class="flex items-center gap-3 text-sm mb-1 w-full">
                <div class="w-full flex items-center gap-1">
                    <div class="flex justify-between items-center w-[20%] font-bold">
                        <p class="text-neutral-700">Invoice ID</p>
                        <p class="text-neutral-700">:</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-neutral-700"
                           x-text="$store.processPurchasingStore.transactionInfo.invoiceID"></p>
                    </div>
                </div>
                <div class="w-full flex items-center gap-1">
                    <div class="flex justify-between items-center w-[20%] font-bold">
                        <p class="text-neutral-700">Date</p>
                        <p class="text-neutral-700">:</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-neutral-700" x-text="$store.processPurchasingStore.transactionInfo.date"></p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 text-sm mb-1 w-full">
                <div class="w-full flex items-center gap-1">
                    <div class="flex justify-between items-center w-[20%] font-bold">
                        <p class="text-neutral-700">Store</p>
                        <p class="text-neutral-700">:</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-neutral-700" x-text="$store.processPurchasingStore.transactionInfo.customer"></p>
                    </div>
                </div>
                <div class="w-full flex items-center gap-1">
                    <div class="flex justify-between items-center w-[20%] font-bold">
                        <p class="text-neutral-700">Sales</p>
                        <p class="text-neutral-700">:</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-neutral-700" x-text="$store.processPurchasingStore.transactionInfo.sales"></p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 text-sm mb-1 w-full">
                <div class="w-full flex items-center gap-1">
                    <div class="flex justify-between items-center w-[20%] font-bold">
                        <p class="text-neutral-700">Status</p>
                        <p class="text-neutral-700">:</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-neutral-700" x-text="$store.processPurchasingStore.transactionInfo.sales"></p>
                    </div>
                </div>
                <div class="w-full flex items-center gap-1">
                </div>
            </div>
            <hr class="mb-3"/>
            <div class="">
                <x-gxui.table.table
                    class="mb-1"
                    store="processPurchasingStore"
                >
                    <x-slot name="header">
                        <x-gxui.table.th
                            title="Product"
                            align="left"
                            className="min-w-[150px] !text-sm"
                        ></x-gxui.table.th>
                        <x-gxui.table.th
                            title="Unit"
                            className="w-[80px]"
                        ></x-gxui.table.th>
                        <x-gxui.table.th
                            title="Price (Rp.)"
                            className="!w-[80px]"
                            align="right"
                        ></x-gxui.table.th>
                        <x-gxui.table.th
                            title="Requested Qty"
                            className="!w-[90px]"
                        ></x-gxui.table.th>
                        <x-gxui.table.th
                            title="Qty"
                            className="!w-[90px]"
                        ></x-gxui.table.th>
                        <x-gxui.table.th
                            title="Total (Rp.)"
                            className="!w-[80px]"
                            align="right"
                        ></x-gxui.table.th>
                    </x-slot>
                    <x-slot name="rows">
                        <tr class="border-b border-neutral-300">
                            <x-gxui.table.td className="min-w-[200px]">
                                <span class="text-sm font-bold text-neutral-900" x-text="data.name"></span>
                            </x-gxui.table.td>
                            <x-gxui.table.td className="flex justify-center">
                                <span x-text="data.unit"></span>
                            </x-gxui.table.td>
                            <x-gxui.table.td className="flex justify-end">
                                <span x-text="data.price.toLocaleString('id-ID') ?? '-'"></span>
                            </x-gxui.table.td>
                            <x-gxui.table.td className="flex justify-end">
                                <span x-text="data.request_qty.toLocaleString('id-ID') ?? '-'"></span>
                            </x-gxui.table.td>
                            <x-gxui.table.td className="flex justify-center">
                                <div x-data="{error: false}">
                                    <input
                                        class="w-10 px-1 py-1 text-xs text-center rounded text-neutral-700 border border-neutral-300 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 transition duration-300 ease-in"
                                        x-model="data.qty"
                                        x-on:input="
                                $store.processPurchasingStore.updateCart(data.id, $event.target.value);
                                error = $event.target.value.trim() === '';
                            "
                                        :class="error ? 'border-red-500 focus:border-red-500' : 'border-neutral-300 focus:border-neutral-500'"
                                    />
                                </div>
                            </x-gxui.table.td>
                            <x-gxui.table.td className="flex justify-end">
                                <span x-text="data.total.toLocaleString('id-ID') ?? '-'"></span>
                            </x-gxui.table.td>

                        </tr>
                    </x-slot>
                </x-gxui.table.table>
                <div class="w-full flex justify-end">
                    <div class="flex items-center text-xl gap-3">
                        <div class="flex justify-between w-20">
                            <p class="text-neutral-700 font-bold">Total</p>
                            <p class="text-neutral-700 font-bold">:</p>
                        </div>
                        <div class="w-24 text-end">
                            <p class="text-neutral-700 font-bold"
                               x-text="$store.processPurchasingStore.total.toLocaleString('id-ID')">10.000</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div
            class="modal-footer w-full w-full flex items-center justify-end gap-2 px-4 py-3 border-t border-neutral-300"
        >
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.processPurchasingStore.setCloseModalForm()"
                x-bind:disabled="$store.processPurchasingStore.loading"
                class="!px-6 bg-white !border-brand-500 !text-brand-500 hover:!text-white disabled:!bg-white disabled:!text-brand-500"
            >
                <div class="w-full flex justify-center items-center gap-1 text-sm">
                    <span>Cancel</span>
                </div>
            </x-gxui.button.button>
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.processPurchasingStore.submitOrder()"
                class="!px-6"
                x-bind:disabled="$store.processPurchasingStore.loadingOrder"
            >
                <template x-if="!$store.processPurchasingStore.loadingOrder">
                    <div class="w-full flex justify-center items-center gap-1 text-sm">
                        <span>Place Order</span>
                    </div>
                </template>
                <template x-if="$store.processPurchasingStore.loadingOrder">
                    <x-gxui.loader.button-loader></x-gxui.loader.button-loader>
                </template>
            </x-gxui.button.button>
        </div>
    </x-gxui.modal.form>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const INITIAL_TRANSACTION_INFO = {
                invoiceID: '-',
                customer: '-',
                sales: '-',
                date: '-',
                status: 'pending'
            };
            const STORE_PROPS = {
                showModal: false,
                transactionInfo: {...INITIAL_TRANSACTION_INFO},
                data: [],
                loading: false,
                loadingOrder: false,
                total: 0,
                toastStore: null,
                tableStore: null,
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="process-purchasing"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.tableStore = Alpine.store('purchasingTableStore');
                        }
                    });
                },
                show() {
                    this.showModal = true;
                },
                close() {
                    this.showModal = false;
                },
                hydrateForm(item) {
                    this.transactionInfo = {
                        invoiceID: item['reference_number'],
                        customer: item['customer']['name'],
                        sales: item['user']['sales']['name'],
                        date: item['date'],
                        status: item['status']
                    };
                    const carts = item['carts'];
                    this.data = carts.map((v, k) => {
                        return {
                            id: v['id'],
                            item_id: v['item']['id'],
                            name: v['item']['name'],
                            price: v['price'],
                            request_qty: v['request_qty'],
                            qty: v['qty'],
                            unit: v['unit'],
                            total: v['total'],
                            user_id: v['user_id'],
                            transaction_id: v['transaction_id'],
                            customer_id: v['customer_id']
                        }
                    });
                    this._setTotal();
                    this._updateStorageCart();
                    this.showModal = true;
                },
                submitOrder() {
                    this.loadingOrder = true;
                    this.component.$wire.call('order', this.transactionInfo.invoiceID, this.data)
                        .then(response => {
                            const {success, message, data} = response;
                            if (success) {
                                this.toastStore.success(message);
                                this.showModal = false;
                                this.tableStore.onFindAll();
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                            this.loadingOrder = false;
                    })
                },
                updateCart(id, qty) {
                    const item = this.data.find(item => item.id === id);
                    if (item) {
                        item.qty = qty;
                        let intQty = qty.trim() === '' ? 0 : qty;
                        item.total = intQty * item.price;
                    }
                    this._setTotal();
                    this._updateStorageCart();
                },
                _getStorageCart() {
                    const storage = JSON.parse(localStorage.getItem('purchase_cart') ?? '[]');
                    return Array.isArray(storage) ? storage : [];
                },
                _updateStorageCart() {
                    localStorage.setItem('purchase_cart', JSON.stringify(this.data));
                },
                _getTotal() {
                    return this.data.reduce((sum, item) => sum + item.total, 0);
                },
                _setTotal() {
                    this.total = this._getTotal();
                },
            };
            Alpine.store('processPurchasingStore', STORE_PROPS);
        });
    </script>
@endpush
