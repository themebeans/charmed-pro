<?php
/**
 * The front page template file.
 *
 * If the user has selected a static page for their homepage, this is what will appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

get_header();

get_template_part( 'template-parts/portfolio' );

get_footer();
