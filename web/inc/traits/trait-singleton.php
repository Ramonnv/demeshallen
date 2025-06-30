<?php
/*
 * Singleton trait.
 *
 * @package fairbase starter
 */

// Set the namespace
namespace FAIRBASE_STARTER\Inc\Traits;

trait Singleton {

	// Protected class constructor to prevent direct object creation
	protected function __construct() {
	}


	// Prevent object cloning
	final protected function __clone() {
	}

	/*
	 * Creates a new instance or returns an existing instance.
	 *
	 * @return Mixed Class object
	 */
	final public static function get_instance(): mixed {

		static $instance = array();

		$called_class = get_called_class();

		if ( ! isset( $instance[ $called_class ] ) ) {

			$instance[ $called_class ] = new $called_class();

		}

		return $instance[ $called_class ];

	}

}
