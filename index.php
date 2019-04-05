<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

get_header(); ?>

<div class="bricks">

	<?php
	if ( have_posts() ) :

		// Start the loop.
		while ( have_posts() ) :
			the_post();

			if ( has_post_thumbnail() ) :

				get_template_part( 'template-parts/portfolio-loop' );

			endif;

		endwhile;

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
	?>

	<div id="page_nav">
		<?php next_posts_link(); ?>
	</div>

</div><!-- .bricks -->

<?php get_footer(); ?>
