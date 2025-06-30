<?php
/**
 * Insert Google Tag Manager scripts in head and body using ACF option field.
 */

function add_gtm_head() {

    $gtm_id = get_field('google_tag_manager_id', 'option');

    if (!empty($gtm_id)) {
        ?>
        <!-- Google Tag Manager -->
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;
            j.src='https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','<?php echo esc_js($gtm_id); ?>');
        </script>
        <!-- End Google Tag Manager -->
        <?php
    }
}

function add_gtm_body() {
    $gtm_id = get_field('google_tag_manager_id', 'option');
    
    if (!empty($gtm_id)) {
        ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr($gtm_id); ?>"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
            </noscript>
            <!-- End Google Tag Manager (noscript) -->
            <?php
    }
}


add_action('wp_head', 'add_gtm_head', 10);
add_action('wp_body_open', 'add_gtm_body', 10);
