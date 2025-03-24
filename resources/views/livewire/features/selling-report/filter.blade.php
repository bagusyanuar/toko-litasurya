<section
    id="section-filter-selling-report"
    data-component-id="filter-selling-report"
>
    <x-gxui.modal.form
        {{--        show="$store.filterPurchasingStore.showModal"--}}
        show="true"
        width="24rem"
    >
        <div
            class="modal-header flex items-center justify-between px-4 py-3 border-b border-neutral-300 rounded-t">
            <span class="text-neutral-700 font-semibold">Filter Selling Report</span>
            <button
                type="button"
                x-on:click="$store.sellingReportTableStore.close()"
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
            <div class="w-full mb-3">
                <label class="text-sm text-neutral-700 block mb-1">Date</label>
                <div class="flex items-center justify-between gap-1">
                    <x-gxui.input.date.datepicker
                        id="dateStart"
                        label=""
                        placeholder="dd/mm/yyyy"
                        x-model="$store.filterPurchasingStore.dateStartValue"
                        x-init="initDatepicker({format: 'dd/mm/yyyy'})"
                    ></x-gxui.input.date.datepicker>
                    <span class="text-sm text-neutral-700">-</span>
                    <x-gxui.input.date.datepicker
                        id="dateEnd"
                        label=""
                        placeholder="dd/mm/yyyy"
                        x-model="$store.filterPurchasingStore.dateEndValue"
                        x-init="initDatepicker({format: 'dd/mm/yyyy'})"
                    ></x-gxui.input.date.datepicker>
                </div>
            </div>
            <x-gxui.input.select.select2-multiple
                store="sellingReportTableStore"
                options="storeOptions"
                label="Customer"
                parentClassName="mb-3"
                selectID="storeSelect"
                x-init="initSelect2({placeholder: 'choose a customer'})"
                x-bind="gxuiSelect2MultipleBind"
                x-bind:store-name="'$store.filterSellingReportStore.customerOptions'"
                x-model="$store.filterSellingReportStore.customerValues"
            ></x-gxui.input.select.select2-multiple>

            <div class="w-full mb-3">
                <label class="text-sm text-neutral-700 block mb-2">Selling Type</label>
                <div class="flex items-start gap-3">
                    <div class="flex items-center">
                        <input
                            id="cashier-type"
                            type="checkbox" value=""
                            class="w-4 h-4 text-brand-500 bg-gray-100 border-brand-500 rounded-sm !focus:ring-0 !focus:outline-none"
                            style="box-shadow: none"
                        >
                        <label for="cashier-type" class="ms-2 text-sm font-medium text-neutral-700">Cashier</label>
                    </div>
                    <div class="flex items-center">
                        <input
                            id="sales-type"
                            type="checkbox" value=""
                            class="w-4 h-4 text-brand-500 bg-gray-100 border-brand-500 rounded-sm !focus:ring-0 !focus:outline-none"
                            style="box-shadow: none"
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
                customerOptions: [],
                customerValues: [],
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="filter-selling-report"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            setTimeout(() => {
                                this.customerOptions = [
                                    { id: '1', text: 'Customer 1' },
                                    { id: '2', text: 'Customer 2' }
                                ];
                            }, 2000);
                        }
                    });
                },
                reset() {
                    console.log(this.customerValues);
                }
            };
            Alpine.store('filterSellingReportStore', STORE_PROPS);
        });
    </script>
@endpush
