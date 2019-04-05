<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

if ( ! defined( 'CHARMED_DEBUG' ) ) :
	/**
	 * Check to see if development mode is active.
	 * If set to false, the theme will load un-minified assets.
	 */
	define( 'CHARMED_DEBUG', true );
endif;

if ( ! defined( 'CHARMED_ASSET_SUFFIX' ) ) :
	/**
	 * If not set to true, let's serve minified .css and .js assets.
	 * Don't modify this, unless you know what you're doing!
	 */
	if ( ! defined( 'CHARMED_DEBUG' ) || true === CHARMED_DEBUG ) {
		define( 'CHARMED_ASSET_SUFFIX', null );
	} else {
		define( 'CHARMED_ASSET_SUFFIX', '.min' );
	}
endif;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function charmed_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Charmed, use a find and replace
	 * to change 'charmed-pro' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'charmed-pro', get_parent_theme_file_path( '/languages' ) );

	/*
	 * Add default posts and comments RSS feed links to head.
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Filter Charmed's custom-background support argument.
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 * }
	 */
	$args = array(
		'default-color' => 'ffffff',
	);
	add_theme_support( 'custom-background', $args );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 140, 140, true );
	add_image_size( 'sml-thumbnail', 50, 50, true );
	add_image_size( 'page-feat', 600, 9999 );
	add_image_size( 'port-full', 9999, 9999, false );
	add_image_size( 'port-grid', 500, 9999 );
	add_image_size( 'port-grid@2x', 1000, 9999 );
	add_image_size( 'port-grid-mobile', 400, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'charmed-pro' ),
			'social'  => esc_html__( 'Social Menu', 'charmed-pro' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats', array(
			'video',
		)
	);

	/*
	 * This theme styles the visual editor to resemble the theme style.
	 */
	add_editor_style( array( 'assets/css/editor' . CHARMED_ASSET_SUFFIX . '.css', charmed_fonts_url() ) );

	/*
	 * Enable support for Customizer Selective Refresh.
	 * See: https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Enable support for the WordPress default Theme Logo
	 * See: https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo', array(
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	/*
	 * Define starter content for the theme.
	 * See: https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
	 */
	$starter_content = array(
		'options'     => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
		),

		'attachments' => array(
			'image-logo' => array(
				'post_title' => _x( 'Logo', 'Theme starter content', 'charmed-pro' ),
				'file'       => 'inc/customizer/images/logo.jpg',
			),
		),

		'theme_mods'  => array(
			'custom_logo'           => '{{image-logo}}',
			'custom_logo_max_width' => '50',
		),

		'widgets'     => array(
			'sidebar-1' => array(
				'text_about',
			),
		),

		'nav_menus'   => array(
			'primary' => array(
				'name'  => __( 'Primary Menu', 'charmed-pro' ),
				'items' => array(
					'page_home',
					'page_about',
					'page_contact',
				),
			),
			'social'  => array(
				'name'  => __( 'Social Menu', 'charmed-pro' ),
				'items' => array(
					'link_twitter',
					'link_dribbble',
					'link_instagram',
				),
			),
		),
	);

	/**
	 * Filters @@pkg.name array of starter content.
	 *
	 * @since @@pkg.name 1.0
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'charmed_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );

}
add_action( 'after_setup_theme', 'charmed_setup' );

/**
 * Checks to see if we're on the homepage or not.
 */
function charmed_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function charmed_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'charmed_content_width', 644 );
}
add_action( 'after_setup_theme', 'charmed_content_width', 0 );

