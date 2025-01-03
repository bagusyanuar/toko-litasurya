document.addEventListener('alpine:init', () => {
    Alpine.store('modalCategory', {
        componentID: document.querySelector('[data-component-id="modal-category"]')?.getAttribute('wire:id'),
        isOpen: false,
        setOpenModal() {
            this.isOpen = true;
        },
        setCloseModal() {
            this.isOpen = false;
        },
        async getCategory(id) {
            const res = await window.Livewire.find(this.componentID).call('getCategory', id);
            if (res['status'] === 200 ) {
                this.isOpen = true;
            }
        }
    });

    Alpine.bind('modalBind', () => ({
        'x-data': () => ({
            text: 'aktif',
            toggle(){
                if (this.text === 'aktif') {
                    this.text = 'tidak aktif'
                } else {
                    this.text = 'aktif'
                }
            }
        })
    }))
});
