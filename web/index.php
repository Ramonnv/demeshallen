<?php get_header(); ?>

<main>

<?php if (get_field('hero_image')) : ?>

  <div class="page-hero-image-wrapper">
    <div class="hero-image" style="--imageURL: url('<?=wp_get_attachment_image_url(get_field('hero_image')); ?>')"></div>
  </div>

<?php endif; ?>

<?php the_content(); ?>

</main>

<?php get_footer(); ?>