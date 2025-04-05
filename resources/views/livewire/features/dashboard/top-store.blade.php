<section
    id="section-dashboard-top-store"
    data-component-id="dashboard-top-store"
    class="w-full"
>
    <div class="w-full bg-white p-4 rounded-lg shadow-md h-[15.5rem] flex flex-col">
        <div class="w-full flex items-center justify-between mb-1">
            <span class="text-neutral-700 font-semibold leading-none block">Most Frequently Store</span>
        </div>
        <div class="w-full flex-1">
            <div class="flex flex-col gap-2 w-full" x-cloak x-show="!$store.dashboardTopStore.loading">
                <template x-for="(data, index) in $store.dashboardTopStore.data" :key="index">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-neutral-500" x-text="data.name"></span>
                            <span class="text-xs text-neutral-500" x-text="'('+data.total+')'"></span>
                        </div>
                        <div class="h-3 w-full relative bg-neutral-300 rounded-sm">
                            <div
                                class="h-3 absolute top-0 left-0 bg-orange-500 rounded-sm"
                                x-bind:style="{width: data.percentage+'%'}"
                            ></div>
                        </div>
                    </div>
                </template>
            </div>
            <div class="flex flex-col gap-1 w-full" x-cloak x-show="$store.dashboardTopStore.loading">
                <template x-for="(data, index) in [1, 2, 3, 4, 5]" :key="index">
                    <div>
                        <x-gxui.loader.shimmer class="!h-[3] !w-1/3 !rounded-sm mb-1"></x-gxui.loader.shimmer>
                        <x-gxui.loader.shimmer class="!h-[3] !w-full !rounded-sm"></x-gxui.loader.shimmer>
                    </div>
                </template>
            </div>
        </div>
    </div>
</section>
@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const componentProps = {
                component: null,
                toastStore: null,
                loading: true,
                data: [],
                sumTotal: 0,
                init: function () {
                    const componentID = document.querySelector('[data-component-id="dashboard-top-store"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.getTopStore();
                        }
                    });
                },
                getTopStore() {
                    this.loading = true;
                    this.component.$wire.call('getTopStore')
                        .then(response => {
                            const {success, data, message} = response;
                            console.log(response);
                            if (success) {
                                this.generateChart(data);
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.loading = false;
                    })
                },
                generateChart(d) {
                    const sumTotal = d.reduce((sum, item) => sum + parseInt(item['transactions_count']), 0);
                    this.sumTotal = sumTotal;
                    this.data = d.map((v, k) => {
                        const totalValue = parseInt(v['transactions_count']);
                        return {
                            name: v['name'],
                            total: totalValue,
                            percentage: (totalValue / sumTotal) * 100
                        };
                    });
                }
            };
            const props = Object.assign({}, componentProps);
            Alpine.store('dashboardTopStore', props);
        });
    </script>
@endpush
