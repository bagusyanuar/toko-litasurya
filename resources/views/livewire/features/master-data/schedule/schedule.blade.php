<section
    id="section-sales-team-schedule"
    data-component-id="sales-team-schedule"
    class="flex-1"
>
    <div class="w-full">
        <p class="text-neutral-700 font-bold text-sm mb-3">Schedule List</p>
        <div x-show="$store.salesTeamScheduleStore.selectedSales === ''">
            <div class="w-full flex flex-col items-center justify-center h-48">
                <img src="{{ asset('/static/images/no-data.png') }}" alt="no-data-image"
                     height="150" width="150">
                <p class="text-brand-500 text-sm italic font-semibold">No Sales Selected!</p>
            </div>
        </div>
        <div
            x-cloak
            x-show="$store.salesTeamScheduleStore.selectedSales !== ''"
            class="w-full flex flex-col gap-3"
        >
            <div
                x-show="$store.salesTeamScheduleStore.loading"
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
                <p class="text-brand-500 text-xs">Find data schedules...</p>
            </div>
            <div x-cloak x-show="!$store.salesTeamScheduleStore.loading" class="w-full flex flex-col gap-3">
                <template x-for="(data, index) in $store.salesTeamScheduleStore.availableSchedule" :key="index">
                    <div class="w-full bg-white shadow-sm rounded px-4 py-3">
                        <p class="text-brand-500 font-bold" x-text="data.label"></p>
                        <hr class="my-1"/>
                        <div class="w-full flex items-end gap-3">
                            <div class="flex-1">
                                <x-gxui.input.select.select2
                                    label="Route"
                                    parentClassName="flex-1"
                                    selectID="routeSelect"
                                    x-init="initSelect2({placeholder: 'choose a route'})"
                                    x-bind="gxuiSelect2Bind"
                                    x-bind:store-name="'$store.salesTeamScheduleStore.routeOptions'"
                                    x-bind:id="`storeSelect-${index}`"
                                    x-model="$store.salesTeamScheduleStore.availableSchedule[index].route"
                                ></x-gxui.input.select.select2>
                            </div>
                            <div class="w-fit flex items-center gap-1">
                                <x-gxui.button.button
                                    wire:ignore
                                    x-on:click="$store.salesTeamScheduleStore.onSubmitSchedules(index)"
                                    x-bind:disabled="$store.salesTeamScheduleStore.availableSchedule[index].loading"
                                    class="!px-6"
                                >
                                    <template x-if="!$store.salesTeamScheduleStore.availableSchedule[index].loading">
                                        <div class="w-full flex justify-center items-center gap-1 text-xs">
                                            <span>Submit</span>
                                        </div>
                                    </template>
                                    <template x-if="$store.salesTeamScheduleStore.availableSchedule[index].loading">
                                        <x-gxui.loader.button-loader></x-gxui.loader.button-loader>
                                    </template>
                                </x-gxui.button.button>
                                <x-gxui.button.button
                                    wire:ignore
                                    x-on:click="$store.salesTeamScheduleStore.onRemoveSchedules(index)"
                                    x-bind:disabled="$store.salesTeamScheduleStore.availableSchedule[index].loading"
                                    class="!px-6 !border-red-500 bg-red-500 hover:bg-red-600 hover:!border-red-600 disabled:!bg-red-600"
                                >
                                    <template x-if="!$store.salesTeamScheduleStore.availableSchedule[index].loading">
                                        <div class="w-full flex justify-center items-center gap-1 text-xs">
                                            <span>Delete</span>
                                        </div>
                                    </template>
                                    <template x-if="$store.salesTeamScheduleStore.availableSchedule[index].loading">
                                        <x-gxui.loader.button-loader></x-gxui.loader.button-loader>
                                    </template>
                                </x-gxui.button.button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const AVAILABLE_SCHEDULES = [
                {key: 0, label: 'Sunday', route: '', loading: false},
                {key: 1, label: 'Monday', route: '', loading: false},
                {key: 2, label: 'Tuesday', route: '', loading: false},
                {key: 3, label: 'Wednesday', route: '', loading: false},
                {key: 4, label: 'Thursday', route: '', loading: false},
                {key: 5, label: 'Friday', route: '', loading: false},
                {key: 6, label: 'Saturday', route: '', loading: false},
            ];
            Alpine.store('salesTeamScheduleStore', {
                component: null,
                toastStore: null,
                loading: true,
                data: [],
                routeOptions: [],
                selectedSales: '',
                loadingSave: false,
                availableSchedule: AVAILABLE_SCHEDULES.map(schedule => ({...schedule})),
                init: function () {
                    const componentID = document.querySelector('[data-component-id="sales-team-schedule"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.getAllRoutes();
                        }
                    })
                },
                hydrateSelectedSales(id) {
                    this.selectedSales = id;
                    if (id !== '') {
                        this.onFindAll();
                    }
                },
                getAllRoutes() {
                    this.component.$wire.call('routes')
                        .then(response => {
                            const {success, data, meta, message} = response;
                            if (success) {
                                let routeOptions = [];
                                data.forEach(function (v, k) {
                                    const option = {id: v.id, text: v.name};
                                    routeOptions.push(option);
                                });
                                this.routeOptions = routeOptions;
                            } else {
                                this.toastStore.failed(message);
                            }
                        })
                },
                onFindAll() {
                    this.loading = true;
                    const id = this.selectedSales;
                    this.availableSchedule = AVAILABLE_SCHEDULES.map(schedule => ({...schedule}));
                    this.component.$wire.call('schedules', id)
                        .then(response => {
                            const {success, data, meta, message} = response;
                            if (success) {
                                this.data = data;
                                this.data.forEach((v, k) => {
                                    const day = v['day'];
                                    const routeID = v['route_id'];
                                    let selectedSchedule = this.availableSchedule.find((item) => item.key === day);
                                    if (selectedSchedule) {
                                        selectedSchedule.route = routeID;
                                    }
                                })
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.loading = false;
                    })
                },
                onSubmitSchedules(index) {
                    const selectedSchedules = this.availableSchedule[index];
                    const form = {
                        salesTeamID: this.selectedSales,
                        routeID: selectedSchedules.route,
                        day: selectedSchedules.key
                    };
                    selectedSchedules.loading = true;
                    this.component.$wire.call('patchSchedule', form)
                        .then(response => {
                            const {success, data, meta, message} = response;
                            console.log(response);
                            if (success) {
                                this.toastStore.success(message);
                                this.onFindAll()
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        selectedSchedules.loading = false;
                    })
                },
                onRemoveSchedules(index) {
                    const selectedSchedules = this.availableSchedule[index];
                    const form = {
                        salesTeamID: this.selectedSales,
                        routeID: selectedSchedules.route,
                        day: selectedSchedules.key
                    };
                    selectedSchedules.loading = true;
                    this.component.$wire.call('removeSchedule', form)
                        .then(response => {
                            const {success, data, meta, message} = response;
                            if (success) {
                                this.toastStore.success(message);
                                this.onFindAll()
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        selectedSchedules.loading = false;
                    })
                }
            });
        });
    </script>
@endpush
