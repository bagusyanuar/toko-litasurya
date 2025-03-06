<section
    id="section-logout"
    data-component-id="section-logout"
    class=""
    x-data="{ open: false }"
>
    <x-navigation.navbar.ui-navbar>
        <div class="w-full h-full flex items-center justify-end px-5 relative">
            <div
                class="flex items-center gap-2 cursor-pointer"
                x-on:click="open = !open"
            >
                <div
                    class="h-[2.5rem] aspect-[1/1] rounded-full bg-brand-500 text-white flex items-center justify-center">
                    <span>LS</span>
                </div>
                <div>
                    <div class="text-neutral-700 text-sm" x-text="$store.navbarStore.username"></div>
                    <div class="text-neutral-500 text-xs" x-text="$store.navbarStore.role"></div>
                </div>

            </div>
            <div
                x-show="open"
                class="absolute right-5 bottom-[-2rem] transform"
                x-on:click.away="open = false;"
                x-cloak
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="translate-y-[-100%] opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="translate-y-0 opacity-100"
                x-transition:leave-end="translate-y-[-100%] opacity-0"
            >
                <div
                    class="w-24 px-1 py-1 bg-white rounded shadow-md text-sm text-neutral-700"
                >
                    <div
                        class="rounded px-3 cursor-pointer hover:bg-neutral-100 transition-all ease-in duration-200"
                        x-on:click="$store.navbarStore.logout()"
                    >
                        Logout
                    </div>
                </div>
            </div>
        </div>
    </x-navigation.navbar.ui-navbar>

</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('navbarStore', {
                component: null,
                username: '',
                role: '',
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="section-logout"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.username = component.$wire.get('username');
                            this.role = component.$wire.get('role');
                        }
                    });
                },
                async logout() {
                    await this.component.$wire.call('logout');
                    window.location.replace('/');
                }
            });
        });
    </script>
@endpush
