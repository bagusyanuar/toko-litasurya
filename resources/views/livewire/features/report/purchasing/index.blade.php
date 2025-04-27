<section
    id="section-purchasing"
    data-component-id="purchasing"
    class="w-full"
>
    <div class="w-full flex gap-3"
         x-data="{
            initIcons() {
               setTimeout(() => { lucide.createIcons(); }, 0);
            }
        }"
         x-init="initIcons()"
         x-effect="initIcons()"
    >
        <div class="min-w-[10rem] border-r border-neutral-300 pe-1">
            <div
                class="relative cursor-pointer w-full"
                x-on:click="$store.purchasingReportStore.onChangeTab('table')"
            >
                <div
                    class="w-full flex items-center justify-start py-1.5 gap-1 transition-all ease-in duration-200"
                    x-bind:class="$store.purchasingReportStore.selectedTab === 'table' ? 'text-brand-500' : 'text-neutral-500'"
                >
                    <div
                        class="w-0.5 h-[1.5rem] bg-brand-500 bg-brand-500 transition-all ease-in duration-200"
                        x-bind:class="$store.purchasingReportStore.selectedTab === 'table' ? 'bg-brand-500' : 'bg-neutral-200'"
                    ></div>
                    <i data-lucide="sheet" class="h-4 aspect-[1/1]"></i>
                    <span class="text-sm">Purchasing List</span>
                </div>
            </div>
            <div
                class="relative cursor-pointer w-full"
                x-on:click="$store.purchasingReportStore.onChangeTab('chart')"
            >
                <div
                    class="w-full flex items-center justify-start py-1.5 gap-1 transition-all ease-in duration-200"
                    x-bind:class="$store.purchasingReportStore.selectedTab === 'chart' ? 'text-brand-500' : 'text-neutral-500'"
                >
                    <div
                        class="w-0.5 h-[1.5rem] bg-brand-500 bg-brand-500 transition-all ease-in duration-200"
                        x-bind:class="$store.purchasingReportStore.selectedTab === 'chart' ? 'bg-brand-500' : 'bg-neutral-200'"
                    ></div>
                    <i data-lucide="chart-line" class="h-4 aspect-[1/1]"></i>
                    <span class="text-sm">Chart</span>
                </div>
            </div>
        </div>
        <div class="flex-1">
            <template x-if="$store.purchasingReportStore.selectedTab === 'table'">
                <div class="w-full">
                    <livewire:features.report.purchasing.table />
                </div>
            </template>
{{--            <template x-if="$store.purchasingReportStore.selectedTab === 'chart'">--}}
{{--                <div class="w-full">--}}
{{--                    <livewire:features.report.purchasing.chart />--}}
{{--                </div>--}}
{{--            </template>--}}
        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('purchasingReportStore', {
                selectedTab: 'table',
                onChangeTab(selectedTab) {
                    this.selectedTab = selectedTab;
                },
            })
        })
    </script>
@endpush
