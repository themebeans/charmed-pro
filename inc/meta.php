<?php
/**
 * The file is for creating the portfolio post type meta.
 * Meta output is defined on the portfolio single editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Charmed Pro
 * @link        https://themebeans.com/themes/charmed-pro
 */

/**
 * Portfolio Type metabox.
 */
function charmed_portfolio_type_metabox() {

	// Start with an underscore to hide fields from custom fields list.
	$prefix = '_bean_';

	/**
	 * Initiate the metabox.
	 */
	$portfolio_type = new_cmb2_box(
		array(
			'id'           => 'portfolio_type',
			'title'        => esc_html__( 'Portfolio Format', 'charmed-pro' ),
			'object_types' => array( 'portfolio', 'post' ),
			'context'      => 'side',
			'priority'     => 'high',
		)
	);

	$portfolio_type->add_field(
		array(
			'name' => esc_html__( 'Gallery', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_type_gallery',
			'type' => 'checkbox',
		)
	);

	$portfolio_type->add_field(
		array(
			'name' => esc_html__( 'Video', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_type_video',
			'type' => 'checkbox',
		)
	);
}
add_action( 'cmb2_admin_init', 'charmed_portfolio_type_metabox' );

/**
 * Portfolio Settings metabox.
 */
function charmed_portfolio_settings_metabox() {

	// Start with an underscore to hide fields from custom fields list.
	$prefix = '_bean_';

	/**
	 * Initiate the metabox.
	 */
	$portfolio_settings = new_cmb2_box(
		array(
			'id'           => 'portfolio_settings',
			'title'        => esc_html__( 'Portfolio Settings', 'charmed-pro' ),
			'object_types' => array( 'portfolio', 'post' ),
			'context'      => 'normal',
			'priority'     => 'high',
		)
	);

	$portfolio_settings->add_field(
		array(
			'name' => esc_html__( 'Gallery', 'charmed-pro' ),
			'desc' => esc_html__( 'Upload, reorder and caption the post gallery.', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_upload_images',
			'type' => 'file_list',
		)
	);

	$portfolio_settings->add_field(
		array(
			'name' => esc_html__( 'Date', 'charmed-pro' ),
			'desc' => esc_html__( 'Display the date.', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_date',
			'type' => 'checkbox',
		)
	);

	$portfolio_settings->add_field(
		array(
			'name' => esc_html__( 'Views', 'charmed-pro' ),
			'desc' => esc_html__( 'Display views.', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_views',
			'type' => 'checkbox',
		)
	);

	$portfolio_settings->add_field(
		array(
			'name' => esc_html__( 'Categories', 'charmed-pro' ),
			'desc' => esc_html__( 'Display portfolio categories.', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_cats',
			'type' => 'checkbox',
		)
	);

	$portfolio_settings->add_field(
		array(
			'name' => esc_html__( 'Tags', 'charmed-pro' ),
			'desc' => esc_html__( 'Display portfolio tags.', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_tags',
			'type' => 'checkbox',
		)
	);

	$portfolio_settings->add_field(
		array(
			'name' => esc_html__( 'Role', 'charmed-pro' ),
			'desc' => esc_html__( 'What was your role?', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_role',
			'type' => 'text',
		)
	);

	$portfolio_settings->add_field(
		array(
			'name' => esc_html__( 'Client', 'charmed-pro' ),
			'desc' => esc_html__( 'Add clien information.', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_client',
			'type' => 'text',
		)
	);

	$portfolio_settings->add_field(
		array(
			'name' => esc_html__( 'URL', 'charmed-pro' ),
			'desc' => esc_html__( 'Display a URL to link to.', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_url',
			'type' => 'text_url',
		)
	);

	$portfolio_settings->add_field(
		array(
			'name' => esc_html__( 'External URL', 'charmed-pro' ),
			'desc' => esc_html__( 'Link this portfolio post to an external URL. For example, link this post to your Behance portfolio post.', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_external_url',
			'type' => 'text_url',
		)
	);
}

add_action( 'cmb2_admin_init', 'charmed_portfolio_settings_metabox' );

/**
 * Portfolio Video metabox.
 */
function charmed_portfolio_video_metabox() {

	// Start with an underscore to hide fields from custom fields list.
	$prefix = '_bean_';

	/**
	 * Initiate the metabox.
	 */
	$portfolio_video = new_cmb2_box(
		array(
			'id'           => 'portfolio_video',
			'title'        => esc_html__( 'Portfolio Format', 'charmed-pro' ),
			'object_types' => array( 'portfolio', 'post' ),
			'context'      => 'normal',
			'priority'     => 'normal',
		)
	);

	$portfolio_video->add_field(
		array(
			'name' => esc_html__( 'Lightbox Embed URL', 'charmed-pro' ),
			'desc' => esc_html__( 'Insert your embeded URL to play in the blogroll grid pages.', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_embed_url',
			'type' => 'text_url',
		)
	);

	$portfolio_video->add_field(
		array(
			'name' => esc_html__( 'Embed 1', 'charmed-pro' ),
			'desc' => esc_html__( 'Insert your embeded code here.', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_embed_code',
			'type' => 'textarea',
		)
	);

	$portfolio_video->add_field(
		array(
			'name' => esc_html__( 'Embed 2', 'charmed-pro' ),
			'desc' => esc_html__( 'Insert your embeded code here.', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_embed_code_2',
			'type' => 'textarea',
		)
	);

	$portfolio_video->add_field(
		array(
			'name' => esc_html__( 'Embed 3', 'charmed-pro' ),
			'desc' => esc_html__( 'Insert your embeded code here.', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_embed_code_3',
			'type' => 'textarea',
		)
	);

	$portfolio_video->add_field(
		array(
			'name' => esc_html__( 'Embed 4', 'charmed-pro' ),
			'desc' => esc_html__( 'Insert your embeded code here.', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_embed_code_4',
			'type' => 'textarea',
		)
	);

	$portfolio_video->add_field(
		array(
			'name' => esc_html__( 'Video Shortcodes', 'charmed-pro' ),
			'desc' => esc_html__( 'Insert any video shortcodes.', 'charmed-pro' ),
			'id'   => $prefix . 'portfolio_video_shortcodes',
			'type' => 'textarea',
		)
	);
}
add_action( 'cmb2_admin_init', 'charmed_portfolio_video_metabox' );
