<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

if ( ! function_exists( 'charmed_social_navigation' ) ) :
	/**
	 * Output the social menu.
	 * Checks if the social navigation is added.
	 */
	function charmed_social_navigation() {
		/*
		 * Check if a social menu is added.
		 */
		if ( has_nav_menu( 'social' ) ) : ?>

			<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Menu', 'charmed-pro' ); ?>">

				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'social',
							'menu_class'     => 'social-links-menu',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>' . charmed_get_svg( array( 'icon' => 'chain' ) ),
						)
					);
				?>

			</nav><!-- .social-navigation -->

		<?php
		endif;
	}
endif;

if ( ! function_exists( 'charmed_site_logo' ) ) :
	/**
	 * Output an <img> tag of the site logo.
	 */
	function charmed_site_logo() {

		$visibility = ( has_custom_logo() ) ? ' hidden' : null;

		do_action( 'charmed_before_site_logo' );

		the_custom_logo();

		if ( ! has_custom_logo() || is_customize_preview() ) {
			printf( '<h1 class="h3 site-title site-logo %1$s" itemscope itemtype="http://schema.org/Organization"><a href="%2$s" rel="home" itemprop="url" class="black">%3$s</a></h1>', esc_attr( $visibility ), esc_url( home_url( '/' ) ), esc_html( get_bloginfo( 'name' ) ) );

		}

		do_action( 'charmed_after_site_logo' );
	}

endif;

if ( ! function_exists( 'charmed_site_description' ) ) :
	/**
	 * Output the site description.
	 */
	function charmed_site_description() {

		$description = get_bloginfo( 'description', 'display' );

		$allowed_html = array(
			'a' => array(
				'alt'    => array(),
				'href'   => array(),
				'target' => array(),
			),
		);

		if ( $description || is_customize_preview() ) {
			printf( '<p class="site-description">%1$s</p>', wp_kses( $description, $allowed_html ) );
		}
	}

endif;

if ( ! function_exists( 'charmed_portfolio_thumb' ) ) :
	/**
	 * Utilizes picturefill.js to serve specific image assets where it makes sense to.
	 * Create your own themebeans_picturefill() to override in a child theme.
	 *
	 * @param string|int $post_id The post id.
	 */
	function charmed_portfolio_thumb( $post_id ) {

		$img_sml = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'port-grid' );
		$img_med = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'port-grid@2x' );
		$img_lrg = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'page-feat' );
		$img_xlg = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'page-feat' );

		/* You define this doing height / width * 100% */
		$intrinsic = charmed_get_percentage( $img_sml[1], $img_sml[2] ) . '%';

		/*
		 * Output.
		 */
		printf(
			'
			<span class="project-img">
				<div class="intrinsic" style="padding-top: %10$s ">
					<img
					src="%5$s"
					data-original="%5$s"
					data-original-set="%1$s %2$sw, %3$s %4$sw, %5$s %6$sw, %7$s %8$sw"
					srcset="%1$s %2$sw, %3$s %4$sw, %5$s %6$sw, %7$s %8$sw"
					sizes="(min-width: 300px) 90vw, (min-width: 649px) 40vw, (min-width: 769px) 60vw, (min-width: 900px) 20vw, 100vw"
					alt="%9$s"
					class="lazyload"
					>
				</div>
			</span>',
			esc_url( $img_sml[0] ),
			esc_attr( $img_sml[1] ),
			esc_url( $img_med[0] ),
			esc_attr( $img_med[1] ),
			esc_url( $img_lrg[0] ),
			esc_attr( $img_lrg[1] ),
			esc_url( $img_xlg[0] ),
			esc_attr( $img_xlg[1] ),
			esc_attr( get_the_title( $post_id ) ),
			esc_attr( $intrinsic )
		);

	}
endif;

