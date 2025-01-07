document.addEventListener('alpine:init', () => {
    Alpine.store('formCategoryStore', {
        componentID: document.querySelector('[data-component-id="form-category"]')?.getAttribute('wire:id'),
        isOpen: false,
        title: '',
        dz: null,
        validator: {},
        loading: false,
        loadingGetCategory: false,
        popOverClosable: true,
        init() {
            this.initFileUpload();
        },
        setOpenModal(title = 'Form Tambah Kategori') {
            this.title = title;
            this.isOpen = true;
        },
        setCloseModal() {
            this.isOpen = false;
        },
        async getCategory(id) {
            this.setOpenModal('Form Edit Kategori');
            this.loadingGetCategory = true;
            const res = await window.Livewire.find(this.componentID).call('getCategory', id);
            Alpine.store('alertStore').failed('test');
            this.loadingGetCategory = false;
        },
        initFileUpload() {
            const elDrop = document.getElementById('dropCategory');
            this.dz = new Dropzone(elDrop, {
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
        },
        async mutate(type = 'create') {
            this.dz.disable();
            this.loading = true;
            const uploadPromises = this.dz.files.map(file => {
                return new Promise((resolve, reject) => {
                    window.Livewire.find(this.componentID).upload('file', file, resolve, reject)
                });
            });
            await Promise.all(uploadPromises);
            let response = await window.Livewire.find(this.componentID).call('create');
            this.loading = false;
            this.dz.enable();
            switch (response['status']) {
                case 400:
                    this.validator = response.data;
                    break;
                case 200:
                    this.dz.removeAllFiles();
                    this.isOpen = false;
                    break;
                default:
                    break;
            }
        },
        async delete() {
            Alpine.store('alertStore').success('test');
        }
    });
});
