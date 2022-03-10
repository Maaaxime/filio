<script src="{{ asset('js/sweetalert2.js') }}"></script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
                title: "{{ __('message.alertConfirmDeleteTitle') }}",
                text: "{{ __('message.alertConfirmDeleteDesc') }}",
                icon: 'warning',
                showConfirmButton: true,
                confirmButtonText: "{{ __('message.alertOk') }}",
                showCancelButton: true,
                cancelButtonText: "{{ __('message.alertCancel') }}",
            })
            .then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
    });
</script>
