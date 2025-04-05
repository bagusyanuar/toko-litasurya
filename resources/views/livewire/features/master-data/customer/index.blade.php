<section
    id="section-customer"
    data-component-id="customer"
    class="w-full"
>
    <div class="w-full flex gap-3">
        <div class="w-[10rem] border-r border-neutral-300 pe-1">
            <div
                class="relative cursor-pointer w-full"
                x-on:click="$store.masterDataCustomerStore.onChangeTab('store')"
            >
                <div
                    class="w-full flex items-center justify-start py-1.5 gap-1 transition-all ease-in duration-200"
                    x-bind:class="$store.masterDataCustomerStore.selectedTab === 'store' ? 'text-brand-500' : 'text-neutral-500'"
                >
                    <div
                        class="w-0.5 h-[1.5rem] bg-brand-500 bg-brand-500 transition-all ease-in duration-200"
                        x-bind:class="$store.masterDataCustomerStore.selectedTab === 'store' ? 'bg-brand-500' : 'bg-neutral-200'"
                    ></div>
                    <i data-lucide="store" class="h-4 aspect-[1/1]"></i>
                    <span class="text-sm">Store</span>
                </div>
            </div>
            <div
                class="relative cursor-pointer w-full"
                x-on:click="$store.masterDataCustomerStore.onChangeTab('personal')"
            >
                <div
                    class="w-full flex items-center justify-start py-1.5 gap-1 transition-all ease-in duration-200"
                    x-bind:class="$store.masterDataCustomerStore.selectedTab === 'personal' ? 'text-brand-500' : 'text-neutral-500'"
                >
                    <div
                        class="w-0.5 h-[1.5rem] transition-all ease-in duration-200"
                        x-bind:class="$store.masterDataCustomerStore.selectedTab === 'personal' ? 'bg-brand-500' : 'bg-neutral-200'"
                    ></div>
                    <i data-lucide="user" class="h-4 aspect-[1/1]"></i>
                    <span class="text-sm">Personal</span>
                </div>
            </div>
        </div>
        <div class="flex-1">
            <div x-show="$store.masterDataCustomerStore.selectedTab === 'store'">
                <livewire:features.master-data.customer.store.table/>
                <livewire:features.master-data.customer.store.form/>
            </div>
            <div x-show="$store.masterDataCustomerStore.selectedTab === 'personal'">
                <livewire:features.master-data.customer.personal.table/>
                <livewire:features.master-data.customer.personal.form/>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('masterDataCustomerStore', {
                selectedTab: 'store',
                onChangeTab(selectedTab) {
                    this.selectedTab = selectedTab;
                },
            })
        })
    </script>
@endpush
