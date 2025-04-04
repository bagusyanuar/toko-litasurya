<section
    id="section-dashboard-widget"
    data-component-id="dashboard-widget"
>
    <div class="w-full grid grid-cols-4 gap-3">
        <div
            class="bg-white shadow-md rounded-lg h-20 w-full flex items-start p-3 gap-2"
            wire:ignore
        >
            <div class="h-full aspect-[1/1] rounded-md bg-brand-500 flex items-center justify-center text-white">
                <i data-lucide="store" class="h-6 aspect-[1/1]"></i>
            </div>
            <div class="flex-1">
                <p class="font-bold text-base text-brand-500 leading-none">Store</p>
                <div x-show="$store.dashboardWidgetStore.loadingStoreCount" class="mt-1">
                    <x-gxui.loader.shimmer class="!h-5 !w-1/2"></x-gxui.loader.shimmer>
                </div>
                <div x-cloak x-show="!$store.dashboardWidgetStore.loadingStoreCount">
                    <p class="text-neutral-700 text-sm font-semibold" x-text="$store.dashboardWidgetStore.storeCount"></p>
                </div>
            </div>
        </div>
        <div
            class="bg-white shadow-md rounded-lg h-20 w-full flex items-start p-3 gap-2"
            wire:ignore
        >
            <div class="h-full aspect-[1/1] rounded-md bg-brand-500 flex items-center justify-center text-white">
                <i data-lucide="contact" class="h-6 aspect-[1/1]"></i>
            </div>
            <div class="flex-1">
                <p class="font-bold text-base text-brand-500 leading-none">Member</p>
                <div x-show="$store.dashboardWidgetStore.loadingMemberCount" class="mt-1">
                    <x-gxui.loader.shimmer class="!h-5 !w-1/2"></x-gxui.loader.shimmer>
                </div>
                <div x-cloak x-show="!$store.dashboardWidgetStore.loadingMemberCount">
                    <p class="text-neutral-700 text-sm font-semibold" x-text="$store.dashboardWidgetStore.memberCount"></p>
                </div>
            </div>
        </div>
        <div
            class="bg-white shadow-md rounded-lg h-20 w-full flex items-start p-3 gap-2"
            wire:ignore
        >
            <div class="h-full aspect-[1/1] rounded-md bg-brand-500 flex items-center justify-center text-white">
                <i data-lucide="wallet" class="h-6 aspect-[1/1]"></i>
            </div>
            <div class="flex-1">
                <p class="font-bold text-base text-brand-500 leading-none">Revenue</p>
                <div x-show="$store.dashboardWidgetStore.loadingTotalRevenue" class="mt-1">
                    <x-gxui.loader.shimmer class="!h-5 !w-1/2"></x-gxui.loader.shimmer>
                </div>
                <div x-cloak x-show="!$store.dashboardWidgetStore.loadingTotalRevenue">
                    <p class="text-neutral-700 text-sm font-semibold" x-text="'IDR'+$store.dashboardWidgetStore.totalRevenue.toLocaleString('id-ID')"></p>
                </div>
            </div>
        </div>
        <div
            class="bg-white shadow-md rounded-lg h-20 w-full flex items-start p-3 gap-2"
            wire:ignore
        >
            <div class="h-full aspect-[1/1] rounded-md bg-brand-500 flex items-center justify-center text-white">
                <i data-lucide="box" class="h-6 aspect-[1/1]"></i>
            </div>
            <div class="flex-1">
                <p class="font-bold text-base text-brand-500 leading-none">Product</p>
                <div x-show="$store.dashboardWidgetStore.loadingProductCount" class="mt-1">
                    <x-gxui.loader.shimmer class="!h-5 !w-1/2"></x-gxui.loader.shimmer>
                </div>
                <div x-cloak x-show="!$store.dashboardWidgetStore.loadingProductCount">
                    <p class="text-neutral-700 text-sm font-semibold" x-text="$store.dashboardWidgetStore.productCount"></p>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const componentProps = {
                component: null,
                toastStore: null,
                loadingStoreCount: true,
                loadingMemberCount: true,
                loadingTotalRevenue: true,
                loadingProductCount: true,
                storeCount: 0,
                memberCount: 0,
                totalRevenue: 0,
                productCount: 0,
                init: function () {
                    const componentID = document.querySelector('[data-component-id="dashboard-widget"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.onMemberCount();
                            this.onStoreCount();
                            this.onProductCount();
                            this.onTotalRevenue();
                        }
                    });
                },
                onStoreCount() {
                    this.loadingStoreCount = true;
                    this.component.$wire.call('getStoreCount')
                        .then(response => {
                            const {success, data, meta} = response;
                            if (success) {
                                this.storeCount = data;
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.loadingStoreCount = false;
                    })
                },
                onMemberCount() {
                    this.loadingMemberCount = true;
                    this.component.$wire.call('getMemberCount')
                        .then(response => {
                            const {success, data, message} = response;
                            if (success) {
                                this.memberCount = data;
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.loadingMemberCount = false;
                    })
                },
                onProductCount() {
                    this.loadingProductCount = true;
                    this.component.$wire.call('getProductCount')
                        .then(response => {
                            const {success, data, message} = response;
                            if (success) {
                                this.productCount = data;
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.loadingProductCount = false;
                    })
                },
                onTotalRevenue() {
                    this.loadingTotalRevenue = true;
                    this.component.$wire.call('getTotalRevenue')
                        .then(response => {
                            const {success, data, message} = response;
                            if (success) {
                                this.totalRevenue = data;
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.loadingTotalRevenue = false;
                    })
                },
            };
            const props = Object.assign({}, componentProps);
            Alpine.store('dashboardWidgetStore', props);
        });
    </script>
@endpush
