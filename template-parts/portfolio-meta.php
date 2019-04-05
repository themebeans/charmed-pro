<?php
/**
 * The file for displaying the portfolio meta.
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the content.
 */
if ( post_password_required() ) {
	return;
}



/*
 * Set variables for the content below.
 */
$portfolio_date      = get_post_meta( $post->ID, '_bean_portfolio_date', true );
$portfolio_client    = get_post_meta( $post->ID, '_bean_portfolio_client', true );
$portfolio_role      = get_post_meta( $post->ID, '_bean_portfolio_role', true );
$portfolio_views     = get_post_meta( $post->ID, '_bean_portfolio_views', true );
$portfolio_cats      = get_post_meta( $post->ID, '_bean_portfolio_cats', true );
$portfolio_tags      = get_post_meta( $post->ID, '_bean_portfolio_tags', true );
$portfolio_url       = get_post_meta( $post->ID, '_bean_portfolio_url', true );
$portfolio_url_clean = str_replace( 'http://', '', $portfolio_url );
$portfolio_url_clean = preg_replace( '/\s+/', '', $portfolio_url_clean );
?>

<div class="project-meta">

	<?php
	if ( 'on' === $portfolio_date ) {
	?>
		<h6 class="published">
			<?php esc_html_e( 'Date: ', 'charmed-pro' ); ?><span><?php the_time( 'M Y' ); ?></span>
		</h6>
	<?php } ?>

	<?php if ( $portfolio_role ) { ?>
		<h6 class="role">
			<?php esc_html_e( 'Role: ', 'charmed-pro' ); ?><span><?php echo esc_html( $portfolio_role ); ?></span>
		</h6>
	<?php } ?>

	<?php if ( $portfolio_client ) { ?>
		<h6 class="client">
			<?php esc_html_e( 'Client: ', 'charmed-pro' ); ?>
			<span>
			<?php if ( $portfolio_url ) { ?>
				<a href="<?php echo esc_url( $portfolio_url ); ?>" target="_blank"><?php echo esc_html( $portfolio_client ); ?></a>
			<?php } else { ?>
				<?php echo esc_html( $portfolio_client ); ?>
			<?php } ?>
			</span>
		</h6>
	<?php } ?>

	<?php if ( $portfolio_url && ! $portfolio_client ) { ?>
		<h6 class="url">
			<?php esc_html_e( 'URL: ', 'charmed-pro' ); ?><span><a href="<?php echo esc_url( $portfolio_url ); ?>" target="_blank"><?php echo esc_html( $portfolio_url_clean ); ?></a></span>
		</h6>
	<?php } ?>

	<?php if ( 'on' === $portfolio_views ) { ?>
		<h6 class="views">
			<?php esc_html_e( 'Views: ', 'charmed-pro' ); ?><span><?php echo esc_html( charmed_get_post_views( get_the_ID() ) ); ?></span>
		</h6>
	<?php } ?>

	<?php do_action( 'portfolio_professional_likes' ); ?>

</div>

<?php if ( 'on' === $portfolio_cats || 'on' === $portfolio_tags ) { ?>

		<div class="project-taxonomy">
			<h6>
				<?php if ( 'on' === $portfolio_cats ) { ?>
					<?php $terms = get_the_terms( $post->ID, 'portfolio_category' ); ?>
					<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
						<?php the_terms( $post->ID, 'portfolio_category', '#', '&nbsp;&nbsp;#', '&nbsp;&nbsp;' ); ?>
					<?php endif; ?>
				<?php } ?>

				<?php if ( 'on' === $portfolio_tags ) { ?>
						<?php the_terms( $post->ID, 'portfolio_tag', '#', '&nbsp;&nbsp;&nbsp;#', '&nbsp;&nbsp;' ); ?>
				<?php } ?>
			</h6>
		</div>

<?php } ?>
