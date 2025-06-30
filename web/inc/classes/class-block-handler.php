<?php
/**
 *  This class helps with handling the data from the blocks.
 *  Generating classes and IDs and helping with escaping.
 *
 * @package FairBase Starter
 * @since 1.0.0
 */

// Sets the namespace
namespace FAIRBASE_STARTER\Inc;

class Block_Handler {

	/*
	 * Helper method to create the ID for the block.
	 *
	 * @param String $name ID name for the block.
	 * @param Array $block The global $block variable.
	 *
	 * @return String The ID for the block.
	 */
	public static function get_id( string $name, array $block ): string {

		if ( ! empty( $block['anchor'] ) ) {
			$id = esc_attr( $block['anchor'] );
		} else {
			$id = 'ws-' . $name . '-' . esc_attr( $block['id'] );
		}

		return $id;

	}

	/*
	 * Helper method to create the classlist for the block.
	 * Generates a standard class and a block-specific class, for optional custom CSS.
	 *
	 * @param String $name Class name for the block.
	 * @param Array $block The global $block variable.
	 *
	 * @return String The classlist for the block, space seperated.
	 */
	public static function get_class( string $name, array $block ): string {

		$className = $name;

		// Add custom class names
		if ( ! empty( $block['className'] ) ) {
			$className .= ' ' . $block['className'];
		}
		// Add align class name
		if ( ! empty( $block['align'] ) ) {
			$className .= ' align' . $block['align'];
		}

		// Add unique block identifier class, for custom css on block specific level.
		$className .= ' ' . $name . '-' . esc_attr( $block['id'] );

		// Return escaped classnames
		return esc_attr( $className );

	}

}
