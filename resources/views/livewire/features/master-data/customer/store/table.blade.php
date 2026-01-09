<section id="section-table-customer-store" data-component-id="table-customer-store">
    <div class="bg-white w-full px-6 py-4 rounded-lg shadow-md">
        <div class="w-full flex items-center justify-between mb-3">
            <p class="text-neutral-700 font-semibold">Store Data</p>
            <div class="flex items-center gap-3">
                <x-gxui.table.dynamic.search store="customerStoreTableStore"
                    dispatcher="onFindAll"></x-gxui.table.dynamic.search>
                <x-gxui.button.button wire:ignore x-on:click="$store.customerStoreFormStore.showModal()">
                    <div class="w-full flex justify-center items-center gap-1 text-xs">
                        <i data-lucide="plus" class="h-3" style="width: fit-content;"></i>
                        <span>Create New</span>
                    </div>
                </x-gxui.button.button>
            </div>
        </div>
        <x-gxui.table.dynamic.table store="customerStoreTableStore" dispatcher="onFindAll" pagination="true">
            <x-slot name="header">
                <x-gxui.table.dynamic.th class="w-[150px]">
                    <span>id</span>
                </x-gxui.table.dynamic.th>
                <x-gxui.table.dynamic.th class="w-[130px]" contentClass="justify-center">
                    <span>Name</span>
                </x-gxui.table.dynamic.th>
                <x-gxui.table.dynamic.th class="w-[130px]" contentClass="justify-center">
                    <span>Phone</span>
                </x-gxui.table.dynamic.th>
                <x-gxui.table.dynamic.th class="flex-1 min-w-[150px]">
                    <span>Address</span>
                </x-gxui.table.dynamic.th>
                <x-gxui.table.dynamic.th contentClass="justify-center" class="w-[100px]">
                    <span>Point</span>
                </x-gxui.table.dynamic.th>
                <x-gxui.table.dynamic.th contentClass="justify-center" class="w-[50px]">
                    <span>Action</span>
                </x-gxui.table.dynamic.th>
            </x-slot>
            <x-slot name="rows">
                <x-gxui.table.dynamic.row>
                    <x-gxui.table.dynamic.td class="w-[150px]">
                        <div x-data="{ copied: false }" class="flex items-center gap-2 cursor-pointer group"
                            @click="navigator.clipboard.writeText(data.id);
            copied = true;
            setTimeout(() => copied = false, 2000);">
                            <span x-text="data.id" class="group-hover:font-bold transition"></span>

                            <span x-show="copied" x-transition style="display: none;"
                                class="text-xs text-green-600 font-semibold bg-green-100 px-1 rounded">
                                Copied!
                            </span>

                            <span x-show="!copied" class="opacity-0 group-hover:opacity-50 text-xs">
                                📋
                            </span>
                        </div>
                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td class="w-[130px]" contentClass="justify-center">
                        <span x-text="data.name"></span>
                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td class="w-[130px]" contentClass="justify-center">
                        <span x-text="data.phone"></span>
                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td class="flex-1 min-w-[150px]">
                        <span x-text="data.address"></span>
                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td contentClass="justify-center" class="w-[100px]">
                        <span x-text="data.point.toLocaleString('id-ID')"></span>
                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td contentClass="justify-center" class="w-[50px]">
                        <x-gxui.table.dynamic.action store="customerStoreTableStore"></x-gxui.table.dynamic.action>
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
                type: 'store',
                component: null,
                formStore: null,
                toastStore: null,
                actionLoaderStore: null,
                actions: [{
                        label: 'Edit',
                        icon: 'pencil',
                        dispatch: function(data) {
                            this.onEdit(data)
                        }
                    },
                    {
                        label: 'Delete',
                        icon: 'trash',
                        dispatch: function(data) {
                            this.onDelete(data)
                        }
                    },
                ],
                init: function() {
                    Livewire.hook('component.init', ({
                        component
                    }) => {
                        const componentID = document.querySelector(
                            '[data-component-id="table-customer-store"]')?.getAttribute(
                            'wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.formStore = Alpine.store('customerStoreFormStore');
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
                            const {
                                success,
                                data,
                                meta,
                                message
                            } = response;

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
                            const {
                                success,
                                message
                            } = response;
                            if (success) {
                                this.toastStore.success(message);
                                this.onFindAll();
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                            this.actionLoaderStore.end();
                        })
                },
                onEdit(data) {
                    const id = data['id'];
                    this.actionLoaderStore.start('Find Store Process...');
                    this.component.$wire.call('findByID', id)
                        .then(response => {
                            const {
                                success,
                                data,
                                message
                            } = response;
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
            Alpine.store('customerStoreTableStore', props);
        });
    </script>
@endpush
