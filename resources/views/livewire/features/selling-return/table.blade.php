<section
    id="section-selling-return-table"
    data-component-id="selling-return-table"
    class="w-full"
>
    <div
        class="w-full flex justify-between items-center mb-3"
        x-data="{
            initIcons() {
               setTimeout(() => { lucide.createIcons(); }, 0);
            }
        }"
        x-init="initIcons()"
        x-effect="initIcons()"
    >
        <p class="mb-0 text-sm text-neutral-700 font-bold">SELLING RETURN DATA</p>
    </div>
    <x-gxui.table.dynamic.table
        store="sellingReturnTableStore"
        dispatcher="onFindAll"
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
                                <template x-for="(cart, index) in data.details" :key="index">
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
                            <div class="w-full flex justify-end">
                                <x-gxui.button.button
                                    wire:ignore
                                    x-on:click="$store.sellingReturnTableStore.onSubmitReturn(data)"
                                    x-bind:disabled="$store.sellingReturnTableStore.loadingSubmit"
                                    class="!px-6"
                                >
                                    <template x-if="!$store.sellingReturnTableStore.loadingSubmit">
                                        <div class="w-full flex justify-center items-center gap-1 text-xs">
                                            <span>Submit</span>
                                        </div>
                                    </template>
                                    <template x-if="$store.sellingReturnTableStore.loadingSubmit">
                                        <x-gxui.loader.button-loader></x-gxui.loader.button-loader>
                                    </template>
                                </x-gxui.button.button>
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
                <span>Total Selling Return</span>
            </x-gxui.table.dynamic.th>
            <x-gxui.table.dynamic.th
                contentClass="justify-end"
                class="w-[120px]"
            >
                <span class="font-extrabold" x-text="$store.sellingReturnTableStore.total.toLocaleString('id-ID')"></span>
            </x-gxui.table.dynamic.th>
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
                toastStore: null,
                actionLoaderStore: null,
                dateStart: today,
                dateEnd: today,
                loadingSubmit: false,
                total: 0,
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="selling-return-table"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.actionLoaderStore = Alpine.store('gxuiActionLoader');
                        }
                    })
                },
                onFindAll() {
                    this.loading = true;
                    const query = {
                        page: this.currentPage,
                        per_page: this.perPage,
                        dateStart: this.dateStart,
                        dateEnd: this.dateEnd,
                    };
                    this.component.$wire.call('findAll', query)
                        .then(response => {
                            const {success, data, meta} = response;
                            console.log(response);
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
                onSubmitReturn(data) {
                    const id = data['id'];
                    this.loadingSubmit = true;
                    this.component.$wire.call('submitReturn', id)
                        .then(response => {
                            const {success, data, message} = response;
                            if (success) {
                                this.toastStore.success('successfully submit selling return');
                                this.onFindAll();
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.loadingSubmit = false;
                    })
                },
            };
            const props = Object.assign({}, window.TableStore, componentProps);
            Alpine.store('sellingReturnTableStore', props);
        });
    </script>
@endpush
