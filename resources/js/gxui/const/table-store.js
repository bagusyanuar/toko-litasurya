const TABLE_STORE = {
    loading: true,
    currentPage: 1,
    perPage: 10,
    shownPages: [],
    totalPages: 0,
    totalRows: 0,
    perPageOptions: [10, 25, 50],
    param: '',
    data: [],
    actions: {
        edit: 'onEdit(data.id)',
        delete: 'onDelete(data.id)'
    }
};

export default TABLE_STORE;
