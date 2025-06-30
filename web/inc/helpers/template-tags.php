<?php
/*
 * All template tags
 *
 * @package FairBase Starter
 * @since 1.0.0
 */

/*
*  Function outputs the breadcrumb.
*  Breadcrumb generation by Yoast, and therewith dependent on Yoast plug-iun.
*
*  @since 1.0
*/
function fairbase_the_breadcrumbs(): void {

	echo FAIRBASE_STARTER\Inc\Breadcrumbs::get_breadcrumbs();

}

/*
*  Function retrieves the block ID.
*  Block ID based on name and block-specific ID.
*
*  @param string $name Name of the block.
*  @param array $block The global $block variable.
*  @param boolean $echo Whether to return or echo the block ID.
*
*  @since 1.0
*  @return string: The block ID.
*/
function fairbase_block_id( string $name, array $block, bool $echo = true ): mixed {

	if ( ! $echo ) {
		return FAIRBASE_STARTER\Inc\Block_Handler::get_id( $name, $block );
	}

	echo FAIRBASE_STARTER\Inc\Block_Handler::get_id( $name, $block );

}

/*
*  Function retrieves the block classes.
*  Gets the general class, a block specific class and any optional classes set via Gutenberg.
*
*  @param string $name Name of the block.
*  @param array $block The global $block variable.
*  @param boolean $echo Echo or return the html.
*
*  @since 1.0
*  @return string $html The HTML to display.
*/
function fairbase_block_classes( string $name, array $block, bool $echo = true ): mixed {

	if ( ! $echo ) {
		return FAIRBASE_STARTER\Inc\Block_Handler::get_class( $name, $block );
	}

	echo FAIRBASE_STARTER\Inc\Block_Handler::get_class( $name, $block );

}

/*
*  Function checks whether there exists pagination.
*
*  @param \WP_Query $query The query to check for.
*
*  @since 1.0
*  @return Boolean Whether pagination exists.
*/
function fairbase_has_pagination(): bool {

	return FAIRBASE_STARTER\Inc\Pagination::has_pagination();

}

/*
*  Function echos the pagination for the given query.
*  Query defaults to the global $wp_query.
*
*  @param \WP_Query $query The query object to show the pagination for.
*
*  @since 1.0
*/
function fairbase_the_pagination(): void {

	FAIRBASE_STARTER\Inc\Pagination::the_pagination(); // Echoes the pagination

}

/*
*  Echos the site logo in a wrapper.
*
*  @param boolean $url Whether to wrap the home url.
*/
function fairbase_the_site_logo( bool $url = true ): void {

	if ( ! get_theme_mod( 'custom_logo' ) ) {
		return;
	}

	$image_id  = get_theme_mod( 'custom_logo' );
	$image_url = wp_get_attachment_image_url( $image_id, 'full' ); // Retrieve URL of attachment ID with 64x64 size.

	$site_title = get_option( 'blogname' );

	if ( $url ) {
		$site_url = get_site_url();
		$html     = "<div class='theme-logo'><a href='{$site_url}'><img title='{$site_title}' alt='{$site_title}' class='theme-logo__image' src='{$image_url}' /></a></div>";
	} else {
		$html = "<div class='theme-logo'><img title='{$site_title}' alt='{$site_title}' class='theme-logo__image' src='{$image_url}' /></div>";
	}

	echo $html;

}

/*
*  Echos the site icon, if set in a wrapper.
*
*  @param boolean $url Whether to wrap the home url.
*/
function fairbase_the_site_icon( bool $url = true ): void {

	if ( ! get_theme_mod( 'fairbase_theme_icon' ) ) {
		return;
	}

	$image_id  = attachment_url_to_postid( get_theme_mod( 'fairbase_theme_icon' ) ); // Retrieve image ID based on the URL.
	$image_url = wp_get_attachment_image_url( $image_id, 'theme-icon' ); // Retrieve URL of attachment ID with 64x64 size.

	$site_title = get_option( 'blogname' );

	if ( $url ) {
		$site_url = get_site_url();
		$html     = "<div class='theme-icon'><a href='{$site_url}'><img title='{$site_title}' alt='{$site_title}' class='theme-icon__image' src='{$image_url}' /></a></div>";
	} else {
		$html = "<div class='theme-icon'><img title='{$site_title}' alt='{$site_title}' class='theme-icon__image' src='{$image_url}' /></div>";
	}

	echo $html;

}

/*
 * Function returns whether the header should be white and offset.
 *
 * @return Boolean
 */
function fairbase_is_white_header(): string {

	if ( is_front_page() )
		return false;

	return true;

}

 /**
  * Returns HTML div in given type with translation toggler.
	*
	* @param String $type Type of return, either menu (for dropdown) or list.
	*
	* @return String|False $html DIV or UL, dependent on given Type.
	*/
 function fairbase_translations_menu( string $type = 'desktop' ): string|false {

		if ( ! function_exists( 'icl_get_languages' ) )
			return false;

		// Retrieve translations
		$translations = icl_get_languages();

		// Check whether the page has translations. 1 will always return, current language.
		if ( count( $translations ) == 1 )
			return false;

		// Set first indicator
		$first = true;

		if ( $type == 'desktop' ) {

			// Start DIV output
			$html = '<div class="main-header__lang-switcher u-d-none u-d-lg-block">';

			// Add current language as base.
			$html .= '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/dist/images/icons/'.$translations[ICL_LANGUAGE_CODE]['code'].'.png" alt="'.$translations[ICL_LANGUAGE_CODE]['code'].'"> '.$translations[ICL_LANGUAGE_CODE]['code'].'</a>';

			// Open UL
			$html .= '<ul>';

			foreach ( $translations as $language_code => $translation ) {

				// Skip current language.
				if ( $language_code == ICL_LANGUAGE_CODE )
					continue;

				$permalink = apply_filters( 'wpml_permalink', get_permalink(), $language_code );
				$html .= '<li><a href="'.$translation['url'].'"><img src="'.get_template_directory_uri().'/dist/images/icons/'.$language_code.'.png" alt="'.$language_code.'"> '.$language_code.'</a></li>';

			}

			$html .= '</ul>'; // Close UL
			$html .= '</div>'; // Close DIV

		} elseif ( $type == 'mobile' ) {

			$html = '<ul class="mobile-nav__languages mb-30">';

			foreach ( $translations as $language_code => $translation ) {

				$permalink = apply_filters( 'wpml_permalink', get_permalink(), $language_code );
				$html .= '<li><a href="'.$translation['url'].'"><img src="'.get_template_directory_uri().'/dist/images/icons/'.$language_code.'.png" alt="'.$language_code.'"> '.$language_code.'</a></li>';

			}

			$html .= '</ul>';

		}

		return $html;

 }
