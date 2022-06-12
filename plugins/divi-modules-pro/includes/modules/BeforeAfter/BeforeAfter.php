<?php
class DMPRO_BeforeAfter extends ET_Builder_Module {
	
	public $module_url = DMPRO_MODULES_URL . 'BeforeAfter' . '/';
	
    protected $module_credits = array(
        'module_uri' => DMPRO_MODULE . 'before-after-slider',
        'author' => DMPRO_AUTHOR,
        'author_uri' => DMPRO_WEB,
    );

    public function init() {
        $this->slug = 'dmpro_before_after_slider';
        $this->icon_path = plugin_dir_path( __FILE__ ) . "BeforeAfter.svg";
        $this->vb_support = 'on';
        $this->name = esc_html__(DMPRO_PREFIX . 'Before After Slider', DMPRO_TEXTDOMAIN);
        $this->settings_modal_toggles = [
            'general' => [
                'toggles' => [
                    'slider_content' => [
                        'sub_toggles' => [
                            'left_side' => [
                                'name' => 'Left Image'
                            ],
                            'right_side' => [
                                'name' => 'Right Image'
                            ]
                        ],
                        'tabbed_subtoggles' => true,
                        'title' => esc_html__('Slider Content', DMPRO_TEXTDOMAIN),
                    ]
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'slider' => esc_html__('Slider', DMPRO_TEXTDOMAIN),
                    'labels' => esc_html__('Labels', DMPRO_TEXTDOMAIN),
                    'overlay' => esc_html__('Overlay', DMPRO_TEXTDOMAIN),
                ],
            ],
        ];
    }

