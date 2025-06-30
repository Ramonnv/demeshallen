<?php
/*
 * Class registers and checks the depencencies.
 * Shows admin notices on missing dependencies.
 *
 * @package FairBase Starter
 * @since 1.0.0
 */

// Set the namespace
namespace FAIRBASE_STARTER\Inc;

// Load the Singleton Trait
use FAIRBASE_STARTER\Inc\Traits\Singleton;

class Dependencies {

	// Use the Singleton Trait
	use Singleton;

	// Declare depencies for the theme
	protected $dependencies = array(
		'advanced-custom-fields-pro/acf.php' => 'Advanced Custom Fields Pro', // Name not translateable.
		'wordpress-seo/wp-seo.php'           => 'Yoast SEO',
	);

	// @param Array $missing Holds all the missing dependencies.
	protected $missing = array();

	// Runs the dependency manager, can only be instantiated as a singleton with get_instance();
	protected function __construct() {

		$this->setup_hooks(); // Add admin notices

	}

	// Sets up the hooks
	protected function setup_hooks(): void {

		add_action( 'admin_notices', array( $this, 'show_dependency_notices' ) );

	}

	// Loads the dependency notices.
	public function show_dependency_notices(): void {

		$this->check_dependencies(); // Run check

		// Loop array with all the missing dependencies
		if ( ! empty( $this->missing ) ) {

			foreach ( $this->missing as $plugin_name ) {
				echo '<div class="error"><p>' . sprintf( esc_html__( 'Warning: FairBase Starter Theme requires: %s.', TEXTDOMAIN ), $plugin_name ) . ' <a href="' . admin_url() . 'plugins.php">' . esc_html__( 'View Plugins', TEXTDOMAIN ) . '</a></p></div>';
			}
		}

		// Check WordPress version
		if ( ! version_compare( get_bloginfo( 'version' ), REQUIRED_WP_VERSION, '>=' ) ) {
			echo '<div class="error"><p>' . sprintf( esc_html__( 'Warning: FairBase Starter Theme requires WordPress version %s or above.', TEXTDOMAIN ), REQUIRED_WP_VERSION ) . ' <a href="' . admin_url() . 'update-core.php">' . esc_html__( 'Update WordPress', TEXTDOMAIN ) . '</a></p></div>';
		}

		// Check PHP version
		if ( ! version_compare( phpversion(), REQUIRED_PHP_VERSION, '>=' ) ) {
			echo '<div class="error"><p>' . sprintf( esc_html__( 'Warning: FairBase Starter Theme requires PHP version %s or above.', TEXTDOMAIN ), REQUIRED_PHP_VERSION ) . '</p></div>';
		}

	}

	// Checks the individual given dependencies.
	protected function check_dependencies(): void {

		foreach ( $this->dependencies as $dependency => $plugin_name ) {

			if ( ! is_plugin_active( $dependency ) ) {

				$this->missing[] = $plugin_name;

			}
		}

	}

}
