<?php

// Register widget.
add_action(
	'widgets_init', function() {
		return register_widget( 'Bean_Portfolio_Menu_Widget' );
	}
);

class Bean_Portfolio_Menu_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'bean_portfolio_menu',
			esc_html__( 'Portfolio Menu', 'charmed-pro' ),
			array(
				'description'                 => esc_html__( 'A custom loop of portfolio posts.', 'charmed-pro' ),
				'customize_selective_refresh' => true,
			)
		);
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );

		$desc      = $instance['desc'];
		$postcount = $instance['postcount'];
		$loop      = $instance['loop'];

		echo $before_widget;

		if ( $title ) {
			echo balanceTags( $before_title ) . esc_html( $title ) . balanceTags( $after_title );
		}

		if ( '' !== $desc ) {
			echo '<p>' . balanceTags( $desc ) . '</p>';
		} ?>

		<ul>

		<?php
		if ( '' !== $loop ) {
			switch ( $loop ) {
				case 'Most Recent':
					$orderby  = 'date';
					$meta_key = '';
					break;
				case 'Random':
					$orderby  = 'rand';
					$meta_key = '';
					break;
			}
		}

		$args = array(
			'post_type'      => 'portfolio',
			'order'          => 'DSC',
			'orderby'        => $orderby,
			'meta_key'       => $meta_key,
			'posts_per_page' => $postcount,
		);
		query_posts( $args ); if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();

		?>

			<li>
				<?php /* translators: Post Link; */ ?>
				<a title="<?php printf( __( 'Permanent Link to %s', 'charmed-pro' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>">
					<?php echo get_the_title(); ?>
				</a>
			</li>

			<?php
			endwhile;
			endif;
			wp_reset_postdata();
			wp_reset_query();
			?>

		</ul>

		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']     = wp_strip_all_tags( $new_instance['title'] );
		$instance['desc']      = stripslashes( $new_instance['desc'] );
		$instance['loop']      = $new_instance['loop'];
		$instance['postcount'] = $new_instance['postcount'];

		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			'title'     => '',
			'desc'      => '',
			'postcount' => '',
			'loop'      => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		?>

		<?php
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		if ( ! is_plugin_active( 'bean-portfolio/bean-portfolio.php' ) ) {
			?>
			<div class="bean-widget-notification">
				<p><?php esc_html_e( 'Please download & install the Bean Portfolio WordPress plugin to properly display this widget.', 'charmed-pro' ); ?><br/>
				<a style="margin-top: 5px; margin-bottom: 8px;" href="https://themebeans.com/plugins/bean-portfolio" target="_blank" class="button button-secondary"><?php esc_html_e( 'Bean Portfolio &rarr;', 'charmed-pro' ); ?></a></p>
			</div>
		<?php } ?>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'charmed-pro' ); ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p style="margin-top: -8px;">
		<textarea class="widefat" rows="5" cols="15" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>"><?php echo esc_attr( $instance['desc'] ); ?></textarea>
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'postcount' ) ); ?>"><?php esc_html_e( 'Number of Posts: (-1 for Infinite)', 'charmed-pro' ); ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'postcount' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postcount' ) ); ?>" value="<?php echo esc_attr( $instance['postcount'] ); ?>" />
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'loop' ) ); ?>"><?php esc_html_e( 'Portfolio Loop:', 'charmed-pro' ); ?></label>
		<select id="<?php echo esc_attr( $this->get_field_id( 'loop' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'loop' ) ); ?>" class="widefat">
			<option
			<?php
			if ( esc_html_e( 'Most Recent', 'charmed-pro' ) === $instance['loop'] ) {
				echo 'selected="selected"';}
?>
><?php esc_html_e( 'Most Recent', 'charmed-pro' ); ?></option>
			<option
			<?php
			if ( esc_html_e( 'Most Recent', 'charmed-pro' ) === $instance['loop'] ) {
				echo 'selected="selected"';}
?>
><?php esc_html_e( 'Random', 'charmed-pro' ); ?></option>
		</select>
		</p>
	<?php
	}
}
