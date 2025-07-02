jQuery(document).ready(function($) {
    const min = 0;
    const max = 60;
    const randomX = Math.floor(Math.random() * (max - min + 1)) + min;
    const randomY = Math.floor(Math.random() * (max - min + 1)) + min;

    $('body').css('background-position', `${randomX}% ${randomY}%`);
});