/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function charmed_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Theme Sidebar', 'charmed-pro' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Appears at the side, under the header.', 'charmed-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>',
		)
	);
}
add_action( 'widgets_init', 'charmed_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function charmed_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'charmed-fonts', charmed_fonts_url(), array(), null );

	// Load theme styles.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'charmed-style', get_parent_theme_file_uri( '/style' . CHARMED_ASSET_SUFFIX . '.css' ) );
		wp_enqueue_style( 'charmed-child-style', get_theme_file_uri( '/style.css' ), false, '@@pkg.version', 'all' );
	} else {
		wp_enqueue_style( 'charmed-style', get_theme_file_uri( '/style' . CHARMED_ASSET_SUFFIX . '.css' ) );
	}

	// Load the standard WordPress comments reply javascript.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		if ( ! charmed_is_frontpage() ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	// Load the contact and comment form validation scripts.
	if ( is_page_template( 'template-contact.php' ) ) {
		wp_enqueue_script( 'validation', 'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array( 'jquery' ), '@@pkg.version', true );
	}

	/**
	 * Now let's check the same for the scripts.
	 */
	if ( SCRIPT_DEBUG || CHARMED_DEBUG ) {

		// Vendor scripts.
		wp_enqueue_script( 'wow', get_theme_file_uri( '/assets/js/vendors/wow.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'isotope', get_theme_file_uri( '/assets/js/vendors/isotope.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'infinitescroll', get_theme_file_uri( '/assets/js/vendors/infinitescroll.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'lazyload', get_theme_file_uri( '/assets/js/vendors/lazyload.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'sticky', get_theme_file_uri( '/assets/js/vendors/sticky.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'animistion', get_theme_file_uri( '/assets/js/vendors/animistion.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'dropkick', get_theme_file_uri( '/assets/js/vendors/dropkick.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'fitvids', get_theme_file_uri( '/assets/js/vendors/fitvids.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'lity', get_theme_file_uri( '/assets/js/vendors/lity.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'charmed-photoswipe', get_theme_file_uri( '/assets/js/vendors/photoswipe.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'charmed-photoswipe-ui', get_theme_file_uri( '/assets/js/vendors/photoswipe-ui-default.js' ), array( 'jquery' ), '@@pkg.version', true );

		// Custom scripts.
		wp_enqueue_script( 'charmed-functions', get_theme_file_uri( '/assets/js/custom/global.js' ), array( 'jquery', 'imagesloaded' ), '@@pkg.version', true );
	} else {
		wp_enqueue_script( 'charmed-vendors-min', get_theme_file_uri( '/assets/js/vendors.min.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'charmed-custom-min', get_theme_file_uri( '/assets/js/custom.min.js' ), array( 'jquery', 'imagesloaded' ), '@@pkg.version', true );
	}
}
add_action( 'wp_enqueue_scripts', 'charmed_scripts' );

/**
 * Remove the duplicate stylesheet enqueue for older versions of the child theme.
 *
 * Since v2.3.6 @@pkg.name has a built-in auto-loader for loading the appropriate
 * parent theme stylesheet, without the need for a wp_enqueue_scripts function within
 * the child theme. This means that stylesheets will "just work" and there's less chance
 * that users will accidently disrupt stylesheet loading.
 */
function charmed_remove_duplicate_child_parent_enqueue_scripts() {
	remove_action( 'wp_enqueue_scripts', 'charmed_pro_child_scripts', 10 );
}
add_action( 'init', 'charmed_remove_duplicate_child_parent_enqueue_scripts' );

/**
 * Register Google fonts.
 *
 * @return string Google fonts URL for the theme.
 */
function charmed_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Karla, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$karla = esc_html_x( 'on', 'Karla font: on or off', 'charmed-pro' );

	if ( 'off' !== $karla ) {
		$font_families = array();

		if ( 'off' !== $karla ) {
			$font_families[] = 'Karla';
		}

		$query_args = array(
			'family' => rawurlencode( implode( '|', $font_families ) ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @param  array  $urls           URLs to print for resource hints.
 * @param  string $relation_type  The relation type the URLs are printed.
 * @return array  $urls           URLs to print for resource hints.
 */
function charmed_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'charmed-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'charmed_resource_hints', 10, 2 );

/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function charmed_enqueue_admin_style() {
	wp_enqueue_style( 'charmed-admin', get_theme_file_uri( '/assets/css/admin-style.css' ), false, '@@pkg.version', 'all' );
}
add_action( 'admin_enqueue_scripts', 'charmed_enqueue_admin_style' );

/**
 * Enqueue JavaScript for post meta.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function charmed_metaboxes_script( $hook ) {

	// Only enqueue this script on edit screens.
	if ( 'edit.php' !== $hook && 'post.php' !== $hook && 'post-new.php' !== $hook ) {
		return;
	}

	wp_enqueue_script( 'charmed-post-meta', get_theme_file_uri( '/assets/js/admin/post-meta.js' ), array( 'jquery' ), '@@pkg.version', true );
}
add_action( 'admin_enqueue_scripts', 'charmed_metaboxes_script' );

/**
 * Add the fullscreen post thumbnail to the post post type.
 */
if ( class_exists( 'MultiPostThumbnails' ) ) {
	new MultiPostThumbnails(
		array(
			'label'     => esc_html__( 'Featured Image Hover', 'charmed-pro' ),
			'id'        => 'hover-image',
			'post_type' => 'portfolio',
		)
	);
}

/**
 * Removes the "Protected" prefix on protected post titles. Returns the title back.
 */
function charmed_protected_title_format() {
	return '%s';
}
add_filter( 'protected_title_format', 'charmed_protected_title_format' );

if ( ! function_exists( 'charmed_protected_form' ) ) :
	/**
	 * Filter the HTML output for the protected post password form.
	 * Create your own charmed_protected_form() to override in a child theme.
	 *
	 * @link https://developer.wordpress.org/reference/hooks/the_password_form/
	 * @link https://codex.wordpress.org/Using_Password_Protection
	 */
	function charmed_protected_form() {
		global $post;

		$label = 'pwbox-' . ( empty( $post->ID ) ? wp_rand() : $post->ID );

		$o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
		<label for="' . $label . '">' . __( 'Password:', 'charmed-pro' ) . ' </label><input name="post_password" placeholder="' . __( 'Enter password & press enter...', 'charmed-pro' ) . '" type="password" placeholder=""/><input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'charmed-pro' ) . '" />
		</form>
		';

		return $o;
	}
	add_filter( 'the_password_form', 'charmed_protected_form' );
endif;

/**
 * Loop by post view count.
 *
 * @param string $id Post ID.
 */
function charmed_get_post_views( $id ) {
	$count_key = 'post_views_count';
	$count     = get_post_meta( $id, $count_key, true );

	if ( '' === $count ) {
		delete_post_meta( $id, $count_key );
		add_post_meta( $id, $count_key, '0' );
		return '0';
	}

	return $count;
}

/**
 * Output the view count.
 *
 * @param string $id Post ID.
 */
function charmed_set_post_views( $id ) {
	$count_key = 'post_views_count';
	$count     = get_post_meta( $id, $count_key, true );

	if ( '' === $count ) {
		$count = 0;
		delete_post_meta( $id, $count_key );
		add_post_meta( $id, $count_key, '0' );
	} else {
		$count++;
		update_post_meta( $id, $count_key, $count );
	}
}

/**
 * Convert HEX to RGB.
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 * HEX code, empty array otherwise.
 */
function charmed_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}

/**
 * Return a percentage.
 *
 * @param string $total Height.
 * @param string $number Width.
 */
function charmed_get_percentage( $total, $number ) {
	if ( $total > 0 ) {
		return round( $number / ( $total / 100 ), 2 );
	} else {
		return 0;
	}
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function charmed_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'charmed_pingback_header' );

if ( is_admin() ) {
	require get_theme_file_path( '/inc/meta/meta.php' );
	require get_theme_file_path( '/inc/meta/meta-post.php' );
	require get_theme_file_path( '/inc/meta/meta-portfolio.php' );
}

/**
 * Customizer additions.
 */
require get_theme_file_path( '/inc/customizer/customizer.php' );
require get_theme_file_path( '/inc/customizer/customizer-css.php' );
require get_theme_file_path( '/inc/customizer/sanitization.php' );
require get_theme_file_path( '/inc/customizer/fonts.php' );
require get_theme_file_path( '/inc/customizer/fonts-library.php' );

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_theme_file_path( '/inc/template-functions.php' );

/**
 * SVG icons functions and filters.
 */
require get_theme_file_path( '/inc/icons.php' );

/**
 * Add Widgets.
 */
require get_theme_file_path( '/inc/widgets/widget-flickr.php' );
require get_theme_file_path( '/inc/widgets/widget-portfolio-menu.php' );

/**
 * Admin specific functions.
 */
require get_parent_theme_file_path( '/inc/admin/init.php' );

/**
 * Disable Merlin WP.
 */
function themebeans_merlin() {}
