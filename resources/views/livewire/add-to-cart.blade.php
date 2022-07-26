<div>


    @push('scripts')
        <script>
            function add_to_cart() {
                const color = jQuery('#color_id').val();
                const size = jQuery('#size_id').val();
                if (!color) {
                    swal("Ooops", "Please Select Color!", "error");
                }
                else if (!size) {

                    swal("Ooops", "Please Select Size!", "error");
                }
                else {

                }
            }
        </script>
    @endpush
</div>
