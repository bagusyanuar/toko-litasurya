<x-gxui.modal.form></x-gxui.modal.form>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('categoryFormStore', {
                modalFormShow: false,
                setOpenModalForm() {
                    this.modalFormShow = true;
                },
                setCloseModalForm() {
                    this.modalFormShow = false;
                }
            })
        });
    </script>
@endpush
