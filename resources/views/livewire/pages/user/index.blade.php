<div>
    <x-gxui.toast.toast></x-gxui.toast.toast>
    <div class="mb-5">
        <x-gxui.typography.page-title text="Users"></x-gxui.typography.page-title>
        <x-gxui.typography.page-sub-title
            text="Welcome to users page. You can create new or edit any data users on this page."></x-gxui.typography.page-sub-title>
    </div>
    <x-gxui.tab.tab-container class="mb-5">
        <x-gxui.tab.tab-item
            active="$store.userStore.selectedTab === 'admin'"
            icon="users"
            title="Admin"
            handleChange="$store.userStore.onChangeTab('admin')"
        ></x-gxui.tab.tab-item>
        <x-gxui.tab.tab-item
            active="$store.userStore.selectedTab === 'sales-team'"
            icon="bike"
            title="Sales Team"
            handleChange="$store.userStore.onChangeTab('sales-team')"
        ></x-gxui.tab.tab-item>
    </x-gxui.tab.tab-container>
    <template x-if="$store.userStore.selectedTab === 'admin'">
        <div>
            <livewire:features.user.admin.table/>
            <livewire:features.user.admin.form/>
        </div>
    </template>
    <template x-if="$store.userStore.selectedTab === 'sales-team'">
        <div>
            <livewire:features.user.sales-team.table/>
            <livewire:features.user.sales-team.form/>
        </div>
    </template>
    <x-gxui.loader.action-loader></x-gxui.loader.action-loader>
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('userStore', {
                selectedTab: 'admin',
                processLoading: false,
                processText: 'Loading...',
                onChangeTab(selectedTab) {
                    this.selectedTab = selectedTab;
                },
            });
        });
    </script>
@endpush
