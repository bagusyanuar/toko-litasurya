<div
    data-component-id="category-create"
>
    <x-button.ui-button
        x-on:click="$store.modalCategoryStore.setOpenModal()"
        wire:ignore
    >
        <div class="w-full flex justify-center items-center">
            <i data-lucide="plus" class="h-4 aspect-[1/1]"></i>
            <span>Tambah Kategori</span>
        </div>
    </x-button.ui-button>
</div>
