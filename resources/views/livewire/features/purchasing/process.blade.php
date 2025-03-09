<section
    id="section-process-purchasing"
    data-component-id="process-purchasing"
>
    <x-gxui.modal.form
        {{--        show="$store.filterPurchasingStore.showModal"--}}
        show="true"
        width="24rem"
    >
    </x-gxui.modal.form>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            const STORE_PROPS = {
                showModal: false,
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="process-purchasing"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;

                        }
                    });
                },
            };
            Alpine.store('processPurchasingStore', STORE_PROPS);
        });
    </script>
@endpush
