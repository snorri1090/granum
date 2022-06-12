<?php
class DMPRO_ContentToggle extends ET_Builder_Module {
	
	public $module_url = DMPRO_MODULES_URL . 'ContentToggle' . '/';
	
	protected $module_credits = array(
		'module_uri' => DMPRO_MODULE,
        'author'     => DMPRO_AUTHOR,
        'author_uri' => DMPRO_WEB,
	);

	public function init() {
		$this->name      = esc_html__( DMPRO_PREFIX . 'Content Toggle', DMPRO_TEXTDOMAIN );
		$this->icon_path = plugin_dir_path( __FILE__ ) . 'toggle.svg';
		$this->slug = 'dmpro_content_toggle';
	    $this->vb_support = 'on';
		$this->settings_modal_toggles = [
			'general'  => [
				'toggles' => [
				    'toggle_content' => [
                        'sub_toggles' => [
                            'first_content' => [
                                'name' => 'First Content',
                            ],
                            'second_content' => [
                                'name' => 'Second Content',
                            ]
                        ],
                        'tabbed_subtoggles' => true,
                        'title' => esc_html__( 'Toggle Content', DMPRO_TEXTDOMAIN),
                        'priority' => 1,
		            ],
			    ],
			],
			'advanced' => [
				'toggles' => [
					'switcher'    => esc_html__( 'Toggle Switch', DMPRO_TEXTDOMAIN ),
					'heading_one' => esc_html__( 'First Title', DMPRO_TEXTDOMAIN ),
					'heading_two' => esc_html__( 'Second Title', DMPRO_TEXTDOMAIN ),
					'content_one' => esc_html__( 'First Content', DMPRO_TEXTDOMAIN ),
					'content_two' => esc_html__( 'Second Content', DMPRO_TEXTDOMAIN ),
				],
			],
		];
	}
	
