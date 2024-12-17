document.addEventListener('alpine:init', () => {
    Alpine.store('categoryCreate', {
        loading: false,
        modalCreate: false,
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
            this.loading = true;
            await window.Livewire.find(componentID).call('createNewCategory');
            this.loading = false;
        },
    })
});
