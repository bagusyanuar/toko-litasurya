<section
    id="section-selling-chart"
    data-component-id="selling-chart"
    class="w-full"
>
    <div
        class="w-full flex justify-between items-center mb-3"
        x-data="{
            initIcons() {
               setTimeout(() => { lucide.createIcons(); }, 0);
            }
        }"
        x-init="initIcons()"
        x-effect="initIcons()"
    >
        <p class="mb-0 text-sm text-neutral-700 font-bold">SELLING CHART</p>
        <div class="flex gap-1 items-center" wire:ignore>
            <x-gxui.input.date.yearpicker
                id="filterSellingYear"
                store="sellingChartStore"
                placeholder="yyyy"
                class="!w-[120px]"
                x-model="$store.sellingChartStore.year"
                x-init="initDatepicker({format: 'yyyy'})"
                dispatcher="onDateChange"
            ></x-gxui.input.date.yearpicker>
        </div>
    </div>
    <div class="w-full relative">
        <div id="selling-chart-canvas" class="h-[25rem] w-full" style="min-width: 150px; width: 100%;"></div>
        <div class="w-full absolute z-10 top-0 left-0" x-show="$store.sellingChartStore.loadingSellingChart">
            <x-gxui.loader.shimmer class="!h-[25rem] !w-full !rounded-md"></x-gxui.loader.shimmer>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const today = new Date().toLocaleDateString('id-ID', {
                year: 'numeric'
            });

            const componentProps = {
                component: null,
                toastStore: null,
                actionLoaderStore: null,
                chartInstance: null,
                resizeHandler: null,
                loadingSellingChart: null,
                year: '2025',
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="selling-chart"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.actionLoaderStore = Alpine.store('gxuiActionLoader');
                            this.getSellingChart();
                        }
                    });
                },
                onDateChange() {
                    this.getSellingChart();
                },
                getSellingChart() {
                    this.loadingSellingChart = true;
                    this.component.$wire.call('createChart', this.year)
                        .then(response => {
                            const {success, data, meta, message} = response;
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
                        return d[k + 1];
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
            const props = Object.assign({}, window.TableStore, componentProps);
            Alpine.store('sellingChartStore', props);
        });
    </script>
@endpush
