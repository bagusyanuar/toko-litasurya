<div class="{{ $parentClassName }}">
    <label for="{{ $id }}" class="text-sm text-neutral-700 {{ $label !== '' ? 'block mb-1' : '' }}">{{ $label }}</label>
    <div class="relative group w-full" x-data="{
            show: false,
            icon: 'eye-off',
            initIcons() {
               setTimeout(() => { lucide.createIcons(); }, 0);
            }
        }"
         x-init="initIcons()"
         x-effect="initIcons()"
    >
        <div wire:ignore class="h-full flex items-center px-[0.5rem] absolute inset-y-0 start-0">
            <i data-lucide="lock" class="text-neutral-500 group-focus-within:text-neutral-900 h-3 aspect-[1/1]"></i>
        </div>
        <input
            :type="show ? 'text' : 'password'"
            {{ $attributes->merge(['class' => $baseClass]) }}
            x-bind:class="{{ $validatorKey !== '' ? "{ '!border-danger-500' : '{$validatorField}' in {$validatorKey} }" : "{}" }}"
        >
        <div
            wire:ignore
            x-on:click="show = !show; show === true ? (icon = 'eye') : (icon = 'eye-off'); initIcons()"
            class="h-full flex items-center px-[0.5rem] absolute inset-y-0 end-0 cursor-pointer">
            <i
                :data-lucide="icon"
                class="text-neutral-500 group-focus-within:text-neutral-900 h-3 aspect-[1/1]">
            </i>
        </div>
    </div>
    @if($validatorKey !== '')
        <template x-if="'{{ $validatorField }}' in {{ $validatorKey }}">
            <span class="text-xs text-danger-500 mt-1 block" x-text="{{ $validatorKey }}['{{ $validatorField }}'][0]"></span>
        </template>
    @endif
</div>
