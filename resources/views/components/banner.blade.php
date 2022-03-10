<script src="{{ asset('js/sweetalert2.js') }}"></script>

@if (count($errors) > 0)
    <script type="text/javascript">
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
        })
    </script>
@endif

@if ($message = Session::get('success'))
    <script type="text/javascript">
        Swal.fire({
            icon: 'success',
            title: "{{ $message }}",
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif
