<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #page div and all content after
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

?>
	</div>
</div>

<?php
if ( ! is_404() ) :

	wp_reset_query();

	if ( ! is_singular( 'page' ) ) :

		if ( get_theme_mod( 'portfolio_lightbox', true ) === true ) {
			get_template_part( 'template-parts/photoswipe' );
		}

		if ( get_theme_mod( 'portfolio_cta', true ) === true ) {

			get_template_part( 'template-parts/portfolio-form' );
			?>

			<div class="project-cta">
				<a class="button std no-animiate"><span class="cta-init"><?php echo esc_html( get_theme_mod( 'portfolio_cta_button_text', 'Hire Me' ) ); ?></span><span class="cta-close"><?php esc_html_e( 'Close', 'charmed-pro' ); ?></span></a>
			</div>

		<?php
		}
	endif;

endif;

wp_footer();
?>

</body>
</html>
