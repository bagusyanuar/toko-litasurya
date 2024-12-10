<div x-data="{ currentStep: $wire.entangle('step') }">
    <div class="flex items-center w-full mb-5">
        <div class="flex items-center text-brand-500">
            <div class="w-8 aspect-[1/1] flex items-center justify-center border-2 border-blue-600 rounded-full">1</div>
            <span class="ml-2 text-sm">Informasi Barang</span>
        </div>
        <div class="flex-grow border-t-2 border-gray-300 mx-2"
             :class="{ '!border-brand-500': currentStep === 2 }"></div>
        <div class="flex items-center text-gray-500" :class="{ '!text-brand-500': currentStep === 2 }">
            <div class="w-8 aspect-[1/1] flex items-center justify-center border-2 border-gray-300 rounded-full"
                 :class="{ '!border-brand-500': currentStep === 2 }">2
            </div>
            <span class="ml-2 text-sm">Informasi Harga</span>
        </div>
    </div>
    <template x-if="currentStep === 1">
        <div class="mb-3">
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
                dropRef="item"
                dispatcher="createNewItem"
                dispatchKey="CreateItem"
                afterDispatch="null"
                targetName="image"
                label="Gambar Barang"
                wire:key="{{ uniqid('create-item-') }}"
            ></x-input.file.dropzone>
        </div>
    </template>
    <template x-if="currentStep === 2">
        <div class="mb-3" x-data="{
            initIcons() {
               setTimeout(() => { lucide.createIcons(); }, 0);
            }
        }"
             x-init="initIcons()">
            <div class="w-full flex items-center p-2 bg-brand-50 border border-neutral-300 rounded-[4px] mb-5"
                 wire:ignore>
                <i data-lucide="info" class="text-neutral-700 h-4 aspect-[1/1]"></i>
                <span class="ms-1 text-xs text-neutral-700">PLU diisi dengan kode barcode barang yang ingin disimpan, jika tidak ada silahkan membuat kode PLU sendiri.</span>
            </div>
            <div class="flex items-center w-full gap-3 mb-3">
                <div class="border border-neutral-300 rounded-[4px] p-4 w-full">
                    <p class="mb-0 text-sm font-bold">Harga PCS</p>
                    <x-spacer.divider class="my-3"></x-spacer.divider>
                    <x-input.text.form-text
                        id="retail-plu"
                        label="PLU (Barcode)"
                        placeholder="PLU (Barcode)"
                        wire:model="prices.0.plu"
                        parentClassName="w-full mb-3"
                    ></x-input.text.form-text>
                    <x-input.text.form-text
                        id="retail-price"
                        label="Harga (Rp.)"
                        placeholder="0"
                        wire:model="prices.0.value"
                        parentClassName="w-full mb-3"
                        x-mask:dynamic="$money($input, ',')"
                        class="text-right"
                    ></x-input.text.form-text>
                    <x-input.text.form-text
                        id="retail-description"
                        label="Deskripsi"
                        placeholder="Deskripsi"
                        wire:model="prices.0.description"
                        parentClassName="w-full"
                    ></x-input.text.form-text>
                </div>
                <div class="border border-neutral-300 rounded-[4px] p-4 w-full">
                    <p class="mb-0 text-sm font-bold">Harga Lusin</p>
                    <x-spacer.divider class="my-3"></x-spacer.divider>
                    <x-input.text.form-text
                        id="dozen-plu"
                        label="PLU (Barcode)"
                        placeholder="PLU (Barcode)"
                        wire:model="prices.1.plu"
                        parentClassName="w-full mb-3"
                    ></x-input.text.form-text>
                    <x-input.text.form-text
                        id="dozen-price"
                        label="Harga (Rp.)"
                        placeholder="0"
                        wire:model="prices.1.value"
                        parentClassName="w-full mb-3"
                        x-mask:dynamic="$money($input, ',')"
                        class="text-right"
                    ></x-input.text.form-text>
                    <x-input.text.form-text
                        id="dozen-description"
                        label="Deskripsi"
                        placeholder="Deskripsi"
                        wire:model="prices.1.description"
                        parentClassName="w-full"
                    ></x-input.text.form-text>
                </div>
            </div>
            <div class="flex items-center w-full gap-3 mb-3">
                <div class="border border-neutral-300 rounded-[4px] p-4 w-full">
                    <p class="mb-0 text-sm font-bold">Harga Karton</p>
                    <x-spacer.divider class="my-3"></x-spacer.divider>
                    <x-input.text.form-text
                        id="carton-plu"
                        label="PLU (Barcode)"
                        placeholder="PLU (Barcode)"
                        wire:model="prices.2.plu"
                        parentClassName="w-full mb-3"
                    ></x-input.text.form-text>
                    <x-input.text.form-text
                        id="carton-price"
                        label="Harga (Rp.)"
                        placeholder="0"
                        wire:model="prices.2.value"
                        parentClassName="w-full mb-3"
                        x-mask:dynamic="$money($input, ',')"
                        class="text-right"
                    ></x-input.text.form-text>
                    <x-input.text.form-text
                        id="carton-description"
                        label="Deskripsi"
                        placeholder="Deskripsi"
                        wire:model="prices.2.description"
                        parentClassName="w-full"
                    ></x-input.text.form-text>
                </div>
                <div class="border border-neutral-300 rounded-[4px] p-4 w-full">
                    <p class="mb-0 text-sm font-bold">Harga Trader</p>
                    <x-spacer.divider class="my-3"></x-spacer.divider>
                    <x-input.text.form-text
                        id="trader-plu"
                        label="PLU (Barcode)"
                        placeholder="PLU (Barcode)"
                        wire:model="prices.3.plu"
                        parentClassName="w-full mb-3"
                    ></x-input.text.form-text>
                    <x-input.text.form-text
                        id="trader-price"
                        label="Harga (Rp.)"
                        placeholder="0"
                        wire:model="prices.3.value"
                        parentClassName="w-full mb-3"
                        x-mask:dynamic="$money($input, ',')"
                        class="text-right"
                    ></x-input.text.form-text>
                    <x-input.text.form-text
                        id="trader-description"
                        label="Deskripsi"
                        placeholder="Deskripsi"
                        wire:model="prices.3.description"
                        parentClassName="w-full"
                    ></x-input.text.form-text>
                </div>
            </div>
        </div>
    </template>
    <x-spacer.divider class="mb-3"></x-spacer.divider>
    <template x-if="currentStep === 1">
        <div class="flex justify-end items-center">
            <x-button.button
                size="small"
                class=""
                x-on:click="$wire.goToStep(2);"
            >
                Selanjutnya
            </x-button.button>
        </div>
    </template>
    <template x-if="currentStep === 2">
        <div class="flex justify-between items-center">
            <x-button.button
                size="small"
                class=""
                x-on:click="$wire.goToStep(1);"
                theme="primary-outline"
            >
                Sebelumnya
            </x-button.button>

            <div
                x-data="{ modalSave: false,
                    initIcons() {
                       setTimeout(() => { lucide.createIcons(); }, 0);
                    }
                }"
                x-init="initIcons()"
            >
                <x-button.button
                    size="small"
                    class=""
                    x-on:click="modalSave = true;"
                >
                    Simpan
                </x-button.button>
                <div x-show="modalSave" class="fixed inset-0 bg-gray-500 bg-opacity-50 z-[250]"></div>
                <div
                    x-show="modalSave"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="translate-y-[-100%] opacity-0"
                    x-transition:enter-end="translate-y-0 opacity-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="translate-y-0 opacity-100"
                    x-transition:leave-end="translate-y-[-100%] opacity-0"
                    class="fixed top-8 left-1/2 transform -translate-x-1/2 z-[251] flex items-center justify-center"
                >
                    <div class="bg-white rounded shadow-lg w-full max-w-sm max-h-full">
                        <div class="p-4">
                            <div class="flex items-start gap-3">
                                <div
                                    class="aspect-[1/1] h-[35px] flex items-center justify-center rounded-[4px] bg-brand-100"
                                    wire:ignore
                                >
                                    <i data-lucide="circle-help" class="h-4 aspect-[1/1] text-brand-500"></i>
                                </div>
                                <div class="flex-grow flex-col items-start justify-start">
                                    <div class="mb-1 text-sm text-brand-500 font-semibold text-start">
                                        Konfirmasi Penyimpanan Data!
                                    </div>
                                    <div class="mb-0 text-xs text-justify text-neutral-700">
                                        Apakah anda yakin ingin menyimpan data barang "<span
                                            class="font-semibold">{{ $name }}</span>"?
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            x-data
                            class="flex items-center gap-2 justify-end px-4 py-2.5 border-t border-neutral-300 rounded-b">
                            <button
                                wire:loading.attr="disabled"
                                wire:target="createNewItem"
                                x-on:click="modalSave = false;"
                                class="py-2 px-3.5 text-xs bg-white border border-[#CBD5E1] text-danger-500 rounded-[4px] hover:bg-danger-50 transition-all duration-200 ease-in disabled:cursor-default"
                            >
                                Batal
                            </button>
                            <button
                                wire:loading.attr="disabled"
                                wire:target="createNewItem"
                                x-on:click="window.dropzoneInstanceCreateItem.eventCreateItem()"
                                class="flex gap-1 py-2 px-3.5 text-xs border border-brand-500 text-white bg-brand-500 rounded-[4px] hover:bg-brand-700 hover:border-brand-700 transition-all duration-200 ease-in"
                            >
                                <div
                                    wire:target="createNewItem"
                                    wire:loading
                                    class="w-full">
                                    <x-loader.button-loader></x-loader.button-loader>
                                </div>
                                <span
                                    wire:target="createNewItem"
                                    wire:loading.remove
                                    class="w-full">
                                        Ya, Simpan
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </template>

</div>
