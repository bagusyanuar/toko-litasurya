document.addEventListener('alpine:init', () => {
    Alpine.store('categoryList', {
        loading: true,
        componentID: document.querySelector('[data-component-id="category-list"]')?.getAttribute('wire:id'),
        init() {
            Livewire.hook('component.init', ({ component, cleanup }) => {
                if (component.id === this.componentID) {
                    component.$wire.call('getDataCategories').then(() => {}).finally(() => {
                        this.loading = false;
                    })
                }
            })
        },
        setLoading(value) {
            this.loading = value;
        },
        async getData() {
            const componentID = document.querySelector('[data-component-id="category-list"]')?.getAttribute('wire:id');
            await window.Livewire.find(componentID).call('getDataCategories');
        }
    })
});

