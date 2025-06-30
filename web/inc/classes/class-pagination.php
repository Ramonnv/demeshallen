<?php
/*
 * Helper class for template-tags, creating proper pagination output.
 *
 * @package FairBase Starter
 * @since 1.0.0
 */

// Setting the namespace
namespace FAIRBASE_STARTER\Inc;

class Pagination {

	/*
	* Function returns whether pagination must be shown.
	*
	* @return Boolean Whether the page has pagination.
	*/
	public static function has_pagination(): bool {

		global $wp_query;

		return ( $wp_query->max_num_pages > 1 );

	}

	/*
	* Function gives the pagination, checks for existence.
	*/
	public static function the_pagination(): void {

		global $wp_query;

		// Abort if no pagination
		if ( ! self::has_pagination() ) {

			wp_reset_query(); // Reset the query
			return;

		}

		$pages = paginate_links(
			array(
				'prev_text' => esc_html__( 'Vorige', TEXTDOMAIN ),
				'next_text' => esc_html__( 'Volgende', TEXTDOMAIN ),
				'type'      => 'array',
			)
		);

		wp_reset_query(); // Reset the query

		// Build up HTML, just as the paginate_links function does with return type list.
		$html  = "<ul class='pagination'>\n\t<li class='pagination__item'>";
		$html .= implode( "</li>\n\t<li class='pagination__item'>", $pages );
		$html .= "</li>\n</ul>\n";

		echo $html;

	}

}
