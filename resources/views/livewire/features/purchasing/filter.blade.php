<section
    id="section-filter-purchasing"
    data-component-id="filter-purchasing"
>
    <x-gxui.modal.form
        {{--        show="$store.filterPurchasingStore.showModal"--}}
        show="true"
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
            ></x-gxui.input.select.select2>
            <x-gxui.input.select.select2
                store="filterPurchasingStore"
                options="salesOptions"
                label="Sales Team"
                parentClassName="mb-3"
                selectID="salesSelect"
            ></x-gxui.input.select.select2>
            <x-gxui.input.date.datepicker
                id="dateStart"
                label="Date Start"
                placeholder="yyyy-mm-dd"
                parentClassName="mb-3"
            ></x-gxui.input.date.datepicker>
            <x-gxui.input.date.datepicker
                id="dateEnd"
                label="Date End"
                placeholder="yyyy-mm-dd"
                parentClassName="mb-3"
            ></x-gxui.input.date.datepicker>
        </div>
        <div class="modal-footer w-full flex items-center justify-end gap-2 px-4 py-3 border-t border-neutral-300">
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.filterPurchasingStore.close()"
                x-bind:disabled="$store.filterPurchasingStore.loading"
                class="!px-6 bg-white !border-brand-500 !text-brand-500 hover:!text-white disabled:!bg-white disabled:!text-brand-500"
            >
                <div class="w-full flex justify-center items-center gap-1 text-sm">
                    <span>Cancel</span>
                </div>
            </x-gxui.button.button>
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.filterPurchasingStore.clearDate()"
                x-bind:disabled="$store.filterPurchasingStore.loading"
                class="!px-6"
            >
                <template x-if="!$store.filterPurchasingStore.loading">
                    <div class="w-full flex justify-center items-center gap-1 text-sm">
                        <span>Filter</span>
                    </div>
                </template>
                <template x-if="$store.filterPurchasingStore.loading">
                    <x-gxui.loader.button-loader></x-gxui.loader.button-loader>
                </template>
            </x-gxui.button.button>
        </div>
    </x-gxui.modal.form>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const INITIAL_FORM = {dateStart: '', dateEnd: ''};
            const STORE_PROPS = {
                component: null,
                toastStore: null,
                tableStore: null,
                showModal: false,
                storeSelectStore: null,
                storeOptions: [],
                salesSelectStore: null,
                salesOptions: [],
                dateStartStore: null,
                dateEndStore: null,
                loading: false,
                dateStartValue: '',
                dateEndValue: '',
                form: {...INITIAL_FORM},
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="filter-purchasing"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.tableStore = Alpine.store('purchasingTableStore');
                            let selectStoreElement = document.getElementById("storeSelect");
                            this.storeSelectStore = Alpine.store('gxuiSelectStore')
                                .initSelect2(
                                    selectStoreElement,
                                    () => {
                                    },
                                    {placeholder: 'choose a store'}
                                );
                            let selectSalesElement = document.getElementById("salesSelect");
                            this.storeSalesStore = Alpine.store('gxuiSelectStore')
                                .initSelect2(
                                    selectSalesElement,
                                    () => {
                                    },
                                    {placeholder: 'choose a sales team'}
                                );
                            let dateStartElement = document.getElementById("dateStart");
                            this.dateStartStore = Alpine.store('gxuiDatepickerStore')
                                .initDatepicker(
                                    dateStartElement,
                                    (value) => {
                                        this.dateStartValue = value;
                                        console.log(value);
                                    },
                                    {
                                        orientation: 'top right',
                                        autoSelectToday: 1,
                                        buttons: true,
                                    });
                            let dateEndElement = document.getElementById("dateEnd");
                            this.dateEndStore = Alpine.store('gxuiDatepickerStore')
                                .initDatepicker(
                                    dateEndElement,
                                    (value) => {
                                        this.dateEndValue = value;
                                    },
                                    {
                                        orientation: 'top right',
                                        autoSelectToday: 1,
                                        buttons: true,
                                    });
                        }
                    });
                },
                clearDate() {
                    // this.dateStartStore.clear();
                    console.log(this.dateStartStore);
                },
                show() {
                    this.showModal = true;
                },
                close() {
                    this.showModal = false;
                },
            };
            Alpine.store('filterPurchasingStore', STORE_PROPS);
        });
    </script>
@endpush
