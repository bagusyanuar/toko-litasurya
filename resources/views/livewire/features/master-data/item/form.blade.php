<section
    id="section-form-item"
    data-component-id="form-item"
>
    <x-gxui.modal.form
        show="true"
        width="40rem"
    >
        <div
            class="modal-header flex items-center justify-between px-4 py-3 border-b border-neutral-300 rounded-t">
            <span class="text-neutral-700 font-semibold">Form New Item</span>
            <button
                type="button"
                x-on:click="$store.itemFormStore.closeModal()"
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
        <div
            class="modal-body px-6 pt-3 pb-6 overflow-y-scroll flex-grow-1 h-96"
            x-data="{step: 1}"
        >
            <div class="w-full flex items-start gap-1">
                <div class="w-fit flex flex-col justify-center items-center mb-6">
                    <div class="w-6 h-6 text-xs rounded-full bg-brand-500 text-white flex items-center justify-center mb-1">1</div>
                    <span class="text-neutral-700 text-xs text-center max-w-[5rem]">Item Information</span>
                </div>
                <div class="h-6 flex flex-col justify-center w-full">
                    <div class="spacer h-[2px] w-full bg-brand-500" x-bind:class="step === 2 ? 'bg-brand-500' : 'bg-neutral-500'"></div>
                </div>
                <div class="w-fit flex flex-col justify-center items-center mb-6">
                    <div
                        class="w-6 h-6 text-xs rounded-full bg-brand-500 text-white flex items-center justify-center mb-1"
                        x-bind:class="step === 2 ? 'bg-brand-500 text-white' : 'bg-neutral-500 text-neutral-700'"
                    >2</div>
                    <span
                        class="text-neutral-700 text-xs text-center max-w-[5rem]"
                    >Item Pricing</span>
                </div>
            </div>

            <x-gxui.input.select.select2
                store="itemFormStore"
                options="categoryOptions"
                label="Category"
                parentClassName="mb-3"
                selectID="categorySelect"
                validatorKey="$store.itemFormStore.formValidator"
                validatorField="category"
            ></x-gxui.input.select.select2>
            <x-gxui.input.text.text
                placeholder="Name"
                label="Name"
                parentClassName="mb-3"
                x-model="$store.itemFormStore.form.name"
                x-bind:disabled="$store.itemFormStore.loading"
                validatorKey="$store.itemFormStore.formValidator"
                validatorField="name"
            ></x-gxui.input.text.text>
            <x-gxui.input.file.file-dropper
                placeholder="Name"
                label="Image"
                dropperID="itemImageDropper"
                dropperLoading="$store.itemFormStore.loading"
                parentClassName="mb-3"
            ></x-gxui.input.file.file-dropper>
            <x-gxui.input.text.text
                placeholder="Description"
                label="Description"
                parentClassName="mb-3"
                x-model="$store.itemFormStore.form.name"
                x-bind:disabled="$store.itemFormStore.loading"
                validatorKey="$store.itemFormStore.formValidator"
                validatorField="name"
            ></x-gxui.input.text.text>
        </div>
        <div class="modal-footer w-full flex items-center justify-end gap-2 px-4 py-3 border-t border-neutral-300">
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.itemFormStore.setCloseModalForm()"
                x-bind:disabled="$store.itemFormStore.loading"
                class="!px-6 bg-white !border-brand-500 !text-brand-500 hover:!text-white disabled:!bg-white"
            >
                <div class="w-full flex justify-center items-center gap-1 text-sm">
                    <span>Cancel</span>
                </div>
            </x-gxui.button.button>
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.itemFormStore.mutate()"
                x-bind:disabled="$store.itemFormStore.loading"
                class="!px-6"
            >
                <template x-if="!$store.itemFormStore.loading">
                    <div class="w-full flex justify-center items-center gap-1 text-sm">
                        <span>Submit</span>
                    </div>
                </template>
                <template x-if="$store.itemFormStore.loading">
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
                id: '',
                name: '',
                category: '',
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
                form: {...INITIAL_FORM},
                categoryOptions: [],
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="form-item"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.tableStore = Alpine.store('itemTableStore');
                            const dropperElement = document.getElementById('itemImageDropper');
                            this.fileDropper = Alpine.store('gxuiFileDropperStore').initDropper(dropperElement);
                            let selectElement = document.getElementById("categorySelect");
                            this.select2Store = Alpine.store('gxuiSelectStore')
                                .initSelect2(
                                    selectElement,
                                    this.onChangeCategory.bind(this),
                                    {placeholder: 'choose a category'}
                                );
                            this.categoryOptions = [{id: '1', text: 'Option 1'}, {id: '2', text: 'Option 2'}];
                        }
                    });
                },
                onChangeCategory(item) {
                    this.form.category = item.id;
                    console.log(this.form);
                },
                formReset() {
                    this.form = {...INITIAL_FORM};
                    this.formType = 'create';
                    this.formValidator = {};
                    this.fileDropper.removeAllFiles();
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
                    this.fileDropper.disable();
                    this.loading = true;
                    const uploadPromises = this.fileDropper.files.map(file => {
                        return new Promise((resolve, reject) => {
                            this.component.$wire.upload('file', file, resolve, reject);
                        });
                    });
                    await Promise.all(uploadPromises);
                    const response = await this.component.$wire.call(this.formType, this.form);
                    const {success, data, status, message} = response;
                    if (success) {
                        this.fileDropper.removeAllFiles();
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
                    this.fileDropper.enable();
                    this.loading = false;
                },
                hydrateForm(data) {
                    this.formType = 'update';
                    this.form.id = data['id'];
                    this.form.name = data['name'];
                    this.showModalForm = true;
                }
            };
            Alpine.store('itemFormStore', STORE_PROPS);
        });
    </script>
@endpush
