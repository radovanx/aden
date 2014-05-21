(function($) {
    "use strict";

    $(function() {
        $('.add-to-preference').live("click", function() {

            var element = $(this).find('i');
            
            var this_element = $(this);

            var data = {
                action: 'add_to_preference',
                flat_id: $(this).attr("data-flat_id")
            };

            var confirm_remove = $('.apartment-list').hasClass("confirm-remove");
            var remove_row = $('.apartment-list').hasClass("remove-favorite-row");

            if (confirm_remove) {
                $('#removePreferenceModal').modal({backdrop: 'static', keyboard: false}).one('click', '#delete', function() {
                    $.post(estateprogram.ajaxurl, data, function(response) {
                        if (1 == response) {
                            element.removeClass('fa-star-o blue').addClass('fa-star red');
                        } else {
                            if (remove_row) {
                                console.log('remove');
                                this_element.closest('.apartment-row').remove();
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
                        this_element.find('.fav-label').html(estateprogram.added);
                    } else {
                        if (remove_row) {
                            console.log('removing..');
                            //element.closest('tr').remove();
                            element.closest('.apartment-row').remove();
                        } else {
                            element.removeClass('fa-star red').addClass('fa-star-o blue');
                            this_element.find('.fav-label').html(estateprogram.removed);
                        }
                    }
                }).fail(function() {
                    //alert( "error" );
                })
            }
        });
    });

}(jQuery));


