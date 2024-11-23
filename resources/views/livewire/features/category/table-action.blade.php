<div
    class="flex items-center justify-center gap-1"
>
    <x-modal.modal-form
        modalID="modalUpdateCategory{{ $idx }}"
        formTitle="Edit Kategori"
    >
        <x-slot name="trigger">
            <x-table.components.button-edit
                x-on:click="modalUpdateCategory{{ $idx }} = true"
            >
            </x-table.components.button-edit>
        </x-slot>
        <x-slot name="body">
            <x-input.text.form-text
                id="name"
                label="Nama Kategori"
                placeholder="Nama Kategori"
                wire:model="name"
                parentClassName="mb-3"
            ></x-input.text.form-text>
            <x-input.file.dropzone
                dropRef="categoryEdit{{ $idx }}"
                dispatcher="onUpdateCategory"
                afterDispatch="this.modalUpdateCategory{{ $idx }} = false;"
                targetName="file"
                label="Gambar Kategori"
            ></x-input.file.dropzone>
        </x-slot>
        <x-slot name="action">
            <x-button.button-loading
                theme="outline"
                loadingTarget=""
                loadingText="Loading"
                x-on:click="modalUpdateCategory{{ $idx }} = false"
                class="flex justify-center items-center"
                :mutate="false"
            >
                <span>Batal</span>
            </x-button.button-loading>
            <x-button.button-loading
                loadingTarget=""
                loadingText="Loading"
                x-on:click="window.dropzoneInstance.uploadEvent()"
                class="flex justify-center items-center"
            >
                <span>Tambah</span>
            </x-button.button-loading>
        </x-slot>
    </x-modal.modal-form>
    <x-table.components.button-delete
        modalKey="modalDeleteCategory{{ $idx }}"
        processTarget="$wire.onDeleteCategory()"
        processTargetLoading="onDeleteCategory"
        targetMenu="Kategori"
        targetName="{{ $category->name }}"
    ></x-table.components.button-delete>
</div>
