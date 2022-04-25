<?php
class DMPRO_Timeline extends ET_Builder_Module {
	protected $module_credits = array(
		'module_uri' => DMPRO_MODULE . 'timeline',
        'author' => DMPRO_AUTHOR,
        'author_uri' => DMPRO_WEB,
	);

	public function init() 
	{
		$this->icon_path = plugin_dir_path(__FILE__) . "timeline.svg";
		$this->slug = 'dmpro_timeline';
		$this->vb_support = 'on';
		$this->child_slug = 'dmpro_timeline_item';
		$this->name = esc_html__( DMPRO_PREFIX . 'Timeline', 'dmpro-timeline-module-for-divi' );
		$this->settings_modal_toggles = [
			'general'    => [
				'toggles' => [
					'card_arrow_settings' => esc_html__('Event Card Arrow', 'dmpro-divi-modules-pro'),
				],
			],      
			'advanced'   => [
				'toggles' => [
				    'timeline_design' => [
				        'sub_toggles' => [
				            'layout_settings' => [
				                'name' => 'Layout',
				                ],
				            'timeline_line_settings' => [
				                'name' => 'Line'
				                ],
				            'card_arrow_settings'   => [
				                 'name' => 'Arrow',
				                 ],
				            ],
				            'tabbed_subtoggles' => true,
                            'title' => esc_html__('Timeline Design Settings', 'dmpro-divi-modules-pro'),
                            'priority' => 1,
				        ],
                    'animation_timeline_settings' => esc_html__( 'Animation Timeline', 'dmpro-divi-modules-pro' ),
				],
			]
    ];
    $this->advanced_fields = [
      'borders' => [
        'default' => [],
      ],
      'fonts' => false,
      'margin_padding' => [
        'css' => [
            'important' => 'all',
        ],
      ],
    ];
	}

