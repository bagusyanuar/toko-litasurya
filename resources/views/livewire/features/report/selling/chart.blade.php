<section
    id="section-selling-chart"
    data-component-id="selling-chart"
    class="w-full"
>
    <div
        class="w-full flex justify-between items-center mb-3"
        x-data="{
            initIcons() {
               setTimeout(() => { lucide.createIcons(); }, 0);
            }
        }"
        x-init="initIcons()"
        x-effect="initIcons()"
    >
        <p class="mb-0 text-sm text-neutral-700 font-bold">SELLING CHART</p>
        <div class="flex gap-1 items-center">
            <input
                type="text"
                id="year-picker"
                x-bind="gxuiYearPickerBind"
                x-init="initYearPicker({})"
                class="border rounded px-3 py-2"
                placeholder="Select Year"
            />
        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const today = new Date().toLocaleDateString('id-ID', {
                year: 'numeric'
            });

            const componentProps = {
                component: null,
                toastStore: null,
                actionLoaderStore: null,
                year: '2025',
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="selling-chart"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                            this.actionLoaderStore = Alpine.store('gxuiActionLoader');
                        }
                    })
                },
                onFindAll() {},
                onDateChange() {
                    this.onFindAll();
                },
            };
            const props = Object.assign({}, window.TableStore, componentProps);
            Alpine.store('sellingChartStore', props);
        });
    </script>
@endpush
