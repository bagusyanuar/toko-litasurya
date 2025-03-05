<section
    id="section-form-login"
    data-component-id="form-login"
>
    <x-gxui.toast.toast></x-gxui.toast.toast>
    <div class="w-full h-screen flex items-center justify-center bg-neutral-100">
        <div class="h-full w-full bg-brand-500 flex-[3]">
            <img src="{{ asset('/assets/images/login-background.jpg') }}" class="w-full h-full object-cover"
                 alt="login-background">
        </div>
        <div class="h-full w-full flex-[2] flex items-center justify-center">
            <div class="w-[20rem] px-10 py-6 rounded-lg shadow-lg bg-white">
                <p class="text-xl text-neutral-800 font-bold mb-1">Halo, Selamat Datang di Toko Lita Surya</p>
                <p class="text-xs text-neutral-500">Please insert username and password</p>
                <div class="mt-5 w-full">
                    <x-gxui.input.text.text-icon
                        placeholder="username"
                        parentClassName="mb-3"
                        iconName="user"
                        x-model="$store.authStore.form.username"
                        x-bind:disabled="$store.authStore.loading"
                        validatorKey="$store.authStore.formValidator"
                        validatorField="username"
                    ></x-gxui.input.text.text-icon>
                    <x-gxui.input.password.password-icon
                        placeholder="password"
                        parentClassName="mb-3"
                        iconName="user"
                        x-model="$store.authStore.form.password"
                        x-bind:disabled="$store.authStore.loading"
                        validatorKey="$store.authStore.formValidator"
                        validatorField="password"
                    ></x-gxui.input.password.password-icon>
                </div>
                <div class="w-full mb-5">
                    <x-gxui.button.button
                        wire:ignore
                        x-on:click="$store.authStore.login()"
                        x-bind:disabled="$store.authStore.loading"
                        class="!px-6 !w-full"
                    >
                        <template x-if="!$store.authStore.loading">
                            <div class="w-full flex justify-center items-center gap-1 text-sm">
                                <span>Login</span>
                            </div>
                        </template>
                        <template x-if="$store.authStore.loading">
                            <x-gxui.loader.button-loader></x-gxui.loader.button-loader>
                        </template>
                    </x-gxui.button.button>
                </div>
                <div class="w-full text-center">
                    <span class="text-xs text-neutral-500">App Version v.1.0</span>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('authStore', {
                toastStore: null,
                form: {
                    username: '',
                    password: ''
                },
                formValidator: {},
                loading: false,
                init: function () {
                    Livewire.hook('component.init', ({component}) => {
                        const componentID = document.querySelector('[data-component-id="form-login"]')?.getAttribute('wire:id');
                        if (component.id === componentID) {
                            this.component = component;
                            this.toastStore = Alpine.store('gxuiToastStore');
                        }
                    });
                },
                async login() {
                    this.loading = true;
                    const response = await this.component.$wire.call('login', this.form);
                    const {success, data, status, message} = response;
                    if (success) {
                        this.toastStore.success(message);
                        setTimeout(() => {
                            window.location.replace('/dashboard');
                        }, 1000);
                    } else {
                        switch (status) {
                            case 422:
                                this.formValidator = data;
                                this.toastStore.failed('please fill the correct form');
                                break;
                            case 404:
                                this.toastStore.failed(message);
                                break;
                            case 401:
                                this.toastStore.failed(data);
                                break;
                            case 500:
                                this.toastStore.failed('internal server error');
                                break;
                            default:
                                this.toastStore.failed('unknown error');
                                break;
                        }
                    }
                    this.loading = false;
                }
            });
        });
    </script>
@endpush
