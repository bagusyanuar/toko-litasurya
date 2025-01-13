import {paginate} from '../../shared/pagination'

document.addEventListener('alpine:init', () => {
    Alpine.store('listStore', {
        loading: true,
        page: 0,
        perPage: 10,
        totalPage: 0,
        totalRows: 0,
        pageLength: [10, 25, 50],
        shownPages: [],
        data: [],
        componentID: document.querySelector('[data-component-id="category-list"]')?.getAttribute('wire:id'),
        init: function () {
            this.page = 1;
            Livewire.hook('component.init', ({component}) => {
                if (component.id === this.componentID) {
                    component.$wire.call('getDataCategories', this.page, this.perPage).then(response => {
                        if (response.status === 200) {
                            this.data = response.data;

                        }
                    }).finally(() => {
                        this.loading = false;
                    })
                }
            })
        },
        async fetchData() {
            this.loading = true;
            const response = await window.Livewire.find(this.componentID).call('getDataCategories', this.page, this.perPage);
            this.loading = false;
            console.log(response);
        },
        async onPerPageChange(perPage) {
            this.perPage = perPage;
            await this.fetchData();
        }
    });
});
