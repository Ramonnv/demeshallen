<?php
/*
*  Name: Hexgrid Swiper block
*  Title: Hexgrid Swiper block
*  Description: This is an hexgrid swiper block
*  Category: fairbase-blocks
*  Icon: fairbase-block
*  Keywords: swiper, demonstration, images
*  Post Types: page
*/

// Set name of the block for class and ID generation
$name = 'hex-swiper';

// Get id and classlist
$id    = fairbase_block_id( $name, $block, false );
$class = fairbase_block_classes( $name, $block, false );

// Preview image on back-end
if (isset($block['data']['preview_image'])) {
    echo '<style>p, a, svg, h1, h2, h3, h4, h5, h6, input, textarea, br, hr, span, button, ul, ol, li, table, tr, td, th, form, label {opacity:0;}</style>
    <img src="' . $block['data']['preview_image'] . '" alt="" style="width: 100%; height: auto;" >';
}

// Get ACF repeater or gallery field
$swiper_items = get_field('hexagon_swiper');
$minimalBoxes = 6;

if (count($swiper_items) < $minimalBoxes) {
  $stillNeeded = $minimalBoxes - count($swiper_items);
  for ($i=0; $i<$stillNeeded;$i++) {
    $swiper_items[]['hexagon_image'] = '';
  }
}

?>

<section id="<?= $id; ?>" class="<?= $class; ?>">
  <div class="swiper hexagon-swiper">
    <div class="swiper-wrapper">
      <?php if ($swiper_items): ?>
        <?php foreach ($swiper_items as $item): ?>
          <div class="swiper-slide">
            <div class="hexagon-swiper-slide">
              <div class="mixin">
                <?php
                
                if( $item['hexagon_image'] ) {
                  echo wp_get_attachment_image($item['hexagon_image'], 'hexagon-swiper-image');
                }

                ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>
