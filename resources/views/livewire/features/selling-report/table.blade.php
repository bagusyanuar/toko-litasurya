<section
    id="section-table-selling-report"
    data-component-id="table-selling-report"
>
    <div class="w-full flex items-center justify-between mb-3">
        <p class="text-neutral-700 font-semibold">Selling Report Data</p>
        <div class="flex items-center gap-3">
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.sellingReportTableStore.show()"
            >
                <div wire:ignore>
                    <i data-lucide="filter"
                       class="text-white h-4 aspect-[1/1]"></i>
                </div>
            </x-gxui.button.button>
        </div>
    </div>
    <div class="w-full rounded-lg border border-neutral-300 overflow-x-auto">
        <div class="flex items-center rounded-t-lg bg-brand-50 w-full text-xs">
            <div class="py-3 px-2.5 font-semibold w-[50px]">
            </div>
            <div class="py-3 px-2.5 font-semibold w-[100px]">
                <div class="w-full flex items-center justify-center text-neutral-700">
                    <span>Date</span>
                </div>
            </div>
            <div class="py-3 px-2.5 w-[170px] font-semibold">
                <div class="w-full flex items-center justify-center text-neutral-700">
                    <span>Invoice ID</span>
                </div>
            </div>
            <div class="py-3 px-2.5 flex-1 min-w-[200px] font-semibold">
                <div class="w-full flex justify-start text-neutral-700">
                    <span>Customer</span>
                </div>
            </div>
            <div class="py-3 px-2.5 w-[80px] font-semibold">
                <div class="w-full flex items-center justify-center text-neutral-700">
                    <span>Type</span>
                </div>
            </div>
            <div class="py-3 px-2.5 w-[120px] font-semibold">
                <div class="w-full flex items-center justify-end text-neutral-700">
                    <span>Total (Rp.)</span>
                </div>
            </div>
        </div>
        <template x-for="(data, index) in $store.sellingReportTableStore.data" :key="index">
            <div
                class="w-full"
                x-data="{
                            isOpen: false,
                            toggleIcon() {
                                this.isOpen = !this.isOpen;
                                this.initIcons();
                            },
                            initIcons() {
                                setTimeout(() => { lucide.createIcons(); }, 0);
                            }
                        }"
                x-init="initIcons()"
                x-effect="initIcons()"
            >
                <div class="w-full flex items-center text-xs border-b last:border-b-0">
                    <div class="py-3 px-2.5 font-semibold w-[50px]">
                        <div
                            wire:ignore
                            @click="toggleIcon"
                            class="flex items-center justify-center p-1 cursor-pointer hover:bg-neutral-100 transition-all ease-in duration-200"
                        >
                            <i x-bind:data-lucide="isOpen ? 'chevron-up' : 'chevron-down'"
                               class="text-neutral-700 h-3 aspect-[1/1]"></i>
                        </div>
                    </div>
                    <div class="py-3 px-2.5 w-[100px]">
                        <div class="w-full flex items-center justify-center text-neutral-700">
                            <span x-text="new Date(data.date).toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' })"></span>
                        </div>
                    </div>
                    <div class="py-3 px-2.5 w-[170px]">
                        <div class="w-full flex items-center justify-center text-neutral-700">
                            <span x-text="data.reference_number"></span>
                        </div>
                    </div>
                    <div class="py-3 px-2.5 flex-1 min-w-[200px]">
                        <div class="w-full flex justify-start text-neutral-700">
                            <span x-text="data.customer ? data.customer?.name : '-'"></span>
                        </div>
                    </div>
                    <div class="py-3 px-2.5 w-[80px]">
                        <div class="w-full flex items-center justify-center">
                            <span
                                x-text="data.type"
                                class="capitalize font-bold"
                                x-bind:class="data.type === 'cashier' ? 'text-brand-300' : 'text-neutral-700'"
                            ></span>
                        </div>
                    </div>
                    <div class="py-3 px-2.5 w-[120px]">
                        <div class="w-full flex items-center justify-end text-neutral-700">
                            <span x-text="data.total.toLocaleString('id-ID')"></span>
                        </div>
                    </div>
                </div>
                <div class="w-full flex items-start border-b" x-show="isOpen" x-collapse>
                    <div class="py-3 px-2.5 font-semibold w-[50px]">
                    </div>
                    <div class="py-3 px-2.5 flex-1">
                        <p class="text-xs text-neutral-700 font-semibold mb-1">Cart</p>
                        <div class="w-full rounded-lg border border-neutral-300 overflow-x-auto">
                            <div class="flex items-center bg-brand-50 w-full text-xs">
                                <div class="py-3 px-2.5 flex-1 min-w-[200px] font-semibold">
                                    <div class="w-full flex justify-start text-neutral-700">
                                        <span>Product</span>
                                    </div>
                                </div>
                                <div class="py-3 px-2.5 w-[80px] font-semibold">
                                    <div class="w-full flex items-center justify-center text-neutral-700">
                                        <span>Qty</span>
                                    </div>
                                </div>
                                <div class="py-3 px-2.5 w-[80px] font-semibold">
                                    <div class="w-full flex items-center justify-center text-neutral-700">
                                        <span>Unit</span>
                                    </div>
                                </div>
                                <div class="py-3 px-2.5 w-[120px] font-semibold">
                                    <div class="w-full flex items-center justify-end text-neutral-700">
                                        <span>Price (Rp.)</span>
                                    </div>
                                </div>
                                <div class="py-3 px-2.5 w-[120px] font-semibold">
                                    <div class="w-full flex items-center justify-end text-neutral-700">
                                        <span>Total (Rp.)</span>
                                    </div>
                                </div>
                            </div>
                            <template x-for="(cart, index) in data.carts" :key="index">
                                <div class="w-full flex items-center text-xs text-neutral-700 border-b last:border-b-0">
                                    <div class="py-3 px-2.5 flex-1 min-w-[200px]">
                                        <div class="w-full flex justify-start">
                                            <span x-text="cart.item.name"></span>
                                        </div>
                                    </div>
                                    <div class="py-3 px-2.5 w-[80px]">
                                        <div class="w-full flex items-center justify-center">
                                            <span x-text="cart.qty.toLocaleString('id-ID')"></span>
                                        </div>
                                    </div>
                                    <div class="py-3 px-2.5 w-[80px]">
                                        <div class="w-full flex items-center justify-center">
                                            <span x-text="cart.unit" class="capitalize"></span>
                                        </div>
                                    </div>
                                    <div class="py-3 px-2.5 w-[120px]">
                                        <div class="w-full flex items-center justify-end">
                                            <span x-text="cart.price.toLocaleString('id-ID')"></span>
                                        </div>
                                    </div>
                                    <div class="py-3 px-2.5 w-[120px] font-semibold">
                                        <div class="w-full flex items-center justify-end">
                                            <span x-text="cart.total.toLocaleString('id-ID')"></span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    <div class="py-3 px-2.5 w-[120px]">
                    </div>
                </div>
            </div>
        </template>
        <div class="flex items-center rounded-b-lg bg-brand-50 w-full text-xs">
            <div class="py-3 px-2.5 font-semibold w-[50px]">
            </div>
            <div class="py-3 px-2.5 font-semibold flex-1">
                <div class="w-full flex items-center text-neutral-700">
                    <span>Total Selling</span>
                </div>
            </div>
            <div class="py-3 px-2.5 w-[120px] font-semibold">
                <div class="w-full flex items-center justify-end text-neutral-700">
                    <span>10.000.000</span>
                </div>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-between gap-3 mt-1">
        <div class="text-xs text-neutral-500">Total Data: <span x-text="$store.sellingReportTableStore.totalRows"></span></div>
        <div class="flex items-center">
            <div class="flex gap-2 items-center text-xs text-neutral-500">
                <span>Lines per page</span>
                <select
                    class="border border-neutral-500 w-fit appearance-none rounded-[4px] text-xs pl-2 !pr-[1.5rem] py-1 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 cursor-pointer"
                    style="
                        background-position: right 0.5rem center;
                        background-image: url('data:image/svg+xml,%3csvg aria-hidden=%27true%27 xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 16 16%27%3e%3cpath stroke=%27%236B7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27m2 6 6-6 6 6 m-12 4 6 6 6-6%27/%3e%3c/svg%3e');
                        "
                    x-on:change="
                   Alpine.store('sellingReportTableStore').perPage = $event.currentTarget.value;
                   Alpine.store('sellingReportTableStore').onFindAll();
                "
                >
                    <template x-for="value in $store.sellingReportTableStore.perPageOptions">
                        <option :value="value" x-text="value"></option>
                    </template>
                </select>
            </div>
            <div class="flex items-center gap-1 py-1.5 ps-1.5" wire:ignore>
                <button
                    class="h-6 aspect-[1/1] rounded-full flex items-center justify-center text-brand-500 cursor-pointer hover:bg-brand-50 transition-all ease-in duration-200 disabled:text-neutral-300 disabled:cursor-default disabled:hover:bg-transparent"
                    x-bind:disabled="($store.sellingReportTableStore.page == 1 || $store.sellingReportTableStore.totalPages <= 0)"
                    x-on:click="
                   Alpine.store('sellingReportTableStore').page -= 1;
                   Alpine.store('sellingReportTableStore').onFindAll();
                "
                >
                    <i data-lucide="chevron-left"
                       class="h-4 aspect-[1/1]">
                    </i>
                </button>
                <template x-for="value in $store.sellingReportTableStore.shownPages">
                    <a href="#"
                       x-on:click.prevent=""
                       x-on:click="
                       Alpine.store('sellingReportTableStore').page = value;
                       Alpine.store('sellingReportTableStore').onFindAll();
                    "
                       class="text-xs cursor-pointer h-6 aspect-[1/1] rounded-full flex items-center justify-center"
                       x-bind:class="value === $store.sellingReportTableStore.page ? 'bg-brand-500 text-white' : 'bg-transparent text-brand-500 hover:bg-brand-50 transition-all ease-in duration-200'"
                       x-text="value"
                    ></a>
                </template>
                <button
                    x-on:click="
                   Alpine.store('sellingReportTableStore').page += 1;
                   Alpine.store('sellingReportTableStore').onFindAll();
                "
                    class="h-6 aspect-[1/1] rounded-full flex items-center justify-center text-brand-500 cursor-pointer hover:bg-brand-50 transition-all ease-in duration-200 disabled:text-neutral-300 disabled:cursor-default disabled:hover:bg-transparent"
                    x-bind:disabled="($store.sellingReportTableStore.page == $store.sellingReportTableStore.totalPages || $store.sellingReportTableStore.totalPages <= 0)"
                >
                    <i data-lucide="chevron-right"
                       class="h-4 aspect-[1/1]">
                    </i>
                </button>
            </div>
        </div>
    </div>
    {{--    <x-gxui.table.table--}}
    {{--        class="mb-1"--}}
    {{--        store="sellingReportTableStore"--}}
    {{--    >--}}
    {{--        <x-slot name="header">--}}
    {{--            <x-gxui.table.th--}}
    {{--                title=""--}}
    {{--                className="w-[50px]"--}}
    {{--            ></x-gxui.table.th>--}}
    {{--            <x-gxui.table.th--}}
    {{--                title="Date"--}}
    {{--                className="w-[80px]"--}}
    {{--            ></x-gxui.table.th>--}}
    {{--            <x-gxui.table.th--}}
    {{--                title="Invoice ID"--}}
    {{--            ></x-gxui.table.th>--}}
    {{--            <x-gxui.table.th--}}
    {{--                title="Customer"--}}
    {{--            ></x-gxui.table.th>--}}
    {{--            <x-gxui.table.th--}}
    {{--                title="Type"--}}
    {{--                className="w-[100px]"--}}
    {{--            ></x-gxui.table.th>--}}
    {{--            <x-gxui.table.th--}}
    {{--                title="Total (Rp.)"--}}
    {{--                className="w-[150px]"--}}
    {{--                align="right"--}}
    {{--            ></x-gxui.table.th>--}}
    {{--        </x-slot>--}}
    {{--        <x-slot name="rows">--}}

    {{--        </x-slot>--}}
    {{--    </x-gxui.table.table>--}}
    {{--    <x-gxui.table.pagination--}}
    {{--        store="sellingReportTableStore"--}}
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
                processStore: null,
                paginationStore: null,
                store: '',
                sales: '',
                dateStart: '',
                dateEnd: '',
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
                            this.paginationStore = Alpine.store('gxuiPaginationStore');
                            // this.actions.forEach((action, key) => {
                            //     action.dispatch = action.dispatch.bind(this);
                            // });
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
            Alpine.store('sellingReportTableStore', props);
        });
    </script>
@endpush
