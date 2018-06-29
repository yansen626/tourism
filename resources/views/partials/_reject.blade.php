<script>
    $('.modal-footer').on('click', '.reject', function() {
        $.ajax({
            type: 'POST',
            url: '{{ route($routeUrl) }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'id': $('#rejected-id').val()
            },
            success: function(data) {
                if ((data.errors)){
                    setTimeout(function () {
                        toastr.error('Gagal mereject!!' + data.errors, 'Peringatan', {timeOut: 6000, positionClass: "toast-top-center"});
                    }, 500);
                }
                else{
                    window.location = '{{ route($redirectUrl) }}';
                }
            }
        });
    });
</script>