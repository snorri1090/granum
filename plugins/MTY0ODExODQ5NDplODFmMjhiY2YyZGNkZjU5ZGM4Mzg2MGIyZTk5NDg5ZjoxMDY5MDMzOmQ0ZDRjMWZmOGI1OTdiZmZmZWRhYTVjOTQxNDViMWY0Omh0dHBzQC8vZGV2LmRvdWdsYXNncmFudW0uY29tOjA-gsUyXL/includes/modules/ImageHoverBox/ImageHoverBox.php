<?php

class DMPRO_ImageHoverBox extends ET_Builder_Module
{

    protected $module_credits = array(
        'module_uri' => DMPRO_MODULE . 'hover-box',
        'author' => DMPRO_AUTHOR,
        'author_uri' => DMPRO_WEB,
    );

    public function init()
    {
        $this->slug = 'dmpro_hover_box';
        $this->icon_path = plugin_dir_path(__FILE__) . "HoverBox.svg";
        $this->vb_support = 'on';
        $this->name = esc_html__(DMPRO_PREFIX . 'Hover Box', 'dmpro-divi-modules-pro');
        $this->settings_modal_toggles = [
            'general' => [
                'toggles' => [

                    'box_text' => [
                        'sub_toggles' => [
                            'default' => [
                                'name' => 'Default',
                            ],
                            'hover' => [
                                'name' => 'Hover',
                            ],
                        ],
                        'tabbed_subtoggles' => true,
                        'title' => esc_html__('Hover Box Text', 'dmpro-divi-modules-pro'),
                        'priority' => 1,
                    ],
                    'settings' => esc_html__('Hover Box Settings', 'dmpro-divi-modules-pro'),
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'box_background' => [
                        'sub_toggles' => [
                            'default' => [
                                'name' => 'Default',
                            ],
                            'hover' => [
                                'name' => 'Hover',
                            ],
                        ],
                        'tabbed_subtoggles' => true,
                        'title' => esc_html__('Box Background', 'dmpro-divi-modules-pro'),
                        'priority' => 1,
                    ],
                    'box_icon_image' => [
                        'sub_toggles' => [
                            'default' => [
                                'name' => 'Default',
                            ],
                            'hover' => [
                                'name' => 'Hover',
                            ],
                        ],
                        'tabbed_subtoggles' => true,
                        'title' => esc_html__('Box Icon & Image', 'dmpro-divi-modules-pro'),
                        'priority' => 2,
                    ],
                    'content_text' => [
                        'sub_toggles' => [
                            'title' => [
                                'name' => 'Title',
                            ],
                            'desc' => [
                                'name' => 'Description',
                            ],
                        ],
                        'tabbed_subtoggles' => true,
                        'title' => esc_html__('Default Text', 'dmpro-divi-modules-pro'),
                        'priority' => 49,
                    ],
                    'content_hover_text' => [
                        'sub_toggles' => [
                            'title' => [
                                'name' => 'Title',
                            ],
                            'desc' => [
                                'name' => 'Description',
                            ],
                        ],
                        'tabbed_subtoggles' => true,
                        'title' => esc_html__('Hover Text', 'dmpro-divi-modules-pro'),
                        'priority' => 49,
                    ],
                ],
            ],
        ];
    }

