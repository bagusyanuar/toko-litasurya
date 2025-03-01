<div>
    <x-gxui.toast.toast></x-gxui.toast.toast>
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
    </div>
    <x-gxui.loader.action-loader
        show="$store.customerStore.processLoading"
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
            <p class="text-sm text-brand-500" x-text="$store.customerStore.processText"></p>
        </div>
    </x-gxui.loader.action-loader>
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('customerStore', {
                selectedTab: 'store',
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
