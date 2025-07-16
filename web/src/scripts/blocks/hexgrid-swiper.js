jQuery(document).ready(function ($) {
 new Swiper('.hexagon-swiper', {
  slidesPerView: 2.3,
  spaceBetween: -100,
  allowTouchMove: true,
  grabCursor: true,
  freeMode: true,
  slidesOffsetBefore: 25,
  slidesOffsetAfter: 25,
  breakpoints: {
   992: {
    slidesPerView: 4.5,
   },

   768: {
    slidesPerView: 2.5,
   },
  },
 });
});
