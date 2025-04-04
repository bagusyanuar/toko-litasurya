<section
    id="section-dashboard-purchasing"
    data-component-id="dashboard-purchasing"
    class="w-full"
>
    <div class="w-full bg-white p-4 rounded-lg shadow-md h-[22rem]">
        <div class="w-full flex items-center justify-between mb-1">
            <span class="text-neutral-700 font-semibold leading-none block">Purchasing</span>
            <span
                class="text-sm text-neutral-500 block cursor-pointer hover:underline transition-all ease-in duration-300">see all</span>
        </div>
        <div class="w-full flex flex-col gap-1" x-show="$store.dashboardPurchasingStore.loading">
            <template x-for="(data, index) in [1, 2, 3, 4, 5]" :key="index">
                <x-gxui.loader.shimmer class="!h-[3.5rem] !w-full !rounded-md"></x-gxui.loader.shimmer>
            </template>
        </div>
        <div class="flex flex-col gap-1" x-cloak x-show="!$store.dashboardPurchasingStore.loading">
            <template x-for="(data, index) in $store.dashboardPurchasingStore.data" :key="index">
                <div class="flex items-center py-3 border-b border-neutral-300 rounded-md">
                    <div class="flex-1">
                        <span
                            class="text-neutral-700 font-bold leading-none text-sm block mb-0"
                            x-text="data.customer ? data.customer?.name : '-'"></span>
                        <span
                            class="text-xs text-neutral-500 block leading-[1.5]"
                            x-text="'IDR'+data.total.toLocaleString('id-ID')"
                        ></span>
                    </div>
                    <div class="w-fit flex items-center justify-center">
                        <template x-if="data.status === 'finish'">
                            <div class=" w-fit px-3 py-0.5 rounded bg-green-500 text-white flex items-center justify-center">
                                <span class="text-xs">Finish</span>
                            </div>
                        </template>
                        <template x-if="data.status === 'pending'">
                            <div class=" w-fit px-3 py-0.5 rounded bg-orange-500 text-white flex items-center justify-center">
                                <span class="text-xs">Pending</span>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>
    </div>
</section>
@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const componentProps = {
                component: null,
                toastStore: null,
                loading: true,
                data: [],
                init: function () {
                    const componentID = document.querySelector('[data-component-id="dashboard-purchasing"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.getLastPurchasing();
                        }
                    });
                },
                getLastPurchasing() {
                    this.loading = true;
                    this.component.$wire.call('getLastPurchasing')
                        .then(response => {
                            const {success, data, meta} = response;
                            if (success) {
                                this.data = data;
                            } else {
                                this.toastStore.failed(message);
                            }
                        }).finally(() => {
                        this.loading = false;
                    })
                },
            };
            const props = Object.assign({}, componentProps);
            Alpine.store('dashboardPurchasingStore', props);
        });
    </script>
@endpush
