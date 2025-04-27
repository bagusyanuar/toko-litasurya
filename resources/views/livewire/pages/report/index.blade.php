<div>
    <div class="mb-5">
        <x-gxui.typography.page-title text="Reports and Analytics"></x-gxui.typography.page-title>
        <x-gxui.typography.page-sub-title
            text="Welcome to reports and analytics page. You can view report and analytic your transaction on this page."></x-gxui.typography.page-sub-title>
    </div>
    <x-gxui.tab.tab-container class="mb-5">
        <x-gxui.tab.tab-item
            active="$store.reportStore.selectedTab === 'selling'"
            icon="shopping-bag"
            title="Selling Report"
            handleChange="$store.reportStore.onChangeTab('selling')"
        ></x-gxui.tab.tab-item>
        <x-gxui.tab.tab-item
            active="$store.reportStore.selectedTab === 'purchasing'"
            icon="notebook-pen"
            title="Purchasing"
            handleChange="$store.reportStore.onChangeTab('purchasing')"
        ></x-gxui.tab.tab-item>
    </x-gxui.tab.tab-container>
    <template x-if="$store.reportStore.selectedTab === 'selling'">
        <div>
            <livewire:features.report.selling.index/>
        </div>
    </template>
    <template x-if="$store.reportStore.selectedTab === 'purchasing'">
        <div>
            <livewire:features.report.purchasing.index/>
        </div>
    </template>
    <x-gxui.loader.action-loader></x-gxui.loader.action-loader>
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('reportStore', {
                selectedTab: 'selling',
                onChangeTab(selectedTab) {
                    this.selectedTab = selectedTab;
                },
            });
        });
    </script>
@endpush
