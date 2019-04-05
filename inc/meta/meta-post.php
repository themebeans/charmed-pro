<?php
/**
 * The file is for creating the portfolio post type meta.
 * Meta output is defined on the portfolio single editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */
function bean_metabox_post() {

	$prefix = '_bean_';

	$meta_box = array(
		'id'       => 'portfolio-type',
		'title'    => esc_html__( 'Portfolio Format', 'charmed-pro' ),
		'page'     => 'post',
		'context'  => 'side',
		'priority' => 'core',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Gallery', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_type_gallery',
				'type' => 'checkbox',
				'desc' => '',
				'std'  => true,
			),
			array(
				'name' => esc_html__( 'Video', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_type_video',
				'type' => 'checkbox',
				'desc' => '',
				'std'  => false,
			),
		),
	);

	charmed_add_meta_box( $meta_box );

	$meta_box = array(
		'id'       => 'portfolio-meta',
		'title'    => esc_html__( 'Portfolio Settings', 'charmed-pro' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Gallery Images:', 'charmed-pro' ),
				'desc' => esc_html__( 'Upload, reorder and caption the post gallery . ', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_upload_images',
				'type' => 'images',
				'std'  => esc_html__( 'Browse & Upload', 'charmed-pro' ),
			),
			array(
				'name' => esc_html__( 'Description:', 'charmed-pro' ),
				'desc' => '',
				'id'   => $prefix . 'portfolio_desc',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Date:', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_date',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Display the date . ', 'charmed-pro' ),
				'std'  => false,
			),
			array(
				'name' => esc_html__( 'Views:', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_views',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Display the view count . ', 'charmed-pro' ),
				'std'  => false,
			),
			array(
				'name' => esc_html__( 'Categories:', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_cats',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Display the portfolio categories . ', 'charmed-pro' ),
				'std'  => false,
			),
			array(
				'name' => esc_html__( 'Tags:', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_tags',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Display the portfolio tags . ', 'charmed-pro' ),
				'std'  => false,
			),
			array(
				'name' => esc_html__( 'Role:', 'charmed-pro' ),
				'desc' => esc_html__( 'Display the role . ', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_role',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Client:', 'charmed-pro' ),
				'desc' => esc_html__( 'Display the client meta . ', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_client',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'URL:', 'charmed-pro' ),
				'desc' => esc_html__( 'Display a URL to link to . ', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_url',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'External URL:', 'charmed-pro' ),
				'desc' => esc_html__( 'Link this portfolio post to an external URL. For example, link this post to your Behance portfolio post . ', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_external_url',
				'type' => 'text',
				'std'  => '',
			),
		),
	);
	charmed_add_meta_box( $meta_box );

	/*
	 *  VIDEO POST FORMAT SETTINGS
	 */
	$meta_box = array(
		'id'       => 'bean-meta-box-portfolio-video',
		'title'    => esc_html__( 'Video Settings', 'charmed-pro' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Lightbox Embed URL:', 'charmed-pro' ),
				'desc' => esc_html__( 'Insert your embeded URL to play in the blogroll grid pages . ', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_embed_url',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Embed 1:', 'charmed-pro' ),
				'desc' => esc_html__( 'Insert your embeded code here . ', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_embed_code',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Embed 2:', 'charmed-pro' ),
				'desc' => esc_html__( 'Insert your embeded code here . ', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_embed_code_2',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Embed 3:', 'charmed-pro' ),
				'desc' => esc_html__( 'Insert your embeded code here . ', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_embed_code_3',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Embed 4:', 'charmed-pro' ),
				'desc' => esc_html__( 'Insert your embeded code here . ', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_embed_code_4',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Video Shortcodes:', 'charmed-pro' ),
				'desc' => esc_html__( 'Insert any video shortcodes here . ', 'charmed-pro' ),
				'id'   => $prefix . 'portfolio_video_shortcodes',
				'type' => 'textarea',
				'std'  => '',
			),
		),

	);
	charmed_add_meta_box( $meta_box );
}
add_action( 'add_meta_boxes', 'bean_metabox_post' );
