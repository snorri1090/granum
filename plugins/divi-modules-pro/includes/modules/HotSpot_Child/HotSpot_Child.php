<?php

class DMPRO_HotSpot_Child extends ET_Builder_Module {
	
	public $module_url = DMPRO_MODULES_URL . 'HotSpot_Child' . '/';

    public function init()
    {
        $this->slug = 'dmpro_image_hotspot_child';
        $this->vb_support = 'on';
        $this->type = 'child';
        $this->name = esc_html__('Marker', DMPRO_TEXTDOMAIN);
        $this->plural = esc_html__('Hotspots', DMPRO_TEXTDOMAIN);
        $this->child_title_var = 'title';
        $this->advanced_setting_tooltip_title = esc_html__('New Hotspot', DMPRO_TEXTDOMAIN);
        $this->settings_text = esc_html__('Marker', DMPRO_TEXTDOMAIN);
        $this->main_css_element = '%%order_class%%'; 
        $this->settings_modal_toggles = [
            'general' => [
                'toggles' => [
                    'hotspot' => esc_html__('Hotspot Marker', DMPRO_TEXTDOMAIN),
                    'tooltip' => esc_html__('Hotspot Tooltip', DMPRO_TEXTDOMAIN),
                    'settings' => esc_html__('Hotspot Settings', DMPRO_TEXTDOMAIN),
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'hotspot_icon_image' => esc_html__('Hotspot', DMPRO_TEXTDOMAIN),
                    'hotspot_ripple_effect' => esc_html__('Marker Pulse Effect', DMPRO_TEXTDOMAIN),
                    'tooltip_styles' => esc_html__('Tooltip Image/Icon', DMPRO_TEXTDOMAIN),
                    'tooltip_text' => [
                        'sub_toggles' => [
                            'title' => [
                                'name' => 'Title',
                            ],
                            'desc' => [
                                'name' => 'Description',
                            ]
                        ],
                        'tabbed_subtoggles'    => true,
                        'title' => esc_html__('Tooltip Text', DMPRO_TEXTDOMAIN),
                        'priority' => 49,
                    ],
                    'tooltip_box' => esc_html__('Tooltip Box', DMPRO_TEXTDOMAIN),
                ],
            ]
        ];
    }

