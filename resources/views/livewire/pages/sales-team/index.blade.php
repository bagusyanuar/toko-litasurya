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
            active="$store.salesTeamStore.selectedTab === 'store-visit'"
            icon="store"
            title="Store Visits"
            handleChange="$store.salesTeamStore.onChangeTab('store-visit')"
        ></x-gxui.tab.tab-item>
    </x-gxui.tab.tab-container>
    <div x-show="$store.salesTeamStore.selectedTab === 'schedule'">
        <div class="flex items-start gap-3 w-full">
            <livewire:features.sales-team.schedule.team/>
            <livewire:features.sales-team.schedule.schedule/>
        </div>
    </div>
    <div x-show="$store.salesTeamStore.selectedTab === 'store-visit'">
        <livewire:features.sales-team.store-visit.table/>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('salesTeamStore', {
                selectedTab: 'store-visit',
                onChangeTab(selectedTab) {
                    this.selectedTab = selectedTab;
                },
            });
        });
    </script>
@endpush
