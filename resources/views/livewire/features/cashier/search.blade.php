<section
    id="section-cashier-search"
    data-component-id="cashier-search"
>
    <x-gxui.modal.form
        show="$store.cartSearchStore.modal"
        width="60%"
    >
        <div
            class="modal-header flex items-center justify-between px-4 py-3 border-b border-neutral-300 rounded-t">
            <span class="text-neutral-700 text-sm font-semibold">Search Product</span>
            <button
                type="button"
                x-on:click="$store.cartSearchStore.closeModalSearch()"
                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-xs w-4 h-4 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
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
        <div
            class="modal-body px-6 py-4 overflow-y-scroll flex-grow-1"
        >
            <div class="w-full mb-3">
                <x-gxui.table.dynamic.search
                    store="cartSearchStore"
                    dispatcher="onFindAll"
                ></x-gxui.table.dynamic.search>
            </div>
            <x-gxui.table.dynamic.table
                store="cartSearchStore"
                dispatcher="onFindAll"
                pagination="true"
            >
                <x-slot name="header">
                    <x-gxui.table.dynamic.th
                        class="flex-1 min-w-[180px]"
                    >
                        <span>Name</span>
                    </x-gxui.table.dynamic.th>
                    <x-gxui.table.dynamic.th
                        contentClass="justify-end"
                        class="w-[150px]"
                    >
                        <span>Price (Rp.)</span>
                    </x-gxui.table.dynamic.th>
                    <x-gxui.table.dynamic.th
                        contentClass="justify-center"
                        class="w-[80px]"
                    >
                        <span>Unit</span>
                    </x-gxui.table.dynamic.th>
                    <x-gxui.table.dynamic.th
                        class="w-[80px]"
                    >
                        <span>Action</span>
                    </x-gxui.table.dynamic.th>
                </x-slot>
                <x-slot name="rows">
                    <x-gxui.table.dynamic.row>
                        <x-gxui.table.dynamic.td
                            class="flex-1 min-w-[180px]"
                        >
                            <span x-text="data.item.name"></span>
                        </x-gxui.table.dynamic.td>
                        <x-gxui.table.dynamic.td
                            contentClass="justify-end"
                            class="w-[150px]"
                        >
                            <span x-text="data.price.toLocaleString('id-ID') ?? '-'"></span>
                        </x-gxui.table.dynamic.td>
                        <x-gxui.table.dynamic.td
                            contentClass="justify-center"
                            class="w-[80px]"
                        >
                            <span x-text="data.unit" class="capitalize"></span>
                        </x-gxui.table.dynamic.td>
                        <x-gxui.table.dynamic.td
                            class="w-[80px]"
                        >
                            <x-gxui.button.button
                                wire:ignore
                                x-on:click="$store.cartSearchStore.insert(data)"
                                class="!w-fit text-xs"
                                x-bind:disabled="false"
                            >
                                <span>Insert</span>
                            </x-gxui.button.button>
                        </x-gxui.table.dynamic.td>
                    </x-gxui.table.dynamic.row>
                </x-slot>
            </x-gxui.table.dynamic.table>
{{--            <x-gxui.table.search--}}
{{--                placeholder="Search..."--}}
{{--                store="cartSearchStore"--}}
{{--                dispatcher="onFindAll"--}}
{{--                parentClassName="mb-3"--}}
{{--            ></x-gxui.table.search>--}}
{{--            <x-gxui.table.table--}}
{{--                class="mb-1"--}}
{{--                store="cartSearchStore"--}}
{{--            >--}}
{{--                <x-slot name="header">--}}
{{--                    <x-gxui.table.th--}}
{{--                        title="Name"--}}
{{--                        align="left"--}}
{{--                    ></x-gxui.table.th>--}}
{{--                    <x-gxui.table.th--}}
{{--                        title="Price"--}}
{{--                        className="w-[120px]"--}}
{{--                        align="right"--}}
{{--                    ></x-gxui.table.th>--}}
{{--                    <x-gxui.table.th--}}
{{--                        title="Unit"--}}
{{--                        className="w-[80px]"--}}
{{--                    ></x-gxui.table.th>--}}
{{--                    <x-gxui.table.th--}}
{{--                        title="Action"--}}
{{--                        className="w-[80px]"--}}
{{--                    ></x-gxui.table.th>--}}
{{--                </x-slot>--}}
{{--                <x-slot name="rows">--}}
{{--                    <tr class="border-b border-neutral-300">--}}
{{--                        <x-gxui.table.td>--}}
{{--                            <span x-text="data.item.name"></span>--}}
{{--                        </x-gxui.table.td>--}}
{{--                        <x-gxui.table.td className="flex justify-end">--}}
{{--                            <span x-text="data.price.toLocaleString('id-ID') ?? '-'"></span>--}}
{{--                        </x-gxui.table.td>--}}
{{--                        <x-gxui.table.td className="flex justify-center">--}}
{{--                            <template x-if="data.unit === 'retail'">--}}
{{--                                <span x-text="'PCS'"></span>--}}
{{--                            </template>--}}
{{--                            <template x-if="data.unit === 'dozen'">--}}
{{--                                <span x-text="'Dozen'"></span>--}}
{{--                            </template>--}}
{{--                            <template x-if="data.unit === 'carton'">--}}
{{--                                <span x-text="'Carton'"></span>--}}
{{--                            </template>--}}
{{--                            <template x-if="data.unit === 'trader'">--}}
{{--                                <span x-text="'Trader'"></span>--}}
{{--                            </template>--}}
{{--                        </x-gxui.table.td>--}}
{{--                        <x-gxui.table.td className="flex justify-center">--}}
{{--                            <x-gxui.button.button--}}
{{--                                wire:ignore--}}
{{--                                x-on:click="$store.cartSearchStore.insert(data)"--}}
{{--                                class="!w-fit"--}}
{{--                                x-bind:disabled="false"--}}
{{--                            >--}}
{{--                                <span>Insert</span>--}}
{{--                            </x-gxui.button.button>--}}
{{--                        </x-gxui.table.td>--}}
{{--                    </tr>--}}
{{--                </x-slot>--}}
{{--            </x-gxui.table.table>--}}
{{--            <x-gxui.table.pagination--}}
{{--                store="cartSearchStore"--}}
{{--                dispatcher="onFindAll"--}}
{{--            ></x-gxui.table.pagination>--}}
        </div>
    </x-gxui.modal.form>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const COMPONENT_PROPS = {
                component: null,
                cartStore: null,
                toastStore: null,
                modal: false,
                param: '',
                data: [],
                loading: false,
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="cashier-search"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.cartStore = Alpine.store('cartStore');
                            this.toastStore = Alpine.store('gxuiToastStore');
                        }
                    })
                },
                showModalSearch() {
                    this.modal = true;
                },
                closeModalSearch() {
                    this.modal = false;
                    this.param = '';
                },
                onFindAll() {
                    this.loading = true;
                    this.component.$wire.call('findAll', this.param, this.currentPage, this.perPage)
                        .then(response => {
                            const {success, data, meta, message} = response;
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
                insert(item) {
                    this.cartStore.addToCart(item);
                    this.toastStore.success('successfully insert new item...')
                }
            };
            const PROPS = Object.assign({}, window.TableStore, COMPONENT_PROPS);
            Alpine.store('cartSearchStore', PROPS);
        });
    </script>
@endpush
