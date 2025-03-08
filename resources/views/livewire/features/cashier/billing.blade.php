<section
    id="section-cashier-billing"
    data-component-id="cashier-billing"
>
    <div class="w-72 bg-white p-6 rounded-md shadow-md">
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
            <span class="font-bold">: <span
                    x-text="'Rp. '+$store.billingStore.total.toLocaleString('id-ID')"></span></span>
        </div>
        <x-gxui.button.button
            wire:ignore
            x-on:click="$store.billingStore.submitOrder()"
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
                toastStore: null,
                transactionStore: null,
                cartStore: null,
                total: 0,
                customerValue: '',
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="cashier-billing"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.transactionStore = Alpine.store('transactionStore');
                            this.cartStore = Alpine.store('cartStore');
                            this.toastStore = Alpine.store('gxuiToastStore');
                            let selectElement = document.getElementById("customerSelect");
                            this.customerSelectStore = Alpine.store('gxuiSelectStore')
                                .initSelect2(
                                    selectElement,
                                    this.onChangeCustomer.bind(this),
                                    {placeholder: 'choose a customer'}
                                );
                            this.component.$wire.call('customer').then(response => {
                                const {success, data} = response;
                                if (success) {
                                    let customerOptions = [];
                                    data.forEach(function (v, k) {
                                        const option = {id: v.id, text: v.name};
                                        customerOptions.push(option);
                                    });
                                    this.customerOptions = customerOptions;
                                } else {
                                    this.toastStore.failed('failed to load customer option');
                                }
                            });
                        }
                    });
                },
                setTotal(total) {
                    this.total = total;
                },
                submitOrder() {
                    this.transactionStore.showLoading('placing order...');
                    const form = {
                        'customer_id': this.customerValue,
                        'carts': this.cartStore.data
                    };
                    this.component.$wire.call('submitOrder', form)
                        .then(response => {
                            const {success, message, data} = response;
                            if (success) {
                                this.transactionStore.closeLoading();
                                this.customerValue = '';
                                $('#customerSelect').val(null).trigger('change');
                                this.toastStore.success(message);
                                this.cartStore.clearCart();
                                const {withPoint, point} = data;
                                if (withPoint) {
                                    this.transactionStore.showPoint(point);
                                }
                            } else {
                                this.transactionStore.closeLoading();
                                this.toastStore.failed(message);
                            }
                        })
                },
                onChangeCustomer(item) {
                    this.customerValue = item.id;
                },
            })
        });
    </script>
@endpush
