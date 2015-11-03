jQuery(document).ready(function($) {

    $('.header_menu li').hover(
        function () {
            $('ul:first', this).css('display','block');
        }, 
        function () {
            $('ul:first', this).css('display','none');         
        }
    );  

    $('#main_header_menu').slicknav();

})