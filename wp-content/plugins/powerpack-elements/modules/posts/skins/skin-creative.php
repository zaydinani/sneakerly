<?php
namespace PowerpackElements\Modules\Posts\Skins;

use PowerpackElements\Modules\Posts\Module;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Creative Skin for Posts widget
 */
class Skin_Creative extends Skin_Base {

	/**
	 * Retrieve Skin ID.
	 *
	 * @access public
	 *
	 * @return string Skin ID.
	 */
	public function get_id() {
		return 'creative';
	}

	/**
	 * Retrieve Skin title.
	 *
	 * @access public
	 *
	 * @return string Skin title.
	 */
	public function get_title() {
		return __( 'Creative', 'powerpack' );
	}

	/**
	 * Register Control Actions.
	 *
	 * @access protected
	 */
	protected function _register_controls_actions() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore

		parent::_register_controls_actions();

		add_action( 'elementor/element/pp-posts/creative_section_post_meta/after_section_end', array( $this, 'add_creative_authorbox_controls' ) );
		add_action( 'elementor/element/pp-posts/creative_section_meta_style/before_section_end', array( $this, 'add_creative_meta_style_controls' ) );
		add_action( 'elementor/element/pp-posts/creative_section_meta_style/after_section_end', array( $this, 'add_creative_author_box_style_controls' ) );
		add_action( 'elementor/element/pp-posts/creative_section_button_style/before_section_end', array( $this, 'add_creative_button_style_controls' ) );
	}

	protected function register_image_controls() {
		parent::register_image_controls();

		$this->remove_control( 'thumbnail_location' );
	}

	protected function register_content_order() {
		parent::register_content_order();

		$this->remove_control( 'thumbnail_order' );
	}

	public function add_creative_authorbox_controls() {
		$this->start_controls_section(
			'section_author_box',
			array(
				'label' => __( 'Author Box', 'powerpack' ),
			)
		);

		$this->add_control(
			'heading_author_avatar',
			array(
				'label' => __( 'Author Avtar', 'powerpack' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'author_avatar',
			array(
				'label'        => __( 'Show Author Avatar', 'powerpack' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'powerpack' ),
				'label_off'    => __( 'No', 'powerpack' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'author_avatar_size',
			array(
				'label'     => __( 'Avatar Size', 'powerpack' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'xs' => __( 'Extra Small', 'powerpack' ),
					'sm' => __( 'Small', 'powerpack' ),
					'md' => __( 'Medium', 'powerpack' ),
					'lg' => __( 'Large', 'powerpack' ),
					'xl' => __( 'Extra Large', 'powerpack' ),
				),
				'default'   => 'sm',
				'condition' => array(
					$this->get_control_id( 'author_avatar' ) => 'yes',
				),
			)
		);

		$this->add_control(
			'heading_authorbox_author',
			array(
				'label'     => __( 'Post Author', 'powerpack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'show_authorbox_author',
			array(
				'label'        => __( 'Show Post Author', 'powerpack' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'powerpack' ),
				'label_off'    => __( 'No', 'powerpack' ),
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

	}

	public function add_creative_meta_style_controls() {

		$this->add_control(
			'meta_border_color',
			array(
				'label'     => __( 'Border Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#797979',
				'selectors' => array(
					'{{WRAPPER}} .pp-post-meta' => 'border-bottom-color: {{VALUE}}; border-top-color: {{VALUE}}',
				),
				'condition' => array(
					$this->get_control_id( 'post_meta' ) => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'meta_border_width',
			array(
				'label'      => __( 'Border Width', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'    => array(
					'size' => 1,
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-post-meta' => 'border-bottom-width: {{SIZE}}{{UNIT}}; border-top-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					$this->get_control_id( 'post_meta' ) => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'meta_padding',
			array(
				'label'      => __( 'Padding', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-post-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					$this->get_control_id( 'post_meta' ) => 'yes',
				),
			)
		);

	}

	public function add_creative_author_box_style_controls() {
		$this->start_controls_section(
			'section_author_box_style',
			array(
				'label' => __( 'Author Box', 'powerpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'author_avatar_image_width',
			array(
				'label'      => __( 'Avatar Image Width', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 10,
						'max'  => 240,
						'step' => 1,
					),
				),
				'default'    => array(
					'size' => 40,
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-post-avtar img' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					$this->get_control_id( 'author_avatar' ) => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'author_avatar_image_spacing',
			array(
				'label'      => __( 'Avatar Image Spacing', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 10,
						'max'  => 80,
						'step' => 1,
					),
				),
				'default'    => array(
					'size' => 10,
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}}.pp-post-content-align-left .pp-post-avtar' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.pp-post-content-align-right .pp-post-avtar' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.pp-post-content-align-center .pp-post-avtar' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					$this->get_control_id( 'author_avatar' ) => 'yes',
				),
			)
		);

		$this->add_control(
			'author_name_color',
			array(
				'label'     => __( 'Author Name Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#D8D8D8',
				'selectors' => array(
					'{{WRAPPER}} .pp-post-authorbox-name a' => 'color: {{VALUE}};',
				),
				'condition' => array(
					$this->get_control_id( 'show_authorbox_author' ) => 'yes',
				),
			)
		);

		$this->add_control(
			'author_name_color_hover',
			array(
				'label'     => __( 'Author Name Hover Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-post-authorbox-name a:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					$this->get_control_id( 'show_authorbox_author' ) => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'author_name_typography',
				'label'     => __( 'Typography', 'powerpack' ),
				'selector'  => '{{WRAPPER}} .pp-post-authorbox a',
				'condition' => array(
					$this->get_control_id( 'show_authorbox_author' ) => 'yes',
				),
			)
		);

		$this->end_controls_section();

	}

	public function add_creative_button_style_controls() {
		$this->add_control(
			'read_more_button_margin_bottom',
			array(
				'label'      => __( 'Bottom Spacing', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 20,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-posts-button' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					$this->get_control_id( 'show_button' ) => 'yes',
				),
			)
		);
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

	protected function register_excerpt_controls() {
		parent::register_excerpt_controls();

		$this->update_control(
			'show_excerpt',
			array(
				'default' => 'yes',
			)
		);
	}

	protected function register_style_content_controls() {
		parent::register_style_content_controls();

		$this->update_control(
			'post_content_align',
			array(
				'toggle'       => false,
				'default'      => 'left',
				'prefix_class' => 'pp-post-content-align-',
				'selectors'    => null
			)
		);

		$this->remove_control( 'post_content_border_radius' );

		$this->update_responsive_control(
			'post_content_padding',
			array(
				'default' => array(
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20',
					'unit'   => 'px',
				),
			)
		);
	}

	protected function register_style_box_controls() {
		parent::register_style_box_controls();

		$this->update_control(
			'post_box_bg',
			array(
				'default' => '#3f3f3f',
			)
		);
	}

	protected function register_style_image_controls() {
		parent::register_style_image_controls();

		$this->remove_control( 'image_spacing' );
	}

	protected function register_style_terms_controls() {
		parent::register_style_terms_controls();

		$this->update_control(
			'terms_text_color',
			array(
				'default' => '#D8D8D8',
			)
		);
	}

	protected function register_style_title_controls() {
		parent::register_style_title_controls();

		$this->update_control(
			'title_color',
			array(
				'default' => '#D8D8D8',
			)
		);

		$this->update_responsive_control(
			'title_margin_bottom',
			array(
				'default' => array(
					'size' => 15,
				),
			)
		);
	}

	protected function register_style_excerpt_controls() {
		parent::register_style_excerpt_controls();

		$this->update_control(
			'excerpt_color',
			array(
				'default' => '#D8D8D8',
			)
		);
	}

	protected function register_style_meta_controls() {
		parent::register_style_meta_controls();

		$this->update_control(
			'meta_text_color',
			array(
				'default' => '#D8D8D8',
			)
		);

		$this->update_control(
			'meta_links_color',
			array(
				'default' => '#D8D8D8',
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

		$post_terms       = $this->get_instance_value( 'post_terms' );
		$post_meta        = $this->get_instance_value( 'post_meta' );
		$author_avatar    = $this->get_instance_value( 'author_avatar' );
		$authorbox_author = $this->get_instance_value( 'show_authorbox_author' );

		do_action( 'ppe_before_single_post_wrap', get_the_ID(), $settings );
		?>
		<div <?php post_class( $this->get_item_wrap_classes() ); ?>>
			<?php do_action( 'ppe_before_single_post', get_the_ID(), $settings ); ?>
			<div class="<?php echo esc_attr( $this->get_item_classes() ); ?>">
				<?php
					$this->render_post_thumbnail();
				?>

				<div class="pp-post-content-wrap">
					<div class="pp-post-content">
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
							}
						?>
					</div>
					<?php
						if ( 'button' === $part ) {
							$this->render_button();
						}
					?>

					<?php if ( 'yes' === $author_avatar || 'yes' === $authorbox_author ) { ?>
						<div class="pp-post-authorbox">
							<?php if ( 'yes' === $author_avatar ) { ?>
								<div class="pp-post-avtar">
									<?php
										echo get_avatar( get_the_author_meta( 'ID' ), 50 );
									?>
								</div>
							<?php } ?>
							<?php if ( 'yes' === $authorbox_author ) { ?>
								<div class="pp-post-authorbox-content">
									<div class="pp-post-authorbox-name">
										<?php
											// Post Author
											echo wp_kses_post( $this->get_post_author( 'yes' ) );
										?>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php do_action( 'ppe_after_single_post', get_the_ID(), $settings ); ?>
		</div>
		<?php
		do_action( 'ppe_after_single_post_wrap', get_the_ID(), $settings );
	}
}
