<section
    id="section-filter-selling-report"
    data-component-id="filter-selling-report"
>
    <x-gxui.modal.form
                show="$store.filterSellingReportStore.showModal"
        width="24rem"
    >
        <div
            class="modal-header flex items-center justify-between px-4 py-3 border-b border-neutral-300 rounded-t">
            <span class="text-neutral-700 font-semibold">Filter Selling Report</span>
            <button
                type="button"
                x-on:click="$store.filterSellingReportStore.close()"
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
        <div class="modal-body p-4">
{{--            <div class="w-full mb-3">--}}
{{--                <label class="text-xs text-neutral-700 block mb-1">Date</label>--}}
{{--                <div class="flex items-center justify-between gap-1">--}}
{{--                    <x-gxui.input.date.datepicker--}}
{{--                        id="filterSellingDateStart"--}}
{{--                        label=""--}}
{{--                        placeholder="dd/mm/yyyy"--}}
{{--                        x-model="$store.filterSellingReportStore.dateStartValue"--}}
{{--                        x-init="initDatepicker({format: 'dd/mm/yyyy'})"--}}
{{--                    ></x-gxui.input.date.datepicker>--}}
{{--                    <span class="text-sm text-neutral-700">-</span>--}}
{{--                    <x-gxui.input.date.datepicker--}}
{{--                        id="filterSellingDateEnd"--}}
{{--                        label=""--}}
{{--                        placeholder="dd/mm/yyyy"--}}
{{--                        x-model="$store.filterSellingReportStore.dateEndValue"--}}
{{--                        x-init="initDatepicker({format: 'dd/mm/yyyy'})"--}}
{{--                    ></x-gxui.input.date.datepicker>--}}
{{--                </div>--}}
{{--            </div>--}}
            <x-gxui.input.text.text
                placeholder="Name"
                label="Invoice ID"
                parentClassName="mb-3"
                x-model="$store.filterSellingReportStore.invoiceID"
            ></x-gxui.input.text.text>
            <x-gxui.input.select.select2-multiple
                label="Customer"
                parentClassName="mb-3"
                selectID="storeSelect"
                x-init="initSelect2({placeholder: 'choose a customer'})"
                x-bind="gxuiSelect2MultipleBind"
                x-bind:store-name="'$store.filterSellingReportStore.customerOptions'"
                x-model="$store.filterSellingReportStore.customerValues"
            ></x-gxui.input.select.select2-multiple>

            <div class="w-full">
                <label class="text-sm text-neutral-700 block mb-2">Selling Type</label>
                <div class="flex items-start gap-3">
                    <div class="flex items-center">
                        <input
                            id="cashier-type"
                            type="checkbox" value=""
                            class="w-4 h-4 text-brand-500 bg-gray-100 border-brand-500 rounded-sm !focus:ring-0 !focus:outline-none"
                            style="box-shadow: none"
                            x-on:change="$store.filterSellingReportStore.onSellingTypeChange('cashier')"
                            :checked="$store.filterSellingReportStore.sellingTypes.includes('cashier')"
                        >
                        <label for="cashier-type" class="ms-2 text-sm font-medium text-neutral-700">Cashier</label>
                    </div>
                    <div class="flex items-center">
                        <input
                            id="sales-type"
                            type="checkbox" value=""
                            class="w-4 h-4 text-brand-500 bg-gray-100 border-brand-500 rounded-sm !focus:ring-0 !focus:outline-none"
                            style="box-shadow: none"
                            x-on:change="$store.filterSellingReportStore.onSellingTypeChange('sales')"
                            :checked="$store.filterSellingReportStore.sellingTypes.includes('sales')"
                        >
                        <label for="sales-type" class="ms-2 text-sm font-medium text-neutral-700">Team Sales</label>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer w-full flex items-center justify-end gap-2 px-4 py-3 border-t border-neutral-300">
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.filterSellingReportStore.reset()"
                class="!px-6 bg-white !border-brand-500 !text-brand-500 hover:!text-white disabled:!bg-white disabled:!text-brand-500"
            >
                <div class="w-full flex justify-center items-center gap-1 text-sm">
                    <span>Reset</span>
                </div>
            </x-gxui.button.button>
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.filterSellingReportStore.filter()"
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
            const today = new Date().toLocaleDateString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
            const STORE_PROPS = {
                component: null,
                toastStore: null,
                tableStore: null,
                showModal: false,
                invoiceID: '',
                dateStartValue: today,
                dateEndValue: today,
                customerOptions: [],
                customerValues: [],
                sellingTypes: [
                    'cashier', 'sales'
                ],
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="filter-selling-report"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.tableStore = Alpine.store('sellingReportTableStore');
                            this.getCustomers();
                        }
                    });
                },
                getCustomers() {
                    this.component.$wire.call('customers').then(response => {
                        const {success, data} = response;
                        if (success) {
                            let customerOptions = [];
                            data.forEach(function (v, k) {
                                const option = {id: v.id, text: v.name};
                                customerOptions.push(option);
                            });
                            this.customerOptions = [{id: 'non-member', text: 'Non Member'}, ...customerOptions];

                        } else {
                            this.toastStore.failed('failed to load store option');
                        }
                    });
                },
                reset() {
                    this.sellingTypes = ['cashier', 'sales'];
                    this.customerValues = [];
                    this.invoiceID = '';
                    this.dateStartValue = '';
                    this.dateEndValue = '';
                },
                filter() {
                    const query = {
                        types: this.sellingTypes,
                        dateStart: this.dateStartValue,
                        dateEnd: this.dateEndValue,
                        customers: this.customerValues,
                        invoiceID: this.invoiceID
                    };
                    this.showModal = false;
                    this.tableStore.hydrateQuery(query);
                },
                onSellingTypeChange(type) {
                    if (this.sellingTypes.includes(type)) {
                        this.sellingTypes = this.sellingTypes.filter(item => item !== type);
                    } else {
                        this.sellingTypes.push(type);
                    }
                },
                show() {
                    this.showModal = true;
                },
                close() {
                    this.showModal = false;
                },
            };
            Alpine.store('filterSellingReportStore', STORE_PROPS);
        });
    </script>
@endpush
