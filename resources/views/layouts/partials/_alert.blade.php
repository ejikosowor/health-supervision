<script>
    @if(Session::has('status'))
        $.notify({
            icon: 'ti-check',
            message: "{{ Session::get('status') }}"

        },{
            type: 'success',
            timer: 4000
        });
    @endif

    @if(Session::has('error'))
        $.notify({
            icon: 'ti-close',
            message: "{{ Session::get('error') }}"

        },{
            type: 'danger',
            timer: 4000
        });
    @endif
</script>