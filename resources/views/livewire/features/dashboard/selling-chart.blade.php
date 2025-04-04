<section
    id="section-dashboard-selling-chart"
    data-component-id="dashboard-selling-chart"
    class="w-full"
>
    <div class="w-full bg-white p-4 rounded-lg shadow-md overflow-x-auto">
        <p class="text-neutral-700 font-semibold">Selling Chart</p>
        <div class="w-full relative">
            <div id="selling-chart-canvas" class="h-[25rem]" style="min-width: 150px;"></div>
            <div class="w-full absolute z-10 top-0 left-0" x-show="$store.dashboardSellingChartStore.loadingSellingChart">
                <x-gxui.loader.shimmer class="!h-[25rem] !w-full !rounded-md"></x-gxui.loader.shimmer>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.6.0/dist/echarts.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            const componentProps = {
                component: null,
                toastStore: null,
                chartInstance: null,
                resizeHandler: null,
                loadingSellingChart: null,
                init: function () {
                    const componentID = document.querySelector('[data-component-id="dashboard-selling-chart"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.getSellingChart();
                        }
                    });
                },
                getSellingChart() {
                    this.loadingSellingChart = true;
                    this.component.$wire.call('getSellingChart')
                        .then(response => {
                            const {success, data, meta} = response;
                            if (success) {
                                this.generateChart(data);
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.loadingSellingChart = false;
                    })
                },
                generateChart(d) {
                    const AVAILABLE_MONTH = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Des"];
                    let data = AVAILABLE_MONTH.map((v, k) => {
                        return d[k+1];
                    });
                    let chartEl = document.getElementById('selling-chart-canvas');
                    this.chartInstance = echarts.init(chartEl);
                    this.chartInstance.setOption({
                        tooltip: {
                            trigger: "item",
                            formatter: function (params) {
                                const data = params['data'];
                                return `IDR${data.toLocaleString('id-ID')}`;
                            }
                        },
                        xAxis: {
                            type: "category",
                            data: AVAILABLE_MONTH
                        },
                        yAxis: {
                            type: "value"
                        },
                        series: [{
                            name: "Sales",
                            type: "line",
                            data: data,
                            showSymbol: true, // pastikan simbol titik ditampilkan
                            symbolSize: 10
                        }]
                    });
                }
            };
            const props = Object.assign({}, componentProps);
            Alpine.store('dashboardSellingChartStore', props);
        })
    </script>
@endpush
