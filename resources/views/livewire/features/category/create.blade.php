<div
    data-component-id="category-create"
>
    <x-modal.ui-modal-form
        title="Form Tambah Kategori"
        open="$store.categoryCreate.modalCreate"
        handleClose="$store.categoryCreate.setCloseModal()"
    >
        <x-slot name="trigger">
            <x-button.ui-button
                x-on:click="$store.categoryCreate.setOpenModal()"
                wire:ignore
            >
                <div class="w-full flex justify-center items-center">
                    <i data-lucide="plus" class="h-4 aspect-[1/1]"></i>
                    <span>Tambah Kategori</span>
                </div>
            </x-button.ui-button>
        </x-slot>
        <x-slot name="body">
            <x-input.text.ui-form-text
                id="name"
                label="Nama Kategori"
                placeholder="Nama Kategori"
                wire:model="name"
                parentClassName="mb-3"
                x-bind:disabled="$store.categoryCreate.loading"
                validatorKey="$store.categoryCreate.validator"
                validatorField="name"
            ></x-input.text.ui-form-text>
            <x-input.file.ui-dropzone
                label="Gambar"
                dropData="imageCategory"
                dropInit="initDropzone"
                dropRef="dropCategory"
                dropLoading="$store.categoryCreate.loading"
            >
            </x-input.file.ui-dropzone>
        </x-slot>
        <x-slot name="action">
            <x-button.ui-button-loading
                fill="outlined"
                x-bind:disabled="$store.categoryCreate.loading"
                x-on:click="$store.categoryCreate.setCloseModal()"
            >
                <span>Batal</span>
            </x-button.ui-button-loading>
            <x-button.ui-button-loading
                fill="contained"
                x-on:click="$store.categoryCreate.onSubmit()"
                x-bind:disabled="$store.categoryCreate.loading"
            >
                <template x-if="!$store.categoryCreate.loading">
                    <span>Simpan</span>
                </template>
                <template x-if="$store.categoryCreate.loading">
                    <x-loader.button-loader></x-loader.button-loader>
                </template>
            </x-button.ui-button-loading>
        </x-slot>
    </x-modal.ui-modal-form>
</div>
@push('scripts')
    @vite('resources/js/features/category/create.js')
@endpush


{{--<x-modal.modal-form--}}
{{--    modalID="modalNewCategory"--}}
{{--    formTitle="Tambah Kategori"--}}
{{-->--}}
{{--    <x-slot name="trigger">--}}
{{--        <x-button.button-loading--}}
{{--            loadingTarget=""--}}
{{--            loadingText="Loading"--}}
{{--            x-on:click="modalNewCategory = true"--}}
{{--            class="flex justify-center items-center"--}}
{{--            wire:ignore--}}
{{--        >--}}
{{--            <div class="w-full flex justify-center items-center">--}}
{{--                <i data-lucide="plus" class="h-4 aspect-[1/1]"></i>--}}
{{--                <span>Tambah Kategori</span>--}}
{{--            </div>--}}
{{--        </x-button.button-loading>--}}
{{--    </x-slot>--}}
{{--    <x-slot name="body">--}}
{{--        <x-input.text.form-text--}}
{{--            id="name"--}}
{{--            label="Nama Kategori"--}}
{{--            placeholder="Nama Kategori"--}}
{{--            wire:model="name"--}}
{{--            parentClassName="mb-3"--}}
{{--        ></x-input.text.form-text>--}}
{{--        <x-input.file.dropzone--}}
{{--            dropRef="category"--}}
{{--            loadingKey="category-loading"--}}
{{--            dispatcher="createNewCategory"--}}
{{--            dispatchKey="CreateCategory"--}}
{{--            afterDispatch="this.modalNewCategory = false;"--}}
{{--            targetName="file"--}}
{{--            label="Gambar Kategori"--}}
{{--            wire:key="{{ uniqid('create-category-') }}"--}}
{{--        ></x-input.file.dropzone>--}}
{{--    </x-slot>--}}
{{--    <x-slot name="action">--}}
{{--        <x-button.ui-button-loading--}}
{{--            fill="outlined"--}}
{{--            x-bind:disabled="$store.category.loading"--}}
{{--            x-on:click="modalNewCategory = false;"--}}
{{--        >--}}
{{--            <span>Batal</span>--}}
{{--        </x-button.ui-button-loading>--}}
{{--        <x-button.ui-button-loading--}}
{{--            fill="contained"--}}
{{--            x-on:click="$store.category.onSubmit()"--}}
{{--            x-bind:disabled="$store.category.loading"--}}
{{--        >--}}
{{--            <template x-if="!$store.category.loading">--}}
{{--                <span>Simpan</span>--}}
{{--            </template>--}}
{{--            <template x-if="$store.category.loading">--}}
{{--                <x-loader.button-loader></x-loader.button-loader>--}}
{{--            </template>--}}
{{--        </x-button.ui-button-loading>--}}
{{--        --}}{{--        <x-button.button-loading--}}
{{--        --}}{{--            theme="outline"--}}
{{--        --}}{{--            loadingTarget="window.dropzoneInstanceCreateCategory.eventCreateCategory()"--}}
{{--        --}}{{--            loadingText="Loading"--}}
{{--        --}}{{--            x-on:click="modalNewCategory = false"--}}
{{--        --}}{{--            class="flex justify-center items-center"--}}
{{--        --}}{{--            :mutate="false"--}}
{{--        --}}{{--        >--}}
{{--        --}}{{--            <span>Batal</span>--}}
{{--        --}}{{--        </x-button.button-loading>--}}
{{--        --}}{{--        <x-button.button-dropzone--}}
{{--        --}}{{--            dropEvent="window.dropzoneInstanceCreateCategory.eventCreateCategory()"--}}
{{--        --}}{{--            loadingKey="category-loading"--}}
{{--        --}}{{--        >--}}
{{--        --}}{{--            <span>Tambah</span>--}}
{{--        --}}{{--        </x-button.button-dropzone>--}}
{{--    </x-slot>--}}
{{--</x-modal.modal-form>--}}
