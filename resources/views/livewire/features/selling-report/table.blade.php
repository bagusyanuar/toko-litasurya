<section
    id="section-table-selling-report"
    data-component-id="table-selling-report"
>
    <div class="w-full flex items-center justify-between mb-3">
        <p class="text-neutral-700 font-semibold">Selling Report Data</p>
        <div class="flex items-center gap-1">
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.filterSellingReportStore.show()"
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
                        <i data-lucide="download"
                           class="text-brand-500 h-3 aspect-[1/1]"></i>
                    </div>
                </x-gxui.button.button>
                <div
                    x-show="open"
                    class="absolute right-0 bottom-[-4.5rem] transform"
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
        store="sellingReportTableStore"
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
                class="flex-1 min-w-[200px]"
            >
                <span>Customer</span>
            </x-gxui.table.dynamic.th>
            <x-gxui.table.dynamic.th
                contentClass="justify-center"
                class="w-[80px]"
            >
                <span>Type</span>
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
                    class="flex-1 min-w-[200px]"
                >
                    <span x-text="data.customer ? data.customer?.name : '-'"></span>
                </x-gxui.table.dynamic.td>
                <x-gxui.table.dynamic.td
                    contentClass="justify-center"
                    class="w-[80px]"
                >
                   <span
                       x-text="data.type"
                       class="capitalize font-bold"
                       x-bind:class="data.type === 'cashier' ? 'text-brand-300' : 'text-neutral-700'"
                   ></span>
                </x-gxui.table.dynamic.td>
                <x-gxui.table.dynamic.td
                    contentClass="justify-end"
                    class="w-[120px]"
                >
                    <span x-text="data.total.toLocaleString('id-ID')"></span>
                </x-gxui.table.dynamic.td>
                <!-- data cart -->
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
        <x-slot name="footer">
            <x-gxui.table.dynamic.th
                contentClass="justify-center"
                class="w-[40px]"
            ></x-gxui.table.dynamic.th>
            <x-gxui.table.dynamic.th
                class="flex-1"
            >
                <span>Total Selling</span>
            </x-gxui.table.dynamic.th>
            <x-gxui.table.dynamic.th
                contentClass="justify-end"
                class="w-[120px]"
            >
                <span x-text="$store.sellingReportTableStore.total.toLocaleString('id-ID')"></span>
            </x-gxui.table.dynamic.th>
        </x-slot>
    </x-gxui.table.dynamic.table>
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
                types: [],
                customers: [],
                invoiceID: '',
                dateStart: '',
                dateEnd: '',
                total: 0,
                actions: [],
                init: function () {
                    const componentID = document.querySelector('[data-component-id="table-selling-report"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                            this.filterStore = Alpine.store('filterPurchasingStore');
                            this.processStore = Alpine.store('processPurchasingStore');
                            this.transactionStore = Alpine.store('transactionStore');
                            this.toastStore = Alpine.store('gxuiToastStore');
                        }
                    })
                },
                hydrateQuery(q) {
                    this.types = q['types'];
                    this.dateStart = q['dateStart'];
                    this.dateEnd = q['dateEnd'];
                    this.invoiceID = q['invoiceID'];
                    this.customers = q['customers'];
                    this.onFindAll();
                },
                onFindAll() {
                    this.loading = true;
                    const query = {
                        page: this.currentPage,
                        per_page: this.perPage,
                        types: this.types,
                        dateStart: this.dateStart,
                        dateEnd: this.dateEnd,
                        invoiceID: this.invoiceID,
                        customers: this.customers
                    };
                    this.component.$wire.call('findAll', query)
                        .then(response => {
                            const {success, data, meta} = response;
                            console.log(data);
                            if (success) {
                                this.data = data['data'];
                                this.total = data['total'];
                                const totalRows = meta['pagination'] ? meta['pagination']['total_rows'] : 0;
                                const page = meta['pagination'] ? meta['pagination']['page'] : 1;
                                this.totalRows = totalRows;
                                this.currentPage = page;
                            } else {
                                this.toastStore.failed('failed to load data');
                            }
                        }).finally(() => {
                        this.loading = false;
                    })
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
            Alpine.store('sellingReportTableStore', props);
        });
    </script>
@endpush