    public function get_fields() {
        $fields = [];

        $fields['content_title'] = [
            'label' => esc_html__('Default Box Title', 'dmpro-divi-modules-pro'),
            'type' => 'text',
            'toggle_slug' => 'box_text',
            'sub_toggle'   => 'default'
        ];

        $fields['use_content_icon'] = [
            'label' => esc_html__('Enable Icon for Default Box', 'dmpro-divi-modules-pro'),
            'type' => 'yes_no_button',
            'options' => [
                'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
                'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
            ],
            'default' => 'off',
            'toggle_slug' => 'box_text',
            'sub_toggle'   => 'default'
        ];

        $fields["content_image"] = [
            'label' => esc_html__('Image', 'dmpro-divi-modules-pro'),
            'type' => 'upload',
            'option_category' => 'basic_option',
            'upload_button_text' => esc_attr__('Upload an image', 'dmpro-divi-modules-pro'),
            'choose_text' => esc_attr__('Choose an Image', 'dmpro-divi-modules-pro'),
            'update_text' => esc_attr__('Set As Image', 'dmpro-divi-modules-pro'),
            'hide_metadata' => true,
            'show_if' => ['use_content_icon' => 'off'],
            'toggle_slug' => 'box_text',
            'sub_toggle'   => 'default',
            'dynamic_content' => 'image',
        ];

        $fields["content_image_alt"] = [
            'label' => esc_html__('Image Alt', 'dmpro-divi-modules-pro'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'show_if' => ['use_content_icon' => 'off'],
            'toggle_slug' => 'box_text',
            'sub_toggle'   => 'default'
        ];

        $fields["content_image_alt"] = [
            'label' => esc_html__('Image Alt Text', 'dmpro-divi-modules-pro'),
            'type' => 'text',
            'description' => esc_html__('Define the HTML ALT text for your image here.', 'dmpro-divi-modules-pro'),
            'show_if' => ['use_content_icon' => 'off'],
            'toggle_slug' => 'box_text',
            'sub_toggle'   => 'default'
        ];

        $fields["content_image_width"] = [
            'label' => esc_html__('Content Image Width', 'dmpro-divi-modules-pro'),
            'type' => 'range',
            'validate_unit' => true,
            'default' => '100%',
            'default_unit' => '%',
            'show_if' => ['use_content_icon' => 'off'],
            'range_settings' => [
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'width',
        ];

        $fields['content_icon'] = [
            'label' => esc_html__('Content Icon', 'dmpro-divi-modules-pro'),
            'type' => 'select_icon',
            'default' => '5',
            'show_if' => ['use_content_icon' => 'on'],
            'toggle_slug' => 'box_text',
            'sub_toggle'   => 'default'
        ];

        $fields["content_icon_color"] = [
            'label' => esc_html__('Icon Color', 'dmpro-divi-modules-pro'),
            'type' => 'color-alpha',
            'default' => '#7EBEC5',
            'show_if' => ['use_content_icon' => 'on'],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_icon_image',
            'sub_toggle'  => 'default',
        ];

        $fields["content_circle_icon"] = [
            'label' => esc_html__('Circle Icon', 'dmpro-divi-modules-pro'),
            'type' => 'yes_no_button',
            'option_category' => 'configuration',
            'default' => 'off',
            'options' => array(
                'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
                'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
            ),
            'show_if' => ['use_content_icon' => 'on'],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_icon_image',
            'sub_toggle'  => 'default',
        ];

        $fields["content_circle_color"] = [
            'label' => esc_html__('Circle Color', 'dmpro-divi-modules-pro'),
            'type' => 'color-alpha',
            'custom_color' => true,
            'show_if' => array(
                'content_circle_icon' => 'on',
            ),
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_icon_image',
            'sub_toggle'  => 'default',
        ];

        $fields["content_circle_border"] = [
            'label' => esc_html__('Show Circle Border', 'dmpro-divi-modules-pro'),
            'type' => 'yes_no_button',
            'option_category' => 'configuration',
            'default' => 'off',
            'options' => [
                'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
                'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
            ],
            'show_if' => ['content_circle_icon' => 'on'],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_icon_image',
            'sub_toggle'  => 'default',
        ];

        $fields["content_circle_border_color"] = [
            'label' => esc_html__('Circle Border Color', 'dmpro-divi-modules-pro'),
            'type' => 'color-alpha',
            'custom_color' => true,
            'show_if' => [
                'content_circle_border' => 'on',
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_icon_image',
            'sub_toggle'  => 'default',
        ];

        $fields["content_icon_size"] = [
            'label' => esc_html__('Icon Font Size', 'dmpro-divi-modules-pro'),
            'type' => 'range',
            'validate_unit' => true,
            'default' => '40px',
            'default_unit' => 'px',
            'range_settings' => array(
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ),
            'show_if' => ['use_content_icon' => 'on'],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_icon_image',
            'sub_toggle'  => 'default',
        ];

        $fields['body_text'] = [
            'label' => esc_html__('Body Text', 'dmpro-divi-modules-pro'),
            'type' => 'tiny_mce',
            'toggle_slug' => 'box_text',
            'sub_toggle'   => 'default'
        ];

  
        $fields['content_hover_title'] = [
            'label' => esc_html__('Hover Box Title', 'dmpro-divi-modules-pro'),
            'type' => 'text',
            'toggle_slug' => 'box_text',
            'sub_toggle'  => 'hover',
        ];

        $fields['use_content_hover_icon'] = [
            'label' => esc_html__('Enable Icon for Hover Box', 'dmpro-divi-modules-pro'),
            'type' => 'yes_no_button',
            'options' => [
                'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
                'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
            ],
            'default' => 'off',
            'toggle_slug' => 'box_text',
            'sub_toggle'  => 'hover',
        ];

        $fields["content_hover_image"] = [
            'label' => esc_html__('Image', 'dmpro-divi-modules-pro'),
            'type' => 'upload',
            'upload_button_text' => esc_attr__('Upload an image', 'dmpro-divi-modules-pro'),
            'choose_text' => esc_attr__('Choose an Image', 'dmpro-divi-modules-pro'),
            'update_text' => esc_attr__('Set As Image', 'dmpro-divi-modules-pro'),
            'description' => esc_html__('Upload an image to display as before image', 'dmpro-divi-modules-pro'),
            'hide_metadata' => true,
            'show_if' => ['use_content_hover_icon' => 'off'],
            'toggle_slug' => 'box_text',
            'sub_toggle'  => 'hover',
            'dynamic_content' => 'image',
        ];

        $fields["content_hover_image_alt"] = [
            'label' => esc_html__('Image Alt Text', 'dmpro-divi-modules-pro'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'description' => esc_html__('Define the HTML ALT text for your image here.', 'dmpro-divi-modules-pro'),
            'show_if' => ['use_content_hover_icon' => 'off'],
            'toggle_slug' => 'box_text',
            'sub_toggle'  => 'hover',
            'dynamic_content' => 'text',
        ];

        $fields["content_hover_image_width"] = [
            'label' => esc_html__('Hover Image Width', 'dmpro-divi-modules-pro'),
            'type' => 'range',
            'validate_unit' => true,
            'default' => '100%',
            'default_unit' => '%',
            'show_if' => ['use_content_hover_icon' => 'off'],
            'range_settings' => [
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'width',
        ];

        $fields['content_hover_icon'] = [
            'label' => esc_html__('Hover Icon', 'dmpro-divi-modules-pro'),
            'type' => 'select_icon',
            'default' => '5',
            'show_if' => ['use_content_hover_icon' => 'on'],
            'toggle_slug' => 'box_text',
            'sub_toggle'  => 'hover',
        ];

        $fields["content_hover_icon_color"] = [
            'label' => esc_html__('Icon Color', 'dmpro-divi-modules-pro'),
            'type' => 'color-alpha',
            'default' => '#7EBEC5',
            'show_if' => ['use_content_hover_icon' => 'on'],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_icon_image',
            'sub_toggle'  => 'hover',
        ];

        $fields["content_hover_circle_icon"] = [
            'label' => esc_html__('Circle Icon', 'dmpro-divi-modules-pro'),
            'type' => 'yes_no_button',
            'default' => 'off',
            'options' => array(
                'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
                'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
            ),
            'show_if' => ['use_content_hover_icon' => 'on'],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_icon_image',
            'sub_toggle'  => 'hover',
        ];

        $fields["content_hover_circle_color"] = [
            'label' => esc_html__('Circle Color', 'dmpro-divi-modules-pro'),
            'type' => 'color-alpha',
            'custom_color' => true,
            'show_if' => array(
                'content_hover_circle_icon' => 'on',
            ),
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_icon_image',
            'sub_toggle'  => 'hover',
        ];

        $fields["content_hover_circle_border"] = [
            'label' => esc_html__('Show Circle Border', 'dmpro-divi-modules-pro'),
            'type' => 'yes_no_button',
            'default' => 'off',
            'options' => [
                'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
                'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
            ],
            'show_if' => ['use_content_hover_icon' => 'on'],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_icon_image',
            'sub_toggle'  => 'hover',
        ];

        $fields["content_hover_circle_border_color"] = [
            'label' => esc_html__('Circle Border Color', 'dmpro-divi-modules-pro'),
            'type' => 'color-alpha',
            'custom_color' => true,
            'show_if' => [
                'content_hover_circle_border' => 'on',
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_icon_image',
            'sub_toggle'  => 'hover',
        ];

        $fields["content_hover_icon_size"] = [
            'label' => esc_html__('Icon Font Size', 'dmpro-divi-modules-pro'),
            'type' => 'range',
            'validate_unit' => true,
            'default' => '40px',
            'default_unit' => 'px',
            'range_settings' => array(
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ),
            'show_if' => ['use_content_hover_icon' => 'on'],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_icon_image',
            'sub_toggle'  => 'hover',
        ];

        $fields['content_hover_content'] = [
            'label' => esc_html__('Body Text', 'dmpro-divi-modules-pro'),
            'type' => 'tiny_mce',
            'toggle_slug' => 'box_text',
            'sub_toggle'  => 'hover',
        ];

        $fields['use_content_hover_button'] = [
            'label' => esc_html__('Enable Button for Hover Box', 'dmpro-divi-modules-pro'),
            'type' => 'yes_no_button',
            'default' => 'off',
            'options' => [
                'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
                'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
            ],
            'toggle_slug' => 'box_text',
            'sub_toggle'  => 'hover',
        ];

        $fields["content_hover_button_text"] = [
            'label' => esc_html__('Button Text', 'dmpro-divi-modules-pro'),
            'type' => 'text',
            'default' => esc_html__('Click Here', 'dmpro-divi-modules-pro'),
            'show_if' => ['use_content_hover_button' => 'on'],
            'toggle_slug' => 'box_text',
            'sub_toggle'  => 'hover',
        ];

        $fields["content_hover_button_link"] = [
            'label' => esc_html__('Button Link', 'dmpro-divi-modules-pro'),
            'type' => 'text',
            'default' => '#',
            'show_if' => ['use_content_hover_button' => 'on'],
            'toggle_slug' => 'box_text',
            'sub_toggle'  => 'hover',
        ];

        $fields["content_hover_button_link_target"] = [
            'label' => esc_html__('Button Link Target', 'dmpro-divi-modules-pro'),
            'type' => 'select',
            'option_category' => 'layout',
            'default' => 'same_window',
            'default_on_child' => true,
            'options' => [
                'off' => esc_html__('Same Window', 'dmpro-divi-modules-pro'),
                'on' => esc_html__('New Window', 'dmpro-divi-modules-pro'),
            ],
            'show_if' => ['use_content_hover_button' => 'on'],
            'toggle_slug' => 'box_text',
            'sub_toggle'  => 'hover',
        ];

        $fields["hover_type"] = [
            'label' => esc_html__('Hover Animation', 'dmpro-divi-modules-pro'),
            'type' => 'select',
            'toggle_slug' => 'settings',
            'default' => 'slide',
            'options' => [
                'slide' => esc_html__('Slide', 'dmpro-divi-modules-pro'),
                'fade' => esc_html__('Fade', 'dmpro-divi-modules-pro'),
                'zoom' => esc_html__('Zoom', 'dmpro-divi-modules-pro'),
            ],
        ];

        $fields["hover_direction"] = [
            'label' => esc_html__('Slide Direction', 'dmpro-divi-modules-pro'),
            'type' => 'select',
            'toggle_slug' => 'settings',
            'default' => 'top',
            'options' => [
                'top' => esc_html__('Bottom to Top', 'dmpro-divi-modules-pro'),
                'bottom' => esc_html__('Top to Bottom', 'dmpro-divi-modules-pro'),
                'left' => esc_html__('Left to Right', 'dmpro-divi-modules-pro'),
                'right' => esc_html__('Right to Left', 'dmpro-divi-modules-pro'),
            ],
            'show_if_not' => [
                'hover_type' => ['zoom', 'fade'],
            ],
        ];

        $fields["animation_speed"] = [
            'label' => esc_html__('Animation Speed', 'dmpro-divi-modules-pro'),
            'type' => 'range',
            'option_category' => 'basic_option',
            'default' => '600ms',
            'fixed_unit' => 'ms',
            'range_settings' => [
                'min' => 100,
                'max' => 3000,
                'step' => 100,
            ],
            'toggle_slug' => 'settings',
        ];

        $fields["hover_box_align_front"] = [
            'label' => esc_html__('Content Align', 'dmpro-divi-modules-pro'),
            'type' => 'select',
            'default' => 'center',
            'toggle_slug' => 'settings',
            'options' => [
                'top_left' => esc_html__('Top Left', 'dmpro-divi-modules-pro'),
                'top' => esc_html__('Center Top', 'dmpro-divi-modules-pro'),
                'top_right' => esc_html__('Top Right', 'dmpro-divi-modules-pro'),
                'left' => esc_html__('Left', 'dmpro-divi-modules-pro'),
                'center' => esc_html__('Center', 'dmpro-divi-modules-pro'),
                'right' => esc_html__('Right', 'dmpro-divi-modules-pro'),
                'bottom_left' => esc_html__('Bottom Left', 'dmpro-divi-modules-pro'),
                'bottom' => esc_html__('Center Bottom', 'dmpro-divi-modules-pro'),
                'bottom_right' => esc_html__('Bottom Right', 'dmpro-divi-modules-pro'),
            ],
        ];

        $fields["hover_box_align_back"] = [
            'label' => esc_html__('Hover Content Align', 'dmpro-divi-modules-pro'),
            'type' => 'select',
            'default' => 'center',
            'toggle_slug' => 'settings',
            'options' => [
                'top_left' => esc_html__('Top Left', 'dmpro-divi-modules-pro'),
                'top' => esc_html__('Center Top', 'dmpro-divi-modules-pro'),
                'top_right' => esc_html__('Top Right', 'dmpro-divi-modules-pro'),
                'left' => esc_html__('Left', 'dmpro-divi-modules-pro'),
                'center' => esc_html__('Center', 'dmpro-divi-modules-pro'),
                'right' => esc_html__('Right', 'dmpro-divi-modules-pro'),
                'bottom_left' => esc_html__('Bottom Left', 'dmpro-divi-modules-pro'),
                'bottom' => esc_html__('Center Bottom', 'dmpro-divi-modules-pro'),
                'bottom_right' => esc_html__('Bottom Right', 'dmpro-divi-modules-pro'),
            ],
        ];

        $fields['use_force_square'] = [
            'label' => esc_html__('Enable Square Hover Box', 'dmpro-divi-modules-pro'),
            'description' => esc_html__('When enabeld, the module will always be a perfect square. The height will automatically be set to the width of the module.', 'dmpro-divi-modules-pro'),
            'type' => 'yes_no_button',
            'default' => 'off',
            'options' => [
                'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
                'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
            ],
            'toggle_slug' => 'settings',
        ];

        $fields["box_height"] = [
            'label' => esc_html__('Box Height', 'dmpro-divi-modules-pro'),
            'type' => 'range',
            'option_category' => 'basic_option',
            'default' => '400px',
            'range_settings' => [
                'min' => 1,
                'max' => 1000,
                'step' => 1,
            ],
            'toggle_slug' => 'settings',
            'mobile_options' => true,
            'show_if' => [
                'use_force_square' => 'off',
            ],
        ];

        $additional_options = [];

        $additional_options['content_bg_color'] = [
            'label' => esc_html__('Default Box Background', 'dmpro-divi-modules-pro'),
            'type' => 'background-field',
            'base_name' => "content_bg",
            'context' => "content_bg",
            'option_category' => 'layout',
            'custom_color' => true,
            'default' => ET_Global_Settings::get_value('all_buttons_bg_color'),
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_background',
            'sub_toggle'  => 'default',
            'background_fields' => array_merge(
                ET_Builder_Element::generate_background_options('content_bg', 'gradient', "advanced", "box_background", "content_bg_gradient"),
                ET_Builder_Element::generate_background_options("content_bg", "color", "advanced", "box_background", "content_bg_color"),
                ET_Builder_Element::generate_background_options("content_bg", "image", "advanced", "box_background", "content_bg_image")
            ),
        ];

        $additional_options['content_hover_bg_color'] = [
            'label' => esc_html__('Hover Box Background', 'dmpro-divi-modules-pro'),
            'type' => 'background-field',
            'base_name' => "content_hover_bg",
            'context' => "content_hover_bg",
            'option_category' => 'layout',
            'custom_color' => true,
            'default' => ET_Global_Settings::get_value('all_buttons_bg_color'),
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_background',
            'sub_toggle'  => 'hover',
            'background_fields' => array_merge(
                ET_Builder_Element::generate_background_options('content_hover_bg', 'gradient', "advanced", "box_background", "content_hover_bg_gradient"),
                ET_Builder_Element::generate_background_options("content_hover_bg", "color", "advanced", "box_background", "content_hover_bg_color"),
                ET_Builder_Element::generate_background_options("content_hover_bg", "image", "advanced", "box_background", "content_hover_bg_image")
            ),
        ];

        $additional_options = array_merge($additional_options, $this->generate_background_options("content_bg", 'skip', "advanced", "content_background", "content_bg_gradient"));
        $additional_options = array_merge($additional_options, $this->generate_background_options("content_bg", 'skip', "advanced", "content_background", "content_bg_color"));
        $additional_options = array_merge($additional_options, $this->generate_background_options("content_bg", 'skip', "advanced", "content_background", "content_bg_image"));
        $additional_options = array_merge($additional_options, $this->generate_background_options("content_hover_bg", 'skip', "advanced", "content_hover_background", "content_hover_bg_gradient"));
        $additional_options = array_merge($additional_options, $this->generate_background_options("content_hover_bg", 'skip', "advanced", "content_hover_background", "content_hover_bg_color"));
        $additional_options = array_merge($additional_options, $this->generate_background_options("content_hover_bg", 'skip', "advanced", "content_hover_background", "content_hover_bg_image"));

        return array_merge($fields, $additional_options);
    }

    public function get_advanced_fields_config() {

        $advanced_fields = [];

        $advanced_fields["text"] = false;
        $advanced_fields["text_shadow"] = false;
        $advanced_fields["fonts"] = false;

        $advanced_fields["borders"]["default"] = [
            'css' => [
                'main' => [
                    'border_radii' => "%%order_class%%,
                                       %%order_class%% .dmpro-hover-box-container,
                                       %%order_class%% .dmpro-hover-box-content,
                                       %%order_class%% .dmpro-hover-box-hover",
                    'border_styles' => "%%order_class%% .dmpro-hover-box-container",
                ],
            ],
        ];

        $advanced_fields["fonts"]["content_title"] = [
            'label' => esc_html__('Title', 'dmpro-divi-modules-pro'),
            'css' => [
                'main' => "%%order_class%% .dmpro-hover-box-content .dmpro-hover-box-heading",
            ],
            'important' => 'all',
            'hide_text_align' => true,
            'toggle_slug' => 'content_text',
            'sub_toggle' => 'title',
            'header_level' => [
                'default' => 'h2',
            ],
            'line_height' => [
                'range_settings' => [
                    'min' => '1',
                    'max' => '3',
                    'step' => '0.1',
                ],
            ],
        ];

        $advanced_fields["fonts"]["content_desc"] = [
            'label' => esc_html__('Description', 'dmpro-divi-modules-pro'),
            'css' => [
                'main' => "%%order_class%% .dmpro-hover-box-content .dmpro-desc",
            ],
            'important' => 'all',
            'hide_text_align' => true,
            'toggle_slug' => 'content_text',
            'sub_toggle' => 'desc',
            'line_height' => [
                'range_settings' => [
                    'min' => '1',
                    'max' => '3',
                    'step' => '0.1',
                ],
            ],
        ];

        $advanced_fields["fonts"]["content_hover_title"] = [
            'label' => esc_html__('Title', 'dmpro-divi-modules-pro'),
            'css' => [
                'main' => "%%order_class%% .dmpro-hover-box-hover .dmpro-hover-box-heading",
            ],
            'important' => 'all',
            'hide_text_align' => true,
            'toggle_slug' => 'content_hover_text',
            'sub_toggle' => 'title',
            'header_level' => [
                'default' => 'h2',
            ],
            'line_height' => [
                'range_settings' => [
                    'min' => '1',
                    'max' => '3',
                    'step' => '0.1',
                ],
            ],
        ];

        $advanced_fields["fonts"]["content_hover_desc"] = [
            'label' => esc_html__('Description', 'dmpro-divi-modules-pro'),
            'css' => [
                'main' => "%%order_class%% .dmpro-hover-box-hover .dmpro-desc",
            ],
            'important' => 'all',
            'hide_text_align' => true,
            'toggle_slug' => 'content_hover_text',
            'sub_toggle' => 'desc',
            'line_height' => [
                'range_settings' => [
                    'min' => '1',
                    'max' => '3',
                    'step' => '0.1',
                ],
            ],
        ];

        $advanced_fields["box_shadow"]["default"] = [
            'label' => esc_html__('Box Shadow', 'dmpro-divi-modules-pro'),
            'css' => [
                'main' => "%%order_class%% .dmpro-hover-box-container",
            ],
        ];

        $advanced_fields['margin_padding'] = [
            'css' => [
                'margin' => "%%order_class%% .dmpro-hover-box-content, %%order_class%% .dmpro-hover-box-hover",
                'padding' => "%%order_class%% .dmpro-hover-box-content-innner, %%order_class%% .dmpro-hover-box-hover-innner",
                'important' => 'all',
            ],
        ];

        $advanced_fields['button']["content_hover_button"] = [
            'label' => esc_html__('Hover Button', 'dmpro-divi-modules-pro'),
            'css' => [
                'main' => "%%order_class%% .dmpro-hover-button",
                'important' => 'all',
            ],
            'use_alignment' => false,
            'box_shadow' => [
                'css' => [
                    'main' => "%%order_class%% .dmpro-hover-button",
                    'important' => true,
                ],
            ],
            'borders' => [
                'css' => [
                    'main' => "%%order_class%% .dmpro-hover-button",
                    'important' => true,
                ],
            ],
            'margin_padding' => [
                'css' => [
                    'main' => "%%order_class%% .dmpro-hover-button.et_pb_button",
                    'important' => true,
                ],
            ],
        ];

        $advanced_fields['borders']['content_image'] = [
            'css' => [
                'main' => [
                    'border_radii' => "%%order_class%% .dmpro-hover-box-content .dmpro-image-wrap img",
                    'border_styles' => "%%order_class%% .dmpro-hover-box-content .dmpro-image-wrap img",
                ],
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_icon_image',
            'sub_toggle'  => 'default',
            'depends_on' => ['use_content_icon'],
            'depends_show_if' => 'off',
        ];

        $advanced_fields['box_shadow']['content_image'] = [
            'label' => esc_html__('Content Image Box Shadow', 'dmpro-divi-modules-pro'),
            'option_category' => 'layout',
            'tab_slug' => 'advanced',
            'show_if' => ['use_content_icon' => 'off'],
            'css' => [
                'main' => '%%order_class%% .dmpro-hover-box-content .dmpro-image-wrap img',
                'overlay' => 'inset',
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_icon_image',
            'sub_toggle'  => 'default',
        ];

        $advanced_fields['borders']['content_hover_image'] = [
            'css' => [
                'main' => [
                    'border_radii' => "%%order_class%% .dmpro-hover-box-hover .dmpro-image-wrap img",
                    'border_styles' => "%%order_class%% .dmpro-hover-box-hover .dmpro-image-wrap img",
                ],
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_icon_image',
            'sub_toggle'  => 'hover',
            'depends_on' => ['use_content_hover_icon'],
            'depends_show_if' => 'off',
        ];

        $advanced_fields['box_shadow']['content_hover_icon_image'] = [
            'label' => esc_html__('Hover Image Box Shadow', 'dmpro-divi-modules-pro'),
            'option_category' => 'layout',
            'tab_slug' => 'advanced',
            'show_if' => ['use_content_hover_icon' => 'off'],
            'css' => [
                'main' => '%%order_class%% .dmpro-hover-box-hover .dmpro-image-wrap img',
                'overlay' => 'inset',
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'box_icon_image',
            'sub_toggle'  => 'hover',
        ];

        return $advanced_fields;
    }

    public function get_custom_css_fields_config() {

        $custom_css_fields = [];

        $custom_css_fields['content_card_container'] = [
            'label' => esc_html__('Content Card Container', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-hover-box-content',
        ];

        $custom_css_fields['content_image_icon'] = [
            'label' => esc_html__('Content Image/Icon', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-content-image-icon-wrap',
        ];

        $custom_css_fields['content_title'] = [
            'label' => esc_html__('Default Box Title', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-hover-box-content .dmpro-hover-box-heading',
        ];

        $custom_css_fields['content_description'] = [
            'label' => esc_html__('Content Description', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-hover-box-content .dmpro-desc',
        ];

        $custom_css_fields['content_button'] = [
            'label' => esc_html__('Content Button', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-content-button',
        ];

        $custom_css_fields['content_hover_card_container'] = [
            'label' => esc_html__('Hover Card Container', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-hover-box-hover',
        ];

        $custom_css_fields['content_hover_image_icon'] = [
            'label' => esc_html__('Hover Image/Icon', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-hover-image-icon-wrap',
        ];

        $custom_css_fields['content_hover_title'] = [
            'label' => esc_html__('Hover Box Title', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-hover-box-hover .dmpro-hover-box-heading',
        ];

        $custom_css_fields['content_hover_description'] = [
            'label' => esc_html__('Hover Description', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-hover-box-hover .dmpro-desc',
        ];

        $custom_css_fields['content_hover_button'] = [
            'label' => esc_html__('Hover Button', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-hover-button',
        ];

        return $custom_css_fields;
    }

    public function render($attrs, $content, $render_slug) {
        wp_enqueue_style("dmpro-".$this->slug, plugin_dir_url(__FILE__) . 'style.css', [], DMPRO_VERSION, 'all');
        wp_enqueue_script("dmpro-".$this->slug, plugin_dir_url(__FILE__) . 'custom.js', array('dmpro_resize_sensor_script'), DMPRO_VERSION, true);
        $this->apply_css($render_slug);

        $hover_box_animation = 'dmpro-hover-box-slide-top';
        if ('slide' === $this->props['hover_type']) {
            $hover_box_animation = "dmpro-hover-box-slide-{$this->props['hover_direction']}";
        } else if ('fade' === $this->props['hover_type']) {
            $hover_box_animation = 'dmpro-hover-box-fade';
        } else if ('zoom' === $this->props['hover_type']) {
            $hover_box_animation = 'dmpro-hover-box-zoom';
        }

        $hover_box_align_front_class = sprintf(
            'hover_box_align_front_%1$s',
            $this->props['hover_box_align_front']
        );

        $hover_box_align_back_class = sprintf(
            'hover_box_align_back_%1$s',
            $this->props['hover_box_align_back']
        );

        return sprintf(
            '<div class="dmpro-hover-box-container %3$s %4$s %5$s" data-force_square="%6$s">
                <div class="dmpro-hover-box-inner-wrapper">
                    %1$s
                    %2$s
                </div>
            </div>',
            $this->_render_content(),
            $this->_render_content_hover(),
            $hover_box_animation,
            $hover_box_align_front_class,
            $hover_box_align_back_class,
            $this->props['use_force_square']
        );
    }

    private function apply_css($render_slug)
    {
        $content_icon_color = $this->props['content_icon_color'];
        $content_circle_icon = $this->props['content_circle_icon'];
        $content_circle_color = $this->props['content_circle_color'];
        $content_circle_border = $this->props['content_circle_border'];
        $content_circle_border_color = $this->props['content_circle_border_color'];
        $content_icon_size = $this->props['content_icon_size'];
        $content_image_width = $this->props['content_image_width'];
        $content_hover_icon_color = $this->props['content_hover_icon_color'];
        $content_hover_circle_icon = $this->props['content_hover_circle_icon'];
        $content_hover_circle_color = $this->props['content_hover_circle_color'];
        $content_hover_circle_border = $this->props['content_hover_circle_border'];
        $content_hover_circle_border_color = $this->props['content_hover_circle_border_color'];
        $content_hover_icon_size = $this->props['content_hover_icon_size'];
        $content_hover_image_width = $this->props['content_hover_image_width'];

        if ('on' !== $this->props['use_force_square']) {
            $this->box_height($render_slug);
        }

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-hover-box-content .dmpro-hover-box-content-icon',
            'declaration' => "color: {$content_icon_color} !important;",
        ]);

        if ('on' == $content_circle_icon):
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-hover-box-content .dmpro-content-icon-circle',
                'declaration' => "background-color: {$content_circle_color} !important;",
            ]);
        endif;

        if ('on' == $content_circle_border):
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-hover-box-content .dmpro-content-icon-border',
                'declaration' => "border-color: {$content_circle_border_color} !important;",
            ]);
        endif;

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-hover-box-content .dmpro-hover-box-content-icon',
            'declaration' => "font-size: {$content_icon_size} !important;",
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-hover-box-hover .dmpro-hover-box-hover-icon',
            'declaration' => "color: {$content_hover_icon_color} !important;",
        ]);

        if ('on' == $content_hover_circle_icon):
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-hover-box-hover .dmpro-hover-icon-circle',
                'declaration' => "background-color: {$content_hover_circle_color} !important;",
            ]);
        endif;

        if ('on' == $content_hover_circle_border):
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-hover-box-hover .dmpro-hover-icon-border',
                'declaration' => "border-color: {$content_hover_circle_border_color} !important;",
            ]);
        endif;

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-hover-box-hover .dmpro-hover-box-hover-icon',
            'declaration' => "font-size: {$content_hover_icon_size} !important;",
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-hover-box-content .dmpro-image-wrap',
            'declaration' => "max-width: {$content_image_width} !important;",
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-hover-box-hover .dmpro-image-wrap',
            'declaration' => "max-width: {$content_hover_image_width} !important;",
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-hover-box-container .dmpro-hover-box-content, %%order_class%% .dmpro-hover-box-container .dmpro-hover-box-hover',
            'declaration' => "transition-duration: {$this->props['animation_speed']} !important;",
        ]);

        $this->process_background(".dmpro-hover-box-content", "content_bg", $render_slug);
        $this->process_background(".dmpro-hover-box-hover", "content_hover_bg", $render_slug);
    }

    private function box_height($render_slug)
    {

        $box_height = $this->props['box_height'];
        $box_height_tablet = $this->props['box_height_tablet'] ? $this->props['box_height_tablet'] : $box_height;
        $box_height_phone = $this->props['box_height_phone'] ? $this->props['box_height_phone'] : $box_height_tablet;
        $box_height_last_edited = $this->props['box_height_last_edited'];
        $box_height_responsive_status = et_pb_get_responsive_status($box_height_last_edited);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-hover-box-content, %%order_class%% .dmpro-hover-box-hover, %%order_class%% .dmpro-hover-box-container',
            'declaration' => "height: {$box_height};",
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-hover-box-container, %%order_class%% .dmpro-hover-box-content, %%order_class%% .dmpro-hover-box-hover',
            'declaration' => "min-height: {$box_height};",
        ]);

        if ('' !== $box_height_tablet && $box_height_responsive_status) {
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-hover-box-content, %%order_class%% .dmpro-hover-box-hover, %%order_class%% .dmpro-hover-box-container',
                'declaration' => "height: {$box_height_tablet};",
                'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-hover-box-container, %%order_class%% .dmpro-hover-box-content, %%order_class%% .dmpro-hover-box-hover',
                'declaration' => "min-height: {$box_height_tablet}; ",
                'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
            ]);
        }

        if ('' !== $box_height_phone && $box_height_responsive_status) {
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-hover-box-content, %%order_class%% .dmpro-hover-box-hover, %%order_class%% .dmpro-hover-box-container',
                'declaration' => "height: {$box_height_phone};",
                'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-hover-box-container, %%order_class%% .dmpro-hover-box-content, %%order_class%% .dmpro-hover-box-hover',
                'declaration' => "min-height: {$box_height_phone};",
                'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
            ]);
        }
    }

