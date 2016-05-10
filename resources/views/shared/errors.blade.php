@if (count($errors) > 0)
    <script>
        swal({
            title: "Oops",
            text: "{{ $errors->first() }}",
            type: "error",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif

