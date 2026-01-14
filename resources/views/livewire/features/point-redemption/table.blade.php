<section id="section-table-point-redemption" data-component-id="table-point-redemption">
    <div class="w-full flex items-center justify-between mb-3" x-data="{
        initIcons() {
            setTimeout(() => { lucide.createIcons(); }, 0);
        }
    }" x-init="initIcons()"
        x-effect="initIcons()">
        <p class="text-neutral-700 font-semibold">Data Penukaran Hadiah</p>
        <div class="flex items-center gap-3">
            <x-gxui.button.button wire:ignore x-on:click="$store.pointRedemptionFormStore.showModal()">
                <div class="w-full flex justify-center items-center gap-1 text-xs">
                    <i data-lucide="plus" class="h-3" style="width: fit-content;"></i>
                    <span>New</span>
                </div>
            </x-gxui.button.button>
        </div>
    </div>
    <x-gxui.table.dynamic.table store="pointRedemptionTableStore" dispatcher="onFindAll" pagination="true">
        <x-slot name="header">
            <x-gxui.table.dynamic.th contentClass="justify-center" class="w-[100px]">
                <span>Date</span>
            </x-gxui.table.dynamic.th>
            <x-gxui.table.dynamic.th class="flex-1 min-w-[150px]">
                <span>Customer</span>
            </x-gxui.table.dynamic.th>
            <x-gxui.table.dynamic.th contentClass="justify-center" class="w-[170px]">
                <span>Hadiah</span>
            </x-gxui.table.dynamic.th>
            <x-gxui.table.dynamic.th contentClass="justify-center" class="w-[120px]">
                <span>Total Point</span>
            </x-gxui.table.dynamic.th>
        </x-slot>
        <x-slot name="rows">
            <x-gxui.table.dynamic.row>
                <x-gxui.table.dynamic.td contentClass="justify-center" class="w-[100px]">
                    <span x-text="data.date"></span>
                </x-gxui.table.dynamic.td>
                <x-gxui.table.dynamic.td class="flex-1 min-w-[150px]">
                    <span x-text="data.customer.name"></span>
                </x-gxui.table.dynamic.td>
                <x-gxui.table.dynamic.td contentClass="justify-center" class="w-[170px]">
                    <span x-text="data.reward.name"></span>
                </x-gxui.table.dynamic.td>
                <x-gxui.table.dynamic.td contentClass="justify-center" class="w-[120px]">
                    <span x-text="data.point_used.toLocaleString('id-ID')"></span>
                </x-gxui.table.dynamic.td>
            </x-gxui.table.dynamic.row>
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
                actions: [{
                        label: 'Process',
                        icon: 'send',
                        dispatch: function(data) {
                            this.onProcess(data)
                        }
                    },
                    {
                        label: 'Cancel',
                        icon: 'undo-2',
                        dispatch: function(data) {
                            // this.onDelete(data)
                        }
                    },
                ],
                init: function() {
                    Livewire.hook('component.init', ({
                        component
                    }) => {
                        const componentID = document.querySelector(
                            '[data-component-id="table-point-redemption"]')?.getAttribute(
                            'wire:id');
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
                        page: this.currentPage,
                        per_page: this.perPage,
                        store: this.store,
                        sales: this.sales,
                        dateStart: this.dateStart,
                        dateEnd: this.dateEnd,
                    };
                    this.component.$wire.call('findAll', query)
                        .then(response => {
                            const {
                                success,
                                data,
                                meta,
                                message
                            } = response;
                            if (success) {
                                this.data = data;
                                const totalRows = meta['pagination'] ? meta['pagination']['total_rows'] : 0;
                                const page = meta['pagination'] ? meta['pagination']['page'] : 1;
                                this.totalRows = totalRows;
                                this.currentPage = page;
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
                            const {
                                success,
                                data,
                                message
                            } = response;
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
                    this.transactionStore.showLoading('processing point redemption...');
                    this.component.$wire.call('findByID', id)
                        .then(response => {
                            const {
                                success,
                                data,
                                message
                            } = response;
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
            Alpine.store('pointRedemptionTableStore', props);
        });
    </script>
@endpush
