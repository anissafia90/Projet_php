$( document ).ready(function() {
    $( "#autocomplete" ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: "src/item/ajax.php",
                type: 'post',
                dataType: "json",
                data: {
                    title: request.term
                },
                success: function( data ) {
                    response( data );
                }
            });
        },
        select: function (event, ui) {
            $('#autocomplete').val(ui.item.label);
            return false;
        }
    });
});