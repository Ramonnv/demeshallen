<?php
/*
 * All the environment variables.
 *
 * @package FairBase Starter
 * @since 1.0.0
 */

// Define version. Always overwrite, so no plugin or else can overwrite.
define( 'FAIRBASE_THEME_VERSION', '1.0.0' );

if ( ! defined( 'FAIRBASE_ENVIRONMENT' ) ) {
	define( 'FAIRBASE_ENVIRONMENT', 'DEVELOPMENT' );
}

if ( ! defined( 'THEME_PREFIX' ) ) {
	define( 'THEME_PREFIX', 'fairbase_' );
}

if ( ! defined( 'TEXTDOMAIN' ) ) {
	define( 'TEXTDOMAIN', 'FAIRBASE_STARTER' );
}

if ( ! defined( 'REQUIRED_WP_VERSION' ) ) {
	define( 'REQUIRED_WP_VERSION', '6.0' );
}

if ( ! defined( 'REQUIRED_PHP_VERSION' ) ) {
	define( 'REQUIRED_PHP_VERSION', '8.0' );
}

if ( ! defined( 'FAIRBASE_DIR_URI' ) ) {
	define( 'FAIRBASE_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}
