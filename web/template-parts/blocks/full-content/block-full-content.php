<?php
/*
*  Name: Full content
*  Title: Full content
*  Description: Full content
*  Category: fairbase-blocks
*  Icon: fairbase-block
*  Keywords: Full, content, WYSIWYG, What You See Is What You Get
*  Post Types: page
*/


// Set name of the block for class and ID generation
$name = 'full-content';


// Get id and classlist
$id    = fairbase_block_id( $name, $block, false );
$class = fairbase_block_classes( $name, $block, false );

// Preview image on back-end
if (isset($block['data']['preview_image'])) {
    echo '<style>p, a, svg, h1, h2, h3, h4, h5, h6, input, textarea, br, hr, span, button, ul, ol, li, table, tr, td, th, form, label {opacity:0;}</style>
    <img src="' . $block['data']['preview_image'] . '" alt="" style="width: 100%; height: auto;" >';
}

// Add additional classes to the section
$class = esc_html(get_field('extra_class'));

switch (get_field('size')) {
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

?>

<section id="<?php echo $id; ?>" class="<?php echo $class; ?>">
    <div class="container">
        <div class="row">
            <div class="col-12 <?= $parentContainerClass; ?>">
                <div class="compontent-wysiwyg">
                    <?= wp_kses_post(get_field('content')); ?>
                </div>
            </div>
        </div>
    </div>
</section>

