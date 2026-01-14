<section id="section-form-point-redemption" data-component-id="form-point-redemption">
    <x-gxui.modal.form show="$store.pointRedemptionFormStore.showModalForm" width="30rem">
        <div class="modal-header flex items-center justify-between px-4 py-3 border-b border-neutral-300 rounded-t">
            <span class="text-neutral-700 text-sm font-semibold">Form Penukaran Hadiah</span>
            <button type="button" x-on:click="$store.pointRedemptionFormStore.closeModal()"
                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-4 h-4 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <div class="modal-body px-6 py-4 flex-grow-1">
            <div class="w-full mb-3">
                <x-gxui.input.select.select2 store="pointRedemptionFormStore" options="customerOptions" label="Member"
                    parentClassName="mb-3 flex-1" selectID="customerSelect" x-init="initSelect2({ placeholder: 'pilih member' })"
                    x-bind="gxuiSelect2Bind" x-bind:store-name="'$store.pointRedemptionFormStore.customerOptions'"
                    x-model="$store.pointRedemptionFormStore.form.customerId"
                    validatorKey="$store.pointRedemptionFormStore.formValidator"
                    validatorField="customerId"></x-gxui.input.select.select2>
            </div>
            <div class="w-full">
                <x-gxui.input.select.select2 store="pointRedemptionFormStore" options="rewardOptions" label="Hadiah"
                    parentClassName="mb-3 flex-1" selectID="rewardSelect" x-init="initSelect2({ placeholder: 'pilih hadiah' })"
                    x-bind="gxuiSelect2Bind" x-bind:store-name="'$store.pointRedemptionFormStore.rewardOptions'"
                    x-model="$store.pointRedemptionFormStore.form.rewardId"
                    validatorKey="$store.pointRedemptionFormStore.formValidator"
                    validatorField="rewardId"></x-gxui.input.select.select2>
            </div>
        </div>
        <div class="modal-footer w-full flex items-center justify-end gap-2 px-4 py-3 border-t border-neutral-300">
            <x-gxui.button.button wire:ignore x-on:click="$store.pointRedemptionFormStore.closeModal()"
                x-bind:disabled="$store.pointRedemptionFormStore.loading"
                class="!px-6 bg-white !border-brand-500 !text-brand-500 hover:!text-white disabled:!bg-white disabled:!text-brand-500">
                <div class="w-full flex justify-center items-center gap-1 text-xs">
                    <span>Cancel</span>
                </div>
            </x-gxui.button.button>
            <x-gxui.button.button wire:ignore x-on:click="$store.pointRedemptionFormStore.mutate()"
                x-bind:disabled="$store.pointRedemptionFormStore.loading" class="!px-6">
                <template x-if="!$store.pointRedemptionFormStore.loading">
                    <div class="w-full flex justify-center items-center gap-1 text-xs">
                        <span>Submit</span>
                    </div>
                </template>
                <template x-if="$store.pointRedemptionFormStore.loading">
                    <x-gxui.loader.button-loader></x-gxui.loader.button-loader>
                </template>
            </x-gxui.button.button>
        </div>
    </x-gxui.modal.form>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const INITIAL_FORM = {
                customerId: '',
                rewardId: '',
            };
            const STORE_PROPS = {
                component: null,
                toastStore: null,
                tableStore: null,
                showModalForm: false,
                fileDropper: null,
                select2Store: null,
                loading: false,
                formType: 'create',
                formValidator: {},
                form: {
                    ...INITIAL_FORM
                },
                customerOptions: [],
                rewardOptions: [],
                init: function() {
                    Livewire.hook('component.init', ({
                        component
                    }) => {
                        const componentID = document.querySelector(
                            '[data-component-id="form-point-redemption"]')?.getAttribute(
                            'wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.tableStore = Alpine.store('pointRedemptionTableStore');
                            this.component.$wire.call('customer').then(response => {
                                const {
                                    success,
                                    data
                                } = response;
                                if (success) {
                                    let customerOptions = [];
                                    data.forEach(function(v, k) {
                                        const option = {
                                            id: v.id,
                                            text: v.name
                                        };
                                        customerOptions.push(option);
                                    });
                                    this.customerOptions = customerOptions;
                                } else {
                                    this.toastStore.failed('failed to load customer data');
                                }
                            });
                            this.component.$wire.call('reward').then(response => {
                                const {
                                    success,
                                    data
                                } = response;
                                if (success) {
                                    let rewardOptions = [];
                                    data.forEach(function(v, k) {
                                        const option = {
                                            id: v.id,
                                            text: `${v.name} (${v.point})`
                                        };
                                        rewardOptions.push(option);
                                    });
                                    this.rewardOptions = rewardOptions;
                                } else {
                                    this.toastStore.failed('failed to load reward data');
                                }
                            });
                        }
                    });
                },
                onChangeCustomer(item) {
                    this.form.customerId = item.id;
                },
                onChangeReward(item) {
                    this.form.rewardId = item.id;
                },
                formReset() {
                    this.form = {
                        ...INITIAL_FORM
                    };
                    this.form.customerId = '';
                    this.form.rewardId = '';
                    this.formType = 'create';
                    this.formValidator = {};
                },
                showModal(formType = 'create') {
                    this.showModalForm = true;
                    this.type = formType;
                    this.component.$wire.call('customer').then(response => {
                        const {
                            success,
                            data
                        } = response;
                        if (success) {
                            let customerOptions = [];
                            data.forEach(function(v, k) {
                                const option = {
                                    id: v.id,
                                    text: v.name
                                };
                                customerOptions.push(option);
                            });
                            this.customerOptions = customerOptions;
                        } else {
                            this.toastStore.failed('failed to load customer data');
                        }
                    });
                    this.component.$wire.call('reward').then(response => {
                        const {
                            success,
                            data
                        } = response;
                        if (success) {
                            let rewardOptions = [];
                            data.forEach(function(v, k) {
                                const option = {
                                    id: v.id,
                                    text: `${v.name} (${v.point})`
                                };
                                rewardOptions.push(option);
                            });
                            this.rewardOptions = rewardOptions;
                        } else {
                            this.toastStore.failed('failed to load reward data');
                        }
                    });
                },
                closeModal() {
                    this.formReset();
                    this.showModalForm = false;
                },
                async mutate() {
                    this.loading = true;
                    const response = await this.component.$wire.call(this.formType, this.form);
                    const {
                        success,
                        data,
                        status,
                        message
                    } = response;
                    if (success) {
                        this.closeModal();
                        this.toastStore.success(message);
                        this.tableStore.onFindAll();
                    } else {
                        switch (status) {
                            case 422:
                                this.formValidator = data;
                                this.toastStore.failed('please fill the correct form');
                                break;
                            case 500:
                                this.toastStore.failed('internal server error');
                                break;
                            default:
                                this.toastStore.failed('unknown error');
                                break;
                        }
                    }
                    this.loading = false;
                },
            };
            Alpine.store('pointRedemptionFormStore', STORE_PROPS);
        });
    </script>
@endpush
