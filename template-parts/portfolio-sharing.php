<?php
/**
 * The file is for displaying the portfolio sharing feature.
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

/**
 * Retrieve a modification setting for the Charmed portfolio loop.
 *
 * @link https://codex.wordpress.org/Function_Reference/get_theme_mod
 */

if ( get_theme_mod( 'portfolio_social' ) || is_customize_preview() ) :

	/**
	 * Only display if the option is selected in the Customizer.
	 */
	$visibility = ( false === get_theme_mod( 'portfolio_social' ) ) ? ' hidden ' : ''; ?>

	<div class="portfolio-sharing <?php esc_attr( $visibility ); ?>">

		<h6><?php echo esc_html( apply_filters( 'charmed_share_header', esc_html__( 'Share:', 'charmed-pro' ) ) ); ?></h6>

		<div class="portfolio-sharing--wrapper">
			<div class="svg__wrapper svg__facebook-share">
				<a class="pulse-active" target="_blank" onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php the_title(); ?>&amp;p[summary]=&amp;p[url]=<?php the_permalink(); ?>&amp;&amp;p[images][0]=','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)">
					<?php echo wp_kses( charmed_get_svg( array( 'icon' => 'facebook-share' ) ), charmed_svg_allowed_html() ); ?>
				</a>
			</div>

			<div class="svg__wrapper svg__twitter-share">
				<?php
				/**
				 * Get the Twitter username from the Customizer.
				 * Then remove the "@", if there is one.
				 */
				$twitter_username = get_theme_mod( 'twitter_username' );
				$twitter_username = str_replace( '@', '', $twitter_username );
				if ( $twitter_username ) {
					$twitter_username = '&via=' . $twitter_username . '';
				}
				?>

				<a class="pulse-active" href="http://twitter.com/share?text=&#34;<?php the_title(); ?>&#34;&url=<?php get_the_permalink(); ?><?php echo esc_attr( $twitter_username ); ?>" target="_blank">
					<?php echo wp_kses( charmed_get_svg( array( 'icon' => 'twitter-share' ) ), charmed_svg_allowed_html() ); ?>
				</a>
			</div>
		</div>

	</div>

<?php endif; ?>
