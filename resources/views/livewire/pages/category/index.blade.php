<div>
    <x-alert.ui-alert
        show="$store.categoryIndex.notification"
        handleClose="$store.categoryIndex.setNotification(false)"
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
            <livewire:features.category.create wire:id="createComponent"/>
        </div>
        <x-spacer.divider class="mb-3"></x-spacer.divider>
        <livewire:features.category.lists/>
    </x-container.card>
</div>
@push('scripts')
    @vite('resources/js/features/category/index.js')
@endpush



