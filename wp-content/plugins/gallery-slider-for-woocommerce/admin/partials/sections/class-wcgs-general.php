<?php
/**
 * The general tab functionality of this plugin.
 *
 * Defines the sections of general tab.
 *
 * @package    Woo_Gallery_Slider
 * @subpackage Woo_Gallery_Slider/admin
 * @author     Shapedplugin <support@shapedplugin.com>
 */

/**
 * WCGS General class
 */
class WCGS_General {
	/**
	 * Specify the Generation tab for the Woo Gallery Slider.
	 *
	 * @since    1.0.0
	 * @param string $prefix Define prefix wcgs_settings.
	 */
	public static function section( $prefix ) {
		WCGS::createSection(
			$prefix,
			array(
				'name'   => 'general',
				'title'  => __( 'General', 'gallery-slider-for-woocommerce' ),
				'icon'   => 'sp_wgs-icon-general-tab',
				'fields' => array(
					array(
						'id'      => 'gallery_layout',
						'type'    => 'image_select',
						'class'   => 'gallery_layout',
						'title'   => __( 'Gallery Layout', 'gallery-slider-for-woocommerce' ),
						'desc'    => 'Want to <strong> boost your sales </strong> by enhancing your product page design and <a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/gallery-layouts/" target="_blank"><strong>layout</strong></a>? <a href="' . WOO_GALLERY_SLIDER_PRO_LINK . '" target="_blank"><strong>Upgrade To Pro!</strong></a>',
						'options' => array(
							'horizontal'     => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/horizontal_bottom.svg',
								'option_name' => __( 'Horizontal Bottom', 'gallery-slider-for-woocommerce' ),
							),
							'horizontal_top' => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/horizontal_top.svg',
								'option_name' => __( 'Horizontal Top', 'gallery-slider-for-woocommerce' ),
							),
							'vertical'       => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/vertical_left.svg',
								'option_name' => __( 'Vertical Left', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
							'vertical_right' => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/vertical_right.svg',
								'option_name' => __( 'Vertical Right', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
							'hide_thumb'     => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/hide_thumbnails.svg',
								'option_name' => __( 'Hide Thumbnails', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
						),
						'default' => 'horizontal',
					),

					array(
						'id'         => 'thumbnails_item_to_show',
						'min'        => 1,
						'max'        => 10,
						'step'       => 1,
						'default'    => 4,
						'type'       => 'slider',
						'title'      => __( 'Thumbnails Item To Show', 'gallery-slider-for-woocommerce' ),
						'dependency' => array( 'gallery_layout', '!=', 'hide_thumb' ),
						'title_help' => '<div class="wcgs-info-label">Thumbnails Item To Show</div><div class="wcgs-short-content">Number of item per view (slides visible at the same time on thumbnail slider\'s container).</div>',
					),
					array(
						'id'          => 'thumbnails_sliders_space',
						'type'        => 'dimensions',
						'title'       => __( 'Thumbnails Space', 'gallery-slider-for-woocommerce' ),
						'title_help'  => '<div class="wcgs-img-tag"><img src="' . plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/th_space.svg" alt=""></div> <div class="wcgs-info-label">Thumbnails Space</div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-set-space-between-thumbnails/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/thumbnails-space-inner-padding-size-border/" target="_blank">Live Demo</a>',
						'width_text'  => __( 'Gap', 'gallery-slider-for-woocommerce' ),
						'height_text' => __( 'Vertical Gap', 'gallery-slider-for-woocommerce' ),
						'units'       => array( 'px' ),
						'unit'        => 'px',
						'default'     => array(
							'width'  => '6',
							'height' => '6',
						),
						'attributes'  => array(
							'min' => 0,
						),
						'dependency'  => array( 'gallery_layout', '!=', 'hide_thumb' ),
					),

					array(
						'id'         => 'thumbnails_sizes',
						'type'       => 'image_sizes',
						'title'      => __( 'Thumbnails Size', 'gallery-slider-for-woocommerce' ),
						'title_help' => '<div class="wcgs-info-label">Thumbnails Size</div><div class="wcgs-short-content">Adjust the thumbnail Size according to your website design.</div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-configure-thumbnails-size/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/thumbnails-space-inner-padding-size-border/#thumb-size" target="_blank">Live Demo</a>',
						'default'    => 'shop_thumbnail',
						'dependency' => array( 'gallery_layout', '!=', 'hide_thumb' ),
					),
					array(
						'id'         => 'thumb_crop_size',
						'type'       => 'dimensions',
						'class'      => 'pro_only_field',
						'title'      => __( 'Custom Size', 'gallery-slider-for-woocommerce' ),
						'units'      => array(
							'Soft-crop',
							'Hard-crop',
						),
						'default'    => array(
							'width'  => '100',
							'height' => '100',
							'unit'   => 'Soft-crop',
						),
						'attributes' => array(
							'min' => 0,
						),
						'dependency' => array( 'thumbnails_sizes|gallery_layout', '==|!=', 'custom|hide_thumb' ),
					),
					array(
						'id'         => 'thumbnails_load_2x_image',
						'type'       => 'switcher',
						'class'      => 'pro_switcher',
						'title'      => __( 'Load 2x Resolution Image in Retina Display', 'gallery-slider-for-woocommerce' ),
						'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
						'text_width' => 96,
						'default'    => false,
						'dependency' => array( 'thumbnails_sizes', '==', 'custom' ),
					),
					array(
						'id'         => 'border_normal_width_for_thumbnail',
						'class'      => 'border_active_thumbnail',
						'type'       => 'border',
						'title'      => __( 'Thumbnails Border', 'gallery-slider-for-woocommerce' ),
						'color'      => true,
						'style'      => false,
						'color2'     => false,
						'all'        => true,
						'radius'     => true,
						'default'    => array(
							'color'  => '#dddddd',
							// 'color2' => '#5EABC1',
							'color3' => '#0085BA',
							'all'    => 2,
							'radius' => 0,
						),
						'dependency' => array( 'gallery_layout', '!=', 'hide_thumb' ),
					),
					array(
						'id'         => 'thumbnails_hover_effect',
						'type'       => 'select',
						'title'      => __( 'Thumbnails Hover Effect', 'gallery-slider-for-woocommerce' ),
						'title_help' => '<div class="wcgs-info-label">Thumbnail Hover Effect</div><div class="wcgs-short-content">A hover effect will enhance user engagement and make the browsing experience more interactive.</div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-set-thumbnails-hover-effects/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/thumbnails-hover-effects/" target="_blank">Live Demo</a>',
						'options'    => array(
							'none'       => __( 'Normal', 'gallery-slider-for-woocommerce' ),
							'zoom_in'    => __( 'Zoom In <span>(Pro)</span>', 'gallery-slider-for-woocommerce' ),
							'zoom_out'   => __( 'Zoom Out  <span>(Pro)</span>', 'gallery-slider-for-woocommerce' ),
							'slide_up'   => __( 'Slide Up <span>(Pro)</span>', 'gallery-slider-for-woocommerce' ),
							'slide_down' => __( 'Slide Down  <span>(Pro)</span>', 'gallery-slider-for-woocommerce' ),
						),
						'default'    => 'none',
						'dependency' => array( 'gallery_layout', '!=', 'hide_thumb' ),
					),
					array(
						'id'         => 'thumb_active_on',
						'type'       => 'radio',
						'title'      => __( 'Thumbnails Activate On', 'gallery-slider-for-woocommerce' ),
						'title_help' => '<div class="wcgs-info-label">Thumbnails Activate on</div><div class="wcgs-short-content">Choose thumbnail activator type.<p><b>Click:</b> The user or visitor has to click on the thumbnail to change the product image.<br/><b>Mouseover:</b> The product image will be replaced when the mouse hovers over the thumbnail.</p></div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-do-you-want-to-activate-thumbnails/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/thumbnails-activation/" target="_blank">Live Demo</a>',
						'options'    => array(
							'click'     => __( 'Click', 'gallery-slider-for-woocommerce' ),
							'mouseover' => array(
								'option_name' => __( 'Mouseover', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
						),
						'default'    => 'click',
					),
					array(
						'id'         => 'thumbnail_style',
						'class'      => 'thumbnail_style',
						'type'       => 'image_select',
						'title_help' => __( '<div class="wcgs-info-label">Active Thumbnail Style</div><div class="wcgs-short-content">The option refers to the visual presentation of a thumbnail when it is in an active or selected state.</div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-choose-an-active-thumbnails-style/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/active-thumbnail-styles/" target="_blank">Live Demo</a>', 'gallery-slider-for-woocommerce' ),
						'title'      => __( 'Active Thumbnail Style', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'border_around' => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/border-around.svg',
								'option_name' => __( 'Border Around', 'gallery-slider-for-woocommerce' ),
							),
							'bottom_line'   => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/bottom-line.svg',
								'option_name' => __( 'Bottom Line', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
							'zoom_out'      => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/zoom-out.svg',
								'option_name' => __( 'Zoom Out', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
							'opacity'       => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/opacity.svg',
								'option_name' => __( 'Opacity', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
						),
						'default'    => 'border_around',
					),
					array(
						'id'         => 'border_width_for_active_thumbnail',
						'class'      => 'border_active_thumbnail',
						'type'       => 'border',
						'title'      => __( 'Active Thumbnail Border', 'gallery-slider-for-woocommerce' ),
						'title_help' => '<div class="wcgs-img-tag"><img src="' . plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/active-thumbnail-border.svg" alt=""></div><div class="wcgs-info-label">Active Thumbnail Border</div>',
						'color'      => false,
						'color2'     => true,
						'color3'     => false,
						'style'      => false,
						'all'        => true,
						'radius'     => false,
						'default'    => array(
							'color2' => '#0085BA',
							'all'    => 2,
						),
						// 'dependency' => array( 'gallery_layout|thumbnail_style', '!=|!=', 'hide_thumb|bottom_line' ),
					),
					array(
						'id'         => 'inactive_thumbnails_effect',
						'type'       => 'select',
						'title'      => __( 'Inactive Thumbnails Effect', 'gallery-slider-for-woocommerce' ),
						'title_help' => '<div class="wcgs-info-label">Inactive Thumbnails Effect</div><div class="wcgs-short-content">Refers to the visual treatment of thumbnails that are not currently selected or in focus.</div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-do-you-want-to-stylize-inactive-thumbnails/" target="_blank">Open Docs</a><a class="wcgs-open-live-demo" href="https://demo.shapedplugin.com/woo-gallery-slider-pro/inactive-thumbnails-effect/" target="_blank">Live Demo</a>',
						'options'    => array(
							'none'      => __( 'Normal', 'gallery-slider-for-woocommerce' ),
							'opacity'   => __( 'Opacity (Pro)', 'gallery-slider-for-woocommerce' ),
							'grayscale' => __( 'Grayscale (Pro)', 'gallery-slider-for-woocommerce' ),
						),
						'default'    => 'none',
						// 'dependency' => array( 'gallery_layout|thumbnail_style', '!=|!=', 'hide_thumb|opacity' ),
					),
					array(
						'id'         => 'gallery_width',
						'type'       => 'slider',
						'title'      => __( 'Gallery Width', 'gallery-slider-for-woocommerce' ),
						'title_help' => '<div class="wcgs-img-tag"><img src="' . plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/gallery-width.svg" alt=""></div><div class="wcgs-info-label">Gallery Width</div><div class="wcgs-short-content">If you are using a Block theme or custom template for the single product page, set the gallery width to 100%.</div><a class="wcgs-open-docs" href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/configurations/how-to-set-gallery-width/" target="_blank">Open Docs</a>',
						'default'    => 50,
						'unit'       => '%',
						'min'        => 1,
						'step'       => 1,
						'max'        => 100,
					),
					array(
						'id'         => 'gallery_responsive_width',
						'class'      => 'gallery_responsive_width',
						'type'       => 'dimensions_res',
						'title'      => __( 'Responsive Gallery Width', 'gallery-slider-for-woocommerce' ),
						'default'    => array(
							'width'   => '0',
							'height'  => '720',
							'height2' => '480',
							'unit'    => 'px',
						),
						'title_help' => '<i class="sp-wgsp-icon-laptop"></i>A default value of 0 means that the thumbnail gallery will inherit the Gallery Width value intended for large devices. This default Gallery width is set to 50% up above,<br> <i class="sp-wgsp-icon-tablet
						"></i> Tablet -Screen size is smaller than 768px. Set the value in between 480-768,<br> <i class="sp-wgsp-icon-mobile"></i> Mobile - Screen size is smaller than 480px.  Set a value between 0-480.',
					),
					array(
						'id'         => 'gallery_bottom_gap',
						'type'       => 'spinner',
						'title'      => __( 'Gallery Bottom Gap', 'gallery-slider-for-woocommerce' ),
						'title_help' => '<div class="wcgs-img-tag"><img src="' . plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/gallery-bottom-gap.svg" alt=""></div><div class="wcgs-info-label">Gallery Bottom Gap</div>',
						'default'    => 30,
						'unit'       => 'px',
					),

					array(
						'id'         => 'gallery_image_source',
						'type'       => 'radio',
						'title'      => __( 'Gallery Image Source', 'gallery-slider-for-woocommerce' ),
						'title_help' => __( '<div class="wcgs-info-label">Gallery Image Source</div><div class="wcgs-short-content">Choose a source from where you want to display the gallery images.</div>', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'attached' => __( 'All images attached to this product content', 'gallery-slider-for-woocommerce' ),
							'uploaded' => __( 'Only images uploaded to the product gallery', 'gallery-slider-for-woocommerce' ),
						),
						'default'    => 'uploaded',
					),
					array(
						'id'         => 'include_feature_image_to_gallery',
						'type'       => 'checkbox',
						'title'      => __( 'Include Feature Image', 'gallery-slider-for-woocommerce' ),
						'title_help' => '<div class="wcgs-info-label">Include Featured Image</div><div class="wcgs-short-content">Check to include featured images in the default gallery and variation gallery.</div>',
						'default'    => 'default_gl',
						'options'    => array(
							'default_gl'  => __( 'To Default Gallery', 'gallery-slider-for-woocommerce' ),
							'variable_gl' => __( 'To Variation Gallery', 'gallery-slider-for-woocommerce' ),
						),
					),
					array(
						'id'         => 'include_variation_and_default_gallery',
						'type'       => 'checkbox',
						'class'      => 'pro_checkbox',
						'title'      => esc_html__( 'Show Default Gallery with Variation Images', 'gallery-slider-for-woocommerce' ),
						'title_help' => '<div class="wcgs-info-label">Default Gallery with Variation Images</div><div class="wcgs-short-content">Check to show the default product gallery along with variation images.</div>',
						'default'    => false,
					),
					array(
						'id'         => 'show_caption',
						'type'       => 'switcher',
						'class'      => 'pro_switcher',
						'title'      => __( 'Gallery Image Caption', 'gallery-slider-for-woocommerce' ),
						'title_help' => '<div class="wcgs-img-tag"><img src="' . plugin_dir_url( __DIR__ ) . '/shapedplugin-framework/assets/images/help-visuals/gallery_image_caption.svg" alt=""></div><div class="wcgs-info-label">Gallery Bottom Gap</div>',
						'text_on'    => __( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => false,
					),

				),
			)
		);
	}
}
