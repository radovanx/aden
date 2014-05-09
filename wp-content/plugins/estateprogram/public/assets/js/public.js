(function($) {
    "use strict";

    $(function() {
        $('.add-to-preference').on("click", function() {

            var element = $(this).find('i');

            var data = {
                action: 'add_to_preference',
                flat_id: $(this).attr("data-flat_id")
            };

            $.post(estateprogram.ajaxurl, data, function(response) {
                if(1 == response){
                    element.removeClass('blue').addClass('red');
                } else {
                    element.removeClass('red').addClass('blue');
                }
            }).fail(function() {
                //alert( "error" );
            }).always(function() {
                //alert( "finished" );
            });
        });
    });

}(jQuery));