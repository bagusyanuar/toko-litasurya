<section
    id="section-filter-purchasing"
    data-component-id="filter-purchasing"
>
    <x-gxui.modal.form
        show="$store.filterPurchasingStore.showModal"
        {{--        show="true"--}}
        width="24rem"
    >
        <div
            class="modal-header flex items-center justify-between px-4 py-3 border-b border-neutral-300 rounded-t">
            <span class="text-neutral-700 font-semibold">Filter Purchasing</span>
            <button
                type="button"
                x-on:click="$store.filterPurchasingStore.close()"
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
        <div class="modal-body p-6">
            <x-gxui.input.select.select2
                store="filterPurchasingStore"
                options="storeOptions"
                label="Store"
                parentClassName="mb-3"
                selectID="storeSelect"
                x-init="initSelect2({placeholder: 'choose a store'})"
                x-bind="gxuiSelect2Bind"
                x-bind:store-name="'$store.filterPurchasingStore.storeOptions'"
                x-model="$store.filterPurchasingStore.storeValue"
            ></x-gxui.input.select.select2>
            <x-gxui.input.select.select2
                store="filterPurchasingStore"
                options="salesOptions"
                label="Sales Team"
                parentClassName="mb-3"
                selectID="salesSelect"
                x-init="initSelect2({placeholder: 'choose a sales team'})"
                x-bind="gxuiSelect2Bind"
                x-bind:store-name="'$store.filterPurchasingStore.salesOptions'"
                x-model="$store.filterPurchasingStore.salesValue"
            ></x-gxui.input.select.select2>
            <x-gxui.input.date.datepicker
                id="dateStart"
                label="Date Start"
                placeholder="dd/mm/yyyy"
                parentClassName="mb-3"
                x-model="$store.filterPurchasingStore.dateStartValue"
                x-init="initDatepicker({format: 'dd/mm/yyyy'})"
            ></x-gxui.input.date.datepicker>
            <x-gxui.input.date.datepicker
                id="dateEnd"
                label="Date End"
                placeholder="dd/mm/yyyy"
                parentClassName="mb-3"
                x-model="$store.filterPurchasingStore.dateEndValue"
                x-init="initDatepicker({format: 'dd/mm/yyyy'})"
            ></x-gxui.input.date.datepicker>
        </div>
        <div class="modal-footer w-full flex items-center justify-end gap-2 px-4 py-3 border-t border-neutral-300">
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.filterPurchasingStore.reset()"
                class="!px-6 bg-white !border-brand-500 !text-brand-500 hover:!text-white disabled:!bg-white disabled:!text-brand-500"
            >
                <div class="w-full flex justify-center items-center gap-1 text-sm">
                    <span>Reset</span>
                </div>
            </x-gxui.button.button>
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.filterPurchasingStore.filter()"
                class="!px-6"
            >
                <div class="w-full flex justify-center items-center gap-1 text-sm">
                    <span>Filter</span>
                </div>
            </x-gxui.button.button>
        </div>
    </x-gxui.modal.form>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const STORE_PROPS = {
                component: null,
                toastStore: null,
                tableStore: null,
                showModal: false,
                storeOptions: [],
                salesOptions: [],
                storeValue: '',
                salesValue: '',
                dateStartValue: '',
                dateEndValue: '',
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="filter-purchasing"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.tableStore = Alpine.store('purchasingTableStore');
                            this.getStores();
                            this.getSales();
                        }
                    });
                },
                filter() {
                    const query = {
                        store: this.storeValue,
                        sales: this.salesValue,
                        dateStart: this.dateStartValue,
                        dateEnd: this.dateEndValue,
                    };
                    this.showModal = false;
                    this.tableStore.hydrateQuery(query);
                },
                reset() {
                    this.storeValue = '';
                    this.salesValue = '';
                    this.dateStartValue = '';
                    this.dateEndValue = '';
                },
                show() {
                    this.showModal = true;
                },
                close() {
                    this.showModal = false;
                },
                getStores() {
                    this.component.$wire.call('stores').then(response => {
                        const {success, data} = response;
                        if (success) {
                            let customerOptions = [];
                            data.forEach(function (v, k) {
                                const option = {id: v.id, text: v.name};
                                customerOptions.push(option);
                            });
                            this.storeOptions = customerOptions;

                        } else {
                            this.toastStore.failed('failed to load store option');
                        }
                    });
                },
                getSales() {
                    this.component.$wire.call('sales').then(response => {
                        const {success, data} = response;
                        if (success) {
                            let salesOptions = [];
                            data.forEach(function (v, k) {
                                const option = {id: v['user_id'], text: v.name};
                                salesOptions.push(option);
                            });
                            this.salesOptions = salesOptions;
                        } else {
                            this.toastStore.failed('failed to load sales option');
                        }
                    });
                }
            };
            Alpine.store('filterPurchasingStore', STORE_PROPS);
        });
    </script>
@endpush
