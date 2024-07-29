<?php
/**
 * The gallery tab functionality of this plugin.
 *
 * Defines the sections of gallery tab.
 *
 * @package    Woo_Gallery_Slider
 * @subpackage Woo_Gallery_Slider/admin
 * @author     Shapedplugin <support@shapedplugin.com>
 */

/**
 * WCGS Gallery class
 */
class WCGS_Gallery {
	/**
	 * Specify the Gallery tab for the Woo Gallery Slider.
	 *
	 * @since    1.0.0
	 * @param string $prefix Define prefix wcgs_settings.
	 */
	public static function section( $prefix ) {
		WCGS::createSection(
			$prefix,
			array(
				'name'   => 'gallery',
				'icon'   => 'sp_wgs-icon-gallery-tab',
				'title'  => __( 'Gallery', 'gallery-slider-for-woocommerce' ),
				'fields' => array(
					array(
						'type' => 'tabbed',
						'tabs' => array(
							array(
								'title'  => __( 'Gallery Slider', 'gallery-slider-for-woocommerce' ),
								'icon'   => 'sp_wgs-icon-gallery-slider-v3-01',
								'fields' => array(
									array(
										'id'         => 'autoplay',
										'class'      => 'pro_switcher',
										'type'       => 'switcher',
										'title'      => esc_html__( 'AutoPlay', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
										'text_width' => 96,
									),
									array(
										'id'         => 'slide_orientation',
										'type'       => 'select',
										'title'      => esc_html__( 'Slide Orientation', 'gallery-slider-for-woocommerce' ),
										'title_help' => '<div class="wcgs-img-tag"><img src="' . plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/slide_orientation.svg" alt=""></div><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/slider-orientations/" target="_blank">Live Demo</a>',
										'options'    => array(
											'horizontal' => esc_html__( 'Horizontal', 'gallery-slider-for-woocommerce' ),
											'vertical'   => esc_html__( 'Vertical', 'gallery-slider-for-woocommerce' ),
										),
										'default'    => 'horizontal',
									),
									array(
										'id'         => 'infinite_loop',
										'type'       => 'switcher',
										'title'      => esc_html__( 'Infinite Loop', 'gallery-slider-for-woocommerce' ),
										'default'    => true,
										'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
										'text_width' => 96,
										'dependency' => array( 'gallery_layout', '!=', 'hide_thumb', true ),
									),
									array(
										'id'      => 'fade_slide',
										'type'    => 'select',
										'title'   => __( 'Sliding Effect', 'gallery-slider-for-woocommerce' ),
										'options' => array(
											'slide' => __( 'Slide', 'gallery-slider-for-woocommerce' ),
											'fade'  => __( 'Fade(Pro)', 'gallery-slider-for-woocommerce' ),
											'flip'  => __( 'Flip(Pro)', 'gallery-slider-for-woocommerce' ),
											'cube'  => __( 'Cube(Pro)', 'gallery-slider-for-woocommerce' ),
										),
										'default' => 'slide',
									),
									array(
										'id'         => 'adaptive_height',
										'type'       => 'switcher',
										'title'      => esc_html__( 'Adaptive Height', 'gallery-slider-for-woocommerce' ),
										'title_help' => __( '<div class="wcgs-info-label">Adaptive Height</div><div class="wcgs-short-content">Adjust the height of gallery images according to the highest item.</div>', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
										'text_width' => 96,
										'default'    => true,
									),
									array(
										'id'         => 'accessibility',
										'type'       => 'switcher',
										'title'      => esc_html__( 'Accessibility', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
										'text_width' => 96,
										'default'    => true,
									),
									array(
										'id'         => 'slider_dir',
										'type'       => 'switcher',
										'title'      => esc_html__( 'RTL Mode', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
										'text_width' => 96,
										'default'    => false,
									),
									array(
										'id'         => 'free_mode',
										'type'       => 'switcher',
										'title'      => __( 'Free Mode', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
										'text_width' => 96,
										'default'    => true,
									),
									array(
										'id'         => 'mouse_wheel',
										'type'       => 'switcher',
										'title'      => __( 'Mouse Wheel', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
										'text_width' => 96,
										'default'    => false,
									),
								),
							),
							array(
								'title'  => __( 'Navigation & Pagination', 'gallery-slider-for-woocommerce' ),
								'icon'   => 'sp_wgs-icon-nav-n-pag-v',
								'fields' => array(
									array(
										'id'         => 'navigation',
										'type'       => 'switcher',
										'title'      => esc_html__( 'Slider Navigation', 'gallery-slider-for-woocommerce' ),
										'title_help' => '<div class="wcgs-img-tag"><img src="' . plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/slider-navigation.svg" alt=""></div>	<div class="wcgs-info-label">Slider Navigation</div>',
										'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
										'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
										'text_width' => 80,
										'default'    => true,
									),
									array(
										'id'         => 'navigation_icon',
										'type'       => 'button_set',
										'class'      => 'btn_icon',
										'title'      => esc_html__( 'Navigation Icon Style', 'gallery-slider-for-woocommerce' ),
										'options'    => array(
											'angle'        => array(
												'option_name' => '<i class="sp_wgs-icon-right-open-1"></i>',
											),
											'chevron'      => array(
												'option_name' => '<i class="sp_wgs-icon-right-open-big"></i>',
												'pro_only' => true,
											),
											'right_open'   => array(
												'option_name' => '<i class="sp_wgs-icon-right-open"></i>',
												'pro_only' => true,
											),
											'right_open_1' => array(
												'option_name' => '<i class="sp_wgs-icon-angle-right"></i>',
												'pro_only' => true,
											),
											'right_open_3' => array(
												'option_name' => '<i class="sp_wgs-icon-right-open-3"></i>',
												'pro_only' => true,
											),
											'right_open_outline' => array(
												'option_name' => '<i class="sp_wgs-icon-right-open-outline"></i>',
												'pro_only' => true,
											),
											'angle_double' => array(
												'option_name' => '<i class="sp_wgs-icon-angle-double-right"></i>',
												'pro_only' => true,
											),
											'chevron_circle' => array(
												'option_name' => '<i class="sp_wgs-icon-angle-circled-right"></i>',
												'pro_only' => true,
											),
											'arrow'        => array(
												'option_name' => '<i class="sp_wgs-icon-right-big"></i>',
												'pro_only' => true,
											),
											'right_outline' => array(
												'option_name' => '<i class="sp_wgs-icon-right-outline"></i>',
												'pro_only' => true,
											),
											// 'long_arrow' => array(
											// 'option_name' => '<i class="sp_wgs-icon-left-thin"></i>',
											// 'pro_only' => true,
											// ),
											// 'arrow_circle' => array(
											// 'option_name' => '<i class="sp_wgs-icon-left-circled"></i>',
											// 'pro_only' => true,
											// ),
											// 'arrow_circle_o' => array(
											// 'option_name' => '<i class="sp_wgs-icon-left-circled-1"></i>',
											// 'pro_only' => true,
											// ),
										),
										'default'    => 'angle',
										'dependency' => array( 'navigation', '==', true ),
									),
									array(
										'id'         => 'navigation_position',
										'class'      => 'shop_video_icon_position',
										'type'       => 'image_select',
										'title'      => __( 'Navigation Position', 'gallery-slider-for-woocommerce' ),
										'options'    => array(
											'center_center' => array(
												'image' => plugin_dir_url( __DIR__ ) . '../img/arrow-position/center-center.svg',
												'option_name' => __( 'Center Center', 'gallery-slider-for-woocommerce' ),
											),
											'bottom_right' => array(
												'image'    => plugin_dir_url( __DIR__ ) . '../img/arrow-position/bottom-right.svg',
												'option_name' => __( 'Bottom Right', 'gallery-slider-for-woocommerce' ),
												'pro_only' => true,
											),
											'bottom_left'  => array(
												'image'    => plugin_dir_url( __DIR__ ) . '../img/arrow-position/bottom-left.svg',
												'option_name' => __( 'Bottom Left', 'gallery-slider-for-woocommerce' ),
												'pro_only' => true,
											),
											'bottom_center' => array(
												'image'    => plugin_dir_url( __DIR__ ) . '../img/arrow-position/bottom-center.svg',
												'option_name' => __( 'Bottom Center', 'gallery-slider-for-woocommerce' ),
												'pro_only' => true,
											),

										),
										'default'    => 'center_center',
										'dependency' => array( 'navigation', '==', 'true', true ),
									),
									array(
										'id'         => 'navigation_icon_size',
										'type'       => 'spinner',
										'title'      => esc_html__( 'Navigation Icon Size', 'gallery-slider-for-woocommerce' ),
										'dependency' => array( 'navigation', '==', true ),
										'default'    => 16,
										'unit'       => 'px',
									),
									array(
										'id'         => 'navigation_icon_color_group',
										'type'       => 'color_group',
										'title'      => esc_html__( 'Navigation Color', 'gallery-slider-for-woocommerce' ),
										'options'    => array(
											'color'       => esc_html__( 'Color', 'gallery-slider-for-woocommerce' ),
											'hover_color' => esc_html__( 'Hover Color', 'gallery-slider-for-woocommerce' ),
											'bg_color'    => esc_html__( 'Background', 'gallery-slider-for-woocommerce' ),
											'hover_bg_color' => esc_html__( 'Hover Background', 'gallery-slider-for-woocommerce' ),
										),
										'dependency' => array( 'navigation', '==', true ),
										'default'    => array(
											'color'       => '#fff',
											'hover_color' => '#fff',
											'bg_color'    => 'rgba(0, 0, 0, .5)',
											'hover_bg_color' => 'rgba(0, 0, 0, .85)',
										),
									),
									array(
										'id'         => 'navigation_icon_radius',
										'type'       => 'spinner',
										'title'      => __( 'Navigation Background Radius', 'gallery-slider-for-woocommerce' ),
										'dependency' => array( 'navigation', '==', true ),
										'min'        => 0,
										'default'    => 0,
										'unit'       => 'px',
									),
									array(
										'id'         => 'navigation_visibility',
										'type'       => 'select',
										'title'      => esc_html__( 'Navigation Visibility', 'gallery-slider-for-woocommerce' ),
										'options'    => array(
											'always' => esc_html__( 'Always', 'gallery-slider-for-woocommerce' ),
											'hover'  => esc_html__( 'On hover', 'gallery-slider-for-woocommerce' ),
										),
										'default'    => 'always',
										'dependency' => array( 'navigation', '==', true ),
									),
									array(
										'id'         => 'pagination',
										'type'       => 'switcher',
										'title'      => esc_html__( 'Slider Pagination', 'gallery-slider-for-woocommerce' ),
										'title_help' => '<div class="wcgs-img-tag"><img src="' . plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/slider-pagination.svg" alt=""></div> <div class="wcgs-info-label">Thumbnails Navigation</div>',
										'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
										'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
										'text_width' => 80,
										'default'    => false,
									),
									array(
										'id'         => 'pagination_icon_color_group',
										'type'       => 'color_group',
										'title'      => esc_html__( 'Pagination Color', 'gallery-slider-for-woocommerce' ),
										'options'    => array(
											'color'        => esc_html__( 'Color', 'gallery-slider-for-woocommerce' ),
											'active_color' => esc_html__( 'Active Color', 'gallery-slider-for-woocommerce' ),
										),
										'dependency' => array( 'pagination', '==', true ),
										'default'    => array(
											'color'        => 'rgba(115, 119, 121, 0.5)',
											'active_color' => 'rgba(115, 119, 121, 0.8)',
										),
									),
									array(
										'id'         => 'pagination_visibility',
										'type'       => 'select',
										'title'      => esc_html__( 'Pagination Visibility', 'gallery-slider-for-woocommerce' ),
										'options'    => array(
											'always' => esc_html__( 'Always', 'gallery-slider-for-woocommerce' ),
											'hover'  => esc_html__( 'On hover', 'gallery-slider-for-woocommerce' ),
										),
										'default'    => 'always',
										'dependency' => array( 'pagination', '==', true ),
									),
								),
							),
							array(
								'title'  => __( 'Thumbnails Navigation', 'gallery-slider-for-woocommerce' ),
								'icon'   => 'sp_wgs-icon-th-nav-01',
								'fields' => array(
									array(
										'id'         => 'thumbnailnavigation',
										'type'       => 'switcher',
										'title'      => esc_html__( 'Thumbnails Navigation', 'gallery-slider-for-woocommerce' ),
										'title_help' => '<div class="wcgs-img-tag"><img src="' . plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/thumbnails-navigation.svg" alt=""></div><div class="wcgs-info-label">Thumbnails Navigation</div>',
										'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
										'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
										'text_width' => 80,
										'default'    => false,
									),
									array(
										'id'         => 'thumb_nav_visibility',
										'type'       => 'select',
										'title'      => esc_html__( 'Thumbnails Navigation Visibility', 'gallery-slider-for-woocommerce' ),
										'options'    => array(
											'always' => esc_html__( 'Always', 'gallery-slider-for-woocommerce' ),
											'hover'  => esc_html__( 'On hover', 'gallery-slider-for-woocommerce' ),
										),
										'default'    => 'always',
										'dependency' => array( 'thumbnailnavigation', '==', 'true', true ),
									),
									array(
										'id'         => 'thumbnailnavigation_style',
										'class'      => 'thumbnailnavigation_style',
										'type'       => 'image_select',
										'title_help' => '<div class="wcgs-info-label">Thumbnails Navigation Style</div><div class="wcgs-short-content">Stylize your thumbnail navigation using Inner, Outer, and Custom design.</div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-customize-thumbnails-navigation-styles/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/thumbnails-navigation-styles/" target="_blank">Live Demo</a>',
										'title'      => __( 'Thumbnails Navigation Style', 'gallery-slider-for-woocommerce' ),
										'options'    => array(
											'custom' => array(
												'image' => plugin_dir_url( __DIR__ ) . '../img/custom.svg',
												'option_name' => __( 'Custom', 'gallery-slider-for-woocommerce' ),
											),
											'outer'  => array(
												'image'    => plugin_dir_url( __DIR__ ) . '../img/outer.svg',
												'option_name' => __( 'Outer', 'gallery-slider-for-woocommerce' ),
												'pro_only' => true,
											),
											'inner'  => array(
												'image'    => plugin_dir_url( __DIR__ ) . '../img/inner.svg',
												'option_name' => __( 'Inner', 'gallery-slider-for-woocommerce' ),
												'pro_only' => true,
											),

										),
										'default'    => 'custom',
										'dependency' => array( 'thumbnailnavigation', '==', 'true', true ),
									),
									array(
										'id'         => 'thumbnailnavigation_icon',
										'class'      => 'btn_icon',
										'type'       => 'button_set',
										'title'      => esc_html__( 'Thumbnail Navigation Icon', 'gallery-slider-for-woocommerce' ),
										'dependency' => array( 'thumbnailnavigation', '==', 'true', true ),
										'options'    => array(
											'angle'        => array(
												'option_name' => '<i class="sp_wgs-icon-right-open-1"></i>',
											),
											'chevron'      => array(
												'option_name' => '<i class="sp_wgs-icon-right-open-big"></i>',
												'pro_only' => true,
											),
											'right_open'   => array(
												'option_name' => '<i class="sp_wgs-icon-right-open"></i>',
												'pro_only' => true,
											),
											'right_open_1' => array(
												'option_name' => '<i class="sp_wgs-icon-angle-right"></i>',
												'pro_only' => true,
											),
											'right_open_3' => array(
												'option_name' => '<i class="sp_wgs-icon-right-open-3"></i>',
												'pro_only' => true,
											),
											'right_open_outline' => array(
												'option_name' => '<i class="sp_wgs-icon-right-open-outline"></i>',
												'pro_only' => true,
											),
											'angle_double' => array(
												'option_name' => '<i class="sp_wgs-icon-angle-double-right"></i>',
												'pro_only' => true,
											),
											'chevron_circle' => array(
												'option_name' => '<i class="sp_wgs-icon-angle-circled-right"></i>',
												'pro_only' => true,
											),
											'arrow'        => array(
												'option_name' => '<i class="sp_wgs-icon-right-big"></i>',
												'pro_only' => true,
											),
											'right_outline' => array(
												'option_name' => '<i class="sp_wgs-icon-right-outline"></i>',
												'pro_only' => true,
											),
											// 'long_arrow' => array(
											// 'option_name' => '<i class="sp_wgs-icon-left-thin"></i>',
											// 'pro_only' => true,
											// ),
											// 'arrow_circle' => array(
											// 'option_name' => '<i class="sp_wgs-icon-left-circled"></i>',
											// 'pro_only' => true,
											// ),
											// 'arrow_circle_o' => array(
											// 'option_name' => '<i class="sp_wgs-icon-left-circled-1"></i>',
											// 'pro_only' => true,
											// ),
										),
										'default'    => 'angle',
									),
									array(
										'id'         => 'thumbnailnavigation_icon_size',
										'type'       => 'spinner',
										'unit'       => 'px',
										'title'      => esc_html__( 'Thumbnail Navigation Icon Size', 'gallery-slider-for-woocommerce' ),
										'default'    => 12,
										'dependency' => array( 'thumbnailnavigation', '==', 'true', true ),
									),
									array(
										'id'         => 'thumbnailnavigation_icon_color_group',
										'type'       => 'color_group',
										'title'      => esc_html__( 'Thumbnail Navigation Color', 'gallery-slider-for-woocommerce' ),
										'options'    => array(
											'color'       => esc_html__( 'Color', 'gallery-slider-for-woocommerce' ),
											'hover_color' => esc_html__( 'Hover Color', 'gallery-slider-for-woocommerce' ),
											'bg_color'    => esc_html__( 'Background', 'gallery-slider-for-woocommerce' ),
											'hover_bg_color' => esc_html__( 'Hover Background', 'gallery-slider-for-woocommerce' ),
										),
										'default'    => array(
											'color'       => '#fff',
											'hover_color' => '#fff',
											'bg_color'    => 'rgba(0, 0, 0, 0.5)',
											'hover_bg_color' => 'rgba(0, 0, 0, 0.8)',
										),
										'dependency' => array( 'thumbnailnavigation', '==', 'true', true ),
									),
									array(
										'id'         => 'thumbnail_navi_border',
										'class'      => 'pro_border',
										'type'       => 'border',
										'title'      => __( 'Thumbnails Navigation Border', 'gallery-slider-for-woocommerce' ),
										'color'      => true,
										'style'      => false,
										'color2'     => false,
										'color3'     => true,
										'all'        => true,
										'radius'     => true,
										'default'    => array(
											'color'  => '#dddddd',
											// 'color2' => '#5EABC1',
											'color3' => '#dddddd',
											'all'    => 0,
											'radius' => 0,
										),
										'dependency' => array( 'thumbnailnavigation', '==', 'true', true ),
									),
									array(
										'id'          => 'thumbnail_navi_box_size',
										'type'        => 'dimensions',
										'class'       => 'pro_dimensions',
										'title'       => __( 'Thumbnails Navigation Box Size', 'gallery-slider-for-woocommerce' ),
										'title_help'  => __( '<div class="wcgs-info-label">Thumbnails Navigation Box Size</div><div class="wcgs-short-content">Set the thumbnail navigation width and height separately as you like.</div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-adjust-the-thumbnails-navigation-box-size/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/thumbnails-navigation-styles/#thumb-nav-box-size" target="_blank">Live Demo</a>', 'gallery-slider-for-woocommerce' ),
										'width_text'  => __( 'Width', 'gallery-slider-for-woocommerce' ),
										'height_text' => __( 'height', 'gallery-slider-for-woocommerce' ),
										'unit'        => false,
										'width_unit'  => true,
										'height_unit' => true,
										'default'     => array(
											'width'       => 25,
											'height'      => 100,
											'height_unit' => '%',
											'width_unit'  => 'px',
										),
										'attributes'  => array(
											'min' => 0,
										),
										'dependency'  => array( 'thumbnailnavigation', '==', 'true', true ),
									),
								),
							),
							array(
								'title'  => __( 'Product Image', 'gallery-slider-for-woocommerce' ),
								'icon'   => 'sp_wgs-icon-product-image-v2-01',
								'fields' => array(
									array(
										'id'      => 'image_sizes',
										'type'    => 'image_sizes',
										'title'   => esc_html__( 'Image Size', 'gallery-slider-for-woocommerce' ),
										'default' => 'full',
									),
									array(
										'id'         => 'product_img_crop_size',
										'type'       => 'dimensions',
										'class'      => 'pro_only_field',
										'title'      => __( 'Custom Size', 'gallery-slider-for-woocommerce' ),
										'units'      => array(
											'Soft-crop (Pro)',
											'Hard-crop (Pro)',
										),
										'default'    => array(
											'width'  => '100',
											'height' => '100',
											'unit'   => 'Soft-crop',
										),
										'attributes' => array(
											'min' => 0,
										),
										'dependency' => array( 'image_sizes', '==', 'custom' ),
									),
									array(
										'id'         => 'product_image_load_2x',
										'type'       => 'switcher',
										'class'      => 'pro_switcher',
										'title'      => __( 'Load 2x Resolution Image in Retina Display', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
										'text_width' => 96,
										'default'    => false,
										'dependency' => array( 'image_sizes', '==', 'custom' ),
									),
									array(
										'id'      => 'wcgs_image_lazy_load',
										'type'    => 'button_set',
										'title'   => __( 'Lazy Load', 'gallery-slider-for-woocommerce' ),
										'options' => array(
											'false'    => __( 'Off', 'gallery-slider-for-woocommerce' ),
											'ondemand' => array(
												'option_name' => __( 'On Demand', 'gallery-slider-for-woocommerce' ),
												'pro_only' => true,
											),
										),
										'radio'   => true,
										'default' => 'false',
									),
									array(
										'id'         => 'preloader',
										'type'       => 'switcher',
										'title'      => esc_html__( 'Preloader', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
										'text_width' => 96,
										'default'    => true,
									),
									array(
										'id'      => 'image_border_radius',
										'type'    => 'spinner',
										'title'   => __( 'Border Radius', 'gallery-slider-for-woocommerce' ),
										'default' => 0,
										'unit'    => 'px',
									),
									array(
										'id'      => 'grayscale',
										'type'    => 'select',
										'title'   => esc_html__( 'Image Mode', 'gallery-slider-for-woocommerce' ),
										'options' => array(
											'gray_off'     => esc_html__( 'Original', 'gallery-slider-for-woocommerce' ),
											'gray_always'  => esc_html__( 'Grayscale(Pro)', 'gallery-slider-for-woocommerce' ),
											'gray_onhover' => esc_html__( 'Grayscale on hover(Pro)', 'gallery-slider-for-woocommerce' ),
											'gray_active_normal' => esc_html__( 'Grayscale with active normal(Pro)', 'gallery-slider-for-woocommerce' ),
											'active_gray_normal' => esc_html__( 'Active grayscale with normal(Pro)', 'gallery-slider-for-woocommerce' ),
										),
										'default' => 'gray_off',
									),
								),
							),
							array(
								'title'  => __( 'Product Image Zoom', 'gallery-slider-for-woocommerce' ),
								'icon'   => 'sp_wgs-icon-product-zoom-v3-01',
								'fields' => array(
									array(
										'id'         => 'zoom',
										'type'       => 'switcher',
										'title'      => esc_html__( 'Enable Image Zoom', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
										'text_width' => 96,
										'default'    => true,
									),
									array(
										'id'         => 'zoom_type',
										'class'      => 'zoom_type',
										'type'       => 'image_select',
										'title'      => __( 'Zoom Style', 'gallery-slider-for-woocommerce' ),
										'desc'       => 'Want access to Advanced <span>Magnific Zoom</span> options? <a href="' . WOO_GALLERY_SLIDER_PRO_LINK . '" target="_blank">Upgrade To Pro!</a>',
										'options'    => array(
											'in_side'    => array(
												'image' => plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/zoom_style_inside.svg',
												'option_name' => __( 'Inside', 'gallery-slider-for-woocommerce' ),
											),
											'right_side' => array(
												'image' => plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/zoom_style_right_side.svg',
												'option_name' => __( 'Right Side', 'gallery-slider-for-woocommerce' ),
												// 'pro_only' => true,
											),
											'lens'       => array(
												'image' => plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/zoom_style_magnify.svg',
												'option_name' => __( 'Magnific', 'gallery-slider-for-woocommerce' ),
												// 'pro_only' => true,
											),

										),
										'title_help' => __( '<div class="wcgs-info-label">Zoom Style</div><div class="wcgs-short-content">This option indicates the visual or interactive approach used to magnify or enlarge product thumbnails.</div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-implement-zoom-styles-for-product-images/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/zoom-styles/" target="_blank">Live Demo</a>', 'gallery-slider-for-woocommerce' ),
										'default'    => 'in_side',
										'dependency' => array( 'zoom', '==', 'true', true ),
									),
									array(
										'id'         => 'cursor_type',
										'type'       => 'button_set',
										'class'      => 'btn_icon',
										'title'      => __( 'Cursor Type', 'gallery-slider-for-woocommerce' ),
										'options'    => array(
											'pointer'   => array(
												'option_name' => '<i class="sp_wgs-icon-hand-pointer-o"></i>',
											),
											'default'   => array(
												'option_name' => '<i class="sp_wgs-icon-mouse-pointer"></i>',
												'pro_only' => true,
											),
											'crosshair' => array(
												'option_name' => '<i class="sp_wgs-icon-plus-1"></i>',
												'pro_only' => true,
											),
											'zoom-in'   => array(
												'option_name' => '<i class="sp_wgs-icon-zoom-in-1"></i>',
												'pro_only' => true,
											),
										),
										'default'    => 'pointer',
										'dependency' => array( 'zoom', '==', 'true', true ),
									),
									array(
										'id'         => 'lens_shape',
										'type'       => 'button_set',
										'class'      => 'pro_button_set',
										'title'      => __( 'Lens Shape', 'gallery-slider-for-woocommerce' ),

										'title_help' => __( '<div class="wcgs-info-label">Lens Shape</div><div class="wcgs-short-content">Choose a source from where you want to display the gallery images.</div>', 'gallery-slider-for-woocommerce' ),
										'options'    => array(
											'circle' => array(
												'option_name' => __( 'Circle', 'gallery-slider-for-woocommerce' ),
											),
											'box'    => array(
												'option_name' => __( 'Box', 'gallery-slider-for-woocommerce' ),
												'pro_only' => true,
											),
										),
										'radio'      => true,
										'default'    => 'circle',
										'dependency' => array( 'zoom|zoom_type', '==|==', 'true|lens', true ),
									),
									array(
										'id'         => 'lens_color',
										'type'       => 'color',
										'class'      => 'pro_color',
										'title'      => __( 'Lens Color', 'gallery-slider-for-woocommerce' ),
										'title_help' => '<div class="wcgs-img-tag"><img src="' . plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/lens_color.svg" alt=""></div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-choose-the-lens-color/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/lens-color/" target="_blank">Live Demo</a>',
										'default'    => 'transparent',
										'dependency' => array( 'zoom|zoom_type', '==|==', 'true|right_side', true ),
									),
									array(
										'id'         => 'lens_border',
										'type'       => 'border',
										'class'      => 'pro_border',
										'title'      => __( 'Lens Border', 'gallery-slider-for-woocommerce' ),
										'color'      => true,
										'style'      => true,
										'all'        => true,
										'radius'     => false,
										'color2'     => false,
										'color3'     => false,
										'default'    => array(
											'color' => '#dddddd',
											'style' => 'solid',
											'all'   => 1,
										),
										'dependency' => array( 'zoom|zoom_type', '==|any', 'true|lens,right_side', true ),
									),
									array(
										'id'         => 'product_image_overlay',
										'type'       => 'button_set',
										'class'      => 'pro_button_set',
										'title'      => __( 'Product Image Overlay on Hover', 'gallery-slider-for-woocommerce' ),
										'title_help' => '<div class="wcgs-img-tag"><img src="' . plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/product-image-overlay-hover.svg" alt=""></div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-choose-product-image-overlay-style-on-hover/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/product-image-overlay-on-hover/" target="_blank">Live Demo</a>',
										'options'    => array(
											'blur'         => array(
												'option_name' => __( 'Blur', 'gallery-slider-for-woocommerce' ),
											),
											'custom_color' => array(
												'option_name' => __( 'Custom Color', 'gallery-slider-for-woocommerce' ),
												'pro_only' => true,
											),

										),
										'radio'      => true,
										'default'    => 'blur',
										'dependency' => array( 'zoom|zoom_type', '==|any', 'true|lens,right_side', true ),
									),
									array(
										'id'         => 'overlay_color',
										'type'       => 'color',
										'class'      => 'pro_color',
										'title'      => __( 'Image Overlay Color', 'gallery-slider-for-woocommerce' ),
										'default'    => '#fff',
										'dependency' => array( 'zoom|zoom_type|product_image_overlay', '==|any|==', 'true|lens,right_side|custom_color', true ),
									),
									array(
										'id'         => 'lens_opacity',
										'type'       => 'slider',
										'class'      => 'pro_slider',
										'title'      => __( 'Image Overlay opacity', 'gallery-slider-for-woocommerce' ),
										'default'    => '0.5',
										'min'        => 0,
										'max'        => 1,
										'step'       => .1,
										'unit'       => '',
										'dependency' => array( 'zoom|zoom_type|product_image_overlay', '==|any|==', 'true|lens,right_side|custom_color', true ),
									),
									array(
										'id'         => 'zoom_size_type',
										'type'       => 'button_set',
										'class'      => 'pro_button_set',
										'title'      => __( 'Zoom Window Size Type', 'gallery-slider-for-woocommerce' ),
										'options'    => array(
											'auto'   => array(
												'option_name' => __( 'Auto', 'gallery-slider-for-woocommerce' ),
											),
											'custom' => array(
												'option_name' => __( 'Custom', 'gallery-slider-for-woocommerce' ),
												'pro_only' => true,
											),
										),
										'radio'      => true,
										'default'    => 'auto',
										'dependency' => array( 'zoom|zoom_type', '==|==', 'true|right_side' ),
									),
									array(
										'id'          => 'zoom_size',
										// 'type'        => 'dimensions',
										'type'        => 'pro_dimensions',
										'title'       => __( 'Zoom Window Size', 'gallery-slider-for-woocommerce' ),
										'width_text'  => __( 'Width', 'gallery-slider-for-woocommerce' ),
										'height_text' => __( 'Height', 'gallery-slider-for-woocommerce' ),
										'title_help'  => __( '<div class="wcgs-info-label">Zoom Window Size</div><div class="wcgs-short-content">Adjust the zoom window size as per your need.</div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-adjust-the-zoom-window-size-for-product-images/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/zoom-window-size/" target="_blank">Live Demo</a>', 'gallery-slider-for-woocommerce' ),
										'units'       => array( 'px' ),
										'default'     => array(
											'width'  => '400',
											'height' => '500',
										),
										'attributes'  => array(
											'min' => 0,
										),
										'dependency'  => array( 'zoom|zoom_type|zoom_size_type', '==|==|==', 'true|right_side|custom' ),
									),
									array(
										'id'         => 'zoom_window_distance',
										'type'       => 'spinner',
										'class'      => 'pro_only_field',
										'title'      => __( 'Zoom Window Distance', 'gallery-slider-for-woocommerce' ),
										'title_help' => '<div class="wcgs-img-tag"> <img src="' . plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/zoom-window-distance.svg" alt=""></div><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/zoom-window-distance/" target="_blank">Live Demo</a>',
										'default'    => 10,
										'unit'       => 'px',
										'dependency' => array( 'zoom|zoom_type', '==|==', 'true|right_side' ),
									),
									array(
										'id'         => 'mouse_wheel_zoom',
										'type'       => 'switcher',
										'class'      => 'pro_switcher',
										'title'      => __( 'MouseWheel Zoom', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
										'text_width' => 96,
										'default'    => false,
										'dependency' => array( 'zoom', '==', 'true' ),
									),
									array(
										'id'         => 'mobile_zoom',
										'type'       => 'switcher',
										'title'      => esc_html__( 'Enable Zoom for Mobile Devices', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
										'text_width' => 96,
										'default'    => false,
										'dependency' => array( 'zoom', '==', true ),
									),
									array(
										'id'      => 'exclude_zoom_by_products_type',
										'type'    => 'select',
										'title'   => __( 'Exclude Zoom', 'gallery-slider-for-woocommerce' ),
										'options' => array(
											'from_product' => __( 'Product(s)', 'gallery-slider-for-woocommerce' ),
											'from_category' => __( 'Category(s)', 'gallery-slider-for-woocommerce' ),
											'none'         => __( 'None', 'gallery-slider-for-woocommerce' ),
										),
										'default' => 'none',
									),
									array(
										'id'          => 'exclude_zoom_by_products',
										'class'       => 'exclude_zoom pro_only_field',
										'type'        => 'select',
										'title'       => __( 'Exclude Zoom by Product(s)', 'gallery-slider-for-woocommerce' ),
										'placeholder' => __( 'Select Product(s)', 'gallery-slider-for-woocommerce' ),
										'options'     => array(
											'' => '',
										),
										'dependency'  => array( 'zoom|exclude_zoom_by_products_type', '==|==', 'true|from_product' ),
									),
									array(
										'id'          => 'exclude_zoom_by_category',
										'class'       => 'exclude_zoom pro_only_field',
										'type'        => 'select',
										'placeholder' => __( 'Select Category(s)', 'gallery-slider-for-woocommerce' ),
										'title'       => __( 'Exclude Zoom by Category(s)', 'gallery-slider-for-woocommerce' ),
										'options'     => array(
											'' => '',
										),
										'dependency'  => array( 'zoom|exclude_zoom_by_products_type', '==|==', 'true|from_category' ),
									),
									array(
										'id'      => 'zoom_notice',
										'type'    => 'notice',
										'style'   => 'normal',
										'class'   => 'wcgs-light-notice',
										'content' => 'Looking to provide your customers with <a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/zoom-styles/" target="_blank"><strong>a more product-detailed view </strong></a> and <strong>boost sales</strong>? <a href="https://shapedplugin.com/plugin/woocommerce-gallery-slider-pro/?ref=143" target="_blank" class="btn"><strong>Upgrade To Pro!</strong></a>',
									),
								),
							),
							array(
								'title'  => __( 'Product Video Gallery', 'gallery-slider-for-woocommerce' ),
								'icon'   => 'sp_wgs-icon-video-gallery-01',
								'fields' => array(
									array(
										'id'      => 'video_notice',
										'type'    => 'notice',
										'style'   => 'normal',
										'class'   => 'wcgs-light-notice',
										'content' => '<strong>WooGallery Slider</strong> (lite version) allows you to add a <strong>YouTube</strong> video to the Product Gallery. <a href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-add-different-types-of-videos-to-the-product-and-variation-gallery-images/" target="_blank"><b>See Instructions</b></a>. To add <strong>unlimited</strong> and multiple types of videos, e.g., <strong>Self-Hosted, Vimeo, Dailymotion, and Facebook </strong> videos, and enable excellent <a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/play-modes/" target="_blank"><strong>Product Video </strong></a> options, <a href="https://shapedplugin.com/plugin/woocommerce-gallery-slider-pro/?ref=143" target="_blank" class="btn"><strong> Upgrade To Pro!</strong></a>',
									),
									array(
										'id'         => 'video_popup_place',
										'type'       => 'button_set',
										'title'      => __( 'Video Play Mode', 'gallery-slider-for-woocommerce' ),
										'title_help' => __( '<div class="wcgs-info-label">Video Play Mode</div><div class="wcgs-short-content">This option refers to the specific behavior or settings related to how a video is played.</div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-set-a-video-play-mode/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/video-play-mode/" target="_blank">Live Demo</a>', 'gallery-slider-for-woocommerce' ),
										'options'    => array(
											'inline' => __( 'Inline', 'gallery-slider-for-woocommerce' ),
											'popup'  => __( 'Popup', 'gallery-slider-for-woocommerce' ),
										),
										'radio'      => true,
										'default'    => 'popup',
									),
									array(
										'id'         => 'autoplay_video_on_sliding',
										'type'       => 'switcher',
										'class'      => 'pro_switcher',
										'title'      => __( 'AutoPlay Video', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
										'text_width' => 96,
										'default'    => false,
									),
									array(
										'id'         => 'video_looping',
										'type'       => 'switcher',
										'class'      => 'pro_switcher',
										'title'      => __( 'Video Loop ', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
										'text_width' => 96,
										'default'    => false,
									),
									array(
										'id'         => 'video_controls',
										'type'       => 'switcher',
										'class'      => 'pro_switcher',
										'title'      => __( 'Self-hosted Video Player Controls', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Show', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Hide', 'gallery-slider-for-woocommerce' ),
										'text_width' => 80,
										'default'    => true,
									),
									array(
										'id'      => 'video_icon_color',
										'type'    => 'color_group',
										'class'   => 'pro_color_group',
										'title'   => __( 'Video Icon Color', 'gallery-slider-for-woocommerce' ),
										'options' => array(
											'color'       => __( 'Color', 'gallery-slider-for-woocommerce' ),
											'hover_color' => __( 'Hover Color', 'gallery-slider-for-woocommerce' ),
										),
										'default' => array(
											'color'       => '#fff',
											'hover_color' => '#fff',
										),
									),
									array(
										'id'         => 'autoplay_video_on_sliding',
										'type'       => 'switcher',
										'class'      => 'pro_switcher',
										'title'      => __( 'AutoPlay Video', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
										'text_width' => 96,
										'default'    => false,
									),
									array(
										'id'         => 'video_looping',
										'type'       => 'switcher',
										'class'      => 'pro_switcher',
										'title'      => __( 'Video Loop ', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
										'text_width' => 96,
										'default'    => false,
									),
									array(
										'id'      => 'player_style',
										'type'    => 'button_set',
										'class'   => 'pro_button_set',
										'title'   => __( 'Self-hosted Video Player Style', 'gallery-slider-for-woocommerce' ),
										'options' => array(
											'default' => array(
												'option_name' => __( 'Default', 'gallery-slider-for-woocommerce' ),
											),
											'custom'  => array(
												'option_name' => __( 'Custom', 'gallery-slider-for-woocommerce' ),
												'pro_only' => true,
											),
										),
										'radio'   => false,
										'default' => 'default',
									),
									array(
										'id'         => 'yt_video_controls',
										'type'       => 'switcher',
										'class'      => 'pro_switcher',
										'title'      => __( 'YouTube Video Player Controls', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Show', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Hide', 'gallery-slider-for-woocommerce' ),
										'text_width' => 80,
										'default'    => true,
									),
									array(
										'id'         => 'yt_related_video',
										'type'       => 'switcher',
										'class'      => 'pro_switcher',
										'title'      => __( 'Show YouTube Related Videos', 'gallery-slider-for-woocommerce' ),
										'title_help' => __( '<div class="wcgs-info-label">Show YouTube Related Videos</div><div class="wcgs-short-content">This refers to the feature on YouTube that displays a list of suggested videos after the current video has ended, encouraging users to continue watching related content.</div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-show-youtube-related-videos/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/show-youtube-related-videos/" target="_blank">Live Demo</a>', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Show', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Hide', 'gallery-slider-for-woocommerce' ),
										'text_width' => 80,
										'default'    => false,
									),
									array(
										'id'      => 'video_volume',
										'min'     => 0,
										'max'     => 1,
										'step'    => 0.1,
										'default' => 0.5,
										'type'    => 'slider',
										'class'   => 'pro_slider',
										'title'   => __( 'Video Volume', 'gallery-slider-for-woocommerce' ),
									),
									array(
										'id'      => 'video_icon_color',
										'type'    => 'color_group',
										'class'   => 'pro_color_group',
										'title'   => __( 'Video Icon Color', 'gallery-slider-for-woocommerce' ),
										'options' => array(
											'color'       => __( 'Color', 'gallery-slider-for-woocommerce' ),
											'hover_color' => __( 'Hover Color', 'gallery-slider-for-woocommerce' ),
										),
										'default' => array(
											'color'       => '#fff',
											'hover_color' => '#fff',
										),
									),
									array(
										'id'         => 'video_order',
										'type'       => 'select',
										'title'      => __( 'Place of the Videos in Gallery Slider', 'gallery-slider-for-woocommerce' ),
										'title_help' => __( '<div class="wcgs-info-label">Place of the Videos in Gallery Slider</div><div class="wcgs-short-content">Determine where and when you want to display the video.</div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-place-the-videos-in-gallery-slider/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/video-placement/" target="_blank">Live Demo</a>', 'gallery-slider-for-woocommerce' ),
										'options'    => array(
											'usual' => __( 'Place the Videos as Usual', 'gallery-slider-for-woocommerce' ),
											'video_come_first' => __( 'At Starting of the Slider  (Pro)', 'gallery-slider-for-woocommerce' ),
											'video_come_last' => __( 'End of the Slider (Pro)', 'gallery-slider-for-woocommerce' ),
										),
										'radio'      => true,
										'default'    => 'usual',
									),
								),
							),
						),
					),
				),
			),
		);
	}
}
