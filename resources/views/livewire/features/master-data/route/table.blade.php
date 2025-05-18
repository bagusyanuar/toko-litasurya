<section
    id="section-table-route"
    data-component-id="table-route"
>
    <div class="bg-white w-full p-6 rounded-lg shadow-md">
        <div class="w-full flex items-center justify-between mb-3">
            <p class="text-neutral-700 font-semibold">Route Data</p>
            <div class="flex items-center gap-3">
                <x-gxui.table.dynamic.search
                    store="routeTableStore"
                    dispatcher="onFindAll"
                ></x-gxui.table.dynamic.search>
                <x-gxui.button.button
                    wire:ignore
                    x-on:click="$store.routeFormStore.showModal()"
                >
                    <div class="w-full flex justify-center items-center gap-1 text-xs">
                        <i data-lucide="plus" class="h-3" style="width: fit-content;"></i>
                        <span>Create New</span>
                    </div>
                </x-gxui.button.button>
            </div>
        </div>
        <x-gxui.table.dynamic.table
            store="routeTableStore"
            dispatcher="onFindAll"
            pagination="true"
        >
            <x-slot name="header">
                <x-gxui.table.dynamic.th
                    class="flex-1 min-w-[150px]"
                >
                    <span>Name</span>
                </x-gxui.table.dynamic.th>
                <x-gxui.table.dynamic.th
                    class="flex-1 min-w-[150px]"
                >
                    <span>Route</span>
                </x-gxui.table.dynamic.th>
                <x-gxui.table.dynamic.th
                    contentClass="justify-center"
                    class="w-[55px]"
                >
                    <span>Action</span>
                </x-gxui.table.dynamic.th>
            </x-slot>
            <x-slot name="rows">
                <x-gxui.table.dynamic.row>
                    <x-gxui.table.dynamic.td
                        class="flex-1 min-w-[150px]"
                    >
                        <span x-text="data.name"></span>
                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td
                        class="flex-1 min-w-[150px]"
                    >
                        <span x-text="data.store_string"></span>
                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td
                        contentClass="justify-center"
                        class="w-[55px]"
                    >
                        <x-gxui.table.dynamic.action store="routeTableStore"></x-gxui.table.dynamic.action>
                    </x-gxui.table.dynamic.td>
                </x-gxui.table.dynamic.row>
            </x-slot>
        </x-gxui.table.dynamic.table>
        {{--        <x-gxui.table.table--}}
        {{--            class="mb-1"--}}
        {{--            store="routeTableStore"--}}
        {{--        >--}}
        {{--            <x-slot name="header">--}}
        {{--                <x-gxui.table.th--}}
        {{--                    title="Name"--}}
        {{--                    className="w-[150px]"--}}
        {{--                ></x-gxui.table.th>--}}
        {{--                <x-gxui.table.th--}}
        {{--                    title="Route"--}}
        {{--                    align="left"--}}
        {{--                ></x-gxui.table.th>--}}
        {{--                <x-gxui.table.th--}}
        {{--                    title="Action"--}}
        {{--                    className="w-[80px]"--}}
        {{--                ></x-gxui.table.th>--}}
        {{--            </x-slot>--}}
        {{--            <x-slot name="rows">--}}
        {{--                <tr class="border-b border-neutral-300">--}}
        {{--                    <x-gxui.table.td className="flex justify-center">--}}
        {{--                        <span x-text="data.name"></span>--}}
        {{--                    </x-gxui.table.td>--}}
        {{--                    <x-gxui.table.td>--}}
        {{--                        <span x-text="data.store_string"></span>--}}
        {{--                    </x-gxui.table.td>--}}
        {{--                    <x-gxui.table.td className="flex justify-center relative">--}}
        {{--                        <x-gxui.table.action store="routeTableStore"></x-gxui.table.action>--}}
        {{--                    </x-gxui.table.td>--}}
        {{--                </tr>--}}
        {{--            </x-slot>--}}
        {{--        </x-gxui.table.table>--}}
        {{--        <x-gxui.table.pagination--}}
        {{--            store="routeTableStore"--}}
        {{--            dispatcher="onFindAll"--}}
        {{--        ></x-gxui.table.pagination>--}}
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
                        const componentID = document.querySelector('[data-component-id="table-route"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.formStore = Alpine.store('routeFormStore');
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
                            const {success, message} = response;
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
                onEdit(item) {
                    const id = item['id'];
                    this.actionLoaderStore.start('Find Route Process...');
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
            Alpine.store('routeTableStore', props);
        });
    </script>
@endpush
