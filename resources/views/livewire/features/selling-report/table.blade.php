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
    <div class="w-full rounded-t-lg border border-neutral-300 overflow-x-auto">
        <div class="flex items-center bg-brand-50 w-full">
            <div class="py-2 px-1.5 text-sm font-semibold w-[50px]">
            </div>
            <div class="py-2 px-1.5 text-sm font-semibold w-[80px]">
                <div class="w-full flex items-center text-neutral-700">
                    <span>Date</span>
                </div>
            </div>
            <div class="py-2 px-1.5 text-sm flex-1 min-w-[120px] font-semibold">
                <div class="w-full flex items-center text-neutral-700">
                    <span>Invoice ID</span>
                </div>
            </div>
            <div class="py-2 px-1.5 text-sm flex-1 min-w-[120px] font-semibold">
                <div class="w-full flex items-center text-neutral-700">
                    <span>Customer</span>
                </div>
            </div>
            <div class="py-2 px-1.5 text-sm w-[120px] font-semibold">
                <div class="w-full flex items-center text-neutral-700">
                    <span>Type</span>
                </div>
            </div>
            <div class="py-2 px-1.5 text-sm w-[150px] font-semibold">
                <div class="w-full flex items-center justify-end text-neutral-700">
                    <span>Total (Rp.)</span>
                </div>
            </div>
        </div>
        <template x-for="(data, index) in $store.sellingReportTableStore.data" :key="index">
            <div class="w-full flex items-center">
                <div class="py-2 px-1.5 text-sm font-semibold w-[50px]">
                    <div
                        wire:ignore
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
                        @click="toggleIcon"
                        class="flex items-center justify-center p-1 cursor-pointer hover:bg-neutral-100 transition-all ease-in duration-200"
                    >
                        <i x-bind:data-lucide="isOpen ? 'chevron-up' : 'chevron-down'"
                           class="text-neutral-700 h-3 aspect-[1/1]"></i>
                    </div>
                </div>
            </div>
        </template>
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