        public function _render_content()
    {

        $content_icon_image = '';

        if ('on' == $this->props['use_content_icon']) {

            $content_circle_icon_class = ('on' === $this->props['content_circle_icon']) ? ' dmpro-content-icon-circle' : '';
            $content_border_icon_class = ('on' === $this->props['content_circle_border']) ? ' dmpro-content-icon-border' : '';
            $content_icon = et_pb_process_font_icon($this->props['content_icon']);

            $content_icon_image = sprintf(
                '<div class="dmpro-content-image-icon-wrap dmpro-icon-wrap">
                    <span class="et-pb-icon et-pb-font-icon dmpro-hover-box-content-icon%2$s%3$s">%1$s</span>
                </div>',
                esc_attr($content_icon),
                $content_circle_icon_class,
                $content_border_icon_class
            );
        } else if ('on' !== $this->props['use_content_icon'] && $this->props['content_image'] !== '') {
            $content_icon_image = sprintf(
                '<div class="dmpro-content-image-icon-wrap dmpro-image-wrap">
                    <img src="%1$s" alt="%2$s">
                </div>',
                esc_attr($this->props['content_image']),
                $this->_esc_attr('content_image_alt')
            );
        }

        $content_title_level = $this->props['content_title_level'];
        $content_title = '';
        if (isset($this->props['content_title']) && '' !== $this->props['content_title']) {
            $content_title = sprintf(
                '<%2$s class="dmpro-hover-box-heading">
                    %1$s
                </%2$s>',
                esc_attr($this->props['content_title']),
                esc_attr($content_title_level)
            );
        }

        $body_text = '1';
        if (isset($this->props['body_text'])) {
            $body_text = sprintf(
                '<div class="dmpro-desc">%1$s</div>', preg_replace('/^<\/p>(.*)<p>/s', '$1', $this->props['body_text'])
            );
        }

        $content_parallax_bg = '';
        if ('on' == $this->props["content_bg_parallax"]) {
            $content_parallax_bg = $this->parallax_image_bg("content_bg");
        }

        return sprintf(
            '<div class="dmpro-hover-box-content">
              %1$s
              <div class="dmpro-hover-box-content-innner">
                    %2$s
                    <div class="dmpro-text">
                        %3$s
                        %4$s
                    </div>
              </div>
            </div>
            ',
            $content_parallax_bg,
            $content_icon_image,
            $content_title,
            $body_text
        );
    }

  
    public function _render_content_hover()
    {

        $content_hover_icon_image = '';

        if ('on' == $this->props['use_content_hover_icon']) {

            $hover_circle_icon_class = ('on' === $this->props['content_circle_icon']) ? ' dmpro-hover-icon-circle' : '';
            $hover_border_icon_class = ('on' === $this->props['content_circle_border']) ? ' dmpro-hover-icon-border' : '';
            $content_hover_icon = et_pb_process_font_icon($this->props['content_hover_icon']);

            $content_hover_icon_image = sprintf(
                '<div class="dmpro-hover-image-icon-wrap dmpro-icon-wrap">
                    <span class="et-pb-icon et-pb-font-icon dmpro-hover-box-hover-icon %2$s%3$s">
                        %1$s
                    </span>
                </div>',
                esc_attr($content_hover_icon),
                $hover_circle_icon_class,
                $hover_border_icon_class
            );
        } else if ('on' !== $this->props['use_content_hover_icon'] && $this->props['content_hover_image'] !== '') {
            $content_hover_icon_image = sprintf(
                '<div class="dmpro-hover-image-icon-wrap dmpro-image-wrap">
                    <img class="dmpro-hover-box-hover-imge" src="%1$s" alt="%2$s">
                </div>',
                $this->props['content_hover_image'],
                $this->_esc_attr('content_hover_image_alt')
            );
        }

        $content_hover_title_level = $this->props['content_hover_title_level'];
        $content_hover_title = '';
        if (isset($this->props['content_hover_title']) && '' !== $this->props['content_hover_title']) {

            $content_hover_title = sprintf(
                '<%2$s class="dmpro-hover-box-heading">
                    %1$s
                </%2$s>',
                esc_attr($this->props['content_hover_title']),
                esc_attr($content_hover_title_level)

            );
        }

        $content_hover_content = '';

        if (isset($this->props['content_hover_content'])) {
            $content_hover_content = sprintf(
                '<div class="dmpro-desc">
                    %1$s
                </div>',
                preg_replace('/^<\/p>(.*)<p>/s', '$1', $this->props['content_hover_content'])
            );
        }

        $content_hover_button_rel = $this->props['content_hover_button_rel'];
        $use_content_hover_button = $this->props['use_content_hover_button'];
        $content_hover_button_text = $this->props['content_hover_button_text'];
        $content_hover_button_link = $this->props['content_hover_button_link'];
        $content_hover_button_link_target = $this->props['content_hover_button_link_target'];
        $content_hover_button_icon = $this->props['content_hover_button_icon'];
        $content_hover_button_custom = $this->props['custom_content_hover_button'];

        $content_hover_button = 'on' == $use_content_hover_button ? $this->render_button([
            'button_classname' => ["dmpro-hover-button"],
            'button_custom' => $content_hover_button_custom,
            'button_rel' => $content_hover_button_rel,
            'button_text' => $content_hover_button_text,
            'button_url' => $content_hover_button_link,
            'custom_icon' => $content_hover_button_icon,
            'has_wrapper' => false,
            'url_new_window' => $content_hover_button_link_target,
        ]) : '';

        $content_hover_parallax_bg = 'on' == $this->props["content_hover_bg_parallax"] ? $this->parallax_image_bg("content_hover_bg") : '';

        return sprintf(
            '<div class="dmpro-hover-box-hover">
                %1$s
                <div class="dmpro-hover-box-hover-innner">
                    %2$s
                    <div class="dmpro-text">
                        %3$s
                        %4$s
                    </div>
                    %5$s
                </div>
            </div>',
            $content_hover_parallax_bg,
            $content_hover_icon_image,
            $content_hover_title,
            $content_hover_content,
            $content_hover_button
        );
    }

