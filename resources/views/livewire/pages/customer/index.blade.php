<div>
    <div class="mb-5">
        <x-gxui.typography.page-title text="Customer"></x-gxui.typography.page-title>
        <x-gxui.typography.page-sub-title
            text="Welcome to customer. You can create new or edit any data customer include store partner on this page."></x-gxui.typography.page-sub-title>
    </div>
    <x-gxui.tab.tab-container class="mb-5">
        <x-gxui.tab.tab-item
            active="$store.customerStore.selectedTab === 'store'"
            icon="store"
            title="Store"
            handleChange="$store.customerStore.onChangeTab('store')"
        ></x-gxui.tab.tab-item>
        <x-gxui.tab.tab-item
            active="$store.customerStore.selectedTab === 'personal'"
            icon="user"
            title="Personal"
            handleChange="$store.customerStore.onChangeTab('personal')"
        ></x-gxui.tab.tab-item>
    </x-gxui.tab.tab-container>
    <div x-show="$store.customerStore.selectedTab === 'store'">
        <livewire:features.customer.store.table/>
        <livewire:features.customer.store.form/>
    </div>
    <div x-show="$store.customerStore.selectedTab === 'personal'">
        <livewire:features.customer.personal.table/>
        <livewire:features.customer.personal.form/>
    </div>
    <x-gxui.loader.action-loader></x-gxui.loader.action-loader>
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('customerStore', {
                selectedTab: 'store',
                onChangeTab(selectedTab) {
                    this.selectedTab = selectedTab;
                },
            });
        });
    </script>
@endpush
