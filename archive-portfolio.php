<?php
/**
 * The template for displaying portfolio archives
 *
 * Used to display archive-type pages for portfolio posts.
 * If you'd like to further customize these taxonomy views, you may create a
 * new template file for each specific one.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

get_header(); ?>

<div class="bricks">

	<?php

	$portfolio_posts_count = get_theme_mod( 'portfolio_posts_count' );

	$paged = 1;
	if ( get_query_var( 'paged' ) ) {
		$paged = get_query_var( 'paged' );
	}

	if ( get_query_var( 'page' ) ) {
		$paged = get_query_var( 'page' );
	}

	do_action( 'charmed_before_portfolio' );

	$args = array(
		'post_type'      => 'portfolio',
		'paged'          => $paged,
		'posts_per_page' => $portfolio_posts_count,
	);

	$wp_query = new WP_Query( apply_filters( 'charmed_portfolio_args', $args ) );

	if ( $wp_query->have_posts() ) :

		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();

			get_template_part( 'template-parts/portfolio-loop' );

		endwhile;

	endif;

	wp_reset_postdata();

	do_action( 'charmed_after_portfolio' );
	?>

	<div id="page_nav">
		<?php next_posts_link(); ?>
	</div>

</div>

<?php
get_footer();
