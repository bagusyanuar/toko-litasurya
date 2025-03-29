<div>
    <x-gxui.toast.toast></x-gxui.toast.toast>
    <div class="mb-5">
        <x-gxui.typography.page-title text="Sales Team"></x-gxui.typography.page-title>
        <x-gxui.typography.page-sub-title
            text="Welcome to sales team page. You can create new or edit any data sales team on this page."></x-gxui.typography.page-sub-title>
    </div>
    <x-gxui.tab.tab-container class="mb-5">
        <x-gxui.tab.tab-item
            active="$store.salesTeamStore.selectedTab === 'schedule'"
            icon="calendar-check"
            title="Schedule"
            handleChange="$store.salesTeamStore.onChangeTab('schedule')"
        ></x-gxui.tab.tab-item>
        <x-gxui.tab.tab-item
            active="$store.salesTeamStore.selectedTab === 'sales-team'"
            icon="bike"
            title="Sales Team"
            handleChange="$store.salesTeamStore.onChangeTab('sales-team')"
        ></x-gxui.tab.tab-item>
    </x-gxui.tab.tab-container>
    <div x-show="$store.salesTeamStore.selectedTab === 'schedule'">
        <div class="flex items-start">
            <livewire:features.sales-team.schedule.team/>
            <div class="flex-1"></div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('salesTeamStore', {
                selectedTab: 'schedule',
                onChangeTab(selectedTab) {
                    this.selectedTab = selectedTab;
                },
            });
        });
    </script>
@endpush
