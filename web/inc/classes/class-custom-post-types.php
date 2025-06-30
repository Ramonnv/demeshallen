<?php
/*
 * Class registers the neccesary custom post types
 *
 * @package FairBase Starter
 * @since 1.0.0
 */

namespace FAIRBASE_STARTER\Inc;

use FAIRBASE_STARTER\Inc\Traits\Singleton;

class Custom_Post_Types {

  use Singleton;

  protected function __construct() {

    $this->create_post_types();

  }

  protected function create_post_types() {

    add_action( 'init', array( $this, 'register_post_type' ) );
    add_action( 'after_switch_theme', array( $this, 'rewrite_flush' ) );

  }

  public function register_post_type(){

  }

  public function rewrite_flush() {

    $this->register_post_type();
    flush_rewrite_rules();

  }

}
