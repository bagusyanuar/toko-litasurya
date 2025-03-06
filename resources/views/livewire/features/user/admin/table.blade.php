<section
    id="section-table-admin"
    data-component-id="table-admin"
>
    <div class="bg-white w-full p-6 rounded-lg shadow-md">
        <div class="w-full flex items-center justify-between mb-3">
            <p class="text-neutral-700 font-semibold">Admin Data</p>
            <div class="flex items-center gap-3">
                <x-gxui.table.search
                    placeholder="Search..."
                    store="adminTableStore"
                    dispatcher="onFindAll"
                ></x-gxui.table.search>
                <x-gxui.button.button
                    wire:ignore
                    x-on:click="$store.adminFormStore.showModal()"
                >
                    <div class="w-full flex justify-center items-center gap-1 text-sm">
                        <i data-lucide="plus" class="h-3" style="width: fit-content;"></i>
                        <span>Create New</span>
                    </div>
                </x-gxui.button.button>
            </div>
        </div>
        <x-gxui.table.table
            class="mb-1"
            store="adminTableStore"
        >
            <x-slot name="header">
                <x-gxui.table.th
                    title="Username"
                    align="left"
                ></x-gxui.table.th>
                <x-gxui.table.th
                    title="Action"
                    className="w-[80px]"
                ></x-gxui.table.th>
            </x-slot>
            <x-slot name="rows">
                <tr class="border-b border-neutral-300">
                    <x-gxui.table.td>
                        <span x-text="data.username"></span>
                    </x-gxui.table.td>
                    <x-gxui.table.td className="flex justify-center relative">
                        <x-gxui.table.action store="adminTableStore"></x-gxui.table.action>
                    </x-gxui.table.td>
                </tr>
            </x-slot>
        </x-gxui.table.table>
        <x-gxui.table.pagination
            store="adminTableStore"
            dispatcher="onFindAll"
        ></x-gxui.table.pagination>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const componentProps = {
                component: null,
                formStore: null,
                toastStore: null,
                userStore: null,
                paginationStore: null,
                actions: [
                    {
                        label: 'Edit',
                        icon: 'pencil',
                        dispatch: function (id) {
                            this.onEdit(id)
                        }
                    },
                    {
                        label: 'Delete',
                        icon: 'trash',
                        dispatch: function (id) {
                            this.onDelete(id)
                        }
                    },
                ],
                init: function () {
                    const componentID = document.querySelector('[data-component-id="table-admin"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                            this.formStore = Alpine.store('adminFormStore');
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.userStore = Alpine.store('userStore');
                            this.paginationStore = Alpine.store('gxuiPaginationStore');
                            this.actions.forEach((action, key) => {
                                action.dispatch = action.dispatch.bind(this);
                            });
                            this.onFindAll();
                        }

                    })
                },
                onFindAll() {
                    this.loading = true;
                    const query = {
                        type: this.type,
                        param: this.param,
                        page: this.page,
                        per_page: this.perPage
                    };
                    this.component.$wire.call('findAll', query)
                        .then(response => {
                            const {success, data, meta, message} = response;
                            if (success) {
                                this.data = data;
                                const totalRows = meta['pagination'] ? meta['pagination']['total_rows'] : 0;
                                const page = meta['pagination'] ? meta['pagination']['page'] : 1;
                                this.totalRows = totalRows;
                                this.page = page;
                                this.paginationStore.paginate(totalRows, this.perPage, this.page);
                                this.totalPages = this.paginationStore.totalPages;
                                this.shownPages = this.paginationStore.shownPages;
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.loading = false;
                    })
                },
                onDelete(id) {
                    this.userStore.showLoading('Deleting Process...');
                    this.component.$wire.call('delete', id)
                        .then(response => {
                            const {success} = response;
                            if (success) {
                                this.toastStore.success('success delete route');
                                this.onFindAll();
                            } else {
                                this.toastStore.failed('failed to delete route');
                            }
                        }).finally(() => {
                        this.userStore.closeLoading();
                    })
                },
                onEdit(id) {
                    this.userStore.showLoading('Finding admin process...');
                    this.component.$wire.call('findByID', id)
                        .then(response => {
                            const {success, data, message} = response;
                            if (success) {
                                this.formStore.hydrateForm(data);
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.userStore.closeLoading();
                    })
                }
            };
            const props = Object.assign({}, window.TableStore, componentProps);
            Alpine.store('adminTableStore', props);
        });
    </script>
@endpush
