<div>
    <x-gxui.toast.toast></x-gxui.toast.toast>
    <div class="mb-5">
        <x-gxui.typography.page-title text="Transaction"></x-gxui.typography.page-title>
        <x-gxui.typography.page-sub-title
            text="Welcome to transaction page. You can manage all transactions on this page."></x-gxui.typography.page-sub-title>
    </div>
    <x-gxui.tab.tab-container class="mb-5">
        <x-gxui.tab.tab-item
            active="$store.transactionStore.selectedTab === 'cashier'"
            icon="shopping-bag"
            title="Cashier"
            handleChange="$store.transactionStore.onChangeTab('cashier')"
        ></x-gxui.tab.tab-item>
        <x-gxui.tab.tab-item
            active="$store.transactionStore.selectedTab === 'purchasing'"
            icon="notebook-pen"
            title="Purchasing"
            handleChange="$store.transactionStore.onChangeTab('purchasing')"
        ></x-gxui.tab.tab-item>
        <x-gxui.tab.tab-item
            active="$store.transactionStore.selectedTab === 'selling-report'"
            icon="file-stack"
            title="Selling Report"
            handleChange="$store.transactionStore.onChangeTab('selling-report')"
        ></x-gxui.tab.tab-item>

    </x-gxui.tab.tab-container>
    <div x-show="$store.transactionStore.selectedTab === 'cashier'">
        <livewire:pages.cashier.index/>
    </div>
    <div x-cloak x-show="$store.transactionStore.selectedTab === 'purchasing'">
        <livewire:features.purchasing.table/>
        <livewire:features.purchasing.filter/>
        <livewire:features.purchasing.process/>
    </div>
    <div x-cloak x-show="$store.transactionStore.selectedTab === 'selling-report'">
        <livewire:features.selling-report.table/>
        <livewire:features.selling-report.filter/>
        {{--        <livewire:features.purchasing.process/>--}}
    </div>
    <x-gxui.loader.action-loader ></x-gxui.loader.action-loader>
    <div>
        <div
            class="fixed inset-0 bg-gray-500 bg-opacity-50 z-[300]"
            x-cloak
            x-show="$store.transactionStore.gift"
            x-on:click="$store.transactionStore.closePoint()"
        >
        </div>
        <div
            x-cloak
            x-show="$store.transactionStore.gift"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-y-[-100%] opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="translate-y-[-100%] opacity-0"
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-[301] flex items-center justify-center"
        >
            <div class="bg-white rounded shadow-lg w-[30rem] max-h-full flex flex-col items-center py-4">
                <p class="text-neutral-700 text-xl font-bold mb-5">Congratulations!</p>
                <img src="{{ asset('/static/images/gift.png') }}" alt="gift-image" class="w-auto h-32 mb-5">
                <p class="text-neutral-700 mb-3">You reached</p>
                <p class="text-brand-500 text-3xl font-extrabold mb-1" x-text="$store.transactionStore.point"></p>
                <p class="text-brand-500 text-xl font-bold">Point</p>

            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('transactionStore', {
                selectedTab: 'cashier',
                gift: false,
                point: 0,
                onChangeTab(selectedTab) {
                    this.selectedTab = selectedTab;
                },
                showPoint(point = 0) {
                    this.point = point;
                    this.gift = true;
                },
                closePoint() {
                    this.gift = false;
                    this.point = 0;
                }
            });
        });
    </script>
@endpush
