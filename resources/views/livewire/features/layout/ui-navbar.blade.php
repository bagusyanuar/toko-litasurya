<section
    id="section-logout"
    data-component-id="section-logout"
>
    <x-navigation.navbar.ui-navbar>
        <div class="w-full h-full flex items-center justify-end px-5">
            <div
                class="flex items-center gap-2 cursor-pointer"
                x-on:click="$store.logoutStore.logout()"
            >
                <div class="h-[2.5rem] aspect-[1/1] rounded-full bg-brand-500 text-white flex items-center justify-center">
                    <span>LS</span>
                </div>
                <div>
                    <div class="text-neutral-700 text-sm">admin@gmail.com</div>
                    <div class="text-neutral-500 text-xs">superadmin</div>
                </div>
            </div>
        </div>
    </x-navigation.navbar.ui-navbar>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('logoutStore', {
                component: null,
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="section-logout"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                        }
                    });
                },
                async logout() {
                    console.log('abc');
                    await this.component.$wire.call('logout');
                    window.location.replace('/');
                }
            });
        });
    </script>
@endpush
