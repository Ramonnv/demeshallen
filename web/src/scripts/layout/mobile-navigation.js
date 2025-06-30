jQuery(document).ready(function($) {
    $('.mobile-navigation-toggle').click(() => {
        $('header .mobile-navigation').toggleClass('mobile-navigation-visible');
    })

    $('.mobile-navigation-main .menu-item-has-children').click(function(){
        $(this).toggleClass('opened');
    });

});