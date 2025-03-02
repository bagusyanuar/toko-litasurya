document.addEventListener('alpine:init', () => {
    Alpine.store('gxuiSelectStore', {
        element: null,
        placeholder: 'choose an option',
        _init(callback) {
            this.element.next('.select2-container').addClass('!w-full');
            let select2Class = 'w-full !text-[0.825rem] !flex !items-center !px-[0.525rem] !py-[0.45rem] !h-[2.523rem] text-neutral-700 rounded-[4px] border !border-neutral-300 outline-none focus:outline-none focus:ring-0 !focus:border-neutral-500 transition duration-300 ease-in-out';
            this.element.next('.select2-container').find('.select2-selection--single').addClass(select2Class);
            this.element.next('.select2-container').find('.select2-selection--single').find('.select2-selection__rendered').addClass('!px-[0] !leading-[2]');
            this.element.next('.select2-container').find('.select2-selection--single').find('.select2-selection__arrow').addClass('!top-1/2 !h-[0]');
            this.element.val(this.value).trigger("change");
            this.element.on('select2:select', function (e) {
                let item = {
                    id: e.params.data.id,
                    text: e.params.data.text
                };
                callback(item)
            });
        },
        _initMultiple(callback) {
            this.element.next('.select2-container').addClass('!w-full');
            let select2Class = 'w-full !text-[0.825rem] !px-[0.525rem] !py-[0.45rem] !min-h-[2.5rem] text-neutral-700 rounded-[4px] border !border-neutral-300 outline-none focus:outline-none focus:ring-0 !focus:border-neutral-500 transition duration-300 ease-in-out';
            this.element.next('.select2-container').find('.select2-selection--multiple').addClass(select2Class);
            this.element.next('.select2-container').find('.select2-search.select2-search--inline textarea').addClass('!p-[unset] !ml-0 !leading-none');
            this.element.next('.select2-container').find('.select2-selection__choice')
                .css('margin-top', '0px !important');
            this.element.next('.select2-container').find('.select2-search__field')
                .attr('style', function(i, style) {
                    return style ? style + ' padding: 0px !important;' : 'padding: 0px !important;';
                });
            this.element.val(this.value).trigger("change");
            this.element.on('select2:select', function (e) {
                let item = {
                    id: e.params.data.id,
                    text: e.params.data.text
                };
                callback(item)
            });
        },
        initSelect2(element, callback, config = {}) {
            this.element = $(element);
            $(element).select2(config);
            this._init(callback);
        },
        initSelect2Multiple(element, callback, config = {}) {
            this.element = $(element);
            $(element).select2(config);
            this._initMultiple(callback);
        },
        setValue(value) {
            this.element.val(value).trigger("change");
        },
        disabled() {
            this.element.prop("disabled", true).trigger("change");
        }
    })
});
