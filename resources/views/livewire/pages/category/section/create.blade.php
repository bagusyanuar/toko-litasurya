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
            parentClassName="mb-3"
        ></x-input.text.form-text>
        <x-input.file.dropzone
            dropRef="category"
            initial="fileUploadInit()"
            dropEvent="processQueue()"
            label="Gambar Kategori"
        ></x-input.file.dropzone>
    </x-slot>
    <x-slot name="action">
        <x-button.button-loading
            theme="outline"
            loadingTarget="createNewCategory"
            loadingText="Loading"
            x-on:click="modalNewCategory = false"
            class="flex justify-center items-center"
            :mutate="false"
        >
            <span>Batal</span>
        </x-button.button-loading>
        <x-button.button-loading
            loadingTarget="createNewCategory"
            loadingText="Loading"
            x-on:click="window.dropzoneInstance.createCategory()"
            class="flex justify-center items-center"
        >
            <span>Tambah</span>
        </x-button.button-loading>
    </x-slot>
</x-modal.modal-form>

<script>
    function fileUploadInit() {
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
                    init: function() {
                        this.on("addedfile", file => {
                            console.log("File added:", file);
                            file.previewElement.querySelector(".dz-filename").style.display = "none";
                        });
                        this.on("queuecomplete", () => {
                            this.removeAllFiles();
                            this.message = 'Files uploaded successfully!';
                        });

                        this.on("uploadprogress", function(file, progress) {
                            console.log("Upload progress:", progress);

                            // Dapatkan elemen dz-upload untuk file tertentu
                            const progressBar = file.previewElement.querySelector(".dz-upload");
                            if (progressBar) {
                                progressBar.style.width = progress + "%";
                            }
                        });
                    },
                });
            },

            async createCategory() {
                this.isUploading = true;
                const uploadPromises = this.dropzone.files.map(file => {
                    return new Promise((resolve, reject) => {
                        @this.upload('files', file, resolve, reject);
                    });
                });

                try {
                    await Promise.all(uploadPromises);
                    this.message = 'All files uploaded successfully!';
                    @this.call('createNewCategory');
                } catch (error) {
                    console.error('Upload error:', error);
                    this.message = 'An error occurred during upload';
                } finally {
                    this.isUploading = false;
                }
            }
        }
    }
</script>
