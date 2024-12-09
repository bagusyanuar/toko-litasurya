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
        <livewire:features.item.form-create />
{{--        <div class="w-full flex gap-3">--}}
{{--            <div class="flex-1 border-r border-neutral-300 pr-3">--}}
{{--                <p class="mb-3 font-semibold text-neutral-500 text-xs">--}}
{{--                    Data Informasi Barang--}}
{{--                </p>--}}
{{--                <x-input.text.form-text--}}
{{--                    id="name"--}}
{{--                    label="Nama Barang"--}}
{{--                    placeholder="Nama Barang"--}}
{{--                    wire:model="name"--}}
{{--                    parentClassName="mb-3"--}}
{{--                ></x-input.text.form-text>--}}
{{--                <div class="w-full mb-3">--}}
{{--                    <x-input.select.select2--}}
{{--                        model="category"--}}
{{--                        label="Kategori"--}}
{{--                        id="categoryID"--}}
{{--                        :options="$categoryOptions"--}}
{{--                    ></x-input.select.select2>--}}
{{--                </div>--}}
{{--                <x-input.textarea.form-textarea--}}
{{--                    id="description"--}}
{{--                    rows="5"--}}
{{--                    label="Deskripsi"--}}
{{--                    placeholder="Deskripsi"--}}
{{--                    wire:model="description"--}}
{{--                    parentClassName="mb-1"--}}
{{--                ></x-input.textarea.form-textarea>--}}
{{--                <x-input.file.dropzone--}}
{{--                    dropRef="category"--}}
{{--                    dispatcher="createNewCategory"--}}
{{--                    dispatchKey="CreateCategory"--}}
{{--                    afterDispatch="this.modalNewCategory = false;"--}}
{{--                    targetName="file"--}}
{{--                    label="Gambar Kategori"--}}
{{--                    wire:key="{{ uniqid('create-category-') }}"--}}
{{--                ></x-input.file.dropzone>--}}
{{--                <button x-on:click="$wire.onSave()">cek</button>--}}
{{--            </div>--}}
{{--            <div class="flex-1">--}}
{{--                <p class="mb-3 font-semibold text-neutral-500 text-xs">--}}
{{--                    Data Harga Barang--}}
{{--                </p>--}}
{{--                <x-input.text.form-text--}}
{{--                    id="retailPrice"--}}
{{--                    label="Harga PCS"--}}
{{--                    placeholder="0"--}}
{{--                    wire:model="retailPrice"--}}
{{--                    parentClassName="mb-3"--}}
{{--                    x-mask:dynamic="$money($input, ',')"--}}
{{--                    class="text-right"--}}
{{--                ></x-input.text.form-text>--}}
{{--                <x-input.text.form-text--}}
{{--                    id="dozenPrice"--}}
{{--                    label="Harga Lusin"--}}
{{--                    placeholder="0"--}}
{{--                    wire:model="dozenPrice"--}}
{{--                    parentClassName="mb-3"--}}
{{--                    x-mask:dynamic="$money($input, ',')"--}}
{{--                    class="text-right"--}}
{{--                ></x-input.text.form-text>--}}
{{--                <div class="mb-3 flex gap-3 w-full">--}}
{{--                    <x-input.text.form-text--}}
{{--                        id="cartonPrice"--}}
{{--                        label="Harga Karton"--}}
{{--                        placeholder="0"--}}
{{--                        wire:model="cartonPrice"--}}
{{--                        x-mask:dynamic="$money($input, ',')"--}}
{{--                        class="text-right"--}}
{{--                        parentClassName="w-full"--}}
{{--                    ></x-input.text.form-text>--}}
{{--                    <x-input.text.form-text--}}
{{--                        id="cartonPriceDescription"--}}
{{--                        label="Isi Karton"--}}
{{--                        placeholder="Keterangan"--}}
{{--                        wire:model="cartonPriceDescription"--}}
{{--                        parentClassName="w-full"--}}
{{--                    ></x-input.text.form-text>--}}
{{--                </div>--}}
{{--                <div class="mb-3 flex gap-3 w-full">--}}
{{--                    <x-input.text.form-text--}}
{{--                        id="cartonPrice"--}}
{{--                        label="Harga Karton"--}}
{{--                        placeholder="0"--}}
{{--                        wire:model="cartonPrice"--}}
{{--                        x-mask:dynamic="$money($input, ',')"--}}
{{--                        class="text-right"--}}
{{--                        parentClassName="w-full"--}}
{{--                    ></x-input.text.form-text>--}}
{{--                    <x-input.text.form-text--}}
{{--                        id="cartonPriceDescription"--}}
{{--                        label="Isi Karton"--}}
{{--                        placeholder="Keterangan"--}}
{{--                        wire:model="cartonPriceDescription"--}}
{{--                        parentClassName="w-full"--}}
{{--                    ></x-input.text.form-text>--}}
{{--                </div>--}}
{{--                <div class="flex justify-end w-full">--}}
{{--                    <x-button.button>Tambah</x-button.button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </x-container.card>
</div>