if ( ! function_exists( 'charmed_article_background' ) ) :
	/**
	 * Return the background image.
	 *
	 * Checks if a featured image is uploaded and creates a background image CSS rule
	 * Create your own charmed_article_background() to override in a child theme.
	 *
	 * @param string|int $post_id The post id.
	 *
	 * @see https://codex.wordpress.org/Function_Reference/wp_get_attachment_url
	 * @see https://codex.wordpress.org/Function_Reference/get_post_thumbnail_id
	 * @see https://codex.wordpress.org/Function_Reference/has_post_thumbnail
	 */
	function charmed_article_background( $post_id ) {
		global $post;

		if ( class_exists( 'MultiPostThumbnails' ) ) :

			if ( MultiPostThumbnails::has_post_thumbnail( 'portfolio', 'hover-image' ) ) {
				$feat_image = MultiPostThumbnails::get_post_thumbnail_url( get_post_type(), 'hover-image', $post_id, 'port-grid' );
				$feat_image = 'background-image: url(' . esc_url( $feat_image ) . ');';
				$feat_image = '<div class="thumb thumb--second lazyload" style=" ' . esc_html( $feat_image ) . ' "></div>';
				return $feat_image;
			} else {
				$feat_image = 'background-image: url(' . charmed_gallery_first_image( $post->ID ) . ');';
				$feat_image = '<div class="thumb thumb--second lazyload" style="' . esc_html( $feat_image ) . '"></div>';
				return $feat_image;
			} else :
				$feat_image = 'background-image: url(' . charmed_gallery_first_image( $post->ID ) . ');';
				$feat_image = '<div class="thumb thumb--second lazyload" style="' . esc_html( $feat_image ) . '"></div>';
				return $feat_image;
		endif;
	}
endif;

if ( ! function_exists( 'charmed_portfolio_tags' ) ) :
	/**
	 * Create your own charmed_portfolio_tags() to override in a child theme.
	 */
	function charmed_portfolio_tags() {
		global $post;

		$terms = wp_get_post_terms( $post->ID, 'portfolio_tag' );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			echo '<div class="project-tags">';
			foreach ( $terms as $term ) {
				echo '<span>#' . $term->name . '</span>';
			}
			echo '</div>';
		}
	}
endif;

if ( ! function_exists( 'charmed_gallery_first_image' ) ) :
	/**
	 * Create your own charmed_gallery_first_image() to override in a child theme.
	 *
	 * @param string|int $postid The post id.
	 */
	function charmed_gallery_first_image( $postid ) {

		global $post;

		$thumb_id      = get_post_thumbnail_id( $postid );
		$image_ids_raw = get_post_meta( $postid, '_bean_image_ids', true );

		if ( '' !== $image_ids_raw ) {
			$image_ids   = explode( ',', $image_ids_raw );
			$post_parent = null;
		} else {
			$image_ids   = '';
			$post_parent = $postid;
		}

		$args = array(
			'exclude'        => $thumb_id,
			'include'        => $image_ids,
			'numberposts'    => 1,
			'orderby'        => 'post__in',
			'order'          => 'DESC',
			'post_type'      => 'attachment',
			'post_parent'    => $post_parent,
			'post_mime_type' => 'image',
			'post_status'    => null,
		);

		$attachments = get_posts( $args );

		if ( ! empty( $attachments ) ) {

			foreach ( $attachments as $attachment ) {

				$src = wp_get_attachment_image_src( $attachment->ID, 'port-grid' );

				$first_image = $src[0];

			}

			return $first_image;

		}
	}
endif;

