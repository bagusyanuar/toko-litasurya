document.addEventListener('alpine:init', () => {
    Alpine.store('categoryCreate', {
        loading: false,
        modalCreate: false,
        validator: {},
        dz: null,
        setLoading(value) {
            this.loading = value;
        },
        setOpenModal() {
            this.modalCreate = true;
        },
        setCloseModal() {
            this.modalCreate = false;
        },
        async onSubmit() {
            const componentID = document.querySelector('[data-component-id="category-create"]')?.getAttribute('wire:id');
            this.dz.disable();
            this.loading = true;
            const uploadPromises = this.dz.files.map(file => {
                return new Promise((resolve, reject) => {
                    window.Livewire.find(componentID).upload('file', file, resolve, reject)
                });
            });
            let res = await Promise.all(uploadPromises);
            let response = await window.Livewire.find(componentID).call('createNewCategory');
            if (response['status'] === 400) {
                this.validator = response.data;
            }
            this.loading = false;
            this.dz.enable();
        },
    });

    Alpine.data('imageCategory', () => ({
        dz: null,
        initDropzone() {
            this.$nextTick(() => {
                this.dz = new Dropzone(this.$refs.dropCategory, {
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
                Alpine.store('categoryCreate').dz = this.dz;
            })
        }
    }))
});
