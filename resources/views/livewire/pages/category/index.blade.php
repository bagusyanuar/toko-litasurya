<div>
    <x-alert.ui-alert timeToClose="2000"></x-alert.ui-alert>
    <x-alert.ui-alert-confirm handleSubmit="$store.formCategoryStore.onDelete()"></x-alert.ui-alert-confirm>
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
    @vite([
    'resources/js/features/category/store/category-page-store.js',
    'resources/js/features/category/store/form-category-store.js',
    'resources/js/features/shared/alert-store.js',
    'resources/js/features/shared/alert-confirm-store.js',
    'resources/js/features/shared/pop-over-bind.js',
    ])
@endpush



