<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/jquery.snippet.min.js"></script>
<script src="/assets/js/toolkit.js"></script>
<script src="/assets/js/application.js"></script>
<script src="/assets/js/jquery.jscroll.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>

    $(function()
    {
        $( "#search" ).autocomplete({
            source: "{{ url('search/autocomplete') }}",
            minLength: 3,
            select: function(event, ui) {
                var id = ui.item.id;
                if(window.location.pathname == '/dashboard')
                window.location.href = "dashboard/" + id;
                else
                window.location.href = id;
            }
        });
        $( "#formsearch" ).submit(function( event ) {
            $('#searchInfo').fadeIn('slow').delay(1000).fadeOut('slow');
            event.preventDefault();
        });

    });
</script>
