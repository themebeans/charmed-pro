<?php
/**
 * The header for our theme.
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php charmed_body_data(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
<div id="page" class="hfeed site page-container clearfix">

<?php
// Don't render the header on the 404 page.
if ( is_404() ) {
	return;
}
?>

<header id="masthead" class="site-header header brick" data-views="99999999999999999999" data-date="<?php echo esc_attr( date( 'YndHis' ) ); ?>">

	<div class="inner">

		<?php
		charmed_site_logo();

		charmed_site_description();
		?>

		<?php if ( has_nav_menu( 'primary' ) ) : ?>

			<nav id="site-navigation" class="main-navigation nav primary">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_class'     => 'primary-menu',
						'depth'          => '1',
					)
				);
				?>
			</nav>

			<?php if ( ! is_singular( 'post' ) && ! is_singular( 'portfolio' ) ) { ?>
				<a id="nav-btn" class="mobile-menu-toggle" href="javascript:void(0);">
					<span><?php echo esc_html( apply_filters( 'charmed_pro_mobile_menu_text', esc_html__( 'Mobile Menu', 'charmed-pro' ) ) ); ?></span>
				</a>
			<?php } ?>

		<?php endif; ?>

		<?php charmed_social_navigation(); ?>

		<?php
		if ( charmed_is_frontpage() || ( is_home() && is_front_page() ) || is_page_template( 'template-portfolio.php' ) ) {
			get_template_part( 'template-parts/portfolio-filter' );
		}

		// Output the following to the singular formats, except pages.
		if ( is_singular( 'post' ) || is_singular( 'portfolio' ) ) {

			if ( have_posts() ) :

				while ( have_posts() ) :

					the_post();
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'post--wrapper' ); ?>>

						<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

						<?php
						// Check if Beaver Builder exsists.
						if ( class_exists( 'FLBuilder' ) ) {
							// Check if Beaver Builder is not active.
							if ( ! FLBuilderModel::is_builder_enabled() ) {
								the_content();
							} else {
								the_excerpt();
							}
						} else {
							the_content();
						}
						?>

						<?php get_template_part( 'template-parts/portfolio-meta' ); ?>

						<?php get_template_part( 'template-parts/portfolio-sharing' ); ?>

					</article>

				<?php
				endwhile;

			endif;

		} else {
			if ( ! charmed_is_frontpage() ) {
				get_sidebar();
			}
		}
		?>

		<div class="site-footer">

			<?php $visibility = ( false === get_theme_mod( 'copyright_text_display' ) ) ? 'hidden' : ''; ?>

			<?php if ( get_theme_mod( 'copyright_text_display' ) || is_customize_preview() ) : ?>
				<span class="copyright <?php echo esc_attr( $visibility ); ?>">
					<?php echo wp_kses_post( get_theme_mod( 'copyright_text' ) ); ?>
				</span>
			<?php endif; ?>

			<?php $visibility = ( false === get_theme_mod( 'powered_by_charmed' ) ) ? 'hidden' : ''; ?>

			<a href="https://themebeans.com/themes/charmed-pro/" class="powered-by-charmed <?php echo esc_attr( $visibility ); ?>"><?php printf( esc_html__( 'Powered by %s', 'charmed-pro' ), 'Charmed' ); ?></a>

			<?php $visibility = ( false === get_theme_mod( 'powered_by_wordpress' ) ) ? 'hidden' : ''; ?>

			<?php /* translators: Theme Name */ ?>
			<a href="http://wordpress.org/" class="powered-by-wordpress <?php echo esc_attr( $visibility ); ?>"><?php printf( __( 'A %s run site. Nice.', 'charmed-pro' ), 'WordPress' ); ?></a>

		</div>

	</div>

</header>

<div class="brick-fullwidth animsition brick">
