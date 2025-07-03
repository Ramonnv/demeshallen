<?php get_header(); ?>

<main>
  
<?php if (get_field('404_hero_img', 'options')) : ?>

  <div class="page-hero-image-wrapper">
    <div class="hero-image" style="--imageURL: url('<?=wp_get_attachment_image_url(get_field('404_hero_img', 'options')); ?>')"></div>
  </div>

<?php endif; ?>

<div class="page-404-main">
  <div class="page-404-main-text">
    
  <h1><?= esc_html(get_field('title', 'options'));?></h1>
  <?php
    $btn_text = get_field('404_btn_title', 'options');
    $btn_link = get_field('404_btn_link', 'options');
    if ($btn_text !== '' && $btn_link !== '') {
      echo '<a class="btn-primary" href="'.$btn_link.'">'.$btn_text.'</a>';
    }
  ?>
  </div>
  <div class="page-404-main-image">
    
    <?=
    wp_get_attachment_image(get_field('404_image', 'options'), null, false, [ 
"class" => "",
"alt" => "" ]);

    ?>
  </div>
</div>

</main>

<?php get_footer(); ?>