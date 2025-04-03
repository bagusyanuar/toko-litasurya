<section
    id="section-dashboard-selling-chart"
    data-component-id="dashboard-selling-chart"
    class="w-full"
>
    <div class="w-full bg-white p-4 rounded-lg shadow-md">
        <p class="text-neutral-700 font-semibold">Selling Chart</p>
        <div id="selling-chart-canvas" class="h-72"></div>
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
                init: function () {
                    const componentID = document.querySelector('[data-component-id="dashboard-selling-chart"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.generateChart();
                        }
                    });
                },
                generateChart() {
                    let chartEl = document.getElementById('selling-chart-canvas');
                    this.chartInstance = echarts.init(chartEl);
                    this.chartInstance.setOption({
                        tooltip: {
                            trigger: "axis"
                        },
                        xAxis: {
                            type: "category",
                            data: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Des"]
                        },
                        yAxis: {
                            type: "value"
                        },
                        series: [{
                            name: "Sales",
                            type: "line",
                            data: [120, 200, 150, 80, 70]
                        }]
                    });

                    this.resizeHandler = () => {
                        console.log("Resized");
                        if (this.chartInstance) {
                            this.chartInstance.resize();
                        }
                    };

                    window.addEventListener("resize", this.resizeHandler);
                }
            };
            const props = Object.assign({}, componentProps);
            Alpine.store('dashboardSellingChartStore', props);
        })
    </script>
@endpush
