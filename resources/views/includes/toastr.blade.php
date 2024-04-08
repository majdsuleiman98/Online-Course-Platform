<script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

<script>
    @if (Session::has('message_id'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message_id') }}", '', {
                    positionClass: 'toast-bottom-left',
                    className: 'success-toast',
                });

                break;

            case 'success':
                toastr.success("{{ Session::get('message_id') }}", '', {
                    positionClass: 'toast-bottom-left',
                    className: 'success-toast',
                });
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message_id') }}", '', {
                    positionClass: 'toast-bottom-left',
                    className: 'success-toast',
                });
                break;

            case 'error':
                toastr.error("{{ Session::get('message_id') }}", '', {
                    positionClass: 'toast-bottom-left',
                    className: 'success-toast',
                });
                break;
        }
    @endif
</script>
<style>
    #toast-container>div {
        background-color: green !important;
    }
</style>
