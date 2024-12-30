<div
    data-component-id="modal-category"
>
    <x-modal.ui-modal-form
        title="Form Tambah Kategori"
        open="$store.modalCategoryStore.isOpen"
        handleClose="$store.modalCategoryStore.setCloseModal()"
    >
        <x-slot name="body">
            <x-input.text.ui-form-text
                id="name"
                label="Nama Kategori"
                placeholder="Nama Kategori"
                wire:model="name"
                parentClassName="mb-3"
                {{--            x-bind:disabled="$store.modalCategory.loading"--}}
                {{--            validatorKey="$store.modalCategory.validator"--}}
                {{--            validatorField="name"--}}
            ></x-input.text.ui-form-text>
        </x-slot>
    </x-modal.ui-modal-form>
</div>
