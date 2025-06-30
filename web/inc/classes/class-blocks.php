<?php
/*
 * Class registers all the blocks from the /template-parts/blocks dir.
 * It also registers all block categories.
 *
 * @package FairBase Starter
 * @since 1.0.0
 */

// Set namespace
namespace FAIRBASE_STARTER\Inc;

// Singleton class, loading the Singleton trait.
use FAIRBASE_STARTER\Inc\Traits\Singleton;

class Blocks {

	// Make this class a singleton
	use Singleton;

	// @param Array $block_categories Holds all the block categories.
	protected $block_categories = array();

	protected function __construct() {

		// Add a new block category
		$this->block_categories[] = 'FairBase Blocks'; // Not translateable, as the slug is based on this.
		$this->block_categories[] = 'FairBase Inner Blocks'; // Not translateable, as the slug is based on this.

		// Register the categories
		$this->register_block_categories();

		// Register the blocks
		$this->register_blocks();

		// Remove core blocks. CAUTION: This also removes all plug-in blocks etc.
		$this->remove_core_blocks();

	}

	protected function register_block_categories(): void {

		add_filter( 'block_categories_all', array( $this, 'filter_block_categories' ) );

	}

	protected function remove_core_blocks(): void {

		add_filter( 'allowed_block_types_all', array( $this, 'allowed_block_types' ), 25, 2 );

	}

	public function allowed_block_types(): array {

		$blocks = $this->get_blocks();
		$allowed = array();

		foreach( $blocks as $block ){
			$title = sanitize_title( $block['name'] ); // Generate slug
			$allowed[] = 'acf/' . $title; // Prefix title
		}

		return $allowed;

	}

	/*
	* Filter function for adding new block categories.
	*
	* @param array $categories The core WordPress Gutenberg block categories.
	*
	* @return array $categories The full set of Gutenberg block categories.
	*/
	public function filter_block_categories( array $categories ): array {

		if ( empty( $this->block_categories ) ) {
			return $categories; // Returns when no custom categories present.
		}

		foreach ( $this->block_categories as $category ) {

			$slug = sanitize_title( $category ); // From name to slug

			$categories[] = array(
				'slug'  => $slug,
				'title' => $category,
			);

		}

		return $categories;

	}

	/*
	*  Main function for registering the blocks, adds an action
	*/
	protected function register_blocks(): void {

		add_action( 'acf/init', array( $this, 'init_blocks' ) );

	}

	/*
	*  Function initiates all blocks
	*/
	public function init_blocks(): void {

		// Get blocks
		$blocks = $this->get_blocks();

		// Check if there are blocks
		if ( empty( $blocks ) || ! count( $blocks ) > 0 ) {
			return;
		}

		// Loop and register blocks
		foreach ( $blocks as $block ) {

			$this->register_block( $block );

		}

	}

	/*
	*  Function retrieves all blocks present in the block directory.
	*
	*  @return Mixed   Array of all blocks or false on failure.
	*/
	protected function get_blocks(): mixed {

		$blocks      = array();
		$directories = glob( FAIRBASE_DIR_PATH . '/template-parts/blocks/*', GLOB_ONLYDIR ); // Get all folders in blocks dir

		if ( empty( $directories ) || count( $directories ) < 1 ) {
			return false;
		}

		foreach ( $directories as $directory ) {

			$blocks[] = $this->get_block_info( $directory );

		}

		return $blocks;

	}

	/*
	 * Function retrieves individual block information
	 *
	 * @param String $directory Path to directory of the block
	 *
	 * @return Array   Block information
	 */
	protected function get_block_info( string $directory ): mixed {

		// Check if provided directory exists and is not empty
		if ( empty( $directory ) || ! is_dir( $directory ) ) {
			return false;
		}

		$directory = untrailingslashit( $directory );

		$block_slug = basename( $directory );
		$file       = $directory . '/block-' . $block_slug . '.php';

		// Check if file exists
		if ( ! file_exists( $file ) ) {
			return false;
		}

		$headers = array(
			'name'        => 'Name',
			'title'       => 'Title',
			'description' => 'Description',
			'category'    => 'Category',
			'icon'        => 'Icon',
			'keywords'    => 'Keywords',
			'post_types'  => 'Post Types',
		);

		$file_data = get_file_data( $file, $headers );

		// Add the render template
		$file_data['render_template'] = $file;
		$file_data['block_slug'] = $block_slug;

		// Add the style file if present in folder
		if ( file_exists( $directory . '/style.css' ) ) {
			$file_data['enqueue_style'] = $directory . '/style.css';
		}

		// Add the script file if present in folder
		if ( file_exists( $directory . '/script.js' ) ) {
			$file_data['enqueue_script'] = $directory . '/script.js';
		}

		// Adds the custom SVG icon as icon if exists
		if ( file_exists( $directory . '/icon.svg' ) ) {
			$file_data['icon'] = file_get_contents( $directory . '/icon.svg' );
		} else {
			$file_data['icon'] = file_get_contents(get_template_directory() . '/dist/images/icon_fallback.svg');
		}

		return $file_data;

	}

	/*
	 * Function registers the block with ACF.
	 *
	 * @param Array $block The array containing all the block information.
	 */
	protected function register_block( array $block ): void {

		// Bail if information is missing
		if ( empty( $block['name'] )
		 || empty( $block['title'] )
		 || empty( $block['description'] )
		 || empty( $block['render_template'] )
		 || empty( $block['category'] )
		 || empty( $block['icon'] ) ) {
			return;
		}

		// Info comes from the file headers, meaning that escaping is not neccesary.
		if ( ! empty( $block['keywords'] ) ) {
			$keywords = explode( ',', $block['keywords'] );
		}

		/*
		 * Registering the block, first checking whether function exists.
		 * No escpaing for the information, as it comes from the file header.
		 * Escaping for the translateable strings, preventing malicious code through translations.
		 */
		if ( function_exists( 'acf_register_block_type' ) ) {

			acf_register_block_type(
				array(
					'name'            => $block['name'],
					'title'           => esc_html__( $block['title'], TEXTDOMAIN ),
					'description'     => esc_html__( $block['description'], TEXTDOMAIN ),
					'render_template' => $block['render_template'],
					'category'        => $block['category'],
					'icon'            => $block['icon'],
					'keywords' => $keywords,
					'example' => array(
						'attributes' => array(
							'mode' => 'preview',
							'data' => array(
								'preview_image' => get_template_directory_uri() . '/template-parts/blocks/' . $block['block_slug'] . '/preview.jpg',
							),
						),
					),
					'mode'						=> 'edit', // Standard mode is edit.
					'supports'				=> array(
						'jsx'		=> true, // For innerBlocks
						'align' => false, // No alignment options
					),
				)
			);

		}

	}

}
