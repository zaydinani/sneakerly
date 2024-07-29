<?php
/**
 * The admin settings page of this plugin.
 *
 * Defines various settings of Gallery Slider for WooCommerce.
 *
 * @package    Woo_Gallery_Slider
 * @subpackage Woo_Gallery_Slider/admin
 * @author     Shapedplugin <support@shapedplugin.com>
 */

/**
 * WCGS Settings class
 */
class WCGS_Settings {
	/**
	 * Initialize the WooCommerce Settings page for the admin area.
	 *
	 * @since    1.0.0
	 * @param string $prefix Define prefix wcgs_settings.
	 */
	public static function options( $prefix ) {
		WCGS::createOptions(
			$prefix,
			array(
				'framework_title'    => '',
				'framework_class'    => 'wcgs-settings',
				'class'              => 'wcgs-preloader',
				'menu_title'         => esc_html__( 'WooGallery Slider', 'gallery-slider-for-woocommerce' ),
				'menu_slug'          => 'wpgs-settings',
				'menu_icon'          => 'data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiBmb2N1c2FibGU9ImZhbHNlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIgoJIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMjQgMjQiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDI0IDI0OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+Cgkuc3Qwe2ZpbGw6I0ZGRkZGRjt9Cjwvc3R5bGU+CjxnPgoJPHBhdGggY2xhc3M9InN0MCIgZD0iTTAsMS45djIwLjFDMCwyMy4xLDAuOSwyNCwxLjksMjRoMjAuMWMxLjEsMCwxLjktMC45LDEuOS0xLjlWMS45QzI0LDAuOSwyMy4xLDAsMjIuMSwwSDEuOUMwLjksMCwwLDAuOSwwLDEuOQoJCXogTTIxLjQsMjIuM0gyLjZjLTAuNSwwLTEtMC40LTEtMVYyLjZjMC0wLjUsMC40LTEsMS0xaDE4LjdjMC41LDAsMSwwLjQsMSwxdjE4LjdDMjIuMywyMS45LDIxLjksMjIuMywyMS40LDIyLjN6Ii8+Cgk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNNy45LDE3LjR2Mi44YzAsMC4zLTAuMiwwLjUtMC41LDAuNUgzLjhjLTAuMywwLTAuNS0wLjItMC41LTAuNXYtMi44YzAtMC4zLDAuMi0wLjUsMC41LTAuNWgzLjUKCQlDNy42LDE2LjksNy45LDE3LjEsNy45LDE3LjR6Ii8+Cgk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNMTQuNSwxNy40djIuOGMwLDAuMy0wLjIsMC41LTAuNSwwLjVoLTRjLTAuMywwLTAuNS0wLjItMC41LTAuNXYtMi44YzAtMC4zLDAuMi0wLjUsMC41LTAuNWg0CgkJQzE0LjIsMTYuOSwxNC41LDE3LjEsMTQuNSwxNy40eiIvPgoJPHBhdGggY2xhc3M9InN0MCIgZD0iTTIwLjYsMTcuNHYyLjhjMCwwLjMtMC4yLDAuNS0wLjUsMC41aC0zLjVjLTAuMywwLTAuNS0wLjItMC41LTAuNXYtMi44YzAtMC4zLDAuMi0wLjUsMC41LTAuNWgzLjUKCQlDMjAuNCwxNi45LDIwLjYsMTcuMSwyMC42LDE3LjR6Ii8+Cgk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNMy40LDMuOHYxMC45YzAsMC4zLDAuMiwwLjUsMC41LDAuNWgxNi4zYzAuMywwLDAuNS0wLjIsMC41LTAuNVYzLjhjMC0wLjMtMC4yLTAuNS0wLjUtMC41SDMuOAoJCUMzLjYsMy40LDMuNCwzLjYsMy40LDMuOHogTTUuNCwxMi44bDMuOC03YzAuMi0wLjMsMC43LTAuMywwLjgsMGwyLjcsNC45YzAuMiwwLjMsMC43LDAuMywwLjgsMGwwLjQtMC43YzAuMi0wLjMsMC43LTAuMywwLjgsMAoJCWwxLjUsMi43YzAuMiwwLjMtMC4xLDAuNy0wLjQsMC43aC0xMEM1LjUsMTMuNSw1LjMsMTMuMSw1LjQsMTIuOHogTTE2LjgsOS40Yy0xLjIsMC0yLjItMS0yLjItMi4yYzAtMS4yLDEtMi4xLDIuMS0yLjEKCQlDMTgsNSwxOSw2LDE5LDcuMkMxOC45LDguNCwxOCw5LjMsMTYuOCw5LjR6Ii8+CjwvZz4KPC9zdmc+',
				'show_reset_section' => true,
				'show_search'        => false,
				'show_all_options'   => false,
				'theme'              => 'light',
				'show_footer'        => false,
				'sticky_header'      => true,
				'show_sub_menu'      => false,
				'footer_credit'      => __( 'Enjoying <strong>Gallery Slider for WooCommerce?</strong> Please rate us <span class="spwpcp-footer-text-star">★★★★★</span> <a href="https://wordpress.org/support/plugin/gallery-slider-for-woocommerce/reviews/?filter=5#new-post" target="_blank">WordPress.org</a>. Your positive feedback will help us grow more. Thank you! 😊', 'gallery-slider-for-woocommerce' ),
				'footer_after'       => "<div id='BuyProPopupContent' style='display: none;'>
				<div class='wcgs-popup-content'><div class='pro-image-tag'><span class='pro-icon'><img src='" .  plugin_dir_url( __DIR__ ) . 'img/go-pro-icon.svg'  . "'></span></div><h2> Upgrade to <strong>WooGallery Slider Pro</strong></h2>
				<h3>To unlock this feature, simply upgrade To Pro!</h3>
				<p class='wcgs-popup-p'>" . __( 'Take your online shop\'s product page experience to the next level with many premium features and <strong>Boost Sales!</strong> 🚀', 'gallery-slider-for-woocommerce' ) . "</p>
				<p><a href='" . esc_url( WOO_GALLERY_SLIDER_PRO_LINK ) . "' target='_blank' class='btn'>" . __( 'Upgrade To Pro Now', 'gallery-slider-for-woocommerce' ) . '</a></p></div></div>',
			)
		);

		// <div id="myOnPageContent" style="display: none;"> <div class="wcgs-popup-content">
		// <h2> <Upgrade to <strong>WooGallery Slider Pro</strong></h2>

		// <p> Take your online shop product page experience to the next
		// level ton of premium features and Boost Sales! 🚀</p> <p><a target="_blank" href=' . esc_url( WOO_GALLERY_SLIDER_PRO_LINK ) . ' class="btn">Get the Pro version</a></p></div> </div>
		WCGS_General::section( $prefix );
		WCGS_Gallery::section( $prefix );
		WCGS_Lightbox::section( $prefix );
		WCGSP_Shoppage::section( $prefix );
		WCGS_Advance::section( $prefix );
		WCGS_Help::section( $prefix );
	}
}
