const TABLE_STORE = {
    loading: true,
    page: 1,
    perPage: 10,
    shownPages: [],
    perPageOptions: [10, 25, 50],
    totalPages: 0,
    totalRows: 0,
    param: '',
    data: [],
    actions: {
        edit: 'onEdit(data.id)',
        delete: 'onDelete(data.id)'
    }
};

export default TABLE_STORE;
