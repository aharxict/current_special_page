<?php

function cs_blade_grve_print_header_title( $mode = 'page', $cs_header_title = 'archive') {
	global $post;

	if ( blade_grve_check_title_visibility() ) {

		$item_type = str_replace ( '_' , '-', $mode );
		$grve_page_title_id = 'grve-' . $item_type  . '-title';
		$grve_page_title = array(
			'height' => blade_grve_option( $mode . '_title_height' ),
			'min_height' => blade_grve_option( $mode . '_title_min_height' ),
			'title_color' => blade_grve_option( $mode . '_title_color' ),
			'title_color_custom' => blade_grve_option( $mode . '_title_color_custom' ),
			'caption_color' => blade_grve_option( $mode . '_description_color' ),
			'caption_color_custom' => blade_grve_option( $mode . '_description_color_custom' ),
			'content_position' => blade_grve_option( $mode . '_title_content_position' ),
			'content_animation' => blade_grve_option( $mode . '_title_content_animation' ),
			'bg_mode' => blade_grve_option( $mode . '_title_bg_mode' ),
			'bg_image_id' => blade_grve_option( $mode . '_title_bg_image', '', 'id' ),
			'bg_position' => blade_grve_option( $mode . '_title_bg_position' ),
			'bg_color' => blade_grve_option( $mode . '_title_bg_color', 'dark' ),
			'bg_color_custom' => blade_grve_option( $mode . '_title_bg_color_custom' ),
			'pattern_overlay' => blade_grve_option( $mode . '_title_pattern_overlay' ),
			'color_overlay' => blade_grve_option( $mode . '_title_color_overlay' ),
			'color_overlay_custom' => blade_grve_option( $mode . '_title_color_overlay_custom' ),
			'opacity_overlay' => blade_grve_option( $mode . '_title_opacity_overlay' ),
		);

		$header_data = blade_grve_header_title();
//		$header_title = isset( $header_data['title'] ) ? $header_data['title'] : '';
		$header_title = isset( $header_data['title'] ) ? $cs_header_title : '';

		$header_description = isset( $header_data['description'] ) ? $header_data['description'] : '';
		$header_reversed = isset( $header_data['reversed'] ) ? $header_data['reversed'] : '';

		$grve_woo_shop = blade_grve_is_woo_shop();

		if ( is_singular() || $grve_woo_shop  ) {
			if ( $grve_woo_shop ) {
				$post_id = wc_get_page_id( 'shop' );
			} else {
				$post_id = $post->ID;
			}

			$grve_custom_title_options = get_post_meta( $post_id, 'grve_custom_title_options', true );
			$grve_page_title_custom = blade_grve_array_value( $grve_custom_title_options, 'custom' );
			if ( 'custom' == $grve_page_title_custom ) {
				$grve_page_title = $grve_custom_title_options;
			}
		} else if ( is_tag() || is_category() || blade_grve_is_woo_category() || blade_grve_is_woo_tag() ) {
			$category_id = get_queried_object_id();
			$grve_custom_title_options = blade_grve_get_term_meta( $category_id, 'grve_custom_title_options' );
			$grve_page_title_custom = blade_grve_array_value( $grve_custom_title_options, 'custom' );
			if ( 'custom' == $grve_page_title_custom ) {
				$grve_page_title = $grve_custom_title_options;
			}
		}

		$grve_wrapper_title_classes = array( 'grve-page-title' );

		$bg_mode = blade_grve_array_value( $grve_page_title, 'bg_mode', 'color' );
		if ( 'color' == $bg_mode ) {
			$grve_wrapper_title_classes[] = 'grve-with-title';
		} else {
			$grve_wrapper_title_classes[] = 'grve-with-image';
		}

		$grve_title_classes = array( 'grve-title', 'clearfix' );
		$grve_caption_classes = array( 'grve-description', 'clearfix' );
		$grve_subheading_classes = array( 'grve-title-meta', 'grve-subheading', 'grve-list-divider', 'clearfix' );

		$content_position = blade_grve_array_value( $grve_page_title, 'content_position', 'center-center' );
		$content_animation = blade_grve_array_value( $grve_page_title, 'content_animation', 'fade-in' );
		$page_title_height = blade_grve_array_value( $grve_page_title, 'height', '350' );
		$page_title_min_height = blade_grve_array_value( $grve_page_title, 'min_height', '320' );


		$page_title_bg_color = blade_grve_array_value( $grve_page_title, 'bg_color', 'dark' );
		if ( 'custom' != $page_title_bg_color ) {
			$grve_wrapper_title_classes[] = 'grve-bg-' . $page_title_bg_color;
		}

		$page_title_color = blade_grve_array_value( $grve_page_title, 'title_color', 'light' );
		if ( 'custom' != $page_title_color ) {
			$grve_title_classes[] = 'grve-text-' . $page_title_color;
		}
		$page_title_caption_color = blade_grve_array_value( $grve_page_title, 'caption_color', 'light' );
		if ( 'custom' != $page_title_caption_color ) {
			$grve_caption_classes[] = 'grve-text-' . $page_title_caption_color;
			$grve_subheading_classes[] = 'grve-text-' . $page_title_caption_color;
		}

		$grve_wrapper_title_classes = implode( ' ', $grve_wrapper_title_classes );
		$grve_title_classes = implode( ' ', $grve_title_classes );
		$grve_caption_classes = implode( ' ', $grve_caption_classes );
		$grve_subheading_classes = implode( ' ', $grve_subheading_classes );
		?>
		<!-- Page Title -->
		<div id="<?php echo esc_attr( $grve_page_title_id ); ?>" class="<?php echo esc_attr( $grve_wrapper_title_classes ); ?>" data-height="<?php echo esc_attr( $page_title_height ); ?>">
			<div class="grve-wrapper clearfix" style="height:<?php echo esc_attr( $page_title_height ); ?>px; min-height:<?php echo esc_attr( $page_title_min_height ); ?>px;">
				<?php do_action( 'blade_grve_page_title_top' ); ?>
				<div class="grve-content grve-align-<?php echo esc_attr( $content_position ); ?>" data-animation="<?php echo esc_attr( $content_animation ); ?>">
					<div class="grve-container">
						<?php if( 'post' == $mode ) { ?>
							<ul class="<?php echo esc_attr( $grve_subheading_classes ); ?>">
								<?php if ( blade_grve_visibility( 'post_author_visibility' ) ) { ?>
									<li><span class="grve-author"><?php esc_html_e( 'By', 'blade' ); ?> <a href="#grve-about-author"><?php the_author(); ?></a></span></li>
								<?php } ?>
								<li><span class="grve-day"><?php echo esc_html( get_the_date() ); ?></span></li>
							</ul>
						<?php } ?>
						<?php if ( empty( $header_reversed ) ) { ?>
							<h1 class="<?php echo esc_attr( $grve_title_classes ); ?>"><span><?php echo esc_html( $header_title ); ?></span></h1>
							<?php if ( !empty( $header_description ) ) { ?>
								<div class="<?php echo esc_attr( $grve_caption_classes ); ?>"><?php echo wp_kses_post( $header_description ); ?></div>
							<?php } ?>
						<?php } else { ?>
							<?php if ( !empty( $header_description ) ) { ?>
								<div class="<?php echo esc_attr( $grve_caption_classes ); ?>"><?php echo wp_kses_post( $header_description ); ?></div>
							<?php } ?>
							<h1 class="<?php echo esc_attr( $grve_title_classes ); ?>"><span><?php echo esc_html( $header_title ); ?></span></h1>
						<?php } ?>
					</div>
				</div>
				<?php do_action( 'blade_grve_page_title_bottom' ); ?>
			</div>
			<?php blade_grve_print_title_bg_image( $grve_page_title ); ?>
		</div>
		<!-- End Page Title -->
		<?php
	}
}

//define( 'ACF_LITE', true );

// 1. customize ACF path
add_filter('acf/settings/path', 'cs_acf_settings_path');

function cs_acf_settings_path( $path ) {

	// update path
	$path = plugin_dir_path( __FILE__ ) . 'plugin/acf/';

	// return
	return $path;

}
// 2. customize ACF dir
add_filter('acf/settings/dir', 'cs_acf_settings_dir');

function cs_acf_settings_dir( $dir ) {

	// update path
	$dir = plugin_dir_path( __FILE__ ) . 'plugin/acf/';

	// return
	return $dir;

}


// 3. Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_false');