    public function get_fields() {
        $module_fields = [];
        $module_fields['before_image'] = [
                'label' => esc_html__('Left Image', DMPRO_TEXTDOMAIN),
                'type' => 'upload',
                'option_category' => 'basic_option',
                'upload_button_text' => esc_attr__('Upload an image', DMPRO_TEXTDOMAIN),
                'choose_text' => esc_attr__('Choose an Image', DMPRO_TEXTDOMAIN),
                'update_text' => esc_attr__('Set As Image', DMPRO_TEXTDOMAIN),
                'description' => esc_html__('Upload your desired image to display on the left part of slider.', DMPRO_TEXTDOMAIN),
                'toggle_slug' => 'slider_content',
                'sub_toggle' => 'left_side'
        ];

        $module_fields['before_image_alt'] = [
                'label' => esc_html__('Left Image Alt Text', DMPRO_TEXTDOMAIN),
                'type' => 'text',
                'description' => esc_html__('Define the HTML ALT text for the image.', DMPRO_TEXTDOMAIN),
                'toggle_slug' => 'slider_content',
                'sub_toggle' => 'left_side'
        ];

        $module_fields['after_image'] = [
                'label' => esc_html__('Right Image', DMPRO_TEXTDOMAIN),
                'type' => 'upload',
                'option_category' => 'basic_option',
                'upload_button_text' => esc_attr__('Upload an image', DMPRO_TEXTDOMAIN),
                'choose_text' => esc_attr__('Choose an Image', DMPRO_TEXTDOMAIN),
                'update_text' => esc_attr__('Set As Image', DMPRO_TEXTDOMAIN),
                'description' => esc_html__('Upload your desired image to display on the right part of slider.', DMPRO_TEXTDOMAIN),
                'toggle_slug' => 'slider_content',
                'sub_toggle' => 'right_side'
        ];

        $module_fields['after_image_alt'] = [
                'label' => esc_html__('Right Image Alt Text', DMPRO_TEXTDOMAIN),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Define the HTML ALT text for the image.', DMPRO_TEXTDOMAIN),
                'toggle_slug' => 'slider_content',
                'sub_toggle' => 'right_side'
        ];

        $module_fields['before_label'] = [
                'label' => esc_html__('Left Label', DMPRO_TEXTDOMAIN),
                'type' => 'text',
                'option_category' => 'basic_option',
                //'toggle_slug' => 'labels',
                'description' => esc_html__('The label for the left image.', DMPRO_TEXTDOMAIN),
                'default' => esc_html__('Before', DMPRO_TEXTDOMAIN),
                'toggle_slug' => 'slider_content',
                'sub_toggle' => 'left_side'
        ];

        $module_fields['after_label'] = [
                'label' => esc_html__('Right Label', DMPRO_TEXTDOMAIN),
                'type' => 'text',
                'option_category' => 'basic_option',
                //'toggle_slug' => 'labels',
                'description' => esc_html__('The label for the right image.', DMPRO_TEXTDOMAIN),
                'default' => esc_html__('After', DMPRO_TEXTDOMAIN),
                'toggle_slug' => 'slider_content',
                'sub_toggle' => 'right_side'
        ];

        $module_fields['always_show_labels'] = [
                'label' => esc_html__('Always Show Labels', DMPRO_TEXTDOMAIN),
                'type' => 'yes_no_button',
                'option_category' => 'basic_option',
                'toggle_slug' => 'labels',
                'tab_slug' => 'advanced',
                'default' => 'off',
                'options'           => array(
                    'off' => esc_html__( 'Off', DMPRO_TEXTDOMAIN ),
                    'on'  => esc_html__( 'On', DMPRO_TEXTDOMAIN ),
                  ),
                'description' => esc_html__('Turn this on if you would like the labels to always show, instead of only on hover.', DMPRO_TEXTDOMAIN),
        ];
        $module_fields['before_label_bg_color'] = [
                'label' => esc_html__('Left Label Background Color', DMPRO_TEXTDOMAIN),
                'type' => 'color-alpha',
                'default' => "rgba(255, 255, 255, 0.2)",
                'toggle_slug' => 'labels',
                'tab_slug' => 'advanced',
            ];

        $module_fields['after_label_bg_color'] = [
                'label' => esc_html__('Right Label Background Color', DMPRO_TEXTDOMAIN),
                'type' => 'color-alpha',
                'default' => "rgba(255, 255, 255, 0.2)",
                'toggle_slug' => 'labels',
                'tab_slug' => 'advanced',
        ];

        $module_fields['enable_overlay'] = [
                'label' => esc_html__('Hover Overlay', DMPRO_TEXTDOMAIN),
                'type' => 'yes_no_button',
                'toggle_slug' => 'overlay',
                'tab_slug' => 'advanced',
                'default' => 'on',
                'options'           => array(
                    'off' => esc_html__( 'Off', DMPRO_TEXTDOMAIN ),
                    'on'  => esc_html__( 'On', DMPRO_TEXTDOMAIN ),
                  ),
                'description' => esc_html__('Enable to show an overlay effect when the mouse hovers over the slider.', DMPRO_TEXTDOMAIN),
        ];

        $module_fields['overlay_color'] = [
                'label' => esc_html__('Overlay  Color', DMPRO_TEXTDOMAIN),
                'type' => 'color-alpha',
                'default' => "rgba(0, 0, 0, 0.5)",
                'toggle_slug' => 'overlay',
                'tab_slug' => 'advanced',
        ];

        $module_fields['direction'] = [
                'label' => esc_html__('Slider Direction', DMPRO_TEXTDOMAIN),
                'type' => 'select',
                'option_category' => 'basic_option',
                'options' => array(
                    'horizontal' => 'Horizontal',
                    'vertical' => 'Vertical',
                ),
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
                'default' => 'horizontal',
                'description' => esc_html__('Choose Horizontal or Vertical for the Slider Direction.', DMPRO_TEXTDOMAIN),
        ];

        $module_fields['offset'] = [
                'label' => esc_html__('Slider Starting Position', DMPRO_TEXTDOMAIN),
                'type' => 'range',
                'option_category' => 'layout',
                'default' => '50',
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
                'unitless' => true,
                'range_settings' => array(
                    'min' => '0',
                    'max' => '100',
                    'step' => '1',
                ),
                'description' => esc_html__('You can change the starting position of the slider (in percentage).', DMPRO_TEXTDOMAIN),
            ];
            
        $module_fields['slider_color'] = [
                'label' => esc_html__('Slider Line Color', DMPRO_TEXTDOMAIN),
                'type' => 'color-alpha',
                'default' => "#ffffff",
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
        ];

        $module_fields['slider_handle_color'] = [
                'label' => esc_html__('Handle Color', DMPRO_TEXTDOMAIN),
                'type' => 'color-alpha',
                'default' => "#ffffff",
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
        ];
            
        $module_fields['slider_handle_bg_color'] = [
                'label' => esc_html__('Handle Background Color', DMPRO_TEXTDOMAIN),
                'type' => 'color-alpha',
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
        ];
            
        $module_fields['slider_handle_icon_color'] = [
                'label' => esc_html__('Handle Icon Color', DMPRO_TEXTDOMAIN),
                'type' => 'color-alpha',
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
                'default' => "#ffffff",
        ];

        return $module_fields;

    }

