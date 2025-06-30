<?php
/*
 * Initiates all the theme menus.
 *
 * @package FairBase Starter
 * @since 1.0.0
 */

namespace FAIRBASE_STARTER\Inc;

// Singleton class using the Singleton Trait
use FAIRBASE_STARTER\Inc\Traits\Singleton;

class Menus {

	// Make this class a singleton
	use Singleton;

	// @param Array $menus Holds an array of all the menu names.
	protected array $menus;

	// Singleton class, can only be instantiated with get_instance();
	protected function __construct() {

		// Define all the menus
		$this->menus = array(
			'main_menu'					=> esc_html__( 'Head menu', TEXTDOMAIN ),
			'mobile_menu'				=> esc_html__( 'Mobile menu', TEXTDOMAIN ),
		);

		// Register the menus
		$this->register_theme_menus();

	}

	// Function registers all the set menus
	protected function register_theme_menus(): void {

		register_nav_menus( $this->menus );

	}

	/*
	 * Function for registering additional menus.
	 * Escaping not neccesary, happens here.
	 * Useful for optional menus for variable template choices.
	 *
	 * @param String $location Location name of the menu
	 * @param String $name Name of the menu
	 *
	 * @return Boolean True if it works, false on error
	 */
	public static function register_menu( string $location, string $name ): bool {

		// Return if no location or name
		if ( empty( $location ) || empty( $name ) ) {
			return false;
		}

		// Register new menu
		register_nav_menu( array( $location, esc_html__( $name, TEXTDOMAIN ) ) );

		return true;

	}

}
