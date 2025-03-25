document.addEventListener('alpine:init', () => {
    Alpine.bind('gxuiTablePagination', () => ({
        'x-data': () => ({
            element: null,
            loading: true,
            rows: [],
            totalRows: 0,
            perPageOptions: [10, 25, 50],
            perPage: 1,
            currentPage: 1,
            totalPages: 0,
            shownPages: [],
            storeName: '',
            dispatcher: '',
            stateData: '',
            stateLoader: '',
            stateTotalRows: '',
            statePerPageOptions: '',
            statePerPage: '',
            stateCurrentPage: '',
            initTable() {
                this.$nextTick(() => {
                    this.element = $(this.$el);
                    this.storeName = this.$el.getAttribute("store") || '';
                    this.dispatcher = this.$el.getAttribute("dispatcher") || '';
                    this.stateData = this.$el.getAttribute("state-data") || '';
                    this.stateLoader = this.$el.getAttribute("state-loader") || '';
                    this.stateTotalRows = this.$el.getAttribute("state-total-rows") || '';
                    this.statePerPageOptions = this.$el.getAttribute("state-per-page-options") || '';
                    this.statePerPage = this.$el.getAttribute("state-per-page") || '';
                    this.stateCurrentPage = this.$el.getAttribute("state-current-page") || '';
                    if (this.storeName) {

                        if (this.statePerPageOptions) {
                            if (Array.isArray(Alpine.store(this.storeName)?.[this.statePerPageOptions])) {
                                this.perPageOptions = Alpine.store(this.storeName)?.[this.statePerPageOptions];
                            } else {
                                this.perPageOptions = [10, 25, 50];
                            }
                        }
                        this.perPage = this.perPageOptions[0];
                        let store = Alpine.store(this.storeName);
                        if (store && this.statePerPage in store) {
                            store[this.statePerPage] = this.perPage;
                        }

                        this.$watch(() => {
                            return Alpine.store(this.storeName)?.[this.stateData];
                        }, (rows) => {
                            if (Array.isArray(rows)) {
                                this.rows = rows;
                            } else {
                                this.rows = [];
                            }
                        });

                        this.$watch(() => {
                            return Alpine.store(this.storeName)?.[this.stateLoader]
                        }, (loading) => {
                            this.loading = loading;
                        });

                        this.$watch(() => {
                            return Alpine.store(this.storeName)?.[this.stateTotalRows]
                        }, (totalRows) => {
                            this.totalRows = totalRows;
                            this.paginate()
                        });

                        //watching state per page
                        this.$watch("perPage", (perPage) => {
                            let store = Alpine.store(this.storeName);
                            if (store && this.statePerPage in store) {
                                store[this.statePerPage] = perPage;
                                this.dispatch();
                            }
                        });

                        this.$watch(() => {
                            return Alpine.store(this.storeName)?.[this.stateCurrentPage]
                        }, (currentPage) => {
                            this.currentPage = currentPage;
                            this.dispatch();
                        });

                        this.dispatch();
                    }
                });
            },
            onPerPageChange(perPage) {
                let store = Alpine.store(this.storeName);
                if (store && this.stateCurrentPage in store) {
                    store[this.stateCurrentPage] = 1;
                }
                this.perPage = perPage;
            },
            onPrevious() {
                let store = Alpine.store(this.storeName);
                if (store && this.stateCurrentPage in store) {
                    store[this.stateCurrentPage] -= 1;
                }
            },
            onNext() {
                let store = Alpine.store(this.storeName);
                if (store && this.stateCurrentPage in store) {
                    store[this.stateCurrentPage] += 1;
                }
            },
            onPageChange(page) {
                let store = Alpine.store(this.storeName);
                if (store && this.stateCurrentPage in store) {
                    store[this.stateCurrentPage] = page;
                }

            },
            dispatch() {
                if (this.storeName && this.dispatcher) {
                    let store = Alpine.store(this.storeName);
                    if (store && typeof store[this.dispatcher] === "function") {
                        store[this.dispatcher]();
                        this.paginate();
                    }
                }
            },
            paginate() {
                const maxPageRange = 5;
                let totalPages = Math.ceil(this.totalRows / this.perPage);
                let halfRange = Math.floor(maxPageRange / 2);
                let startPage = Math.max(1, (this.currentPage - halfRange));
                let endPage = Math.min(totalPages, (this.currentPage + halfRange));
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
        }),
        'x-init': "initTable()"
    }));

    Alpine.bind('gxuiCollapsibleRow', () => ({
        'x-data': () => ({
            isOpen: false,
            toggleIcon() {
                this.isOpen = !this.isOpen;
                this.initIcons();
            },
            initIcons() {
                setTimeout(() => {
                    lucide.createIcons();
                }, 0);
            }
        })
    }));

    Alpine.bind('gxuiTableSearch', () => ({
        'x-data': () => ({
            element: null,
            debounce: null,
            debounceTime: null,
            storeName: '',
            dispatcher: '',
            stateParam: '',
            stateCurrentPage: '',
            initSearch() {
                this.$nextTick(() => {
                    this.element = $(this.$el);
                    this.storeName = this.$el.getAttribute("store-name") || '';
                    this.dispatcher = this.$el.getAttribute("dispatcher") || '';
                    this.stateParam = this.$el.getAttribute("state-param") || '';
                    this.stateCurrentPage = this.$el.getAttribute("state-current-page") || '';
                    this.debounceTime = this.$el.getAttribute('state-debounce-time') || 500;
                })
            },
            onInput(event) {
                let store = Alpine.store(this.storeName);
                if (store && this.stateCurrentPage in store) {
                    clearTimeout(this.debounce);
                    this.debounce = setTimeout(() => {
                        let value = event.target.value;
                        store[this.stateCurrentPage] = 1;
                        store[this.stateParam] = value;
                        if (this.dispatcher && typeof store[this.dispatcher] === "function") {
                            store[this.dispatcher]();
                        }
                    }, this.debounceTime);
                }
            }
        }),
        'x-init': "initSearch()"
    }))
});
