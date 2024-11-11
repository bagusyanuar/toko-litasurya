<x-modal.modal-form
    modalID="modalNewCategory"
    formTitle="Tambah Kategori"
>
    <x-slot name="trigger">
        <x-button.button-loading
            loadingTarget=""
            loadingText="Loading"
            x-on:click="modalNewCategory = true"
            class="flex justify-center items-center"
        >
            <div class="w-full flex justify-center items-center">
                <i data-lucide="plus" class="h-4 aspect-[1/1]"></i>
                <span>Tambah Kategori</span>
            </div>
        </x-button.button-loading>
    </x-slot>
    <x-slot name="body">
        <x-input.text.form-text
            id="name"
            label="Nama Kategori"
            placeholder="Nama Kategori"
            parentClassName="mb-3"
        ></x-input.text.form-text>
    </x-slot>
</x-modal.modal-form>
