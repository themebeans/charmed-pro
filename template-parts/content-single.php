<?php
/**
 * The file for displaying the portfolio meta.
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

// Log the view counts.
charmed_set_post_views( get_the_ID() );

// Let's check if Beaver Builder is active.
if ( class_exists( 'FLBuilder' ) && FLBuilderModel::is_builder_enabled() ) { ?>
	<div class="site-content--fullwidth site-content--beaver-builder">
		<?php the_content(); ?>
	</div>
<?php
} else {
	// Load the gallery media element, located in inc/template-tags.php.
	charmed_gallery( $post->ID, 'port-full', 'portfolio-single', '', true );
}
