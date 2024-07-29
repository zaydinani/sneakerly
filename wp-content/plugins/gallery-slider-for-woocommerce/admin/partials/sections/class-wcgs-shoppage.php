<?php
/**
 * The gallery tab functionality of this plugin.
 *
 * Defines the sections of gallery tab.
 *
 * @package    Woo_Gallery_Slider_Pro
 * @subpackage Woo_Gallery_Slider_Pro/admin
 * @author     Shapedplugin <support@shapedplugin.com>
 */

/**
 * WCGSP_Lightbox
 */
class WCGSP_Shoppage {
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
				'name'   => 'shop_page_video',
				'icon'   => 'sp_wgs-icon-video-01-1',
				'title'  => __( 'Shop Page Video', 'gallery-slider-for-woocommerce' ),
				'fields' => array(
					array(
						'id'      => 'shop_page_video_notice',
						'class'   => 'shop_page_video_notice wcgs-light-notice',
						'type'    => 'notice',
						'style'   => 'normal',
						'content' => 'Want to show multiple types of product videos on the <a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/shop/" target="_blank"><strong>Shop/Archive Page</strong></a> and speed up customer decision-making? <a href="https://shapedplugin.com/plugin/woocommerce-gallery-slider-pro/?ref=143" target="_blank" class="btn"><strong>Upgrade To Pro!</strong></a>',
					),
					array(
						'id'         => 'wcgs_video_shop',
						'type'       => 'switcher',
						'class'      => 'pro_switcher',
						'title'      => __( 'Show Product Video on the Shop or Archive Page', 'gallery-slider-for-woocommerce' ),
						'title_help' => __( 'The featured image will be replaced by image video.', 'gallery-slider-for-woocommerce' ),
						'title_help' => '<div class="wcgs-img-tag big-tooltip"><img src="' . plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/video-shop-page.svg" alt=""></div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-show-product-video-on-the-shop-page/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/shop-or-archive-page-video/" target="_blank">Live Demo</a>',
						'text_on'    => __( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => false,
					),
					array(
						'id'      => 'shoppage_video_popup_place',
						'type'    => 'button_set',
						'class'   => 'pro_button_set',
						'title'   => __( 'Video Play Mode', 'gallery-slider-for-woocommerce' ),
						'options' => array(
							'inline' => array(
								'option_name' => __( 'Inline', 'gallery-slider-for-woocommerce' ),
							),
							'popup'  => array(
								'option_name' => __( 'Popup', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
						),
						'default' => 'inline',
						'radio'   => true,
					),
					array(
						'id'      => 'shoppage_video_icon',
						'class'   => 'shop_video_icon pro_button_set',
						'type'    => 'button_set',
						'title'   => __( 'Video Icon Style', 'gallery-slider-for-woocommerce' ),
						'options' => array(
							'play-01' => array(
								'option_name' => '<i class="sp_wgs-icon-play-01"></i>',
							),
							'play-02' => array(
								'option_name' => '<i class="sp_wgs-icon-play-02"></i>',
								'pro_only'    => true,
							),
							'play-03' => array(
								'option_name' => '<i class="sp_wgs-icon-play-03"></i>',
								'pro_only'    => true,
							),
							'play-04' => array(
								'option_name' => '<i class="sp_wgs-icon-play-04"></i>',
								'pro_only'    => true,
							),
							'play-05' => array(
								'option_name' => '<i class="sp_wgs-icon-play-05"></i>',
								'pro_only'    => true,
							),
							'play-06' => array(
								'option_name' => '<i class="sp_wgs-icon-play-06"></i>',
								'pro_only'    => true,
							),
							'play-07' => array(
								'option_name' => '<i class="sp_wgs-icon-play-07"></i>',
								'pro_only'    => true,
							),
							'play-08' => array(
								'option_name' => '<i class="sp_wgs-icon-play-08"></i>',
								'pro_only'    => true,
							),
							'play-09' => array(
								'option_name' => '<i class="sp_wgs-icon-play-09"></i>',
								'pro_only'    => true,
							),
							'native'  => array(
								'option_name' => __( 'Native', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
							'custom'  => array(
								'option_name' => __( 'Custom', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
						),
						'default' => 'play-01',
					),
					array(
						'id'      => 'shop_video_icon_size',
						'type'    => 'spinner',
						'title'   => __( 'Video Icon Size', 'gallery-slider-for-woocommerce' ),
						'default' => 44,
						'unit'    => 'px',
						'class'   => 'pro_only_field',
					),
					array(
						'id'      => 'shop_video_icon_position',
						'class'   => 'lightbox_icon_position shop_video_icon_position',
						'type'    => 'image_select',
						'title'   => __( 'Video Icon Position', 'gallery-slider-for-woocommerce' ),
						'options' => array(
							'middle'       => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/shop-video-position/middle.svg',
								'option_name' => __( 'Middle', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
							'bottom_right' => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/shop-video-position/bottom-right.svg',
								'option_name' => __( 'Bottom Right', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
							'bottom_left'  => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/shop-video-position/bottom-left.svg',
								'option_name' => __( 'Bottom left', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
							'top_right'    => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/shop-video-position/top-right.svg',
								'option_name' => __( 'Top Right', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
							'top_left'     => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/shop-video-position/top-left.svg',
								'option_name' => __( 'Top left', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
						),
						'default' => 'middle',
					),
					array(
						'id'      => 'shop_page_video_icon_color',
						'type'    => 'color_group',
						'title'   => __( 'Video Icon Color', 'gallery-slider-for-woocommerce' ),
						'class'   => 'pro_color_group',
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
						'id'      => 'shop_page_video_bg',
						'class'   => 'pro_only_color',
						'type'    => 'color',
						'title'   => __( 'Video Background', 'gallery-slider-for-woocommerce' ),
						'default' => '#1e1e1e',
					),
					array(
						'id'         => 'autoplay_video_shop',
						'type'       => 'switcher',
						'class'      => 'pro_switcher',
						'title'      => __( 'AutoPlay Video', 'gallery-slider-for-woocommerce' ),
						'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
						'text_width' => 96,
						'default'    => false,

					),
					array(
						'id'      => 'video_play_event',
						'type'    => 'radio',
						'title'   => __( 'Video Play On', 'gallery-slider-for-woocommerce' ),
						'options' => array(
							'click'     => array(
								'option_name' => __( 'Click', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
							'mouseover' => array(
								'option_name' => __( 'Mouseover', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
						),
						'default' => 'click',
					),
					array(
						'id'         => 'shop_video_looping',
						'type'       => 'switcher',
						'class'      => 'pro_switcher',
						'title'      => __( 'Video Loop ', 'gallery-slider-for-woocommerce' ),
						'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
						'text_width' => 96,
						'default'    => false,
					),
					array(
						'id'      => 'shop_video_volume',
						'min'     => 0,
						'max'     => 1,
						'step'    => 0.1,
						'default' => 0.8,
						'type'    => 'slider',
						'class'      => 'pro_slider',
						'title'   => __( 'Video Volume', 'gallery-slider-for-woocommerce' ),
					),
					array(
						'id'         => 'shop_video_controls',
						'type'       => 'switcher',
						'class'      => 'pro_switcher',
						'title'      => __( 'Video Player Controls', 'gallery-slider-for-woocommerce' ),
						'text_on'    => __( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'title_help' => __( 'This feature will work in self hosted, and youtube video', 'gallery-slider-for-woocommerce' ),
						'default'    => true,
					),
					array(
						'id'      => 'shop_player_style',
						'type'    => 'button_set',
						'class'   => 'pro_button_set',
						'title'   => __( 'Self-hosted Video Player Style', 'gallery-slider-for-woocommerce' ),
						'options' => array(
							'default' => array(
								'option_name' => __( 'Default', 'gallery-slider-for-woocommerce' ),
							),
							'custom'  => array(
								'option_name' => __( 'Custom', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
						),
						'radio'   => true,
						'default' => 'default',
					),
					array(
						'id'         => 'shop_video_ratio_type',
						'type'       => 'radio',
						'title'      => __( 'Video Aspect Ratio', 'gallery-slider-for-woocommerce' ),
						'title_help' => __( 'Same as Featured Image is recommended. The video wrapper ratio will be the same as the product image ratio.', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'as_featured' => array(
								'option_name' => __( 'Same as Featured Image', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
							'custom'      => array(
								'option_name' => __( 'Custom', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
						),
						'default'    => 'custom',
					),
					array(
						'id'         => 'shop_video_ratio',
						'class'      => 'pro_only_field',
						'type'       => 'text',
						'default'    => '16:9',
						'title'      => __( 'Custom Ratio', 'gallery-slider-for-woocommerce' ),
						'title_help' => __( 'Set the aspect ratio for the video frame(width: height)', 'gallery-slider-for-woocommerce' ),
					),
					array(
						'id'         => 'shop_video_playback',
						'type'       => 'switcher',
						'class'      => 'pro_switcher',
						'title'      => __( 'Video Playback on Mobile', 'gallery-slider-for-woocommerce' ),
						'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
						'text_width' => 96,
						'default'    => true,
					),
					array(
						'id'         => 'shop_video_preloader',
						'type'       => 'switcher',
						'class'      => 'pro_switcher',
						'title'      => __( 'Video Preloader', 'gallery-slider-for-woocommerce' ),
						'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
						'text_width' => 96,
						'default'    => true,
					),
				),
			)
		);
	}
}
