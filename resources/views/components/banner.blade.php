<script src="{{ asset('js/sweetalert2.js') }}"></script>

@if (isset($errors) && (count($errors) > 0))

    <script type="text/javascript">
        $(document).ready(function() {
            var errorDetails = "<p>{{ __('message.whoopsDetails') }}</p>";

            var errorList = document.createElement('ul');
            @foreach ($errors->all() as $error)
                errorList.innerHTML += '<li>{{ $error }}</li>';
            @endforeach

            errorDetails = errorDetails + errorList.innerHTML;


            console.log($('errorDetails').html());
            Swal.fire({
                icon: 'error',
                title: "{{ __('message.whoops') }}",
                html: errorDetails,
                showConfirmButton: true
            });
        });
    </script>
@endif

@if ($message = Session::get('success'))
    <script type="text/javascript">
        $(document).ready(function() {
            Swal.fire({
                icon: 'success',
                title: "{{ $message }}",
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
@endif

<script type="text/javascript">
    $(document).ready(function() {
        const swalBulmaButtons = Swal.mixin({
            customClass: {
                confirmButton: 'button is-danger is-outlined',
                cancelButton: 'button is-primary',
                actions: 'buttons',
            },
            buttonsStyling: false
        })

        $('.confirmDelete').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swalBulmaButtons.fire({
                    title: "{{ __('message.alertConfirmDeleteTitle') }}",
                    text: "{{ __('message.alertConfirmDeleteDesc') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: "{{ __('message.alertCancelDeleteButton') }}",
                    showConfirmButton: true,
                    confirmButtonText: "{{ __('message.alertConfirmDeleteButton') }}",
                    reverseButtons: true,
                    focusCancel: true
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        form.attr("method", "post");
                        form.append('<input name="_method" type="hidden" value="DELETE">');
                        form.submit();
                    }
                });
        });

        $('.confirmDelete').keypress(function(event) {
            if (event.which == 13) {
                event.preventDefault();
                $('#confirmDelete').click(event);
            }
        });
    });
</script>
