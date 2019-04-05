<?php
/**
 * The template for displaying posts in the standard post format.
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

?>
<div class="bricks">

	<?php
	if ( is_archive( 'post' ) || is_category() || is_tag() ) {
		$post_type = 'post';
	} else {
		$post_type = 'portfolio';
	}

	$portfolio_posts_count = get_theme_mod( 'portfolio_posts_count' );

	$paged = 1;
	if ( get_query_var( 'paged' ) ) {
		$paged = get_query_var( 'paged' );
	}

	if ( get_query_var( 'page' ) ) {
		$paged = get_query_var( 'page' );
	}

	if ( is_tax() ) {

		global $query_string;

		query_posts( "{$query_string}&posts_per_page=-1" );

		if ( have_posts() ) :

			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/portfolio-loop' );

			endwhile;

		endif;

		wp_reset_postdata();

	} else {

		do_action( 'charmed_before_portfolio' );

		$args = array(
			'post_type'      => $post_type,
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

	}
	?>

	<div id="page_nav">
		<?php next_posts_link(); ?>
	</div>

</div>
