<div class="relative group {{ $parentClassName }}" x-data="{
            show: false,
            icon: 'eye-off',
            initIcons() {
               setTimeout(() => { lucide.createIcons(); }, 0);
            }
        }"
     x-init="initIcons()"
     x-effect="initIcons()"
>
    <div class="h-full flex items-center px-[0.5rem] absolute inset-y-0 start-0">
        <i data-lucide="lock" class="text-neutral-500 group-focus-within:text-neutral-900 h-3 aspect-[1/1]"></i>
    </div>
    <input :type="show ? 'text' : 'password'" {{ $attributes->merge(['class' => $baseClass]) }}>
    <div
        x-on:click="show = !show; show === true ? (icon = 'eye') : (icon = 'eye-off'); initIcons()"
        class="h-full flex items-center px-[0.5rem] absolute inset-y-0 end-0 cursor-pointer">
        <i
            x-effect="console.log(icon)"
            :data-lucide="icon"
            class="text-neutral-500 group-focus-within:text-neutral-900 h-3 aspect-[1/1]">
        </i>
    </div>
</div>
