<section
    id="section-price-list-item"
    data-component-id="price-list-item"
>
    <x-gxui.modal.form
        show="$store.priceListStore.showModalPriceList"
        width="80%"
    >
        <div
            class="modal-header flex items-center justify-between px-4 py-3 border-b border-neutral-300 rounded-t">
            <span class="text-neutral-700 font-semibold">Product Price List</span>
            <button
                type="button"
                x-on:click="$store.priceListStore.closeModal()"
                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-4 h-4 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            >
                <svg class="w-2 h-2" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <div
            class="modal-body px-6 pt-6 pb-6 overflow-y-scroll flex-grow-1"
        >
            <div class="w-full grid grid-cols-4 gap-3 mb-3">
                <div class="flex flex-col">
                    <div class="bg-brand-500 rounded-tr-md rounded-tl-md px-3 py-2.5">
                        <span class="text-white">Retail</span>
                    </div>
                    <div class="w-full p-3 border-t-0 border border-neutral-300 rounded-br-md rounded-bl-md">
                        <x-gxui.input.text.text
                            placeholder=""
                            label="PLU"
                            parentClassName="mb-3"
                            x-model="$store.priceListStore.retailPrice.plu"
                            x-bind:disabled="$store.priceListStore.saveProcess === 'retail'"
                        ></x-gxui.input.text.text>
                        <x-gxui.input.text.text
                            placeholder="0"
                            label="Price"
                            parentClassName="mb-3"
                            x-model="$store.priceListStore.retailPrice.price"
                            x-mask:dynamic="$money($input, ',')"
                            x-bind:disabled="$store.priceListStore.saveProcess === 'retail'"
                            validatorKey="$store.priceListStore.retailValidator"
                            validatorField="price"
                        ></x-gxui.input.text.text>
                        <hr/>
                        <div class="flex justify-end w-full mt-3">
                            <x-gxui.button.button
                                wire:ignore
                                x-on:click="$store.priceListStore.mutate('retail')"
                                class="!px-4 !py-2"
                                x-bind:disabled="$store.priceListStore.saveProcess === 'retail'"
                            >
                                <template x-if="!($store.priceListStore.saveProcess === 'retail')">
                                    <div class="w-full flex justify-center items-center gap-1 text-xs">
                                        <span>Submit</span>
                                    </div>
                                </template>
                                <template x-if="$store.priceListStore.saveProcess === 'retail'">
                                    <x-gxui.loader.button-loader class="!text-xs"></x-gxui.loader.button-loader>
                                </template>
                            </x-gxui.button.button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="bg-brand-500 rounded-tr-md rounded-tl-md px-3 py-2.5">
                        <span class="text-white">Dozen</span>
                    </div>
                    <div class="w-full p-3 border-t-0 border border-neutral-300 rounded-br-md rounded-bl-md">
                        <x-gxui.input.text.text
                            placeholder=""
                            label="PLU"
                            parentClassName="mb-3"
                            x-model="$store.priceListStore.dozenPrice.plu"
                            x-bind:disabled="$store.priceListStore.saveProcess === 'dozen'"
                        ></x-gxui.input.text.text>
                        <x-gxui.input.text.text
                            placeholder="0"
                            label="Price"
                            parentClassName="mb-3"
                            x-model="$store.priceListStore.dozenPrice.price"
                            x-mask:dynamic="$money($input, ',')"
                            x-bind:disabled="$store.priceListStore.saveProcess === 'dozen'"
                            validatorKey="$store.priceListStore.dozenValidator"
                            validatorField="price"
                        ></x-gxui.input.text.text>
                        <hr/>
                        <div class="flex justify-end w-full mt-3">
                            <x-gxui.button.button
                                wire:ignore
                                x-on:click="$store.priceListStore.mutate('dozen')"
                                class="!px-4 !py-2"
                                x-bind:disabled="$store.priceListStore.saveProcess === 'dozen'"
                            >
                                <template x-if="!($store.priceListStore.saveProcess === 'dozen')">
                                    <div class="w-full flex justify-center items-center gap-1 text-xs">
                                        <span>Submit</span>
                                    </div>
                                </template>
                                <template x-if="$store.priceListStore.saveProcess === 'dozen'">
                                    <x-gxui.loader.button-loader class="!text-xs"></x-gxui.loader.button-loader>
                                </template>
                            </x-gxui.button.button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="bg-brand-500 rounded-tr-md rounded-tl-md px-3 py-2.5">
                        <span class="text-white">Carton</span>
                    </div>
                    <div class="w-full p-3 border-t-0 border border-neutral-300 rounded-br-md rounded-bl-md">
                        <x-gxui.input.text.text
                            placeholder=""
                            label="PLU"
                            parentClassName="mb-3"
                            x-model="$store.priceListStore.cartonPrice.plu"
                            x-bind:disabled="$store.priceListStore.saveProcess === 'carton'"
                        ></x-gxui.input.text.text>
                        <x-gxui.input.text.text
                            placeholder="0"
                            label="Price"
                            parentClassName="mb-3"
                            x-model="$store.priceListStore.cartonPrice.price"
                            x-mask:dynamic="$money($input, ',')"
                            x-bind:disabled="$store.priceListStore.saveProcess === 'carton'"
                            validatorKey="$store.priceListStore.cartonValidator"
                            validatorField="price"
                        ></x-gxui.input.text.text>
                        <hr/>
                        <div class="flex justify-end w-full mt-3">
                            <x-gxui.button.button
                                wire:ignore
                                x-on:click="$store.priceListStore.mutate('carton')"
                                class="!px-4 !py-2"
                                x-bind:disabled="$store.priceListStore.saveProcess === 'carton'"
                            >
                                <template x-if="!($store.priceListStore.saveProcess === 'carton')">
                                    <div class="w-full flex justify-center items-center gap-1 text-xs">
                                        <span>Submit</span>
                                    </div>
                                </template>
                                <template x-if="$store.priceListStore.saveProcess === 'carton'">
                                    <x-gxui.loader.button-loader class="!text-xs"></x-gxui.loader.button-loader>
                                </template>
                            </x-gxui.button.button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="bg-brand-500 rounded-tr-md rounded-tl-md px-3 py-2.5">
                        <span class="text-white">Trader</span>
                    </div>
                    <div class="w-full p-3 border-t-0 border border-neutral-300 rounded-br-md rounded-bl-md">
                        <x-gxui.input.text.text
                            placeholder=""
                            label="PLU"
                            parentClassName="mb-3"
                            x-model="$store.priceListStore.traderPrice.plu"
                            x-bind:disabled="$store.priceListStore.saveProcess === 'trader'"
                        ></x-gxui.input.text.text>
                        <x-gxui.input.text.text
                            placeholder="0"
                            label="Price"
                            parentClassName="mb-3"
                            x-model="$store.priceListStore.traderPrice.price"
                            x-mask:dynamic="$money($input, ',')"
                            x-bind:disabled="$store.priceListStore.saveProcess === 'trader'"
                            validatorKey="$store.priceListStore.traderValidator"
                            validatorField="price"
                        ></x-gxui.input.text.text>
                        <hr/>
                        <div class="flex justify-end w-full mt-3">
                            <x-gxui.button.button
                                wire:ignore
                                x-on:click="$store.priceListStore.mutate('trader')"
                                class="!px-4 !py-2 !text-xs"
                                x-bind:disabled="$store.priceListStore.saveProcess === 'trader'"
                            >
                                <template x-if="!($store.priceListStore.saveProcess === 'trader')">
                                    <div class="w-full flex justify-center items-center gap-1 text-xs">
                                        <span>Submit</span>
                                    </div>
                                </template>
                                <template x-if="$store.priceListStore.saveProcess === 'trader'">
                                    <x-gxui.loader.button-loader class="!text-xs"></x-gxui.loader.button-loader>
                                </template>
                            </x-gxui.button.button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </x-gxui.modal.form>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const INITIAL_PRICE = {
                plu: '',
                price: '',
            };

            const STORE_PROPS = {
                component: null,
                toastStore: null,
                tableStore: null,
                showModalPriceList: false,
                retailPrice: {...INITIAL_PRICE, unit: 'retail'},
                dozenPrice: {...INITIAL_PRICE, unit: 'dozen'},
                cartonPrice: {...INITIAL_PRICE, unit: 'carton'},
                traderPrice: {...INITIAL_PRICE, unit: 'trader'},
                saveProcess: '',
                retailValidator: {},
                dozenValidator: {},
                cartonValidator: {},
                traderValidator: {},
                itemID: '',
                priceKeys: ['retail', 'dozen', 'carton', 'trader'],
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="price-list-item"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.tableStore = Alpine.store('itemTableStore');
                        }
                    });
                },
                showModal() {
                    this.showModalPriceList = true;
                },
                closeModal() {
                    this.formReset();
                    this.showModalPriceList = false;
                },
                formReset() {
                    this.retailPrice = {...INITIAL_PRICE, unit: 'retail'};
                    this.dozenPrice = {...INITIAL_PRICE, unit: 'dozen'};
                    this.cartonPrice = {...INITIAL_PRICE, unit: 'carton'};
                    this.traderPrice = {...INITIAL_PRICE, unit: 'trader'};
                    this.itemID = '';
                    this.retailValidator = {};
                    this.dozenValidator = {};
                    this.cartonValidator = {};
                    this.traderValidator = {};
                },
                hydrateForm(item) {
                    this.itemID = item['id'];
                    const prices = item['prices'];
                    this.priceKeys.forEach((v, k) => {
                        const price = prices.find(el => el.unit === v);
                        if (price) {
                            switch (v) {
                                case 'retail':
                                    this.retailPrice = {
                                        ...this.retailPrice,
                                        plu: price['price_list_unit'],
                                        price: price['price'].toLocaleString('id-ID')
                                    };
                                    break;
                                case 'dozen':
                                    this.dozenPrice = {
                                        ...this.dozenPrice,
                                        plu: price['price_list_unit'],
                                        price: price['price'].toLocaleString('id-ID')
                                    };
                                    break;
                                case 'carton':
                                    this.cartonPrice = {
                                        ...this.cartonPrice,
                                        plu: price['price_list_unit'],
                                        price: price['price'].toLocaleString('id-ID')
                                    };
                                    break;
                                case 'trader':
                                    this.traderPrice = {
                                        ...this.traderPrice,
                                        plu: price['price_list_unit'],
                                        price: price['price'].toLocaleString('id-ID')
                                    };
                                    break;
                                default:
                                    break;
                            }
                        }
                    });

                    this.showModalPriceList = true;
                },
                async mutate(type = 'retail') {
                    this.saveProcess = type;
                    let form = {};
                    switch (type) {
                        case 'retail':
                            form = {...this.retailPrice, item_id: this.itemID,};
                            break;
                        case 'dozen':
                            form = {...this.dozenPrice, item_id: this.itemID};
                            break;
                        case 'carton':
                            form = {...this.cartonPrice, item_id: this.itemID};
                            break;
                        case 'trader':
                            form = {...this.traderPrice, item_id: this.itemID};
                            break;
                        default:
                            break;
                    }
                    const response = await this.component.$wire.call('mutate', form);
                    const {success, data, status, message} = response;
                    if (success) {
                        this.toastStore.success(message);
                    } else {
                        switch (status) {
                            case 422:
                                switch (type) {
                                    case 'retail':
                                        this.retailValidator = data;
                                        break;
                                    case 'dozen':
                                        this.dozenValidator = data;
                                        break;
                                    case 'carton':
                                        this.cartonValidator = data;
                                        break;
                                    case 'trader':
                                        this.traderValidator = data;
                                        break;
                                    default:
                                        break;
                                }
                                this.toastStore.failed('please fill the correct form');
                                break;
                            case 500:
                                this.toastStore.failed('internal server error');
                                break;
                            default:
                                this.toastStore.failed('unknown error');
                                break;
                        }
                    }
                    this.saveProcess = '';
                }
            };
            Alpine.store('priceListStore', STORE_PROPS);
        });
    </script>
@endpush