    public function get_fields(){

        $fields = [];

        $fields["title"] = [
            'label' => esc_html__('Admin Label', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'default' => 'Hotspot',
            'toggle_slug' => 'hotspot',
        ];

        $fields['use_hotspot_icon'] = [
            'label' => esc_html__('Enable Icon Marker', DMPRO_TEXTDOMAIN),
            'type'  => 'yes_no_button',
            'options' => [
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
                'on'  => esc_html__('Yes', DMPRO_TEXTDOMAIN)
            ],
            'default' => 'off',
            'toggle_slug' => 'hotspot',
            'affects' => [
                'hotspot_icon',
                'hotspot_icon_color',
                'hotspot_circle_icon',
                'hotspot_circle_color',
                'hotspot_circle_border',
                'hotspot_circle_border_color',
                'use_hotspot_icon_font_size',
                'hotspot_icon_size',
                'hotspot_image',
                'img_alt',
                'hotspot_image_width'
            ]
        ];

        $fields["hotspot_image"] = [
            'label' => esc_html__('Image Marker', DMPRO_TEXTDOMAIN),
            'type'               => 'upload',
            'option_category'    => 'basic_option',
            'upload_button_text' => esc_attr__('Upload an image', DMPRO_TEXTDOMAIN),
            'choose_text'        => esc_attr__('Choose an Image', DMPRO_TEXTDOMAIN),
            'update_text'        => esc_attr__('Set As Image', DMPRO_TEXTDOMAIN),
            'hide_metadata'      => true,
            'depends_show_if'   => 'off',
            'toggle_slug'       => 'hotspot',
            'dynamic_content'   => 'image'
        ];

        $fields["img_alt"] = [
            'label'       => esc_html__( 'Image Alt Text', DMPRO_TEXTDOMAIN ),
            'type'        => 'text',
            'description' => esc_html__( 'Define the HTML ALT text for your image here.', DMPRO_TEXTDOMAIN),
            'depends_show_if'   => 'off',
            'toggle_slug'       => 'hotspot',
        ];

        $fields["hotspot_image_width"] = [
            'label' => esc_html__('Hotspot Image Width', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'validate_unit' => true,
            'default' => '100px',
            'default_unit' => 'px',
            'default_on_front' => '100px',
            'allowed_units' => ['px'],
            'depends_show_if'   => 'off',
            'range_settings' => [
                'min' => '0',
                'max' => '1000',
                'step' => '10'
            ],
            'mobile_options' => true,
            'tab_slug' => 'advanced',
            'toggle_slug' => 'hotspot_icon_image'
        ];

        $fields['hotspot_icon'] = [
            'label' => esc_html__('Icon', DMPRO_TEXTDOMAIN),
            'type' => 'select_icon',
            'option_category' => 'basic_option',
            'default' => '5',
            'depends_show_if'   => 'on',
            'toggle_slug' => 'hotspot'
        ];

        $fields["hotspot_icon_color"] = [
            'label' => esc_html__('Icon Color', DMPRO_TEXTDOMAIN),
            'type' => 'color-alpha',
            'default' => '#7EBEC5',
            'depends_show_if' => 'on',
            'hover' => 'tabs',
            'mobile_options' => true,
            'tab_slug' => 'advanced',
            'toggle_slug' => 'hotspot_icon_image'
        ];

        $fields["hotspot_circle_icon"] = [
            'label'           => esc_html__('Circle Icon', DMPRO_TEXTDOMAIN),
            'type'             => 'yes_no_button',
            'option_category'  => 'configuration',
            'default'          => 'off',
            'options'          => [
                'on'  => esc_html__('Yes', DMPRO_TEXTDOMAIN),
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
            ],
            'depends_show_if'    => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'hotspot_icon_image'
        ];

        $fields["hotspot_circle_color"] = [
            'label'          => esc_html__('Circle Color', DMPRO_TEXTDOMAIN),
            'type'           => 'color-alpha',
            'custom_color'   => true,
            'depends_show_if' => 'on',
            'hover' => 'tabs',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'hotspot_icon_image',
            'show_if' => array(
                'hotspot_circle_icon' => 'on',
            ),
        ];

        $fields["hotspot_circle_border"] = [
            'label'            => esc_html__('Show Circle Border', DMPRO_TEXTDOMAIN),
            'type'             => 'yes_no_button',
            'option_category'  => 'configuration',
            'default'          => 'off',
            'options'          => [
                'on'  => esc_html__('Yes', DMPRO_TEXTDOMAIN),
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
            ],
            'depends_show_if'    => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'hotspot_icon_image',
            'show_if' => array(
                'hotspot_circle_icon' => 'on',
            ),
        ];

        $fields["hotspot_circle_border_color"] = [
            'label' => esc_html__('Circle Border Color', DMPRO_TEXTDOMAIN),
            'type' => 'color-alpha',
            'custom_color' => true,
            'hover' => 'tabs',
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'hotspot_icon_image',
            'show_if' => array(
                'hotspot_circle_icon' => 'on',
                'hotspot_circle_border' => 'on',
            ),
        ];

        $fields["use_hotspot_icon_font_size"] = [
            'label' => esc_html__('Use Icon Font Size', 'et_builder'),
            'type'  => 'yes_no_button',
            'option_category' => 'font_option',
            'options' => [
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
                'on'  => esc_html__('Yes', DMPRO_TEXTDOMAIN),
            ],
            'default_on_front' => 'off',
            'depends_show_if' => 'on',
            'hover' => 'tabs',
            'mobile_options' => true,
            'tab_slug' => 'advanced',
            'toggle_slug' => 'hotspot_icon_image'
        ];

        $fields["hotspot_icon_size"] = [
            'label' => esc_html__('Icon Font Size', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'default' => '24px',
            'default_on_front' => '24px',
            'default_unit' => 'px',
            'range_settings' => [
                'min' => '0',
                'max' => '100',
                'step' => '1'
            ],
            'depends_show_if' => 'on',
            'validate_unit' => true,
            'hover' => 'tabs',
            'mobile_options' => true,
            'tab_slug' => 'advanced',
            'toggle_slug' => 'hotspot_icon_image',
            'show_if' => array(
                'use_hotspot_icon_font_size' => 'on',
            ),
        ];

        $fields["hotspot_ripple_effect"] = [
            'label'   => esc_html__('Enable Marker Pulse Effect', DMPRO_TEXTDOMAIN),
            'type'    => 'yes_no_button',
            'default' => 'off',
            'options' => [
                'on'  => esc_html__('Yes', DMPRO_TEXTDOMAIN),
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'hotspot_ripple_effect'
        ];

        $fields["hotspot_ripple_effect_color"] = [
            'label' => esc_html__('Market Pulse Effect Color', DMPRO_TEXTDOMAIN),
            'type' => 'color-alpha',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'hotspot_ripple_effect'
        ];

        $fields["hotspot_position_vertical"] = [
            'label' => esc_html__('Marker Vertical Position', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'default' => '10%',
            'default_unit' => '%',
            'range_settings' => [
                'min' => '0',
                'max' => '100',
                'step' => '1'
            ],
            'validate_unit' => true,
            'toggle_slug' => 'settings'
        ];

        $fields["hotspot_position_horizontal"] = [
            'label' => esc_html__('Marker Horizontal Position', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'default' => '10%',
            'default_unit' => '%',
            'range_settings' => [
                'min' => '0',
                'max' => '100',
                'step' => '1'
            ],
            'validate_unit' => true,
            'toggle_slug' => 'settings'
        ];

        $fields["type"] = [
            'label' => esc_html__('Tooltip Type', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'options' => [
                'default' => esc_html__('Default (Text, Icon, Image)', DMPRO_TEXTDOMAIN),
                'library' => esc_html__('Divi Library Layout', DMPRO_TEXTDOMAIN),
            ],
            'default' => 'default',
            'affects' => [
                'use_tooltip_icon',
                'tooltip_img_src',
                'tooltip_title',
                'tooltip_desc',
                'show_tooltip_button',
                'library_id'
            ],
            'toggle_slug' => 'tooltip'
        ];

        $fields["library_id"] = [
            'label' => esc_html__('Divi Library', DMPRO_TEXTDOMAIN),
            'options' => $this->image_hotspot(),
            'type' => 'select',
            'depends_show_if' => 'library',
            'computed_affects' => [
                '__gethtmllibary',
            ],
            'toggle_slug' => 'tooltip'
        ];

        $fields["use_tooltip_icon"] = [
            'label' => esc_html__('Enable Icon within Tooltip', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'default_on_front' => 'off',
            'options' => [
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
                'on'  => esc_html__('Yes', DMPRO_TEXTDOMAIN),
            ],
            'toggle_slug' => 'tooltip',
            'depends_show_if' => 'default',
            'affects' => [
                'tooltip_icon',
                'tooltip_icon_color',
                'use_tooltip_icon_circle',
                'tooltip_icon_circle_color',
                'use_tooltip_icon_circle_border',
                'tooltip_icon_circle_border_color',
                'use_tooltip_icon_font_size',
                'tooltip_icon_font_size',
                'tooltip_img_src',
                'tooltip_img_alt',
                'tooltip_image_width',
            ],
        ];

        $fields["tooltip_icon"] = [
            'label' => esc_html__('Icon', DMPRO_TEXTDOMAIN),
            'type' => 'select_icon',
            'option_category' => 'basic_option',
            'toggle_slug' => 'tooltip',
            'class' => ['et-pb-font-icon'],
            'default' => '1',
            'depends_show_if' => 'on',
            'hover' => 'tabs'
        ];

        $fields["tooltip_icon_color"] = [
            'label' => esc_html__('Icon Color', DMPRO_TEXTDOMAIN),
            'type' => 'color-alpha',
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'tooltip_styles',
            'hover' => 'tabs'
        ];

        $fields["use_tooltip_icon_circle"] = [
            'label' => esc_html__('Show as Circle Icon', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'options' => [
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
                'on'  => esc_html__('Yes', DMPRO_TEXTDOMAIN),
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'tooltip_styles',
            'depends_show_if' => 'on',
            'default_on_front' => 'off',
        ];

        $fields["tooltip_icon_circle_color"] = [
            'label'           => esc_html__('Circle Color', DMPRO_TEXTDOMAIN),
            'type'            => 'color-alpha',
            'depends_show_if' => 'on',
            'validate_unit'   => true,
            'show_if' => [
                'use_tooltip_icon_circle' => 'on'
            ],
            'tab_slug'        => 'advanced',
            'toggle_slug'     => 'tooltip_styles',
            'hover'           => 'tabs'
        ];

        $fields["use_tooltip_icon_circle_border"] = [
            'label'           => esc_html__('Show Circle Border', DMPRO_TEXTDOMAIN),
            'type'            => 'yes_no_button',
            'option_category' => 'configuration',
            'options'         => [
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
                'on'  => esc_html__('Yes', DMPRO_TEXTDOMAIN),
            ],
            'default_on_front'  => 'off',
            'depends_show_if'   => 'on',
            'tab_slug'          => 'advanced',
            'toggle_slug'       => 'tooltip_styles',
            'show_if' => [
                'use_tooltip_icon_circle' => 'on'
            ],
        ];

        $fields["tooltip_icon_circle_border_color"] = [
            'label'           => esc_html__('Circle Border Color', DMPRO_TEXTDOMAIN),
            'type'            => 'color-alpha',
            'show_if' => [
                'use_tooltip_icon_circle' => 'on',
                'use_tooltip_icon_circle_border' => 'on'
            ],
            'validate_unit'   => true,
            'tab_slug'        => 'advanced',
            'toggle_slug'     => 'tooltip_styles',
            'hover'           => 'tabs',
        ];

        $fields["use_tooltip_icon_font_size"] = [
            'label'           => esc_html__('Use Icon Font Size', DMPRO_TEXTDOMAIN),
            'type'            => 'yes_no_button',
            'option_category' => 'font_option',
            'options'         => [
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
                'on'  => esc_html__('Yes', DMPRO_TEXTDOMAIN),
            ],
            'default_on_front' => 'off',
            'depends_show_if'  => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'tooltip_styles',
        ];

        $fields["tooltip_icon_font_size"] = [
            'label' => esc_html__('Icon Font Size', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'default' => '40px',
            'default_unit' => 'px',
            'default_on_front' => '40px',
            'allowed_units' => ['%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'],
            'show_if' => [
                'use_tooltip_icon_font_size' => 'on'
            ],
            'range_settings' => [
                'min'  => '1',
                'max'  => '150',
                'step' => '1',
            ],
            'hover' => 'tabs',
            'validate_unit' => true,
            'tab_slug' => 'advanced',
            'toggle_slug' => 'tooltip_styles',
        ];

        $fields['tooltip_img_src'] = [
            'type' => 'upload',
            'option_category' => 'basic_option',
            'hide_metadata' => true,
            'upload_button_text' => esc_attr__('Upload an image', DMPRO_TEXTDOMAIN),
            'choose_text' => esc_attr__('Choose an Image', DMPRO_TEXTDOMAIN),
            'update_text' => esc_attr__('Set As Image', DMPRO_TEXTDOMAIN),
            'description' => esc_html__('Upload an image to display in the module.', DMPRO_TEXTDOMAIN),
            'depends_show_if' => 'off',
            'toggle_slug' => 'tooltip',
            'dynamic_content' => 'image'
        ];

        $fields["tooltip_img_alt"] = [
            'label'       => esc_html__( 'Image Alt Text', DMPRO_TEXTDOMAIN ),
            'type'        => 'text',
            'description' => esc_html__( 'Define the HTML ALT text for your image here.', DMPRO_TEXTDOMAIN),
            'depends_show_if' => 'off',
            'toggle_slug' => 'tooltip',
        ];

        $fields['tooltip_image_width'] = [
            'label' => esc_html__('Tooltip Image Width', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'default' => '100px',
            'default_unit' => 'px',
            'default_on_front' => '100px',
            'allowed_units' => ['px'],
            'range_settings' => [
                'min'  => '1',
                'max'  => '1000',
                'step' => '10'
            ],
            'depends_show_if' => 'off',
            'mobile_options' => true,
            'responsive' => true,
            'tab_slug' => 'advanced',
            'toggle_slug' => 'tooltip_styles',
        ];

        $fields["tooltip_bg"] = [
            'label'           => esc_html__('Background Color', DMPRO_TEXTDOMAIN),
            'type'            => 'color-alpha',
            'tab_slug'        => 'advanced',
            'toggle_slug'     => 'tooltip_box'
        ];

        $fields["tooltip_title"] = [
            'label' => esc_html__('Title', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'option_category' => 'basic_option',
            'depends_show_if' => 'default',
            'toggle_slug'     => 'tooltip'
        ];

        $fields["tooltip_desc"] = [
            'label'           => esc_html__('Description', DMPRO_TEXTDOMAIN),
            'type'            => 'textarea',
            'option_category' => 'basic_option',
            'depends_show_if' => 'on',
            'dynamic_content' => 'text',
            'depends_show_if' => 'default',
            'toggle_slug'     => 'tooltip'
        ];

        $fields["show_tooltip_button"] = [
            'default' => 'off',
            'label' => esc_html__('Show Button', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'options' => [
                'on' => esc_html__('Yes', DMPRO_TEXTDOMAIN),
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
            ],
            'depends_show_if' => 'default',
            'toggle_slug' => 'tooltip',
            'affects' => [
                'tooltip_button_text',
                'tooltip_button_link',
                'tooltip_button_link_target'
            ],
        ];

        $fields["tooltip_button_text"] = [
            'label' => esc_html__('Button Text', DMPRO_TEXTDOMAIN),
            'default' => esc_html__('Click Here', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'toggle_slug' => 'tooltip',
            'depends_show_if' => 'on'
        ];

        $fields["tooltip_button_link"] = [
            'label' => esc_html__('Button Link', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'depends_show_if' => 'on',
            'toggle_slug' => 'tooltip',
        ];

        $fields["tooltip_button_link_target"] = [
            'label' => esc_html__('Button Link Target', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'default' => 'same_window',
            'options' => [
                'off' => esc_html__('Same Window', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('New Window', DMPRO_TEXTDOMAIN),
            ],
            'depends_show_if' => 'on',
            'toggle_slug' => 'tooltip'
        ];

        $fields["tooltip_position"] = [
            'label' => esc_html__('Tooltip Position', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'options' => [
                'left' => esc_html__('Left', DMPRO_TEXTDOMAIN),
                'right' => esc_html__('Right', DMPRO_TEXTDOMAIN),
                'top' => esc_html__('Top', DMPRO_TEXTDOMAIN),
                'bottom' => esc_html__('Bottom', DMPRO_TEXTDOMAIN),
            ],
            'default' => 'left',
            'default_on_child' => true,
            'toggle_slug' => 'settings'
        ];

        $fields["tooltip_width"] = [
            'label' => esc_html__('Tooltip Width', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'default' => '300px',
            'default_unit' => 'px',
            'default_on_child' => true,
            'mobile_options'  => true,
            'range_settings' => [
                'min' => '0',
                'max' => '500',
                'step' => '1'
            ],
            'validate_unit' => true,
            'toggle_slug' => 'settings'
        ];

        $fields["tooltip_content_align"] = [
            'label'           => esc_html__('Tooltip Content Align', DMPRO_TEXTDOMAIN),
            'type'            => 'select',
            'option_category' => 'basic_option',
            'options' => [
                'left'  => esc_html__('Left', DMPRO_TEXTDOMAIN),
                'center' => esc_html__('Center', DMPRO_TEXTDOMAIN),
                'right' => esc_html__('Right', DMPRO_TEXTDOMAIN)
            ],
            'default' => 'left',
            'toggle_slug' => 'settings'
        ];

        $fields['use_tooltip_arrow'] = [
            'label' => esc_html__('Use Tooltip Arrow', DMPRO_TEXTDOMAIN),
            'type'  => 'yes_no_button',
            'options' => [
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
                'on'  => esc_html__('Yes', DMPRO_TEXTDOMAIN)
            ],
            'default' => 'off',
            'toggle_slug' => 'settings',
            'affects' => [
                'arrow_color'
            ]
        ];

        $fields["arrow_color"] = [
            'label'             => esc_html__('Arrow Color', DMPRO_TEXTDOMAIN),
            'type'              => 'color-alpha',
            'default'           => '#000',
            'depends_show_if'   => 'on',
            'toggle_slug'       => 'settings'
        ];

        $fields['tooltip_padding'] = [
            'label' => esc_html__('Tooltip Padding', DMPRO_TEXTDOMAIN),
            'type' => 'custom_margin',
            'default' => '10px|10px|10px|10px',
            'mobile_options' => true,
            'responsive' => true,
            'tab_slug' => 'advanced',
            'toggle_slug'  => 'tooltip_box'
        ];

        $fields["__gethtmllibary"] = [
            'type' => 'computed',
            'computed_callback' => ['DMPRO_HotSpot_Child', 'get_html_libary'],
            'computed_depends_on' => [
                'library_id'
            ]
        ];

        return $fields;
    }

    public function get_advanced_fields_config() {

        $advanced_fields = [];

        $advanced_fields['fonts'] = false;
        $advanced_fields['text'] = false;
        $advanced_fields['text_shadow'] = false;
        $advanced_fields['link_options'] = false;

        $advanced_fields["fonts"]["tooltip_title"] = [
            'label' => esc_html__('Title', DMPRO_TEXTDOMAIN),
            'css' => [
                'main' => "%%order_class%% .dmpro-tooltip-title",
            ],
            'hide_text_align' => true,
            'toggle_slug' => 'tooltip_text',
            'sub_toggle'  => 'title',
            'line_height' => [
                'range_settings' => [
                    'default' => '1em',
                    'min'  => '1',
                    'max'  => '3',
                    'step' => '.1'
                ],
            ],
            'header_level' => [
                'default' => 'h2',
            ],
            'font_size' => [
                'default' => '18px',
            ],
            'important' => 'all',
        ];

        $advanced_fields["fonts"]["tooltip_desc"] = [
            'label' => esc_html__('Description', DMPRO_TEXTDOMAIN),
            'css' => [
                'main' => "%%order_class%% .dmpro-tooltip-desc",
            ],
            'hide_text_align' => true,
            'toggle_slug' => 'tooltip_text',
            'sub_toggle'  => 'desc',
            'line_height' => [
                'range_settings' => [
                    'default' => '1em',
                    'min'  => '1',
                    'max'  => '3',
                    'step' => '.1'
                ],
            ],
            'font_size' => [
                'default' => absint(et_get_option('body_font_size', '14')) . 'px', 
            ],
            'important' => 'all',
        ];

        $advanced_fields['button']["tooltip_button"] = [
            'label' => esc_html__('Tooltip Button', DMPRO_TEXTDOMAIN),
            'use_alignment' => false,
            'css' => [
                'main' => "%%order_class%% .dmpro-tooltip-button",
                'important' => true,
            ],
            'box_shadow'  => [
                'css' => [
                    'main' => "%%order_class%% .dmpro-tooltip-button",
                    'important' => true,
                ],
            ],
            'margin_padding' => [
                'css' => [
                    'main' => "%%order_class%% .dmpro-tooltip-button.et_pb_button",
                    'important' => 'all',
                ],
            ],
        ];

        $advanced_fields['borders']['hotspot_img'] = [
            'label_prefix' => esc_html__('Hotspot Image', DMPRO_TEXTDOMAIN),
            'css' => [
                'main' => [
                    'border_radii'  => "%%order_class%% .dmpro-hotspot .dmpro-hotspot-image",
                    'border_styles' => "%%order_class%% .dmpro-hotspot .dmpro-hotspot-image",
                ],
            ],
            'tab_slug' => 'advanced',
            'toggle_slug'  => 'hotspot_icon_image',
            'depends_on'      => ['use_hotspot_icon'],
            'depends_show_if' => 'off',
        ];

        $advanced_fields['box_shadow']['hotspot_img'] = [
            'label_prefix' => esc_html__('Hotspot Image', DMPRO_TEXTDOMAIN),
            'css' => [
                'main' => '%%order_class%% .dmpro-hotspot .dmpro-hotspot-image',
                'overlay'     => 'inset',
            ],
            'tab_slug' => 'advanced',
            'toggle_slug'  => 'hotspot_icon_image',
            'show_if'   => ['use_hotspot_icon' => 'off'],
        ];

        $advanced_fields['borders']['tooltip_img'] = [
            'label_prefix' => esc_html__('Tooltip Image', DMPRO_TEXTDOMAIN),
            'css' => [
                'main' => [
                    'border_radii'  => "%%order_class%% .dmpro-tooltip-image",
                    'border_styles' => "%%order_class%% .dmpro-tooltip-image",
                ],
            ],
            'tab_slug' => 'advanced',
            'toggle_slug'  => 'tooltip_styles',
            'depends_on'      => ['use_tooltip_icon'],
            'depends_show_if' => 'off'
        ];

        $advanced_fields['box_shadow']['tooltip_img'] = [
            'label' => esc_html__('Tooltip Image', DMPRO_TEXTDOMAIN),
            'css' => [
                'main' => '%%order_class%% .dmpro-tooltip-image',
                'overlay'     => 'inset',
            ],
            'tab_slug' => 'advanced',
            'toggle_slug'  => 'tooltip_styles',
            'show_if'   => ['use_tooltip_icon' => 'off'],
        ];

        $advanced_fields['borders']['tooltip_box'] = [
            'css' => [
                'main' => [
                    'border_radii'  => "%%order_class%% .dmpro-tooltip-wrap",
                    'border_styles' => "%%order_class%% .dmpro-tooltip-wrap",
                ],
            ],
            'tab_slug' => 'advanced',
            'toggle_slug'  => 'tooltip_box',
        ];

        $advanced_fields['box_shadow']['tooltip_box'] = [
            'css' => [
                'main' => '%%order_class%% .dmpro-tooltip-wrap',
                'overlay'     => 'inset',
            ],
            'tab_slug' => 'advanced',
            'toggle_slug'  => 'tooltip_box'
        ];

        $advanced_fields['margin_padding'] = [
            'css' => [
                'margin' => '%%order_class%%',
                'padding' => '%%order_class%%',
                'important' => 'all',
            ],
        ];

        return $advanced_fields;
    }

    public function render($attrs, $content, $render_slug) {
        wp_enqueue_style("dmpro".$this->slug, $this->module_url . 'style.css', [], "1.0.0", 'all');
        $this->apply_css($render_slug);


        $hotspot_image = $this->props['hotspot_image'];
        $use_hotspot_icon = $this->props['use_hotspot_icon'];
        $hotspot_icon = $this->props['hotspot_icon'];

        $hotspot_ripple_effect = $this->props['hotspot_ripple_effect'];
        $hotspot_ripple_effect_color = $this->props['hotspot_ripple_effect_color'];

        $key_uuid = 'key' . wp_rand();

        $color1 = "rgba(0,0,0, .3)";
        $color2 = "rgba(0,0,0, .3)";
        $color3 = "rgba(0,0,0, 0)";
        $color4 = "rgba(0,0,0, .5)";
        $color5 = "rgba(0,0,0, 0)";
        $color6 = "rgba(0,0,0, 0)";
        $color7 = "rgba(0,0,0, 0)";
        $color8 = "rgba(0,0,0, 0)";

        if ($hotspot_ripple_effect_color !== 'undefined') {

            if ($this->beginsWith($hotspot_ripple_effect_color, "#")) {

                $color1 = $this->hex2RGB($hotspot_ripple_effect_color, 0.3);
                $color2 = $this->hex2RGB($hotspot_ripple_effect_color, 0.3);
                $color3 = $this->hex2RGB($hotspot_ripple_effect_color, 0.0);
                $color4 = $this->hex2RGB($hotspot_ripple_effect_color, 0.5);
                $color5 = $this->hex2RGB($hotspot_ripple_effect_color, 0.0);
                $color6 = $this->hex2RGB($hotspot_ripple_effect_color, 0.0);
                $color7 = $this->hex2RGB($hotspot_ripple_effect_color, 0.0);
                $color8 = $this->hex2RGB($hotspot_ripple_effect_color, 0.0);
            } else {

                $rgbaColor = $hotspot_ripple_effect_color;
                $rgba_arr = $this->rgb_split($rgbaColor);

                $red   = isset($rgba_arr[0]) ? $rgba_arr[0] : '';
                $green = isset($rgba_arr[1]) ? $rgba_arr[1] : '';
                $blue  = isset($rgba_arr[2]) ? $rgba_arr[2] : '';

                $color1 = "rgba($red, $green, $blue, .3)";
                $color2 = "rgba($red, $green, $blue, .3)";
                $color3 = "rgba($red, $green, $blue, 0)";
                $color4 = "rgba($red, $green, $blue, .5)";
                $color5 = "rgba($red, $green, $blue, 0)";
                $color6 = "rgba($red, $green, $blue, 0)";
                $color7 = "rgba($red, $green, $blue, 0)";
                $color8 = "rgba($red, $green, $blue, 0)";
            }
        }

        $keyframes = 'on' === $this->props['hotspot_ripple_effect'] ? "<style>@keyframes pulse-$key_uuid {
            0% {box-shadow: 0 0 0 0 $color1, 0 0 0 0 $color2;}
            33% {box-shadow: 0 0 0 15px $color3, 0 0 0 0 $color4;}
            66% {box-shadow: 0 0 0 10px $color5, 0 0 0 10px $color6;}
            100% {box-shadow: 0 0 0 0 $color7, 0 0 0 15px $color8;}
            }</style>" : "";

        $pulse_style = 'on' === $this->props['hotspot_ripple_effect'] ? 'style="animation: pulse-' . $key_uuid . ' 3s linear infinite;"' : '';

        $hotspot_icon = sprintf(
            '
            <span %2$s class="et-pb-icon et-pb-font-icon dmpro-hotspot-icon">
                %1$s
            </span>',
            esc_attr(et_pb_process_font_icon($hotspot_icon)),
            $pulse_style
        );

        $img_alt = $this->props['img_alt'];

        $hotspot_image = sprintf(
            '<img style="animation: pulse-%2$s 3s linear infinite;" src="%1$s" class="dmpro-hotspot-image" alt="%3$s">',
            $hotspot_image,
            $key_uuid,
            $img_alt

        );

        $hotspot_img_icon = $use_hotspot_icon === 'on' ? $hotspot_icon : $hotspot_image;

        $hotspot = sprintf(
            '
            <div class="dmpro-hotspot">
                %1$s
                %2$s
            </div>',
            $hotspot_img_icon,
            $keyframes
        );

        $tooltip_icon = sprintf(
            '
            <div class="dmpro-tooltip-image-icon">
                <span class="et-pb-icon et-pb-font-icon dmpro-tooltip-icon">
                    %1$s
                </span>
            </div>',
            esc_attr(et_pb_process_font_icon($this->props['tooltip_icon']))
        );

        $tooltip_img_alt =  $this->props['tooltip_img_alt'];
        
        $tooltip_image = '';
        if(!empty($this->props['tooltip_img_src'])){
            $tooltip_image = sprintf(
                '
                <div class="dmpro-tooltip-image-icon">
                    <img src="%1$s" class="dmpro-tooltip-image" alt="%2$s">
                </div>',
                $this->props['tooltip_img_src'],
                $tooltip_img_alt
            );
        }
        $tooltip_title_level = $this->props['tooltip_title_level'] ? $this->props['tooltip_title_level'] : 'h2';
        $tooltip_title = $this->props['tooltip_title'] !== '' ? sprintf(
            '
            <%2$s class="dmpro-tooltip-title">
                %1$s
            </%2$s>',
            $this->props['tooltip_title'],
            esc_attr($tooltip_title_level)
        ) : '';

        $tooltip_desc = $this->props['tooltip_desc'] !== '' ? sprintf(
            '
            <div class="dmpro-tooltip-desc">
                %1$s
            </div>',
            $this->props['tooltip_desc']
        ) : '';


        $show_tooltip_button = $this->props['show_tooltip_button'];
        $tooltip_button_text = $this->props['tooltip_button_text'];
        $tooltip_button_link = $this->props['tooltip_button_link'];
        $tooltip_button_rel = $this->props['tooltip_button_rel'];
        $tooltip_button_icon = $this->props['tooltip_button_icon'];
        $tooltip_button_link_target = $this->props['tooltip_button_link_target'];
        $tooltip_button_custom = $this->props['custom_tooltip_button'];

        $tooltip_button = $this->render_button([
            'button_classname' => ["dmpro-tooltip-button"],
            'button_custom'    => $tooltip_button_custom,
            'button_rel' => $tooltip_button_rel,
            'button_text' => $tooltip_button_text,
            'button_url' => $tooltip_button_link,
            'custom_icon' => $tooltip_button_icon,
            'has_wrapper' => false,
            'url_new_window' => $tooltip_button_link_target
        ]);

        $tooltip_img_icon = 'on' === $this->props['use_tooltip_icon'] ? $tooltip_icon : $tooltip_image;

        $tooltip_button = 'on' === $show_tooltip_button ? sprintf('<div class="dmpro-tooltip-button-wrap">%1$s</div>', $tooltip_button) : '';

        $tooltip_shortcode = do_shortcode('[et_pb_section global_module="' . $this->props['library_id'] . '"][/et_pb_section]');

        $tooltip_arrow = 'on' === $this->props['use_tooltip_arrow'] ? 'dmpro-tooltip-arrow dmpro-tooltip-arrow-' . $this->props['tooltip_position'] : '';

        $tooltip_position_class = "dmpro-tooltip-position-{$this->props['tooltip_position']}";

        $tooltip = '';

        if ($this->props['type'] === 'library') :

            $tooltip = sprintf(
                '
                <div class="dmpro-tooltip-wrap %2$s %3$s">
                    %1$s
                </div>',
                $tooltip_shortcode,
                $tooltip_position_class,
                $tooltip_arrow

            );
        else :

            $tooltip = sprintf(
                '
                <div class="dmpro-tooltip-wrap %5$s %6$s">
                    %1$s
                    %2$s
                    %3$s
                    %4$s
                </div>',
                $tooltip_img_icon,
                $tooltip_title,
                $tooltip_desc,
                $tooltip_button,
                $tooltip_position_class,
                $tooltip_arrow
            );
        endif;

        
        $output = sprintf(
            '
            <div class="dmpro-image-hotspot-child">
                %1$s
                %2$s
            </div>',
            $tooltip,
            $hotspot
        );

        return $output;
    }


    public static function get_html_libary($args = [])
    {
        $library_id = isset($args['library_id']) ? $args['library_id'] : '';
        $shortcode = do_shortcode('[et_pb_section global_module="' . $library_id . '"][/et_pb_section]');
        $shortcode .= '<style type="text/css">' . ET_Builder_Element::get_style() . '</style>';

        ET_Builder_Element::clean_internal_modules_styles(false);

        return $shortcode;
    }

    private function hex2RGB($color, $opacity = false)
    {

        if ($color[0] == '#') {
            $color = substr($color, 1);
        }

        if (strlen($color) == 6) {
            $hex = [$color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]];
        } elseif (strlen($color) == 3) {
            $hex = [$color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]];
        }

        $rgb = array_map('hexdec', $hex);

        $output = 'rgba( ' . implode(",", $rgb) . ',' . $opacity . ' )';

        return $output;
    }

    private function rgb_split($color, $alpha = true)
    {

        $pattern = '~^rgba?\((25[0-5]|2[0-4]\d|1\d{2}|\d\d?)\s*,\s*(25[0-5]|2[0-4]\d|1\d{2}|\d\d?)\s*,\s*(25[0-5]|2[0-4]\d|1\d{2}|\d\d?)\s*(?:,\s*([01]\.?\d*?))?\)$~';

        if (!preg_match($pattern, $color, $matches)) {
            return [];
        }

        return array_slice($matches, 1, $alpha ? 4 : 3);
    }

    private function image_hotspot()
    {

        $layouts = [];

        $layouts = [
            '0' => __('Select A Layout', DMPRO_TEXTDOMAIN)
        ];

        $args = [
            'post_type' => 'et_pb_layout',
            'posts_per_page' => -1
        ];

        $query = new WP_Query($args);

        if ($query->have_posts()) :

            while ($query->have_posts()) : $query->the_post();

                $layouts[get_the_ID()] = get_the_title();

            endwhile;

        endif;

        wp_reset_postdata();

        return $layouts;
    }

    private function tooltip_content_align_css($render_slug)
    {

        $tooltip_content_align = $this->props['tooltip_content_align'];

        if ('left' == $tooltip_content_align) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-wrap, %%order_class%% .dmpro-tooltip-button-wrap',
                'declaration' => "text-align: left !important;"
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-image-icon',
                'declaration' => "margin-left: 0 !important; margin-right: auto !important;"
            ]);

        elseif ('center' == $tooltip_content_align) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-wrap, %%order_class%% .dmpro-tooltip-button-wrap',
                'declaration' => "text-align: center !important;"
            ]);


            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-image-icon',
                'declaration' => "margin-left: auto !important; margin-right: auto !important;"
            ]);

        elseif ('right' == $tooltip_content_align) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-wrap, %%order_class%% .dmpro-tooltip-button-wrap',
                'declaration' => "text-align: right !important;"
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-image-icon',
                'declaration' => "margin-right: 0 !important; margin-left: auto !important;"
            ]);

        endif;
    }

    private function image_width_css($render_slug)
    {
        $hotspot_image_width = $this->get_responsive_prop('hotspot_image_width');

        ET_Builder_Element::set_style($render_slug, array(
            'selector' => "%%order_class%% .dmpro-hotspot .dmpro-hotspot-image ",
            'declaration' => sprintf('width: %1$s !important;', $hotspot_image_width['desktop']),
        ));

        ET_Builder_Element::set_style($render_slug, array(
            'selector' => "%%order_class%% .dmpro-hotspot .dmpro-hotspot-image",
            'declaration' => sprintf('width: %1$s !important;', $hotspot_image_width['tablet']),
            'media_query' => ET_Builder_Element::get_media_query('max_width_980')
        ));

        ET_Builder_Element::set_style($render_slug, array(
            'selector' => "%%order_class%% .dmpro-hotspot .dmpro-hotspot-image",
            'declaration' => sprintf('width: %1$s !important;', $hotspot_image_width['phone']),
            'media_query' => ET_Builder_Element::get_media_query('max_width_767')
        ));



        $tooltip_image_width = $this->get_responsive_prop('tooltip_image_width');

        ET_Builder_Element::set_style($render_slug, array(
            'selector' => "%%order_class%% .dmpro-tooltip-image-icon img",
            'declaration' => sprintf('width: %1$s !important;', $tooltip_image_width['desktop']),
        ));

        ET_Builder_Element::set_style($render_slug, array(
            'selector' => "%%order_class%% .dmpro-tooltip-image-icon img",
            'declaration' => sprintf('width: %1$s !important;', $tooltip_image_width['tablet']),
            'media_query' => ET_Builder_Element::get_media_query('max_width_980')
        ));

        ET_Builder_Element::set_style($render_slug, array(
            'selector' => "%%order_class%% .dmpro-tooltip-image-icon img",
            'declaration' => sprintf('width: %1$s !important;', $tooltip_image_width['phone']),
            'media_query' => ET_Builder_Element::get_media_query('max_width_767')
        ));
    }

    private function hotspot_icon_css($render_slug)
    {
        $hotspot_icon_color = $this->get_responsive_prop('hotspot_icon_color');
        $hotspot_icon_color_hover = $this->get_hover_value('hotspot_icon_color');

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-hotspot-icon',
            'declaration' => "color: {$hotspot_icon_color['desktop']} !important;"
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-hotspot-icon',
            'declaration' => "color: {$hotspot_icon_color['tablet']} !important;",
            'media_query' => ET_Builder_Element::get_media_query('max_width_980')
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-hotspot-icon',
            'declaration' => "color: {$hotspot_icon_color['phone']} !important;",
            'media_query' => ET_Builder_Element::get_media_query('max_width_767')
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-hotspot-icon:hover',
            'declaration' => "color: {$hotspot_icon_color_hover} !important;"
        ]);

        $hotspot_circle_icon = $this->props['hotspot_circle_icon'];
        $hotspot_circle_color = $this->props['hotspot_circle_color'];
        $hotspot_circle_color_hover = $this->get_hover_value('hotspot_circle_color');

        if ('on' === $hotspot_circle_icon) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-hotspot-icon',
                'declaration' => "padding: 15px; border-radius: 100%; background-color: {$hotspot_circle_color};"
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-hotspot-icon:hover',
                'declaration' => "background-color: {$hotspot_circle_color_hover};"
            ]);

        endif;

        $hotspot_circle_border = $this->props['hotspot_circle_border'];
        $hotspot_circle_border_color = $this->props['hotspot_circle_border_color'];
        $hotspot_circle_border_color_hover = $this->get_hover_value('hotspot_circle_border_color');

        if ('on' === $hotspot_circle_border) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-hotspot-icon',
                'declaration' => "border: 3px solid {$hotspot_circle_border_color};"
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-hotspot-icon:hover',
                'declaration' => "border-color: {$hotspot_circle_border_color_hover};"
            ]);

        endif;

        $use_hotspot_icon_font_size = $this->props['use_hotspot_icon_font_size'];

        $hotspot_icon_size = $this->get_responsive_prop('hotspot_icon_size');
        $hotspot_icon_size_hover = $this->get_hover_value('hotspot_icon_size');

        if ('on' === $use_hotspot_icon_font_size) :
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-hotspot-icon',
                'declaration' => "font-size: {$hotspot_icon_size['desktop']};"
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-hotspot-icon',
                'declaration' => "font-size: {$hotspot_icon_size['tablet']};",
                'media_query' => ET_Builder_Element::get_media_query('max_width_980')
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-hotspot-icon',
                'declaration' => "font-size: {$hotspot_icon_size['phone']};",
                'media_query' => ET_Builder_Element::get_media_query('max_width_980')
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-hotspot:hover .dmpro-hotspot-icon',
                'declaration' => "font-size: {$hotspot_icon_size_hover} !important;"
            ]);
        endif;
    }

    private function tooltip_icon_css($render_slug)
    {

        $tooltip_icon_color = $this->props['tooltip_icon_color'];
        $tooltip_icon_color_hover = $this->get_hover_value('tooltip_icon_color');

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-tooltip-icon',
            'declaration' => "color: {$tooltip_icon_color} !important;"
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-tooltip-icon:hover',
            'declaration' => "color: {$tooltip_icon_color_hover} !important;"
        ]);

