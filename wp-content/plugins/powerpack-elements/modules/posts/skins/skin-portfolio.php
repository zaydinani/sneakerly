<?php
namespace PowerpackElements\Modules\Posts\Skins;

use PowerpackElements\Modules\Posts\Module;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Portfolio Skin for Posts widget
 */
class Skin_Portfolio extends Skin_Base {

	/**
	 * Retrieve Skin ID.
	 *
	 * @access public
	 *
	 * @return string Skin ID.
	 */
	public function get_id() {
		return 'portfolio';
	}

	/**
	 * Retrieve Skin title.
	 *
	 * @access public
	 *
	 * @return string Skin title.
	 */
	public function get_title() {
		return __( 'Portfolio', 'powerpack' );
	}

	/**
	 * Register Control Actions.
	 *
	 * @access protected
	 */
	protected function _register_controls_actions() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore

		parent::_register_controls_actions();

		add_action( 'elementor/element/pp-posts/section_skin_field/before_section_end', array( $this, 'add_portfolio_content_controls' ) );
		add_action( 'elementor/element/pp-posts/portfolio_section_post_box_style/after_section_start', array( $this, 'add_portfolio_post_box_controls' ) );
		add_action( 'elementor/element/pp-posts/portfolio_section_post_content_style/after_section_start', array( $this, 'add_portfolio_content_position_controls' ) );
		add_action( 'elementor/element/pp-posts/portfolio_section_post_content_style/before_section_end', array( $this, 'add_portfolio_content_style_controls' ) );
		add_action( 'elementor/element/pp-posts/portfolio_section_image_style/after_section_end', array( $this, 'add_portfolio_overlay_controls' ) );
	}

	protected function register_image_controls() {
		parent::register_image_controls();

		$this->remove_control( 'thumbnail_custom_height' );
		$this->remove_control( 'thumbnail_ratio' );
		$this->remove_control( 'thumbnail_location' );
	}

	protected function register_content_order() {
		parent::register_content_order();

		$this->remove_control( 'thumbnail_order' );
	}

	public function register_layout_content_controls() {
		parent::register_layout_content_controls();

		$this->update_control(
			'equal_height',
			array(
				'default'   => 'yes',
				'condition' => array(
					$this->get_control_id( 'layout!' ) => 'masonry',
				),
			)
		);
	}

	public function register_button_controls() {
		parent::register_button_controls();

		$this->remove_control( 'button_alignment' );
	}

	public function add_portfolio_content_controls() {

		$this->add_control(
			'content_visibility',
			array(
				'label'   => __( 'Content Visibility', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'always',
				'options' => array(
					'always'   => __( 'Always', 'powerpack' ),
					'on-hover' => __( 'On Hover', 'powerpack' ),
				),
			)
		);
	}

	public function add_portfolio_post_box_controls() {

		$this->add_responsive_control(
			'post_box_height',
			array(
				'label'     => __( 'Height', 'powerpack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 100,
						'max' => 500,
					),
				),
				'default'   => array(
					'size' => 300,
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-posts-skin-portfolio .pp-post-content' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					$this->get_control_id( 'layout' ) => [ 'grid', 'carousel' ],
					$this->get_control_id( 'equal_height' ) => 'yes',
				),
			)
		);
	}

	public function add_portfolio_content_style_controls() {

		$this->add_responsive_control(
			'post_content_margin',
			array(
				'label'      => __( 'Margin', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-post-thumb-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
	}

	public function add_portfolio_content_position_controls() {

		$this->add_control(
			'content_vertical_position',
			array(
				'label'                => __( 'Content Position', 'powerpack' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => array(
					'top'    => array(
						'title' => __( 'Top', 'powerpack' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle' => array(
						'title' => __( 'Middle', 'powerpack' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom' => array(
						'title' => __( 'Bottom', 'powerpack' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'              => 'bottom',
				'selectors_dictionary' => array(
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				),
				'selectors'            => array(
					'{{WRAPPER}} .pp-post-thumb-content-wrap'   => 'justify-content: {{VALUE}};',
				),
			)
		);
	}

	public function add_portfolio_overlay_controls() {
		$this->start_controls_section(
			'section_overlay_style',
			array(
				'label' => __( 'Overlay', 'powerpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_overlay_style' );

		$this->start_controls_tab(
			'tab_overlay_normal',
			array(
				'label' => __( 'Normal', 'powerpack' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'overlay_background_color_normal',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pp-image-overlay',
				'exclude'  => array(
					'image',
				),
			)
		);

		$this->add_control(
			'overlay_margin_normal',
			array(
				'label'     => __( 'Margin', 'powerpack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-image-overlay' => 'top: {{SIZE}}px; bottom: {{SIZE}}px; left: {{SIZE}}px; right: {{SIZE}}px;',
				),
			)
		);

		$this->add_control(
			'overlay_opacity_normal',
			array(
				'label'     => __( 'Opacity', 'powerpack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-image-overlay' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_overlay_hover',
			array(
				'label' => __( 'Hover', 'powerpack' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'overlay_background_color_hover',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pp-post:hover .pp-image-overlay',
				'exclude'  => array(
					'image',
				),
			)
		);

		$this->add_control(
			'overlay_margin_hover',
			array(
				'label'     => __( 'Margin', 'powerpack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-post:hover .pp-image-overlay' => 'top: {{SIZE}}px; bottom: {{SIZE}}px; left: {{SIZE}}px; right: {{SIZE}}px;',
				),
			)
		);

		$this->add_control(
			'overlay_opacity_hover',
			array(
				'label'     => __( 'Opacity', 'powerpack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-post:hover .pp-image-overlay' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_terms_controls() {
		parent::register_terms_controls();

		$this->update_control(
			'post_terms',
			array(
				'default' => '',
			)
		);
	}

	protected function register_title_controls() {
		parent::register_title_controls();

		$this->update_control(
			'post_title_link',
			array(
				'condition' => array(
					$this->get_control_id( 'post_title' ) => 'yes',
					$this->get_control_id( 'thumbnail_link!' ) => 'yes',
				),
			)
		);
	}

	protected function register_meta_controls() {
		parent::register_meta_controls();

		$this->update_control(
			'author_link',
			array(
				'condition' => array(
					$this->get_control_id( 'post_meta' )   => 'yes',
					$this->get_control_id( 'show_author' ) => 'yes',
					$this->get_control_id( 'thumbnail_link!' ) => 'yes',
				),
			)
		);

		$this->update_control(
			'date_link',
			array(
				'condition' => array(
					$this->get_control_id( 'post_meta' ) => 'yes',
					$this->get_control_id( 'show_date' ) => 'yes',
					$this->get_control_id( 'thumbnail_link!' ) => 'yes',
				),
			)
		);
	}

	protected function register_style_content_controls() {
		parent::register_style_content_controls();

		$this->update_control(
			'post_content_align',
			array(
				'selectors' => array(
					'{{WRAPPER}} .pp-post-thumb-content' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->update_control(
			'post_content_bg',
			array(
				'selectors' => array(
					'{{WRAPPER}} .pp-post-thumb-content' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->remove_control( 'post_content_border_radius' );

		$this->update_responsive_control(
			'post_content_padding',
			array(
				'default'    => array(
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20',
					'unit'   => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-post-thumb-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
	}

	protected function register_style_box_controls() {
		parent::register_style_box_controls();

		$this->remove_control( 'post_box_bg' );
		$this->remove_control( 'post_box_padding' );
	}

	protected function register_style_image_controls() {
		parent::register_style_image_controls();

		$this->remove_control( 'image_spacing' );
	}

	protected function register_style_title_controls() {
		parent::register_style_title_controls();

		$this->update_control(
			'title_color',
			array(
				'default' => '#ffffff',
			)
		);
	}

	protected function register_style_meta_controls() {
		parent::register_style_meta_controls();

		$this->update_control(
			'meta_text_color',
			array(
				'default' => '#ffffff',
			)
		);

		$this->update_control(
			'meta_links_color',
			array(
				'default' => '#ffffff',
			)
		);
	}

	/**
	 * Render post body output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render_post_body() {
		$settings = $this->parent->get_settings_for_display();

		$post_meta          = $this->get_instance_value( 'post_meta' );
		$content_visibility = $this->get_instance_value( 'content_visibility' );

		do_action( 'ppe_before_single_post_wrap', get_the_ID(), $settings );
		?>
		<div <?php post_class( $this->get_item_wrap_classes() ); ?>>
			<?php do_action( 'ppe_before_single_post', get_the_ID(), $settings ); ?>
			<div class="<?php echo esc_attr( $this->get_item_classes() ); ?>">
				<div class="pp-post-content pp-content-<?php echo esc_attr( $content_visibility ); ?>">
					<?php
						$this->render_post_thumbnail();
					?>
					<div class="pp-image-overlay">
					</div>
					<div class="pp-post-thumb-content-wrap">
						<div class="pp-post-thumb-content">
							<?php
							$content_parts = $this->get_ordered_items( Module::get_post_parts() );

							foreach ( $content_parts as $part => $index ) {
								if ( 'terms' === $part ) {
									$this->render_terms();
								}

								if ( 'title' === $part ) {
									$this->render_post_title();
								}

								if ( 'meta' === $part ) {
									$this->render_post_meta();
								}

								if ( 'excerpt' === $part ) {
									$this->render_excerpt();
								}

								if ( 'button' === $part ) {
									$this->render_button();
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<?php do_action( 'ppe_after_single_post', get_the_ID(), $settings ); ?>
		</div>
		<?php
		do_action( 'ppe_after_single_post_wrap', get_the_ID(), $settings );
	}
}