	public function get_fields() {
		$module_fields = [];
		$module_fields['heading_one'] = [
				'label'           => esc_html__( 'First Title', DMPRO_TEXTDOMAIN ),
				'type'            => 'text',
				'default'         => 'Option One',
				'toggle_slug'     => 'toggle_content',
				'sub_toggle' => 'first_content',
				'dynamic_content' => 'text',
			];

		$module_fields['content_type_one'] = [
				'label'            => esc_html__( 'Content Type', DMPRO_TEXTDOMAIN ),
				'type'             => 'select',
				'default'          => 'content',
				'options'          => array(
					'content' => esc_html__( 'Text (or Shortcode)', 'dssb-divi-social-sharing-buttons' ),
					'library' => esc_html__( 'Divi Library', 'dssb-divi-social-sharing-buttons' ),
				),
				'toggle_slug'     => 'toggle_content',
				'sub_toggle' => 'first_content',
				'computed_affects' => array(
					'__library_one',
				),
			];

		$module_fields['library_id_one'] = [
				'label'            => __( 'Select Library Layout', DMPRO_TEXTDOMAIN ),
				'type'             => 'select',
				'options'          => $this->get_divi_library_options(),
				'toggle_slug'     => 'toggle_content',
				'sub_toggle' => 'first_content',
				'computed_affects' => array(
					'__library_one',
				),
				'show_if'          => array(
					'content_type_one' => 'library',
				),
			];

		$module_fields['custom_content_one'] = [
				'label'           => esc_html__( 'Content', DMPRO_TEXTDOMAIN ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Write your content or paste a shortcode.', DMPRO_TEXTDOMAIN ),
				'toggle_slug'     => 'toggle_content',
				'sub_toggle' => 'first_content',
				'dynamic_content' => 'text',
				'show_if'         => array(
					'content_type_one' => 'content',
				),
			];

		$module_fields['heading_two'] = [
				'label'           => esc_html__( 'Second Title', DMPRO_TEXTDOMAIN ),
				'type'            => 'text',
				'default'         => 'Option Two',
				'toggle_slug'     => 'toggle_content',
				'sub_toggle' => 'second_content',
				'dynamic_content' => 'text',
			];

		$module_fields['content_type_two'] = [
				'label'            => esc_html__( 'Content Type', DMPRO_TEXTDOMAIN ),
				'type'             => 'select',
				'default'          => 'content',
				'options'          => array(
					'content' => esc_html__( 'Text (or Shortcode)', 'dssb-divi-social-sharing-buttons' ),
					'library' => esc_html__( 'Divi Library', 'dssb-divi-social-sharing-buttons' ),
				),
				'computed_affects' => array(
					'__library_two',
				),
				'toggle_slug'     => 'toggle_content',
				'sub_toggle' => 'second_content',
			];

		$module_fields['library_id_two'] = [
				'label'            => __( 'Select Library Layout', DMPRO_TEXTDOMAIN ),
				'type'             => 'select',
				'default'          => '',
				'options'          => $this->get_divi_library_options(),
				'computed_affects' => array(
					'__library_one',
				),
				'toggle_slug'     => 'toggle_content',
				'sub_toggle' => 'second_content',
				'show_if'          => array(
					'content_type_two' => 'library',
				),
			];

		$module_fields['custom_content_two'] = [
				'label'           => esc_html__( 'Content', DMPRO_TEXTDOMAIN ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Write your content or paste a shortcode.', DMPRO_TEXTDOMAIN ),
				'toggle_slug'     => 'toggle_content',
				'sub_toggle' => 'second_content',
				'dynamic_content' => 'text',
				'show_if'         => array(
					'content_type_two' => 'content',
				),
			];

		$module_fields['__library_one'] = [
				'type'                => 'computed',
				'computed_callback'   => array( 'DMPRO_ContentToggle', 'get_content_one' ),
				'computed_depends_on' => array(
					'library_id_one',
					'content_type_one',
				),
			];

		$module_fields['__library_two'] = [
				'type'                => 'computed',
				'computed_callback'   => array( 'DMPRO_ContentToggle', 'get_content_two' ),
				'computed_depends_on' => array(
					'library_id_two',
					'content_type_two',
				),
			];
		
		$module_fields['switcher_size'] = [
				'label'          => esc_html__( 'Toggle Switch Size', 'dssb-divi-social-sharing-buttons' ),
				'type'           => 'range',
				'default'        => '14px',
				'mobile_options' => true,
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'switcher',
			];

		$module_fields['alignment'] = [
				'label'          => esc_html__( 'Toggle Switch Alignment', DMPRO_TEXTDOMAIN ),
				'type'           => 'select',
				'default'        => 'center',
				'mobile_options' => true,
				'options'        => array(
					'left'   => esc_html__( 'Left', DMPRO_TEXTDOMAIN ),
					'center' => esc_html__( 'Center', DMPRO_TEXTDOMAIN ),
					'right'  => esc_html__( 'Right', DMPRO_TEXTDOMAIN ),
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'switcher',
			];

		$module_fields['switcher_bg_primary'] = [
				'label'       => esc_html__( 'Toggle Switch Left Background', 'dssb-divi-social-sharing-buttons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#dbdbdb',
				'toggle_slug' => 'switcher',
			];

		$module_fields[	'switcher_bg_secondary'] = [
				'label'       => esc_html__( 'Toggle Switch Right Background', 'dssb-divi-social-sharing-buttons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#8300e9',
				'toggle_slug' => 'switcher',
			];

		$module_fields['switcher_inner_bg'] = [
				'label'       => esc_html__( 'Toggle Switch Color', 'dssb-divi-social-sharing-buttons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#ffffff',
				'toggle_slug' => 'switcher',
			];

		$module_fields['content_bg_one'] = [
				'label'       => esc_html__( 'Content Background', 'dssb-divi-social-sharing-buttons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#ffffff',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'content_one',
			];

		$module_fields['content_bg_two'] = [
				'label'       => esc_html__( 'Content Background', 'dssb-divi-social-sharing-buttons' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#ffffff',
				'toggle_slug' => 'content_two',
			];

		$module_fields['content_padding_one'] = [
				'label'          => __( 'Content Padding', DMPRO_TEXTDOMAIN ),
				'type'           => 'custom_padding',
				'default'        => '0px|0px|0px|0px',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'content_one',
				'mobile_options' => true,
			];

		$module_fields['content_spacing_top_one'] = [
				'label'          => esc_html__( 'Content Spacing Top', DMPRO_TEXTDOMAIN ),
				'type'           => 'range',
				'default'        => '25px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'mobile_options' => true,
				'toggle_slug'    => 'content_one',
				'tab_slug'       => 'advanced',
			];

		$module_fields['content_fullwidth_one'] = [
				'label'            => esc_html__( 'Make This Layout Fullwidth', DMPRO_TEXTDOMAIN ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'off' => esc_html__( 'No', DMPRO_TEXTDOMAIN ),
					'on'  => esc_html__( 'Yes', DMPRO_TEXTDOMAIN ),
				),
				'default_on_front' => 'off',
				'toggle_slug'      => 'content_one',
				'tab_slug'         => 'advanced',
				'show_if'          => array(
					'content_type_one' => 'library',
				),
				'description'      => esc_html__( 'Here you can choose to make your row and section in the layout fullwidth.', DMPRO_TEXTDOMAIN ),
			];

		$module_fields['content_padding_two'] = [
				'label'          => __( 'Content Padding', DMPRO_TEXTDOMAIN ),
				'type'           => 'custom_padding',
				'default'        => '0px|0px|0px|0px',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'content_two',
				'mobile_options' => true,
			];

		$module_fields['content_spacing_top_two'] = [
				'label'          => esc_html__( 'Content Spacing Top', DMPRO_TEXTDOMAIN ),
				'type'           => 'range',
				'default'        => '25px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'mobile_options' => true,
				'toggle_slug'    => 'content_two',
				'tab_slug'       => 'advanced',
			];

		$module_fields['content_fullwidth_two'] = [
				'label'            => esc_html__( 'Make This Layout Fullwidth', DMPRO_TEXTDOMAIN ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'off' => esc_html__( 'No', DMPRO_TEXTDOMAIN ),
					'on'  => esc_html__( 'Yes', DMPRO_TEXTDOMAIN ),
				),
				'default_on_front' => 'off',
				'toggle_slug'      => 'content_two',
				'tab_slug'         => 'advanced',
				'show_if'          => array(
					'content_type_two' => 'library',
				),
				'description'      => esc_html__( 'Here you can choose to make your row and section in the layout fullwidth.', DMPRO_TEXTDOMAIN ),
			];

		return $module_fields;
	}
	public function get_advanced_fields_config() {

		$advanced_fields = array();

		$advanced_fields['text']         = false;
		$advanced_fields['text_shadow']  = false;
		$advanced_fields['fonts']        = false;
		$advanced_fields['link_options'] = false;

		$advanced_fields['fonts']['heading_one'] = array(
			'label'           => esc_html__( 'Heading', DMPRO_TEXTDOMAIN ),
			'css'             => array(
				'main'      => '%%order_class%% .dmpro-toggle-head-one',
				'important' => 'all',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'heading_one',
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
		);

		$advanced_fields['fonts']['heading_two'] = array(
			'label'           => esc_html__( 'Heading', DMPRO_TEXTDOMAIN ),
			'css'             => array(
				'main'      => '%%order_class%% .dmpro-toggle-head-two',
				'important' => 'all',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'heading_two',
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
		);

		$advanced_fields['fonts']['content_one'] = array(
			'label'           => esc_html__( 'Content', DMPRO_TEXTDOMAIN ),
			'css'             => array(
				'main'      => '%%order_class%% .dmpro-content-toggle-front p, %%order_class%% .dmpro-content-toggle-front a',
				'important' => 'all',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'content_one',
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
		);

		$advanced_fields['borders']['content_one'] = array(
			'css'         => array(
				'main' => array(
					'border_radii'  => '%%order_class%% .dmpro-content-toggle-front',
					'border_styles' => '%%order_class%% .dmpro-content-toggle-front',
				),
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'content_one',
		);

		$advanced_fields['box_shadow']['content_one'] = array(
			'css'         => array(
				'main' => '%%order_class%% .dmpro-content-toggle-front',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'content_one',
		);

		$advanced_fields['fonts']['content_two'] = array(
			'label'           => esc_html__( 'Content', DMPRO_TEXTDOMAIN ),
			'css'             => array(
				'main'      => '%%order_class%% .dmpro-content-toggle-back p, %%order_class%% .dmpro-content-toggle-back a',
				'important' => 'all',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'content_two',
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
		);

		$advanced_fields['borders']['content_two'] = array(
			'css'         => array(
				'main' => array(
					'border_radii'  => '%%order_class%% .dmpro-content-toggle-back',
					'border_styles' => '%%order_class%% .dmpro-content-toggle-back',
				),
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'content_two',
		);

		$advanced_fields['box_shadow']['content_two'] = array(
			'css'         => array(
				'main' => '%%order_class%% .dmpro-content-toggle-back',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'content_two',
		);

		return $advanced_fields;
	}

	protected function get_divi_library_options() {
		$layouts = array();
		$_layouts = get_posts(
			array(
				'post_type'      => 'et_pb_layout',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => 'title',
			)
		);
		$layouts[0] = esc_html__( '-- Select Layout --', DMPRO_TEXTDOMAIN );

		if ( ! empty( $_layouts ) ) {

			foreach ( $_layouts as $layout ) {
				$layouts[ $layout->ID ] = $layout->post_title;
			}
		}
		return $layouts;
	}

	public static function get_content_one( $args = array() ) {
		$defaults = array();
		$args     = wp_parse_args( $args, $defaults );

		if ( empty( $args['library_id_one'] ) ) {
			return;
		}

		ob_start();

		ET_Builder_Element::clean_internal_modules_styles();

		echo do_shortcode(
			sprintf(
				'[et_pb_section global_module="%1$s" template_type="section" fullwidth="on"][/et_pb_section]',
				$args['library_id_one']
			)
		);

		$internal_style = ET_Builder_Element::get_style();
		ET_Builder_Element::clean_internal_modules_styles( false );

		if ( $internal_style ) {
			$modules_style = sprintf(
				'<style id="dmpro_content_toggle_styles-%2$s" type="text/css" class="dmpro_content_toggle_styles-%2$s">
					%1$s
				</style>',
				$internal_style,
				$args['library_id_one']
			);
		}

		if ( function_exists( 'et_core_is_fb_enabled' ) && et_core_is_fb_enabled() ) {
			echo et_core_esc_previously( $modules_style );
		}

		$render_shortcode = ob_get_clean();

		return $render_shortcode;
	}

	public static function get_content_two( $args = array() ) {

		$defaults = array();
		$args     = wp_parse_args( $args, $defaults );

		if ( empty( $args['library_id_two'] ) ) {
			return;
		}

		ob_start();

		ET_Builder_Element::clean_internal_modules_styles();

		echo do_shortcode( sprintf( '[et_pb_section global_module="%1$s" template_type="section" fullwidth="on"][/et_pb_section]', $args['library_id_two'] ) );

		$internal_style = ET_Builder_Element::get_style();
		ET_Builder_Element::clean_internal_modules_styles( false );

		if ( $internal_style ) {
			$modules_style = sprintf(
				'<style type="text/css" class="dsm_content_toggle_styles-%2$s">
					%1$s
				</style>',
				$internal_style,
				$args['library_id_two']
			);
		}

		if ( function_exists( 'et_core_is_fb_enabled' ) && et_core_is_fb_enabled() ) {
			echo et_core_esc_previously( $modules_style );
		}

		$render_shortcode = ob_get_clean();

		return $render_shortcode;
	}

	protected function render_content_one() {
		$content_type_one      = $this->props['content_type_one'];
		$library_id_one        = $this->props['library_id_one'];
		$custom_content_one    = $this->_esc_attr( 'custom_content_one', 'full' );
		$args                  = array( 'library_id_one' => $library_id_one );
		$content_fullwidth_one = $this->props['content_fullwidth_one'];

		if ( 'content' === $content_type_one ) {
			return sprintf(
				'<div class="dmpro-content-toggle-front">
                    %1$s
                </div>',
				 preg_replace( '/^<\/p>(.*)<p>/s', '$1', $custom_content_one )
			);
		} else {
			return sprintf(
				'<div class="dmpro-content-toggle-front%2$s">
                    %1$s
                </div>',
				$this->get_content_one( $args ),
				'on' === $content_fullwidth_one ? ' dmpro-content-force-fullwidth' : ''
			);
		}
	}

	protected function render_content_two() {
		$content_type_two      = $this->props['content_type_two'];
		$library_id_two        = $this->props['library_id_two'];
		$custom_content_two    = $this->_esc_attr( 'custom_content_two', 'full' );
		$args                  = array( 'library_id_two' => $library_id_two );
		$content_fullwidth_two = $this->props['content_fullwidth_two'];

		if ( 'content' === $content_type_two ) {
			return sprintf(
				'<div class="dmpro-content-toggle-back" style="display: none">
                    %1$s
                </div>',
				preg_replace( '/^<\/p>(.*)<p>/s', '$1', $custom_content_two )
			);
		} else {
			return sprintf(
				'<div class="dmpro-content-toggle-back%2$s" style="display: none">
                    %1$s
                </div>',
				$this->get_content_two( $args ),
				'on' === $content_fullwidth_two ? ' dmpro-content-force-fullwidth' : ''
			);
		}
	}

	public function render( $attrs, $content, $render_slug ) {
	    wp_enqueue_style("dmpro-".$this->slug, $this->module_url . 'style.css', [], DMPRO_VERSION , 'all');
	    wp_enqueue_script("dmpro-".$this->slug, $this->module_url . 'custom.js', array('jquery'), DMPRO_VERSION, true);
		$this->apply_css( $render_slug );
		$order_class  = self::get_module_order_class( $render_slug );
		$order_number = str_replace( '_', '', str_replace( $this->slug, '', $order_class ) );
		$heading_one = $this->props['heading_one'];
		$heading_two = $this->props['heading_two'];
		$output = sprintf(
			'<div class="dmpro-content-toggle">
				<div class="dmpro-content-toggle-header">
					<div class="dmpro-toggle">
						<div class="dmpro-toggle-left">
							<h5 class="dmpro-toggle-head-one"><label for="dmpro-input-%5$s">%1$s</label></h5>
						</div>
						<div class="dmpro-toggle-btn">
							<label class="dmpro-switch-label" for="dmpro-input-%5$s">
								<input id="dmpro-input-%5$s" class="dmpro-input dmpro-toggle-switch" type="checkbox" />
								<span class="dmpro-switch-inner"></span>
							</label>
						</div>
						<div class="dmpro-toggle-right">
							<h5 class="dmpro-toggle-head-two"><label for="dmpro-input-%5$s">%2$s</label></h5>
						</div>
					</div>
				</div>
				<div class="dmpro-content-toggle-body">
					%3$s %4$s
				</div>
			</div>',
			$heading_one,
			$heading_two,
			$this->render_content_one(),
			$this->render_content_two(),
			$order_number
		);
		
		return $output;
	}

	public function apply_css( $render_slug ) {

		$content_bg_one = $this->props['content_bg_one'];
		$content_bg_two = $this->props['content_bg_two'];

		$content_padding_one = $this->props['content_padding_one'];
		$content_padding_two = $this->props['content_padding_two'];

		$content_spacing_top_one                   = $this->props['content_spacing_top_one'];
		$content_spacing_top_one_tablet            = $this->props['content_spacing_top_one_tablet'];
		$content_spacing_top_one_phone             = $this->props['content_spacing_top_one_phone'];
		$content_spacing_top_one_last_edited       = $this->props['content_spacing_top_one_last_edited'];
		$content_spacing_top_one_responsive_status = et_pb_get_responsive_status( $content_spacing_top_one_last_edited );

		$content_spacing_top_two                   = $this->props['content_spacing_top_two'];
		$content_spacing_top_two_tablet            = $this->props['content_spacing_top_two_tablet'];
		$content_spacing_top_two_phone             = $this->props['content_spacing_top_two_phone'];
		$content_spacing_top_two_last_edited       = $this->props['content_spacing_top_two_last_edited'];
		$content_spacing_top_two_responsive_status = et_pb_get_responsive_status( $content_spacing_top_two_last_edited );

		$switcher_inner_bg               = $this->props['switcher_inner_bg'];
		$switcher_bg_secondary           = $this->props['switcher_bg_secondary'];
		$switcher_bg_primary             = $this->props['switcher_bg_primary'];
		$switcher_size                   = $this->props['switcher_size'];
		$switcher_size_tablet            = $this->props['switcher_size_tablet'];
		$switcher_size_phone             = $this->props['switcher_size_phone'];
		$switcher_size_last_edited       = $this->props['switcher_size_last_edited'];
		$switcher_size_responsive_status = et_pb_get_responsive_status( $switcher_size_last_edited );

		$content_front_selector = '%%order_class%% .dmpro-content-toggle-front';
		$content_back_selector  = '%%order_class%% .dmpro-content-toggle-back';

		$this->apply_custom_margin_padding(
			$render_slug,
			'content_padding_one',
			'padding',
			$content_front_selector
		);

		$this->apply_custom_margin_padding(
			$render_slug,
			'content_padding_two',
			'padding',
			$content_back_selector
		);

		if ( '25px' !== $content_spacing_top_one ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-content-toggle-front',
					'declaration' => sprintf( 'margin-top: %1$s;', $content_spacing_top_one ),
				)
			);
		}

		if ( $content_spacing_top_one_tablet && $content_spacing_top_one_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-content-toggle-front',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'margin-top: %1$s;', $content_spacing_top_one_tablet ),
				)
			);
		}

		if ( $content_spacing_top_one_phone && $content_spacing_top_one_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-content-toggle-front',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'margin-top: %1$s;', $content_spacing_top_one_phone ),
				)
			);
		}

		if ( '25px' !== $content_spacing_top_two ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-content-toggle-back',
					'declaration' => sprintf( 'margin-top: %1$s;', $content_spacing_top_two ),
				)
			);
		}

		if ( $content_spacing_top_two_tablet && $content_spacing_top_two_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-content-toggle-back',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'margin-top: %1$s;', $content_spacing_top_two_tablet ),
				)
			);
		}

		if ( $content_spacing_top_two_phone && $content_spacing_top_two_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-content-toggle-back',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'margin-top: %1$s;', $content_spacing_top_two_phone ),
				)
			);
		}

		if ( '' !== $content_bg_one ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-content-toggle-front',
					'declaration' => sprintf( 'background-color: %1$s;', $content_bg_one ),
				)
			);
		}

		if ( '' !== $content_bg_two ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-content-toggle-back',
					'declaration' => sprintf( 'background-color: %1$s;', $content_bg_two ),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dmpro-toggle-btn',
				'declaration' => sprintf( 'font-size: %1$s;', $switcher_size ),
			)
		);

		if ( $switcher_size_tablet && $switcher_size_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-toggle-btn',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
					'declaration' => sprintf( 'font-size: %1$s;', $switcher_size_tablet ),
				)
			);
		}

