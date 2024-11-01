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
                <x-input.text-icon
                    wire:model="username"
                    parentClassName="mb-3"
                    size="small"
                    placeholder="username"
                    materialIcon="person"></x-input.text-icon>
                <x-input.password-icon
                    wire:model="password"
                    class="w-full"
                    size="small"
                    placeholder="password"></x-input.password-icon>
            </div>
        </div>
    </div>
    {{--    <div class="w-[320px] bg-white p-4 border border-neutral-300 rounded-md">--}}
    {{--        <div class="w-full flex justify-center">--}}
    {{--            <img--}}
    {{--                class="w-[120px] h-auto mb-3"--}}
    {{--                src="{{ asset('/assets/images/logo.png') }}"--}}
    {{--                alt="img-logo">--}}
    {{--        </div>--}}
    {{--        <p class="text-sm text-neutral-900 font-bold text-center">Selamat Datang Di Toko LitaSurya</p>--}}
    {{--        <p class="text-xs text-neutral-500 text-center mb-3">Masukan username dan password</p>--}}
    {{--        <div class="w-full flex flex-col gap-2 mb-3">--}}


    {{--        </div>--}}
    {{--        <div class="w-full flex justify-end">--}}
    {{--            <x-button.button--}}
    {{--                @click="$wire.submitLogin();"--}}
    {{--                loadingTarget="submitLogin"--}}
    {{--                theme="primary"--}}
    {{--                size="small">--}}
    {{--                Login--}}
    {{--            </x-button.button>--}}
    {{--        </div>--}}
    {{--    </div>--}}
</div>
