<div>
    <x-alert.success
        message="{{ $sessionMessage }}"
    ></x-alert.success>
    <x-alert.error
        message="{{ $sessionMessage }}"
    ></x-alert.error>
    <x-typography.page-title
        title="Halaman Barang"
        class="mb-3"
    ></x-typography.page-title>
    <x-container.card>
        <div class="flex items-center justify-between mb-3">
            <x-typography.section-title
                title="Data Barang"
            ></x-typography.section-title>
            <x-button.button-link to="{{ route('item.create') }}">
                <div class="w-full flex justify-center items-center">
                    <i data-lucide="plus" class="h-4 aspect-[1/1]"></i>
                    <span class="leading-none">Tambah Barang</span>
                </div>
            </x-button.button-link>
        </div>
        <x-spacer.divider class="mb-3"></x-spacer.divider>
        <livewire:features.item.lists/>
    </x-container.card>
</div>
