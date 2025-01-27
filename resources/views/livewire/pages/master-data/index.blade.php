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
            active="$store.masterDataStore.selectedTab === 'box'"
            icon="box"
            title="Item"
            handleChange="$store.masterDataStore.onChangeTab('box')"
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
    </x-gxui.tab.tab-container>
    <div x-show="$store.masterDataStore.selectedTab === 'category'">
        <livewire:features.master-data.category.table />
    </div>
    <div x-show="$store.masterDataStore.selectedTab === 'box'">
        <div>Box</div>
    </div>
    <div x-show="$store.masterDataStore.selectedTab === 'gift'">
        <div>Gift</div>
    </div>
    <div x-show="$store.masterDataStore.selectedTab === 'route'">
        <div>Route</div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('masterDataStore', {
                selectedTab: 'category',
                onChangeTab(selectedTab) {
                    this.selectedTab = selectedTab;
                }
            })
        })
    </script>
@endpush
