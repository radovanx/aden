(function($) {
    "use strict";

    $(function() {
        $('#content .add-to-preference').on("click", function() {

            var data = {
                action: 'add_to_preference',
                flat_id: $(this).attr("data-flat_id")
            };

            $.post(estateprogram.ajaxurl, data, function(response) {
                console.log(response);
            }).fail(function() {
                //alert( "error" );
            }).always(function() {
                //alert( "finished" );
            });
        });
    });

}(jQuery));