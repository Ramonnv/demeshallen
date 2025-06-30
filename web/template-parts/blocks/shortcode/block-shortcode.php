<?php
/*
*  Name: Shortcode
*  Title: Shortcode
*  Description: Shortcode inladen
*  Category: fairbase-blocks
*  Icon: fairbase-block
*  Keywords: Berichten, posts, container
*  Post Types: page
*/

// Set name of the block for class and ID generation
$name = 'shortcode_loader';

// Get id and classlist
$id    = fairbase_block_id( $name, $block, false );
$class = fairbase_block_classes( $name, $block, false );

// Preview image on back-end
if (isset($block['data']['preview_image'])) {
    echo '<style>p, a, svg, h1, h2, h3, h4, h5, h6, input, textarea, br, hr, span, button, ul, ol, li, table, tr, td, th, form, label {opacity:0;}</style>
    <img src="' . $block['data']['preview_image'] . '" alt="" style="width: 100%; height: auto;" >';
}

switch (get_field('offset_settings')) {
    case 'full-width':
        $parentContainerClass = '';
    break;
    case 'middle':
        $parentContainerClass = ' col-md-10 offset-md-1';
    break;
    case 'smallest':
        $parentContainerClass = ' col-md-10 offset-md-1 col-lg-8 offset-lg-2';
    break;
}

$shortcode = str_contains(get_field('shortcode'), '[') ? get_field('shortcode') : '[' . get_field('shortcode') . ']';  

?>


<section class="custom-shortcode-block">
    <div class="container">
        <div class="row">
            <div class="<?= $parentContainerClass; ?>">
                <div class="<?= esc_html(get_field('extra_class')); ?>">
                    <?= do_shortcode($shortcode); ?>
                </div>
            </div>
        </div>
    </div>
</section>