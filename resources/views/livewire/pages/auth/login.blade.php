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
                <x-input.text.text-icon
                    wire:model="username"
                    parentClassName="mb-3"
                    placeholder="username"
                    iconName="user">
                </x-input.text.text-icon>
                <x-input.password.password-icon
                    parentClassName="mb-3"
                    wire:model="password"
                    placeholder="password">
                </x-input.password.password-icon>
            </div>
        </div>
    </div>
</div>
