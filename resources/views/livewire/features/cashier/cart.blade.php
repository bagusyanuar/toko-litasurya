<section
    id="section-cashier-cart"
    data-component-id="cashier-cart"
    class="flex-1"
>
    <div class="w-full flex justify-end mb-3">
        <div class="flex gap-1">
            <div class="relative group">
                <div wire:ignore class="h-full flex items-center px-[0.5rem] absolute inset-y-0 start-0">
                    <i data-lucide="scan-barcode"
                       class="text-neutral-500 group-focus-within:text-neutral-900 h-4 aspect-[1/1]"></i>
                </div>
                <input
                    x-model="$store.cartStore.plu"
                    placeholder="scan barcode"
                    class="w-full text-sm ps-[2.05rem] pe-[0.825rem] py-[0.5rem] rounded text-neutral-700 border border-neutral-300 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 transition duration-300 ease-in"
                    x-on:keydown.enter="$store.cartStore.findByPLU()"
                />
            </div>
            <x-gxui.button.button
                wire:ignore
                x-on:click="$store.cartStore.searchProduct()"
                class="!w-fit"
                x-bind:disabled="false"
            >
                <div wire:ignore>
                    <i data-lucide="box"
                       class="text-white h-4 aspect-[1/1]"></i>
                </div>
            </x-gxui.button.button>
        </div>
    </div>
    <x-gxui.table.table
        class="mb-1"
        store="cartStore"
    >
        <x-slot name="header">
            <x-gxui.table.th
                title="Product"
                align="left"
                className="min-w-[150px] !text-sm"
            ></x-gxui.table.th>
            <x-gxui.table.th
                title="Unit"
                className="w-[80px]"
            ></x-gxui.table.th>
            <x-gxui.table.th
                title="Price (Rp.)"
                className="!w-[80px]"
                align="right"
            ></x-gxui.table.th>
            <x-gxui.table.th
                title="Qty"
                className="!w-[80px]"
            ></x-gxui.table.th>
            <x-gxui.table.th
                title="Total (Rp.)"
                className="!w-[80px]"
                align="right"
            ></x-gxui.table.th>
            <x-gxui.table.th
                title=""
                className="w-[40px]"
            ></x-gxui.table.th>
        </x-slot>
        <x-slot name="rows">
            <tr class="border-b border-neutral-300">
                <x-gxui.table.td className="min-w-[200px]">
                    <span class="text-sm font-bold text-neutral-900" x-text="data.name"></span>
                </x-gxui.table.td>
                <x-gxui.table.td className="flex justify-center">
                    <span x-text="data.unit"></span>
                </x-gxui.table.td>
                <x-gxui.table.td className="flex justify-end">
                    <span x-text="data.price.toLocaleString('id-ID') ?? '-'"></span>
                </x-gxui.table.td>
                <x-gxui.table.td className="flex justify-center">
                    <div x-data="{error: false}">
                        <input
                            class="w-10 px-1 py-1 text-xs text-center rounded text-neutral-700 border border-neutral-300 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 transition duration-300 ease-in"
                            x-model="data.qty"
                            x-on:input="
                                $store.cartStore.updateCart(data.id, $event.target.value);
                                error = $event.target.value.trim() === '';
                            "
                            :class="error ? 'border-red-500 focus:border-red-500' : 'border-neutral-300 focus:border-neutral-500'"
                        />
                    </div>
                </x-gxui.table.td>
                <x-gxui.table.td className="flex justify-end">
                    <span x-text="data.total.toLocaleString('id-ID') ?? '-'"></span>
                </x-gxui.table.td>
                <x-gxui.table.td className="flex justify-center relative">
                </x-gxui.table.td>
            </tr>
        </x-slot>
    </x-gxui.table.table>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('cartStore', {
                component: null,
                transactionStore: null,
                billingStore: null,
                toastStore: null,
                searchStore: null,
                plu: '',
                data: [],
                init: function () {
                    const componentID = document.querySelector('[data-component-id="cashier-cart"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                            this.billingStore = Alpine.store('billingStore');
                            this.transactionStore = Alpine.store('transactionStore');
                            this.searchStore = Alpine.store('cartSearchStore');
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.getCart();
                        }
                    })
                },
                findByPLU() {
                    const selectedItem = this.data.find(v => v.plu === this.plu);
                    if (selectedItem) {
                        selectedItem.qty = parseInt(selectedItem.qty) + 1;
                        selectedItem.total = selectedItem.qty * selectedItem.price;
                        this._setTotal();
                    } else {
                        this.transactionStore.showLoading('find product...');
                        this.component.$wire.call('getProductByPLU', this.plu)
                            .then(response => {
                                const {success, message, data} = response;
                                if (success) {
                                    this.addToCart(data);
                                } else {
                                    this.toastStore.failed(message);
                                }
                            }).finally(() => {
                            this.transactionStore.closeLoading();
                        })
                    }
                    this.plu = '';
                },
                searchProduct() {
                    this.searchStore.showModalSearch();
                },
                print() {
                    this.component.$wire.call('print')
                        .then(response => {
                            const {success, message, data} = response;
                            console.log(response)
                        }).finally(() => {
                    })
                },
                addToCart(item) {
                    const plu = item['price_list_unit'];
                    const cartItem = {
                        id: item['id'],
                        itemID: item['item']['id'],
                        plu: plu,
                        name: item['item']['name'],
                        price: item['price'],
                        unit: item['unit'],
                        qty: 1,
                        total: item['price']
                    };
                    const selectedItem = this.data.find(v => v.plu === plu);
                    if (selectedItem) {
                        selectedItem.qty = parseInt(selectedItem.qty) + 1;
                        selectedItem.total = selectedItem.qty * selectedItem.price;
                    } else {
                        this.data.push(cartItem);
                    }
                    this._setTotal();
                    this._updateStorageCart();
                },
                getCart() {
                    this.data = this._getStorageCart();
                    this._setTotal();
                },
                updateCart(id, qty) {
                    const item = this.data.find(item => item.id === id);
                    if (item) {
                        item.qty = qty;
                        let intQty = qty.trim() === '' ? 0 : qty;
                        item.total = intQty * item.price;
                    }
                    this._setTotal();
                    this._updateStorageCart();
                },
                _getTotal() {
                    return this.data.reduce((sum, item) => sum + item.total, 0);
                },
                _setTotal() {
                    this.billingStore.setTotal(this._getTotal());
                },
                _getStorageCart() {
                    const storage = JSON.parse(localStorage.getItem('cart') ?? '[]');
                    return Array.isArray(storage) ? storage : [];
                },
                _updateStorageCart() {
                    localStorage.setItem('cart', JSON.stringify(this.data));
                },
                clearCart() {
                    this.data = [];
                    this._setTotal();
                    localStorage.removeItem('cart');
                },
            });
        });
    </script>
@endpush