if ( ! function_exists( 'charmed_gallery' ) ) :
	/**
	 * Return the portfolio and post galleries.
	 * Checks if there are images uploaded to the post or portfolio post and outputs them.
	 * Create your own charmed_gallery() to override in a child theme.
	 *
	 * @param int     $postid Post ID.
	 * @param string  $imagesize Post Image Size.
	 * @param string  $layout Post Layout.
	 * @param string  $orderby Post Order By.
	 * @param boolean $single If Single Post.
	 */
	function charmed_gallery( $postid, $imagesize = '', $layout = '', $orderby = '', $single = false ) {
		$thumb_id      = get_post_thumbnail_id( $postid );
		$image_ids_raw = get_post_meta( $postid, '_bean_image_ids', true );
		// Post meta.
		$embed            = get_post_meta( $postid, '_bean_portfolio_embed_code', true );
		$embed2           = get_post_meta( $postid, '_bean_portfolio_embed_code_2', true );
		$embed3           = get_post_meta( $postid, '_bean_portfolio_embed_code_3', true );
		$embed4           = get_post_meta( $postid, '_bean_portfolio_embed_code_4', true );
		$video_shortcodes = get_post_meta( $postid, '_bean_portfolio_video_shortcodes', true );
		wp_reset_postdata();
		if ( '' !== $image_ids_raw ) {
			$image_ids   = explode( ',', $image_ids_raw );
			$post_parent = null;
		} else {
			$image_ids   = '';
			$post_parent = $postid;
		}
		$i = 1;
		// Pull in the image assets.
		$args        = array(
			'exclude'        => $thumb_id,
			'include'        => $image_ids,
			'numberposts'    => -1,
			'orderby'        => 'post__in',
			'order'          => 'ASC',
			'post_type'      => 'attachment',
			'post_parent'    => $post_parent,
			'post_mime_type' => 'image',
			'post_status'    => null,
		);
		$attachments = get_posts( $args );
		?>

		<div class="project-assets">
			<?php
			if ( ! post_password_required() ) {
				if ( $embed ) {
					echo '<figure class="video-frame">';
						echo stripslashes( htmlspecialchars_decode( $embed ) );
					echo '</figure>';
				}
				if ( $embed2 ) {
					echo '<figure class="video-frame">';
						echo stripslashes( htmlspecialchars_decode( $embed2 ) );
					echo '</figure>';
				}
				if ( $embed3 ) {
					echo '<figure class="video-frame">';
						echo stripslashes( htmlspecialchars_decode( $embed3 ) );
					echo '</figure>';
				}
				if ( $embed4 ) {
					echo '<figure class="video-frame">';
						echo stripslashes( htmlspecialchars_decode( $embed4 ) );
					echo '</figure>';
				}
				if ( $video_shortcodes ) {
					echo '<figure class="video-frame">';
						echo do_shortcode( $video_shortcodes );
					echo '</figure>';
				}
			}
			?>


			<div id="project-assets-<?php echo esc_attr( $postid ); ?>" itemscope itemtype="http://schema.org/ImageGallery">

				<?php
				if ( ! empty( $attachments ) ) {
					if ( ! post_password_required() ) {
						foreach ( $attachments as $attachment ) {
							$caption       = $attachment->post_excerpt;
							$caption       = ( $caption ) ? "$caption" : '';
							$alt           = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
							$src           = wp_get_attachment_image_src( $attachment->ID, $imagesize );
							$caption_style = ( false === get_theme_mod( 'portfolio_caption-style', true ) ) ? '' : 'caption--lrg';
							// Image sizes.
							$img_sml = wp_get_attachment_image_src( $attachment->ID, 'port-grid' );
							$img_med = wp_get_attachment_image_src( $attachment->ID, 'port-grid@2x' );
							$img_lrg = wp_get_attachment_image_src( $attachment->ID, 'port-grid-mobile' );
							$img_xlg = wp_get_attachment_image_src( $attachment->ID, 'liam-portfolio-loop-xlg' );
							// Defined by height / width * 100%.
							$intrinsic = charmed_get_percentage( $img_sml[1], $img_sml[2] ) . '%';

							$allowed_html = array(
								'a' => array(
									'alt'    => array(),
									'href'   => array(),
									'target' => array(),
								),
							);
							?>

							<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="wow moveInUp position--relative" style="max-width: <?php echo esc_attr( $img_xlg[1] ) . 'px'; ?>">

								<?php
								if ( get_theme_mod( 'portfolio_lightbox' ) === true ) {
									echo '<a href="' . esc_url( $src[0] ) . '" class="lightbox-link" title="' . esc_attr( $caption ) . '" alt="' . esc_attr( $alt ) . '" itemprop="contentUrl" data-size="' . esc_attr( $src[1] ) . 'x' . esc_attr( $src[2] ) . '">';
								}
								printf(
									'
									<img
									data-original="%5$s"
									data-original-set="%1$s %2$sw, %3$s %4$sw, %5$s %6$sw, %7$s %8$sw"
									srcset="%1$s %2$sw, %3$s %4$sw, %5$s %6$sw, %7$s %8$sw"
									sizes="(min-width: 300px) 90vw, (min-width: 1024px) 70vw, (min-width: 1500px) 80vw, 100vw"
									class=""
									>',
									esc_url( $img_sml[0] ),
									esc_attr( $img_sml[1] ),
									esc_url( $img_med[0] ),
									esc_attr( $img_med[1] ),
									esc_url( $img_lrg[0] ),
									esc_attr( $img_lrg[1] ),
									esc_url( $img_xlg[0] ),
									esc_attr( $img_xlg[1] ),
									esc_attr( $caption ),
									esc_attr( $intrinsic )
								);
								if ( get_theme_mod( 'portfolio_lightbox' ) === true ) {
									echo '</a>'; }
								if ( $caption ) {
									echo '<div class="project-caption ' . esc_attr( $caption_style ) . '">' . wp_kses( $caption, $allowed_html ) . '</div>'; }
								?>

							</figure>

							<?php
						}
					}
				}
				?>

			</div>

		</div>
	<?php
	}