	public function get_fields() {
		$et_accent_color = et_builder_accent_color();
		$start_position = array();
		$start_position['left'] = esc_html__('Left', 'dmpro-divi-modules-pro');
		$start_position['right'] = esc_html__('Right', 'dmpro-divi-modules-pro');
		return array(
			'show_card_arrow'  => array(
				'label'            => esc_html__( 'Show Event Card Arrow', 'dmpro-divi-modules-pro' ),
				'description'      => esc_html__( 'Enable this to Display the an arrow from the Timeline Event Card', 'dmpro-divi-modules-pro' ),
				'type'             => 'yes_no_button',
				'options'          => array(
					'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
					'on'  => esc_html__('Yes', 'dmpro-divi-modules-pro'),
				),
				'toggle_slug'      => 'card_arrow_settings',
				'default_on_front' => 'on',
			),
			'layout'      => array(
				'label'            => esc_html__( 'Timeline Layout', 'dmpro-divi-modules-pro' ),
				'type'             => 'select',
				'option_category'  => 'layout',
				'options'          => array(
          'left'           => esc_html__( 'Left', 'dmpro-divi-modules-pro' ),
          'right'          => esc_html__( 'Right', 'dmpro-divi-modules-pro' ),
          'mixed'          => esc_html__( 'Alternating', 'dmpro-divi-modules-pro' )
      ),
		'tab_slug'         => 'advanced',
		'toggle_slug' => 'timeline_design',
		'sub_toggle'      => 'layout_settings',
		'description'      => esc_html__( 'Choose to display your timeline event cards to the left, right, or alternating.', 'dmpro-divi-modules-pro' ),
        'default_on_front' => 'mixed',
        'default_tablet' => 'right',
        'default_phone' => 'right',
        'default'        => 'mixed', 
				'responsive'      => true,              
        'mobile_options'   => true,
				'hover'           => 'tabs',        
      ),      
			'start_position'      => array(
				'label'            => esc_html__( 'Start Position', 'dmpro-divi-modules-pro' ),
				'type'             => 'select',
				'option_category'  => 'layout',
				'options'          => $start_position,
				'tab_slug'         => 'advanced',
				'toggle_slug' => 'timeline_design',
				'sub_toggle'      => 'layout_settings',
				'description'      => esc_html__( 'Choose which side you want your first timeline event card to display on.', 'dmpro-divi-modules-pro' ),
				'default_on_front' => 'left',
        'mobile_options'   => false,
        'depends_show_if'  => 'mixed',
        'depends_on'       => array(
          'layout',
        ),
      ),
      'line_area_size'                  => array(
				'label'           => esc_html__( 'Line Container Width ', 'dmpro-divi-modules-pro' ),
				'description'     => esc_html__( 'Adjust the width of the entire line container.', 'dmpro-divi-modules-pro' ),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'timeline_design',
				'sub_toggle'     => 'timeline_line_settings',
				'mobile_options'  => true,
				'sticky'          => true,
				'validate_unit'   => true,
				'default'         => '80px',
				'default_unit'    => 'px',
				'range_settings'  => array(
					'min'  => '0',
					'max'  => '1024',
					'step' => '1',
				),
				'responsive'      => true,
				'hover'           => 'tabs',
      ),
      'timeline_line_width' => array(
				'label'            => esc_html__( 'Line Width', 'dmpro-divi-modules-pro' ),
				'description'      => esc_html__( 'Adjust the width of the connecting line of the timeline.', 'dmpro-divi-modules-pro' ),
				'type'             => 'range',
				'option_category'  => 'configuration',
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'timeline_design',
				'sub_toggle'     => 'timeline_line_settings',
				'default'          => '2px',
				'default_unit'     => 'px',
				'default_on_front' => '2px',
				'allowed_units'    => array( 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
				'range_settings'   => array(
					'min'  => '0',
					'max'  => '100',
					'step' => '1',
				),
				'sticky'           => true,
				'hover'            => 'tabs',
      ),
      'timeline_line_style'    => array(
				'label'           => esc_html__( 'Line Style', 'dmpro-divi-modules-pro' ),
				'description'     => esc_html__( 'Select the shape of the timeline line.', 'dmpro-divi-modules-pro' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => et_builder_get_border_styles(),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'timeline_design',
				'sub_toggle'     => 'timeline_line_settings',
				'default'         => 'solid',
        'hover'           => 'tabs',
			),
      'timeline_line_color' => array(
				'default'         => $et_accent_color,
				'label'           => esc_html__( 'Line Color', 'dmpro-divi-modules-pro' ),
				'type'            => 'color-alpha',
				'description'     => esc_html__( 'Here you can define a custom color for the timeline line.', 'dmpro-divi-modules-pro' ),
				'tab_slug' => 'advanced',
				'toggle_slug' => 'timeline_design',
				'sub_toggle'     => 'timeline_line_settings',
        'default'         => '#f4f4f4',
				'hover'           => 'tabs',
				'sticky'          => true,
      ),
      'use_active_line'  => array(
				'label'            => esc_html__( 'Use Progressing Line', 'dmpro-divi-modules-pro' ),
				'description'      => esc_html__( 'Enable this option to show a line that progresses the timeline as you scroll.', 'dmpro-divi-modules-pro' ),
				'type'             => 'yes_no_button',
				'options'          => array(
					'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
					'on'  => esc_html__('Yes', 'dmpro-divi-modules-pro'),
				),
				'tab_slug'         => 'advanced',
				'toggle_slug' => 'timeline_design',
				'sub_toggle'     => 'timeline_line_settings',
				'default_on_front' => 'on',
      ),
      'timeline_active_line_width' => array(
				'label'            => esc_html__( 'Progressing Line Width', 'dmpro-divi-modules-pro' ),
				'description'      => esc_html__( 'Choose a width for the progessing line.', 'dmpro-divi-modules-pro' ),
				'type'             => 'range',
        'option_category'  => 'configuration',
        'show_if'          => array(
          'use_active_line' => 'on'
        ),
				'tab_slug'         => 'advanced',
				'toggle_slug' => 'timeline_design',
				'sub_toggle'     => 'timeline_line_settings',
				'default'          => '2px',
				'default_unit'     => 'px',
				'default_on_front' => '2px',
				'allowed_units'    => array( 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
				'range_settings'   => array(
					'min'  => '0',
					'max'  => '100',
					'step' => '1',
				),
				'sticky'           => true,
				'hover'            => 'tabs',
      ),
      'timeline_active_line_style'    => array(
				'label'           => esc_html__( 'Progressing Line Style', 'dmpro-divi-modules-pro' ),
				'description'     => esc_html__( 'Select the shape of the progressing line.', 'dmpro-divi-modules-pro' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => et_builder_get_border_styles(),
        'show_if'          => array(
          'use_active_line' => 'on'
        ),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'timeline_design',
				'sub_toggle'     => 'timeline_line_settings',
				'default'         => 'solid',
        'hover'           => 'tabs',
			),
      'timeline_active_line_color' => array(
				'default'         => $et_accent_color,
				'label'           => esc_html__( 'Progressing Line Color', 'dmpro-divi-modules-pro' ),
				'type'            => 'color-alpha',
				'description'     => esc_html__( 'Here you can define a custom color for the progressing line.', 'dmpro-divi-modules-pro' ),
        'show_if'          => array(
          'use_active_line' => 'on'
        ),
				'tab_slug'        => 'advanced',
        'toggle_slug' => 'timeline_design',
				'sub_toggle'     => 'timeline_line_settings',
        'default'         => '#7d2ae8',
				'hover'           => 'tabs',
				'sticky'          => true,
      ),
      'card_arrow_size' => array(
				'label'            => esc_html__( 'Event Card Arrow Size', 'dmpro-divi-modules-pro' ),
				'description'      => esc_html__( 'Event Card Arrow Size', 'dmpro-divi-modules-pro' ),
				'type'             => 'range',
				'option_category'  => 'configuration',
				'tab_slug'         => 'advanced',
				'toggle_slug' => 'timeline_design',
				'sub_toggle'      => 'card_arrow_settings',
				'default'          => '12px',
				'default_unit'     => '12x',
				'default_on_front' => '12px',
				'allowed_units'    => array( 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
				'range_settings'   => array(
					'min'  => '0',
					'max'  => '500',
					'step' => '1',
				),
				'mobile_options'   => true,
				'sticky'           => true,
        'hover'            => 'tabs',
        'show_if'          => array(
          'show_card_arrow' => 'on'
        ),
      ),
      'card_arrow_color' => array(
				'default'         => $et_accent_color,
				'label'           => esc_html__( 'Event Card Arrow Color', 'dmpro-divi-modules-pro' ),
				'type'            => 'color-alpha',
				'description'     => esc_html__( 'Here you can define a custom color for card arrow.', 'dmpro-divi-modules-pro' ),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'timeline_design',
                'sub_toggle'     => 'card_arrow_settings',
                'default'         => '#f4f4f4',
				'hover'           => 'tabs',
				'sticky'          => true,
                'show_if'          => array(
                    'show_card_arrow' => 'on'
            ),
         ),
		);
	}
  public function get_custom_style($slug_value, $type, $important) {
		return  sprintf('%1$s: %2$s%3$s;', $type, $slug_value, $important? ' !important' : '');
	}
	public function get_changed_prop_value($slug, $conv_matrix) {
		if(array_key_exists($this->props[$slug], $conv_matrix))
			$this->props[$slug] =  $conv_matrix[$this->props[$slug]];
  }
  
  public function apply_custom_style_for_phone(
		$function_name,
		$slug,
		$type,
		$class,
		$important = false,
		$zoom = '',
    $unit='',
    $wrap_func = '' /* traslate, clac ... */
    )
	{
		$slug_value_responsive_active = isset($this->props[$slug."_last_edited"]) ? et_pb_get_responsive_status($this->props[$slug."_last_edited"]) : false;
		$slug_value = (isset($this->props[$slug])) ? $this->props[$slug] : '';
		$slug_value_tablet = ($slug_value_responsive_active && isset($this->props[$slug."_tablet"])) ? $this->props[$slug."_tablet"] : $slug_value;
    $slug_value_phone = ($slug_value_responsive_active && isset($this->props[$slug."_phone"])) ? $this->props[$slug."_phone"]: $slug_value_tablet;
    
		if ($zoom === '') {
			$slug_value = $slug_value .$unit;
			$slug_value_tablet = $slug_value_tablet.$unit;
			$slug_value_phone = $slug_value_phone.$unit;
		} else {
			$slug_value = ((float)$slug_value * $zoom) .$unit;
			$slug_value_tablet = ((float)$slug_value_tablet * $zoom).$unit;
			$slug_value_phone = ((float)$slug_value_phone * $zoom).$unit;
		}
		if ($wrap_func !== '') {
      $slug_value = "$wrap_func($slug_value)";
      $slug_value_tablet = "$wrap_func($slug_value_tablet)";
      $slug_value_phone = "$wrap_func($slug_value_phone)";
    }

	  if (isset($slug_value_phone)
			&& !empty($slug_value_phone)) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => $this->get_custom_style($slug_value_phone, $type, $important),
				'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
			));
		}
  }
  
  public function apply_custom_style_for_tablet(
		$function_name,
		$slug,
		$type,
		$class,
		$important = false,
		$zoom = '',
    $unit='',
    $wrap_func = '' /* traslate, clac ... */
    )
	{
		$slug_value_responsive_active = isset($this->props[$slug."_last_edited"]) ? et_pb_get_responsive_status($this->props[$slug."_last_edited"]) : false;
		$slug_value = (isset($this->props[$slug])) ? $this->props[$slug] : '';
		$slug_value_tablet = ($slug_value_responsive_active && isset($this->props[$slug."_tablet"])) ? $this->props[$slug."_tablet"] : $slug_value;
    $slug_value_phone = ($slug_value_responsive_active && isset($this->props[$slug."_phone"])) ? $this->props[$slug."_phone"]: $slug_value_tablet;
    
		if ($zoom === '') {
			$slug_value = $slug_value .$unit;
			$slug_value_tablet = $slug_value_tablet.$unit;
			$slug_value_phone = $slug_value_phone.$unit;
		} else {
			$slug_value = ((float)$slug_value * $zoom) .$unit;
			$slug_value_tablet = ((float)$slug_value_tablet * $zoom).$unit;
			$slug_value_phone = ((float)$slug_value_phone * $zoom).$unit;
		}
		if ($wrap_func !== '') {
      $slug_value = "$wrap_func($slug_value)";
      $slug_value_tablet = "$wrap_func($slug_value_tablet)";
      $slug_value_phone = "$wrap_func($slug_value_phone)";
    }

    if (isset($slug_value_tablet)
    && !empty($slug_value_tablet)) {
    ET_Builder_Element::set_style($function_name, array(
      'selector' => $class,
      'declaration' => $this->get_custom_style($slug_value_tablet, $type, $important),
      'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
    ));
    }
  }
  
  public function apply_custom_style_for_desktop(
		$function_name,
		$slug,
		$type,
		$class,
		$important = false,
		$zoom = '',
    $unit='',
    $wrap_func = '' /* traslate, clac ... */
    )
	{
    
    $slug_value_responsive_active = isset($this->props[$slug."_last_edited"]) ? et_pb_get_responsive_status($this->props[$slug."_last_edited"]) : false;
		$slug_value = (isset($this->props[$slug])) ? $this->props[$slug] : '';
		$slug_value_tablet = ($slug_value_responsive_active && isset($this->props[$slug."_tablet"])) ? $this->props[$slug."_tablet"] : $slug_value;
    $slug_value_phone = ($slug_value_responsive_active && isset($this->props[$slug."_phone"])) ? $this->props[$slug."_phone"]: $slug_value_tablet;
    
		if ($zoom === '') {
			$slug_value = $slug_value .$unit;
			$slug_value_tablet = $slug_value_tablet.$unit;
			$slug_value_phone = $slug_value_phone.$unit;
		} else {
			$slug_value = ((float)$slug_value * $zoom) .$unit;
			$slug_value_tablet = ((float)$slug_value_tablet * $zoom).$unit;
			$slug_value_phone = ((float)$slug_value_phone * $zoom).$unit;
		}
		if ($wrap_func !== '') {
      $slug_value = "$wrap_func($slug_value)";
      $slug_value_tablet = "$wrap_func($slug_value_tablet)";
      $slug_value_phone = "$wrap_func($slug_value_phone)";
    }

		if (isset($slug_value) && !empty($slug_value)) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => $this->get_custom_style($slug_value, $type, $important),
			));
		}
  }

	public function apply_custom_style(
		$function_name,
		$slug,
		$type,
		$class,
		$important = false,
		$zoom = '',
    $unit='',
    $wrap_func = '' /* traslate, clac ... */
    )
	{
		$slug_value_responsive_active = isset($this->props[$slug."_last_edited"]) ? et_pb_get_responsive_status($this->props[$slug."_last_edited"]) : false;
		$slug_value = (isset($this->props[$slug])) ? $this->props[$slug] : '';
		$slug_value_tablet = ($slug_value_responsive_active && isset($this->props[$slug."_tablet"])) ? $this->props[$slug."_tablet"] : $slug_value;
    $slug_value_phone = ($slug_value_responsive_active && isset($this->props[$slug."_phone"])) ? $this->props[$slug."_phone"]: $slug_value_tablet;
    
		if ($zoom === '') {
			$slug_value = $slug_value .$unit;
			$slug_value_tablet = $slug_value_tablet.$unit;
			$slug_value_phone = $slug_value_phone.$unit;
		} else {
			$slug_value = ((float)$slug_value * $zoom) .$unit;
			$slug_value_tablet = ((float)$slug_value_tablet * $zoom).$unit;
			$slug_value_phone = ((float)$slug_value_phone * $zoom).$unit;
		}
		if ($wrap_func !== '') {
      $slug_value = "$wrap_func($slug_value)";
      $slug_value_tablet = "$wrap_func($slug_value_tablet)";
      $slug_value_phone = "$wrap_func($slug_value_phone)";
    }

		if (isset($slug_value) && !empty($slug_value)) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => $this->get_custom_style($slug_value, $type, $important),
			));
		}

		if (isset($slug_value_tablet)
			&& !empty($slug_value_tablet)
			&& $slug_value_responsive_active) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => $this->get_custom_style($slug_value_tablet, $type, $important),
				'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
			));
		}

		if (isset($slug_value_phone)
			&& !empty($slug_value_phone)
			&& $slug_value_responsive_active) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => $this->get_custom_style($slug_value_phone, $type, $important),
				'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
			));
		}
	}
	public function apply_custom_margin_padding($function_name, $slug, $type, $class, $important = true)
	{
		$slug_value_responsive_active = isset($this->props[$slug."_last_edited"]) ? et_pb_get_responsive_status($this->props[$slug."_last_edited"]) : false;
		$slug_value = (isset($this->props[$slug])) ? $this->props[$slug] : '';
		$slug_value_tablet = ($slug_value_responsive_active && isset($this->props[$slug."_tablet"])) ? $this->props[$slug."_tablet"] : $slug_value;
    $slug_value_phone = ($slug_value_responsive_active && isset($this->props[$slug."_phone"])) ? $this->props[$slug."_phone"]: $slug_value_tablet;
  
		if (isset($slug_value) && !empty($slug_value)) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => et_builder_get_element_style_css($slug_value, $type, $important),
			));
		}
  
		if (isset($slug_value_tablet) && !empty($slug_value_tablet) && $slug_value_responsive_active) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => et_builder_get_element_style_css($slug_value_tablet, $type, $important),
				'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
			));
		}
  
		if (isset($slug_value_phone) && !empty($slug_value_phone) && $slug_value_responsive_active) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => et_builder_get_element_style_css($slug_value_phone, $type, $important),
				'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
			));
		}
  }
  
  public function get_transition_fields_css_props() {
    $fields               = parent::get_transition_fields_css_props();
    $fields['timeline_line_width'] = array( 'border-width' => '%%order_class%% .dmpro-timeline-line' );
    $fields['timeline_line_color'] = array( 'border-color' => '%%order_class%% .dmpro-timeline-line' );
    $fields['timeline_line_style'] = array( 'border-style' => '%%order_class%% .dmpro-timeline-line' );
    
    return $fields;
  }
	public function render( $attrs, $content, $render_slug ) {
    wp_enqueue_style("dmpro-".$this->slug, plugin_dir_url(__FILE__) . 'style.css', [], DMPRO_VERSION, 'all');
    wp_enqueue_script("dmpro-".$this->slug, plugin_dir_url(__FILE__) . 'custom.js', [],DMPRO_VERSION, true);

    $layout                            = $this->props['layout'];
    $layout_values                     = et_pb_responsive_options()->get_property_values( $this->props, 'layout' );
    $start_position                    = $this->props['start_position'];
    $use_active_line				           = $this->props['use_active_line'];
    $line_area_size                    = $this->props['line_area_size'];
    $line_area_size_values             = et_pb_responsive_options()->get_property_values( $this->props, 'line_area_size' ); 
    $show_card_arrow                   = $this->props['show_card_arrow'];
    $timline_line_html =  '<div class="dmpro-timeline-line"></div>';
    if ($use_active_line == "on") {
      $timline_line_html .='<div class="dmpro-timeline-line__active"></div>';
    }
    
	  $layout_tablet        = isset( $layout_values['tablet'] ) ? $layout_values['tablet'] : '';
    $layout_phone         = isset( $layout_values['phone'] ) ? $layout_values['phone'] : '';
    
    if ( is_rtl() && 'left' === $layout ) {
			$layout = 'right';
		}

		if ( is_rtl() && 'left' === $layout_tablet ) {
			$layout_tablet = 'right';
		}

		if ( is_rtl() && 'left' === $layout_phone ) {
			$layout_phone = 'right';
    }

    $module_custom_classes = 'dmpro_timeline_custom_classes';
    $module_custom_classes .= $this->get_text_orientation_classname();
		$module_custom_classes .= sprintf( ' dmpro_timeline_layout_%1$s', esc_attr( $layout ) );

    if ( ! empty( $layout_tablet ) ) {
			$module_custom_classes .=  " dmpro_timeline_layout_{$layout_tablet}_tablet" ;
		} else {
      $module_custom_classes .=  " dmpro_timeline_layout_right_tablet" ;
    }

		if ( ! empty( $layout_phone ) ) {
			$module_custom_classes .=  " dmpro_timeline_layout_{$layout_phone}_phone" ;
		} else {
      $module_custom_classes .=  " dmpro_timeline_layout_right_phone" ;
    }
    
    if ( ! empty( $start_position ) ) {
			$module_custom_classes .=  " startpos-{$start_position}" ;
    }
    
    if ($show_card_arrow == 'on') {
      $module_custom_classes .= " dmpro_timeline_show-card-arrow" ;
    }
    $this->generate_styles(
      array(
        'base_attr_name' => 'line_area_size',
        'selector'       => '%%order_class%% .dmpro_timeline_item .date-icon-wrap, %%order_class%% .dmpro_timeline_layout_right .dmpro_timeline_item .date-icon-wrap, %%order_class%%.dmpro_timeline.dmpro_timeline_layout_left .dmpro_timeline_item .date-icon-wrap',
        'css_property'   => 'width',
        'render_slug'    => $render_slug,
        'type'           => 'range',
      )
    );
    $this->generate_styles(
      array(
        'base_attr_name' => 'line_area_size',
        'selector'       => '%%order_class%% .dmpro_timeline_item .date-icon-wrap, %%order_class%% .dmpro_timeline_layout_right .dmpro_timeline_item .date-icon-wrap, %%order_class%%.dmpro_timeline.dmpro_timeline_layout_left .dmpro_timeline_item .date-icon-wrap',
        'css_property'   => 'max-width',
        'render_slug'    => $render_slug,
        'type'           => 'range',
        'important'     => true
      )
    );

    $this->apply_custom_style_for_desktop(
      $this->slug,
      'line_area_size',
      'left',
      '%%order_class%% .dmpro_timeline_layout_right .dmpro-timeline-line__active,
      %%order_class%% .dmpro_timeline_layout_right .dmpro-timeline-line
      ',
      false,
      0.5,
      'px'
	  );
    $this->apply_custom_style_for_tablet(
      $this->slug,
      'line_area_size',
      'left',
      '%%order_class%%.dmpro_timeline .dmpro_timeline_layout_right_tablet .dmpro_timeline_container .dmpro-timeline-line__active,
      %%order_class%%.dmpro_timeline .dmpro_timeline_layout_right_tablet .dmpro_timeline_container .dmpro-timeline-line
      ',
      false,
      0.5,
      'px'
      );
    $this->apply_custom_style_for_phone(
      $this->slug,
      'line_area_size',
      'left',
      '%%order_class%%.et_pb_module.dmpro_timeline .dmpro_timeline_layout_right_phone .dmpro_timeline_container .dmpro-timeline-line__active,
      %%order_class%%.et_pb_module.dmpro_timeline .dmpro_timeline_layout_right_phone .dmpro_timeline_container .dmpro-timeline-line
      ',
      false,
      0.5,
      'px'
      );
    
    $this->apply_custom_style(
      $this->slug,
      'line_area_size',
      'right',
      '%%order_class%% .dmpro_timeline_layout_left .dmpro-timeline-line__active,
      %%order_class%% .dmpro_timeline_layout_left .dmpro-timeline-line',
      false,
      0.5,
      'px'
    );
    $this->apply_custom_style_for_tablet(
      $this->slug,
      'line_area_size',
      'right',
      '%%order_class%%.dmpro_timeline .dmpro_timeline_layout_left_tablet .dmpro_timeline_container .dmpro-timeline-line__active,
      %%order_class%%.dmpro_timeline .dmpro_timeline_layout_left_tablet .dmpro_timeline_container .dmpro-timeline-line',
      false,
      0.5,
      'px'
      );
    $this->apply_custom_style_for_phone(
      $this->slug,
      'line_area_size',
      'right',
      '%%order_class%%.et_pb_module.dmpro_timeline .dmpro_timeline_layout_left_phone .dmpro_timeline_container .dmpro-timeline-line__active,
      %%order_class%%.et_pb_module.dmpro_timeline .dmpro_timeline_layout_left_phone .dmpro_timeline_container .dmpro-timeline-line',
      false,
      0.5,
      'px'
    );

    $this->apply_custom_style_for_desktop(
      $this->slug,
      'timeline_line_width',
      'transform',
      '%%order_class%% .dmpro_timeline_layout_left .dmpro-timeline-line
      ',
      false,
      1,
      'px',
      'translateX'
	);
	$this->apply_custom_style_for_tablet(
		$this->slug,
		'timeline_line_width',
		'transform',
		'%%order_class%%.dmpro_timeline .dmpro_timeline_layout_left_tablet .dmpro-timeline-line
		',
		false,
		1,
		'px',
		'translateX'
	  );
	$this->apply_custom_style_for_phone(
		$this->slug,
		'timeline_line_width',
		'transform',
		'%%order_class%%.dmpro_timeline .dmpro_timeline_layout_left_phone .dmpro_timeline_container .dmpro-timeline-line
		',
		false,
		1,
		'px',
		'translateX'
	);

    $this->generate_styles(
			array(
				'base_attr_name'                  => 'timeline_line_width',
				'selector'                        => '%%order_class%% .dmpro-timeline-line',
				'css_property'                    => 'border-width',
				'render_slug'                     => $render_slug,
				'type'                            => 'range',
			)
    );
    
    $this->generate_styles(
			array(
				'base_attr_name'                  => 'timeline_line_color',
				'selector'                        => '%%order_class%% .dmpro-timeline-line',
				'css_property'                    => 'border-color',
				'render_slug'                     => $render_slug,
				'type'                            => 'color',
			)
    );

    $this->generate_styles(
			array(
				'base_attr_name'                  => 'timeline_line_style',
				'selector'                        => '%%order_class%% .dmpro-timeline-line',
				'css_property'                    => 'border-style',
				'render_slug'                     => $render_slug,
				'type'                            => 'select',
			)
    );
    /* Active line */
    $this->generate_styles(
			array(
				'base_attr_name'                  => 'timeline_active_line_width',
				'selector'                        => '%%order_class%% .dmpro-timeline-line__active',
				'css_property'                    => 'border-width',
				'render_slug'                     => $render_slug,
				'type'                            => 'range',
			)
    );
    
    $this->generate_styles(
			array(
				'base_attr_name'                  => 'timeline_active_line_color',
				'selector'                        => '%%order_class%% .dmpro-timeline-line__active',
				'css_property'                    => 'border-color',
				'render_slug'                     => $render_slug,
				'type'                            => 'color',
			)
    );

    $this->generate_styles(
			array(
				'base_attr_name'                  => 'timeline_active_line_style',
				'selector'                        => '%%order_class%% .dmpro-timeline-line__active',
				'css_property'                    => 'border-style',
				'render_slug'                     => $render_slug,
				'type'                            => 'select',
			)
    );

    $this->apply_custom_style_for_desktop(
      $this->slug,
      'timeline_active_line_width',
      'transform',
      '%%order_class%% .dmpro_timeline_layout_left .dmpro-timeline-line__active
      ',
      false,
      1,
      'px',
      'translateX'
	  );
	
    $this->apply_custom_style_for_tablet(
      $this->slug,
      'timeline_active_line_width',
      'transform',
      '%%order_class%%.dmpro_timeline .dmpro_timeline_layout_left_tablet .dmpro-timeline-line__active
      ',
      false,
      1,
      'px',
      'translateX'
	  );

    $this->apply_custom_style_for_phone(
      $this->slug,
      'timeline_active_line_width',
      'transform',
      '%%order_class%%.dmpro_timeline .dmpro_timeline_layout_left_phone .dmpro_timeline_container .dmpro-timeline-line__active
      ',
      false,
      1,
      'px',
      'translateX'
    );

    $this->apply_custom_style_for_desktop(
      $this->slug,
      'timeline_line_width',
      'transform',
      '%%order_class%% .dmpro_timeline_layout_right .dmpro-timeline-line
      ',
      false,
      -1,
      'px',
      'translateX'
    );

    $this->apply_custom_style_for_tablet(
      $this->slug,
      'timeline_line_width',
      'transform',
      '%%order_class%%.dmpro_timeline .dmpro_timeline_layout_right_tablet .dmpro-timeline-line
      ',
      false,
      -1,
      'px',
      'translateX'
    );
    $this->apply_custom_style_for_phone(
      $this->slug,
      'timeline_line_width',
      'transform',
      '%%order_class%%.dmpro_timeline .dmpro_timeline_layout_right_phone .dmpro_timeline_container .dmpro-timeline-line
      ',
      false,
      -1,
      'px',
      'translateX'
    );

    $this->apply_custom_style_for_desktop(
      $this->slug,
      'timeline_active_line_width',
      'transform',
      '%%order_class%% .dmpro_timeline_layout_right .dmpro-timeline-line__active
      ',
      false,
      -1,
      'px',
      'translateX'
	  );

    $this->apply_custom_style_for_tablet(
      $this->slug,
      'timeline_active_line_width',
      'transform',
      '%%order_class%%.dmpro_timeline .dmpro_timeline_layout_right_tablet .dmpro-timeline-line__active
      ',
      false,
      -1,
      'px',
      'translateX'
	  );
    $this->apply_custom_style_for_phone(
      $this->slug,
      'timeline_active_line_width',
      'transform',
      '%%order_class%%.dmpro_timeline .dmpro_timeline_layout_right_phone .dmpro_timeline_container .dmpro-timeline-line__active
      ',
      false,
      -1,
      'px',
      'translateX'
	  );
    /* Event Card Arrow */
    $this->generate_styles(
			array(
				'base_attr_name'                  => 'card_arrow_color',
				'selector'                        => '%%order_class%% .dmpro_timeline_item_card-wrap:after',
				'css_property'                    => 'border-right-color',
				'render_slug'                     => $render_slug,
				'type'                            => 'color',
			)
    );
    $this->generate_styles(
			array(
				'base_attr_name'                  => 'card_arrow_color',
				'selector'                        => '%%order_class%% .dmpro_timeline_item_card-wrap:after',
				'css_property'                    => 'border-left-color',
				'render_slug'                     => $render_slug,
				'type'                            => 'color',
			)
    );
    $this->generate_styles(
			array(
				'base_attr_name'                  => 'card_arrow_size',
				'selector'                        => '%%order_class%% .dmpro_timeline_item_card-wrap:after',
				'css_property'                    => 'border-width',
				'render_slug'                     => $render_slug,
        'type'                            => 'range',
        'important'                       => true
			)
    );
    $this->apply_custom_style_for_desktop(
      $this->slug,
      'card_arrow_size',
      'left',
      '%%order_class%% .dmpro_timeline_layout_right .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       %%order_class%% .dmpro_timeline_layout_mixed.startpos-right .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       %%order_class%% .dmpro_timeline_layout_mixed.startpos-left .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
      ',
      false,
      -1,
      'px'
	  );

    $this->apply_custom_style_for_tablet(
      $this->slug,
      'card_arrow_size',
      'left',
      '%%order_class%%.dmpro_timeline .dmpro_timeline_layout_right_tablet .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       %%order_class%%.dmpro_timeline .dmpro_timeline_layout_right_tablet .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       %%order_class%% .dmpro_timeline_layout_mixed_tablet.startpos-right .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       %%order_class%% .dmpro_timeline_layout_mixed_tablet.startpos-left .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
      ',
      false,
      -1,
      'px'
	  );
    $this->apply_custom_style_for_phone(
      $this->slug,
      'card_arrow_size',
      'left',
      '%%order_class%%.et_pb_module.dmpro_timeline .dmpro_timeline_layout_right_phone .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       %%order_class%%.et_pb_module.dmpro_timeline .dmpro_timeline_layout_right_phone .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       %%order_class%%.et_pb_module .dmpro_timeline_layout_mixed_phone.startpos-right .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       %%order_class%%.et_pb_module .dmpro_timeline_layout_mixed_phone.startpos-left .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
      ',
      false,
      -1,
      'px'
    );
    
    $this->apply_custom_style_for_desktop(
      $this->slug,
      'card_arrow_size',
      'right',
      '%%order_class%% .dmpro_timeline_layout_left .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       %%order_class%% .dmpro_timeline_layout_mixed.startpos-right .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       %%order_class%% .dmpro_timeline_layout_mixed.startpos-left .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
      ',
      false,
      -1,
      'px'
	  );

    $this->apply_custom_style_for_tablet(
      $this->slug,
      'card_arrow_size',
      'right',
      '%%order_class%%.dmpro_timeline .dmpro_timeline_layout_left_tablet .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       %%order_class%%.dmpro_timeline.dmpro_timeline_layout_left_tablet .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       %%order_class%% .dmpro_timeline_layout_mixed_tablet.startpos-right .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       %%order_class%% .dmpro_timeline_layout_mixed_tablet.startpos-left .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
      ',
      false,
      -1,
      'px'
	  );
    $this->apply_custom_style_for_phone(
      $this->slug,
      'card_arrow_size',
      'right',
      '%%order_class%%.et_pb_module.dmpro_timeline .dmpro_timeline_layout_left_phone .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
      %%order_class%%.et_pb_module.dmpro_timeline .dmpro_timeline_layout_left_phone .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       %%order_class%%.et_pb_module .dmpro_timeline_layout_mixed_phone.startpos-right .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       %%order_class%%.et_pb_module .dmpro_timeline_layout_mixed_phone.startpos-left .dmpro_timeline_container .dmpro-timeline-items .dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
      ',
      false,
      -1,
      'px'
	  );
		return sprintf(
      '<div class="%3$s">
        <div class="dmpro_timeline_container">
          <div class="dmpro-timeline-items">%1$s</div>
          %2$s
        </div>
      </div>
      ',
      $this->props['content'],
      $timline_line_html,
      $module_custom_classes
		);
	}
}

new DMPRO_Timeline;

