<section
    id="section-table-categories"
    data-component-id="table-category"
>
    <div class="bg-white w-full px-6 py-4 rounded-lg shadow-md">
        <div class="w-full flex items-center justify-between mb-3">
            <p class="text-neutral-700 font-semibold">Category Data</p>
            <div class="flex items-center gap-3">
                <x-gxui.table.dynamic.search
                    store="categoryTableStore"
                    dispatcher="onFindAll"
                ></x-gxui.table.dynamic.search>
                <x-gxui.button.button
                    wire:ignore
                    x-on:click="$store.categoryFormStore.showModal()"
                >
                    <div class="w-full flex justify-center items-center gap-1 text-xs">
                        <i data-lucide="plus" class="h-3" style="width: fit-content;"></i>
                        <span>Create New</span>
                    </div>
                </x-gxui.button.button>
            </div>
        </div>
        <x-gxui.table.dynamic.table
            store="categoryTableStore"
            dispatcher="onFindAll"
            pagination="true"
        >
            <x-slot name="header">
                <x-gxui.table.dynamic.th
                    class="flex-1 min-w-[200px]"
                >
                    <span>Category</span>
                </x-gxui.table.dynamic.th>
                <x-gxui.table.dynamic.th
                    contentClass="justify-center"
                    class="w-[50px]"
                >
                    <span>Action</span>
                </x-gxui.table.dynamic.th>
            </x-slot>
            <x-slot name="rows">
                <x-gxui.table.dynamic.row>
                    <x-gxui.table.dynamic.td
                        class="flex-1 min-w-[200px]"
                    >
                        <div class="flex items-center gap-3">
                            <img
                                x-data
                                alt="category-image"
                                class="w-10 h-10 rounded-lg border border-neutral-200"
                                x-bind:src="data.image"
                            >
                            <span x-text="data.name"></span>
                        </div>

                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td
                        contentClass="justify-center relative"
                        class="w-[55px]"
                    >
                        <x-gxui.table.dynamic.action store="categoryTableStore"></x-gxui.table.dynamic.action>
                    </x-gxui.table.dynamic.td>
                </x-gxui.table.dynamic.row>
            </x-slot>
        </x-gxui.table.dynamic.table>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const componentProps = {
                component: null,
                formStore: null,
                toastStore: null,
                masterDataStore: null,
                paginationStore: null,
                actions: [
                    {
                        label: 'Edit',
                        icon: 'pencil',
                        dispatch: function (data) {
                            this.onEdit(data)
                        }
                    },
                    {
                        label: 'Delete',
                        icon: 'trash',
                        dispatch: function (data) {
                            this.onDelete(data)
                        }
                    },
                ],
                init: function () {
                    const componentID = document.querySelector('[data-component-id="table-category"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                            this.formStore = Alpine.store('categoryFormStore');
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.masterDataStore = Alpine.store('masterDataStore');
                            this.paginationStore = Alpine.store('gxuiPaginationStore');
                            this.actions.forEach((action, key) => {
                                action.dispatch = action.dispatch.bind(this);
                            });

                        }

                    })
                },
                onFindAll() {
                    this.loading = true;
                    this.component.$wire.call('findAll', this.param, this.page, this.perPage)
                        .then(response => {
                            const {success, data, meta} = response;
                            if (success) {
                                this.data = data;
                                const totalRows = meta['pagination'] ? meta['pagination']['total_rows'] : 0;
                                const page = meta['pagination'] ? meta['pagination']['page'] : 1;
                                this.totalRows = totalRows;
                                this.page = page;
                            } else {
                                this.toastStore.failed('failed to load data');
                            }
                        }).finally(() => {
                        this.loading = false;
                    })
                },
                onDelete(data) {
                    const id = data['id'];
                    this.masterDataStore.showLoading('Deleting Process...');
                    this.component.$wire.call('delete', id)
                        .then(response => {
                            const {success} = response;
                            if (success) {
                                this.toastStore.success('success delete category');
                                this.onFindAll();
                            } else {
                                this.toastStore.failed('failed to load data');
                            }
                        }).finally(() => {
                        this.masterDataStore.closeLoading();
                    })
                },
                onEdit(data) {
                    const id = data['id'];
                    this.masterDataStore.showLoading('Finding Item Process...');
                    this.component.$wire.call('findByID', id)
                        .then(response => {
                            const {success, data, message} = response;
                            if (success) {
                                this.formStore.hydrateForm(data);
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.masterDataStore.closeLoading();
                    })
                }
            };
            const props = Object.assign({}, window.TableStore, componentProps);
            Alpine.store('categoryTableStore', props);
        })
    </script>
@endpush


