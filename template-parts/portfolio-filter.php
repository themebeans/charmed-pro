<?php
/**
 * The file for displaying the more portfolio page filter.
 * It is called via the header.php.
 *
 * @subpackage Charmed
 */

/**
 * Loop Variables
 */
if ( 'post' === get_post_type() ) {
	$loop_terms = 'category';
} else {
	$loop_terms = 'portfolio_category';
} ?>

<?php if ( get_theme_mod( 'portfolio_filtering' ) || get_theme_mod( 'portfolio_sorting' ) || is_customize_preview() ) : ?>

<div class="project-filter hide-on-mobile">

	<?php if ( get_theme_mod( 'portfolio_filtering' ) || is_customize_preview() ) : ?>

		<?php $visibility = ( false === get_theme_mod( 'portfolio_filtering', true ) ) ? 'hidden' : ''; ?>

		<div class="filter-wrapper <?php echo esc_html( $visibility ); ?>">

			<h6 class="widget-title">
				<?php echo esc_html( apply_filters( 'charmed_filter_header', esc_html__( 'Tags:', 'charmed-pro' ) ) ); ?>
			</h6>

			<ul class="filter-group">

				<li><a href="javascript:void(0);" id="filter-close" class="active" data-filter="*"><?php echo esc_html__( 'All', 'charmed-pro' ); ?></a></li>

				<?php
				$terms = get_terms( $loop_terms );
				foreach ( $terms as $term_item ) {
					echo balanceTags( '<li><a href="javascript:void(0);" data-filter=".' . esc_attr( $term_item->term_id ) . '">' . esc_html( $term_item->name ) . '</a></li>' );
				}
				?>

			</ul><!-- END .filter-group -->

		</div>

	<?php endif; ?>

	<?php if ( get_theme_mod( 'portfolio_sorting' ) || is_customize_preview() ) : ?>

		<?php $visibility = ( false === get_theme_mod( 'portfolio_sorting', true ) ) ? 'hidden' : ''; ?>

		<div class="sort-wrapper <?php echo esc_attr( $visibility ); ?>">

			<h6 class="widget-title">
				<?php echo esc_html( apply_filters( 'charmed_sort_header', esc_html__( 'Sort by:', 'charmed-pro' ) ) ); ?>
			</h6>

			<ul class="sort-group">

				<li><a href="javascript:void(0);" class="shuffle-btn"><?php esc_html_e( 'Random', 'charmed-pro' ); ?></a></li>
				<li><a href="javascript:void(0);" data-sort-by="views"><?php esc_html_e( 'Popularity', 'charmed-pro' ); ?></a></li>
				<li><a href="javascript:void(0);" data-sort-by="date"><?php esc_html_e( 'Date', 'charmed-pro' ); ?></a></li>

			</ul><!-- END .sort-group -->

		</div>

	<?php endif; ?>

</div>

<?php endif; ?>
