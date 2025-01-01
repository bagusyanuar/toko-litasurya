<div data-component-id="form-category">
    <x-modal.ui-modal-form
        title="$store.formCategoryStore.title"
        open="$store.formCategoryStore.isOpen"
        handleClose="$store.formCategoryStore.setCloseModal()"
    >
        <x-slot name="body">
            <x-input.text.ui-form-text
                id="name"
                label="Nama Kategori"
                placeholder="Nama Kategori"
                wire:model="name"
                parentClassName="mb-3"
                x-bind:disabled="$store.formCategoryStore.loading"
                validatorKey="$store.formCategoryStore.validator"
                validatorField="name"
            ></x-input.text.ui-form-text>
            <x-input.file.ui-dropzone
                label="Gambar"
                dropID="dropCategory"
                dropLoading="$store.formCategoryStore.loading"></x-input.file.ui-dropzone>
        </x-slot>
        <x-slot name="action">
            <x-button.ui-button-loading
                fill="outlined"
                x-bind:disabled="$store.formCategoryStore.loading"
                x-on:click="$store.formCategoryStore.setCloseModal()"
            >
                <span>Batal</span>
            </x-button.ui-button-loading>
            <x-button.ui-button-loading
                fill="contained"
                x-on:click="$store.formCategoryStore.mutate()"
                x-bind:disabled="$store.formCategoryStore.loading"
            >
                <template x-if="!$store.formCategoryStore.loading">
                    <span>Simpan</span>
                </template>
                <template x-if="$store.formCategoryStore.loading">
                    <x-loader.button-loader></x-loader.button-loader>
                </template>
            </x-button.ui-button-loading>
        </x-slot>
    </x-modal.ui-modal-form>
</div>
