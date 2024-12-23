import {paginate} from '../shared/pagination';

document.addEventListener('alpine:init', () => {
    Alpine.store('categoryList', {
        loading: true,
        page: 0,
        perPage: 10,
        totalPage: 0,
        totalRecords: 0,
        pageLength: [10, 25, 50],
        shownPages: [],
        componentID: document.querySelector('[data-component-id="category-list"]')?.getAttribute('wire:id'),
        init: function () {
            Livewire.hook('component.init', ({component, cleanup}) => {
                if (component.id === this.componentID) {
                    component.$wire.call('getDataCategories', this.page, this.perPage).then((res) => {
                        // let currentPage = res['data']['current_page'];
                        // let totalRecords = res['data']['total_rows'];
                        let currentPage = 1;
                        let totalRecords = 74;
                        this.page = currentPage;
                        this.totalRecords = totalRecords;
                        const {totalPages, shownPages} = paginate(this.totalRecords, this.perPage, this.page);
                        console.log(shownPages);
                        this.totalPage = totalPages;
                        this.shownPages = shownPages;
                    }).finally(() => {
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
        onFirstPageHandler() {
        },
        onPreviousPageHandler() {
        },
        onNextPageHandler() {
        },
        onLastPageHandler() {
        },
        onPageChangeHandler(page) {
            this.page = page;
            const {totalPages, shownPages} = paginate(this.totalRecords, this.perPage, this.page);
            this.shownPages = shownPages;
            console.log(page);
        },
        async getData() {
            const componentID = document.querySelector('[data-component-id="category-list"]')?.getAttribute('wire:id');
            await window.Livewire.find(componentID).call('getDataCategories');
        }
    })
});

