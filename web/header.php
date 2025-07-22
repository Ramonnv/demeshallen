<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo get_the_title(); ?> | <?php bloginfo('name'); ?></title>
  
  <?php if ( $favicon = get_field('favicon', 'option') ) : ?>

    <link rel="icon" type="image/x-icon" href="<?= $favicon; ?>">

  <?php endif; ?>

  <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header class="header">
  <div class="container">
    <div class="row">
      <div class="col-4">
        <a class="header-logo-container" href="<?= get_home_url(); ?>">

          <?= wp_get_attachment_image(get_field('nav_image', 'option'), 'navigation-image', false, [ 
            "class" => "header-logo-container-image",
            "alt" => "" ]); 
          ?>
        </a>
    </div>
    <div class="col-8">
      <div class="main-navigation">
        <?php
          wp_nav_menu( array(
              'theme_location'  => 'main_menu',
              'menu_class'      => 'main-menu',
              'container'       => 'nav',
              'container_class' => 'main-nav',
          ) );
        ?>
      </div>
      <div class="mobile-navigation-toggler">
        <div class="mobile-navigation-toggle">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"/>
          </svg>
        </div>
      </div>
    </div>
    </div>
  </div>
  <div class="mobile-navigation">
    <div class="mobile-navigation-header">
      <div class="mobile-navigation-toggle">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
          <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
      </svg>
      </div>
    </div>
    <div class="mobile-navigation-main">
      <h2>Mobiele navigatie</h2>
        <?php
          wp_nav_menu( array(
              'theme_location'  => 'mobile_menu',
              'menu_class'      => 'mobile-menu',
              'container'       => 'nav',
              'container_class' => 'mobile-menu',
          ) );
        ?>
    </div>
  </div>
</header>
