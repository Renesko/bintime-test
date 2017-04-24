<script type="text/javascript" src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>

<script>
    var Laravel = {
        csrfToken: "{{ csrf_token() }}"
    };
</script>