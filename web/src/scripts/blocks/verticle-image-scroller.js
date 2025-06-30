document.addEventListener('DOMContentLoaded', function () {
    var verticleImageSlider = new Swiper('.swiper-container.verticle_image_swiper', {
        loop: true,
        slidesPerView: 3,
        spaceBetween: 20,
        breakpoints: {
            0: {
                slidesPerView: 2.1,
                spaceBetween: 15,
            },
            786: {
                slidesPerView: 3,
            },
            1440: {
                spaceBetween: 20,
            }
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
    });
});
