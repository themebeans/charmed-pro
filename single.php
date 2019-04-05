<?php
/**
 * The template for displaying all pages, single posts and attachments
 *
 * This is a new template file that WordPress introduced in
 * version 4.3. Note that it uses conditional logic to display
 * different content based on the post type.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

get_header(); ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) :

			the_post();

			// Include the single post and single portfolio content template.
			get_template_part( 'template-parts/content', 'single' );

		endwhile;

		// Include the single portfolio and post more loop.
		if ( get_theme_mod( 'portfolio_loop', true ) === true ) {
			get_template_part( 'template-parts/portfolio', 'more' );
		}
		?>

	</main>

</div>

<?php
get_footer();
