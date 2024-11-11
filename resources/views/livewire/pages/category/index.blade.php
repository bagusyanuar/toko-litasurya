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
            <x-button.button-loading
                loadingTarget=""
                loadingText="Loading"
                x-on:click=""
                class="flex justify-center items-center"
            >
                <div class="w-full flex justify-center items-center">
                    <i data-lucide="plus" class="h-4 aspect-[1/1]"></i>
                    <span>New Category</span>
                </div>
            </x-button.button-loading>
        </div>
        <x-spacer.divider class="mb-3"></x-spacer.divider>
        <livewire:pages.category.section.data-list.category-list />
    </x-container.card>
</div>
