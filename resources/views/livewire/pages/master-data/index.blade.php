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
            active="$store.masterDataStore.selectedTab === 'gift'"
            icon="gem"
            title="Reward"
            handleChange="$store.masterDataStore.onChangeTab('gift')"
        ></x-gxui.tab.tab-item>
        <x-gxui.tab.tab-item
            active="$store.masterDataStore.selectedTab === 'route'"
            icon="route"
            title="Route"
            handleChange="$store.masterDataStore.onChangeTab('route')"
        ></x-gxui.tab.tab-item>
    </x-gxui.tab.tab-container>
    <div x-show="$store.masterDataStore.selectedTab === 'category'">
        <div class="bg-white w-full px-6 py-5 rounded-lg shadow-md">
            <div class="w-full flex items-center justify-between mb-3">
                <p class="text-neutral-700 font-semibold">Category Data</p>
                <x-gxui.button.button
                    wire:ignore
                >
                    <div class="w-full flex justify-center items-center gap-1 text-sm">
                        <i data-lucide="plus" class="h-3" style="width: fit-content;"></i>
                        <span>Create New</span>
                    </div>
                </x-gxui.button.button>
            </div>
            <x-gxui.table.table
                class="mb-1"
                isLoading="true"
            >
                <x-slot name="header">
                    <x-gxui.table.th
                        title="Name"
                        align="left"
                    ></x-gxui.table.th>
                    <x-gxui.table.th
                        title="Action"
                        className="w-[80px]"
                    ></x-gxui.table.th>
                </x-slot>
                <x-slot name="rows">
                    <tr>
                        <td colspan="2">
                            <x-gxui.table.empty-row></x-gxui.table.empty-row>
                        </td>
                    </tr>
                </x-slot>
            </x-gxui.table.table>
            <x-gxui.table.pagination
                shownPages="[1, 2, 3, 4, 5]"
                currentPage="1"
            ></x-gxui.table.pagination>
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
