<div class="relative group" x-data="{show: false}">
    <span
        class="material-symbols-outlined absolute inset-y-0 start-0 flex items-center pointer-events-none text-neutral-500 group-focus-within:text-neutral-900 {{ $iconClass }}">
        lock
    </span>
    <input :type="show ? 'text' : 'password'" {{ $attributes->merge(['class' => $baseClass]) }}>
    <span @click="show = !show"
        x-text="show ? 'visibility' : 'visibility_off'"
        class="cursor-pointer material-symbols-outlined absolute inset-y-0 end-0 flex items-center text-neutral-500 group-focus-within:text-neutral-900 {{ $showPasswordClass }}">
    </span>
</div>
