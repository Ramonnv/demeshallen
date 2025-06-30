<?php
/*
*  Name: Greeting block
*  Title: Greeting block
*  Description: This is an greeting block
*  Category: fairbase-blocks
*  Icon: fairbase-block
*  Keywords: Example, demonstration
*  Post Types: page
*/

// Set name of the block for class and ID generation
$name = 'greeting';

// Get id and classlist
$id    = fairbase_block_id( $name, $block, false );
$class = fairbase_block_classes( $name, $block, false );

// Preview image on back-end
if (isset($block['data']['preview_image'])) {
    echo '<style>p, a, svg, h1, h2, h3, h4, h5, h6, input, textarea, br, hr, span, button, ul, ol, li, table, tr, td, th, form, label {opacity:0;}</style>
    <img src="' . $block['data']['preview_image'] . '" alt="" style="width: 100%; height: auto;" >';
}

// Get ACF fields

$firstName = get_field('firstname');
$lastName = get_field('lastname');

?>

<section class="greeting">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="greeting-title">Hallo, <?= esc_html($firstName); ?> <?= esc_html($lastName); ?></h2>
                <p>
                    <?= wp_kses_post(get_field('desc')); ?>
                </p>
                <div class="greeting-btn-container">

                    <?php 
                
                foreach (get_field('button_wrapper') as $btn) {
                    echo '<a class="btn-outline" href="' . $btn['btn_link'] . '">' . $btn['btn_text'] . '</a>';
                }
                
                
                ?>
                </div>
                
            </div>
        </div>
    </div>
</section>