        $use_tooltip_icon_circle = $this->props['use_tooltip_icon_circle'];
        $tooltip_icon_circle_color = $this->props['tooltip_icon_circle_color'];
        $tooltip_icon_circle_color_hover = $this->get_hover_value('tooltip_icon_circle_color');

        if ('on' == $use_tooltip_icon_circle) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-icon',
                'declaration' => "padding: 25px; border-radius: 100%; background-color: {$tooltip_icon_circle_color} !important;"
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-icon:hover',
                'declaration' => "background-color: {$tooltip_icon_circle_color_hover} !important;"
            ]);

        endif;

        $use_tooltip_icon_circle_border = $this->props['use_tooltip_icon_circle_border'];
        $tooltip_icon_circle_border_color = $this->props['tooltip_icon_circle_border_color'];
        $tooltip_icon_circle_border_color_hover = $this->get_hover_value('tooltip_icon_circle_border_color');

        if ('on' === $use_tooltip_icon_circle_border) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-icon',
                'declaration' => "border: 3px solid {$tooltip_icon_circle_border_color};"
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-icon:hover',
                'declaration' => "border-color: {$tooltip_icon_circle_border_color_hover};"
            ]);

        endif;

        $use_tooltip_icon_font_size  = $this->props['use_tooltip_icon_font_size'];
        $tooltip_icon_font_size = $this->props['tooltip_icon_font_size'];
        $tooltip_icon_font_size_hover = $this->get_hover_value('tooltip_icon_font_size');

        if ('on' == $use_tooltip_icon_font_size) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-icon',
                'declaration' => "font-size: {$tooltip_icon_font_size} !important;"
            ]);

            if ('' === $tooltip_icon_font_size_hover) :

                ET_Builder_Element::set_style($render_slug, [
                    'selector' => '%%order_class%% .dmpro-tooltip-icon:hover',
                    'declaration' => "font-size: {$tooltip_icon_font_size_hover} !important;"
                ]);

            endif;

        endif;
    }

    private function tooltip_padding_css($render_slug)
    {

        if (!isset($this->props['tooltip_padding']) || '' === $this->props['tooltip_padding']) {
            return;
        }

        $tooltip_padding = $this->get_responsive_prop('tooltip_padding');
        $tooltip_padding_desktop = explode('|', $tooltip_padding['desktop']);
        $tooltip_padding_tablet = explode('|', $tooltip_padding['tablet']);
        $tooltip_padding_phone = explode('|', $tooltip_padding['phone']);

        ET_Builder_Element::set_style($render_slug, array(
            'selector' => "%%order_class%% .dmpro-tooltip-wrap",
            'declaration' => sprintf(
                'padding-top: %1$s !important; 
                padding-right:%2$s !important; 
                padding-bottom:%3$s !important; 
                padding-left:%4$s !important;',
                $tooltip_padding_desktop[0],
                $tooltip_padding_desktop[1],
                $tooltip_padding_desktop[2],
                $tooltip_padding_desktop[3]
            ),
        ));

        ET_Builder_Element::set_style($render_slug, array(
            'selector' => "%%order_class%% .dmpro-tooltip-wrap",
            'declaration' => sprintf(
                'padding-top: %1$s !important; 
                padding-right:%2$s !important; 
                padding-bottom:%3$s !important; 
                padding-left:%4$s !important;',
                $tooltip_padding_tablet[0],
                $tooltip_padding_tablet[1],
                $tooltip_padding_tablet[2],
                $tooltip_padding_tablet[3]
            ),
            'media_query' => ET_Builder_Element::get_media_query('max_width_980')
        ));

        ET_Builder_Element::set_style($render_slug, array(
            'selector' => "%%order_class%% .dmpro-tooltip-wrap",
            'declaration' => sprintf(
                '
                padding-top: %1$s !important;
                padding-right:%2$s !important; 
                padding-bottom:%3$s !important; 
                padding-left:%4$s !important;
                ',
                $tooltip_padding_phone[0],
                $tooltip_padding_phone[1],
                $tooltip_padding_phone[2],
                $tooltip_padding_phone[3]
            ),

            'media_query' => ET_Builder_Element::get_media_query('max_width_767')
        ));
    }

    private function tooltip_arrow_css($render_slug)
    {

        $arrow_color = $this->props['arrow_color'];
        $border_width_all_tooltip_box =  $this->props['border_width_all_tooltip_box'];

        if ('left' === $this->props['tooltip_position']) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-arrow::before',
                'declaration' => "border-left-color: {$arrow_color} !important;"
            ]);
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-arrow::before',
                'declaration' => "right: -{$border_width_all_tooltip_box} !important;"
            ]);

        elseif ('right' === $this->props['tooltip_position']) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-arrow::before',
                'declaration' => "border-right-color: {$arrow_color} !important;"
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-arrow::before',
                'declaration' => "left: -{$border_width_all_tooltip_box} !important;"
            ]);

        elseif ('top' === $this->props['tooltip_position']) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-arrow::before',
                'declaration' => "border-top-color: {$arrow_color} !important;"
            ]);
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-arrow::before',
                'declaration' => "bottom: -{$border_width_all_tooltip_box} !important;"
            ]);

        elseif ('bottom' === $this->props['tooltip_position']) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-arrow::before',
                'declaration' => "border-bottom-color: {$arrow_color} !important;"
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-tooltip-arrow::before',
                'declaration' => "top: -{$border_width_all_tooltip_box} !important;"
            ]);

        endif;
    }

    private function tooltip_width_css($render_slug)
    {

        if (!isset($this->props['tooltip_width']) || '' === $this->props['tooltip_width']) {
            return;
        }

        $tooltip_width = $this->get_responsive_prop('tooltip_width');
        
        ET_Builder_Element::set_style($render_slug, array(
            'selector' => "%%order_class%% .dmpro-tooltip-wrap",
            'declaration' => sprintf('width: %1$s !important;', $tooltip_width['desktop']),
        ));

        ET_Builder_Element::set_style($render_slug, array(
            'selector' => "%%order_class%% .dmpro-tooltip-wrap",
            'declaration' => sprintf('width: %1$s !important;', $tooltip_width['tablet']),
            'media_query' => ET_Builder_Element::get_media_query('max_width_980')
        ));

        ET_Builder_Element::set_style($render_slug, array(
            'selector' => "%%order_class%% .dmpro-tooltip-wrap",
            'declaration' => sprintf('width: %1$s !important;', $tooltip_width['phone']),
            'media_query' => ET_Builder_Element::get_media_query('max_width_767')
        ));
    }

    private function apply_css($render_slug)
    {
        $this->image_width_css($render_slug);
        $this->tooltip_width_css($render_slug);
        $this->tooltip_content_align_css($render_slug);
        $this->hotspot_icon_css($render_slug);
        $this->tooltip_icon_css($render_slug);
        $this->tooltip_padding_css($render_slug);
        $this->tooltip_arrow_css($render_slug);

        $hotspot_position_vertical = $this->props['hotspot_position_vertical'];
        $hotspot_position_horizontal = $this->props['hotspot_position_horizontal'];
        $tooltip_bg = $this->props['tooltip_bg'];

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%%',
            'declaration' => "top: {$hotspot_position_vertical};"
        ]);
        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-tooltip-wrap.dmpro-tooltip-wrap',
            'declaration' => "top: {$hotspot_position_vertical};",
            'media_query' => ET_Builder_Element::get_media_query('max_width_767')
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%%',
            'declaration' => "left: {$hotspot_position_horizontal};"
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-tooltip-wrap',
            'declaration' => "background-color: {$tooltip_bg} !important;"
        ]);
    }

    protected function get_responsive_prop($property, $default = '', $default_if_empty = true)
    {
        $responsive_prop = [];
        $responsive_enabled = isset($this->props["{$property}_last_edited"]) ? et_pb_get_responsive_status($this->props["{$property}_last_edited"]) : false;
        if (!isset($this->props[$property]) || ($default_if_empty && '' === $this->props[$property])) {
            $responsive_prop["desktop"] = $default;
        } else {
            $responsive_prop["desktop"] = $this->props[$property];
        }

        if (!$responsive_enabled || !isset($this->props["{$property}_tablet"]) || '' === $this->props["{$property}_tablet"]) {
            $responsive_prop["tablet"] = $responsive_prop["desktop"];
        } else {
            $responsive_prop["tablet"] = $this->props["{$property}_tablet"];
        }

        if (!$responsive_enabled || !isset($this->props["{$property}_phone"]) || '' === $this->props["{$property}_phone"]) {
            $responsive_prop["phone"] = $responsive_prop["tablet"];
        } else {
            $responsive_prop["phone"] = $this->props["{$property}_phone"];
        }

        return $responsive_prop;
    }
    
    protected function beginsWith($string, $startString)
    {

        $length = strlen($startString);
        return (substr($string, 0, $length) === $startString);
    }

}
new DMPRO_HotSpot_Child;