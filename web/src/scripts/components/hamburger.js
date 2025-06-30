jQuery(document).ready(function($) {
    
    if ($('.fairbase-hamburger').length > 0) {
        $('.fairbase-hamburger').click(function(){
            $(this).toggleClass('open-hamburger');
        })
    }
});