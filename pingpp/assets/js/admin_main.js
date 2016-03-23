(function ($) {
    'use strict';

    $(function () {
        function get_hash() {
            if(window.location.hash) {
                return window.location.hash.substring(1);
            } else {
                return 'pingpp-keys';
            }
        }

        $('#' + get_hash() + '-settings-tab').addClass('tab-content').show();

        $('.nav-tab-wrapper').children( '.nav-tab' ).each( function(index) {
            if($(this).data('tab-id') == get_hash() ) {
                $(this).addClass('nav-tab-active');
            }
        });

        $('.ppp-nav-tab').click( function() {
            var tab_id = $(this).data('tab-id');

            $('.tab-content').hide().removeClass('tab-content');
            $('#' + tab_id + '-settings-tab').addClass('tab-content').show();
        });

        $('.nav-tab').click( function() {
            $(this).parent().children( '.nav-tab' ).each( function(index) {
                $(this).removeClass('nav-tab-active');
            });

            $(this).addClass('nav-tab-active');
        });

        $('#sc-settings-content form #submit').on('click', function() {
            //event.preventDefault();
            $(this).closest('form').attr('action', 'options.php#' + get_hash() );
            //$(this).closest('form').submit();
        });



        console.log('admin_main.js loaded');
    });
}(jQuery));
