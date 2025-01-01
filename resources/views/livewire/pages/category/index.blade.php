<div>
    <x-alert.ui-alert
        show="$store.categoryIndex.notification"
        handleClose="$store.categoryIndex.setNotification(false)"
        timeToClose="2000"
    ></x-alert.ui-alert>
    <x-typography.page-title
        title="Halaman Kategori"
        class="mb-3"
    ></x-typography.page-title>
    <x-container.card>
        <div class="flex items-center justify-between mb-3">
            <x-typography.section-title
                title="Data Kategori"
            ></x-typography.section-title>
            <x-button.ui-button
                x-on:click="$store.formCategoryStore.setOpenModal()"
                wire:ignore
            >
                <div class="w-full flex justify-center items-center">
                    <i data-lucide="plus" class="h-4 aspect-[1/1]"></i>
                    <span>Tambah Kategori</span>
                </div>
            </x-button.ui-button>
        </div>
        <x-spacer.divider class="mb-3"></x-spacer.divider>
        <livewire:features.category.lists/>
    </x-container.card>
    <livewire:features.category.form-category/>
</div>
@push('scripts')
    @vite(['resources/js/features/category/index.js', 'resources/js/features/category/store/form-category-store.js'])
@endpush



