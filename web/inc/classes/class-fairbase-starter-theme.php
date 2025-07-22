<?php
/*
 * This class bootstraps the enire theme.
 *
 * @package FairBase Starter
 * @since 1.0.0
 */

// Setting the namespace
namespace FAIRBASE_STARTER\Inc;

// Singleton class thus using the Singleton trait.
use FAIRBASE_STARTER\Inc\Traits\Singleton;

class FAIRBASE_STARTER_THEME {

	// Using the Singleton trait
	use Singleton;

	// Singleton class thus instantiation only possible with get_instance();
	protected function __construct() {

		// Run dependency manager
		$this->check_dependencies();

		// Setup the general theme
		$this->setup_theme();

		// Instantiate other classes
		Assets::get_instance(); // Loads all styles and scripts
		Menus::get_instance(); // Creates all menus
		Blocks::get_instance(); // Auto registers all blocks
		Theme_options::get_instance(); // Creates options page and adds customizer settings and controls
		Advanced_Custom_Fields::get_instance(); // Local JSON settings
		Custom_Post_Types::get_instance(); // Create custom post types
	}

	// Functions sets up the theme
	protected function setup_theme(): void {

		/*
		*  Load the theme textdomain file, for translation.
		*/
		// load_theme_textdomain( TEXTDOMAIN, FAIRBASE_DIR_PATH . '/languages' );
		add_action( 'after_setup_theme', function() {
			load_theme_textdomain( TEXTDOMAIN, FAIRBASE_DIR_PATH . '/languages' );
		});
		

		/*
		*  Add various image sizes.
		*/
		add_image_size( 'theme-icon', 64, 64, true );
		add_image_size( 'navigation-image', 900, 300, true );
		add_image_size( 'hexagon-swiper-image', 600, 600, true );


		/*
		*  Add various theme support.
		*/
		add_theme_support( 'yoast-seo-breadcrumbs' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-logo' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'post-thumbnails' );

		/**
		* Remove search functionality
		*/
		add_action( 'parse_query', array( $this, 'remove_search_func' ), 1, 1 );

	}

	// Runs the dependency manager
	protected function check_dependencies(): void {

		Dependencies::get_instance();

	}

	public function remove_search_func( $query ): void {

		if (is_search()) {
				$query->is_search = false;
				$query->query_vars['s'] = false;
				$query->query['s'] = false;
		}

	}

}
