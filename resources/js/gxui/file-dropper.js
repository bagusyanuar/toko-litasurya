document.addEventListener('alpine:init', () => {
    Alpine.store('gxuiFileDropperStore', {
        initDropper(element) {
            return new Dropzone(element, {
                url: '/url-dropper',
                autoProcessQueue: false,
                addRemoveLinks: true,
                acceptedFiles: '.jpg, .png, .jpeg',
                uploadMultiple: false,
                maxFiles: 1,
                dictDefaultMessage: 'Tarik gambar yang ingin di upload',
                init: function () {
                    this.on('addedfile', file => {
                        if (this.files.length > 1) {
                            this.removeFile(this.files[0]);
                        }
                        file.previewElement.querySelector('.dz-filename').style.display = 'none';
                    });
                }
            });
        }
    });
});
