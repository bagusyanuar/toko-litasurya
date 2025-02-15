<section
    id="section-form-category"
    data-component-id="form-category"
>
    <x-gxui.modal.form
        show="$store.categoryFormStore.modalFormShow"
    >
        <div
            class="modal-header flex items-center justify-between px-4 py-3 border-b border-neutral-300 rounded-t">
            <span class="text-neutral-700 font-semibold">Form New Category</span>
            <button
                type="button"
                x-on:click="$store.categoryFormStore.setCloseModalForm()"
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
                x-model="$store.categoryFormStore.form.name"
                x-bind:disabled="$store.categoryFormStore.loading"
                validatorKey="$store.categoryFormStore.validator"
                validatorField="name"
            ></x-gxui.input.text.text>
            <x-gxui.input.file.file-dropper
                placeholder="Name"
                label="Image"
                dropperID="imageDropper"
                dropperLoading="$store.categoryFormStore.loading"
            ></x-gxui.input.file.file-dropper>
        </div>
        <div class="modal-footer w-full flex items-center justify-end gap-2 px-4 py-3 border-t border-neutral-300">
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.categoryFormStore.setCloseModalForm()"
                x-bind:disabled="$store.categoryFormStore.loading"
                class="!px-6 bg-white !border-brand-500 !text-brand-500 hover:!text-white disabled:!bg-white"
            >
                <div class="w-full flex justify-center items-center gap-1 text-sm">
                    <span>Cancel</span>
                </div>
            </x-gxui.button.button>
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.categoryFormStore.mutate()"
                x-bind:disabled="$store.categoryFormStore.loading"
                class="!px-6"
            >
                <template x-if="!$store.categoryFormStore.loading">
                    <div class="w-full flex justify-center items-center gap-1 text-sm">
                        <span>Submit</span>
                    </div>
                </template>
                <template x-if="$store.categoryFormStore.loading">
                    <x-gxui.loader.button-loader></x-gxui.loader.button-loader>
                </template>
            </x-gxui.button.button>
        </div>
    </x-gxui.modal.form>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('categoryFormStore', {
                componentID: document.querySelector('[data-component-id="form-category"]')?.getAttribute('wire:id'),
                form: {
                    name: '',
                },
                modalFormShow: false,
                fileDropper: null,
                loading: false,
                type: 'create',
                validator: {},
                toastStore: null,
                setOpenModalForm(type = 'create') {
                    this.modalFormShow = true;
                    this.type = type;
                },
                setCloseModalForm() {
                    this.resetForm();
                    this.modalFormShow = false;
                },
                resetForm() {
                    this.validator = {};
                    this.form.name = '';
                    this.fileDropper.removeAllFiles();
                    this.type = 'create';
                },
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === this.componentID) {
                            this.toastStore = Alpine.store('gxuiToastStore');
                            const dropperElement = document.getElementById('imageDropper');
                            this.fileDropper = Alpine.store('gxuiFileDropperStore').initDropper(dropperElement);
                        }
                    });
                },
                async mutate() {
                    this.fileDropper.disable();
                    this.loading = true;
                    const uploadPromises = this.fileDropper.files.map(file => {
                        return new Promise((resolve, reject) => {
                            window.Livewire.find(this.componentID).upload('file', file, resolve, reject)
                        });
                    });
                    await Promise.all(uploadPromises);
                    const formData = {name: this.form.name};
                    let response = await window.Livewire.find(this.componentID).call(this.type, formData);
                    switch (response['status']) {
                        case 422:
                            this.validator = response['data'];
                            this.toastStore.failed('please fill the correct form');
                            break;
                        case 201:
                            this.fileDropper.removeAllFiles();
                            Alpine.store('gxuiToastStore').success('successfully create new category');
                            Alpine.store('categoryTableStore').onFindAll();
                            break;
                        case 500:
                            Alpine.store('gxuiToastStore').failed('internal server error');
                            break;
                        default:
                            Alpine.store('gxuiToastStore').failed('unknown error');
                            break;
                    }
                    this.fileDropper.enable();
                    this.loading = false;
                },
                hydrateForm(id) {

                }
            });
        });
    </script>
@endpush
