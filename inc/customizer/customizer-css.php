<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */
function charmed_customizer_css() {

	$background_color        = get_theme_mod( 'theme_background_color', '#ffffff' );
	$theme_accent_color      = get_theme_mod( 'theme_accent_color', '#61bfad' );
	$body_typography_color   = get_theme_mod( 'body_typography_color', '#222222' );
	$social_svg_color        = get_theme_mod( 'social_svg_color', '#222222' );
	$header_typography_color = get_theme_mod( 'header_typography_color', '#222222' );
	$header_a_color          = get_theme_mod( 'header_a_color', '#222222' );
	$footer_color            = get_theme_mod( 'footer_color', '#999999' );
	$widget_title_color      = get_theme_mod( 'wt_color', '#999999' );

	$body_font_family    = get_theme_mod( 'body_font_family', 'Karla' );
	$body_font_size      = get_theme_mod( 'body_font_size', '15' );
	$body_line_height    = get_theme_mod( 'body_line_height', '26' );
	$body_letter_spacing = get_theme_mod( 'body_letter_spacing', '0' );
	$body_word_spacing   = get_theme_mod( 'body_word_spacing', '0' );

	$pagetitle_font_family    = get_theme_mod( 'pagetitle_font_family', 'Karla' );
	$pagetitle_font_size      = get_theme_mod( 'pagetitle_font_size', '26' );
	$pagetitle_line_height    = get_theme_mod( 'pagetitle_line_height', '26' );
	$pagetitle_letter_spacing = get_theme_mod( 'pagetitle_letter_spacing', '0' );
	$pagetitle_word_spacing   = get_theme_mod( 'pagetitle_word_spacing', '0' );

	$pagecontent_font_size    = get_theme_mod( 'pagecontent_font_size', '19' );
	$pagecontent_line_height  = get_theme_mod( 'pagecontent_line_height', '32' );
	$pagecontent_word_spacing = get_theme_mod( 'pagecontent_word_spacing', '0' );

	$site_logo_width = get_theme_mod( 'custom_logo_max_width', '50' );

	// RGB.
	$theme_accent_color_rgb = charmed_hex2rgb( $theme_accent_color );
	// If the rgba values are empty return early.
	if ( empty( $theme_accent_color_rgb ) ) {
		return;
	}
	$progress_border = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.4)', $theme_accent_color_rgb );

	$css =
	'

	body .custom-logo-link img.custom-logo {
		width: ' . esc_attr( $site_logo_width ) . 'px;
	}

	body .social-navigation a svg,
	body .portfolio-sharing .svg__wrapper svg,
	body .widget-area .menu-social-menu-container a svg {
		fill: ' . $social_svg_color . ';
	}

	body, body .post--wrapper, body .sticky-wrapper, body .project-caption {
		background-color: ' . $background_color . ';
	}

	body {
		font-family: ' . $body_font_family . ' !important;
		font-size: ' . $body_font_size . 'px !important;
		line-height: ' . $body_line_height . 'px !important;
		letter-spacing: ' . $body_letter_spacing . 'px !important;
		word-spacing: ' . $body_word_spacing . 'px !important;
	}

	article.page h2.entry-title {
		font-family: ' . $pagetitle_font_family . ' !important;
		font-size: ' . $pagetitle_font_size . 'px !important;
		line-height: ' . $pagetitle_line_height . 'px !important;
		letter-spacing: ' . $pagetitle_letter_spacing . 'px !important;
		word-spacing: ' . $pagetitle_word_spacing . 'px !important;
	}

	.site-archive, .entry-content p {
		font-size: ' . $pagecontent_font_size . 'px !important;
		line-height: ' . $pagecontent_line_height . 'px !important;
		word-spacing: ' . $pagecontent_word_spacing . 'px !important;
	}

	body.single,
	body.page,
	body.home,
	body button,
	body input,
	body select,
	body textarea,
	p a:hover,
	body.single .project-meta h6,
	body.single .project-meta h6 a {
		color: ' . $body_typography_color . ';
	}

	body .header .project-filter a,
	body .header .main-navigation a {
		color: ' . $header_a_color . ';
	}

	body .site-footer,
	body .site-footer a {
		color: ' . $footer_color . ';
	}

	body h6.widget-title,
	body .project-taxonomy h6,
	body .project-taxonomy a {
		color: ' . $widget_title_color . ';
	}

	body h1,
	body h2,
	body h3,
	body h4,
	body h5,
	body h1.site-logo a {
		color: ' . $header_typography_color . ';
	}


	a:hover,
	a:focus,
	a:active,
	.entry-content p a,
	body .site-footer a:hover,
	body .header .project-filter a:hover,
	body .header .main-navigation a:hover,
	body .header .project-filter a.active,
	.logo_text:hover,
	.widget ul li a:hover,
	.current-menu-item a,
	.portfolio .project-meta a:hover,
	.page-links a span:not(.page-links-title):hover,
	.page-links span:not(.page-links-title) { color:' . $theme_accent_color . '; }

	.cats,
	h1 a:hover,
	.logo a h1:hover,
	.tagcloud a:hover,
	nav ul li a:hover,
	.widget li a:hover,
	.entry-meta a:hover,
	.header-alt a:hover,
	.pagination a:hover,
	.post-after a:hover,
	.bean-tabs > li.active > a,
	.bean-panel-title > a:hover,
	.archives-list ul li a:hover,
	nav ul li.current-menu-item a,
	.bean-tabs > li.active > a:hover,
	.bean-tabs > li.active > a:focus,
	.bean-pricing-table .pricing-column li.info:hover {
		color:' . $theme_accent_color . '!important;
	}

	button:hover,
	button:focus,
	.button:hover,
	.button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.wpcf7-form textarea:focus,
	.wpcf7-form input:focus {
		border-color:' . $theme_accent_color . ';
	}

	button:hover,
	button:focus,
	.button:hover,
	.button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.bean-btn,
	.tagcloud a,
	nav a h1:hover,
	div.jp-play-bar,
	#nprogress .bar,
	.avatar-list li a.active,
	div.jp-volume-bar-value,
	.bean-direction-nav a:hover,
	.bean-pricing-table .table-mast,
	.entry-categories a:hover,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.bean-contact-form .bar:before,
	.post .post-slider.fade .bean-direction-nav a:hover {
		background-color:' . $theme_accent_color . ';
	}

	#nprogress .bar {
		box-shadow: 0 0 10px ' . $progress_border . ';
	}

	.bean-btn { border: 1px solid ' . $theme_accent_color . '!important; }
	.bean-quote { background-color:' . $theme_accent_color . '!important; }
	';

	$css_filter_style = get_theme_mod( 'css_filter' );
	if ( '' !== $css_filter_style ) {
		switch ( $css_filter_style ) {
			case 'none':
				break;
			case 'grayscale':
				echo ' . brick-fullwidth .brick { filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); filter:gray; -webkit-filter:grayscale(100%);-moz-filter: grayscale(100%);-o-filter: grayscale(100%);}';
				break;
			case 'sepia':
				echo ' . brick-fullwidth .brick { -webkit-filter: sepia(50%); }';
				break;
			case 'saturation':
				echo ' . brick-fullwidth .brick { -webkit-filter: saturate(150%); }';
				break;
		}
	}

	/**
	 * Combine the values from above and minifiy them.
	 */
	$css_minified = $css;

	$css_minified = preg_replace( '#/\*.*?\*/#s', '', $css_minified );
	$css_minified = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $css_minified );
	$css_minified = preg_replace( '/\s\s+(.*)/', '$1', $css_minified );

	wp_add_inline_style( 'charmed-style', wp_strip_all_tags( $css_minified ) );

}

add_action( 'wp_enqueue_scripts', 'charmed_customizer_css' );
