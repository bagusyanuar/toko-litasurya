<button
    {{ $attributes->merge(['class' => 'rounded-lg py-[0.5rem] px-[0.5rem] cursor-pointer bg-brand-500 border border-brand-500 text-white hover:bg-brand-700 hover:border-brand-700 disabled:bg-brand-700 disabled:border-brand-700 transition duration-300 ease-in disabled:cursor-default']) }}
>
    {{ $slot }}
</button>
