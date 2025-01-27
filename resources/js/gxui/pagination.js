document.addEventListener('alpine:init', () => {
    Alpine.store('gxuiPaginationStore', {
        shownPages: [],
        totalPages: 0,
        paginate(totalRecords, perPage, currentPage, maxPageRange = 5) {

            let totalPages = Math.ceil(totalRecords / perPage);
            let halfRange = Math.floor(maxPageRange / 2);
            let startPage = Math.max(1, (currentPage - halfRange));
            let endPage = Math.min(totalPages, (currentPage + halfRange));
            if ((endPage - startPage + 1) < maxPageRange) {
                if (startPage === 1) {
                    endPage = Math.min(totalPages, (startPage + maxPageRange - 1));
                } else {
                    startPage = Math.max(1, (endPage - maxPageRange + 1))
                }
            }
            this.shownPages = Array.from({length: endPage - startPage + 1}, (_, i) => startPage + i);
            this.totalPages = totalPages;
        }
    });
});
