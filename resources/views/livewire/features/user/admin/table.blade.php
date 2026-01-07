<section
    id="section-table-admin"
    data-component-id="table-admin"
>
    <div class="bg-white w-full px-6 py-4 rounded-lg shadow-md">
        <div class="w-full flex items-center justify-between mb-3">
            <p class="text-neutral-700 font-semibold">Admin Data</p>
            <div class="flex items-center gap-3">
                <x-gxui.table.dynamic.search
                    store="adminTableStore"
                    dispatcher="onFindAll"
                ></x-gxui.table.dynamic.search>
                <x-gxui.button.button
                    wire:ignore
                    x-on:click="$store.adminFormStore.showModal()"
                >
                    <div class="w-full flex justify-center items-center gap-1 text-xs">
                        <i data-lucide="plus" class="h-3" style="width: fit-content;"></i>
                        <span>Create New</span>
                    </div>
                </x-gxui.button.button>
            </div>
        </div>
        <x-gxui.table.dynamic.table
            store="adminTableStore"
            dispatcher="onFindAll"
            pagination="true"
        >
            <x-slot name="header">
                <x-gxui.table.dynamic.th
                    class="flex-1 min-w-[150px]"
                >
                    <span>Username</span>
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
                        class="flex-1 min-w-[150px]"
                    >
                        <span x-text="data.username"></span>
                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td
                        contentClass="justify-center"
                        class="w-[50px]"
                    >
                        <x-gxui.table.dynamic.action store="adminTableStore"></x-gxui.table.dynamic.action>
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
                actionLoaderStore: null,
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
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="table-admin"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.formStore = Alpine.store('adminFormStore');
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.actionLoaderStore = Alpine.store('gxuiActionLoader');
                            this.actions.forEach((action, key) => {
                                action.dispatch = action.dispatch.bind(this);
                            });
                        }

                    })
                },
                onFindAll() {
                    this.loading = true;
                    const query = {
                        type: this.type,
                        param: this.param,
                        page: this.currentPage,
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
                                this.currentPage = page;
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.loading = false;
                    })
                },
                onDelete(data) {
                    const id = data['id'];
                    this.actionLoaderStore.start('Deleting Process...');
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
                        this.actionLoaderStore.end();
                    })
                },
                onEdit(data) {
                    const id = data['id'];
                    this.actionLoaderStore.start('Find Admin Process...');
                    this.component.$wire.call('findByID', id)
                        .then(response => {
                            const {success, data, message} = response;
                            if (success) {
                                this.formStore.hydrateForm(data);
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.actionLoaderStore.end();
                    })
                }
            };
            const props = Object.assign({}, window.TableStore, componentProps);
            Alpine.store('adminTableStore', props);
        });
    </script>
@endpush