    public function get_advanced_fields_config() {
        $advanced_fields = [];

        $advanced_fieds['fonts'] = false;
        $advanced_fields['text'] = false;
        $advanced_fields['text_shadow'] = false;

        $advanced_fields['fonts'] = [
                'labels' => [
                    'label' => esc_html__('Title', DMPRO_TEXTDOMAIN),
                    'css' => [
                        'main' => "{$this->main_css_element} .dmpro_before_after_slider_label:before",
                    ],
                    'important' => 'all',
                    'toggle_slug' => 'labels',
                    'hide_text_align' => true
                ],
            ];
        return $advanced_fields;
    }

    public function get_custom_css_fields_config() {
        $custom_css_fields = [];
        $custom_css_fields['dss_image_before'] = [
                'label' => 'Left Image',
                'selector' => '%%order_class%% .dmpro_before_after_slider_before',
        ];
        $custom_css_fields['dss_image_after'] = [
                'label' => 'Right Image',
                'selector' => '%%order_class%% .dmpro_before_after_slider_after',
        ];
        $custom_css_fields['dss_label_before'] = [
                'label' => 'Left Label',
                'selector' => '%%order_class%% .dmpro_before_after_slider_overlay .dmpro_before_after_slider_before_label:before',
        ];
        $custom_css_fields['dss_label_after'] = [
                'label' => 'Right Label',
                'selector' => '%%order_class%% .dmpro_before_after_slider_overlay .dmpro_before_after_slider_after_label:before',
        ];
       $custom_css_fields['dss_overlay'] = [
                'label' => 'Overlay',
                'selector' => '%%order_class%% .dmpro_before_after_slider_overlay',
        ];

        return $custom_css_fields;
    }

