<section
    id="section-form-admin"
    data-component-id="form-admin"
>
    <x-gxui.modal.form
        show="$store.adminFormStore.showModalForm"
        width="25rem"
    >
        <div
            class="modal-header flex items-center justify-between px-4 py-3 border-b border-neutral-300 rounded-t">
            <span class="text-neutral-700 text-sm font-semibold">Form New Admin</span>
            <button
                type="button"
                x-on:click="$store.adminFormStore.closeModal()"
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
                placeholder="Username"
                label="Username"
                parentClassName="mb-3"
                x-model="$store.adminFormStore.form.username"
                x-bind:disabled="$store.adminFormStore.loading"
                validatorKey="$store.adminFormStore.formValidator"
                validatorField="username"
            ></x-gxui.input.text.text>
            <x-gxui.input.text.text
                type="password"
                placeholder="Password"
                label="Password"
                parentClassName="mb-3"
                x-model="$store.adminFormStore.form.password"
                x-bind:disabled="$store.adminFormStore.loading"
                validatorKey="$store.adminFormStore.formValidator"
                validatorField="password"
            ></x-gxui.input.text.text>
        </div>
        <div class="modal-footer w-full flex items-center justify-end gap-2 px-4 py-3 border-t border-neutral-300">
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.adminFormStore.closeModal()"
                x-bind:disabled="$store.adminFormStore.loading"
                class="!px-6 bg-white !border-brand-500 !text-brand-500 hover:!text-white disabled:!bg-white disabled:!text-brand-500"
            >
                <div class="w-full flex justify-center items-center gap-1 text-xs">
                    <span>Cancel</span>
                </div>
            </x-gxui.button.button>
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.adminFormStore.mutate()"
                x-bind:disabled="$store.adminFormStore.loading"
                class="!px-6"
            >
                <template x-if="!$store.adminFormStore.loading">
                    <div class="w-full flex justify-center items-center gap-1 text-xs">
                        <span>Submit</span>
                    </div>
                </template>
                <template x-if="$store.adminFormStore.loading">
                    <x-gxui.loader.button-loader></x-gxui.loader.button-loader>
                </template>
            </x-gxui.button.button>
        </div>
    </x-gxui.modal.form>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const INITIAL_FORM = {id: '', username: '', password: ''};
            const STORE_PROPS = {
                component: null,
                toastStore: null,
                tableStore: null,
                showModalForm: false,
                loading: false,
                formType: 'create',
                formValidator: {},
                form: {...INITIAL_FORM},
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="form-admin"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.tableStore = Alpine.store('adminTableStore');
                        }
                    });
                },
                formReset() {
                    this.form = {...INITIAL_FORM};
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
                    const response = await this.component.$wire.call(this.formType, this.form);
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
                    this.form.id = data['id'];
                    this.form.username = data['username'];
                    this.form.password = '';
                    this.showModalForm = true;
                }
            };
            Alpine.store('adminFormStore', STORE_PROPS);
        });
    </script>
@endpush
