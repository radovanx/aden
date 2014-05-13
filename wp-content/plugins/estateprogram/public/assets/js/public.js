(function($) {
    "use strict";

    $(function() {
        $('.add-to-preference').on("click", function() {

            var element = $(this).find('i');

            var data = {
                action: 'add_to_preference',
                flat_id: $(this).attr("data-flat_id")
            };

            var confirm_remove = $(this).hasClass("confirm-remove");
            var remove_row = $(this).hasClass("remove-row");

            if (confirm_remove) {
                $('#removePreferenceModal').modal({backdrop: 'static', keyboard: false}).one('click', '#delete', function() {
                    $.post(estateprogram.ajaxurl, data, function(response) {
                        if (1 == response) {
                            element.removeClass('fa-star-o blue').addClass('fa-star red');
                        } else {
                            if (remove_row) {
                                element.closest('tr').remove();
                            } else {
                                element.removeClass('fa-star red').addClass('fa-star-o blue');
                            }
                        }
                    }).fail(function() {
                        //alert( "error" );
                    })
                });
            } else {
                $.post(estateprogram.ajaxurl, data, function(response) {
                    if (1 == response) {
                        element.removeClass('fa-star-o blue').addClass('fa-star red');
                    } else {
                        if (remove_row) {
                            element.closest('tr').remove();
                        } else {
                            element.removeClass('fa-star red').addClass('fa-star-o blue');
                        }
                    }
                }).fail(function() {
                    //alert( "error" );
                })
            }
        });
    });

}(jQuery));


