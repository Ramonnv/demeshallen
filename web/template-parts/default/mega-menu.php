<?php

  $mega_menu_id = $args['id']; // Retrieve ID

?>

<li class="has-megamenu"><a href="#"><?php esc_html_e(get_field('menu-item_title', $mega_menu_id))?></a>

  <div class="menu__mega">
    <div class="menu__mega-wrap">
      <div class="container">
        <div class="row">

              <?php if ( get_field( 'sub_items', $mega_menu_id ) ) { ?>

                <div class="col-xl-4 col-lg-5 offset-xl-1">
                  <ul class="menu__mega-sub">

                    <?php foreach ( get_field( 'sub_items', $mega_menu_id ) as $sub_item ) { ?>

                      <li><a href="<?php echo get_permalink( $sub_item->ID  ); ?>"><?php echo esc_html( $sub_item->post_title ); ?></a></li>

                    <?php } // End while ?>

                  </ul>
                </div>

              <?php } // End if ?>

        </div>
      </div>
    </div>
  </div>

</li>