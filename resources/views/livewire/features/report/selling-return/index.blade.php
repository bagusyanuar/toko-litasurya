<section
    id="section-selling-return"
    data-component-id="selling-return"
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
                x-on:click="$store.sellingReturnReportStore.onChangeTab('table')"
            >
                <div
                    class="w-full flex items-center justify-start py-1.5 gap-1 transition-all ease-in duration-200"
                    x-bind:class="$store.sellingReturnReportStore.selectedTab === 'table' ? 'text-brand-500' : 'text-neutral-500'"
                >
                    <div
                        class="w-0.5 h-[1.5rem] bg-brand-500 bg-brand-500 transition-all ease-in duration-200"
                        x-bind:class="$store.sellingReturnReportStore.selectedTab === 'table' ? 'bg-brand-500' : 'bg-neutral-200'"
                    ></div>
                    <i data-lucide="sheet" class="h-4 aspect-[1/1]"></i>
                    <span class="text-sm">Selling Return List</span>
                </div>
            </div>
            <div
                class="relative cursor-pointer w-full"
                x-on:click="$store.sellingReturnReportStore.onChangeTab('chart')"
            >
                <div
                    class="w-full flex items-center justify-start py-1.5 gap-1 transition-all ease-in duration-200"
                    x-bind:class="$store.sellingReturnReportStore.selectedTab === 'chart' ? 'text-brand-500' : 'text-neutral-500'"
                >
                    <div
                        class="w-0.5 h-[1.5rem] bg-brand-500 bg-brand-500 transition-all ease-in duration-200"
                        x-bind:class="$store.sellingReturnReportStore.selectedTab === 'chart' ? 'bg-brand-500' : 'bg-neutral-200'"
                    ></div>
                    <i data-lucide="chart-line" class="h-4 aspect-[1/1]"></i>
                    <span class="text-sm">Chart</span>
                </div>
            </div>
        </div>
        <div class="flex-1">
            <template x-if="$store.sellingReturnReportStore.selectedTab === 'table'">
                <div class="w-full">
                    <livewire:features.report.selling-return.table />
                </div>
            </template>
            <template x-if="$store.sellingReturnReportStore.selectedTab === 'chart'">
                <div class="w-full">
                    <livewire:features.report.selling-return.chart />
                </div>
            </template>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('sellingReturnReportStore', {
                selectedTab: 'table',
                onChangeTab(selectedTab) {
                    this.selectedTab = selectedTab;
                },
            })
        })
    </script>
@endpush