    public function render($attrs, $content, $render_slug) {
        wp_enqueue_style("dmpro-".$this->slug, $this->module_url . 'style.css', [], DMPRO_VERSION , 'all');
        wp_enqueue_script("dmpro-".$this->slug, $this->module_url . 'custom.js', array('dmpro_event_move_script'), DMPRO_VERSION, true);
        $get_options = [
            "before_image"     => $this->props["before_image"],
            "before_image_alt" => $this->props["before_image_alt"],
            "before_label"     => $this->props["before_label"],
            "after_image"      => $this->props["after_image"],
            "after_image_alt"  => $this->props["after_image_alt"],
            "after_label"      => $this->props["after_label"],
            "offset"           => $this->props["offset"],
            "direction"        => $this->props["direction"]
        ];
        $options = htmlspecialchars(wp_json_encode($get_options), ENT_QUOTES, 'UTF-8');

        $this->apply_css($render_slug);

        return sprintf(
            '<div class="dmpro_before_after_slider_container" data-options="%1$s">
            </div>',
            $options
        );
    }
    public function apply_css($render_slug) {
        if( $this->props["always_show_labels"] === "on" ) {
            ET_Builder_Element::set_style($render_slug, [
                'selector' => "%%order_class%% .dmpro_before_after_slider_overlay .dmpro_before_after_slider_after_label, %%order_class%% .dmpro_before_after_slider_overlay .dmpro_before_after_slider_before_label",
                'declaration' => "opacity: 1 !important;",
            ]);
        }

        ET_Builder_Element::set_style($render_slug, [
            'selector' => "%%order_class%% .dmpro_before_after_slider_overlay .dmpro_before_after_slider_before_label:before",
            'declaration' => "background: {$this->props['before_label_bg_color']};",
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => "%%order_class%% .dmpro_before_after_slider_overlay .dmpro_before_after_slider_after_label:before",
            'declaration' => "background: {$this->props['after_label_bg_color']};",
        ]);
        
        if( $this->props["enable_overlay"] === 'on' ) {            
            ET_Builder_Element::set_style($render_slug, [
                'selector' => "%%order_class%% .dmpro_before_after_slider_overlay:hover",
                'declaration' => "background: {$this->props['overlay_color']};",
            ]);
        }
        ET_Builder_Element::set_style($render_slug, [
            'selector' => "%%order_class%% .dmpro_before_after_slider_handle:before, %%order_class%%  .dmpro_before_after_slider_handle:after",
            'declaration' => "background: {$this->props['slider_color']};"
        ]);
                
        ET_Builder_Element::set_style($render_slug, [
            'selector' => "%%order_class%% .dmpro_before_after_slider_horizontal .dmpro_before_after_slider_handle:before",
            'declaration' => "-webkit-box-shadow: 0 3px 0 {$this->props['slider_handle_color']}, 0px 0px 12px rgba(51, 51, 51, 0.5);
                            -moz-box-shadow: 0 3px 0 {$this->props['slider_handle_color']}, 0px 0px 12px rgba(51, 51, 51, 0.5);
                            box-shadow: 0 3px 0 {$this->props['slider_handle_color']}, 0px 0px 12px rgba(51, 51, 51, 0.5);"
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => "%%order_class%% .dmpro_before_after_slider_horizontal .dmpro_before_after_slider_handle:after",
            'declaration' => "-webkit-box-shadow: 0 -3px 0 {$this->props['slider_handle_color']}, 0px 0px 12px rgba(51, 51, 51, 0.5);
                            -moz-box-shadow: 0 -3px 0 {$this->props['slider_handle_color']}, 0px 0px 12px rgba(51, 51, 51, 0.5);
                            box-shadow: 0 -3px 0 {$this->props['slider_handle_color']}, 0px 0px 12px rgba(51, 51, 51, 0.5);"
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => "%%order_class%% .dmpro_before_after_slider_vertical .dmpro_before_after_slider_handle:before",
            'declaration' => "-webkit-box-shadow: 3px 0 0 {$this->props['slider_handle_color']}, 0px 0px 12px rgba(51, 51, 51, 0.5);
                            -moz-box-shadow: 3px 0 0 {$this->props['slider_handle_color']}, 0px 0px 12px rgba(51, 51, 51, 0.5);
                            box-shadow: 3px 0 0 {$this->props['slider_handle_color']}, 0px 0px 12px rgba(51, 51, 51, 0.5);"
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => "%%order_class%% .dmpro_before_after_slider_vertical .dmpro_before_after_slider_handle:after",
            'declaration' => "-webkit-box-shadow: -3px 0 0 {$this->props['slider_handle_color']}, 0px 0px 12px rgba(51, 51, 51, 0.5);
                            -moz-box-shadow: -3px 0 0 {$this->props['slider_handle_color']}, 0px 0px 12px rgba(51, 51, 51, 0.5);
                            box-shadow: -3px 0 0 {$this->props['slider_handle_color']}, 0px 0px 12px rgba(51, 51, 51, 0.5);"
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => "%%order_class%% .dmpro_before_after_slider_handle",
            'declaration' => "border-color: {$this->props['slider_handle_color']};"
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => "%%order_class%% .dmpro_before_after_slider_handle",
            'declaration' => "background: {$this->props['slider_handle_bg_color']};"
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => "%%order_class%% .dmpro_before_after_slider_left_arrow",
            'declaration' => "border-right-color: {$this->props['slider_handle_icon_color']};"
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => "%%order_class%% .dmpro_before_after_slider_right_arrow",
            'declaration' => "border-left-color: {$this->props['slider_handle_icon_color']};"
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => "%%order_class%% .dmpro_before_after_slider_up_arrow",
            'declaration' => "border-bottom-color: {$this->props['slider_handle_icon_color']};"
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => "%%order_class%% .dmpro_before_after_slider_down_arrow",
            'declaration' => "border-top-color: {$this->props['slider_handle_icon_color']};"
        ]);

    }
}
new DMPRO_BeforeAfter;