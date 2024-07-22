<?php
namespace PowerpackElements\Modules\AdvancedTabs\Widgets;

use PowerpackElements\Base\Powerpack_Widget;
use PowerpackElements\Classes\PP_Config;
use PowerpackElements\Classes\PP_Helper;
use PowerpackElements\Classes\PP_Posts_Helper;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Advanced Tabs Widget
 */
class Advanced_Tabs extends Powerpack_Widget {

	/**
	 * Retrieve Advanced Tabs widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return parent::get_widget_name( 'Advanced_Tabs' );
	}

	/**
	 * Retrieve Advanced Tabs widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return parent::get_widget_title( 'Advanced_Tabs' );
	}

	/**
	 * Retrieve Advanced Tabs widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return parent::get_widget_icon( 'Advanced_Tabs' );
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the Advanced Tabs widget belongs to.
	 *
	 * @since 1.4.13.1
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return parent::get_widget_keywords( 'Advanced_Tabs' );
	}

	protected function is_dynamic_content(): bool {
		return false;
	}

	/**
	 * Retrieve the list of scripts the Advanced Tabs widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return array(
			'pp-advanced-tabs',
		);
	}

	/**
	 * Register Advanced Tabs widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 2.0.3
	 * @access protected
	 */
	protected function register_controls() {
		/* Content Tab */
		$this->register_content_tabs_controls();
		$this->register_content_query_controls();
		$this->register_content_layout_controls();
		$this->register_content_help_docs_controls();

		/* Style Tab */
		$this->register_style_tabs_controls();
		$this->register_style_title_controls();
		$this->register_style_content_controls();
	}

