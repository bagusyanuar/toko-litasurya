<div
    x-show="$store.gxuiToastStore.open"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-300 transform"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="translate-x-full opacity-0"
    class="fixed top-5 right-5 bg-white h-[4.275rem] w-80 flex rounded shadow-lg z-[300]"
    style="display: none;"
    x-init="
        $watch('$store.gxuiToastStore.open', value => {
            if(value) {
                setTimeout(() =>  { $store.gxuiToastStore.close() }, $store.gxuiToastStore.timeToClose )
            }
        })
    "
>
    <div class="w-full" x-cloak x-show="$store.gxuiToastStore.type === 'success'">
        <x-gxui.toast.type.toast-success></x-gxui.toast.type.toast-success>
    </div>
    <div class="w-full" x-cloak x-show="$store.gxuiToastStore.type === 'error'">
        <x-gxui.toast.type.toast-error></x-gxui.toast.type.toast-error>
    </div>
</div>