    public function process_background($class_name, $base_name, $render_slug)
    {

        $background_images = [];
        $background_style = '';

        $use_bg_gradient = $this->props["{$base_name}_use_color_gradient"];
        $bg_type = $this->props["{$base_name}_color_gradient_type"];
        $bg_direction = $this->props["{$base_name}_color_gradient_direction"];
        $bg_direction_radial = $this->props["{$base_name}_color_gradient_direction_radial"];
        $bg_start = $this->props["{$base_name}_color_gradient_start"];
        $bg_end = $this->props["{$base_name}_color_gradient_end"];
        $bg_start_position = $this->props["{$base_name}_color_gradient_start_position"];
        $bg_end_position = $this->props["{$base_name}_color_gradient_end_position"];
        $bg_overlays_image = $this->props["{$base_name}_color_gradient_overlays_image"];
        $has_bg_gradient = false;
        $has_bg_image = false;

      
        if ('on' === $use_bg_gradient) {

            $direction = $bg_type === 'linear' ? $bg_direction : "circle at {$bg_direction_radial}";
            $start_position = et_sanitize_input_unit($bg_start_position, false, '%');
            $end_position = et_sanitize_input_unit($bg_end_position, false, '%');
            $gradient_bg = "{$bg_type}-gradient({$direction}, {$bg_start} {$start_position},{$bg_end} {$end_position})";

            if (!empty($gradient_bg)) {
                $background_images[] = $gradient_bg;
            }

            $has_bg_gradient = true;
        }

        $bg_image = $this->props["{$base_name}_image"];
        $parallax = $this->props["{$base_name}_parallax"];
        $is_bg_image_active = '' !== $bg_image && 'on' !== $parallax;

        if ($is_bg_image_active) {

            $has_bg_image = true;

            $bg_size = $this->props["{$base_name}_size"];
            $bg_position = $this->props["{$base_name}_position"];
            $bg_repeat = $this->props["{$base_name}_repeat"];
            $bg_blend = $this->props["{$base_name}_blend"];

            if ('' !== $bg_size) {
                $background_style .= sprintf(
                    'background-size: %1$s !important; ',
                    esc_html($bg_size)
                );
            }

            if ('' !== $bg_position) {
                $background_style .= sprintf(
                    'background-position: %1$s !important; ',
                    esc_html(str_replace('_', ' ', $bg_position))
                );
            }

            if ('' !== $bg_repeat) {
                $background_style .= sprintf(
                    'background-repeat: %1$s !important; ',
                    esc_html($bg_repeat)
                );
            }

            if ('' !== $bg_blend) {
                $background_style .= sprintf(
                    'background-blend-mode: %1$s !important;',
                    esc_html($bg_blend)
                );
            }

            $background_images[] = sprintf('url(%1$s)', esc_html($bg_image));
        }

        if (!empty($background_images)) {
            if ('on' !== $bg_overlays_image) {
                $background_images = array_reverse($background_images);
            }

            $background_style .= sprintf(
                'background-image: %1$s !important;',
                esc_html(join(', ', $background_images))
            );
        }

        if (!$has_bg_gradient || !$has_bg_image) {
            $background_color = $this->props["{$base_name}_color"];
            if ('' !== $background_color) {
                $background_style .= sprintf(
                    'background-color: %1$s !important; ',
                    esc_html($background_color)
                );
            }
        }

        if ('' !== $background_style) {
            ET_Builder_Element::set_style($render_slug, array(
                'selector' => "%%order_class%% {$class_name}",
                'declaration' => rtrim($background_style),
            ));
        }
    }

    public function parallax_image_bg($base_name)
    {

        $bg_image = $this->props["{$base_name}_image"];
        $parallax = $this->props["{$base_name}_parallax"];
        $parallax_method = $this->props["{$base_name}_parallax_method"];
        $parallax_classname = [];

        if ('' !== $bg_image && 'on' === $parallax) {
            $parallax_classname[] = 'et_parallax_bg';
            if ('off' === $parallax_method) {
                $parallax_classname[] = 'et_pb_parallax_css';
            }
        }

        return sprintf(
            '<span class="et_parallax_bg_wrap">
                <span class="%1$s" style="background-image: url(%2$s);"></span>
            </span>',
            esc_attr(implode(' ', $parallax_classname)),
            esc_url($bg_image)
        );
    }
}

new DMPRO_ImageHoverBox;
