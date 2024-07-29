<?php
/**
 * The advance tab functionality of this plugin.
 *
 * Defines the sections of advance tab.
 *
 * @package    Woo_Gallery_Slider
 * @subpackage Woo_Gallery_Slider/admin
 * @author     Shapedplugin <support@shapedplugin.com>
 */

/**
 * WCGS Advance class
 */
class WCGS_Advance {
	/**
	 * Specify the Advance tab for the Woo Gallery Slider.
	 *
	 * @since    1.0.0
	 * @param string $prefix Define prefix wcgs_settings.
	 */
	public static function section( $prefix ) {
		WCGS::createSection(
			$prefix,
			array(
				'name'   => 'advance',
				'icon'   => 'sp_wgs-icon-advanced-tab',
				'title'  => __( 'Advanced', 'gallery-slider-for-woocommerce' ),
				'fields' => array(
					array(
						'type' => 'tabbed',
						'tabs' => array(
							array(
								'title'  => __( 'Advanced Controls', 'gallery-slider-for-woocommerce' ),
								'icon'   => 'sp_wgs-icon-advanced-2',
								'fields' => array(
									array(
										'id'         => 'wcgs_data_remove',
										'type'       => 'checkbox',
										'title'      => __( 'Clean-up Data on Deletion', 'gallery-slider-for-woocommerce' ),
										'title_help' => __( 'Check this box if you would like Woo Gallery Slider plugin to completely remove all of its data when the plugin is deleted.', 'gallery-slider-for-woocommerce' ),
									),
									array(
										'id'         => 'shortcode',
										'class'      => 'spwg_shortcode',
										'type'       => 'text',
										'shortcode'  => true,
										'title'      => __( 'Shortcode', 'gallery-slider-for-woocommerce' ),
										'desc'       => __( 'If the gallery slider is not displaying automatically on your product pages when edited using page builders (<b>Divi, Elementor, Bricks</b> Builder, etc.), use this shortcode manually to render the gallery slider. <a href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce-pro/troubleshooting/how-to-fix-gallery-slider-display-issues-in-different-page-builders/" target="_blank"><b>See Instructions.</b></a>', 'gallery-slider-for-woocommerce' ),
										'attributes' => array(
											'readonly' => '',
										),
										'default'    => '[wcgs_gallery_slider]',
									),
									array(
										'type'    => 'subheading',
										'content' => __( 'Assets (Styles and Scripts)', 'gallery-slider-for-woocommerce' ),
									),
									array(
										'id'         => 'enqueue_fancybox_css',
										'type'       => 'switcher',
										'title'      => __( 'FancyBox CSS', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enqueued', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Dequeued', 'gallery-slider-for-woocommerce' ),
										'text_width' => 100,
										'default'    => true,
									),
									array(
										'id'         => 'enqueue_fancybox_js',
										'type'       => 'switcher',
										'title'      => __( 'FancyBox JS', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enqueued', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Dequeued', 'gallery-slider-for-woocommerce' ),
										'text_width' => 100,
										'default'    => true,
									),
									array(
										'id'         => 'enqueue_swiper_css',
										'type'       => 'switcher',
										'title'      => __( 'Swiper CSS', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enqueued', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Dequeued', 'gallery-slider-for-woocommerce' ),
										'text_width' => 100,
										'default'    => true,
									),
									array(
										'id'         => 'enqueue_swiper_js',
										'type'       => 'switcher',
										'title'      => __( 'Swiper JS', 'gallery-slider-for-woocommerce' ),
										'text_on'    => __( 'Enqueued', 'gallery-slider-for-woocommerce' ),
										'text_off'   => __( 'Dequeued', 'gallery-slider-for-woocommerce' ),
										'text_width' => 100,
										'default'    => true,
									),
								),
							),
							array(
								'title'  => __( 'Additional CSS & JS', 'gallery-slider-for-woocommerce' ),
								'icon'   => 'dashicons dashicons-editor-code',
								'fields' => array(
									array(
										'id'       => 'wcgs_additional_css',
										'type'     => 'code_editor',
										'title'    => __( 'Additional CSS', 'gallery-slider-for-woocommerce' ),
										'settings' => array(
											'theme' => 'mbo',
											'mode'  => 'css',
										),
									),
									array(
										'id'       => 'wcgs_additional_js',
										'type'     => 'code_editor',
										'title'    => __( 'Additional JS', 'gallery-slider-for-woocommerce' ),
										'settings' => array(
											'theme' => 'mbo',
											'mode'  => 'js',
										),
									),
								),
							),
							array(
								'title'  => __( 'License Key', 'gallery-slider-for-woocommerce' ),
								'icon'   => 'sp_wgs-icon-license-tab',
								'fields' => array(
									array(
										'id'      => 'license_notice',
										'type'    => 'notice',
										'style'   => 'normal',
										'class'   => 'wcgs-light-notice align-center',
										'content' => __( 'Premium license key provides you access to regular updates and expert support 👨🏻‍💻', 'gallery-slider-for-woocommerce' ),
									),
									array(
										'id'   => 'license_key',
										'type' => 'license',
									),
								),
							),
						),
					),

				),
			)
		);
	}
}
