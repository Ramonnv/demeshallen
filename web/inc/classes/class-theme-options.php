<?php
/*
 * Registering the ACF options page and creating custom Customizer controls.
 *
 * @package FairBase Starter
 * @since 1.0.0
 */

// Setting the namespace
namespace FAIRBASE_STARTER\Inc;

// Singleton class, thus using the Singleton Trait.
use FAIRBASE_STARTER\Inc\Traits\Singleton;

class Theme_Options {

	// Loading the Singleton trait.
	use Singleton;

	// Singleton class, can only be instantiated with get_instance();
	protected function __construct() {

		$this->add_actions();
		add_action('init', [$this, 'add_options_page']);

		$this->allow_upload_types();

	}

	public function add_options_page(): void {

		if ( function_exists( 'acf_add_options_page' ) ) {

		  acf_add_options_page( esc_html__( 'FairBase', TEXTDOMAIN ) );

		}

	}

	protected function add_actions() {

		add_action( 'customize_register', array( $this, 'setup_customizer_options' ) );

	}

	/*
	 * Adds custom settings and controls to the WordPress customizer.
	 *
	 * @param \WP_Customize_Manager $wp_customize Customizer object given by action.
	 */
	public function setup_customizer_options( \WP_Customize_Manager $wp_customize ): void {

		// Add theme icon option
		$wp_customize->add_setting(
			'ws_theme_icon',
			array(
				'default'    => '',
				'type'       => 'option',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Image_Control(
				$wp_customize,
				'ws_theme_icon_control',
				array(
					'label'       => esc_html__( 'Company icon', TEXTDOMAIN ),
					'description' => esc_html__( 'Small icon for usage throughout the theme.', TEXTDOMAIN ),
					'settings'    => 'ws_theme_icon',
					'priority'    => 10,
					'section'     => 'title_tagline',
				)
			)
		);

	}

	public function allow_upload_types() {
		/*
			WordPress will only allow the specified types.
		*/

	$allowed_types = [

		// ------------------
		// Application types
		// ------------------

		'pdf'  => 'application/pdf',
		'json' => 'application/json',
		// 'csv'  => 'text/csv',
		// 'zip'  => 'application/zip',
		// 'doc'  => 'application/msword',
		// 'xls'  => 'application/vnd.ms-excel',
		// 'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		// 'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',

		// ------------------
		// Image types
		// ------------------

		'jpg'  => 'image/jpeg',
		'jpeg' => 'image/jpeg',
		'png'  => 'image/png',
		'webp' => 'image/webp',
		'svg'  => 'image/svg+xml',
		'ico'  => 'image/x-icon',
		// 'gif'  => 'image/gif',
		// 'psd'  => 'image/vnd.adobe.photoshop',

		// ------------------
		// Font types
		// ------------------

		// 'ttf'   => 'font/ttf',
		// 'otf'   => 'font/otf',
		// 'woff'  => 'font/woff',
		// 'woff2' => 'font/woff2',
		// 'eot'   => 'application/vnd.ms-fontobject',

		// ------------------
		// Video/Audio types
		// ------------------

		// 'mp4'  => 'video/mp4',
		// 'ogg'  => 'audio/ogg',
		// 'mp3'  => 'audio/mpeg',
		// 'webm' => 'video/webm',
	];

	add_filter( 'upload_mimes', function( $mimes ) use ( $allowed_types ) {
		return $allowed_types;
	});

	return true;
}


}
