<section
    id="section-cashier-billing"
    data-component-id="cashier-billing"
>
    <div class="w-72 bg-white px-6 py-4 rounded-md shadow-md">
        <p class="font-bold text-sm text-neutral-700 mb-3">Billing</p>
        <hr class="mb-3"/>
        <x-gxui.input.select.select2
            label="Customer"
            parentClassName="mb-3 flex-1"
            selectID="billingCustomerSelect"
            x-init="initSelect2({placeholder: 'choose a customer'})"
            x-bind="gxuiSelect2Bind"
            x-bind:store-name="'$store.billingStore.customerOptions'"
            x-model="$store.billingStore.customerValue"
        ></x-gxui.input.select.select2>

        <hr class="mb-3"/>
        <div class="w-full mb-3 flex items-center justify-between text-neutral-700">
            <span class="">Total</span>
            <span class="font-bold">: <span
                    x-text="'Rp. '+$store.billingStore.total.toLocaleString('id-ID')"></span></span>
        </div>

        <hr class="mb-3"/>
        <div class="flex items-center justify-end w-full mb-3">
            <input
                id="print-option"
                type="checkbox"
                class="w-4 h-4 text-brand-500 bg-gray-100 border-brand-500 rounded-sm !focus:ring-0 !focus:outline-none"
                style="box-shadow: none"
                x-on:change="$store.billingStore.usePrint = $event.target.checked"
                :checked="$store.billingStore.usePrint"
            >
            <label for="cashier-type" class="ms-2 text-xs font-medium text-neutral-700">Print</label>
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
                actionLoaderStore: null,
                transactionStore: null,
                cartStore: null,
                total: 0,
                customerValue: '',
                usePrint: true,
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="cashier-billing"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.transactionStore = Alpine.store('transactionStore');
                            this.cartStore = Alpine.store('cartStore');
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.actionLoaderStore = Alpine.store('gxuiActionLoader');
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
                    this.actionLoaderStore.start('placing order...');
                    const form = {
                        'customer_id': this.customerValue,
                        'carts': this.cartStore.data,
                        'print': this.usePrint
                    };
                    this.component.$wire.call('submitOrder', form)
                        .then(response => {
                            const {success, message, data} = response;
                            if (success) {
                                this.actionLoaderStore.end();
                                this.customerValue = '';
                                $('#customerSelect').val(null).trigger('change');
                                this.toastStore.success(message);
                                this.cartStore.clearCart();
                                const {withPoint, point} = data;
                                if (withPoint) {
                                    this.transactionStore.showPoint(point);
                                }
                            } else {
                                this.actionLoaderStore.end();
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
