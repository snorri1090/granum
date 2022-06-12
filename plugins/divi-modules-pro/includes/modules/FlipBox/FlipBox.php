<?php
class DMPRO_FlipBox extends ET_Builder_Module {
	
	public $module_url = DMPRO_MODULES_URL . 'FlipBox' . '/';

    protected $module_credits = array(
        'module_uri' => DMPRO_MODULE . 'flip-box',
        'author'     => DMPRO_AUTHOR,
        'author_uri' => DMPRO_WEB,
    );

    public function init() {
        $this->slug = 'dmpro_flip_box';
        $this->icon_path = plugin_dir_path( __FILE__ ) . "FlipBox.svg";
        $this->vb_support = 'on';
        $this->name = esc_html__(DMPRO_PREFIX . 'FlipBox', DMPRO_TEXTDOMAIN);
        $this->settings_modal_toggles = [

            'general' => [
                'toggles' => [
                     'flipbox_content' => [
                        'sub_toggles' => [
                            'front_side' => [
                                'name' => 'Front Side',
                            ],
                            'back_side' => [
                                'name' => 'Back Side',
                            ],
                        ],
                        'tabbed_subtoggles' => true,
                        'title' => esc_html__('Flipbox Content', DMPRO_TEXTDOMAIN),
                        'priority' => 1,
                    ],
                    'flipbox_icon_image' => [
                        'sub_toggles' => [
                            'front_side' => [
                                'name' => 'Front Side',
                            ],
                            'back_side' => [
                                'name' => 'Back Side',
                            ],
                        ],
                        'tabbed_subtoggles' => true,
                        'title' => esc_html__('Flipbox Icon & image', DMPRO_TEXTDOMAIN),
                        'priority' => 1,
                    ],
                    'flipbox_button' => [
                        'sub_toggles' => [
                            'front_side' => [
                                'name' => 'Front Side',
                            ],
                            'back_side' => [
                                'name' => 'Back Side',
                            ],
                        ],
                        'tabbed_subtoggles' => true,
                        'title' => esc_html__('Flipbox Button', DMPRO_TEXTDOMAIN),
                        'priority' => 1,
                    ],
                    'flipbox_settings' => esc_html__('Flipbox Settings and Animation', DMPRO_TEXTDOMAIN),
                ],
            ],

            'advanced' => [
                'toggles' => [
                    'flipbox_background' => [
                        'sub_toggles' => [
                            'front_side' => [
                                'name' => 'Front Side',
                            ],
                            'back_side' => [
                                'name' => 'Back Side',
                            ],
                        ],
                        'tabbed_subtoggles' => true,
                        'title' => esc_html__('Flipbox Background', DMPRO_TEXTDOMAIN),
                        'priority' => 49,
                    ],
                    'flipbox_icon_image' => [
                        'sub_toggles' => [
                            'front_side' => [
                                'name' => 'Front Side',
                            ],
                            'back_side' => [
                                'name' => 'Back Side',
                            ],
                        ],
                        'tabbed_subtoggles' => true,
                        'title' => esc_html__('Flipbox Icon & Image', DMPRO_TEXTDOMAIN),
                        'priority' => 49,
                    ],
                    'front_text' => [
                        'sub_toggles' => [
                            'title' => [
                                'name' => 'Title',
                            ],
                            'desc' => [
                                'name' => 'Description',
                            ],
                        ],
                        'tabbed_subtoggles' => true,
                        'title' => esc_html__('Front Text', DMPRO_TEXTDOMAIN),
                        'priority' => 49,
                    ],
                    'back_text' => [
                        'sub_toggles' => [
                            'title' => [
                                'name' => 'Title',
                            ],
                            'desc' => [
                                'name' => 'Description',
                            ],
                        ],
                        'tabbed_subtoggles' => true,
                        'title' => esc_html__('Back Text', DMPRO_TEXTDOMAIN),
                        'priority' => 49,
                    ],
                    'width' => [
                        'title' => esc_html__('Sizing', DMPRO_TEXTDOMAIN),
                        'priority' => 65,
                    ],
                ],
            ],
        ];
    }

