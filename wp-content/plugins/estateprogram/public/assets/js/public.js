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
                    element.removeClass('fa-star-o blue').addClass('fa-star red');
                } else {
                    element.removeClass('fa-star red').addClass('fa-star-o blue');
                }
            }).fail(function() {
                //alert( "error" );
            }).always(function() {
                //alert( "finished" );
            });
        });
    });

}(jQuery));