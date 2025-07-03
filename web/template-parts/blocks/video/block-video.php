<?php
/*
*  Name: Video block
*  Title: Video block
*  Description: This is an video block
*  Category: fairbase-blocks
*  Icon: fairbase-block
*  Keywords: Video, url
*  Post Types: page
*/

// Set name of the block for class and ID generation
$name = 'video';

// Get id and classlist
$id    = fairbase_block_id( $name, $block, false );
$class = fairbase_block_classes( $name, $block, false );

// Preview image on back-end
if (isset($block['data']['preview_image'])) {
    echo '<style>p, a, svg, h1, h2, h3, h4, h5, h6, input, textarea, br, hr, span, button, ul, ol, li, table, tr, td, th, form, label {opacity:0;}</style>
    <img src="' . $block['data']['preview_image'] . '" alt="" style="width: 100%; height: auto;" >';
}

// Get ACF fiels
$title = get_field('title');
$video = get_field('add_video');

// Put custom functions here
if (!function_exists('getVideoID')) {
function getVideoID($u){
      return preg_match('/(?:youtu\.be\/|[?&]v=|\/v\/|embed\/)([A-Za-z0-9_-]{11})/',$u,$m)?$m[1]:false;
    }
}

?>
<section id="<?= $id; ?>" class="<?= $class; ?>">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-9">
                <div class="video-wrapper">
                    <div class="video-wrapper-title-wrapper">
                        <h2><?= esc_html($title); ?></h2>
                    </div>
                    <div class="video-wrapper-description">
                    <iframe src="https://www.youtube.com/embed/<?= getVideoID(esc_url($video));?>" frameborder="0" title="Youtube video"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>