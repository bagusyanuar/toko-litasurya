document.addEventListener('alpine:init', () => {
    Alpine.store('gxuiSelectStore', {
        value: null,
        selectedItem: null,
        element: null,
        initSelect2(element, callback) {
            $(element).select2({
                placeholder: 'Pilih Opsi',
            });
            $(element).next('.select2-container').addClass('!w-full');
            let select2Class = 'w-full !text-[0.825rem] !flex !items-center !px-[0.525rem] !py-[0.45rem] !h-[2.523rem] text-neutral-700 rounded-[4px] border !border-neutral-300 outline-none focus:outline-none focus:ring-0 !focus:border-neutral-500 transition duration-300 ease-in-out';
            $(element).next('.select2-container').find('.select2-selection--single').addClass(select2Class);
            $(element).next('.select2-container').find('.select2-selection--single').find('.select2-selection__rendered').addClass('!px-[0] !leading-[2]');
            $(element).next('.select2-container').find('.select2-selection--single').find('.select2-selection__arrow').addClass('!top-1/2 !h-[0]');
            $(element).val(this.value).trigger("change");
            $(element).on('select2:select', function (e) {
                let item = {
                    id: e.params.data.id,
                    text: e.params.data.text
                };
                this.selectedItem = item;
                this.value = item['id'];
                callback(item)
            });
            this.element = $(element);
            $(element).prop("disabled", true).trigger("change");
        },
        setValue(value) {
            this.element.val(value).trigger("change");
        }
    })
});
