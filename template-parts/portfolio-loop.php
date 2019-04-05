<?php
/**
 * The template for displaying the portfolio loop.
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

/**
 * Loop Variables
 */
if ( 'post' === get_post_type() ) {
	$terms = get_the_terms( $post->ID, 'category' );
} else {
	$terms = get_the_terms( $post->ID, 'portfolio_category' );
}

/**
 * Generate terms for the portfolio filter.
 */
$term_list = null;

if ( is_array( $terms ) ) {
	foreach ( $terms as $term ) {
		$term_list .= $term->term_id;
		$term_list .= ' ';
	}
}

/**
 * Check to see if a featured image is uploaded.
 * There's no point showing an article link, if there's no image.
 */
if ( has_post_thumbnail() ) :

	/**
	 * In the string below we are ouputting the portfolio_category terms (%1$s) for the filter,
	 * the post view count (%2$s) and the post date (%3$s) - both for the filter sorting.
	 */
	printf( '<article class="brick %1$s" data-views="%2$s" data-date="%3$s">', esc_html( $term_list ), esc_html( charmed_get_post_views( get_the_ID() ) ), esc_html( get_the_time( 'YndHis' ) ) );

	/*
	 * Let's check if there's an external url included on the back end.
	 * If there is, that will be assigned as the $portfolio_url variable, if not,
	 * the post permalink will be assigned.
	 */
	$external_url  = get_post_meta( $post->ID, '_bean_portfolio_external_url', true );
	$portfolio_url = ! empty( $external_url ) ? $external_url : get_the_permalink();

	/*
	 * Now let's check if there is an embed url. If so, let's show the "play" icon
	 * and add an lightbox iframe to display the video.
	 */
	$embed_url  = get_post_meta( $post->ID, '_bean_portfolio_embed_url', true );
	$icon       = charmed_get_svg( array( 'icon' => 'play' ) );
	$icon_style = ( get_theme_mod( 'portfolio_white_play_icon' ) ) === true ? 'play--white' : '';

	if ( $embed_url ) :
		printf( '<a href="%s" class="lightbox-link lightbox-play ' . esc_attr( $icon_style ) . '" data-lity>%s</a>', esc_url( $embed_url ), wp_kses( $icon, charmed_svg_allowed_html() ) );
	endif;

	do_action( 'portfolio_professional_pinterest' );

		printf( '<a href="%s" class="brick--link" rel="bookmark">', esc_url( $portfolio_url ) ); ?>

			<div class="thumb">

				<?php

				/*
				 * Call the following function, which is located in template-tags.php
				 * this function pulls in the featured image, which is using Picturefill.js
				 * to output multiple versions that are selectively loaded.
				 */
				echo charmed_portfolio_thumb( get_the_ID() );
				?>

				<div class="overlay-wrap">
					<div class="center">
						<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
						<?php charmed_portfolio_tags(); ?>
					</div>
				</div>

				<?php echo charmed_article_background( get_the_ID() ); ?>

			</div>

		</a>

	</article>

<?php
endif;
