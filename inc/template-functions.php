<?php
/**
 * Additional features to allow styling of the templates.
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function charmed_body_classes( $classes ) {

	$classes[] = 'clearfix';

	// Adds a class of post-thumbnail to pages with post thumbnails for hero areas.
	if ( is_customize_preview() ) {
		$classes[] = 'is-customize-preview';
	}

	// Adds a class is a site border is specified in the Customizer.
	if ( get_theme_mod( 'portfolio_sticky', true ) ) {
		$classes[] = 'has-sticky-content';
	}

	return $classes;
}
add_filter( 'body_class', 'charmed_body_classes' );

if ( ! function_exists( 'charmed_body_data' ) ) :
	/**
	 * Adds data attributes to the body, based on Customizer entries.
	 */
	function charmed_body_data() {
		/*
		 * Lightbox variable used throughout for the PhotoSwipe lightbox.
		 */
		$charmed_lightbox_scheme = get_theme_mod( 'portfolio_lightbox-colorscheme', 'light' );

		printf( 'data-lightbox-scheme="%s"', esc_attr( $charmed_lightbox_scheme ) );
	}
endif;
