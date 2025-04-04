<section
    id="section-dashboard-top-product"
    data-component-id="dashboard-top-product"
    class="w-full"
>
    <div class="w-full bg-white p-4 rounded-lg shadow-md h-[15.5rem]">
        <div class="w-full flex items-center justify-between mb-1">
            <span class="text-neutral-700 font-semibold leading-none block">Top 5 Product</span>
        </div>
        <div class="w-full relative">
            <div id="top-product-chart-canvas" class="h-[10rem]" style="min-width: 150px;"></div>
            <div class="w-full absolute z-10 top-0 left-0" x-show="$store.dashboardTopProductStore.loading">
                <x-gxui.loader.shimmer class="!h-[10rem] !w-full !rounded-md"></x-gxui.loader.shimmer>
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
                init: function () {
                    const componentID = document.querySelector('[data-component-id="dashboard-top-product"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.getTopProduct();
                        }
                    });
                },
                getTopProduct() {
                    this.loading = true;
                    this.component.$wire.call('getTopProduct')
                        .then(response => {
                            const {success, data, message} = response;
                            console.log(response);
                            if (success) {
                                this.data = data;
                                this.generateChart(data);
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.loading = false;
                    })
                },
                generateChart(d) {
                    let data = [
                        ["score", "total", "name"]
                    ];
                    d.forEach((v, k) => {
                        data.push([
                            parseInt(v['total_sold']),
                            20,
                            v['name']
                        ]);
                    });
                    let chartEl = document.getElementById('top-product-chart-canvas');
                    this.chartInstance = echarts.init(chartEl);
                    this.chartInstance.setOption({
                        dataset: {
                            source: [
                                ['score', 'amount', 'product'],
                                [89.3, 58212, 'Matcha Latte'],
                                [57.1, 78254, 'Milk Tea'],
                                [74.4, 41032, 'Cheese Cocoa'],
                            ]
                        },
                        grid: { containLabel: true },
                        xAxis: { name: 'amount' },
                        yAxis: { type: 'category' },
                        series: [
                            {
                                type: 'bar',
                                encode: {
                                    // Map the "amount" column to X axis.
                                    x: 'amount',
                                    // Map the "product" column to Y axis
                                    y: 'product'
                                }
                            }
                        ]
                    });
                }
            };
            const props = Object.assign({}, componentProps);
            Alpine.store('dashboardTopProductStore', props);
        });
    </script>
@endpush
