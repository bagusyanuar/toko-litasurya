<section
    id="section-cashier-billing"
    data-component-id="cashier-billing"
>
    <div class="w-80 bg-white p-6 rounded-md shadow-md">
        <p class="font-bold text-neutral-700 mb-3">Billing</p>
        <hr class="mb-3"/>
        <x-gxui.input.select.select2
            store="billingStore"
            options="customerOptions"
            label="Customer"
            parentClassName="mb-3"
            selectID="customerSelect"
        ></x-gxui.input.select.select2>
        <hr class="mb-3"/>
        <div class="w-full mb-5 flex items-center justify-between text-neutral-700 text-lg">
            <span class="">Total</span>
            <span class="font-bold">: <span x-text="'Rp. '+$store.billingStore.total.toLocaleString('id-ID')"></span></span>
        </div>
        <x-gxui.button.button
            wire:ignore
            x-on:click=""
            class="!w-full"
            x-bind:disabled="false"
        >
            <div class="w-full flex justify-center items-center gap-1 text-sm">
                <span>Place Order</span>
            </div>
        </x-gxui.button.button>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('billingStore', {
                component: null,
                customerSelectStore: null,
                customerOptions: [],
                total: 0,
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="cashier-billing"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            let selectElement = document.getElementById("customerSelect");
                            this.customerSelectStore = Alpine.store('gxuiSelectStore')
                                .initSelect2(
                                    selectElement,
                                    this.onChangeCustomer.bind(this),
                                    {placeholder: 'choose a customer'}
                                );
                        }
                    });
                },
                setTotal(total) {
                    this.total = total;
                },
                onChangeCustomer(item) {
                },
            })
        });
    </script>
@endpush
