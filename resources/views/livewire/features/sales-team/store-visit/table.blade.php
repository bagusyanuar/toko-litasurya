<section
    id="section-table-purchasing"
    data-component-id="table-purchasing"
>
    <div class="bg-white w-full p-6 rounded-lg shadow-md">
        <div class="w-full flex items-center justify-between mb-3">
            <p class="text-neutral-700 font-semibold">Sales Team Visit Data</p>
            <div class="flex items-center gap-1">
                <div class="flex items-center justify-between gap-1">
                    <x-gxui.input.date.datepicker
                        id="filterVisitDateStart"
                        store="salesTeamVisitStore"
                        placeholder="dd/mm/yyyy"
                        class="!w-[120px]"
                        x-model="$store.salesTeamVisitStore.dateStart"
                        x-init="initDatepicker({format: 'dd/mm/yyyy'})"
                        dispatcher="onDateChange"
                    ></x-gxui.input.date.datepicker>
                    <span class="text-sm text-neutral-700">-</span>
                    <x-gxui.input.date.datepicker
                        id="filterVisitDateEnd"
                        store="salesTeamVisitStore"
                        placeholder="dd/mm/yyyy"
                        class="!w-[120px]"
                        x-model="$store.salesTeamVisitStore.dateEnd"
                        x-init="initDatepicker({format: 'dd/mm/yyyy'})"
                        dispatcher="onDateChange"
                    ></x-gxui.input.date.datepicker>
                </div>
            </div>
        </div>
        <x-gxui.table.dynamic.table
            store="salesTeamVisitStore"
            dispatcher="onFindAll"
            pagination="true"
        >
            <x-slot name="header">
                <x-gxui.table.dynamic.th
                    contentClass="justify-center"
                    class="w-[40px]"
                ></x-gxui.table.dynamic.th>
                <x-gxui.table.dynamic.th
                    contentClass="justify-center"
                    class="w-[120px]"
                >
                    <span>Sales</span>
                </x-gxui.table.dynamic.th>
                <x-gxui.table.dynamic.th
                    class="flex-1 min-w-[170px]"
                >
                    <span>Store</span>
                </x-gxui.table.dynamic.th>
                <x-gxui.table.dynamic.th
                    contentClass="justify-center"
                    class="w-[180px]"
                >
                    <span>Visited at</span>
                </x-gxui.table.dynamic.th>
                <x-gxui.table.dynamic.th
                    contentClass="justify-center"
                    class="w-[120px]"
                >
                    <span>Status</span>
                </x-gxui.table.dynamic.th>
            </x-slot>
            <x-slot name="rows">
                <x-gxui.table.dynamic.collapsible-row>
                    <x-gxui.table.dynamic.td
                        contentClass="justify-center"
                        class="w-[40px]"
                    >
                        <div
                            wire:ignore
                            @click="toggleOpen"
                            class="flex items-center justify-center p-1 cursor-pointer hover:bg-neutral-100 transition-all ease-in duration-200"
                        >
                            <i x-bind:data-lucide="isOpen ? 'chevron-up' : 'chevron-down'"
                               class="text-neutral-700 h-3 aspect-[1/1]"></i>
                        </div>
                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td
                        contentClass="justify-center"
                        class="w-[120px]"
                    >
                        <span x-text="data.sales ? data.sales.name : '-'"></span>
                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td
                        class="flex-1 min-w-[170px]"
                    >
                        <span x-text="data.store ? data.store?.name : '-'"></span>
                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td
                        contentClass="justify-center"
                        class="w-[180px]"
                    >
                        <span x-text="data.visited_at !== null ? data.visited_at : '-'"></span>
                    </x-gxui.table.dynamic.td>
                    <x-gxui.table.dynamic.td
                        contentClass="justify-center"
                        class="w-[120px]"
                    >
                        <span
                            x-text="data.status"
                            class="capitalized font-bold"
                            x-bind:class="data.status === 'visited' ? 'text-green-500' : 'text-red-500'"
                        ></span>
                    </x-gxui.table.dynamic.td>
                    <x-slot name="collapsible">
                        <div class="w-full flex items-start border-b">
                            <x-gxui.table.dynamic.td
                                contentClass="justify-center"
                                class="w-[40px]"
                            ></x-gxui.table.dynamic.td>
                            <div class="py-3 px-2.5 flex-1">
                                <div class="w-full">
                                    <p class="text-neutral-700 font-bold text-xs mb-3">Evidence of visit</p>
                                    <div x-show="data.image !== null" class="mb-3">
                                        <img
                                            x-data
                                            alt="evidence-image"
                                            class="w-48 aspect-[1/1] rounded-lg border border-neutral-200"
                                            x-bind:src="data.image"
                                        >
                                    </div>
                                    <div
                                        x-show="data.image === null"
                                        class="mb-3 w-48 aspect-[1/1] rounded-lg border border-neutral-200 flex items-center justify-center"
                                    >
                                        <p class="text-xs font-bold italic text-neutral-700">No evidence found!</p>
                                    </div>
                                    <div class="text-neutral-500 italic text-xs">
                                        <span class="me-1">Description :</span>
                                        <span x-text="data.description !== null ? data.description : '-'"></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </x-slot>
                </x-gxui.table.dynamic.collapsible-row>
            </x-slot>
        </x-gxui.table.dynamic.table>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const today = new Date().toLocaleDateString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
            const componentProps = {
                component: null,
                toastStore: null,
                dateStart: today,
                dateEnd: today,
                actions: [],
                init: function () {
                    const componentID = document.querySelector('[data-component-id="table-purchasing"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                        }

                    })
                },
                onFindAll() {
                    this.loading = true;
                    const query = {
                        param: this.param,
                        page: this.page,
                        per_page: this.perPage,
                        dateStart: this.dateStart,
                        dateEnd: this.dateEnd,
                    };
                    this.component.$wire.call('findAll', query)
                        .then(response => {
                            const {success, data, meta, message} = response;
                            console.log(response);
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
                onDateChange() {
                    this.onFindAll();
                },
            };
            const props = Object.assign({}, window.TableStore, componentProps);
            Alpine.store('salesTeamVisitStore', props);
        });
    </script>
@endpush
