<section
    id="section-sales-team-list"
    data-component-id="sales-team-list"
>
    <div class="w-64 bg-white rounded-lg shadow-md px-4 py-3 flex flex-col">
        <div class="w-full mb-3">
            <p class="text-neutral-700 text-sm font-bold mb-3">Sales Team List</p>
            <hr class="mb-3"/>
            <x-gxui.table.dynamic.search
                store="scheduleTeamStore"
                dispatcher="onFindAll"
            ></x-gxui.table.dynamic.search>
        </div>
        <div class="w-full h-56">
            <div
                x-show="$store.scheduleTeamStore.loading"
                class="h-56 w-full flex flex-col items-center justify-center"
            >
                <svg class="w-4 h-4 animate-spinner me-1 text-brand-500" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24">
                    <g>
                        <circle cx="3" cy="12" r="1.5" class="fill-current"/>
                        <circle cx="21" cy="12" r="1.5" class="fill-current"/>
                        <circle cx="12" cy="21" r="1.5" class="fill-current"/>
                        <circle cx="12" cy="3" r="1.5" class="fill-current"/>
                        <circle cx="5.64" cy="5.64" r="1.5" class="fill-current"/>
                        <circle cx="18.36" cy="18.36" r="1.5" class="fill-current"/>
                        <circle cx="5.64" cy="18.36" r="1.5" class="fill-current"/>
                        <circle cx="18.36" cy="5.64" r="1.5" class="fill-current"/>
                    </g>
                </svg>
                <p class="text-brand-500 text-xs">Loading...</p>
            </div>
            <div
                x-cloak
                x-show="!$store.scheduleTeamStore.loading && $store.scheduleTeamStore.data.length > 0"
                class="flex flex-col gap-1 overflow-y-auto"
            >
                <template x-for="(data, index) in $store.scheduleTeamStore.data" :key="index">
                    <div
                        class="w-full text-neutral-700 flex justify-between items-center py-2.5 border-b rounded cursor-pointer transition-all ease-in duration-300 hover:bg-brand-500 hover:text-white hover:px-2"
                        x-data="{
                            initIcons() {
                               setTimeout(() => { lucide.createIcons(); }, 0);
                            }
                        }"
                        x-init="initIcons()"
                        x-effect="initIcons()"
                        x-bind:class="data.id === $store.scheduleTeamStore.selectedSales ? 'bg-brand-500 text-white px-2' : ''"
                        x-on:click="$store.scheduleTeamStore.onSelectSales(data)"
                    >
                        <div class="flex-1">
                            <p class="text-xs font-semibold" x-text="data.name"></p>
                        </div>
                        <div
                            wire:ignore
                            class="text-inherit"
                        >
                            <i data-lucide="chevron-right" class="h-3" style="width: fit-content;"></i>
                        </div>
                    </div>
                </template>
            </div>
            <div
                x-cloak x-show="!$store.scheduleTeamStore.loading && $store.scheduleTeamStore.data.length <= 0"
                class="w-full h-56 flex flex-col justify-center items-center"
            >
                <p class="text-xs tex-brand-600 font-semibold">Sales team not found!</p>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('scheduleTeamStore', {
                component: null,
                scheduleStore: null,
                param: '',
                loading: true,
                toastStore: null,
                data: [],
                selectedSales: '',
                init: function () {
                    const componentID = document.querySelector('[data-component-id="sales-team-list"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.scheduleStore = Alpine.store('salesTeamScheduleStore');
                            this.onFindAll();
                        }
                    })
                },
                onSelectSales(data) {
                    const id = data['id'];
                    this.selectedSales = id;
                    this.scheduleStore.hydrateSelectedSales(id);
                },
                onFindAll() {
                    this.selectedSales = '';
                    if (this.scheduleStore) {
                        this.scheduleStore.hydrateSelectedSales('');
                    }

                    this.loading = true;
                    const query = {
                        param: this.param,
                    };
                    this.component.$wire.call('sales', query)
                        .then(response => {
                            const {success, data, meta, message} = response;
                            console.log(data);
                            if (success) {
                                this.data = data;
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.loading = false;
                    })
                }
            });
        });
    </script>
@endpush
