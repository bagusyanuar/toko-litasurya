<div class="w-full flex gap-3">
    <div class="w-full flex gap-3">
        <div class="flex-[3] border-r border-neutral-300 pr-3">
            <x-input.text.form-text
                id="name"
                label="Nama Barang"
                placeholder="Nama Barang"
                wire:model="name"
                parentClassName="mb-3"
            ></x-input.text.form-text>
            <div class="w-full mb-3">
                <x-input.select.select2
                    model="category"
                    label="Kategori"
                    id="categoryID"
                    :options="$categoryOptions"
                ></x-input.select.select2>
            </div>
            <x-input.textarea.form-textarea
                id="description"
                rows="5"
                label="Deskripsi"
                placeholder="Deskripsi"
                wire:model="description"
                parentClassName="mb-1"
            ></x-input.textarea.form-textarea>
            <x-input.file.dropzone
                dropRef="category"
                dispatcher="createNewCategory"
                dispatchKey="CreateCategory"
                afterDispatch="null"
                targetName="file"
                label="Gambar Barang"
                wire:key="{{ uniqid('create-item-') }}"
            ></x-input.file.dropzone>
        </div>
        <div class="flex-[2]">
            <x-input.text.form-text
                id="retail-price"
                label="Harga PCS (Rp.)"
                placeholder="0"
                wire:model="prices.0.value"
                parentClassName="mb-3"
                x-mask:dynamic="$money($input, ',')"
                class="text-right"
            ></x-input.text.form-text>
            <x-input.text.form-text
                id="dozen-price"
                label="Harga Lusin (Rp.)"
                placeholder="0"
                wire:model="prices.1.value"
                parentClassName="mb-3"
                x-mask:dynamic="$money($input, ',')"
                class="text-right"
            ></x-input.text.form-text>
            <div></div>
            <button x-on:click="$wire.cek()">Cek</button>
            <x-spacer.divider class="mb-3"></x-spacer.divider>
        </div>
    </div>
</div>
