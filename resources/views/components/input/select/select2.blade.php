<div
    x-data="{ selectedItem: $wire.entangle('{{ $model }}'), element: null }"
    wire:ignore
    x-init="$nextTick(() => {
        element = $('#{{ $id }}').select2();
        $('#{{ $id }}').next('.select2-container').addClass('!w-full');
        $('#{{ $id }}').next('.select2-container').find('.select2-selection--single').addClass('{{ $baseClass }}');
        $('#{{ $id }}').next('.select2-container').find('.select2-selection--single').find('.select2-selection__rendered').addClass('!px-[0] !leading-[2]');
        $('#{{ $id }}').next('.select2-container').find('.select2-selection--single').find('.select2-selection__arrow').addClass('!top-1/2 !h-[0]');
        $('#{{ $id }}').on('select2:select', function (e) {
            let item = {
                id: e.params.data.id,
                text: e.params.data.text
            };
            @this.set('{{ $model }}', item);
        });
 })" class="w-full">
    <label for="{{ $id }}" class="text-xs text-neutral-700 block mb-1">{{ $label }}</label>
    <select id="{{ $id }}" class="form-control w-full text-[0.725rem] text-neutral-700 border border-neutral-300 rounded-[4px] focus:ring-0 focus:outline-none focus:border-neutral-500 transition duration-300 ease-in-out">
        @foreach($options as $option)
            <option value="{{ $option['value'] }}">{{ $option['text'] }}</option>
        @endforeach
    </select>
</div>
