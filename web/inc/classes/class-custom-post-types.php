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


    $labels = array(
      'name'                     => _x('Nieuws', 'Post type general name', TEXTDOMAIN),
      'singular_name'            => _x('Nieuws', 'Post type singular name', TEXTDOMAIN),
      'menu_name'                => _x('Nieuws', 'Admin Menu text', TEXTDOMAIN),
      'name_admin_bar'           => _x('Nieuws', 'Add New on Toolbar', TEXTDOMAIN),
      'add_new'                  => __('Nieuw bericht', TEXTDOMAIN),
      'add_new_item'             => __('Nieuw nieuwsbericht', TEXTDOMAIN),
      'new_item'                 => __('Nieuw nieuwsbericht', TEXTDOMAIN),
      'edit_item'                => __('Bewerk nieuwsbericht', TEXTDOMAIN),
      'view_item'                => __('Bekijk nieuwsbericht', TEXTDOMAIN),
      'all_items'                => __('Alle nieuwsberichten', TEXTDOMAIN),
      'search_items'             => __('Zoek nieuwsberichten', TEXTDOMAIN),
      'parent_item_colon'        => __('Hoofd nieuwsberichten:', TEXTDOMAIN),
      'not_found'                => __('Geen nieuwsbericht gevonden.', TEXTDOMAIN),
      'not_found_in_trash'       => __('Geen nieuwsbericht in de prullenbak gevonden.', TEXTDOMAIN),
      'featured_image'           => _x('Nieuwsbericht hoofdafbeelding', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', TEXTDOMAIN),
      'set_featured_image'       => _x('Kies hoofdafbeelding', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', TEXTDOMAIN),
      'remove_featured_image'    => _x('Verwijder hoofdafbeelding', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', TEXTDOMAIN),
      'use_featured_image'       => _x('Gebruik als hoofdafbeelding', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', TEXTDOMAIN),
      'archives'                 => _x('Nieuwsarchieven', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', TEXTDOMAIN),
      'insert_into_item'         => _x('Voeg toe aan nieuwsbericht', 'Overrides the “Insert into post”/”Insert into page” phrase. Added in 4.4', TEXTDOMAIN),
      'uploaded_to_this_item'    => _x('Geüpload naar dit nieuwsbericht', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase. Added in 4.4', TEXTDOMAIN),
      'filter_items_list'        => _x('Filter nieuwsberichten', 'Screen reader text for filter links heading. Added in 4.4', TEXTDOMAIN),
      'items_list_navigation'    => _x('Nieuwsberichten navigatie', 'Screen reader text for pagination. Added in 4.4', TEXTDOMAIN),
      'items_list'               => _x('Overzicht nieuwsberichten', 'Screen reader text for the items list. Added in 4.4', TEXTDOMAIN),
    );

    $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_rest' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'nieuws'),
      'capability_type' => 'post',
      'has_archive' => true,
      'hierarchical' => false,
      'menu_position' => null,
      'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
      'menu_icon' => 'dashicons-megaphone',
    );

    register_post_type('news', $args);

    $labels = array(
      'name'                     => _x('Bedrijven', 'Post type general name', TEXTDOMAIN),
      'singular_name'            => _x('Bedrijf', 'Post type singular name', TEXTDOMAIN),
      'menu_name'                => _x('Bedrijven', 'Admin Menu text', TEXTDOMAIN),
      'name_admin_bar'           => _x('Bedrijf', 'Add New on Toolbar', TEXTDOMAIN),
      'add_new'                  => __('Nieuw Bedrijf', TEXTDOMAIN),
      'add_new_item'             => __('Nieuw Bedrijf', TEXTDOMAIN),
      'new_item'                 => __('Nieuw Bedrijf', TEXTDOMAIN),
      'edit_item'                => __('Bewerk Bedrijf', TEXTDOMAIN),
      'view_item'                => __('Bekijk Bedrijf', TEXTDOMAIN),
      'all_items'                => __('Alle Bedrijven', TEXTDOMAIN),
      'search_items'             => __('Zoek Bedrijf', TEXTDOMAIN),
      'parent_item_colon'        => __('Hoofd Bedrijf:', TEXTDOMAIN),
      'not_found'                => __('Geen Bedrijven gevonden.', TEXTDOMAIN),
      'not_found_in_trash'       => __('Geen Bedrijven in de prullenbak gevonden.', TEXTDOMAIN),
      'featured_image'           => _x('Bedrijf hoofdafbeelding', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', TEXTDOMAIN),
      'set_featured_image'       => _x('Kies hoofdafbeelding', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', TEXTDOMAIN),
      'remove_featured_image'    => _x('Verwijder hoofdafbeelding', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', TEXTDOMAIN),
      'use_featured_image'       => _x('Gebruik als hoofdafbeelding', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', TEXTDOMAIN),
      'archives'                 => _x('Bedrijfsarchieven', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', TEXTDOMAIN),
      'insert_into_item'         => _x('Voeg toe aan Bedrijf', 'Overrides the “Insert into post”/”Insert into page” phrase. Added in 4.4', TEXTDOMAIN),
      'uploaded_to_this_item'    => _x('Geüpload naar dit Bedrijf', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase. Added in 4.4', TEXTDOMAIN),
      'filter_items_list'        => _x('Filter Bedrijven', 'Screen reader text for filter links heading. Added in 4.4', TEXTDOMAIN),
      'items_list_navigation'    => _x('Bedrijven navigatie', 'Screen reader text for pagination. Added in 4.4', TEXTDOMAIN),
      'items_list'               => _x('Bedrijven overzicht', 'Screen reader text for the items list. Added in 4.4', TEXTDOMAIN),
    );

    $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_rest' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'bedrijf'),
      'capability_type' => 'page',
      'has_archive' => true,
      'hierarchical' => false,
      'menu_position' => null,
      'supports' => array('title'),
      'menu_icon' => 'dashicons-building',
    );

    register_post_type('bedrijven', $args);

    $labels = array(
      'name'                     => _x('Vergaderruimtes', 'Post type general name', TEXTDOMAIN),
      'singular_name'            => _x('Vergaderruimte', 'Post type singular name', TEXTDOMAIN),
      'menu_name'                => _x('Vergaderruimtes', 'Admin Menu text', TEXTDOMAIN),
      'name_admin_bar'           => _x('Vergaderruimte', 'Add New on Toolbar', TEXTDOMAIN),
      'add_new'                  => __('Nieuwe Vergaderruimte', TEXTDOMAIN),
      'add_new_item'             => __('Nieuwe Vergaderruimte', TEXTDOMAIN),
      'new_item'                 => __('Nieuwe Vergaderruimte', TEXTDOMAIN),
      'edit_item'                => __('Bewerk Vergaderruimte', TEXTDOMAIN),
      'view_item'                => __('Bekijk Vergaderruimte', TEXTDOMAIN),
      'all_items'                => __('Alle Vergaderruimtes', TEXTDOMAIN),
      'search_items'             => __('Zoek Vergaderruimte', TEXTDOMAIN),
      'parent_item_colon'        => __('Hoofd Vergaderruimte:', TEXTDOMAIN),
      'not_found'                => __('Geen Vergaderruimtes gevonden.', TEXTDOMAIN),
      'not_found_in_trash'       => __('Geen Vergaderruimtes in de prullenbak gevonden.', TEXTDOMAIN),
      'featured_image'           => _x('Vergaderruimte hoofdafbeelding', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', TEXTDOMAIN),
      'set_featured_image'       => _x('Kies hoofdafbeelding', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', TEXTDOMAIN),
      'remove_featured_image'    => _x('Verwijder hoofdafbeelding', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', TEXTDOMAIN),
      'use_featured_image'       => _x('Gebruik als hoofdafbeelding', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', TEXTDOMAIN),
      'archives'                 => _x('Vergaderruimte archieven', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', TEXTDOMAIN),
      'insert_into_item'         => _x('Voeg toe aan Vergaderruimte', 'Overrides the “Insert into post”/”Insert into page” phrase. Added in 4.4', TEXTDOMAIN),
      'uploaded_to_this_item'    => _x('Geüpload naar deze Vergaderruimte', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase. Added in 4.4', TEXTDOMAIN),
      'filter_items_list'        => _x('Filter Vergaderruimtes', 'Screen reader text for filter links heading. Added in 4.4', TEXTDOMAIN),
      'items_list_navigation'    => _x('Vergaderruimtes navigatie', 'Screen reader text for pagination. Added in 4.4', TEXTDOMAIN),
      'items_list'               => _x('Vergaderruimtes overzicht', 'Screen reader text for the items list. Added in 4.4', TEXTDOMAIN),
    );

    $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_rest' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'vergaderruimte'),
      'capability_type' => 'page',
      'has_archive' => true,
      'hierarchical' => false,
      'menu_position' => null,
      'supports' => array('title'),
      'menu_icon' => 'dashicons-welcome-view-site',
    );

    register_post_type('vergaderruimtes', $args);



  }

  public function rewrite_flush() {

    $this->register_post_type();
    flush_rewrite_rules();

  }

}
