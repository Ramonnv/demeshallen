<?php
/**
 * Assets class, Singleton instance.
 * Class handles the loading of all the neccesary assets.
 *
 * @package FairBase Starter
 * @since 1.0.0
 */

// Set the namespace
namespace FAIRBASE_STARTER\Inc;

// Load the Singleton Trait.
use FAIRBASE_STARTER\Inc\Traits\Singleton;

class Assets {


	/*
		===========================================================
		Folder structure for SCSS and JS
			- 'blocks' are full page sections (e.g., hero, features)
			- 'components' are smaller UI elements (e.g., buttons, cards)
			- 'layout' holds global structure (e.g., header, main, footer)
			- 'abstract' for variables, mixins, functions (no output)
			- 'base' for resets, typography, global styling

		the root of the ./scss contains a main.scss, this loads in all of the scss
		===========================================================
	*/

	use Singleton;

	protected $styles;

	protected $scripts;

	
	protected function __construct() {

    	// Make AjaxURL available
		add_action( 'wp_head', array( $this, 'add_ajax_url' ), 1 );

		// Add all styles
		$this->add_element( FAIRBASE_DIR_URI . '/dist/css/main.css' );
		$this->add_element( FAIRBASE_DIR_URI . '/dist/scripts/scripts.min.js', array('jquery'), true );

		// Add Swiper
		$this->add_element('https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array('jquery'), true);
		$this->add_element('https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
		$this->add_element(url: 'https://unpkg.com/swiper/swiper-bundle.min.css');  

		$this->load();

		// Remove gutenberg styling
		add_action( 'wp_enqueue_scripts', array( $this, 'remove_gutenberg_styling' ) );

	}

	public function remove_gutenberg_styling() {

		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style('classic-theme-styles');

	}

	public function add_ajax_url() {

		echo '<script type="text/javascript">const ajaxURL = "'.admin_url( 'admin-ajax.php' ).'";</script>';

	}

	/*
	 *  Loads all the styles.
	 *  Hooks to the wp_enqueue_scripts action.
	 */
	protected function load(): void {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		//add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_editor_styles' ) );

	}

	public function enqueue_editor_styles(): void {

		//wp_enqueue_style( 'gutenberg-styling', get_stylesheet_directory_uri() . "/dist/css/gutenberg.css", false, '1.0', 'all' );

	}

	/*
	 * Function enqueing all scripts neccesary for the page
	 * Function sets all styles
	 *
	 * @return Void
	 */
	public function enqueue_styles(): void {

		if( count( $this->styles ) > 0 ) {
			foreach ( $this->styles as $style ) {

				wp_enqueue_style( ...$style ); // Use array as set of parameters

			}
		}

		if( count( $this->scripts ) > 0 ) {
			foreach ( $this->scripts as $script ) {

				wp_enqueue_script( ...$script ); // Use array as set of parameters

			}
		}

	}

	/*
	 * Registers styles to the protected $styles property.
	 * Checks for file existence, generates a unique name and sets version to theme version.
	 *
	 * @param String $path The path to the CSS-file.
	 * @param Array $dependencies Dependencies for the script or style.
	 * @param Boolean $script Whether it is an external file (CDN).
	 */
	protected function add_element( string $url, array $dependencies = [], bool $script = false ): void {

		// Get file name from URL
		$name = $this->get_external_name( $url );

		// Strip extension and add prefix
		$name = explode( '.', $name ); // removing file extension
		$name = $name[0]; // removing file extension
		$name = THEME_PREFIX . $name; // prefixing name

		if( $script ){

			$this->scripts[] = array(
				$name, // Name of the script
				$url, // URL of the script
				$dependencies, // Dependencies of the script
				FAIRBASE_THEME_VERSION, // Version number of script, for cache busting purposes
				'true', // Enqueue in footer, standard set to true. Might need changes.
			);

		} else {

			$this->styles[] = array(
				$name, // Name of the style
				$url, // URI of the style
				$dependencies, // Dependencies of the style
				FAIRBASE_THEME_VERSION, // Version number of style, for cache busting purposes
				'all', // For which media device, default is all.
			);

		}

	}

	/*
	 * Function returns file name from external URL, excluding versioning etc.
	 *
	 * @param String $url URL to the file.
	 *
	 * @return String $name Name of the file.
	 */
	protected function get_external_name( string $url ) {

		$path = parse_url( $url, PHP_URL_PATH );
		$name = basename( $path );

		return $name;

	}

}
