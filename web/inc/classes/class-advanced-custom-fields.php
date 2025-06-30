<?php
/**
 * ACF Class.
 * Singleton class registering all ACF related neccesities.
 * Examples: API keys, local JSON and ACF related filters.
 * Gets instantiated on every run.
 *
 * @package FairBase Starter
 * @since 1.0.0
 */

// Sets the namespace
namespace FAIRBASE_STARTER\Inc;

// Singleton class, thus importing the Singleton Trait.
use FAIRBASE_STARTER\Inc\Traits\Singleton;

class Advanced_Custom_Fields {

	use Singleton;

	// Set the general path for import and export of JSON field settings.
	private $folder = FAIRBASE_DIR_PATH . '/field-settings/';

	protected function __construct() {

		$this->setup_filters();

	}

	protected function setup_filters() {

		add_filter( 'acf/settings/save_json', array( $this, 'save_json' ) );
		add_filter( 'acf/settings/load_json', array( $this, 'load_json' ) );
		add_filter( 'acf/load_field/name=select_post_type', array( $this, 'select_post_type_field' ) );

	}

	// Making sure the 'select_post_type' field includes all available post_types
	public function select_post_type_field($field) {
		$postTypes = get_post_types(['public' => true], 'names');
		$field['choices'] = array_combine($postTypes, $postTypes);
		return $field;
	}

	public function save_json( string $path ): string {

		$path = $this->folder;
		return $path;

	}

	public function load_json( array $paths ): array {

		// Remove standard acf-json folder, as it is moved. Not neccesary anymore.
		unset( $paths[0] );

		$paths[] = $this->folder;

		return $paths;

	}

}
