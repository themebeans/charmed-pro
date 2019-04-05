<?php
/**
 * Fonts functionality
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

/**
 * Enqueue Customize font selections.
 */
function charmed_enqueue_fonts() {
	$default = array(
		'default',
		'Default',
		'arial',
		'Arial',
		'courier',
		'Courier',
		'verdana',
		'Verdana',
		'trebuchet',
		'Trebuchet',
		'georgia',
		'Georgia',
		'times',
		'Times',
		'tahoma',
		'Tahoma',
		'helvetica',
		'Helvetica',
	);

	$fonts = array();

	$body_font_family   = get_theme_mod( 'body_font_family' );
	$header_font_family = get_theme_mod( 'header_font_family' );

	if ( $body_font_family ) {
		$fonts[] = $body_font_family;
	}

	if ( $header_font_family ) {
		$fonts[] = $header_font_family;
	}

	$fonts = array_unique( $fonts );

	foreach ( $fonts as $font ) {
		if ( ! in_array( $font, $default, true ) ) {
			charmed_enqueue_google_fonts( $font );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'charmed_enqueue_fonts' );

/**
 * Enqueue Customize fonts.
 *
 * @param string $font Customizer font selection.
 */
function charmed_enqueue_google_fonts( $font ) {
	$font = explode( ',', $font );
	$font = $font[0];

	// CUSTOM CHECKS FOR CERTAIN FONTS.
	if ( 'Open Sans' === $font ) {
		$font = 'Open Sans:400,600';
	} else {
		$font = $font . ':400,500,700';
	}

	// FRIENDLY MOD.
	$font = str_replace( ' ', '+', $font );

	// CSS ENQUEUE.
	wp_enqueue_style( 'charmed-google-$font', 'https://fonts.googleapis.com/css?family=$font', false, null, 'all' );
}
