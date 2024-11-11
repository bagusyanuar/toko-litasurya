<div>
    <x-typography.page-title
        title="Halaman Kategori"
        class="mb-3"
    ></x-typography.page-title>
    <x-container.card>
        <div class="flex items-center justify-between mb-3">
            <x-typography.section-title
                title="Data Kategori"
            ></x-typography.section-title>
            <livewire:pages.category.section.create/>
        </div>
        <x-spacer.divider class="mb-3"></x-spacer.divider>
        <livewire:pages.category.section.category-list/>
    </x-container.card>
</div>
