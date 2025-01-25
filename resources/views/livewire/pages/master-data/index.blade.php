<div>
    <p class="text-xl font-semibold text-neutral-900 mb-1">Master Data</p>
    <p class="text-xs text-neutral-500 mb-5">Welcome to master data. You can set any data master on this page.</p>
    <div class="w-full border-b border-neutral-300 flex items-center mb-5">
        <x-tab.ui-tab-item
            active="$store.masterDataStore.selectedTab === 'category'"
            icon="tags"
            title="Category"
            handleChange="$store.masterDataStore.onChangeTab('category')"
        ></x-tab.ui-tab-item>
        <x-tab.ui-tab-item
            active="$store.masterDataStore.selectedTab === 'box'"
            icon="box"
            title="Item"
            handleChange="$store.masterDataStore.onChangeTab('box')"
        ></x-tab.ui-tab-item>
        <x-tab.ui-tab-item
            active="$store.masterDataStore.selectedTab === 'gift'"
            icon="gem"
            title="Reward"
            handleChange="$store.masterDataStore.onChangeTab('gift')"
        ></x-tab.ui-tab-item>
        <x-tab.ui-tab-item
            active="$store.masterDataStore.selectedTab === 'route'"
            icon="route"
            title="Route"
            handleChange="$store.masterDataStore.onChangeTab('route')"
        ></x-tab.ui-tab-item>
    </div>
    <div x-show="$store.masterDataStore.selectedTab === 'category'">
        <div class="bg-white w-full px-4 py-5 rounded-lg">
            <div class="w-full flex items-center justify-between mb-3">
                <p class="text-neutral-700 font-semibold">Category Data</p>
                <x-button.ui-button
                    wire:ignore
                    class="rounded-lg !text-xs !py-[0.5rem] !px-[0.5rem]"
                >
                    <div class="w-full flex justify-center items-center gap-1">
                        <i data-lucide="plus" class="h-3" style="width: fit-content"></i>
                        <span>Create New</span>
                    </div>
                </x-button.ui-button>
            </div>
            <div class="w-full rounded-lg border border-neutral-300 h-48">
                <table class="w-full">
                    <thead>
                        <tr class="rounded-t-lg border-b border-neutral-300 bg-brand-50">
                            <x-table.server.components.ui-th
                                title="No."
                                className="w-[70px]"
                            ></x-table.server.components.ui-th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
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
