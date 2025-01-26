<div>
    <div class="mb-5">
        <x-gxui.typography.page-title text="Master Data"></x-gxui.typography.page-title>
        <x-gxui.typography.page-sub-title text="Welcome to master data. You can create new or edit any data master on this page."></x-gxui.typography.page-sub-title>
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
            <div class="w-full rounded-lg border border-neutral-300">
                <table class="w-full">
                    <thead>
                    <tr class="rounded-t-lg border-b border-neutral-300 bg-brand-50">
                        <x-table.server.components.ui-th
                            title="No."
                            className="w-[70px]"
                        ></x-table.server.components.ui-th>
                        <x-table.server.components.ui-th
                            title="Name"
                            align="left"
                        ></x-table.server.components.ui-th>
                        <x-table.server.components.ui-th
                            title="Action"
                            className="w-[80px]"
                        ></x-table.server.components.ui-th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="h-[300px] w-full flex flex-col items-center justify-center">
                    <img src="{{ asset('/assets/images/no-data.png') }}" alt="no-data-image"
                         height="150" width="150">
                    <p class="text-sm text-brand-500">No data available</p>
                </div>
            </div>
            <div class="mt-1 flex items-center justify-between gap-3">
                <div class="text-xs text-neutral-500">Total Rows : <span
                        class="font-semibold text-neutral-700">100</span></div>
                <div class="flex items-center">
                    <div class="flex gap-2 items-center text-xs text-neutral-500">
                        <span>Lines per page</span>
                        <select
                            class="border border-neutral-500 w-fit appearance-none rounded-[4px] text-xs pl-2 !pr-[1.25rem] py-1 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 cursor-pointer"
                            style="
                        background-position: right 0.5rem center;
                        background-image: url('data:image/svg+xml,%3csvg aria-hidden=%27true%27 xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 16 16%27%3e%3cpath stroke=%27%236B7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27m2 6 6-6 6 6 m-12 4 6 6 6-6%27/%3e%3c/svg%3e');
                        "
                        >
                            <template x-for="value in {{ '[5, 10, 25]' }}">
                                <option :value="value" x-text="value"></option>
                            </template>
                        </select>
                    </div>
                    <div class="flex items-center gap-1 py-1.5 px-1.5" wire:ignore>
                        <a href="#" x-on:click.prevent=""
                           class="text-brand-500 cursor-pointer h-6 aspect-[1/1] rounded-full flex items-center justify-center hover:bg-brand-50 transition-all ease-in duration-200">
                            <i data-lucide="chevron-left"
                               class="text-neutral-500 group-focus-within:text-neutral-900 h-4 aspect-[1/1]">
                            </i>
                        </a>
                        <a href="#" x-on:click.prevent=""
                           class="text-white text-xs bg-brand-500 cursor-pointer h-6 aspect-[1/1] rounded-full flex items-center justify-center">
                            1
                        </a>
                        <a href="#" x-on:click.prevent=""
                           class="text-brand-500 text-xs cursor-pointer h-6 aspect-[1/1] rounded-full flex items-center justify-center hover:bg-brand-50 transition-all ease-in duration-200">
                            2
                        </a>
                        <a href="#" x-on:click.prevent=""
                           class="text-brand-500 cursor-pointer h-6 aspect-[1/1] rounded-full flex items-center justify-center hover:bg-brand-50 transition-all ease-in duration-200">
                            <i data-lucide="chevron-right"
                               class="text-neutral-500 group-focus-within:text-neutral-900 h-4 aspect-[1/1]">
                            </i>
                        </a>
                    </div>
                </div>
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
