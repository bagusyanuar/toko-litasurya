<section
    id="section-table-rewards"
    data-component-id="table-reward"
>
    <div class="bg-white w-full p-6 rounded-lg shadow-md">
        <div class="w-full flex items-center justify-between mb-3">
            <p class="text-neutral-700 font-semibold">Category Data</p>
            <div class="flex items-center gap-3">
                <x-gxui.table.search
                    placeholder="Search..."
                    store="rewardTableStore"
                    dispatcher="onFindAll"
                ></x-gxui.table.search>
                <x-gxui.button.button
                    wire:ignore
                    x-on:click="$store.rewardFormStore.showModal()"
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
            store="rewardTableStore"
        >
            <x-slot name="header">
                <x-gxui.table.th
                    title="Name"
                    align="left"
                ></x-gxui.table.th>
                <x-gxui.table.th
                    title="Poin"
                    className="w-[120px]"
                ></x-gxui.table.th>
                <x-gxui.table.th
                    title="Action"
                    className="w-[80px]"
                ></x-gxui.table.th>
            </x-slot>
            <x-slot name="rows">
                <tr class="border-b border-neutral-300">
                    <x-gxui.table.td>
                        <div class="flex items-center gap-3">
                            <img
                                x-data
                                alt="reward-image"
                                class="w-10 h-10 rounded-full border border-neutral-200"
                                x-bind:src="data.image"
                            >
                            <span x-text="data.name"></span>
                        </div>
                    </x-gxui.table.td>
                    <x-gxui.table.td>
                        <span x-text="data.point.toLocaleString('id-ID')"></span>
                    </x-gxui.table.td>
                    <x-gxui.table.td className="flex justify-center relative">
                        <x-gxui.table.action store="rewardTableStore"></x-gxui.table.action>
                    </x-gxui.table.td>
                </tr>
            </x-slot>
        </x-gxui.table.table>
        <x-gxui.table.pagination
            store="rewardTableStore"
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
                masterDataStore: null,
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
                    const componentID = document.querySelector('[data-component-id="table-reward"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.formStore = Alpine.store('rewardFormStore');
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.masterDataStore = Alpine.store('masterDataStore');
                            this.paginationStore = Alpine.store('gxuiPaginationStore');
                            this.actions.forEach((action, key) => {
                                action.dispatch = action.dispatch.bind(this);
                            });
                            this.component = component;
                            this.onFindAll();
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
                                this.paginationStore.paginate(totalRows, this.perPage, this.page);
                                this.totalPages = this.paginationStore.totalPages;
                                this.shownPages = this.paginationStore.shownPages;
                            } else {
                                this.toastStore.failed('failed to load data');
                            }
                        }).finally(() => {
                        this.loading = false;
                    })
                },
                onDelete(id) {
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
                onEdit(id) {
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
            Alpine.store('rewardTableStore', props);
        });
    </script>
@endpush