endif;

/**
 * Returns a cmb2 file_list
 *
 * @param  string|string $meta_key The field meta key. ($prefix . 'file_list').
 * @param  string|string $img_size           Size of image to show.
 * @return string                      The html markup for the images.
 */
function charmed_cmb2_gallery( $meta_key, $img_size = 'large' ) {

	// Return early if a password is required.
	if ( post_password_required() ) {
		return;
	}

	// Post ID.
	$id = get_the_ID();

	$embed            = get_post_meta( $id, '_bean_portfolio_embed_code', true );
	$embed2           = get_post_meta( $id, '_bean_portfolio_embed_code_2', true );
	$embed3           = get_post_meta( $id, '_bean_portfolio_embed_code_3', true );
	$embed4           = get_post_meta( $id, '_bean_portfolio_embed_code_4', true );
	$video_shortcodes = get_post_meta( $id, '_bean_portfolio_video_shortcodes', true );

	echo '<div class="project-assets">';

	if ( $embed ) {
		echo '<figure class="video-frame">';
			echo stripslashes( htmlspecialchars_decode( $embed ) );
		echo '</figure>';
	}

	if ( $embed2 ) {
		echo '<figure class="video-frame">';
			echo stripslashes( htmlspecialchars_decode( $embed2 ) );
		echo '</figure>';
	}

	if ( $embed3 ) {
		echo '<figure class="video-frame">';
			echo stripslashes( htmlspecialchars_decode( $embed3 ) );
		echo '</figure>';
	}

	if ( $embed4 ) {
		echo '<figure class="video-frame">';
			echo stripslashes( htmlspecialchars_decode( $embed4 ) );
		echo '</figure>';
	}

	if ( $video_shortcodes ) {
		echo '<figure class="video-frame">';
			echo do_shortcode( $video_shortcodes );
		echo '</figure>';
	}

	// Get the gallery images.
	$files  = get_post_meta( $id, $meta_key, 1 );
	$images = '';

	// Loop through each gallery item and output.
	foreach ( (array) $files as $attachment_id => $attachment_url ) {

		// Image sizes.
		$img_sml = wp_get_attachment_image_src( $attachment_id, 'port-grid' );
		$img_med = wp_get_attachment_image_src( $attachment_id, 'port-grid@2x' );
		$img_lrg = wp_get_attachment_image_src( $attachment_id, 'port-grid-mobile' );
		$img_xlg = wp_get_attachment_image_src( $attachment_id, 'liam-portfolio-loop-xlg' );

		// Captions.
		$caption        = wptexturize( get_post_field( 'post_excerpt', $attachment_id ) );
		$caption        = ( $caption ) ? "$caption" : null;
		$caption_style  = ( true === get_theme_mod( 'portfolio_caption-style', true ) ) ? 'caption--lrg' : null;
		$caption_output = ( $caption ) ? '<div class="project-caption ' . esc_attr( $caption_style ) . '"> ' . htmlspecialchars( $caption ) . ' </div>' : null;

		// Image alt text.
		$alt = ( get_post_field( 'post_content', $attachment_id ) ) ? wptexturize( get_post_field( 'post_content', $attachment_id ) ) : wptexturize( get_post_field( 'post_title', $attachment_id ) );

		// Defined by height / width * 100%.
		$intrinsic = charmed_get_percentage( $img_sml[1], $img_sml[2] ) . '%';

		// Check for lightbox support.
		$lightbox     = ( true === get_theme_mod( 'portfolio_lightbox', true ) ) ? '<a href="' . esc_url( $img_xlg[0] ) . '" class="lightbox-link" title="' . esc_attr( $caption ) . '" alt="' . esc_attr( $alt ) . '" itemprop="contentUrl" data-size="' . esc_attr( $img_xlg[1] ) . 'x' . esc_attr( $img_xlg[2] ) . '">' : null;
		$lightbox_end = ( true === get_theme_mod( 'portfolio_lightbox', true ) ) ? '</a>' : null;

		$images                 .= '<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="wow moveInUp position--relative" style="max-width: ' . esc_attr( $img_xlg[1] ) . 'px">';
			$images             .= $lightbox;
						$images .= sprintf(
							'
							<img data-original="%5$s"
							data-original-set="%1$s %2$sw, %3$s %4$sw, %5$s %6$sw, %7$s %8$sw"
							srcset="%1$s %2$sw, %3$s %4$sw, %5$s %6$sw, %7$s %8$sw"
							sizes="(min-width: 300px) 90vw, (min-width: 1024px) 70vw, (min-width: 1500px) 80vw, 100vw">
							',
							esc_url( $img_sml[0] ),
							esc_attr( $img_sml[1] ),
							esc_url( $img_med[0] ),
							esc_attr( $img_med[1] ),
							esc_url( $img_lrg[0] ),
							esc_attr( $img_lrg[1] ),
							esc_url( $img_xlg[0] ),
							esc_attr( $img_xlg[1] ),
							esc_attr( $caption ),
							esc_attr( $intrinsic )
						);
			$images             .= $lightbox_end;
			$images             .= $caption_output;
		$images                 .= '</figure>';
	}

	return $images ? '<div id="project-assets" itemscope itemtype="http://schema.org/ImageGallery">' . $images . '</div>' : '';

	echo '</div>';
}

if ( ! function_exists( 'charmed_site_map' ) ) :
	/**
	 * Prints HTML containing the site map.
	 * This function is currently pulled by content-page.php, which checks if
	 * the Site Map template (template-site-map.php) is in use.
	 * Create your own charmed_site_map() to override in a child theme.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/wp_list_pages
	 */
	function charmed_site_map() {
		if ( is_singular() && 'page' === get_post_type() ) {

			printf( '<ul class="site-archive">' );
				printf( esc_html( wp_list_pages( 'title_li=' ) ) );
			printf( '</ul>' );

		}
	}
endif;

/**
 * Determine whether blog/site has more than one category.
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function charmed_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'charmed_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'charmed_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so charmed_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so charmed_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in { @see charmed_categorized_blog() }.
 */
function charmed_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'charmed_categories' );
}
add_action( 'edit_category', 'charmed_category_transient_flusher' );
add_action( 'save_post', 'charmed_category_transient_flusher' );
