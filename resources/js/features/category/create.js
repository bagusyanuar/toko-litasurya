document.addEventListener('alpine:init', () => {
    Alpine.store('categoryCreate', {
        loading: false,
        modalCreate: false,
        validator: {},
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
            let response = await window.Livewire.find(componentID).call('createNewCategory');
            console.log(response.status);
            if (response['status'] === 400) {
                this.validator = response.data;
            }
            this.loading = false;
        },
    })
});
