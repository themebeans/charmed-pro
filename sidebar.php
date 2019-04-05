<?php
/**
 * The sidebar containing the main widget area for pages.
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

// If we get this far, we have widgets. Let do this.
if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

	<div id="sidebar" class="widget-area hide-on-mobile">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>

<?php
endif;
