<section
    id="section-form-route"
    data-component-id="form-route"
>
    <x-gxui.modal.form
        show="$store.routeFormStore.showModalForm"
        width="30rem"
    >
        <div
            class="modal-header flex items-center justify-between px-4 py-3 border-b border-neutral-300 rounded-t">
            <span class="text-neutral-700 font-semibold">Form New Route</span>
            <button
                type="button"
                x-on:click="$store.routeFormStore.closeModal()"
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
            <x-gxui.input.text.text
                placeholder="Name"
                label="Name"
                parentClassName="mb-3"
                x-model="$store.routeFormStore.form.name"
                x-bind:disabled="$store.routeFormStore.loading"
                validatorKey="$store.routeFormStore.formValidator"
                validatorField="name"
            ></x-gxui.input.text.text>
            <x-gxui.input.select.select2-multiple
                store="routeFormStore"
                options="storeOptions"
                label="Store"
                parentClassName="mb-3 flex-1"
                selectID="storeSelect"
                validatorKey="$store.routeFormStore.formValidator"
                validatorField="stores"
            ></x-gxui.input.select.select2-multiple>
        </div>
        <div class="modal-footer w-full flex items-center justify-end gap-2 px-4 py-3 border-t border-neutral-300">
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.routeFormStore.closeModal()"
                x-bind:disabled="$store.routeFormStore.loading"
                class="!px-6 bg-white !border-brand-500 !text-brand-500 hover:!text-white disabled:!bg-white disabled:!text-brand-500"
            >
                <div class="w-full flex justify-center items-center gap-1 text-sm">
                    <span>Cancel</span>
                </div>
            </x-gxui.button.button>
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.routeFormStore.mutate()"
                x-bind:disabled="$store.routeFormStore.loading"
                class="!px-6"
            >
                <template x-if="!$store.routeFormStore.loading">
                    <div class="w-full flex justify-center items-center gap-1 text-sm">
                        <span>Submit</span>
                    </div>
                </template>
                <template x-if="$store.routeFormStore.loading">
                    <x-gxui.loader.button-loader></x-gxui.loader.button-loader>
                </template>
            </x-gxui.button.button>
        </div>
    </x-gxui.modal.form>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const INITIAL_FORM = {id: '', name: ''};
            const STORE_PROPS = {
                component: null,
                toastStore: null,
                tableStore: null,
                showModalForm: false,
                select2Store: null,
                loading: false,
                formType: 'create',
                formValidator: {},
                form: {...INITIAL_FORM},
                storeOptions: [],
                storeValues: [],
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="form-route"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.tableStore = Alpine.store('routeTableStore');
                            let selectElement = document.getElementById("storeSelect");
                            this.select2Store = Alpine.store('gxuiSelectStore')
                                .initSelect2Multiple(
                                    selectElement,
                                    this.onChangeCategory.bind(this),
                                    {placeholder: 'choose a store'}
                                );
                            this.component.$wire.call('stores').then(response => {
                                const {success, data} = response;
                                if (success) {
                                    let storeOptions = [];
                                    data.forEach(function (v, k) {
                                        const option = {id: v.id, text: v.name};
                                        storeOptions.push(option);
                                    });
                                    this.storeOptions = storeOptions;
                                } else {
                                    this.toastStore.failed('failed to load store option');
                                }
                            });
                        }
                    });
                },
                onChangeCategory(items) {
                    this.storeValues = items;
                    console.log(items);
                },
                formReset() {
                    this.form = {...INITIAL_FORM};
                    this.storeValues = [];
                    this.formType = 'create';
                    this.formValidator = {};
                },
                showModal(formType = 'create') {
                    this.showModalForm = true;
                    this.type = formType;
                },
                closeModal() {
                    this.formReset();
                    this.showModalForm = false;
                },
                async mutate() {
                    this.loading = true;
                    const stores = this.storeValues.map((v, k) => {
                        return {customer_id: v};
                    });
                    const form = {...this.form, stores: stores};
                    const response = await this.component.$wire.call(this.formType, form);
                    const {success, data, status, message} = response;
                    if (success) {
                        if (this.formType === 'update') {
                            this.closeModal();
                        } else {
                            this.formReset();
                        }
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
                hydrateForm(data) {
                    this.formType = 'update';
                    this.form = data;
                    this.storeValues = data['details'].map((v, k) => {
                        return v['customer_id'];
                    });
                    $('#storeSelect').val(this.storeValues).trigger('change');
                    this.showModalForm = true;
                }
            };
            Alpine.store('routeFormStore', STORE_PROPS);
        });
    </script>
@endpush
