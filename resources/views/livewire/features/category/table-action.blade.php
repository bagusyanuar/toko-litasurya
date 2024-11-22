<div
    class="flex items-center justify-center gap-1"
>
    <x-modal.modal-form
        modalID="modalUpdateCategory{{ $idx }}"
        formTitle="Edit Kategori"
    >
        <x-slot name="trigger">
            <x-table.components.button-edit
                x-on:click="modalUpdateCategory{{ $idx }} = true"
            >
            </x-table.components.button-edit>
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
                dropRef="category{{ $idx }}"
                initial="fileUploadInitEdit()"
                dropEvent="processQueue()"
                label="Gambar Kategori"
            ></x-input.file.dropzone>
        </x-slot>
        <x-slot name="action">
            <x-button.button-loading
                theme="outline"
                loadingTarget=""
                loadingText="Loading"
                x-on:click="modalNewCategory = false"
                class="flex justify-center items-center"
                :mutate="false"
            >
                <span>Batal</span>
            </x-button.button-loading>
            <x-button.button-loading
                loadingTarget=""
                loadingText="Loading"
                x-on:click="window.dropzoneInstance.createCategory()"
                class="flex justify-center items-center"
            >
                <span>Tambah</span>
            </x-button.button-loading>
        </x-slot>
    </x-modal.modal-form>
    <x-table.components.button-delete
        modalKey="modalDeleteCategory{{ $idx }}"
        processTarget="$wire.onDeleteCategory()"
        processTargetLoading="onDeleteCategory"
        targetMenu="Kategori"
        targetName="{{ $category->name }}"
    ></x-table.components.button-delete>
</div>
<script>
    function fileUploadInitEdit() {
        return {
            message: null,
            isUploading: false,
            init() {
                this.dropzone = new Dropzone(this.$refs.category, {
                    url: "/fake-url", // Tidak digunakan
                    autoProcessQueue: false,
                    addRemoveLinks: true,
                    acceptedFiles: ".jpg, .png, .jpeg",
                    uploadMultiple: false,
                    maxFiles: 1,
                    dictDefaultMessage: "Tarik gambar yang ingin di upload",
                    init: function() {
                        this.on("addedfile", file => {
                            if (this.files.length > 1) {
                                this.removeFile(this.files[0]);
                            }
                            file.previewElement.querySelector(".dz-filename").style.display = "none";
                        });
                    },
                });
            },

            async createCategory() {
                this.isUploading = true;
                this.dropzone.disable();
                const uploadPromises = this.dropzone.files.map(file => {
                    return new Promise((resolve, reject) => {
                    @this.upload('file', file, resolve, reject);
                    });
                });
                try {
                    await Promise.all(uploadPromises);
                    this.message = 'All files uploaded successfully!';
                    await @this.call('createNewCategory');
                    this.modalNewCategory = false;
                    console.log('cek')
                    this.dropzone.removeAllFiles();
                } catch (error) {
                    console.error('Upload error:', error);
                    this.message = 'An error occurred during upload';
                } finally {
                    this.isUploading = false;
                }
                this.dropzone.enable();
            }
        }
    }
</script>