    public function get_fields() {

        $module_fields = [];

        $module_fields['front_title'] = [
            'label' => esc_html__('Front Side Title', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'toggle_slug' => 'flipbox_content',
            'sub_toggle' => 'front_side'
        ];

        $module_fields['use_front_icon'] = [
            'label' => esc_html__('Enable Front Side Icon', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'basic_option',
            'options' => [
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('Yes', DMPRO_TEXTDOMAIN),
            ],
            'default' => 'off',
            'affects' => [
                'front_icon_image',
                'front_icon_color',
                'front_circle_icon',
                'front_circle_color',
                'front_circle_border',
                'front_circle_border_color',
                'front_icon_size',
                'front_icon_image',
            ],
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'front_side'
        ];

        $module_fields["front_image"] = [
            'label' => esc_html__('Front Image', DMPRO_TEXTDOMAIN),
            'type' => 'upload',
            'option_category' => 'basic_option',
            'upload_button_text' => esc_attr__('Upload an image', DMPRO_TEXTDOMAIN),
            'choose_text' => esc_attr__('Choose an Image', DMPRO_TEXTDOMAIN),
            'update_text' => esc_attr__('Set As Image', DMPRO_TEXTDOMAIN),
            'hide_metadata' => true,
            'show_if' => ['use_front_icon' => 'off'],
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'front_side',
            'dynamic_content' => 'image',
        ];

        $module_fields["front_image_alt"] = [
            'label'       => esc_html__( 'Image Alt Text', DMPRO_TEXTDOMAIN ),
            'type'        => 'text',
            'description' => esc_html__( 'Define the HTML ALT text for your image here.', DMPRO_TEXTDOMAIN),
            'show_if' => ['use_front_icon' => 'off'],
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'front_side'
        ];

        $module_fields["front_image_width"] = [
            'label' => esc_html__('Front Image Container Width', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'validate_unit' => true,
            'default' => '100%',
            'default_unit' => '%',
            'show_if' => ['use_front_icon' => 'off'],
            'range_settings' => array(
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ),
            'tab_slug' => 'advanced',
            'toggle_slug' => 'width',
        ];

        $module_fields["front_image_width"] = [
            'label' => esc_html__('Front Image Container Width', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'validate_unit' => true,
            'mobile_options' => true,
            'default' => '100%',
            'default_unit' => '%',
            'show_if' => ['use_front_icon' => 'off'],
            'range_settings' => array(
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ),
            'tab_slug' => 'advanced',
            'toggle_slug' => 'width',
        ];

        $module_fields['front_icon'] = [
            'label' => esc_html__('Front Icon', DMPRO_TEXTDOMAIN),
            'type' => 'select_icon',
            'default' => '5',
            'show_if' => ['use_front_icon' => 'on'],
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'front_side'
        ];

        $module_fields["front_icon_color"] = [
            'label' => esc_html__('Icon Color', DMPRO_TEXTDOMAIN),
            'type' => 'color-alpha',
            'default' => '#7EBEC5',
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'front_side'
        ];

        $module_fields["front_circle_icon"] = [
            'label' => esc_html__('Circle Icon', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'configuration',
            'default' => 'off',
            'options' => array(
                'on' => esc_html__('Yes', DMPRO_TEXTDOMAIN),
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
            ),
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'front_side'
        ];

        $module_fields["front_circle_color"] = [
            'label' => esc_html__('Circle Color', DMPRO_TEXTDOMAIN),
            'type' => 'color-alpha',
            'custom_color' => true,
            'show_if' => array(
                'front_circle_icon' => 'on',
            ),
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'front_side'
        ];

        $module_fields["front_circle_border"] = [
            'label' => esc_html__('Show Circle Border', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'configuration',
            'default' => 'off',
            'options' => [
                'on' => esc_html__('Yes', DMPRO_TEXTDOMAIN),
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
            ],
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'front_side'
        ];

        $module_fields["front_circle_border_color"] = [
            'label' => esc_html__('Circle Border Color', DMPRO_TEXTDOMAIN),
            'type' => 'color-alpha',
            'custom_color' => true,
            'show_if' => [
                'front_circle_border' => 'on',
            ],
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'front_side'
        ];

        $module_fields["front_icon_size"] = [
            'label' => esc_html__('Icon Font Size', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'validate_unit' => true,
            'default' => '40px',
            'default_unit' => 'px',
            'range_settings' => array(
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ),
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'front_side'
        ];

        $module_fields['front_content'] = [
            'label' => esc_html__('Front Side Content', DMPRO_TEXTDOMAIN),
            'type' => 'tiny_mce',
            'option_category' => 'basic_option',
            'toggle_slug' => 'flipbox_content',
            'sub_toggle' => 'front_side'
        ];

        $module_fields['use_front_button'] = [
            'label' => esc_html__('Enable Front Side Button', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'basic_option',
            'default' => 'off',
            'options' => [
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('Yes', DMPRO_TEXTDOMAIN),
            ],
            'affects' => [
                'front_button_text',
                'front_button_link',
                'front_button_link_target',
            ],
            
            'toggle_slug' => 'flipbox_button',
            'sub_toggle' => 'front_side'
        ];

        $module_fields["front_button_text"] = [
            'label' => esc_html__('Button Text', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'default' => esc_html__('Click Here', DMPRO_TEXTDOMAIN),
            'option_category' => 'basic_option',
            'depends_show_if' => 'on',
            'toggle_slug' => 'flipbox_button',
            'sub_toggle' => 'front_side'
        ];

        $module_fields["front_button_link"] = [
            'label' => esc_html__('Button Link', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'default' => '#',
            'option_category' => 'basic_option',
            'depends_show_if' => 'on',
            'toggle_slug' => 'flipbox_button',
            'sub_toggle' => 'front_side'
        ];

        $module_fields["front_button_link_target"] = [
            'label' => esc_html__('Button Link Target', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'option_category' => 'layout',
            'default' => 'same_window',
            'default_on_child' => true,
            'options' => [
                'off' => esc_html__('Same Window', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('New Window', DMPRO_TEXTDOMAIN),
            ],
            'depends_show_if' => 'on',
            'toggle_slug' => 'flipbox_button',
            'sub_toggle' => 'front_side'
        ];
        $module_fields['back_title'] = [
            'label' => esc_html__('Back Side Title', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'toggle_slug' => 'flipbox_content',
            'sub_toggle' => 'back_side'
        ];

        $module_fields['use_back_icon'] = [
            'label' => esc_html__('Enable Back Side Icon', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'basic_option',
            'options' => [
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('Yes', DMPRO_TEXTDOMAIN),
            ],
            'default' => 'off',
            'affects' => [
                'back_icon_image',
                'back_icon_color',
                'back_circle_icon',
                'back_circle_color',
                'back_circle_border',
                'back_circle_border_color',
                'back_icon_size',
                'back_icon_image',
            ],
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'back_side'
        ];

        $module_fields["back_image"] = [
            'label' => esc_html__('Image', DMPRO_TEXTDOMAIN),
            'type' => 'upload',
            'upload_button_text' => esc_attr__('Upload an image', DMPRO_TEXTDOMAIN),
            'choose_text' => esc_attr__('Choose an Image', DMPRO_TEXTDOMAIN),
            'update_text' => esc_attr__('Set As Image', DMPRO_TEXTDOMAIN),
            'description' => esc_html__('Upload an image to display as before image', DMPRO_TEXTDOMAIN),
            'hide_metadata' => true,
            'show_if' => ['use_back_icon' => 'off'],
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'back_side',
            'dynamic_content' => 'image',
        ];

        $module_fields["back_image_alt"] = [
            'label'       => esc_html__( 'Image Alt Text', DMPRO_TEXTDOMAIN ),
            'type'        => 'text',
            'description' => esc_html__( 'Define the HTML ALT text for your image here.', DMPRO_TEXTDOMAIN),
            'show_if'     => ['use_back_icon' => 'off'],
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'back_side'
        ];

        $module_fields["back_image_width"] = [
            'label' => esc_html__('Back Image Container Width', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'validate_unit' => true,
            'mobile_options' => true,
            'default' => '100%',
            'default_unit' => '%',
            'show_if' => ['use_back_icon' => 'off'],
            'range_settings' => array(
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ),
            'tab_slug' => 'advanced',
            'toggle_slug' => 'width',
        ];

        $module_fields['back_icon'] = [
            'label' => esc_html__('Back Icon', DMPRO_TEXTDOMAIN),
            'type' => 'select_icon',
            'option_category' => 'basic_option',
            'default' => '5',
            'show_if' => ['use_back_icon' => 'on'],
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'back_side'
        ];

        $module_fields["back_icon_color"] = [
            'label' => esc_html__('Icon Color', DMPRO_TEXTDOMAIN),
            'type' => 'color-alpha',
            'default' => '#7EBEC5',
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'back_side'
        ];

        $module_fields["back_circle_icon"] = [
            'label' => esc_html__('Circle Icon', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'configuration',
            'default' => 'off',
            'options' => array(
                'on' => esc_html__('Yes', DMPRO_TEXTDOMAIN),
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
            ),
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'back_side'
        ];

        $module_fields["back_circle_color"] = [
            'label' => esc_html__('Circle Color', DMPRO_TEXTDOMAIN),
            'type' => 'color-alpha',
            'custom_color' => true,
            'show_if' => array(
                'back_circle_icon' => 'on',
            ),
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'back_side'
        ];

        $module_fields["back_circle_border"] = [
            'label' => esc_html__('Show Circle Border', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'configuration',
            'default' => 'off',
            'options' => [
                'on' => esc_html__('Yes', DMPRO_TEXTDOMAIN),
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
            ],
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'back_side'
        ];

        $module_fields["back_circle_border_color"] = [
            'label' => esc_html__('Circle Border Color', DMPRO_TEXTDOMAIN),
            'type' => 'color-alpha',
            'custom_color' => true,
            'show_if' => [
                'back_circle_border' => 'on',
            ],
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'back_side'
        ];

        $module_fields["back_icon_size"] = [
            'label' => esc_html__('Icon Font Size', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'validate_unit' => true,
            'default' => '40px',
            'default_unit' => 'px',
            'range_settings' => array(
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ),
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'back_side'
        ];

        $module_fields['back_content'] = [
            'label' => esc_html__('Back Side Content', DMPRO_TEXTDOMAIN),
            'type' => 'tiny_mce',
            'option_category' => 'basic_option',
            'toggle_slug' => 'flipbox_content',
            'sub_toggle' => 'back_side'
        ];

        $module_fields['use_back_button'] = [
            'label' => esc_html__('Enable Back Side Button', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'basic_option',
            'default' => 'off',
            'options' => [
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('Yes', DMPRO_TEXTDOMAIN),
            ],
            'affects' => [
                'back_button_text',
                'back_button_link',
                'back_button_link_target',
            ],
            'toggle_slug' => 'flipbox_button',
            'sub_toggle' => 'back_side'
        ];

        $module_fields["back_button_text"] = [
            'label' => esc_html__('Button Text', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'default' => esc_html__('Click Here', DMPRO_TEXTDOMAIN),
            'option_category' => 'basic_option',
            'depends_show_if' => 'on',
            'toggle_slug' => 'flipbox_button',
            'sub_toggle' => 'back_side'
        ];

        $module_fields["back_button_link"] = [
            'label' => esc_html__('Button Link', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'default' => '#',
            'option_category' => 'basic_option',
            'depends_show_if' => 'on',
            'toggle_slug' => 'flipbox_button',
            'sub_toggle' => 'back_side'
        ];

        $module_fields["back_button_link_target"] = [
            'label' => esc_html__('Button Link Target', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'option_category' => 'layout',
            'default' => 'same_window',
            'default_on_child' => true,
            'options' => [
                'off' => esc_html__('Same Window', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('New Window', DMPRO_TEXTDOMAIN),
            ],
            'depends_show_if' => 'on',
            'toggle_slug' => 'flipbox_button',
            'sub_toggle' => 'back_side'
        ];

        $module_fields['use_dynamic_height'] = [
            'label' => esc_html__('Equalize Flipbox Height', DMPRO_TEXTDOMAIN),
            'description' => esc_html__('Equalizing flipbox heights will force both sides of the flipbox to assume the height of the tallest side. Both sides of the flipbox will have the same height, keeping their appearance uniform.', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'default' => 'off',
            'options' => [
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('Yes', DMPRO_TEXTDOMAIN),
            ],
            'toggle_slug' => 'flipbox_settings',
            'show_if' => [
                'use_force_square' => 'off',
            ],
        ];

        $module_fields['use_force_square'] = [
            'label' => esc_html__('Enable Square Flipbox', DMPRO_TEXTDOMAIN),
            'description' => esc_html__('Enalbe this option to make the flipbox a perfect square. The height of will automatically equal the width of the flipbox.', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'default' => 'off',
            'options' => [
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('Yes', DMPRO_TEXTDOMAIN),
            ],
            'toggle_slug' => 'flipbox_settings',
            'show_if' => [
                'use_dynamic_height' => 'off',
            ],
        ];

        $module_fields["flip_box_height"] = [
            'label' => esc_html__('Flipbox Height', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'validate_unit' => true,
            'mobile_options' => true,
            'default' => '250px',
            'default_unit' => 'px',
            'range_settings' => array(
                'min' => '0',
                'max' => '500',
                'step' => '1',
            ),
            'show_if' => [
                'use_dynamic_height' => 'off',
                'use_force_square' => 'off',
            ],
            'toggle_slug' => 'flipbox_settings',
        ];

        $module_fields["flip_box_speed"] = [
            'label' => esc_html__('Flip Speed', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'validate_unit' => true,
            'default' => '600ms',
            'default_unit' => 'ms',
            'range_settings' => array(
                'min' => '0',
                'max' => '2000',
                'step' => '100',
            ),
            'toggle_slug' => 'flipbox_settings',
        ];

        $module_fields["flip_box_align_front"] = [
            'label' => esc_html__('Front Horizontal Align', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'option_category' => 'basic_option',
            'default' => 'center',
            'options' => array(
                'left' => esc_html__('Left', DMPRO_TEXTDOMAIN),
                'center' => esc_html__('Center', DMPRO_TEXTDOMAIN),
                'right' => esc_html__('Right', DMPRO_TEXTDOMAIN),
            ),
            'toggle_slug' => 'flipbox_settings',
        ];
        $module_fields["flip_box_align_front_vertical"] = [
            'label' => esc_html__('Front Vertical Align', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'option_category' => 'basic_option',
            'default' => 'center',
            'options' => array(
                'flex-start' => esc_html__('Top', DMPRO_TEXTDOMAIN),
                'center' => esc_html__('Center', DMPRO_TEXTDOMAIN),
                'flex-end' => esc_html__('Bottom', DMPRO_TEXTDOMAIN),
            ),
            'toggle_slug' => 'flipbox_settings',
        ];

        $module_fields["flip_box_align_back"] = [
            'label' => esc_html__('Back Horizontal Align', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'option_category' => 'basic_option',
            'default' => 'center',
            'options' => array(
                'left' => esc_html__('Left', DMPRO_TEXTDOMAIN),
                'center' => esc_html__('Center', DMPRO_TEXTDOMAIN),
                'right' => esc_html__('Right', DMPRO_TEXTDOMAIN),
            ),
            'toggle_slug' => 'flipbox_settings',
        ];

        $module_fields["flip_box_align_back_vertical"] = [
            'label' => esc_html__('Back Vertical Align', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'option_category' => 'basic_option',
            'default' => 'center',
            'options' => array(
                'flex-start' => esc_html__('Top', DMPRO_TEXTDOMAIN),
                'center' => esc_html__('Center', DMPRO_TEXTDOMAIN),
                'flex-end' => esc_html__('Bottom', DMPRO_TEXTDOMAIN),
            ),
            'toggle_slug' => 'flipbox_settings',
        ];

        $module_fields["flip_box_animation"] = [
            'label' => esc_html__('Select Flipbox Animation', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'option_category' => 'layout',
            'default' => 'flip_horizontally_ltr',
            'default_on_child' => true,
            'options' => [
                'flip_horizontally_ltr' => esc_html__('Left to Right', DMPRO_TEXTDOMAIN),
                'flip_horizontally_rtl' => esc_html__('Right to Left', DMPRO_TEXTDOMAIN),
                'flip_vertically_ttb' => esc_html__('Top to Bottom', DMPRO_TEXTDOMAIN),
                'flip_vertically_btt' => esc_html__('Bottom to Top', DMPRO_TEXTDOMAIN),
            ],
            'depends_show_if' => 'on',
            'toggle_slug' => 'flipbox_settings',
        ];

        $module_fields['use_3d_effect'] = [
            'label' => esc_html__('Enable 3D Content Effect', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'basic_option',
            'options' => [
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('Yes', DMPRO_TEXTDOMAIN),
            ],
            'default' => 'off',
            'toggle_slug' => 'flipbox_settings',
        ];

        $module_fields['use_3d_flip_box'] = [
            'label' => esc_html__('Enable 3D Flipbox', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'basic_option',
            'options' => [
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('Yes', DMPRO_TEXTDOMAIN),
            ],
            'default' => 'off',
            'toggle_slug' => 'flipbox_settings',
        ];

        $module_fields["flip_box_3d_flank_color"] = [
            'label' => esc_html__('Flip Box 3D Flank Color', DMPRO_TEXTDOMAIN),
            'type' => 'color-alpha',
            'custom_color' => true,
            'show_if' => [
                'use_3d_flip_box' => 'on',
            ],
            'toggle_slug' => 'flipbox_settings',
        ];

        $more_settings = [];

        $more_settings['front_side_bg_color'] = [
            'label' => esc_html__('Front Background', DMPRO_TEXTDOMAIN),
            'type' => 'background-field',
            'base_name' => "front_side_bg",
            'context' => "front_side_bg",
            'option_category' => 'layout',
            'custom_color' => true,
            'default' => ET_Global_Settings::get_value('all_buttons_bg_color'),
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_background',
            'sub_toggle' => 'front_side',
            'background_fields' => array_merge(
                $this->generate_background_options('front_side_bg', 'gradient', "advanced", "flipbox_background", "front_side_bg_gradient"),
                $this->generate_background_options("front_side_bg", "color", "advanced", "flipbox_background", "front_side_bg_color"),
                $this->generate_background_options("front_side_bg", "image", "advanced", "flipbox_background", "front_side_bg_image")
            ),
        ];

        $more_settings['back_side_bg_color'] = [
            'label' => esc_html__('Back Background', DMPRO_TEXTDOMAIN),
            'type' => 'background-field',
            'base_name' => "back_side_bg",
            'context' => "back_side_bg",
            'option_category' => 'layout',
            'custom_color' => true,
            'default' => ET_Global_Settings::get_value('all_buttons_bg_color'),
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_background',
            'sub_toggle' => 'back_side',
            'background_fields' => array_merge(
                $this->generate_background_options('back_side_bg', 'gradient', "advanced", "flipbox_background", "back_side_bg_gradient"),
                $this->generate_background_options("back_side_bg", "color", "advanced", "flipbox_background", "back_side_bg_color"),
                $this->generate_background_options("back_side_bg", "image", "advanced", "flipbox_background", "back_side_bg_image")
            ),
        ];

        $more_settings = array_merge($more_settings, $this->generate_background_options("front_side_bg", 'skip', "advanced", "flipbox_background", "front_side_bg_gradient"));
        $more_settings = array_merge($more_settings, $this->generate_background_options("front_side_bg", 'skip', "advanced", "flipbox_background", "front_side_bg_color"));
        $more_settings = array_merge($more_settings, $this->generate_background_options("front_side_bg", 'skip', "advanced", "flipbox_background", "front_side_bg_image"));
        $more_settings = array_merge($more_settings, $this->generate_background_options("back_side_bg", 'skip', "advanced", "flipbox_background", "back_side_bg_gradient"));
        $more_settings = array_merge($more_settings, $this->generate_background_options("back_side_bg", 'skip', "advanced", "flipbox_background", "back_side_bg_color"));
        $more_settings = array_merge($more_settings, $this->generate_background_options("back_side_bg", 'skip', "advanced", "flipbox_background", "back_side_bg_image"));

        return array_merge($module_fields, $more_settings);
    }

    public function get_advanced_fields_config() {

        $advanced_fields = [];

        $advanced_fields["text"] = false;
        $advanced_fields["text_shadow"] = false;
        $advanced_fields["fonts"] = false;
        $advanced_fields["background"] = false;

        $advanced_fields["borders"]["default"] = [
            'css' => [
                'main' => [
                    'border_radii' => "%%order_class%% .dmpro-flip-box-front-side .dmpro-flip-box-front-side-wrapper, %%order_class%% .dmpro-flip-box-back-side .dmpro-flip-box-back-side-wrapper",
                    'border_styles' => "%%order_class%% .dmpro-flip-box-front-side .dmpro-flip-box-front-side-wrapper, %%order_class%% .dmpro-flip-box-back-side .dmpro-flip-box-back-side-wrapper"
                ]
            ],
            'defaults' => [
                    'border_radii' => 'on|3px|3px|3px|3px',
                    'border_styles' => [
                        'style' => 'none',
                        ]
            ]
        ];

        $advanced_fields["fonts"]["front_title"] = [
            'label' => esc_html__('Title', DMPRO_TEXTDOMAIN),
            'css' => [
                'main' => "%%order_class%% .dmpro-flip-box-front-side .dmpro-flip-box-heading",
                'important' => 'all',
            ],
            'hide_text_align' => true,
            'toggle_slug' => 'front_text',
            'sub_toggle' => 'title',
            'header_level' => [
                'default' => 'h2',
            ],
            'line_height' => [
                'range_settings' => [
                    'min' => '1',
                    'max' => '100',
                    'step' => '1',
                ],
            ],
        ];

        $advanced_fields["fonts"]["front_desc"] = [
            'label' => esc_html__('Description', DMPRO_TEXTDOMAIN),
            'css' => [
                'main' => "%%order_class%% .dmpro-flip-box-front-side .dmpro-desc",
            ],
            'important' => 'all',
            'hide_text_align' => true,
            'toggle_slug' => 'front_text',
            'sub_toggle' => 'desc',
            'line_height' => [
                'range_settings' => [
                    'min' => '1',
                    'max' => '100',
                    'step' => '1',
                ],
            ],
        ];

        $advanced_fields["fonts"]["back_title"] = [
            'label' => esc_html__('Title', DMPRO_TEXTDOMAIN),
            'css' => [
                'main' => "%%order_class%% .dmpro-flip-box-back-side .dmpro-flip-box-heading",
            ],
            'important' => 'all',
            'hide_text_align' => true,
            'toggle_slug' => 'back_text',
            'sub_toggle' => 'title',
            'header_level' => [
                'default' => 'h2',
            ],
            'line_height' => [
                'range_settings' => [
                    'min' => '1',
                    'max' => '100',
                    'step' => '1',
                ],
            ],
        ];

        $advanced_fields["fonts"]["back_desc"] = [
            'label' => esc_html__('Description', DMPRO_TEXTDOMAIN),
            'css' => [
                'main' => "%%order_class%% .dmpro-flip-box-back-side .dmpro-desc",
            ],
            'important' => 'all',
            'hide_text_align' => true,
            'toggle_slug' => 'back_text',
            'sub_toggle' => 'desc',
            'line_height' => [
                'range_settings' => [
                    'min' => '1',
                    'max' => '100',
                    'step' => '1',
                ],
            ],
        ];

        $advanced_fields["box_shadow"]["default"] = [
            'label' => esc_html__('Flipbox Shadow', DMPRO_TEXTDOMAIN),
            'css' => [
                'main' => "%%order_class%% .dmpro-flip-box-front-side .dmpro-flip-box-front-side-wrapper, %%order_class%% .dmpro-flip-box-back-side .dmpro-flip-box-back-side-wrapper",
            ],
        ];

        $advanced_fields['margin_padding'] = [
            'css' => [
                'margin' => "%%order_class%% .dmpro-flip-box-front-side, %%order_class%% .dmpro-flip-box-back-side",
                'padding' => "%%order_class%% .dmpro-flip-box-front-side-innner, %%order_class%% .dmpro-flip-box-back-side-innner",
                'important' => 'all',
            ],
        ];

        $advanced_fields['button']["front_button"] = [
            'label' => esc_html__('Front Button', DMPRO_TEXTDOMAIN),
            'css' => [
                'main' => "%%order_class%% .dmpro-front-button",
                'important' => true,
            ],
            'use_alignment' => false,
            'box_shadow' => [
                'css' => [
                    'main' => "%%order_class%% .dmpro-front-button",
                    'important' => true,
                ],
            ],
            'margin_padding' => [
                'css' => [
                    'main' => "%%order_class%% .dmpro-front-button.et_pb_button",
                    'important' => 'all',
                ],
            ],
        ];

        $advanced_fields['button']["back_button"] = [
            'label' => esc_html__('Back Button', DMPRO_TEXTDOMAIN),
            'css' => [
                'main' => "%%order_class%% .dmpro-back-button",
                'important' => 'all',
            ],
            'use_alignment' => false,
            'box_shadow' => [
                'css' => [
                    'main' => "%%order_class%% .dmpro-back-button",
                    'important' => true,
                ],
            ],
            'borders' => [
                'css' => [
                    'main' => "%%order_class%% .dmpro-back-button",
                    'important' => true,
                ],
            ],
            'margin_padding' => [
                'css' => [
                    'main' => "%%order_class%% .dmpro-back-button.et_pb_button",
                    'important' => true,
                ],
            ],
        ];

        $advanced_fields['borders']['front_image'] = [
            'css' => [
                'main' => [
                    'border_radii' => "%%order_class%% .dmpro-flip-box-front-side .dmpro-image-wrap img",
                    'border_styles' => "%%order_class%% .dmpro-flip-box-front-side .dmpro-image-wrap img",
                ],
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'front_side',
            'depends_on' => ['use_front_icon'],
            'depends_show_if' => 'off',
        ];

        $advanced_fields['box_shadow']['front_image'] = [
            'option_category' => 'layout',
            'tab_slug' => 'advanced',
            'show_if' => ['use_front_icon' => 'off'],
            'css' => [
                'main' => '%%order_class%% .dmpro-flip-box-front-side .dmpro-image-wrap img',
                'overlay' => 'inset',
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'front_side'
        ];

        $advanced_fields['borders']['back_image'] = [
            'css' => [
                'main' => [
                    'border_radii' => "%%order_class%% .dmpro-flip-box-back-side .dmpro-image-wrap img",
                    'border_styles' => "%%order_class%% .dmpro-flip-box-back-side .dmpro-image-wrap img",
                ],
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'back_side',
            'depends_on' => ['use_back_icon'],
            'depends_show_if' => 'off',
        ];

        $advanced_fields['box_shadow']['back_icon_image'] = [
            'label' => esc_html__('Back Image Box Shadow', DMPRO_TEXTDOMAIN),
            'option_category' => 'layout',
            'tab_slug' => 'advanced',
            'show_if' => ['use_back_icon' => 'off'],
            'css' => [
                'main' => '%%order_class%% .dmpro-flip-box-back-side .dmpro-image-wrap img',
                'overlay' => 'inset',
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'flipbox_icon_image',
            'sub_toggle' => 'back_side'
        ];

        return $advanced_fields;
    }

    public function get_custom_css_fields_config() {

        $custom_css_fields = [];

        $custom_css_fields['front_card_container'] = [
            'label' => esc_html__('Front Card Container', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-flip-box-front-side',
        ];

        $custom_css_fields['front_image_icon'] = [
            'label' => esc_html__('Front Image/Icon', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-front-image-icon-wrap',
        ];

        $custom_css_fields['front_title'] = [
            'label' => esc_html__('Front Side Title', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-flip-box-front-side .dmpro-flip-box-heading',
        ];

        $custom_css_fields['front_description'] = [
            'label' => esc_html__('Front Description', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-flip-box-front-side .dmpro-desc',
        ];

        $custom_css_fields['front_button'] = [
            'label' => esc_html__('Front Button', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-front-button',
        ];

        $custom_css_fields['back_card_container'] = [
            'label' => esc_html__('Back Card Container', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-flip-box-back-side',
        ];

        $custom_css_fields['back_image_icon'] = [
            'label' => esc_html__('Back Image/Icon', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-back-image-icon-wrap',
        ];

        $custom_css_fields['back_title'] = [
            'label' => esc_html__('Back Side Title', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-flip-box-back-side .dmpro-flip-box-heading',
        ];

        $custom_css_fields['back_description'] = [
            'label' => esc_html__('Back Description', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-flip-box-back-side .dmpro-desc',
        ];

        $custom_css_fields['back_button'] = [
            'label' => esc_html__('Back Button', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-back-button',
        ];

        return $custom_css_fields;
    }

    public function render($attrs, $content, $render_slug) {
		
        $this->process_background( ".dmpro-flip-box-front-side .dmpro-flip-box-front-side-wrapper", "front_side_bg", $render_slug, 'sticky' );
        $this->process_background(".dmpro-flip-box-back-side .dmpro-flip-box-back-side-wrapper", "back_side_bg", $render_slug, 'hover' );
		
        $this->apply_css($render_slug);
		
        $flip_box_animation = '';

        if ('flip_horizontally_ltr' == $this->props['flip_box_animation'] && 'off' == $this->props['use_3d_flip_box']) {
            $flip_box_animation = 'dmpro-flip-left-right';
        } elseif ('flip_horizontally_rtl' == $this->props['flip_box_animation'] && 'off' == $this->props['use_3d_flip_box']) {
            $flip_box_animation = 'dmpro-flip-right-left';
        } elseif ('flip_vertically_ttb' == $this->props['flip_box_animation'] && 'off' == $this->props['use_3d_flip_box']) {
            $flip_box_animation = 'dmpro-flip-top-bottom';
        } elseif ('flip_vertically_btt' == $this->props['flip_box_animation'] && 'off' == $this->props['use_3d_flip_box']) {
            $flip_box_animation = 'dmpro-flip-bottom-top';
        }

        if ('on' == $this->props['use_3d_flip_box']) {
            if ('flip_horizontally_ltr' == $this->props['flip_box_animation']) {
                $flip_box_animation = 'dmpro-flip-box-3d-cube dmpro-flip-ltr';
            } elseif ('flip_horizontally_rtl' == $this->props['flip_box_animation']) {
                $flip_box_animation = 'dmpro-flip-box-3d-cube dmpro-flip-rtl';
            } elseif ('flip_vertically_ttb' == $this->props['flip_box_animation']) {
                $flip_box_animation = 'dmpro-flip-box-3d-cube dmpro-flip-ttb';
            } elseif ('flip_vertically_btt' == $this->props['flip_box_animation']) {
                $flip_box_animation = 'dmpro-flip-box-3d-cube dmpro-flip-btt';
            }
        }

        $get_3d_flank = ('on' == $this->props['use_3d_flip_box']) ? '<div class="dmpro-flip-box-3d-flank"></div>' : '';
        $use_3d_effect = ('on' == $this->props['use_3d_effect']) ? 'dmpro-3d-flip-box' : '';
        $order_class = self::get_module_order_class($render_slug);
		
        wp_enqueue_style("dmpro-".$this->slug, $this->module_url . 'style.css', [], DMPRO_VERSION , 'all');
        wp_enqueue_script('dmpro_resize_sensor_script');
		
        return sprintf(
            '<div class="dmpro-flip-box-container" data-dynamic_height="%6$s" data-force_square="%7$s">
                <div class="dmpro-flip-box-inner %3$s %4$s">
                    <div class="dmpro-flip-box-inner-wrapper">
                        %1$s
                        %2$s
                        %5$s
                    </div>
                </div>
           </div>',
            $this->_render_front_side(),
            $this->_render_back_side(),
            $flip_box_animation,
            $use_3d_effect,
            $get_3d_flank,
            $this->props['use_dynamic_height'],
            $this->props['use_force_square']
        );
    }

    public function _render_front_side() {
        $front_icon_image = '';
        if ('on' == $this->props['use_front_icon']) {
            $front_icon = et_pb_process_font_icon($this->props['front_icon']);
            $front_circle_icon_class = 'on' === $this->props['front_circle_icon'] ? 'dmpro-front-icon-circle' : '';
            $front_border_icon_class = 'on' === $this->props['front_circle_border'] ? 'dmpro-front-icon-border' : '';
            $front_icon_image = sprintf(
                '<div class="dmpro-front-image-icon-wrap dmpro-icon-wrap">
                    <span class="et-pb-icon et-pb-font-icon dmpro-flip-box-front-icon %2$s %3$s">
                        %1$s
                    </span>
                </div>',
                esc_attr($front_icon),
                $front_circle_icon_class,
                $front_border_icon_class
            );
        } else if (isset($this->props['front_image']) && '' !== $this->props['front_image']) {

            $front_image_alt = $this->_esc_attr( 'front_image_alt' );

            $front_icon_image = sprintf(
                '<div class="dmpro-front-image-icon-wrap dmpro-image-wrap">
                  <img src="%1$s" alt="%2$s">
                </div>',
                esc_attr($this->props['front_image']),
                $front_image_alt
            );
        }

        $front_title_level = $this->props['front_title_level'];
        $front_title = '';
        if ('' !== $this->props['front_title']) {
            $front_title = sprintf(
                '<%2$s class="dmpro-flip-box-heading">%1$s</%2$s>',
                esc_attr($this->props['front_title']),
                esc_attr($front_title_level)
            );
        }

        $front_content = '';
        if ('' !== $this->props['front_content']) {
            $front_content = sprintf(
                '<div class="dmpro-desc">%1$s</div>',
                et_sanitized_previously( $this->props['front_content'] )
            );
        }

        $front_button = '';
        if ('on' === $this->props['use_front_button']) {

            $front_button_rel = $this->props['front_button_rel'];
            $front_button_text = $this->props['front_button_text'];
            $front_button_link = $this->props['front_button_link'];
            $front_button_icon = $this->props['front_button_icon'];
            $front_button_target = $this->props['front_button_link_target'];
            $front_button_custom = $this->props['custom_front_button'];

            $front_button = $this->render_button([
                'button_classname' => [" dmpro-front-button"],
                'button_custom' => $front_button_custom,
                'button_rel' => $front_button_rel,
                'button_text' => $front_button_text,
                'button_url' => $front_button_link,
                'custom_icon' => $front_button_icon,
                'has_wrapper' => false,
                'url_new_window' => $front_button_target,
            ]);
        }

        $front_parallax_bg = '';
        if ('on' == $this->props["front_side_bg_parallax"]) {
            $front_parallax_bg = $this->parallax_image_bg("front_side_bg");
        }

        $front_content_render = '';
        if ('' !== $front_title || '' !== $front_content || '' !== $front_button) {
            $front_content_render = sprintf(
                '<div class="dmpro-text">
                    %1$s
                    %2$s
                    %3$s
                </div>',
                $front_title,
                $front_content,
                $front_button
            );
        }

        return sprintf(
            '<div class="dmpro-flip-box-front-side">
                <div class="dmpro-flip-box-front-side-wrapper">
                    %1$s
                    <div class="dmpro-flip-box-front-side-innner">
                        %2$s
                        %3$s
                    </div>
                </div>
            </div>
            ',
            $front_parallax_bg,
            $front_icon_image,
            $front_content_render
        );
    }

    public function _render_back_side() {
        $back_icon_image = '';
        if ('on' == $this->props['use_back_icon']) {
            $back_icon = et_pb_process_font_icon($this->props['back_icon']);
            $back_circle_icon_class = 'on' === $this->props['back_circle_icon'] ? 'dmpro-back-icon-circle' : '';
            $back_border_icon_class = 'on' === $this->props['back_circle_border'] ? 'dmpro-back-icon-border' : '';
            $back_icon_image = sprintf(
                '<div class="dmpro-back-image-icon-wrap dmpro-icon-wrap">
                    <span class="et-pb-icon et-pb-font-icon dmpro-flip-box-back-icon %2$s %3$s">%1$s</span>
                </div>',
                esc_attr($back_icon),
                $back_circle_icon_class,
                $back_border_icon_class
            );
        } else if (isset($this->props['back_image']) && '' !== $this->props['back_image']) {
            $back_image_alt = $this->_esc_attr( 'back_image_alt' );
            $back_icon_image = sprintf(
                '<div class="dmpro-back-image-icon-wrap dmpro-image-wrap">
                    <img class="dmpro-flip-box-back-imge" src="%1$s" alt="%2$s">
                </div>',
                esc_attr($this->props['back_image']),
                $back_image_alt
            );
        }

        $back_title_level = $this->props['back_title_level'];
        $back_title = '';
        if ('' !== $this->props['back_title']) {
            $back_title = sprintf(
                '<%2$s class="dmpro-flip-box-heading">
                    %1$s
                </%2$s>',
                esc_attr($this->props['back_title']),
                esc_attr($back_title_level)
            );
        }

        $back_content = '';
        if ('' !== $this->props['back_content']) {
            $back_content = sprintf(
                '<div class="dmpro-desc">%1$s</div>',
                et_sanitized_previously( $this->props['back_content'] )
            ); 
        }

        $back_button = '';
        if ('on' === $this->props['use_back_button']) {

            $back_button_rel = $this->props['back_button_rel'];
            $back_button_text = $this->props['back_button_text'];
            $back_button_link = $this->props['back_button_link'];
            $back_button_icon = $this->props['back_button_icon'];
            $back_button_target = $this->props['back_button_link_target'];
            $back_button_custom = $this->props['custom_back_button'];
            
            $back_button = $this->render_button([
                'button_classname' => [" dmpro-back-button"],
                'button_custom' => $back_button_custom,
                'button_rel' => $back_button_rel,
                'button_text' => $back_button_text,
                'button_url' => $back_button_link,
                'custom_icon' => $back_button_icon,
                'has_wrapper' => false,
                'url_new_window' => $back_button_target,
            ]);
        }

        $back_parallax_bg = '';
        if ('on' == $this->props["back_side_bg_parallax"]) {
            $back_parallax_bg = $this->parallax_image_bg("back_side_bg");
        }

        $back_content_render = '';
        if ('' !== $back_title || '' !== $back_content || '' !== $back_button) {
            $back_content_render = sprintf(
                '<div class="dmpro-text">
                    %1$s
                    %2$s
                    %3$s
                </div>',
                $back_title,
                $back_content,
                $back_button
            );
        }

        return sprintf(
            '<div class="dmpro-flip-box-back-side">
                <div class="dmpro-flip-box-back-side-wrapper">
                    %1$s
                    <div class="dmpro-flip-box-back-side-innner">
                        %2$s
                        %3$s
                    </div>
                </div>
            </div>',
            $back_parallax_bg,
            $back_icon_image,
            $back_content_render
        );
    }

    public function parallax_image_bg($base_name) {

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
            '<span class="et_parallax_bg_wrap"><span
            class="%1$s"
            style="background-image: url(%2$s);"
          ></span></span>',
            esc_attr(implode(' ', $parallax_classname)),
            esc_url($bg_image)
        );
    }

    public function apply_css($render_slug) {
        $this->flip_box_height($render_slug);
        $this->flip_box_image_width($render_slug);
        $front_icon_color = $this->props['front_icon_color'];
        $front_circle_icon = $this->props['front_circle_icon'];
        $front_circle_color = $this->props['front_circle_color'];
        $front_circle_border = $this->props['front_circle_border'];
        $front_circle_border_color = $this->props['front_circle_border_color'];
        $front_icon_size = $this->props['front_icon_size'];
        $back_icon_color = $this->props['back_icon_color'];
        $back_circle_icon = $this->props['back_circle_icon'];
        $back_circle_color = $this->props['back_circle_color'];
        $back_circle_border = $this->props['back_circle_border'];
        $back_circle_border_color = $this->props['back_circle_border_color'];
        $back_icon_size = $this->props['back_icon_size'];
        $flip_box_speed = $this->props['flip_box_speed'];
        $flip_box_align_front = $this->props['flip_box_align_front'];
        $flip_box_align_back = $this->props['flip_box_align_back'];
        $flip_box_3d_flank_color = $this->props['flip_box_3d_flank_color'];


        $flip_box_align_front_vertical = $this->props['flip_box_align_front_vertical'];
        $flip_box_align_back_vertical = $this->props['flip_box_align_back_vertical'];

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-flip-box-front-side-wrapper',
            'declaration' => "justify-content: {$flip_box_align_front_vertical};",
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-flip-box-back-side-wrapper',
            'declaration' => "justify-content: {$flip_box_align_back_vertical};",
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-back-button:after',
            'declaration' => "font-size: inherit !important; line-height: inherit !important;",
        ]);

        if ('on' == $this->props['use_3d_flip_box']) :
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-3d-cube',
                'declaration' => "transition-duration: {$flip_box_speed} !important;",
            ]);

        else :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-front-side, %%order_class%% .dmpro-flip-box-back-side',
                'declaration' => "transition-duration: {$flip_box_speed} !important;",
            ]);

        endif;

        if ('left' == $flip_box_align_front) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-front-side-innner',
                'declaration' => "text-align: left !important;",
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-front-image-icon-wrap',
                'declaration' => "margin-left: 0 !important; margin-right: auto !important;",
            ]);

        elseif ('center' == $flip_box_align_front) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-front-side-innner',
                'declaration' => "text-align: center !important;",
            ]);

        elseif ('right' == $flip_box_align_front) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-front-side-innner',
                'declaration' => "text-align: right !important;",
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-front-image-icon-wrap',
                'declaration' => "margin-right: 0 !important; margin-left: auto !important;",
            ]);

        endif;

        if ('left' == $flip_box_align_back) :
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-back-side-innner',
                'declaration' => "text-align: left !important;",
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-back-image-icon-wrap',
                'declaration' => "margin-right: auto !important; margin-left: 0 !important;",
            ]);

        elseif ('center' == $flip_box_align_back) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-back-side-innner',
                'declaration' => "text-align: center !important;",
            ]);

        elseif ('right' == $flip_box_align_back) :

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-back-side-innner',
                'declaration' => "text-align: right !important;",
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-back-image-icon-wrap',
                'declaration' => "margin-right: 0 !important; margin-left: auto !important;",
            ]);

        endif;

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-flip-box-3d-cube .dmpro-flip-box-3d-flank',
            'declaration' => "background-color: {$flip_box_3d_flank_color} !important;",
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-flip-box-front-side .dmpro-flip-box-front-icon',
            'declaration' => "color: {$front_icon_color} !important;",
        ]);

        if ('on' == $front_circle_icon) :
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-front-side .dmpro-front-icon-circle',
                'declaration' => "background-color: {$front_circle_color} !important;",
            ]);
        endif;

        if ('on' == $front_circle_border) :
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-front-side .dmpro-front-icon-border',
                'declaration' => "border-color: {$front_circle_border_color} !important;",
            ]);
        endif;

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-flip-box-front-side .dmpro-flip-box-front-icon',
            'declaration' => "font-size: {$front_icon_size} !important;",
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-flip-box-back-side .dmpro-flip-box-back-icon',
            'declaration' => "color: {$back_icon_color} !important;",
        ]);

        if ('on' == $back_circle_icon) :
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-back-side .dmpro-back-icon-circle',
                'declaration' => "background-color: {$back_circle_color} !important;",
            ]);
        endif;

        if ('on' == $back_circle_border) :
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-back-side .dmpro-back-icon-border',
                'declaration' => "border-color: {$back_circle_border_color} !important;",
            ]);
        endif;

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-flip-box-back-side .dmpro-flip-box-back-icon',
            'declaration' => "font-size: {$back_icon_size} !important;",
        ]);
    }

    private function flip_box_height($render_slug) {

        $flip_box_height = $this->props['flip_box_height'];
        $flip_box_height_tablet = $this->props['flip_box_height_tablet'] ? $this->props['flip_box_height_tablet'] : $flip_box_height;
        $flip_box_height_phone = $this->props['flip_box_height_phone'] ? $this->props['flip_box_height_phone'] : $flip_box_height_tablet;
        $flip_box_height_last_edited = $this->props['flip_box_height_last_edited'];
        $flip_box_height_responsive_status = et_pb_get_responsive_status($flip_box_height_last_edited);

        if ('off' === $this->props['use_dynamic_height'] && 'off' === $this->props['use_force_square']) {
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-inner-wrapper',
                'declaration' => "height: {$flip_box_height} !important;",
            ]);

            if ('' !== $flip_box_height_tablet && $flip_box_height_responsive_status) {
                ET_Builder_Element::set_style($render_slug, [
                    'selector' => '%%order_class%% .dmpro-flip-box-inner-wrapper',
                    'declaration' => "height: {$flip_box_height_tablet} !important;",
                    'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
                ]);
            }

            if ('' !== $flip_box_height_phone && $flip_box_height_responsive_status) {
                ET_Builder_Element::set_style($render_slug, [
                    'selector' => '%%order_class%% .dmpro-flip-box-inner-wrapper',
                    'declaration' => "height: {$flip_box_height_phone} !important;",
                    'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
                ]);
            }
        }
    }

    private function flip_box_image_width($render_slug) {

        $front_image_width = $this->props['front_image_width'];
        $front_image_width_tablet = $this->props['front_image_width_tablet'] ? $this->props['front_image_width_tablet'] : $front_image_width;
        $front_image_width_phone = $this->props['front_image_width_phone'] ? $this->props['front_image_width_phone'] : $front_image_width_tablet;
        $front_image_width_last_edited = $this->props['front_image_width_last_edited'];
        $front_image_width_responsive_status = et_pb_get_responsive_status($front_image_width_last_edited);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-flip-box-front-side .dmpro-image-wrap',
            'declaration' => "max-width: {$front_image_width} !important;",
        ]);

        if ('' !== $front_image_width_tablet && $front_image_width_responsive_status) :
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-front-side .dmpro-image-wrap',
                'declaration' => "max-width: {$front_image_width_tablet} !important;",
                'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
            ]);
        endif;

        if ('' !== $front_image_width_phone && $front_image_width_responsive_status) :
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-front-side .dmpro-image-wrap',
                'declaration' => "max-width: {$front_image_width_phone} !important;",
                'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
            ]);
        endif;

        $back_image_width = $this->props['back_image_width'];
        $back_image_width_tablet = $this->props['back_image_width_tablet'] ? $this->props['back_image_width_tablet'] : $back_image_width;
        $back_image_width_phone = $this->props['back_image_width_phone'] ? $this->props['back_image_width_phone'] : $back_image_width_tablet;
        $back_image_width_last_edited = $this->props['back_image_width_last_edited'];
        $back_image_width_responsive_status = et_pb_get_responsive_status($back_image_width_last_edited);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-flip-box-back-side .dmpro-image-wrap',
            'declaration' => "max-width: {$back_image_width} !important;",
        ]);

        if ('' !== $back_image_width_tablet && $back_image_width_responsive_status) :
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-back-side .dmpro-image-wrap',
                'declaration' => "max-width: {$back_image_width_tablet} !important;",
                'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
            ]);
        endif;

        if ('' !== $back_image_width_phone && $back_image_width_responsive_status) :
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .dmpro-flip-box-back-side .dmpro-image-wrap',
                'declaration' => "max-width: {$back_image_width_phone} !important;",
                'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
            ]);
        endif;
    }

    public function process_background( $class_name, $base_name, $render_slug, $mode = 'sticky' ) {
		
		$helper_background = et_pb_background_options(); 
		
        $background_images = [];
        $background_style = '';

        $use_bg_gradient = $this->props["{$base_name}_use_color_gradient"];
		
		$bg_gradient_stops = $this->props["{$base_name}_color_gradient_stops"];
		$bg_gradient_unit = $this->props["{$base_name}_color_gradient_unit"];
		
		$stops = str_replace( '|', ', ', $bg_gradient_stops );
		$stops = $helper_background->get_color_value( $stops );
		
        $bg_overlays_image = $this->props["{$base_name}_color_gradient_overlays_image"];
		
        $has_bg_gradient = false;
        $has_bg_image = false;
		
        if ('on' === $use_bg_gradient) {

			$suffix = '';
			
			$gradient_properties = $helper_background->get_gradient_properties( $this->props, $base_name, $suffix );
			
			$gradient_properties_desktop = $gradient_properties;
			
			$gradient_values_mode = $helper_background->get_gradient_mode_properties(
				$mode,
				$this->props,
				$base_name,
				$gradient_properties_desktop
			);
			
			$gradient_bg = $helper_background->get_gradient_style( $gradient_values_mode );
			
            $gradient_bg = $gradient_bg;
			
            if ( !empty($gradient_bg) ) {
				
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
            if ('' !== $bg_size) {
                $background_style .= sprintf(
                    'background-size: %1$s !important; ',
                    esc_html($bg_size)
                );
            }
            $bg_position = $this->props["{$base_name}_position"];
            if ('' !== $bg_position) {
                $background_style .= sprintf(
                    'background-position: %1$s !important; ',
                    esc_html(str_replace('_', ' ', $bg_position))
                );
            }
            $bg_repeat = $this->props["{$base_name}_repeat"];
            if ('' !== $bg_repeat) {
                $background_style .= sprintf(
                    'background-repeat: %1$s !important; ',
                    esc_html($bg_repeat)
                );
            }
            $bg_blend = $this->props["{$base_name}_blend"];
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
}

new DMPRO_FlipBox;