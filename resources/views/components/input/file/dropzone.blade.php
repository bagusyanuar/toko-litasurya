<div
    x-data="{
        dispatcher: '{{ $dispatcher }}',
        afterDispatch: {{ $afterDispatch }},
        loadingKey: '{{ $loadingKey }}',
        dz: null,
        dzOnLoading: false,
        fileUploadInit() {
            this.$nextTick(() => {
                this.dz = new Dropzone(this.$refs.{{ $dropRef }}, {
                    url: '/check',
                    autoProcessQueue: false,
                    addRemoveLinks: true,
                    acceptedFiles: '.jpg, .png, .jpeg',
                    uploadMultiple: false,
                    maxFiles: 1,
                    dictDefaultMessage: 'Tarik gambar yang ingin di upload',
                    init: function() {
                        this.on('addedfile', file => {
                            if (this.files.length > 1) {
                                this.removeFile(this.files[0]);
                            }
                            file.previewElement.querySelector('.dz-filename').style.display = 'none';
                        });
                    }
                });
            });
        },
        initMethod() {
            this.uploadMethod('{{ $dispatchKey }}');
        },
        uploadMethod(key) {
            this[`event${key}`] = async () => {
                this.dz.disable();
                this.dzOnLoading = true;

                const uploadPromises = this.dz.files.map(file => {
                    return new Promise((resolve, reject) => {
                        @this.upload('{{ $targetName }}', file, resolve, reject);
                    });
                });

                try {
                    if (this.loadingKey !== '') {
                        $dispatch(`${this.loadingKey}-start`)
                    }
                    await Promise.all(uploadPromises);
                    if(this.dispatcher) {
                        await @this.call(this.dispatcher);
                    }
                    this.dz.removeAllFiles();
                    if (this.loadingKey !== '') {
                        $dispatch(`${this.loadingKey}-end`)
                    }
                    if(typeof this.afterDispatch === 'function') {
                        this.afterDispatch();
                    }
                } catch (error) {
                    if (this.loadingKey !== '') {
                        $dispatch(`${this.loadingKey}-end`)
                    }
                    console.error('Upload error:', error);
                } finally {
                    this.dzOnLoading = false;
                    this.dz.enable();
                }
            }
        }
    }"
    class="{{ $parentClassName }}"
    x-init="window.dropzoneInstance{{ $dispatchKey }} = $data, fileUploadInit(), initMethod()"
    wire:ignore
>
    <label class="text-xs text-neutral-700">{{ $label }}</label>
    <div class="relative w-full h-full">
        <div x-ref="{{ $dropRef }}" class="dropzone"></div>
        <div
            x-show="dzOnLoading"
            class="absolute inset-0 z-[20] bg-gray-900 bg-opacity-50 flex items-center justify-center text-white text-sm font-semibold"
            x-cloak
        >
            Sedang melakukan upload...
        </div>
    </div>
</div>


<style>
    .dropzone {
        width: 100%;
        height: 150px;
        border: 2px dashed #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .dropzone:hover {
        background-color: #f8f8f8;
    }

    .dropzone .dz-progress {
        height: 10px !important; /* Menyesuaikan tinggi progress bar */
        background-color: #e0e0e0 !important; /* Warna latar belakang progress bar */
        border-radius: 2px !important; /* Menambahkan sudut membulat */
        overflow: hidden; /* Menyembunyikan bagian yang melebihi progress */
        border: 1px solid darkgrey !important;
    }

    /* Styling untuk progress bar yang terisi */
    .dropzone .dz-progress .dz-upload {
        height: 100% !important;;
        background-color: #4caf50 !important; /* Warna hijau untuk progress */
        width: 0%; /* Secara default, progress adalah 0% */
        transition: width 0.4s ease-in-out !important; /* Animasi smooth saat progress berubah */
    }

    /* Gaya tambahan untuk progress ketika proses upload berlangsung */
    .dropzone .dz-progress.dz-error .dz-upload {
        background-color: #f44336 !important; /* Warna merah jika terjadi error */
    }

    .dropzone .dz-message {
        font-size: 12px !important; /* Ukuran font */
        color: #94a3b8 !important; /* Warna teks */
    }

    .dz-error-mark {
        display: none !important;
    }
</style>