	protected function register_content_tabs_controls() {
		/**
		 * Content Tab: Advanced Tabs
		 */
		$this->start_controls_section(
			'section_advanced_tabs',
			array(
				'label' => __( 'Advanced Tabs', 'powerpack' ),
			)
		);

		$this->add_control(
			'source',
			array(
				'label'   => __( 'Source', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'manual',
				'options' => array(
					'manual' => __( 'Manual', 'powerpack' ),
					'posts'  => __( 'Posts', 'powerpack' ),
				),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'     => __( 'Posts Count', 'powerpack' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 3,
				'condition' => array(
					'source' => 'posts',
				),
			)
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'tabs_at' );

		$repeater->start_controls_tab(
			'tab_content',
			array(
				'label' => __( 'Content', 'powerpack' ),
			)
		);

		$repeater->add_control(
			'tab_title',
			array(
				'label'       => __( 'Title', 'powerpack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'placeholder' => __( 'Title', 'powerpack' ),
				'default'     => __( 'Title', 'powerpack' ),
			)
		);

		$repeater->add_control(
			'content_type',
			array(
				'label'   => __( 'Content Type', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'tab_content',
				'options' => array(
					'tab_content' => __( 'Content', 'powerpack' ),
					'tab_photo'   => __( 'Image', 'powerpack' ),
					'tab_video'   => __( 'Link (Video/Image)', 'powerpack' ),
					'section'     => __( 'Saved Section', 'powerpack' ),
					'widget'      => __( 'Saved Widget', 'powerpack' ),
					'template'    => __( 'Saved Page Template', 'powerpack' ),
				),
			)
		);

		$repeater->add_control(
			'content',
			array(
				'label'     => __( 'Content', 'powerpack' ),
				'type'      => Controls_Manager::WYSIWYG,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => __( 'I am tab content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'powerpack' ),
				'condition' => array(
					'content_type' => 'tab_content',
				),
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'     => __( 'Image', 'powerpack' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'content_type' => 'tab_photo',
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image',
				'label'     => __( 'Image Size', 'powerpack' ),
				'default'   => 'large',
				'exclude'   => array( 'custom' ),
				'condition' => array(
					'content_type' => 'tab_photo',
				),
			)
		);

		$repeater->add_control(
			'link_video',
			array(
				'label'       => __( 'Link', 'powerpack' ),
				'description' => sprintf( __( 'Check list of supported embeds <a href="%1$s" target="_blank">here</a>.', 'powerpack' ), 'https://wordpress.org/support/article/embeds/' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'ai'          => array(
					'active' => false,
				),
				'placeholder' => __( 'Enter your Video link', 'powerpack' ),
				'label_block' => true,
				'condition'   => array(
					'content_type' => 'tab_video',
				),
			)
		);

		$repeater->add_control(
			'saved_widget',
			array(
				'label'       => __( 'Choose Widget', 'powerpack' ),
				'type'        => 'pp-query',
				'label_block' => false,
				'multiple'    => false,
				'query_type'  => 'templates-widget',
				'conditions'  => array(
					'terms' => array(
						array(
							'name'     => 'content_type',
							'operator' => '==',
							'value'    => 'widget',
						),
					),
				),
			)
		);

		$repeater->add_control(
			'saved_section',
			array(
				'label'       => __( 'Choose Section', 'powerpack' ),
				'type'        => 'pp-query',
				'label_block' => false,
				'multiple'    => false,
				'query_type'  => 'templates-section',
				'conditions'  => array(
					'terms' => array(
						array(
							'name'     => 'content_type',
							'operator' => '==',
							'value'    => 'section',
						),
					),
				),
			)
		);

		$repeater->add_control(
			'templates',
			array(
				'label'       => __( 'Choose Template', 'powerpack' ),
				'type'        => 'pp-query',
				'label_block' => false,
				'multiple'    => false,
				'query_type'  => 'templates-page',
				'conditions'  => array(
					'terms' => array(
						array(
							'name'     => 'content_type',
							'operator' => '==',
							'value'    => 'template',
						),
					),
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'tab_icon',
			array(
				'label' => __( 'Icon', 'powerpack' ),
			)
		);

		$repeater->add_control(
			'pp_icon_type',
			[
				'label'             => __( 'Icon Type', 'powerpack' ),
				'type'              => Controls_Manager::CHOOSE,
				'label_block'       => false,
				'toggle'            => false,
				'default'           => 'icon',
				'options'           => [
					'none'  => [
						'title' => esc_html__( 'None', 'powerpack' ),
						'icon'  => 'eicon-ban',
					],
					'icon'  => [
						'title' => esc_html__( 'Icon', 'powerpack' ),
						'icon'  => 'eicon-star',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'powerpack' ),
						'icon'  => 'eicon-image-bold',
					],
				],
			]
		);

		$repeater->add_control(
			'selected_icon',
			array(
				'label'            => __( 'Icon', 'powerpack' ),
				'type'             => Controls_Manager::ICONS,
				'label_block'      => true,
				'default'          => array(
					'value'   => 'fas fa-check',
					'library' => 'fa-solid',
				),
				'fa4compatibility' => 'icon',
				'condition'        => [
					'pp_icon_type' => 'icon',
				],
			)
		);

		$repeater->add_control(
			'icon_img',
			[
				'label'             => __( 'Image', 'powerpack' ),
				'label_block'       => true,
				'type'              => Controls_Manager::MEDIA,
				'default'           => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic'           => [
					'active'  => true,
				],
				'condition'         => [
					'pp_icon_type' => 'image',
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'icon_img',
				'label'     => __( 'Image Size', 'powerpack' ),
				'default'   => 'full',
				'condition' => array(
					'pp_icon_type' => 'image',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'tab_features',
			array(
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'tab_title' => __( 'Tab #1', 'powerpack' ),
						'content'   => __( 'I am tab 1 content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'powerpack' ),
					),
					array(
						'tab_title' => __( 'Tab #2', 'powerpack' ),
						'content'   => __( 'I am tab 2 content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'powerpack' ),
					),
					array(
						'tab_title' => __( 'Tab #3', 'powerpack' ),
						'content'   => __( 'I am tab 3 content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'powerpack' ),
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ tab_title }}}',
				'condition'   => array(
					'source' => 'manual',
				),
			)
		);

		$repeater_posts = new Repeater();

		$repeater_posts->add_control(
			'dynamic_tab_title',
			array(
				'label'     => __( 'Title', 'powerpack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'post_title',
				'options'   => array(
					'post_title'  => __( 'Post Title', 'powerpack' ),
					'post_author' => __( 'Post Author', 'powerpack' ),
					'post_date'   => __( 'Post Date', 'powerpack' ),
					//'custom_data' => __( 'Custom Data', 'powerpack' ),
				),
			)
		);

		/* $repeater_posts->add_control(
			'dynamic_tab_title_custom_data',
			array(
				'label'     => __( 'Custom Data', 'powerpack' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => '',
				'condition' => array(
					'dynamic_tab_title' => 'custom_data',
				),
			)
		); */

		$repeater_posts->add_control(
			'dynamic_tab_content',
			array(
				'label'     => __( 'Content', 'powerpack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'post_content',
				'options'   => array(
					'post_title'     => __( 'Post Title', 'powerpack' ),
					'post_author'    => __( 'Post Author', 'powerpack' ),
					'post_date'      => __( 'Post Date', 'powerpack' ),
					'post_excerpt'   => __( 'Post Excerpt', 'powerpack' ),
					'post_content'   => __( 'Post Content', 'powerpack' ),
					'post_thumbnail' => __( 'Featured Image', 'powerpack' ),
					//'custom_data'    => __( 'Custom Data', 'powerpack' ),
				),
			)
		);

		/* $repeater_posts->add_control(
			'dynamic_tab_content_custom_data',
			array(
				'label'     => __( 'Custom Data', 'powerpack' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => '',
				'condition' => array(
					'dynamic_tab_content' => 'custom_data',
				),
			)
		); */

		$this->add_control(
			'dynamic_tabs_content',
			array(
				'label'        => '',
				'type'         => Controls_Manager::REPEATER,
				'fields'       => $repeater_posts->get_controls(),
				'item_actions' => [
					'add'       => false,
					'duplicate' => false,
					'remove'    => false,
					'sort'      => false,
				],
				'default'      => array(
					array(
						'dynamic_tab_title'   => 'post_title',
						'dynamic_tab_content' => 'post_content',
					),
				),
				'condition'    => array(
					'source' => 'posts',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function register_content_query_controls() {
		/**
		 * Content Tab: Query
		 */
		$this->start_controls_section(
			'section_post_query',
			[
				'label'     => __( 'Query', 'powerpack' ),
				'condition' => [
					'source' => 'posts',
				],
			]
		);

		$this->add_control(
			'post_type',
			[
				'label'   => __( 'Post Type', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'options' => PP_Posts_Helper::get_post_types(),
				'default' => 'post',

			]
		);

		$post_types = PP_Posts_Helper::get_post_types();

		foreach ( $post_types as $post_type_slug => $post_type_label ) {

			$taxonomy = PP_Posts_Helper::get_post_taxonomies( $post_type_slug );

			if ( ! empty( $taxonomy ) ) {

				foreach ( $taxonomy as $index => $tax ) {

					$terms = PP_Posts_Helper::get_tax_terms( $index );

					$tax_terms = array();

					if ( ! empty( $terms ) ) {

						foreach ( $terms as $term_index => $term_obj ) {

							$tax_terms[ $term_obj->term_id ] = $term_obj->name;
						}

						if ( 'post' === $post_type_slug ) {
							if ( 'post_tag' === $index ) {
								$tax_control_key = 'tags';
							} elseif ( 'category' === $index ) {
								$tax_control_key = 'categories';
							} else {
								$tax_control_key = $index . '_' . $post_type_slug;
							}
						} else {
							$tax_control_key = $index . '_' . $post_type_slug;
						}

						// Taxonomy filter type
						$this->add_control(
							$index . '_' . $post_type_slug . '_filter_type',
							[
								/* translators: %s Label */
								'label'       => sprintf( __( '%s Filter Type', 'powerpack' ), $tax->label ),
								'type'        => Controls_Manager::SELECT,
								'default'     => 'IN',
								'label_block' => true,
								'options'     => [
									/* translators: %s label */
									'IN'     => sprintf( __( 'Include %s', 'powerpack' ), $tax->label ),
									/* translators: %s label */
									'NOT IN' => sprintf( __( 'Exclude %s', 'powerpack' ), $tax->label ),
								],
								'separator'         => 'before',
								'condition'   => [
									'post_type' => $post_type_slug,
								],
							]
						);

						$this->add_control(
							$tax_control_key,
							[
								'label'         => $tax->label,
								'type'          => 'pp-query',
								'post_type'     => $post_type_slug,
								'options'       => [],
								'label_block'   => true,
								'multiple'      => true,
								'query_type'    => 'terms',
								'object_type'   => $index,
								'include_type'  => true,
								'condition'   => [
									'post_type' => $post_type_slug,
								],
							]
						);

					}
				}
			}
		}

		$this->add_control(
			'author_filter_type',
			[
				'label'       => __( 'Authors Filter Type', 'powerpack' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'author__in',
				'label_block' => true,
				'separator'   => 'before',
				'options'     => [
					'author__in'     => __( 'Include Authors', 'powerpack' ),
					'author__not_in' => __( 'Exclude Authors', 'powerpack' ),
				],
			]
		);

		$this->add_control(
			'authors',
			[
				'label'       => __( 'Authors', 'powerpack' ),
				'type'        => 'pp-query',
				'label_block' => true,
				'multiple'    => true,
				'query_type'  => 'authors',
				'condition'   => [
					'post_type!' => 'related',
				],
			]
		);

		foreach ( $post_types as $post_type_slug => $post_type_label ) {

			if ( 'post' === $post_type_slug ) {
				$posts_control_key = 'exclude_posts';
			} else {
				$posts_control_key = $post_type_slug . '_filter';
			}

			$this->add_control(
				$post_type_slug . '_filter_type',
				[
					'label'       => sprintf( __( '%s Filter Type', 'powerpack' ), $post_type_label ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'post__not_in',
					'label_block' => true,
					'separator'   => 'before',
					'options'     => [
						'post__in'     => sprintf( __( 'Include %s', 'powerpack' ), $post_type_label ),
						'post__not_in' => sprintf( __( 'Exclude %s', 'powerpack' ), $post_type_label ),
					],
					'condition'   => [
						'post_type' => $post_type_slug,
					],
				]
			);

			$this->add_control(
				$posts_control_key,
				[
					'label'       => $post_type_label,
					'type'        => 'pp-query',
					'default'     => '',
					'multiple'    => true,
					'label_block' => true,
					'query_type'  => 'posts',
					'object_type' => $post_type_slug,
					'condition'   => [
						'post_type' => $post_type_slug,
					],
				]
			);
		}

		$this->add_control(
			'select_date',
			[
				'label'       => __( 'Date', 'powerpack' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'anytime' => __( 'All', 'powerpack' ),
					'today'   => __( 'Past Day', 'powerpack' ),
					'week'    => __( 'Past Week', 'powerpack' ),
					'month'   => __( 'Past Month', 'powerpack' ),
					'quarter' => __( 'Past Quarter', 'powerpack' ),
					'year'    => __( 'Past Year', 'powerpack' ),
					'exact'   => __( 'Custom', 'powerpack' ),
				],
				'default'     => 'anytime',
				'label_block' => false,
				'multiple'    => false,
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'date_before',
			[
				'label'       => __( 'Before', 'powerpack' ),
				'description' => __( 'Setting a ‘Before’ date will show all the posts published until the chosen date (inclusive).', 'powerpack' ),
				'type'        => Controls_Manager::DATE_TIME,
				'label_block' => false,
				'multiple'    => false,
				'placeholder' => __( 'Choose', 'powerpack' ),
				'condition'   => [
					'select_date' => 'exact',
				],
			]
		);

		$this->add_control(
			'date_after',
			[
				'label'       => __( 'After', 'powerpack' ),
				'description' => __( 'Setting an ‘After’ date will show all the posts published since the chosen date (inclusive).', 'powerpack' ),
				'type'        => Controls_Manager::DATE_TIME,
				'label_block' => false,
				'multiple'    => false,
				'placeholder' => __( 'Choose', 'powerpack' ),
				'condition'   => [
					'select_date' => 'exact',
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'     => __( 'Order', 'powerpack' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'DESC' => __( 'Descending', 'powerpack' ),
					'ASC'  => __( 'Ascending', 'powerpack' ),
				],
				'default'   => 'DESC',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Order By', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'date'          => __( 'Date', 'powerpack' ),
					'modified'      => __( 'Last Modified Date', 'powerpack' ),
					'rand'          => __( 'Random', 'powerpack' ),
					'comment_count' => __( 'Comment Count', 'powerpack' ),
					'title'         => __( 'Title', 'powerpack' ),
					'ID'            => __( 'Post ID', 'powerpack' ),
					'author'        => __( 'Post Author', 'powerpack' ),
				],
				'default' => 'date',
			]
		);

		$this->add_control(
			'sticky_posts',
			[
				'label'        => __( 'Sticky Posts', 'powerpack' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'powerpack' ),
				'label_off'    => __( 'No', 'powerpack' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'all_sticky_posts',
			[
				'label'             => __( 'Show Only Sticky Posts', 'powerpack' ),
				'type'              => Controls_Manager::SWITCHER,
				'default'           => '',
				'label_on'          => __( 'Yes', 'powerpack' ),
				'label_off'         => __( 'No', 'powerpack' ),
				'return_value'      => 'yes',
				'condition'         => [
					'sticky_posts' => 'yes',
				],
			]
		);

		$this->add_control(
			'offset',
			[
				'label'       => __( 'Offset', 'powerpack' ),
				'description' => __( 'Use this setting to skip this number of initial posts', 'powerpack' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => '',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'query_id',
			array(
				'label'       => __( 'Query ID', 'powerpack' ),
				'description' => __( 'Give your Query a custom unique id to allow server side filtering', 'powerpack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'separator'   => 'before',
			)
		);

		$this->end_controls_section();
	}

	protected function register_content_layout_controls() {
		/**
		 * Content Tab: Layout
		 */
		$this->start_controls_section(
			'section_general_layout',
			array(
				'label' => __( 'Layout', 'powerpack' ),
			)
		);
		$this->add_control(
			'type',
			array(
				'label'   => __( 'Layout', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'at-horizontal',
				'options' => array(
					'at-horizontal' => __( 'Horizontal', 'powerpack' ),
					'at-vertical'   => __( 'Vertical', 'powerpack' ),
				),
			)
		);

		$this->add_control(
			'responsive_support',
			array(
				'label'   => __( 'Responsive Support', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'tablet',
				'options' => array(
					'no'     => __( 'No', 'powerpack' ),
					'tablet' => __( 'For Tablet & Mobile', 'powerpack' ),
					'mobile' => __( 'For Mobile Only', 'powerpack' ),
				),
			)
		);

		$this->add_control(
			'custom_style',
			array(
				'label'   => __( 'Select Style', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-0',
				'options' => array(
					'style-0'      => __( 'Basic', 'powerpack' ),
					'style-1'      => __( 'Style 1', 'powerpack' ),
					'style-2'      => __( 'Style 2', 'powerpack' ),
					'style-3'      => __( 'Style 3', 'powerpack' ),
					'style-4'      => __( 'Style 4', 'powerpack' ),
					'style-5'      => __( 'Style 5', 'powerpack' ),
					'style-6'      => __( 'Style 6', 'powerpack' ),
					'style-7'      => __( 'Style 7', 'powerpack' ),
					'style-8'      => __( 'Style 8', 'powerpack' ),
					'style-custom' => __( 'Custom', 'powerpack' ),
				),
			)
		);

		$this->add_control(
			'scroll_top',
			array(
				'label'       => __( 'Scroll to Top', 'powerpack' ),
				'description' => __( 'Scrolls to top of tabs contaniner when clicked on tab title.', 'powerpack' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'no',
				'options'     => array(
					'yes' => __( 'Yes', 'powerpack' ),
					'no'  => __( 'No', 'powerpack' ),
				),
				'condition'   => array(
					'type' => 'at-vertical',
				),
			)
		);

		$this->add_control(
			'default_tab',
			array(
				'label'       => __( 'Default Active Tab Index', 'powerpack' ),
				'type'        => Controls_Manager::NUMBER,
				'label_block' => false,
				'min'         => 1,
				'step'        => 1,
				'default'     => 1,
				'placeholder' => __( 'Default Active Tab Index', 'powerpack' ),
			)
		);

		$this->add_control(
			'custom_id_prefix',
			array(
				'label'       => __( 'Custom ID Prefix', 'powerpack' ),
				'description' => __( 'A prefix that will be applied to ID attribute of tabs\'s in HTML. For example, prefix "mytab" will be applied as "mytab-1", "mytab-2" in ID attribute of Tab 1 and Tab 2 respectively. It should only contain dashes, underscores, letters or numbers. No spaces.', 'powerpack' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => '',
				'ai'          => [
					'active' => false,
				],
				'placeholder' => __( 'mytab', 'powerpack' ),
			)
		);

		$this->end_controls_section();
	}

	protected function register_content_help_docs_controls() {

		$help_docs = PP_Config::get_widget_help_links( 'Advanced_Tabs' );

		if ( ! empty( $help_docs ) ) {
			/**
			 * Content Tab: Help Docs
			 *
			 * @since 1.4.8
			 * @access protected
			 */
			$this->start_controls_section(
				'section_help_docs',
				array(
					'label' => __( 'Help Docs', 'powerpack' ),
				)
			);

			$hd_counter = 1;
			foreach ( $help_docs as $hd_title => $hd_link ) {
				$this->add_control(
					'help_doc_' . $hd_counter,
					array(
						'type'            => Controls_Manager::RAW_HTML,
						'raw'             => sprintf( '%1$s ' . $hd_title . ' %2$s', '<a href="' . $hd_link . '" target="_blank" rel="noopener">', '</a>' ),
						'content_classes' => 'pp-editor-doc-links',
					)
				);

				$hd_counter++;
			}

			$this->end_controls_section();
		}
	}

	protected function register_style_tabs_controls() {
		/**
		 * Style Tab: Tabs
		 */
		$this->start_controls_section(
			'section_tabs_style',
			array(
				'label' => __( 'Tabs', 'powerpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'title_align_horizontal',
			array(
				'label'     => __( 'Horizontal Alignment', 'powerpack' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Left', 'powerpack' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'powerpack' ),
						'icon'  => 'eicon-h-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Right', 'powerpack' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'   => 'center',
				'condition' => array(
					'type' => 'at-horizontal',
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-advanced-tabs-wrapper.at-horizontal, {{WRAPPER}} .pp-advanced-tabs .pp-advanced-tabs-content-wrapper .pp-tab-responsive.pp-advanced-tabs-title' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'title_margin_right',
			array(
				'label'      => __( 'Margin Right', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 0,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'condition'  => array(
					'type'                   => 'at-horizontal',
					'title_align_horizontal' => 'flex-end',
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .at-horizontal .pp-advanced-tabs-title:last-child' => 'margin-right: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'title_margin_left',
			array(
				'label'      => __( 'Margin Left', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 0,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'condition'  => array(
					'type'                   => 'at-horizontal',
					'title_align_horizontal' => 'flex-start',
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .at-horizontal .pp-advanced-tabs-title:first-child' => 'margin-left: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'title_align_vertical',
			array(
				'label'     => __( 'Vertical Alignment', 'powerpack' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Top', 'powerpack' ),
						'icon'  => 'eicon-v-align-top',
					),
					'center'     => array(
						'title' => __( 'Center', 'powerpack' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'flex-end'   => array(
						'title' => __( 'Bottom', 'powerpack' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'   => 'flex-start',
				'condition' => array(
					'type' => 'at-vertical',
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-advanced-tabs-wrapper.at-vertical' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'tabs_position_vertical',
			array(
				'label'                => __( 'Position', 'powerpack' ),
				'type'                 => Controls_Manager::CHOOSE,
				'options'              => array(
					'left'  => array(
						'title' => __( 'Left', 'powerpack' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => __( 'Right', 'powerpack' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'              => 'left',
				'selectors_dictionary' => array(
					'left'  => 'row',
					'right' => 'row-reverse',
				),
				'selectors'            => array(
					'{{WRAPPER}} .pp-advanced-tabs' => 'flex-direction: {{VALUE}};',
				),
				'condition'            => array(
					'type' => 'at-vertical',
				),
			)
		);

		$this->add_responsive_control(
			'title_margin_top',
			array(
				'label'      => __( 'Margin Top', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 0,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'condition'  => array(
					'type'                 => 'at-vertical',
					'title_align_vertical' => 'flex-start',
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .at-vertical .pp-advanced-tabs-title:first-child' => 'margin-top: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'title_margin_bottom',
			array(
				'label'      => __( 'Margin Bottom', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 0,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'condition'  => array(
					'type'                 => 'at-vertical',
					'title_align_vertical' => 'flex-end',
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .at-vertical .pp-advanced-tabs-title:last-child' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'title_space',
			array(
				'label'      => __( 'Space Between Tabs', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 0,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .at-horizontal .pp-advanced-tabs-title:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .at-horizontal-content .pp-advanced-tabs-title:not(:first-child)' => 'margin-top: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .at-vertical .pp-advanced-tabs-title:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					'(tablet){{WRAPPER}} .pp-tabs-responsive-tablet .pp-tabs-panel:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					'(mobile){{WRAPPER}} .pp-tabs-responsive-mobile .pp-tabs-panel:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'tabs_container_background_color',
			[
				'label'                 => __( 'Background Color', 'powerpack' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .pp-advanced-tabs-wrapper, {{WRAPPER}} .pp-style-6 .pp-advanced-tabs-title.pp-tab-responsive' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'tabs_container_border_radius',
			[
				'label'                 => __( 'Border Radius', 'powerpack' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%', 'em' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-advanced-tabs-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tabs_container_padding',
			[
				'label'                 => __( 'Padding', 'powerpack' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-advanced-tabs-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_title_controls() {
		/**
		 * Style Tab: Title
		 */
		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => __( 'Title', 'powerpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'icon_position',
			array(
				'label'   => __( 'Icon Position', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'top'    => __( 'Top', 'powerpack' ),
					'bottom' => __( 'Bottom', 'powerpack' ),
					'left'   => __( 'Left', 'powerpack' ),
					'right'  => __( 'Right', 'powerpack' ),
				),
				'default' => 'left',
			)
		);
		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => __( 'Icon Size', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 15,
				),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-advanced-tabs-title .pp-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'icon_image_width',
			array(
				'label'      => __( 'Icon Image Width', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 30,
				),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-advanced-tabs-title .pp-icon-img img' => 'width: {{SIZE}}{{UNIT}}',
				),
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'title_border_radius',
			array(
				'label'      => __( 'Border Radius', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'top'    => 0,
					'bottom' => 0,
					'left'   => 0,
					'right'  => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-advanced-tabs-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'title_padding',
			array(
				'label'      => __( 'Padding', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'separator'  => 'after',
				'default'    => array(
					'top'    => 10,
					'bottom' => 10,
					'left'   => 10,
					'right'  => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-advanced-tabs-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'powerpack' ),
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .pp-advanced-tabs-title .pp-advanced-tabs-title-text',
			)
		);
		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			array(
				'label' => __( 'Normal', 'powerpack' ),
			)
		);
		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Icon Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#808080',
				'selectors' => array(
					'{{WRAPPER}} .pp-advanced-tabs-title .pp-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pp-advanced-tabs-title svg' => 'fill: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'title_text_color',
			array(
				'label'     => __( 'Title Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#808080',
				'selectors' => array(
					'{{WRAPPER}} .pp-advanced-tabs-title .pp-advanced-tabs-title-text' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'title_bg_color',
			array(
				'label'     => __( 'Title Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .pp-advanced-tabs-title' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'custom_style!' => 'style-6',
				),
			)
		);
		$this->add_control(
			'title_border_color',
			array(
				'label'     => __( 'Title Border Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#808080',
				'selectors' => array(
					'{{WRAPPER}} .pp-advanced-tabs-title' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .pp-style-6 .pp-advanced-tabs-title:after, {{WRAPPER}} .pp-style-6 .pp-advanced-tabs-title.pp-tab-responsive.pp-tab-active' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'custom_style' => array( 'style-6' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'tab_title_border',
				'label'     => esc_html__( 'Border', 'powerpack' ),
				'selector'  => '{{WRAPPER}} .pp-style-custom .pp-advanced-tabs-title',
				'condition' => array(
					'custom_style' => array( 'style-custom' ),
				),
			)
		);

		$this->end_controls_tab(); // End Normal Tab

		$this->start_controls_tab(
			'tab_title_active',
			array(
				'label' => __( 'Active', 'powerpack' ),
			)
		);
		$this->add_control(
			'icon_color_active',
			array(
				'label'     => __( 'Icon Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .pp-advanced-tabs-title.pp-tab-active .pp-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pp-advanced-tabs-title.pp-tab-active svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .at-hover .pp-advanced-tabs-title:hover .pp-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .at-hover .pp-advanced-tabs-title:hover svg' => 'fill: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'title_text_color_active',
			array(
				'label'     => __( 'Title Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .pp-tab-active .pp-advanced-tabs-title-text' => 'color: {{VALUE}}',
					'{{WRAPPER}} .at-hover .pp-advanced-tabs-title:hover .pp-advanced-tabs-title-text' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'title_bg_color_active',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-tab-active' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .at-hover .pp-advanced-tabs-title:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .pp-style-1 .at-horizontal .pp-tab-active:after' => 'border-top-color: {{VALUE}}',
					'{{WRAPPER}} .pp-style-1 .at-vertical .pp-tab-active:after' => 'border-left-color: {{VALUE}}',
					'{{WRAPPER}} .pp-style-6 .pp-advanced-tabs-title.pp-tab-active:after' => 'background-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'title_border_color_active',
			array(
				'label'     => __( 'Border Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'condition' => array(
					'custom_style!' => array( 'style-1', 'style-6', 'style-7', 'style-8' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-tab-active, {{WRAPPER}} .pp-style-custom .pp-advanced-tabs-title.pp-tab-active' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .at-hover .pp-advanced-tabs-title:hover' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .pp-style-2 .pp-advanced-tabs-title.pp-tab-active:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .pp-style-2 .at-hover .pp-advanced-tabs-title.pp-tab-active:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .pp-style-3 .pp-advanced-tabs-title.pp-tab-active:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .pp-style-3 .at-hover .pp-advanced-tabs-title.pp-tab-active:before' => 'background-color: {{VALUE}}',
				),
			)
		);
			$this->add_control(
				'title_animation_color',
				array(
					'label'     => __( 'Animation Color', 'powerpack' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#000000',
					'condition' => array(
						'custom_style' => array( 'style-4', 'style-5', 'style-7', 'style-8' ),
					),
					'selectors' => array(
						'{{WRAPPER}} .pp-style-4 .pp-advanced-tabs-title.pp-tab-active:before' => 'background-color: {{VALUE}}',
						'{{WRAPPER}} .pp-style-4 .pp-advanced-tabs-title.pp-tab-active:after' => 'background-color: {{VALUE}}',
						'{{WRAPPER}} .pp-style-5 .pp-advanced-tabs-title.pp-tab-active:before' => 'background-color: {{VALUE}}',
						'{{WRAPPER}} .pp-style-5 .pp-advanced-tabs-title.pp-tab-active:after' => 'background-color: {{VALUE}}',
						'{{WRAPPER}} .pp-style-7 .pp-advanced-tabs-title .active-slider-span' => 'background-color: {{VALUE}}',
						'{{WRAPPER}} .pp-style-8 .pp-advanced-tabs-title .active-slider-span' => 'background-color: {{VALUE}}',
					),
				)
			);
		$this->end_controls_tab(); // End Hover Tab

		$this->end_controls_tabs(); // End Controls Tab

		$this->add_control(
			'tab_hover_effect',
			array(
				'label'     => __( 'Hover Effect', 'powerpack' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'yes' => array(
						'title' => __( 'Yes', 'powerpack' ),
						'icon'  => 'eicon-check',
					),
					'no'  => array(
						'title' => __( 'No', 'powerpack' ),
						'icon'  => 'eicon-ban',
					),
				),
				'condition' => array(
					'custom_style!' => array( 'style-6' ),
				),
				'separator' => 'before',
				'default'   => 'no',
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_content_controls() {
		/**
		 * Style Tab: Content
		 */
		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => __( 'Content', 'powerpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'tab_align',
			array(
				'label'     => __( 'Alignment', 'powerpack' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'start'  => array(
						'title' => __( 'Left', 'powerpack' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'powerpack' ),
						'icon'  => 'eicon-text-align-center',
					),
					'end'    => array(
						'title' => __( 'Right', 'powerpack' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'separator' => 'after',
				'selectors' => array(
					'{{WRAPPER}} .pp-advanced-tabs-content'   => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tab_bg_style',
				'label'    => __( 'Background', 'powerpack' ),
				'types'    => array( 'none', 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pp-advanced-tabs-content',
			)
		);
		$this->add_control(
			'text_color',
			array(
				'label'     => __( 'Text Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#808080',
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .pp-advanced-tabs-content' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tab_text_typography',
				'label'    => __( 'Text Typography', 'powerpack' ),
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .pp-advanced-tabs-content',
			)
		);

		$this->add_control(
			'tab_border_type',
			array(
				'label'     => __( 'Border Type', 'powerpack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'none'   => __( 'None', 'powerpack' ),
					'solid'  => __( 'Solid', 'powerpack' ),
					'double' => __( 'Double', 'powerpack' ),
					'dotted' => __( 'Dotted', 'powerpack' ),
					'dashed' => __( 'Dashed', 'powerpack' ),
					'groove' => __( 'Groove', 'powerpack' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-advanced-tabs-content' => 'border-style: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'tab_border_width',
			array(
				'label'      => __( 'Border Width', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'    => 1,
					'bottom' => 1,
					'left'   => 1,
					'right'  => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-advanced-tabs-content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'tab_border_type!' => 'none',
				),
			)
		);

		$this->add_control(
			'tab_border_color',
			array(
				'label'     => __( 'Border Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#808080',
				'selectors' => array(
					'{{WRAPPER}} .pp-advanced-tabs-content' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'tab_border_type!' => 'none',
				),
			)
		);
		$this->add_control(
			'tab_border_radius',
			array(
				'label'      => __( 'Border Radius', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'separator'  => 'before',
				'default'    => array(
					'top'    => 0,
					'bottom' => 0,
					'left'   => 0,
					'right'  => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-advanced-tabs-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'tab_padding',
			array(
				'label'      => __( 'Padding', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'    => 10,
					'bottom' => 10,
					'left'   => 10,
					'right'  => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-advanced-tabs-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_section();
	}

	/**
	 * Get post query arguments.
	 *
	 * @access protected
	 */
	protected function get_posts_query_arguments() {
		$settings    = $this->get_settings_for_display();
		$posts_count = absint( $settings['posts_per_page'] );

		// Query Arguments
		$query_args = array(
			'post_status'           => array( 'publish' ),
			'post_type'             => $settings['post_type'],
			'orderby'               => $settings['orderby'],
			'order'                 => $settings['order'],
			'offset'                => $settings['offset'],
			'ignore_sticky_posts'   => ( 'yes' === $settings['sticky_posts'] ) ? 0 : 1,
			'showposts'             => $posts_count,
		);

		// Author Filter
		if ( ! empty( $settings['authors'] ) ) {
			$query_args[ $settings['author_filter_type'] ] = $settings['authors'];
		}

		// Posts Filter
		$post_type = $settings['post_type'];

		if ( 'post' === $post_type ) {
			$posts_control_key = 'exclude_posts';
		} else {
			$posts_control_key = $post_type . '_filter';
		}

		if ( ! empty( $settings[ $posts_control_key ] ) ) {
			$query_args[ $settings[ $post_type . '_filter_type' ] ] = $settings[ $posts_control_key ];
		}

		// Taxonomy Filter
		$taxonomy = PP_Posts_Helper::get_post_taxonomies( $post_type );

		if ( ! empty( $taxonomy ) && ! is_wp_error( $taxonomy ) ) {

			foreach ( $taxonomy as $index => $tax ) {

				if ( 'post' === $post_type ) {
					if ( 'post_tag' === $index ) {
						$tax_control_key = 'tags';
					} elseif ( 'category' === $index ) {
						$tax_control_key = 'categories';
					} else {
						$tax_control_key = $index . '_' . $post_type;
					}
				} else {
					$tax_control_key = $index . '_' . $post_type;
				}

				if ( ! empty( $settings[ $tax_control_key ] ) ) {

					$operator = $settings[ $index . '_' . $post_type . '_filter_type' ];

					$query_args['tax_query'][] = [
						'taxonomy' => $index,
						'field'    => 'term_id',
						'terms'    => $settings[ $tax_control_key ],
						'operator' => $operator,
					];
				}
			}
		}

		if ( 'anytime' !== $settings['select_date'] ) {
			$select_date = $settings['select_date'];
			if ( ! empty( $select_date ) ) {
				$date_query = [];
				if ( 'today' === $select_date ) {
					$date_query['after'] = '-1 day';
				} elseif ( 'week' === $select_date ) {
					$date_query['after'] = '-1 week';
				} elseif ( 'month' === $select_date ) {
					$date_query['after'] = '-1 month';
				} elseif ( 'quarter' === $select_date ) {
					$date_query['after'] = '-3 month';
				} elseif ( 'year' === $select_date ) {
					$date_query['after'] = '-1 year';
				} elseif ( 'exact' === $select_date ) {
					$after_date = $settings['date_after'];
					if ( ! empty( $after_date ) ) {
						$date_query['after'] = $after_date;
					}
					$before_date = $settings['date_before'];
					if ( ! empty( $before_date ) ) {
						$date_query['before'] = $before_date;
					}
					$date_query['inclusive'] = true;
				}

				$query_args['date_query'] = $date_query;
			}
		}

		// Sticky Posts Filter
		if ( 'yes' === $settings['sticky_posts'] && 'yes' === $settings['all_sticky_posts'] ) {
			$post__in = get_option( 'sticky_posts' );

			$query_args['post__in'] = $post__in;
		}

		return apply_filters( 'ppe_tabs_query_args', $query_args, $settings );
	}

	/**
	 * Render posts output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function get_tabs_posts() {
		$settings = $this->get_settings_for_display();

		$i = 0;
		$tabs = array();

		// Query Arguments
		$args = $this->get_posts_query_arguments();
		$posts_query = new \WP_Query( $args );

		if ( $posts_query->have_posts() ) :
			while ( $posts_query->have_posts() ) :
				$posts_query->the_post();

				$dynamic_tab_title = 'get_' . $settings['dynamic_tabs_content'][0]['dynamic_tab_title'];
				$dynamic_tab_content = 'get_' . $settings['dynamic_tabs_content'][0]['dynamic_tab_content'];

				if ( method_exists( $this, $dynamic_tab_title ) ) {
					$tab_title = $this->$dynamic_tab_title();
				} else if ( 'get_custom_data' === $dynamic_tab_title ) {
					$tab_title = $settings['dynamic_tabs_content'][0]['dynamic_tab_title_custom_data'];
				} else {
					$tab_title = get_the_title();
				}

				if ( method_exists( $this, $dynamic_tab_content ) ) {
					$tab_content = $this->$dynamic_tab_content();
				} else if ( 'get_custom_data' === $dynamic_tab_content ) {
					$tab_content = $settings['dynamic_tabs_content'][0]['dynamic_tab_content_custom_data'];
				} else {
					$tab_content = get_the_content();
				}

				$tabs[ $i ]['tab_title'] = $tab_title;
				$tabs[ $i ]['content_type'] = 'tab_content';
				$tabs[ $i ]['content'] = $tab_content;
				$tabs[ $i ]['icon_type'] = 'none';
				$tabs[ $i ]['icon'] = '';

				$i++;
			endwhile;
		endif;
		wp_reset_postdata();

		return $tabs;
	}

	protected function get_tabs_custom() {
		global $wp_embed;

		$settings = $this->get_settings_for_display();

		$tabs = array();

		foreach ( $settings['tab_features'] as $index => $item ) {
			$tabs[ $index ]['tab_title'] = $item['tab_title'];
			$tabs[ $index ]['content_type'] = $item['content_type'];
			$tabs[ $index ]['content'] = $this->get_tabs_content( $item );
			$tabs[ $index ]['icon_type'] = $item['pp_icon_type'];
			$tabs[ $index ]['icon'] = $item['selected_icon'];
			$tabs[ $index ]['icon_img'] = $item['icon_img'];
		}

		return $tabs;
	}

	public function get_tabs_items() {
		$settings = $this->get_settings_for_display();

		if ( 'posts' === $settings['source'] ) {
			return $this->get_tabs_posts();
		}

		if ( 'manual' === $settings['source'] ) {
			return $this->get_tabs_custom();
		}

		/* if ( 'acf' === $settings['source'] ) {
			return $this->get_faqs_acf();
		} */
	}

	/**
	 * Render post title output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function get_post_title() {
		return get_the_title();
	}

	/**
	 * Get post excerpt end text.
	 *
	 * Returns the string to append to post excerpt.
	 *
	 * @param string $more returns string.
	 * @since 2.10.0
	 * @access public
	 */
	public function excerpt_more_filter( $more ) {
		return '...';
	}

	/**
	 * Get post excerpt
	 *
	 * @access protected
	 */
	protected function get_post_excerpt() {
		add_filter( 'excerpt_more', array( $this, 'excerpt_more_filter' ), 20 );
		return get_the_excerpt();
		remove_filter( 'excerpt_more', array( $this, 'excerpt_more_filter' ), 20 );
	}

	/**
	 * Get post content
	 *
	 * @access protected
	 */
	protected function get_post_content() {
		return get_the_content();
	}

	/**
	 * Get post author
	 *
	 * @access protected
	 */
	protected function get_post_author( $author_link = '' ) {
		if ( 'yes' === $author_link ) {
			return get_the_author_posts_link();
		} else {
			return get_the_author();
		}
	}

	/**
	 * Get post date
	 *
	 * @access protected
	 */
	protected function get_post_date() {
		return get_the_date();
	}

	/**
	 * Get post thumbnail HTML.
	 *
	 * @access protected
	 */
	protected function get_post_thumbnail() {
		$settings       = $this->get_settings_for_display();
		$post_type_name = $settings['post_type'];

		if ( has_post_thumbnail() || 'attachment' === $post_type_name ) {

			if ( 'attachment' === $post_type_name ) {
				$image_id = get_the_ID();
			} else {
				$image_id = get_post_thumbnail_id( get_the_ID() );
			}

			$setting_key              = 'thumbnail';
			$settings[ $setting_key ] = array(
				'id' => $image_id,
			);
			$thumbnail_html           = Group_Control_Image_Size::get_attachment_image_html( $settings, $setting_key );

		}

		if ( empty( $thumbnail_html ) ) {
			return;
		}

		return $thumbnail_html;
	}

	/**
	 * Render tabs content.
	 *
	 * @since 2.3.2
	 */
	protected function get_tabs_content( $item ) {
		$settings     = $this->get_settings_for_display();
		$content_type = $item['content_type'];
		$output       = '';

		/* if ( 'posts' === $settings['source'] ) {
			$output = $this->get_post_data();
		} else { */
			switch ( $content_type ) {
				case 'tab_content':
					$output = $this->parse_text_editor( $item['content'] );
					break;

				case 'tab_photo':
					if ( $item['image']['url'] ) {
						$output = wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $item, 'image', 'image' ) );
					}
					break;

				case 'tab_video':
					$output = wp_kses_post( $this->parse_text_editor( $item['link_video'] ) );
					break;

				case 'section':
					$output = PP_Helper::elementor()->frontend->get_builder_content_for_display( $item['saved_section'] );
					break;

				case 'template':
					$output = PP_Helper::elementor()->frontend->get_builder_content_for_display( $item['templates'] );
					break;

				case 'widget':
					$output = PP_Helper::elementor()->frontend->get_builder_content_for_display( $item['saved_widget'] );
					break;

				default:
					return;
			}
		//}

		return $output;
	}

	/**
	 * Render tabs widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings        = $this->get_settings_for_display();
		$id_int          = substr( $this->get_id_int(), 0, 3 );
		$hover_class     = '';
		$default_tab_no  = '';
		$default_title   = '';
		$default_content = '';

		$tabs = $this->get_tabs_items();

		$fallback_defaults = array(
			'fa fa-check',
			'fa fa-times',
			'fa fa-dot-circle-o',
		);

		if ( 0 < $settings['default_tab'] && count( $tabs ) >= $settings['default_tab'] ) {
			$default_tab_no = $settings['default_tab'];
		} else {
			$default_tab_no = 1;
		}

		$hover_state = $settings['tab_hover_effect'];

		if ( 'yes' === $hover_state ) {
			$hover_class = ' at-hover';
		} else {
			$hover_class = ' at-no-hover';
		}

		$this->add_render_attribute(
			'container',
			array(
				'class' => array( 'pp-advanced-tabs', 'pp-' . $settings['custom_style'], 'pp-tabs-responsive-' . $settings['responsive_support'] ),
			)
		);

		if ( 'no' !== $settings['scroll_top'] ) {
			$this->add_render_attribute( 'container', 'data-scroll-top', 'yes' );
		}

		if ( 'no' !== $settings['responsive_support'] ) {
			$this->add_render_attribute( 'container', 'class', 'pp-advabced-tabs-responsive' );
		}

		$this->add_render_attribute(
			'tabs-wrap',
			array(
				'class' => array(
					'pp-advanced-tabs-wrapper',
					'pp-tabs-labels',
					$settings['type'],
					$hover_class,
				),
				'role'  => 'tablist',
			)
		);
		?>
		<div <?php $this->print_render_attribute_string( 'container' ); ?>>
			<div <?php $this->print_render_attribute_string( 'tabs-wrap' ); ?>>
				<?php
				foreach ( $tabs as $index => $item ) {
					$tab_count = $index + 1;

					if ( $tab_count === (int) $default_tab_no ) {
						$default_title = 'pp-tab-active';
					} else {
						$default_title = '';
					}

					if ( $settings['custom_id_prefix'] ) {
						$tab_id = $settings['custom_id_prefix'] . '-' . $tab_count;
					} else {
						$tab_id = 'pp-advanced-tabs-title-' . $id_int . $tab_count;
					}

					$title_text_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tab_features', $index );

					$this->add_render_attribute(
						$title_text_setting_key,
						array(
							'id'            => $tab_id,
							'class'         => array( 'pp-advanced-tabs-title', 'pp-tabs-label', 'pp-advanced-tabs-desktop-title', $default_title ),
							'data-tab'      => $tab_count,
							'data-index'    => $id_int . $tab_count,
							'tabindex'      => '0',
							'role'          => 'tab',
							'aria-controls' => 'pp-advanced-tabs-content-' . $id_int . $tab_count,
						)
					);

					if ( 'top' === $settings['icon_position'] || 'left' === $settings['icon_position'] ) {
						?>
							<div <?php $this->print_render_attribute_string( $title_text_setting_key ); ?>>

								<?php $this->render_tab_title_icon( $item ); ?>

								<span class="pp-advanced-tabs-title-text"><?php echo wp_kses_post( $item['tab_title'] ); ?></span>
								<?php if ( 'style-7' === $settings['custom_style'] || 'style-8' === $settings['custom_style'] ) { ?>
									<span class="active-slider-span"></span>
								<?php } ?>
							</div>
						<?php } elseif ( 'bottom' === $settings['icon_position'] || 'right' === $settings['icon_position'] ) { ?>
							<div <?php $this->print_render_attribute_string( $title_text_setting_key ); ?>>
								<span class="pp-advanced-tabs-title-text"><?php echo wp_kses_post( $item['tab_title'] ); ?></span>

								<?php $this->render_tab_title_icon( $item ); ?>

								<?php if ( 'style-7' === $settings['custom_style'] || 'style-8' === $settings['custom_style'] ) { ?>
									<span class="active-slider-span"></span>
								<?php } ?>
							</div>
						<?php
						}
				}
				?>
			</div>
			<div class="pp-advanced-tabs-content-wrapper pp-tabs-panels <?php echo esc_attr( $settings['type'] ); ?>-content">
				<?php
				foreach ( $tabs as $index => $item ) :
					$tab_count = $index + 1;

					if ( $tab_count === (int) $default_tab_no ) {
						$default_content = 'pp-tab-active';
					} else {
						$default_content = '';
					}

					if ( $settings['custom_id_prefix'] ) {
						$tab_id = $settings['custom_id_prefix'] . '-' . $tab_count;
					} else {
						$tab_id = 'pp-advanced-tabs-title-' . $id_int . $tab_count;
					}

					$tab_title_setting_key = $this->get_repeater_setting_key( 'title', 'tab_features', $index );
					$tab_content_setting_key = $this->get_repeater_setting_key( 'content', 'tab_features', $index );

					$this->add_render_attribute(
						$tab_title_setting_key,
						array(
							'class'      => array(
								'pp-advanced-tabs-title',
								'pp-tabs-label',
								'pp-tab-responsive',
								esc_attr( $default_content ),
								esc_attr( $hover_class )
							),
							'data-index' => $id_int . $tab_count,
						)
					);

					$this->add_render_attribute(
						$tab_content_setting_key,
						array(
							'id'              => 'pp-advanced-tabs-content-' . $id_int . $tab_count,
							'class'           => array( 'pp-advanced-tabs-content', 'elementor-clearfix', 'pp-advanced-tabs-' . $item['content_type'], $default_content ),
							'data-tab'        => $tab_count,
							'data-index'      => $id_int . $tab_count,
							'role'            => 'tabpanel',
							'aria-labelledby' => $tab_id,
						)
					);
					?>
					<div class="pp-tabs-panel">
						<div <?php $this->print_render_attribute_string( $tab_title_setting_key ); ?>>
							<div class="pp-advanced-tabs-title-inner">
								<?php $this->render_tab_title_icon( $item ); ?>

								<span class="pp-advanced-tabs-title-text"><?php echo wp_kses_post( $item['tab_title'] ); ?></span>
								<i class="pp-toggle-icon pp-tab-open fa"></i>
							</div>
						</div>
						<div <?php $this->print_render_attribute_string( $tab_content_setting_key ); ?>>
							<?php echo $item['content']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}

	/**
	 *  Get Saved Widgets
	 *
	 *  @param string $type Type.
	 *
	 *  @return string
	 */
	public function render_tab_title_icon( $item ) {
		$settings = $this->get_settings_for_display();

		if ( 'none' === $item['icon_type'] ) {
			return;
		}

		if ( 'icon' === $item['icon_type'] && ! empty( $item['icon']['value'] ) ) {
			?>
			<span class="pp-icon pp-advanced-tabs-icon-<?php echo esc_attr( $settings['icon_position'] ); ?>">
				<?php Icons_Manager::render_icon( $item['icon'], array( 'aria-hidden' => 'true' ) ); ?>
			</span>
			<?php
		} elseif ( 'image' === $item['icon_type'] && '' !== $item['icon_img']['url'] ) {
			?>
			<span class="pp-icon-img pp-advanced-tabs-icon-<?php echo esc_attr( $settings['icon_position'] ); ?>">
			<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $item, 'icon_img', 'icon_img' ) ); ?>
			</span>
			<?php
		}
	}

	/**
	 *  Get Saved Widgets
	 *
	 *  @param string $type Type.
	 *
	 *  @return string
	 */
	public function get_page_template_options( $type = '' ) {

		$page_templates = pp_get_page_templates( $type );

		$options[-1] = __( 'Select', 'powerpack' );

		if ( count( $page_templates ) ) {
			foreach ( $page_templates as $id => $name ) {
				$options[ $id ] = $name;
			}
		} else {
			$options['no_template'] = __( 'No saved templates found!', 'powerpack' );
		}

		return $options;
	}
}
