<x-modal.modal-form
    modalID="modalNewCategory"
    formTitle="Tambah Kategori"
>
    <x-slot name="trigger">
        <x-button.button-loading
            loadingTarget=""
            loadingText="Loading"
            x-on:click="modalNewCategory = true"
            class="flex justify-center items-center"
            wire:ignore
        >
            <div class="w-full flex justify-center items-center">
                <i data-lucide="plus" class="h-4 aspect-[1/1]"></i>
                <span>Tambah Kategori</span>
            </div>
        </x-button.button-loading>
    </x-slot>
    <x-slot name="body">
        <x-input.text.form-text
            id="name"
            label="Nama Kategori"
            placeholder="Nama Kategori"
            wire:model="name"
            parentClassName="mb-3"
        ></x-input.text.form-text>
        <x-input.file.dropzone
            dropRef="category"
            loadingKey="category-loading"
            dispatcher="createNewCategory"
            dispatchKey="CreateCategory"
            afterDispatch="this.modalNewCategory = false;"
            targetName="file"
            label="Gambar Kategori"
            wire:key="{{ uniqid('create-category-') }}"
        ></x-input.file.dropzone>
    </x-slot>
    <x-slot name="action">
        <div x-data>
            <button
                @click="$store.categoryState.setLoading(true)"
                :disabled="$store.categoryState.loading"
                class="px-4 py-2 bg-blue-500 text-white rounded disabled:bg-gray-300"
            >
                <span x-show="!$store.categoryState.loading">Submit</span>
                <span x-show="$store.categoryState.loading">Loading...</span>
            </button>
        </div>
{{--        <x-button.button-loading--}}
{{--            theme="outline"--}}
{{--            loadingTarget="window.dropzoneInstanceCreateCategory.eventCreateCategory()"--}}
{{--            loadingText="Loading"--}}
{{--            x-on:click="modalNewCategory = false"--}}
{{--            class="flex justify-center items-center"--}}
{{--            :mutate="false"--}}
{{--        >--}}
{{--            <span>Batal</span>--}}
{{--        </x-button.button-loading>--}}
{{--        <x-button.button-dropzone--}}
{{--            dropEvent="window.dropzoneInstanceCreateCategory.eventCreateCategory()"--}}
{{--            loadingKey="category-loading"--}}
{{--        >--}}
{{--            <span>Tambah</span>--}}
{{--        </x-button.button-dropzone>--}}
    </x-slot>
</x-modal.modal-form>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('categoryState', {
            loading: false,
            setLoading(value) {
                this.loading = value;
            }
        })
    })
</script>
