<?php
class DMPRO_BeforeAfter extends ET_Builder_Module
{
    protected $module_credits = array(
        'module_uri' => DMPRO_MODULE . 'before-after-slider',
        'author' => DMPRO_AUTHOR,
        'author_uri' => DMPRO_WEB,
    );

    public function init() {
        $this->slug = 'dmpro_before_after_slider';
        $this->icon_path = plugin_dir_path(__FILE__) . "BeforeAfter.svg";
        $this->vb_support = 'on';
        $this->name = esc_html__(DMPRO_PREFIX . 'Before After Slider', 'dmpro-divi-modules-pro');
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
                        'title' => esc_html__('Slider Content', 'dmpro-divi-modules-pro'),
                    ]
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'slider' => esc_html__('Slider', 'dmpro-divi-modules-pro'),
                    'labels' => esc_html__('Labels', 'dmpro-divi-modules-pro'),
                    'overlay' => esc_html__('Overlay', 'dmpro-divi-modules-pro'),
                ],
            ],
        ];
    }

    public function get_fields() {
        $module_fields = [];
        $module_fields['before_image'] = [
                'label' => esc_html__('Left Image', 'dmpro-divi-modules-pro'),
                'type' => 'upload',
                'option_category' => 'basic_option',
                'upload_button_text' => esc_attr__('Upload an image', 'dmpro-divi-modules-pro'),
                'choose_text' => esc_attr__('Choose an Image', 'dmpro-divi-modules-pro'),
                'update_text' => esc_attr__('Set As Image', 'dmpro-divi-modules-pro'),
                'description' => esc_html__('Upload your desired image to display on the left part of slider.', 'dmpro-divi-modules-pro'),
                'toggle_slug' => 'slider_content',
                'sub_toggle' => 'left_side'
        ];

        $module_fields['before_image_alt'] = [
                'label' => esc_html__('Left Image Alt Text', 'dmpro-divi-modules-pro'),
                'type' => 'text',
                'description' => esc_html__('Define the HTML ALT text for the image.', 'dmpro-divi-modules-pro'),
                'toggle_slug' => 'slider_content',
                'sub_toggle' => 'left_side'
        ];

        $module_fields['after_image'] = [
                'label' => esc_html__('Right Image', 'dmpro-divi-modules-pro'),
                'type' => 'upload',
                'option_category' => 'basic_option',
                'upload_button_text' => esc_attr__('Upload an image', 'dmpro-divi-modules-pro'),
                'choose_text' => esc_attr__('Choose an Image', 'dmpro-divi-modules-pro'),
                'update_text' => esc_attr__('Set As Image', 'dmpro-divi-modules-pro'),
                'description' => esc_html__('Upload your desired image to display on the right part of slider.', 'dmpro-divi-modules-pro'),
                'toggle_slug' => 'slider_content',
                'sub_toggle' => 'right_side'
        ];

        $module_fields['after_image_alt'] = [
                'label' => esc_html__('Right Image Alt Text', 'dmpro-divi-modules-pro'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Define the HTML ALT text for the image.', 'dmpro-divi-modules-pro'),
                'toggle_slug' => 'slider_content',
                'sub_toggle' => 'right_side'
        ];

        $module_fields['before_label'] = [
                'label' => esc_html__('Left Label', 'dmpro-divi-modules-pro'),
                'type' => 'text',
                'option_category' => 'basic_option',
                //'toggle_slug' => 'labels',
                'description' => esc_html__('The label for the left image.', 'dmpro-divi-modules-pro'),
                'default' => esc_html__('Before', 'dmpro-divi-modules-pro'),
                'toggle_slug' => 'slider_content',
                'sub_toggle' => 'left_side'
        ];

        $module_fields['after_label'] = [
                'label' => esc_html__('Right Label', 'dmpro-divi-modules-pro'),
                'type' => 'text',
                'option_category' => 'basic_option',
                //'toggle_slug' => 'labels',
                'description' => esc_html__('The label for the right image.', 'dmpro-divi-modules-pro'),
                'default' => esc_html__('After', 'dmpro-divi-modules-pro'),
                'toggle_slug' => 'slider_content',
                'sub_toggle' => 'right_side'
        ];

        $module_fields['always_show_labels'] = [
                'label' => esc_html__('Always Show Labels', 'dmpro-divi-modules-pro'),
                'type' => 'yes_no_button',
                'option_category' => 'basic_option',
                'toggle_slug' => 'labels',
                'tab_slug' => 'advanced',
                'default' => 'off',
                'options'           => array(
                    'off' => esc_html__( 'Off', 'dmpro-divi-modules-pro' ),
                    'on'  => esc_html__( 'On', 'dmpro-divi-modules-pro' ),
                  ),
                'description' => esc_html__('Turn this on if you would like the labels to always show, instead of only on hover.', 'dmpro-divi-modules-pro'),
        ];
        $module_fields['before_label_bg_color'] = [
                'label' => esc_html__('Left Label Background Color', 'dmpro-divi-modules-pro'),
                'type' => 'color-alpha',
                'default' => "rgba(255, 255, 255, 0.2)",
                'toggle_slug' => 'labels',
                'tab_slug' => 'advanced',
            ];

        $module_fields['after_label_bg_color'] = [
                'label' => esc_html__('Right Label Background Color', 'dmpro-divi-modules-pro'),
                'type' => 'color-alpha',
                'default' => "rgba(255, 255, 255, 0.2)",
                'toggle_slug' => 'labels',
                'tab_slug' => 'advanced',
        ];

        $module_fields['enable_overlay'] = [
                'label' => esc_html__('Hover Overlay', 'dmpro-divi-modules-pro'),
                'type' => 'yes_no_button',
                'toggle_slug' => 'overlay',
                'tab_slug' => 'advanced',
                'default' => 'on',
                'options'           => array(
                    'off' => esc_html__( 'Off', 'dmpro-divi-modules-pro' ),
                    'on'  => esc_html__( 'On', 'dmpro-divi-modules-pro' ),
                  ),
                'description' => esc_html__('Enable to show an overlay effect when the mouse hovers over the slider.', 'dmpro-divi-modules-pro'),
        ];

        $module_fields['overlay_color'] = [
                'label' => esc_html__('Overlay  Color', 'dmpro-divi-modules-pro'),
                'type' => 'color-alpha',
                'default' => "rgba(0, 0, 0, 0.5)",
                'toggle_slug' => 'overlay',
                'tab_slug' => 'advanced',
        ];

        $module_fields['direction'] = [
                'label' => esc_html__('Slider Direction', 'dmpro-divi-modules-pro'),
                'type' => 'select',
                'option_category' => 'basic_option',
                'options' => array(
                    'horizontal' => 'Horizontal',
                    'vertical' => 'Vertical',
                ),
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
                'default' => 'horizontal',
                'description' => esc_html__('Choose Horizontal or Vertical for the Slider Direction.', 'dmpro-divi-modules-pro'),
        ];

        $module_fields['offset'] = [
                'label' => esc_html__('Slider Starting Position', 'dmpro-divi-modules-pro'),
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
                'description' => esc_html__('You can change the starting position of the slider (in percentage).', 'dmpro-divi-modules-pro'),
            ];
            
        $module_fields['slider_color'] = [
                'label' => esc_html__('Slider Line Color', 'dmpro-divi-modules-pro'),
                'type' => 'color-alpha',
                'default' => "#ffffff",
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
        ];

        $module_fields['slider_handle_color'] = [
                'label' => esc_html__('Handle Color', 'dmpro-divi-modules-pro'),
                'type' => 'color-alpha',
                'default' => "#ffffff",
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
        ];
            
        $module_fields['slider_handle_bg_color'] = [
                'label' => esc_html__('Handle Background Color', 'dmpro-divi-modules-pro'),
                'type' => 'color-alpha',
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
        ];
            
        $module_fields['slider_handle_icon_color'] = [
                'label' => esc_html__('Handle Icon Color', 'dmpro-divi-modules-pro'),
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
                    'label' => esc_html__('Title', 'dmpro-divi-modules-pro'),
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
        wp_enqueue_style("dmpro-".$this->slug, plugin_dir_url(__FILE__) . 'style.css', [], DMPRO_VERSION , 'all');
        wp_enqueue_script("dmpro-".$this->slug, plugin_dir_url(__FILE__) . 'custom.js', array('dmpro_event_move_script'), DMPRO_VERSION, true);
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
        $options = htmlspecialchars(json_encode($get_options), ENT_QUOTES, 'UTF-8');

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