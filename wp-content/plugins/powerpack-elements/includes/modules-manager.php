<?php
namespace PowerpackElements;

use PowerpackElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Modules_Manager {
	/**
	 * @var Module_Base[]
	 */
	private $modules = [];

	public function register_modules() {
		$modules = [
			'advanced-accordion',
			'advanced-menu',
			'advanced-tabs',
			'album',
			'author-list',
			'breadcrumbs',
			'business-hours',
			'business-reviews',
			'buttons',
			'categories',
			'contact-form-seven',
			'content-reveal',
			'countdown',
			'counter',
			'coupons',
			'devices',
			'divider',
			'faq',
			'flipbox',
			'fluent-forms',
			'formidable-forms',
			'headings',
			'gallery',
			'google-maps',
			'gravity-forms',
			'headings',
			'hotspots',
			'how-to',
			'icon-list',
			'image-accordion',
			'image-comparison',
			'info-box',
			'info-list',
			'info-table',
			'instafeed',
			'link-effects',
			'login-form',
			'logos',
			'modal-popup',
			'ninja-forms',
			'offcanvas-content',
			'onepage-nav',
			'posts',
			'pricing',
			'promo-box',
			'random-image',
			'recipe',
			'registration-form',
			'review-box',
			'scroll-image',
			'showcase',
			'sitemap',
			'tabbed-gallery',
			'team-member',
			'testimonials',
			'toggle',
			'table',
			'toc',
			'twitter',
			'video',
			'query-post',
			'query-control',
			'wpforms',
			'templates-content',
			'display-conditions',
			'dynamic-tags',
			'presets-style',
		];

		if ( is_pp_woocommerce() ) {
			$modules[] = 'woocommerce';
		}

		ksort( $modules );

		foreach ( $modules as $module_name ) {
			$class_name = str_replace( '-', ' ', $module_name );

			$class_name = str_replace( ' ', '', ucwords( $class_name ) );

			$class_name = __NAMESPACE__ . '\\Modules\\' . $class_name . '\Module';

			/** @var Module_Base $class_name */
			if ( $class_name::is_active() ) {
				$this->modules[ $module_name ] = $class_name::instance();
			}
		}
	}

	/**
	 * @param string $module_name
	 *
	 * @return Module_Base|Module_Base[]
	 */
	public function get_modules( $module_name = null ) {
		if ( $module_name ) {
			if ( isset( $this->modules[ $module_name ] ) ) {
				return $this->modules[ $module_name ];
			}

			return null;
		}

		return $this->modules;
	}

	private function require_files() {
		require( POWERPACK_ELEMENTS_PATH . 'base/module-base.php' );
	}

	public function __construct() {
		$this->require_files();
		$this->register_modules();
	}
}
