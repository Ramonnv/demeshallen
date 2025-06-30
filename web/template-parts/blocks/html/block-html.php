<?php
/*
*  Name: HTML block
*  Title: HTML block
*  Description: Custom HTML
*  Category: fairbase-blocks
*  Icon: fairbase-block
*  Keywords: Header, mapper, localize, vissible
*  Post Types: page
*/

// Set name of the block for class and ID generation
$name = 'html';

// Get id and classlist
$id    = fairbase_block_id( $name, $block, false );
$class = fairbase_block_classes( $name, $block, false );

// Preview image on back-end
if (isset($block['data']['preview_image'])) {
    echo '<style>p, a, svg, h1, h2, h3, h4, h5, h6, input, textarea, br, hr, span, button, ul, ol, li, table, tr, td, th, form, label {opacity:0;}</style>
    <img src="' . $block['data']['preview_image'] . '" alt="" style="width: 100%; height: auto;" >';
}

// Add additional classes to the section
$class .= ' section-block ';
?>

<section class="<?= $class; ?>">
    <?= get_field('html') ?>
</section>