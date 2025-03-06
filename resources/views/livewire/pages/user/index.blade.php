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
    <div x-show="$store.userStore.selectedTab === 'admin'">
        <livewire:features.user.admin.table/>
        <livewire:features.user.admin.form/>
    </div>
    <div x-show="$store.userStore.selectedTab === 'sales-team'">
        <livewire:features.user.sales-team.table/>
        <livewire:features.user.sales-team.form/>
    </div>
    <x-gxui.loader.action-loader
        show="$store.userStore.processLoading"
        x-cloak
    >
        <div class="h-24 w-full flex flex-col gap-1 items-center justify-center">
            <svg class="w-6 h-6 animate-spinner me-1 text-brand-500" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24">
                <g>
                    <circle cx="3" cy="12" r="1.5" class="fill-current"/>
                    <circle cx="21" cy="12" r="1.5" class="fill-current"/>
                    <circle cx="12" cy="21" r="1.5" class="fill-current"/>
                    <circle cx="12" cy="3" r="1.5" class="fill-current"/>
                    <circle cx="5.64" cy="5.64" r="1.5" class="fill-current"/>
                    <circle cx="18.36" cy="18.36" r="1.5" class="fill-current"/>
                    <circle cx="5.64" cy="18.36" r="1.5" class="fill-current"/>
                    <circle cx="18.36" cy="5.64" r="1.5" class="fill-current"/>
                </g>
            </svg>
            <p class="text-sm text-brand-500" x-text="$store.userStore.processText"></p>
        </div>
    </x-gxui.loader.action-loader>
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
                showLoading(text = 'Loading process...') {
                    this.processText = text;
                    this.processLoading = true;
                },
                closeLoading() {
                    this.processLoading = false;
                    this.processText = 'Loading...';
                }
            });
        });
    </script>
@endpush
