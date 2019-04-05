<?php
/**
 * The file is for displaying the portfolio grid after single post content (pages and posts).
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

/**
 * Retrieve a modification setting for the Charmed portfolio loop.
 *
 * @link https://codex.wordpress.org/Function_Reference/get_theme_mod
 */

if ( get_theme_mod( 'portfolio_loop' ) === true && is_singular( 'portfolio' ) || get_theme_mod( 'portfolio_loop_pages' ) === true && is_singular( 'page' ) ) : ?>

	<div class="bricks">
		<?php

		/**
		 * Check what post type we are using.
		 * This is important because Charmed works with both 'post' and 'portfolio' post types.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/get_post_type
		 */

		if ( 'post' === get_post_type() ) {
			$post_type = 'post';
		} else {
			$post_type = 'portfolio';
		}

		$args = array(
			'post_type'      => $post_type,
			'orderby'        => 'rand',
			'order'          => 'ASC',
			'posts_per_page' => '14',
			'post__not_in'   => array( $post->ID ),
		);

		$wp_query = new WP_Query( $args );

		if ( $wp_query->have_posts() ) :

			// Start the loop.
			while ( $wp_query->have_posts() ) :
				$wp_query->the_post();

				if ( has_post_thumbnail() ) :

					// Retrieve the portfolio loop (which works on 'post' types as well).
					get_template_part( 'template-parts/portfolio-loop' );

				endif;

			endwhile;

		endif;

		wp_reset_postdata();
		wp_reset_query();
		?>

	</div>

<?php endif; ?>
