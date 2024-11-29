<div x-data x-init="$nextTick(() => {
        console.log('abcdefg');
        const el = $('#{{ $id }}').select2();
        $('#{{ $id }}').next('.select2-container').find('.select2-selection--single').addClass('{{ $baseClass }}');
 })" class="w-full">
    <select id="{{ $id }}" class="form-control w-full text-[0.725rem] text-neutral-700 border border-neutral-300 rounded-[4px] focus:ring-0 focus:outline-none focus:border-neutral-500 transition duration-300 ease-in-out">
        @foreach($options as $option)
            <option value="{{ $option['value'] }}">{{ $option['text'] }}</option>
        @endforeach
    </select>
</div>
