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
    <x-slot name="action">
        <x-button.button-loading
            theme="outline"
            loadingTarget="createNewCategory"
            loadingText="Loading"
            x-on:click="modalNewCategory = false"
            class="flex justify-center items-center"
            :mutate="false"
        >
            <span>Batal</span>
        </x-button.button-loading>
        <x-button.button-loading
            loadingTarget="createNewCategory"
            loadingText="Loading"
            x-on:click="$wire.createNewCategory()"
            class="flex justify-center items-center"
        >
            <span>Tambah</span>
        </x-button.button-loading>
    </x-slot>
</x-modal.modal-form>