		if ( $switcher_size_phone && $switcher_size_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-toggle-btn',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
					'declaration' => sprintf( 'font-size: %1$s;', $switcher_size_phone ),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dmpro-switch-inner',
				'declaration' => sprintf( ' background-color: %1$s;', $switcher_bg_primary ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dmpro-toggle-switch:checked+.dmpro-switch-inner',
				'declaration' => sprintf( ' background-color: %1$s;', $switcher_bg_secondary ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dmpro-switch-inner:before',
				'declaration' => sprintf( ' background-color: %1$s;', $switcher_inner_bg ),
			)
		);

		$alignment                   = $this->props['alignment'];
		$alignment_tablet            = $this->props['alignment_tablet'] ? $this->props['alignment_tablet'] : $alignment;
		$alignment_phone             = $this->props['alignment_phone'] ? $this->props['alignment_phone'] : $alignment_tablet;
		$alignment_last_edited       = $this->props['alignment_last_edited'];
		$alignment_responsive_status = et_pb_get_responsive_status( $alignment_last_edited );

		if ( 'left' === $alignment ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-toggle',
					'declaration' => 'justify-content: flex-start;',
				)
			);
		} elseif ( 'center' === $alignment ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-toggle',
					'declaration' => 'justify-content: center;',
				)
			);
		} elseif ( 'right' === $alignment ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-toggle',
					'declaration' => 'justify-content: flex-end;',
				)
			);
		}

		if ( 'left' === $alignment_tablet && $alignment_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-toggle',
					'declaration' => 'justify-content: flex-start;',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
				)
			);
		} elseif ( 'center' === $alignment_tablet && $alignment_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-toggle',
					'declaration' => 'justify-content: center;',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
				)
			);
		} elseif ( 'right' === $alignment_tablet && $alignment_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-toggle',
					'declaration' => 'justify-content: flex-end;',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
				)
			);
		}

		if ( 'left' === $alignment_phone && $alignment_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-toggle',
					'declaration' => 'justify-content: flex-start;',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
				)
			);
		} elseif ( 'center' === $alignment_phone && $alignment_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-toggle',
					'declaration' => 'justify-content: center;',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
				)
			);
		} elseif ( 'right' === $alignment_phone && $alignment_responsive_status ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dmpro-toggle',
					'declaration' => 'justify-content: flex-end;',
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
				)
			);
		}

	}
	public function apply_custom_margin_padding( $function_name, $slug, $type, $class, $important = false ) {
		$slug_value                   = $this->props[ $slug ];
		$slug_value_tablet            = $this->props[ $slug . '_tablet' ];
		$slug_value_phone             = $this->props[ $slug . '_phone' ];
		$slug_value_last_edited       = $this->props[ $slug . '_last_edited' ];
		$slug_value_responsive_active = et_pb_get_responsive_status( $slug_value_last_edited );

		if ( isset( $slug_value ) && ! empty( $slug_value ) ) {
			ET_Builder_Element::set_style(
				$function_name,
				array(
					'selector'    => $class,
					'declaration' => et_builder_get_element_style_css( $slug_value, $type, $important ),
				)
			);
		}

		if ( isset( $slug_value_tablet ) && ! empty( $slug_value_tablet ) && $slug_value_responsive_active ) {
			ET_Builder_Element::set_style(
				$function_name,
				array(
					'selector'    => $class,
					'declaration' => et_builder_get_element_style_css( $slug_value_tablet, $type, $important ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
				)
			);
		}

		if ( isset( $slug_value_phone ) && ! empty( $slug_value_phone ) && $slug_value_responsive_active ) {
			ET_Builder_Element::set_style(
				$function_name,
				array(
					'selector'    => $class,
					'declaration' => et_builder_get_element_style_css( $slug_value_phone, $type, $important ),
					'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
				)
			);
		}
		if ( et_builder_is_hover_enabled( $slug, $this->props ) ) {
			if ( isset( $this->props[ $slug . '__hover' ] ) ) {
				$hover = $this->props[ $slug . '__hover' ];
				ET_Builder_Element::set_style(
					$function_name,
					array(
						'selector'    => $this->add_hover_to_order_class( $class ),
						'declaration' => et_builder_get_element_style_css( $hover, $type, $important ),
					)
				);
			}
		}
	}
}

new DMPRO_ContentToggle;
