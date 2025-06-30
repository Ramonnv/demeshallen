<?php
/*
*  Name: Example block
*  Title: Example block
*  Description: This is an example block
*  Category: fairbase-blocks
*  Icon: fairbase-block
*  Keywords: Example, demonstration
*  Post Types: page
*/

// Set name of the block for class and ID generation
$name = 'example';

// Get id and classlist
$id    = fairbase_block_id( $name, $block, false );
$class = fairbase_block_classes( $name, $block, false );

// Preview image on back-end
if (isset($block['data']['preview_image'])) {
    echo '<style>p, a, svg, h1, h2, h3, h4, h5, h6, input, textarea, br, hr, span, button, ul, ol, li, table, tr, td, th, form, label {opacity:0;}</style>
    <img src="' . $block['data']['preview_image'] . '" alt="" style="width: 100%; height: auto;" >';
}

// Get ACF fiels
$example_description = get_field('example_desc');
?>

<section id="<?= $id; ?>" class="<?= $class; ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?= $example_description; ?>
            </div>
        </div>
    </div>
</section>