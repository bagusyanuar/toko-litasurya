<section
    id="section-master-data"
    data-component-id="master-data"
>
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
    <template x-if="$store.masterDataStore.selectedTab === 'category'">
        <div>
            <livewire:features.master-data.category.table/>
            <livewire:features.master-data.category.form/>
        </div>
    </template>
    <template x-if="$store.masterDataStore.selectedTab === 'item'">
        <div>
            <livewire:features.master-data.item.table/>
            <livewire:features.master-data.item.form/>
            <livewire:features.master-data.item.price-list/>
        </div>
    </template>
    <template x-if="$store.masterDataStore.selectedTab === 'reward'">
        <div>
            <livewire:features.master-data.reward.table/>
            <livewire:features.master-data.reward.form/>
        </div>
    </template>
    <template x-if="$store.masterDataStore.selectedTab === 'route'">
        <div>
            <livewire:features.master-data.route.table/>
            <livewire:features.master-data.route.form/>
        </div>
    </template>
    <template x-if="$store.masterDataStore.selectedTab === 'customer'">
        <div>
            <livewire:features.master-data.customer.index/>
        </div>
    </template>
    <template x-if="$store.masterDataStore.selectedTab === 'schedule'">
        <div>
            <div class="flex items-start gap-3 w-full">
                <livewire:features.master-data.schedule.team/>
                <livewire:features.master-data.schedule.schedule/>
            </div>
        </div>
    </template>

    <x-gxui.loader.action-loader></x-gxui.loader.action-loader>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('masterDataStore', {
                component: null,
                selectedTab: 'category',
                // init: function() {
                //     const componentID = document.querySelector('[data-component-id="master-data"]')?.getAttribute('wire:id');
                //     Livewire.hook('component.init', ({component}) => {
                //         if (component.id === componentID) {
                //             this.component = component;
                //             // const categoryTableComponent = document.querySelector('[data-component-id="table-category"]')?.getAttribute('wire:id');
                //             // if (categoryTableComponent === component.id) {
                //             //     this.tabEvent(this.selectedTab);
                //             // }
                //         }
                //     })
                // },
                onChangeTab(selectedTab) {
                    // this.tabEvent(selectedTab);
                    this.selectedTab = selectedTab;
                },
                tabEvent(selectedTab) {
                    switch (selectedTab) {
                        case 'category':
                            Alpine.store('categoryTableStore').onFindAll();
                            break;
                        case 'item':
                            Alpine.store('itemTableStore').onFindAll();
                            break;
                        case 'reward':
                            Alpine.store('rewardTableStore').onFindAll();
                            break;
                        case 'route':
                            Alpine.store('routeTableStore').onFindAll();
                            break;
                        default:
                            break;
                    }
                }
            })
        })
    </script>
@endpush
