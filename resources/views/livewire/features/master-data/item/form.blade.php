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
            class="modal-body px-6 pt-6 pb-6 overflow-y-scroll flex-grow-1 h-[40rem]"
        >
            <div class="w-full flex items-start gap-1 border-b border-neutral-300 mb-3">
                <div class="w-fit flex flex-col justify-center items-center mb-6">
                    <div
                        class="w-6 h-6 text-xs rounded-full bg-brand-500 text-white flex items-center justify-center mb-1">
                        1
                    </div>
                    <span class="text-neutral-700 text-xs text-center max-w-[5rem]">Item Information</span>
                </div>
                <div class="h-6 flex flex-col justify-center w-full">
                    <div class="spacer h-[2px] w-full bg-brand-500"
                         x-bind:class="$store.itemFormStore.step === 2 ? 'bg-brand-500' : 'bg-neutral-500'"></div>
                </div>
                <div class="w-fit flex flex-col justify-center items-center mb-6">
                    <div
                        class="w-6 h-6 text-xs rounded-full bg-brand-500 text-white flex items-center justify-center mb-1"
                        x-bind:class="$store.itemFormStore.step === 2 ? 'bg-brand-500 text-white' : 'bg-neutral-500 text-neutral-700'"
                    >2
                    </div>
                    <span
                        class="text-neutral-700 text-xs text-center max-w-[5rem]"
                    >Item Pricing</span>
                </div>
            </div>
            <div
                class="w-full"
                x-show="$store.itemFormStore.step === 1"
            >
                <x-gxui.input.select.select2
                    store="itemFormStore"
                    options="categoryOptions"
                    label="Category"
                    parentClassName="mb-3"
                    selectID="categorySelect"
                    validatorKey="$store.itemFormStore.formValidator"
                    validatorField="category_id"
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
                    x-model="$store.itemFormStore.form.description"
                    x-bind:disabled="$store.itemFormStore.loading"
                    validatorKey="$store.itemFormStore.formValidator"
                    validatorField="description"
                ></x-gxui.input.text.text>
            </div>
            <div
                class="w-full"
                x-cloak
                x-show="$store.itemFormStore.step === 2"
            >
                <div class="w-full mb-5">
                    <p class="text-sm text-neutral-700 font-bold mb-3">Retail Price</p>
                    <x-gxui.input.text.text
                        placeholder="ex: 91285996869"
                        label="PLU"
                        parentClassName="mb-3"
                        x-model="$store.itemFormStore.form.pricing[0].plu"
                        x-bind:disabled="$store.itemFormStore.loading"
                        validatorKey="$store.itemFormStore.formValidator"
                        validatorField="pricing.0.plu"
                    ></x-gxui.input.text.text>
                    <x-gxui.input.text.text
                        placeholder="ex: 91285996869"
                        label="Price (IDR)"
                        parentClassName="mb-3"
                        x-model="$store.itemFormStore.form.pricing[0].price"
                        x-bind:disabled="$store.itemFormStore.loading"
                        validatorKey="$store.itemFormStore.formValidator"
                        validatorField="pricing.0.price"
                    ></x-gxui.input.text.text>
                    <x-gxui.input.text.text
                        placeholder="description"
                        label="Description"
                        parentClassName="mb-3"
                        x-model="$store.itemFormStore.form.pricing[0].description"
                        x-bind:disabled="$store.itemFormStore.loading"
                    ></x-gxui.input.text.text>
                </div>
                <p class="text-sm text-neutral-700 font-bold mb-3">Dozen Price</p>
                <x-gxui.input.text.text
                    placeholder="ex: 25.000"
                    label="PLU"
                    parentClassName="mb-3"
                    x-model="$store.itemFormStore.form.pricing[1].plu"
                    x-bind:disabled="$store.itemFormStore.loading"
                    validatorKey="$store.itemFormStore.formValidator"
                    validatorField="pricing.1.plu"
                ></x-gxui.input.text.text>
                <x-gxui.input.text.text
                    placeholder="ex: 10.000"
                    label="Price (IDR)"
                    parentClassName="mb-3"
                    x-model="$store.itemFormStore.form.pricing[1].price"
                    x-bind:disabled="$store.itemFormStore.loading"
                    validatorKey="$store.itemFormStore.formValidator"
                    validatorField="pricing.1.price"
                ></x-gxui.input.text.text>
                <x-gxui.input.text.text
                    placeholder="description"
                    label="Description"
                    parentClassName="mb-3"
                    x-model="$store.itemFormStore.form.pricing[1].description"
                    x-bind:disabled="$store.itemFormStore.loading"
                ></x-gxui.input.text.text>
                <p class="text-sm text-neutral-700 font-bold mb-3">Carton Price</p>
                <x-gxui.input.text.text
                    placeholder="ex: 25.000"
                    label="PLU"
                    parentClassName="mb-3"
                    x-model="$store.itemFormStore.form.pricing[2].plu"
                    x-bind:disabled="$store.itemFormStore.loading"
                    validatorKey="$store.itemFormStore.formValidator"
                    validatorField="pricing.2.plu"
                ></x-gxui.input.text.text>
                <x-gxui.input.text.text
                    placeholder="ex: 10.000"
                    label="Price (IDR)"
                    parentClassName="mb-3"
                    x-model="$store.itemFormStore.form.pricing[2].price"
                    x-bind:disabled="$store.itemFormStore.loading"
                    validatorKey="$store.itemFormStore.formValidator"
                    validatorField="pricing.2.price"
                ></x-gxui.input.text.text>
                <x-gxui.input.text.text
                    placeholder="description"
                    label="Description"
                    parentClassName="mb-3"
                    x-model="$store.itemFormStore.form.pricing[2].description"
                    x-bind:disabled="$store.itemFormStore.loading"
                ></x-gxui.input.text.text>
                <p class="text-sm text-neutral-700 font-bold mb-3">Trader Price</p>
                <x-gxui.input.text.text
                    placeholder="ex: 25.000"
                    label="PLU"
                    parentClassName="mb-3"
                    x-model="$store.itemFormStore.form.pricing[3].plu"
                    x-bind:disabled="$store.itemFormStore.loading"
                    validatorKey="$store.itemFormStore.formValidator"
                    validatorField="pricing.3.plu"
                ></x-gxui.input.text.text>
                <x-gxui.input.text.text
                    placeholder="ex: 10.000"
                    label="Price (IDR)"
                    parentClassName="mb-3"
                    x-model="$store.itemFormStore.form.pricing[3].price"
                    x-bind:disabled="$store.itemFormStore.loading"
                    validatorKey="$store.itemFormStore.formValidator"
                    validatorField="pricing.3.price"
                ></x-gxui.input.text.text>
                <x-gxui.input.text.text
                    placeholder="description"
                    label="Description"
                    parentClassName="mb-3"
                    x-model="$store.itemFormStore.form.pricing[3].description"
                    x-bind:disabled="$store.itemFormStore.loading"
                ></x-gxui.input.text.text>
            </div>
        </div>
        <div
            class="modal-footer w-full w-full flex items-center justify-end gap-2 px-4 py-3 border-t border-neutral-300"
            x-cloak
            x-show="$store.itemFormStore.step === 1"
        >
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.itemFormStore.step = 2"
                class="!px-6"
            >
                <div class="w-full flex justify-center items-center gap-1 text-sm">
                    <span>Next</span>
                </div>
            </x-gxui.button.button>
        </div>
        <div
            class="modal-footer w-full flex items-center justify-between gap-2 px-4 py-3 border-t border-neutral-300"
            x-cloak
            x-show="$store.itemFormStore.step === 2"
        >
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.itemFormStore.step = 1"
                x-bind:disabled="$store.itemFormStore.loading"
                class="!px-6 bg-white !border-brand-500 !text-brand-500 hover:!text-white disabled:!bg-white"
            >
                <div class="w-full flex justify-center items-center gap-1 text-sm">
                    <span>Previous</span>
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
                description: '',
                pricing: [
                    {
                        plu: '',
                        price: 0,
                        description: '',
                        unit: 'retail'
                    },
                    {
                        plu: '',
                        price: 0,
                        description: '',
                        unit: 'dozen'
                    },
                    {
                        plu: '',
                        price: 0,
                        description: '',
                        unit: 'carton'
                    },
                    {
                        plu: '',
                        price: 0,
                        description: '',
                        unit: 'trader'
                    },
                ]
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
                step: 1,
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
                            this.component.$wire.call('categories').then(response => {
                                const {success, data} = response;
                                if (success) {
                                    let categoryOptions = [];
                                    data.forEach(function (v, k) {
                                        const option = {id: v.id, text: v.name};
                                        categoryOptions.push(option);
                                    })
                                    this.categoryOptions = categoryOptions;
                                } else {
                                    this.toastStore.failed('failed to load item data');
                                }
                            });


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
                    console.log(this.form.pricing)
                    // this.fileDropper.disable();
                    // this.loading = true;
                    // const uploadPromises = this.fileDropper.files.map(file => {
                    //     return new Promise((resolve, reject) => {
                    //         this.component.$wire.upload('file', file, resolve, reject);
                    //     });
                    // });
                    // await Promise.all(uploadPromises);
                    const response = await this.component.$wire.call('create', this.form);
                    console.log(response)
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
                    // this.fileDropper.enable();
                    // this.loading = false;
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
