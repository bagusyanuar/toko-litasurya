<div>
    <x-alert.success
        message="{{ $sessionMessage }}"
    ></x-alert.success>
    <x-alert.error
        message="{{ $sessionMessage }}"
    ></x-alert.error>
    <x-typography.page-title
        title="Halaman Tambah Barang"
        class="mb-3"
    ></x-typography.page-title>
    <x-container.card>
        <div class="flex items-center justify-between mb-3">
            <x-typography.section-title
                title="Form Data Barang"
            ></x-typography.section-title>
        </div>
        <x-spacer.divider class="mb-3"></x-spacer.divider>
        <div class="w-full flex gap-3">
            <div class="flex-1 border-r border-neutral-300 pr-3">
                <p class="mb-3 font-semibold text-neutral-500 text-xs">
                    Data Informasi Barang
                </p>
                <x-input.text.form-text
                    id="name"
                    label="Nama Barang"
                    placeholder="Nama Barang"
                    wire:model="name"
                    parentClassName="mb-3"
                ></x-input.text.form-text>
                <x-input.select.select2
                    id="categoryID"
                    :options="$categoryOptions"
                ></x-input.select.select2>
            </div>
            <div class="flex-1">
                <p class="mb-0 font-semibold text-neutral-500 text-xs">
                    Data Harga Barang
                </p>
            </div>
        </div>
    </x-container.card>
</div>
