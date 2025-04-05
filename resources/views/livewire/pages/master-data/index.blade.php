<div>
    <div class="mb-5">
        <x-gxui.typography.page-title text="Master Data"></x-gxui.typography.page-title>
        <x-gxui.typography.page-sub-title
            text="Welcome to master data. You can create new or edit any data master on this page."></x-gxui.typography.page-sub-title>
    </div>
    <x-gxui.tab.tab-container class="mb-5">
        <x-gxui.tab.tab-item
            active="$store.masterDataStore.selectedTab === 'category'"
            icon="tags"
            title="Category"
            handleChange="$store.masterDataStore.onChangeTab('category')"
        ></x-gxui.tab.tab-item>
        <x-gxui.tab.tab-item
            active="$store.masterDataStore.selectedTab === 'item'"
            icon="box"
            title="Item"
            handleChange="$store.masterDataStore.onChangeTab('item')"
        ></x-gxui.tab.tab-item>
        <x-gxui.tab.tab-item
            active="$store.masterDataStore.selectedTab === 'reward'"
            icon="gem"
            title="Reward"
            handleChange="$store.masterDataStore.onChangeTab('reward')"
        ></x-gxui.tab.tab-item>
        <x-gxui.tab.tab-item
            active="$store.masterDataStore.selectedTab === 'route'"
            icon="route"
            title="Route"
            handleChange="$store.masterDataStore.onChangeTab('route')"
        ></x-gxui.tab.tab-item>
        <x-gxui.tab.tab-item
            active="$store.masterDataStore.selectedTab === 'customer'"
            icon="square-user"
            title="Customer"
            handleChange="$store.masterDataStore.onChangeTab('customer')"
        ></x-gxui.tab.tab-item>
        <x-gxui.tab.tab-item
            active="$store.masterDataStore.selectedTab === 'schedule'"
            icon="calendar-check"
            title="Schedule"
            handleChange="$store.masterDataStore.onChangeTab('schedule')"
        ></x-gxui.tab.tab-item>
    </x-gxui.tab.tab-container>
    <div x-show="$store.masterDataStore.selectedTab === 'category'">
        <livewire:features.master-data.category.table/>
        <livewire:features.master-data.category.form/>
    </div>
    <div
        x-show="$store.masterDataStore.selectedTab === 'item'"
        x-cloak
    >
        <livewire:features.master-data.item.table/>
        <livewire:features.master-data.item.form/>
        <livewire:features.master-data.item.price-list/>
    </div>
    <div
        x-show="$store.masterDataStore.selectedTab === 'reward'"
        x-cloak
    >
        <livewire:features.master-data.reward.table/>
        <livewire:features.master-data.reward.form/>
    </div>
    <div
        x-show="$store.masterDataStore.selectedTab === 'route'"
        x-cloak
    >
        <livewire:features.master-data.route.table/>
        <livewire:features.master-data.route.form/>
    </div>
    <div
        x-show="$store.masterDataStore.selectedTab === 'customer'"
        x-cloak
    >
        <livewire:features.master-data.customer.index/>
    </div>
    <div
        x-show="$store.masterDataStore.selectedTab === 'schedule'"
        x-cloak
    >
        <div class="flex items-start gap-3 w-full">
            <livewire:features.master-data.schedule.team/>
            <livewire:features.master-data.schedule.schedule/>
        </div>
    </div>
    <x-gxui.loader.action-loader></x-gxui.loader.action-loader>
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('masterDataStore', {
                selectedTab: 'category',
                onChangeTab(selectedTab) {
                    this.selectedTab = selectedTab;
                },
            })
        })
    </script>
@endpush
