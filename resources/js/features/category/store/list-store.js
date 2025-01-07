import {paginate} from '../../shared/pagination'

document.addEventListener('alpine:init', () => {
    Alpine.store('listStore', {
        loading: true,
        page: 0,
        perPage: 10,
        totalPage: 0,
        totalRecords: 0,
        pageLength: [10, 25, 50],
        shownPages: [],
        componentID: document.querySelector('[data-component-id="category-list"]')?.getAttribute('wire:id'),

    });
});
