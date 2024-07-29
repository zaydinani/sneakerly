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
 * WCGS Lightbox class
 */
class WCGS_Lightbox {
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
				'name'   => 'lightbox',
				'icon'   => 'sp_wgs-icon-lightbox-tab',
				'title'  => __( 'Lightbox', 'gallery-slider-for-woocommerce' ),
				'fields' => array(
					array(
						'id'         => 'lightbox',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Enable Lightbox', 'gallery-slider-for-woocommerce' ),
						'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
						'text_width' => 96,
						'default'    => true,
					),
					array(
						'id'         => 'lightbox_sliding_effect',
						'type'       => 'select',
						'title'      => esc_html__( 'Lightbox Sliding Effect', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'slide'    => esc_html__( 'Slide', 'gallery-slider-for-woocommerce' ),
							'fade'     => esc_html__( 'Fade (Pro)', 'gallery-slider-for-woocommerce' ),
							'rotate'   => esc_html__( 'Rotate (Pro)', 'gallery-slider-for-woocommerce' ),
							'circular' => esc_html__( 'Circular (Pro)', 'gallery-slider-for-woocommerce' ),
							'tube'     => esc_html__( 'Tube (Pro)', 'gallery-slider-for-woocommerce' ),
						),
						'default'    => 'slide',
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'         => 'lightbox_icon_position',
						'class'      => 'lightbox_icon_position',
						'type'       => 'image_select',
						'title_help' => __( '<div class="wcgs-info-label">Lightbox Icon Display Position</div><div class="wcgs-short-content">Choose where you want to place the lightbox icon over the product thumbnail.</div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-customize-the-lightbox-icon-display-position/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/lightbox-popup-icon-position/" target="_blank">Live Demo</a>', 'gallery-slider-for-woocommerce' ),
						'title'      => __( 'Lightbox Icon Display Position', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'top_right'    => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/top-right.svg',
								'option_name' => __( 'Top Right', 'gallery-slider-for-woocommerce' ),
							),
							'top_left'     => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/top-left.svg',
								'option_name' => __( 'Top Left', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
							'bottom_right' => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/bottom-right.svg',
								'option_name' => __( 'Bottom Right', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
							'bottom_left'  => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/bottom-left.svg',
								'option_name' => __( 'Bottom Left', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
							'middle'       => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/middle.svg',
								'option_name' => __( 'Middle', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
						),
						'default'    => 'top_right',
						'dependency' => array( 'lightbox', '==', true ),
					),

					array(
						'id'         => 'lightbox_icon',
						'type'       => 'button_set',
						'class'      => 'btn_icon',
						'title'      => esc_html__( 'Lightbox Icon Style', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'search'          => array(
								'option_name' => '<i class="sp_wgs-icon-search"></i>',
							),
							'search-plus'     => array(
								'option_name' => '<i class="sp_wgs-icon-zoom-in-1"></i>',
								'pro_only'    => true,
							),
							'zoom-in'         => array(
								'option_name' => '<i class="sp_wgs-icon-zoom-in"></i>',
								'pro_only'    => true,
							),
							'expand'          => array(
								'option_name' => '<i class="sp_wgs-icon-resize-full"></i>',
								'pro_only'    => true,
							),
							'arrows-alt'      => array(
								'option_name' => '<i class="sp_wgs-icon-resize-full-2"></i>',
								'pro_only'    => true,
							),
							'resize-full-1'   => array(
								'option_name' => '<i class="sp_wgs-icon-resize-full-1"></i>',
								'pro_only'    => true,
							),
							'resize-full-alt' => array(
								'option_name' => '<i class="sp_wgs-icon-resize-full-alt"></i>',
								'pro_only'    => true,
							),
							'eye'             => array(
								'option_name' => '<i class="sp_wgs-icon-eye"></i>',
								'pro_only'    => true,
							),
							'eye-1'           => array(
								'option_name' => '<i class="sp_wgs-icon-eye-1"></i>',
								'pro_only'    => true,
							),
							'plus'            => array(
								'option_name' => '<i class="sp_wgs-icon-plus"></i>',
								'pro_only'    => true,
							),
							'plus-1'          => array(
								'option_name' => '<i class="sp_wgs-icon-plus-1"></i>',
								'pro_only'    => true,
							),
							'info'            => array(
								'option_name' => '<i class="sp_wgs-icon-info"></i>',
								'pro_only'    => true,
							),
						),
						'default'    => 'search',
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'         => 'lightbox_icon_size',
						'class'      => 'pro_only_field',
						'type'       => 'spinner',
						'title'      => esc_html__( 'Lightbox Icon Size', 'gallery-slider-for-woocommerce' ),
						'dependency' => array( 'lightbox', '==', true ),
						'default'    => 13,
						'unit'       => 'px',
					),
					array(
						'id'         => 'lightbox_icon_color_group',
						'type'       => 'color_group',
						'title'      => esc_html__( 'Lightbox Icon Color', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'color'          => esc_html__( 'Color', 'gallery-slider-for-woocommerce' ),
							'hover_color'    => esc_html__( 'Hover Color', 'gallery-slider-for-woocommerce' ),
							'bg_color'       => esc_html__( 'Background', 'gallery-slider-for-woocommerce' ),
							'hover_bg_color' => esc_html__( 'Hover Background', 'gallery-slider-for-woocommerce' ),
						),
						'default'    => array(
							'color'          => '#fff',
							'hover_color'    => '#fff',
							'bg_color'       => 'rgba(0, 0, 0, 0.5)',
							'hover_bg_color' => 'rgba(0, 0, 0, 0.8)',
						),
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'         => 'lightbox_caption',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Lightbox Caption', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => true,
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'             => 'lightbox_caption_size',
						'type'           => 'spinner',
						'title'          => esc_html__( 'Lightbox Caption Size', 'gallery-slider-for-woocommerce' ),
						// 'subtitle'   => esc_html__( 'Set lightbox caption size.', 'gallery-slider-for-woocommerce' ),
							'dependency' => array( 'lightbox|lightbox_caption', '==|==', 'true|true' ),
						'default'        => 14,
						'unit'           => 'px',

					),
					array(
						'id'         => 'caption_color',
						'type'       => 'color',
						'title'      => esc_html__( 'Caption Color', 'gallery-slider-for-woocommerce' ),
						// 'subtitle'   => esc_html__( 'Change caption color.', 'gallery-slider-for-woocommerce' ),
						'default'    => '#ffffff',
						'dependency' => array( 'lightbox|lightbox_caption', '==|==', 'true|true' ),
					),
					array(
						'id'          => 'l_img_counter',
						'type'        => 'switcher',
						'title'       => esc_html__( 'Image Counter', 'gallery-slider-for-woocommerce' ),
						// 'subtitle'   => esc_html__( 'Show lightbox image counter.', 'gallery-slider-for-woocommerce' ),
							'text_on' => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'    => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width'  => 80,
						'default'     => true,
						'dependency'  => array( 'lightbox', '==', true ),
					),

					array(
						'id'         => 'slide_play_btn',
						'type'       => 'switcher',
						'class'      => 'pro_switcher',
						'title'      => esc_html__( 'Slideshow Play Button', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => false,
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'         => 'side_gallery_btn',
						'class'      => 'pro_switcher',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Thumbnails Gallery Button', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => false,
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'         => 'thumb_gallery_show',
						'type'       => 'switcher',
						'class'      => 'pro_switcher',
						'title'      => esc_html__( 'Thumbnails Gallery Visibility', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'title_help' => '<div class="wcgs-img-tag"><img src="' . plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/thumbnails-side-gallery-visibility.svg" alt=""></div><div class="wcgs-info-label">Thumbnails Gallery</div>',
						'default'    => false,
						'text_width' => 80,
						'dependency' => array( 'lightbox', '==', true ),
					),

					array(
						'id'         => 'gallery_share',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Social Share Button', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => false,
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'         => 'gallery_fs_btn',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Full Screen Button', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => false,
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'         => 'gallery_dl_btn',
						'type'       => 'switcher',
						'class'      => 'pro_switcher',
						'title'      => esc_html__( 'Download Button', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => false,
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'         => 'shoppage_video_notice',
						'type'       => 'notice',
						'style'      => 'normal',
						'class'      => 'wcgs-light-notice',
						'content'    => 'Want to unlock the full potential of <a href="https://demo.shapedplugin.com/woo-gallery-slider-pro/lightbox-sliding-effects/" target="_blank" class="btn"> <strong> Advanced Lightbox </strong> </a> features and <strong>Skyrocket</strong> conversions? <a href="https://shapedplugin.com/plugin/woocommerce-gallery-slider-pro/?ref=143" target="_blank" class="btn"><strong>Upgrade To Pro!</strong></a>',
						'dependency' => array( 'lightbox', '==', true ),
					),
				),
			)
		);
	}
}
