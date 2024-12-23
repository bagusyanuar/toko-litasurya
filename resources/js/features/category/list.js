document.addEventListener('alpine:init', () => {
    Alpine.store('categoryList', {
        loading: true,
        page: 1,
        perPage: 10,
        totalPage: 0,
        pageLength: [10, 25, 50],
        componentID: document.querySelector('[data-component-id="category-list"]')?.getAttribute('wire:id'),
        init() {
            Livewire.hook('component.init', ({ component, cleanup }) => {
                if (component.id === this.componentID) {
                    component.$wire.call('getDataCategories', this.page, this.perPage).then(() => {}).finally(() => {
                        this.loading = false;
                    })
                }
            })
        },
        setLoading(value) {
            this.loading = value;
        },
        setPerPage(value) {
            this.perPage = value;
            console.log(value);
        },
        async getData() {
            const componentID = document.querySelector('[data-component-id="category-list"]')?.getAttribute('wire:id');
            await window.Livewire.find(componentID).call('getDataCategories');
        }
    })
});

