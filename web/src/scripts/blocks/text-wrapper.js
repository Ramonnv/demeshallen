jQuery(document).ready(function ($) {

    function imgURL() {
        return 'https://images.unsplash.com/photo-1753298999092-0df8a80bfe34?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D';
    }

    function handleResult(x) {
        const wrapper = $('#meetingroom-popup-wrapper');

        let listHTML = '';
        let swiperChildren = '';

        if (Array.isArray(x['benefits_space'])) {
            x['benefits_space'].forEach(function (item) {
                listHTML += `<li>${item.benefit}</li>`;
            });
        }


        if (Array.isArray(x['images'])) {
            x['images'].forEach(function (item) {
                swiperChildren += `<div class="swiper-slide"><img src="${item}" alt=""></div>`;
            });
        }

        const returningHTML = `
        <div class="meetingroom-popup-content">
            <div class="popup-title">
                <h2>${x['title']}</h2>
            </div>
            <div class="close-popup-wrapper">
                <div class="close-popup">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <path d="M32.1343 30.3658C32.2505 30.482 32.3426 30.6198 32.4055 30.7716C32.4683 30.9233 32.5007 31.086 32.5007 31.2502C32.5007 31.4145 32.4683 31.5771 32.4055 31.7288C32.3426 31.8806 32.2505 32.0184 32.1343 32.1346C32.0182 32.2507 31.8803 32.3428 31.7286 32.4057C31.5768 32.4686 31.4142 32.5009 31.25 32.5009C31.0857 32.5009 30.9231 32.4686 30.7713 32.4057C30.6196 32.3428 30.4817 32.2507 30.3656 32.1346L20 21.7674L9.63434 32.1346C9.39979 32.3691 9.08167 32.5009 8.74996 32.5009C8.41826 32.5009 8.10014 32.3691 7.86559 32.1346C7.63104 31.9 7.49927 31.5819 7.49927 31.2502C7.49927 30.9185 7.63104 30.6004 7.86559 30.3658L18.2328 20.0002L7.86559 9.63458C7.63104 9.40003 7.49927 9.08191 7.49927 8.75021C7.49927 8.4185 7.63104 8.10038 7.86559 7.86583C8.10014 7.63128 8.41826 7.49951 8.74996 7.49951C9.08167 7.49951 9.39979 7.63128 9.63434 7.86583L20 18.233L30.3656 7.86583C30.6001 7.63128 30.9183 7.49951 31.25 7.49951C31.5817 7.49951 31.8998 7.63128 32.1343 7.86583C32.3689 8.10038 32.5007 8.4185 32.5007 8.75021C32.5007 9.08191 32.3689 9.40003 32.1343 9.63458L21.7672 20.0002L32.1343 30.3658Z" fill="#DB6221"/>
                    </svg>
                </div>
            </div>

            

            <!-- Swiper -->
            <div class="meetingroom-swiper-wrapper">
<div class="swiper meetingroomSwiper">
  <div class="swiper-wrapper">
    ${swiperChildren}
    <!-- Add more slides as needed -->
  </div>
  
  <!-- Navigation arrows -->
    <div class="swiper-navigation-buttons">
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
  </div>
  </div>












            <div class="meetingroom-short-info">
                <div class="meetingroom-short-info-title-wrapper">
                    <h3>${x['title']}</h3>
                </div>
                <p>De ruimte is voorzien van alle volgende gemakken:</p>
                <ul class="meetingroom-point-list">
                    ${listHTML}
                </ul>
            </div>
        </div>
        `;

        wrapper.html(returningHTML);
    }

    $('.meetingroom-wrapper').click(function () {
        $.ajax({
            type: 'POST',
            url: ajaxURL,
            data: {
                action: 'get_meetingroom_info',
                post_id: $(this).data('postid')
            },
            success: function (response) {
                handleResult(response.data.data);
                $('#meetingroom-popup-wrapper').show();
                setupElementEvents();
            }
        });
    });

    function setupElementEvents() {
        $('.close-popup').off('click').on('click', function () {
            $('#meetingroom-popup-wrapper').hide();
        });


        var swiper = new Swiper(".meetingroomSwiper", {
            slidesPerView: "auto",
            centeredSlides: true,
            spaceBetween: 30,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            loop: true
        });
    }

});
