<?php

class DMPRO_Timeline_Item extends ET_Builder_Module
{
    public function init()
    {
        $this->name = esc_html__('Timeline Event', 'dmpro-divi-modules-pro');
        $this->plural = esc_html__('Timeline Events', 'dmpro-divi-modules-pro');
        $this->slug = 'dmpro_timeline_item';
        $this->vb_support = 'on';
        $this->main_css_element = '%%order_class%%.dmpro_timeline_item';
        $this->type = 'child';
        $this->advanced_setting_title_text = esc_html__('Timeline Event', 'dmpro-divi-modules-pro');
        $this->child_title_var = 'admin_label';
        $this->settings_modal_toggles = [
            'general' => [
                'toggles' => [
                    'event_card' => [
                        'sub_toggles' => [
                            'event_card_text' => [
                                'name' => 'Text',
                                ],
                            'image' => [
                                'name' => 'Image & Icon',
                                ],
                                
                            ],
                            'tabbed_subtoggles' => true,
                            'title' => esc_html__('Event Card', 'dmpro-divi-modules-pro'),
                            'priority' => 1,
                        ],
                    'timeline_icon' => esc_html__('Timeline Icon', 'dmpro-divi-modules-pro'),
                ],
            ],
            'advanced' => [
                'toggles' => [
                     'event_card' => [
                        'sub_toggles' => [
                            'card_settings' => [
                                'name' => 'Style',
                                ],
                            'card_arrow_settings' => [
                                'name' => 'Arrow',
                                ],
                            'date_text_settings' => [
                                'name' => 'Date/Milestone',
                                ],
                                
                            ],
                            'tabbed_subtoggles' => true,
                            'title' => esc_html__('Event Card', 'dmpro-divi-modules-pro'),
                            'priority' => 1,
                        ],
                    'timeline_icon_settings' => esc_html__('Timeline Icon', 'dmpro-divi-modules-pro'),
                    'icon_settings' => esc_html__('Image & Icon', 'dmpro-divi-modules-pro'),
                    'text_group' => [
                        'title' => esc_html__('Text', 'dmpro-divi-modules-pro'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles' => [
                            'title' => [
                                'name' => 'Title',
                            ],
                            'desc' => [
                                'name' => 'Description',
                            ],
                            'date' => [
                                'name' => 'Date',
                            ],
                        ],
                    ],
                    'button' => [
                        'title' => esc_html__('Button', 'dmpro-divi-modules-pro'),
                        'priority' => 55,
                    ],
                    'width' => [
                        'title' => esc_html__('Sizing', 'dmpro-divi-modules-pro'),
                        'priority' => 65,
                    ],
                ],
            ],
            'custom_css' => [
                'toggles' => [
                    'attributes' => [
                        'title' => esc_html__('Attributes', 'dmpro-divi-modules-pro'),
                        'priority' => 95,
                    ],
                ],
            ],
        ];

        $this->advanced_fields = array(
            'fonts' => array(
                'header' => array(
                    'label' => esc_html__('Event Card Title', 'dmpro-divi-modules-pro'),
                    'css' => array(
                        'main' => "{$this->main_css_element} .dmpro_timeline_item_header, {$this->main_css_element} .dmpro_timeline_item_header",
                        'hover' => "{$this->main_css_element}:hover .dmpro_timeline_item_header, {$this->main_css_element}:hover .dmpro_timeline_item_header",
                    ),
                    'header_level' => array(
                        'default' => 'h4',
                    ),
                    'toggle_slug' => 'text_group',
                    'sub_toggle' => 'title',
                ),
                'body' => array(
                    'label' => esc_html__('Event Card Description', 'dmpro-divi-modules-pro'),
                    'css' => array(
                        'main' => "{$this->main_css_element} .dmpro_timeline_item_description",
                        'line_height' => "{$this->main_css_element} .dmpro_timeline_item_description p",
                        'text_align' => "{$this->main_css_element} .dmpro_timeline_item_description",
                        'text_shadow' => "{$this->main_css_element} .dmpro_timeline_item_description",
                    ),
                    'toggle_slug' => 'text_group',
                    'sub_toggle' => 'desc',
                ),
                'date_text' => array(
                    'label' => esc_html__('Date/Milestone', 'dmpro-divi-modules-pro'),
                    'css' => array(
                        'main' => "{$this->main_css_element} .dmpro_timeline_date_text",
                        'line_height' => "{$this->main_css_element} span.dmpro_timeline_date_text",
                        'text_align' => "{$this->main_css_element} .dmpro_timeline_date_text",
                        'text_shadow' => "{$this->main_css_element} .dmpro_timeline_date_text",
                        'important' => 'all',
                    ),
                    'tab_slug' => 'advanced',
                    'toggle_slug' => 'text_group',
                    'sub_toggle' => 'date',
                ),
            ),
            'background' => array(
                'settings' => array(
                    'color' => 'alpha',
                ),
                'css' => array(
                    'main' => '%%order_class%% .dmpro_timeline_item_card',
                    'important' => 'all',
                ),
                'default' => 'f4f4f4',
            ),
            'button' => array(
                'button' => array(
                    'label' => esc_html__('Button', 'dmpro-divi-modules-pro'),
                    'css' => array(
                        'main' => "{$this->main_css_element} .dmpro_timeline_item_button.et_pb_button",
                        'limited_main' => "{$this->main_css_element} .dmpro_timeline_item_button.et_pb_button",
                        'alignment' => "{$this->main_css_element} .et_pb_button_wrapper",
                    ),
                    'use_alignment' => true,
                    'box_shadow' => array(
                        'css' => array(
                            'main' => '%%order_class%% .et_pb_button',
                        ),
                    ),
                    'margin_padding' => array(
                        'css' => array(
                            'main' => "{$this->main_css_element} .et_pb_button_wrapper .dmpro_timeline_item_button.et_pb_button",
                            'margin' => "{$this->main_css_element} .et_pb_button_wrapper",
                            'important' => 'all',
                            'default' => '20px|||',
                        ),
                    ),
                ),
            ),
            'borders' => array(
                'default' => array(
                    'css' => array(
                        'main' => array(
                            'border_radii' => '%%order_class%% .dmpro_timeline_item_card',
                            'border_radii_hover' => '%%order_class%%:hover .dmpro_timeline_item_card',
                            'border_styles' => '%%order_class%% .dmpro_timeline_item_card',
                            'border_styles_hover' => '%%order_class%%:hover .dmpro_timeline_item_card',
                        ),
                    ),
                    'label_prefix' => esc_html__('Event Card', 'dmpro-divi-modules-pro'),
                    'tab_slug' => 'advanced',
                    'toggle_slug' => 'event_card',
                    'sub_toggle' => 'card_settings',
                ),
                'image' => array(
                    'css' => array(
                        'main' => array(
                            'border_radii' => '%%order_class%% .dmpro_timeline_item_image .et_pb_image_wrap',
                            'border_radii_hover' => '%%order_class%%:hover .dmpro_timeline_item_image .et_pb_image_wrap',
                            'border_styles' => '%%order_class%% .dmpro_timeline_item_image .et_pb_image_wrap',
                            'border_styles_hover' => '%%order_class%%:hover .dmpro_timeline_item_image .et_pb_image_wrap',
                        ),
                    ),
                    'label_prefix' => esc_html__('Image', 'dmpro-divi-modules-pro'),
                    'tab_slug' => 'advanced',
                    'toggle_slug' => 'icon_settings',
                    'show_if' => array(
                        'use_icon' => 'off',
                    ),
                ),
                'date_text' => array(
                    'css' => array(
                        'main' => array(
                            'border_radii' => '%%order_class%% .dmpro_timeline_date .dmpro_timeline_date_text',
                            'border_radii_hover' => '%%order_class%%:hover .dmpro_timeline_date .dmpro_timeline_date_text',
                            'border_styles' => '%%order_class%% .dmpro_timeline_date .dmpro_timeline_date_text',
                            'border_styles_hover' => '%%order_class%%:hover .dmpro_timeline_date .dmpro_timeline_date_text',
                        ),
                    ),
                    'label_prefix' => esc_html__('Date/Milestone', 'dmpro-divi-modules-pro'),
                    'tab_slug' => 'advanced',
                    'toggle_slug' => 'event_card',
                    'sub_toggle' => 'date_text_settings',
                ),
            ),
            'box_shadow' => array(
                'default' => array(
                    'label' => esc_html__('Event Card Box Shadow', 'dmpro-divi-modules-pro'),
                    'option_category' => 'layout',
                    'tab_slug' => 'advanced',
                    'toggle_slug' => 'event_card',
                    'sub_toggle' => 'card_settings',
                    'css' => array(
                        'main' => '%%order_class%% .dmpro_timeline_item_card',
                        'hover' => '%%order_class%%:hover .dmpro_timeline_item_card',
                        'overlay' => 'inset',
                        'important' => 'all',
                    ),
                    'default_on_fronts' => array(
                        'color' => '',
                        'position' => '',
                    ),
                ),
                'image' => array(
                    'label' => esc_html__('Image Box Shadow', 'dmpro-divi-modules-pro'),
                    'option_category' => 'layout',
                    'tab_slug' => 'advanced',
                    'toggle_slug' => 'icon_settings',
                    'show_if' => array(
                        'use_icon' => 'off',
                    ),
                    'css' => array(
                        'main' => '%%order_class%% .dmpro_timeline_item_image .et_pb_image_wrap',
                        'hover' => '%%order_class%%:hover .dmpro_timeline_item_image .et_pb_image_wrap',
                        'show_if_not' => array(
                            'use_icon' => 'on',
                        ),
                        'overlay' => 'inset',
                    ),
                    'default_on_fronts' => array(
                        'color' => '',
                        'position' => '',
                    ),
                ),
                'date_text' => array(
                    'label' => esc_html__('Date/Milestone', 'dmpro-divi-modules-pro'),
                    'option_category' => 'layout',
                    'tab_slug' => 'advanced',
                    'toggle_slug' => 'event_card',
                    'sub_toggle' => 'date_text_settings',
                    'css' => array(
                        'main' => '%%order_class%% .dmpro_timeline_date .dmpro_timeline_date_text',
                        'hover' => '%%order_class%%:hover .dmpro_timeline_date .dmpro_timeline_date_text',
                        'overlay' => 'inset',
                    ),
                    'default_on_fronts' => array(
                        'color' => '',
                        'position' => '',
                    ),
                ),
            ),
            'margin_padding' => array(
                'css' => array(
                    'important' => 'all',
                ),
            ),
            'max_width' => array(
                'css' => array(
                    'main' => $this->main_css_element,
                    'module_alignment' => '%%order_class%%.dmpro_timeline_item.et_pb_module',
                ),
            ),
            'text' => false, /* array(
            'use_background_layout' => true,
            'css'                   => array(
            'text_shadow' => "{$this->main_css_element} .dmpro_timeline_item_content",
            ),
            'options'               => array(
            'background_layout' => array(
            'default_on_front' => 'light',
            'hover'            => 'tabs',
            ),
            'text_orientation'  => array(
            'default_on_front' => 'left',
            ),
            ),
            ),*/
            'filters' => array(
                'child_filters_target' => array(
                    'tab_slug' => 'advanced',
                    'toggle_slug' => 'icon_settings',
                    'depends_show_if' => 'off',
                    'css' => array(
                        'main' => '%%order_class%% .dmpro_timeline_item_image',
                        'hover' => '%%order_class%%:hover .dmpro_timeline_item_image',
                    ),
                ),
            ),
            'icon_settings' => array(
                'css' => array(
                    'main' => '%%order_class%% .dmpro_timeline_item_image',
                ),
            ),
        );

        $this->custom_css_fields = array(
            'timeline_item_image' => array(
                'label' => esc_html__('Timeline Event Image', 'dmpro-divi-modules-pro'),
                'selector' => '.dmpro_timeline_item_image',
            ),
            'timeline_item_title' => array(
                'label' => esc_html__('Timeline Event Title', 'dmpro-divi-modules-pro'),
                'selector' => '.dmpro_timeline_item_header',
            ),
            'timeline_item_content' => array(
                'label' => esc_html__('Timeline Event Content', 'dmpro-divi-modules-pro'),
                'selector' => '.dmpro_timeline_item_content',
            ),
            'timeline_item_button' => array(
                'label' => esc_html__('Timeline Event Button', 'dmpro-divi-modules-pro'),
                'selector' => '.et_pb_button_wrapper .et_pb_button.dmpro_timeline_item_button',
                'no_space_before_selector' => false,
            ),
            'timeline_item_date_text' => array(
                'label' => esc_html__('Timeline Event Date/Milestone Text', 'dmpro-divi-modules-pro'),
                'selector' => '.dmpro_timeline_date .dmpro_timeline_date_text',
			),
			'timeline_item_icon' => array(
                'label' => esc_html__('Timeline Icon', 'dmpro-divi-modules-pro'),
                'selector' => '.date-icon',
            ),

        );

        $this->help_videos = array(
            array(
                'id' => 'XW7HR86lp8U',
                'name' => esc_html__('An introduction to the Timeline Event module', 'dmpro-divi-modules-pro'),
            ),
        );
    }

    public function get_fields()
    {
        $et_accent_color = et_builder_accent_color();

        $image_icon_placement = array(
            'top' => esc_html__('Top', 'dmpro-divi-modules-pro'),
        );

        if (!is_rtl()) {
            $image_icon_placement['left'] = esc_html__('Left', 'dmpro-divi-modules-pro');
        } else {
            $image_icon_placement['right'] = esc_html__('Right', 'dmpro-divi-modules-pro');
        }

        $fields = array(
            'admin_label' => array(
                'label' => esc_html__('Admin Label', 'dmpro-divi-modules-pro'),
                'type' => 'text',
                'toggle_slug' => 'admin_label',
                'description' => esc_html__('This will change the label of the module in the builder for easy identification.', 'dmpro-divi-modules-pro'),
            ),
            'date' => array(
                'label' => esc_html__('Date/Milestone', 'dmpro-divi-modules-pro'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('The date or milestone title that displays with your timeline event.', 'dmpro-divi-modules-pro'),
                'toggle_slug' => 'event_card',
                'sub_toggle' => 'event_card_text',
                'dynamic_content' => 'text',
                'mobile_options' => true,
                'hover' => 'tabs',
            ),
            'title' => array(
                'label' => esc_html__('Event Title', 'dmpro-divi-modules-pro'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('The title of your timeline event that will display within the timeline event card.', 'dmpro-divi-modules-pro'),
                'toggle_slug' => 'event_card',
                'sub_toggle' => 'event_card_text',
                'dynamic_content' => 'text',
                'mobile_options' => true,
                'hover' => 'tabs',
            ),
            'content' => array(
                'label' => esc_html__('Event Description', 'dmpro-divi-modules-pro'),
                'type' => 'tiny_mce',
                'option_category' => 'basic_option',
                'description' => esc_html__('Input a description for the timeline event that will display inside the timeline event card.', 'dmpro-divi-modules-pro'),
                'toggle_slug' => 'event_card',
                'sub_toggle' => 'event_card_text',
                'dynamic_content' => 'text',
                'mobile_options' => true,
                'hover' => 'tabs',
            ),
            'show_button' => array(
                'label' => esc_html__('Enable Event Button', 'dmpro-divi-modules-pro'),
                'type' => 'yes_no_button',
                'option_category' => 'layout',
                'options' => array(
                    'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
                    'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
                ),
                'description' => esc_html__('Enable this option to show a button within the timeline event card.', 'dmpro-divi-modules-pro'),
                'toggle_slug' => 'event_card',
                'sub_toggle' => 'event_card_text',
                'default_on_front' => 'off',
            ),
            'button_text' => array(
                'label' => esc_html__('Button Text', 'dmpro-divi-modules-pro'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Input your desired button text, or leave blank for no button.', 'dmpro-divi-modules-pro'),
                'toggle_slug' => 'event_card',
                'sub_toggle' => 'event_card_text',
                'dynamic_content' => 'text',
                'mobile_options' => true,
                'hover' => 'tabs',
                'show_if' => array(
                    'show_button' => 'on',
                ),
            ),
            'button_url' => array(
                'label' => esc_html__('Button Link URL', 'dmpro-divi-modules-pro'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Input the destination URL for your button.', 'dmpro-divi-modules-pro'),
                'toggle_slug' => 'event_card',
                'sub_toggle' => 'event_card_text',
                'dynamic_content' => 'url',
                'show_if' => array(
                    'show_button' => 'on',
                ),
            ),
            'button_url_new_window' => array(
                'label' => esc_html__('Button Link Target', 'dmpro-divi-modules-pro'),
                'type' => 'select',
                'option_category' => 'configuration',
                'options' => array(
                    'off' => esc_html__('In The Same Window', 'dmpro-divi-modules-pro'),
                    'on' => esc_html__('In The New Tab', 'dmpro-divi-modules-pro'),
                ),
                'toggle_slug' => 'event_card',
                'sub_toggle' => 'event_card_text',
                'description' => esc_html__('Here you can choose whether or not your link opens in a new window', 'dmpro-divi-modules-pro'),
                'default_on_front' => 'off',
                'show_if' => array(
                    'show_button' => 'on',
                ),
            ),
            'url' => array(
                'label' => esc_html__('Title Link URL', 'dmpro-divi-modules-pro'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('If you would like to make your timeline event a link, input your destination URL here.', 'dmpro-divi-modules-pro'),
                'toggle_slug' => 'link_options',
                'dynamic_content' => 'url',
            ),
            'url_new_window' => array(
                'label' => esc_html__('Title Link Target', 'dmpro-divi-modules-pro'),
                'type' => 'select',
                'option_category' => 'configuration',
                'options' => array(
                    'off' => esc_html__('In The Same Window', 'dmpro-divi-modules-pro'),
                    'on' => esc_html__('In The New Tab', 'dmpro-divi-modules-pro'),
                ),
                'toggle_slug' => 'link_options',
                'description' => esc_html__('Here you can choose whether or not your link opens in a new window', 'dmpro-divi-modules-pro'),
                'default_on_front' => 'off',
            ),
            'timeline_icon' => array(
                'label' => esc_html__('Timeline Icon', 'dmpro-divi-modules-pro'),
                'type' => 'select_icon',
                'option_category' => 'basic_option',
                'class' => array('et-pb-font-icon'),
                'toggle_slug' => 'timeline_icon',
                'description' => esc_html__('Choose an icon to display with your timeline Date/Milestone.', 'dmpro-divi-modules-pro'),
                'mobile_options' => true,
                'hover' => 'tabs',
                'default' => '%%43%%',
            ),
            'timeline_icon_color' => array(
                'default' => $et_accent_color,
                'label' => esc_html__('Icon Color', 'dmpro-divi-modules-pro'),
                'type' => 'color-alpha',
                'description' => esc_html__('Here you can define a custom color for your icon.', 'dmpro-divi-modules-pro'),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'timeline_icon_settings',
                'hover' => 'tabs',
                'mobile_options' => true,
                'sticky' => true,
                'default' => '#7d2ae8',
            ),
            'date_use_circle' => array(
                'label' => esc_html__('Circle Icon', 'dmpro-divi-modules-pro'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
                    'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
                ),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'timeline_icon_settings',
                'description' => esc_html__('Here you can choose whether icon set above should display within a circle.', 'dmpro-divi-modules-pro'),
                'default' => 'on',
            ),
            'date_circle_color' => array(
                'default' => $et_accent_color,
                'label' => esc_html__('Circle Color', 'dmpro-divi-modules-pro'),
                'type' => 'color-alpha',
                'description' => esc_html__('Here you can define a custom color for the icon circle.', 'dmpro-divi-modules-pro'),
                'show_if' => array(
                    'date_use_circle' => 'on',
                ),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'timeline_icon_settings',
                'hover' => 'tabs',
                'mobile_options' => true,
                'sticky' => true,
                'default' => '#f4f4f4',
            ),
            'date_use_circle_border' => array(
                'label' => esc_html__('Show Circle Border', 'dmpro-divi-modules-pro'),
                'type' => 'yes_no_button',
                'option_category' => 'layout',
                'options' => array(
                    'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
                    'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
                ),
                'description' => esc_html__('Here you can choose whether if the icon circle border should display.', 'dmpro-divi-modules-pro'),
                'show_if' => array(
                    'date_use_circle' => 'on',
                ),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'timeline_icon_settings',
                'default_on_front' => 'off',
            ),
            'date_circle_border_color' => array(
                'default' => $et_accent_color,
                'label' => esc_html__('Circle Border Color', 'dmpro-divi-modules-pro'),
                'type' => 'color-alpha',
                'description' => esc_html__('Here you can define a custom color for the icon circle border.', 'dmpro-divi-modules-pro'),
                'show_if' => array(
                    'date_use_circle_border' => 'on',
                ),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'timeline_icon_settings',
                'hover' => 'tabs',
                'mobile_options' => true,
                'sticky' => true,
                'default' => '#000',
            ),
            'date_use_icon_font_size' => array(
                'label' => esc_html__('Use Icon Font Size', 'dmpro-divi-modules-pro'),
                'description' => esc_html__('If you would like to control the size of the icon, you must first enable this option.', 'dmpro-divi-modules-pro'),
                'type' => 'yes_no_button',
                'option_category' => 'font_option',
                'options' => array(
                    'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
                    'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
                ),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'timeline_icon_settings',
                'default_on_front' => 'off',
            ),
            'timeline_icon_font_size' => array(
                'label' => esc_html__('Icon Font Size', 'dmpro-divi-modules-pro'),
                'description' => esc_html__('Control the size of the icon by increasing or decreasing the font size.', 'dmpro-divi-modules-pro'),
                'type' => 'range',
                'option_category' => 'font_option',
                'tab_slug' => 'advanced',
                'toggle_slug' => 'timeline_icon_settings',
                'default' => '96px',
                'default_unit' => 'px',
                'default_on_front' => '',
                'allowed_units' => array('%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
                'range_settings' => array(
                    'min' => '1',
                    'max' => '120',
                    'step' => '1',
                ),
                'show_if' => array(
                    'date_use_icon_font_size' => 'on',
                ),
                'mobile_options' => true,
                'sticky' => true,
                'responsive' => true,
                'hover' => 'tabs',
            ),
            'date_text_bgcolor' => array(
                'label' => esc_html__('Background Color of Date/Milestone', 'dmpro-divi-modules-pro'),
                'type' => 'color-alpha',
                'description' => esc_html__('Here you can define a custom color for the Date/Milestone Text.', 'dmpro-divi-modules-pro'),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'event_card',
                'sub_toggle' => 'date_text_settings',
                'hover' => 'tabs',
                'mobile_options' => true,
                'sticky' => true,
                'default' => 'transparent',
            ),
            'use_icon' => array(
                'label' => esc_html__('Use Icon', 'dmpro-divi-modules-pro'),
                'type' => 'yes_no_button',
                'option_category' => 'basic_option',
                'options' => array(
                    'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
                    'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
                ),
                'toggle_slug' => 'event_card',
                'sub_toggle' => 'image',
                'affects' => array(
                    'border_radii_image',
                    'border_styles_image',
                    'child_filter_hue_rotate',
                    'child_filter_saturate',
                    'child_filter_brightness',
                    'child_filter_contrast',
                    'child_filter_invert',
                    'child_filter_sepia',
                    'child_filter_opacity',
                    'child_filter_blur',
                    'child_mix_blend_mode',
                ),
                'description' => esc_html__('Here you can choose whether icon set below should be used.', 'dmpro-divi-modules-pro'),
                'default_on_front' => 'off',
            ),
            'font_icon' => array(
                'label' => esc_html__('Icon', 'dmpro-divi-modules-pro'),
                'type' => 'select_icon',
                'option_category' => 'basic_option',
                'class' => array('et-pb-font-icon'),
                'toggle_slug' => 'event_card',
                'sub_toggle' => 'image',
                'description' => esc_html__('Choose an icon to display with your timeline item.', 'dmpro-divi-modules-pro'),
                'show_if' => array(
                    'use_icon' => 'on',
                ),
                'mobile_options' => true,
                'hover' => 'tabs',
            ),
            'icon_color' => array(
                'default' => $et_accent_color,
                'label' => esc_html__('Icon Color', 'dmpro-divi-modules-pro'),
                'type' => 'color-alpha',
                'description' => esc_html__('Here you can define a custom color for your icon.', 'dmpro-divi-modules-pro'),
                'show_if' => array(
                    'use_icon' => 'on',
                ),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'icon_settings',
                'hover' => 'tabs',
                'mobile_options' => true,
                'sticky' => true,
                'default' => '#000',
            ),
            'use_circle' => array(
                'label' => esc_html__('Circle Icon', 'dmpro-divi-modules-pro'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => array(
                    'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
                    'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
                ),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'icon_settings',
                'description' => esc_html__('Here you can choose whether icon set above should display within a circle.', 'dmpro-divi-modules-pro'),
                'show_if' => array(
                    'use_icon' => 'on',
                ),
                'default_on_front' => 'off',
            ),
            'circle_color' => array(
                'default' => $et_accent_color,
                'label' => esc_html__('Circle Color', 'dmpro-divi-modules-pro'),
                'type' => 'color-alpha',
                'description' => esc_html__('Here you can define a custom color for the icon circle.', 'dmpro-divi-modules-pro'),
                'show_if' => array(
                    'use_circle' => 'on',
                ),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'icon_settings',
                'hover' => 'tabs',
                'mobile_options' => true,
                'sticky' => true,
                'default' => '#eee',
            ),
            'use_circle_border' => array(
                'label' => esc_html__('Show Circle Border', 'dmpro-divi-modules-pro'),
                'type' => 'yes_no_button',
                'option_category' => 'layout',
                'options' => array(
                    'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
                    'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
                ),
                'description' => esc_html__('Here you can choose whether if the icon circle border should display.', 'dmpro-divi-modules-pro'),
                'show_if' => array(
                    'use_circle' => 'on',
                ),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'icon_settings',
                'default_on_front' => 'off',
            ),
            'circle_border_color' => array(
                'default' => $et_accent_color,
                'label' => esc_html__('Circle Border Color', 'dmpro-divi-modules-pro'),
                'type' => 'color-alpha',
                'description' => esc_html__('Here you can define a custom color for the icon circle border.', 'dmpro-divi-modules-pro'),
                'show_if' => array(
                    'use_circle_border' => 'on',
                ),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'icon_settings',
                'hover' => 'tabs',
                'mobile_options' => true,
                'sticky' => true,
                'default' => '#000',
            ),
            'image' => array(
                'label' => esc_html__('Image', 'dmpro-divi-modules-pro'),
                'type' => 'upload',
                'option_category' => 'basic_option',
                'upload_button_text' => esc_html__('Upload an image', 'dmpro-divi-modules-pro'),
                'choose_text' => esc_attr__('Choose an Image', 'dmpro-divi-modules-pro'),
                'update_text' => esc_attr__('Set As Image', 'dmpro-divi-modules-pro'),
                'show_if' => array(
                    'use_icon' => 'off',
                ),
                'description' => esc_html__('Upload an image to display at the top of your timeline item.', 'dmpro-divi-modules-pro'),
                'toggle_slug' => 'event_card',
                'sub_toggle' => 'image',
                'dynamic_content' => 'image',
                'mobile_options' => true,
                'hover' => 'tabs',
            ),
            'alt' => array(
                'label' => esc_html__('Image Alt Text', 'dmpro-divi-modules-pro'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Define the HTML ALT text for your image here.', 'dmpro-divi-modules-pro'),
                'show_if' => array(
                    'use_icon' => 'off',
                ),
                'toggle_slug' => 'event_card',
                'sub_toggle' => 'image',
                'dynamic_content' => 'text',
            ),
            'icon_placement' => array(
                'label' => esc_html__('Image/Icon Placement', 'dmpro-divi-modules-pro'),
                'type' => 'select',
                'option_category' => 'layout',
                'options' => $image_icon_placement,
                'tab_slug' => 'advanced',
                'toggle_slug' => 'icon_settings',
                'description' => esc_html__('Here you can choose where to place the icon.', 'dmpro-divi-modules-pro'),
                'default_on_front' => 'top',
                'mobile_options' => true,
            ),
            'icon_alignment' => array(
                'label' => esc_html__('Image/Icon Alignment', 'dmpro-divi-modules-pro'),
                'description' => esc_html__('Align image/icon to the left, right or center.', 'dmpro-divi-modules-pro'),
                'type' => 'align',
                'option_category' => 'layout',
                'options' => et_builder_get_text_orientation_options(array('justified')),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'icon_settings',
                'default' => 'center',
                'mobile_options' => true,
                'sticky' => true,
                'show_if' => array(
                    'icon_placement' => 'top',
                ),
            ),
            'image_max_width' => array(
                'label' => esc_html__('Image Width', 'dmpro-divi-modules-pro'),
                'description' => esc_html__('Adjust the width of the image within the timeline item.', 'dmpro-divi-modules-pro'),
                'type' => 'range',
                'option_category' => 'layout',
                'tab_slug' => 'advanced',
                'toggle_slug' => 'width',
                'mobile_options' => true,
                'validate_unit' => true,
                'allowed_units' => array('%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
                'default' => '100%',
                'default_unit' => '%',
                'default_on_front' => '',
                'allow_empty' => true,
                'range_settings' => array(
                    'min' => '0',
                    'max' => '100',
                    'step' => '1',
                ),
                'responsive' => true,
                'sticky' => true,
            ),
            'use_icon_font_size' => array(
                'label' => esc_html__('Use Icon Font Size', 'dmpro-divi-modules-pro'),
                'description' => esc_html__('If you would like to control the size of the icon, you must first enable this option.', 'dmpro-divi-modules-pro'),
                'type' => 'yes_no_button',
                'option_category' => 'font_option',
                'options' => array(
                    'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
                    'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
                ),
                'show_if' => array(
                    'use_icon' => 'on',
                ),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'icon_settings',
                'default_on_front' => 'off',
            ),
            'icon_font_size' => array(
                'label' => esc_html__('Icon Font Size', 'dmpro-divi-modules-pro'),
                'description' => esc_html__('Control the size of the icon by increasing or decreasing the font size.', 'dmpro-divi-modules-pro'),
                'type' => 'range',
                'option_category' => 'font_option',
                'tab_slug' => 'advanced',
                'toggle_slug' => 'icon_settings',
                'default' => '96px',
                'default_unit' => 'px',
                'default_on_front' => '',
                'allowed_units' => array('%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
                'range_settings' => array(
                    'min' => '1',
                    'max' => '120',
                    'step' => '1',
                ),
                'mobile_options' => true,
                'sticky' => true,
                'show_if' => array(
                    'use_icon_font_size' => 'on',
                ),
                'responsive' => true,
                'hover' => 'tabs',
            ),
            'custom_card_arrow' => array(
                'label' => esc_html__('Use Custom Styling for Event Card Arrow', 'dmpro-divi-modules-pro'),
                'description' => esc_html__('Use different styling from parent setting for Event Card Arrow', 'dmpro-divi-modules-pro'),
                'type' => 'yes_no_button',
                'options' => array(
                    'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
                    'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
                ),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'event_card',
                'sub_toggle' => 'card_arrow_settings',
                'default_on_front' => 'off',
            ),
            'card_arrow_size' => array(
                'label' => esc_html__('Event Card Arrow Size', 'dmpro-divi-modules-pro'),
                'description' => esc_html__('Event Card Arrow Size', 'dmpro-divi-modules-pro'),
                'type' => 'range',
                'option_category' => 'configuration',
                'tab_slug' => 'advanced',
                'toggle_slug' => 'event_card',
                'sub_toggle' => 'card_arrow_settings',
                'default' => '12px',
                'default_unit' => '12x',
                'default_on_front' => '12px',
                'allowed_units' => array('em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
                'range_settings' => array(
                    'min' => '0',
                    'max' => '500',
                    'step' => '1',
                ),
                'mobile_options' => true,
                'sticky' => true,
                'hover' => 'tabs',
                'show_if' => array(
                    'custom_card_arrow' => 'on',
                ),
            ),
            'card_arrow_color' => array(
                'default' => $et_accent_color,
                'label' => esc_html__('Event Card Arrow Color', 'dmpro-divi-modules-pro'),
                'type' => 'color-alpha',
                'description' => esc_html__('Here you can define a custom color for card arrow.', 'dmpro-divi-modules-pro'),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'event_card',
                'sub_toggle' => 'card_arrow_settings',
                'default' => '#eaebec',
                'hover' => 'tabs',
                'mobile_options' => true,
                'sticky' => true,
                'show_if' => array(
                    'custom_card_arrow' => 'on',
                ),
            ),
            'card_width' => array(
                'label' => esc_html__('Event Card Width', 'dmpro-divi-modules-pro'),
                'type' => 'range',
                'option_category' => 'layout',
                'tab_slug' => 'advanced',
                'toggle_slug' => 'width',
                'validate_unit' => true,
                'default' => '100%',
                'default_unit' => '%',
                'allow_empty' => true,
                'responsive' => true,
                'mobile_options' => true,
            ),
            'card_max_width' => array(
                'label' => esc_html__('Event Card Max Width', 'dmpro-divi-modules-pro'),
                'description' => esc_html__('Adjust the width of the card within the timeline item.', 'dmpro-divi-modules-pro'),
                'type' => 'range',
                'option_category' => 'layout',
                'tab_slug' => 'advanced',
                'toggle_slug' => 'width',
                'mobile_options' => true,
                'validate_unit' => true,
                'default' => '550px',
                'default_unit' => 'px',
                'default_on_front' => '',
                'allowed_units' => array('%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
                'allow_empty' => true,
                'range_settings' => array(
                    'min' => '0',
                    'max' => '1100',
                    'step' => '1',
                ),
                'responsive' => true,
                'sticky' => true,
            ),
            'card_margin' => array(
                'label' => __('Event Card Margin', 'et_builder'),
                'type' => 'custom_margin',
                'description' => __('Set Margin of Event Card.', 'et_builder'),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'margin_padding',
                'mobile_options' => true,
            ),
            'card_padding' => array(
                'label' => __('Event Card Padding', 'et_builder'),
                'type' => 'custom_margin',
                'description' => __('Set Padding of Event Card.', 'et_builder'),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'margin_padding',
                'default' => '30px|30px|30px|30px',
                'mobile_options' => true,
            ),
            'card_content_padding' => array(
                'label' => __('Event Card Content Padding', 'et_builder'),
                'type' => 'custom_margin',
                'description' => __('Set Padding of Event Card Content.', 'et_builder'),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'margin_padding',
                'mobile_options' => true,
            ),
            'date_text_margin' => array(
                'label' => __('Date/Milestone Margin', 'et_builder'),
                'type' => 'custom_margin',
                'description' => __('Set Margin of Date/Milestone Text.', 'et_builder'),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'margin_padding',
                'mobile_options' => true,
            ),
            'date_text_padding' => array(
                'label' => __('Date/Milestone Padding', 'et_builder'),
                'type' => 'custom_margin',
                'description' => __('Set Padding of Date/Milestone Text.', 'et_builder'),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'margin_padding',
                'mobile_options' => true,
            ),
        );

        return $fields;
    }

    public function get_transition_fields_css_props()
    {
        $fields = parent::get_transition_fields_css_props();
        $fields['icon_color'] = array(
            'color' => '%%order_class%% .et-pb-icon',
        );

        $fields['circle_color'] = array(
            'background-color' => '%%order_class%% .et-pb-icon',
        );

        $fields['circle_border_color'] = array(
            'border-color' => '%%order_class%% .et-pb-icon',
        );

        $fields['icon_font_size'] = array(
            'font-size' => '%%order_class%% .et-pb-icon',
        );

        $fields['timeline_icon_color'] = array(
            'color' => '%%order_class%% .date-icon-wrap .date-icon',
        );

        $fields['date_circle_color'] = array(
            'background-color' => '%%order_class%% .date-icon-wrap .date-icon.date-icon-circle',
        );

        $fields['date_circle_border_color'] = array(
            'border-color' => '%%order_class%% .date-icon-wrap .date-icon.date-icon-circle-border',
        );

        $fields['timeline_icon_font_size'] = array(
            'font-size' => '%%order_class%% .date-icon',
        );

        $fields['body_text_color'] = array(
            'color' => '%%order_class%% .dmpro_timeline_item_description',
        );

        $fields['image_max_width'] = array(
            'width' => '%%order_class%% .dmpro_timeline_item_image, %%order_class%% .dmpro_timeline_item_image .et_pb_image_wrap',
            'max-width' => '%%order_class%% .dmpro_timeline_item_image, %%order_class%% .dmpro_timeline_item_image .et_pb_image_wrap',
        );

        $fields['card_max_width'] = array(
            'max-width' => '%%order_class%% .dmpro_timeline_item_card',
        );

        return $fields;
    }

    public function get_custom_style($slug_value, $type, $important)
    {
        return sprintf('%1$s: %2$s%3$s;', $type, $slug_value, $important ? ' !important' : '');
    }
    public function get_changed_prop_value($slug, $conv_matrix)
    {
        if (array_key_exists($this->props[$slug], $conv_matrix)) {
            $this->props[$slug] = $conv_matrix[$this->props[$slug]];
        }

    }
    public function apply_custom_style_for_phone(
        $function_name,
        $slug,
        $type,
        $class,
        $important = false,
        $zoom = '',
        $unit = '',
        $wrap_func = '' /* traslate, clac ... */
    ) {
        if (empty($this->props[$slug . '_tablet'])) {
            $this->props[$slug . '_tablet'] = $this->props[$slug];
        }
        if (empty($this->props[$slug . '_phone'])) {
            $this->props[$slug . '_phone'] = $this->props[$slug . '_tablet'];
        }
        if ($zoom === '') {
            $slug_value = $this->props[$slug] . $unit;
            $slug_value_tablet = $this->props[$slug . '_tablet'] . $unit;
            $slug_value_phone = $this->props[$slug . '_phone'] . $unit;
        } else {
            $slug_value = ((float) $this->props[$slug] * $zoom) . $unit;
            $slug_value_tablet = ((float) $this->props[$slug . '_tablet'] * $zoom) . $unit;
            $slug_value_phone = ((float) $this->props[$slug . '_phone'] * $zoom) . $unit;
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
        $unit = '',
        $wrap_func = '' /* traslate, clac ... */
    ) {
        if (empty($this->props[$slug . '_tablet'])) {
            $this->props[$slug . '_tablet'] = $this->props[$slug];
        }
        if ($zoom === '') {
            $slug_value = $this->props[$slug] . $unit;
            $slug_value_tablet = $this->props[$slug . '_tablet'] . $unit;
            $slug_value_phone = $this->props[$slug . '_phone'] . $unit;
        } else {
            $slug_value = ((float) $this->props[$slug] * $zoom) . $unit;
            $slug_value_tablet = ((float) $this->props[$slug . '_tablet'] * $zoom) . $unit;
            $slug_value_phone = ((float) $this->props[$slug . '_phone'] * $zoom) . $unit;
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
        $unit = '',
        $wrap_func = '' /* traslate, clac ... */
    ) {
        if ($zoom === '') {
            $slug_value = $this->props[$slug] . $unit;
            $slug_value_tablet = $this->props[$slug . '_tablet'] . $unit;
            $slug_value_phone = $this->props[$slug . '_phone'] . $unit;
        } else {
            $slug_value = ((float) $this->props[$slug] * $zoom) . $unit;
            $slug_value_tablet = ((float) $this->props[$slug . '_tablet'] * $zoom) . $unit;
            $slug_value_phone = ((float) $this->props[$slug . '_phone'] * $zoom) . $unit;
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

    public function apply_custom_style_for_hover(
        $function_name,
        $slug,
        $type,
        $class,
        $important = false
    ) {

        $slug_hover_enabled = isset($this->props[$slug . '__hover_enabled']) ? substr($this->props[$slug . '__hover_enabled'], 0, 2) === "on" : false;
        $slug_hover_value = isset($this->props[$slug . '__hover']) ? $this->props[$slug . '__hover'] : '';
        if (isset($slug_hover_value)
            && !empty($slug_hover_value)
            && $slug_hover_enabled) {
            ET_Builder_Element::set_style($function_name, array(
                'selector' => $class,
                'declaration' => $this->get_custom_style($slug_hover_value, $type, $important),
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
        $unit = '') {
        if ($zoom == '') {
            $slug_value = $this->props[$slug] . $unit;
            $slug_value_tablet = $this->props[$slug . '_tablet'] . $unit;
            $slug_value_phone = $this->props[$slug . '_phone'] . $unit;
        } else {
            $slug_value = ((float) $this->props[$slug] * $zoom) . $unit;
            $slug_value_tablet = ((float) $this->props[$slug . '_tablet'] * $zoom) . $unit;
            $slug_value_phone = ((float) $this->props[$slug . '_phone'] * $zoom) . $unit;
        }

        $slug_value_last_edited = $this->props[$slug . '_last_edited'];
        $slug_value_responsive_active = et_pb_get_responsive_status($slug_value_last_edited);

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
        $slug_value = $this->props[$slug];
        $slug_value_tablet = $this->props[$slug . '_tablet'];
        $slug_value_phone = $this->props[$slug . '_phone'];
        $slug_value_last_edited = $this->props[$slug . '_last_edited'];
        $slug_value_responsive_active = et_pb_get_responsive_status($slug_value_last_edited);

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
    private function replaceEmptyWith($array, $replaceValue)
    {
        foreach ($array as $key => $value) {
            if (empty($value)) {
                $array[$key] = $replaceValue;
            }
        }
        return $array;
    }
    public function render($attrs, $content, $render_slug)
    {
        wp_enqueue_style("dmpro-".$this->slug, plugin_dir_url(__FILE__) . 'style.css', [], "1.0.0", 'all');
        $multi_view = et_pb_multi_view_options($this);
        $sticky = et_pb_sticky_options();
        $is_sticky_module = $sticky->is_sticky_module($this->props);
        $url = $this->props['url'];
        $image = $this->props['image'];
        $url_new_window = $this->props['url_new_window'];

        $button_url = $this->props['button_url'];
        $button_rel = $this->props['button_rel'];
        $button_text = $this->_esc_attr('button_text', 'limited');
        $button_url_new_window = $this->props['button_url_new_window'];
        $button_custom = $this->props['custom_button'];
        $custom_icon_values = et_pb_responsive_options()->get_property_values($this->props, 'button_icon');
        $custom_icon = isset($custom_icon_values['desktop']) ? $custom_icon_values['desktop'] : '';
        $custom_icon_tablet = isset($custom_icon_values['tablet']) ? $custom_icon_values['tablet'] : '';
        $custom_icon_phone = isset($custom_icon_values['phone']) ? $custom_icon_values['phone'] : '';
        $button_url = trim($button_url);

        $alt = $this->_esc_attr('alt');
        $font_icon = $this->props['font_icon'];
        $timeline_icon = $this->props['timeline_icon'];
        $use_icon = $this->props['use_icon'];
        $use_circle = $this->props['use_circle'];
        $use_circle_border = $this->props['use_circle_border'];
        $use_icon_font_size = $this->props['use_icon_font_size'];
        $date_use_circle = $this->props['date_use_circle'];
        $date_use_circle_border = $this->props['date_use_circle_border'];
        $date_use_icon_font_size = $this->props['date_use_icon_font_size'];
        $header_level = $this->props['header_level'];
        $icon_font_size_last_edited = $this->props['icon_font_size_last_edited'];
        $timeline_icon_font_size_last_edited = $this->props['timeline_icon_font_size_last_edited'];
        $image_max_width = $this->props['image_max_width'];
        $image_max_width_sticky = $sticky->get_value('image_max_width', $this->props, '');
        $image_max_width_tablet = $this->props['image_max_width_tablet'];
        $image_max_width_phone = $this->props['image_max_width_phone'];
        $image_max_width_last_edited = $this->props['image_max_width_last_edited'];
        $card_max_width = $this->props['card_max_width'];
        $card_max_width_sticky = $sticky->get_value('card_max_width', $this->props, '');
        $card_max_width_tablet = $this->props['card_max_width_tablet'];
        $card_max_width_phone = $this->props['card_max_width_phone'];
        $card_max_width_last_edited = $this->props['card_max_width_last_edited'];
        $custom_card_arrow = $this->props['custom_card_arrow'];

        $icon_placement = $this->props['icon_placement'];
        $icon_placement_values = et_pb_responsive_options()->get_property_values($this->props, 'icon_placement');
        $icon_placement_tablet = isset($icon_placement_values['tablet']) ? $icon_placement_values['tablet'] : '';
        $icon_placement_phone = isset($icon_placement_values['phone']) ? $icon_placement_values['phone'] : '';
        $is_icon_placement_responsive = et_pb_responsive_options()->is_responsive_enabled($this->props, 'icon_placement');
        $is_icon_placement_top = !$is_icon_placement_responsive ? 'top' === $icon_placement : in_array('top', $icon_placement_values);
        $image_pathinfo = pathinfo($image);
        $is_image_svg = isset($image_pathinfo['extension']) ? 'svg' === $image_pathinfo['extension'] : false;

        $icon_selector = '%%order_class%% .et-pb-icon';
        $timeline_icon_selector = '%%order_class%% .date-icon';
        $timeline_icon_hover_selector = '%%order_class%%:hover .date-icon,%%order_class%% .date-icon.active';
        $timeline_icon_circle_selector = '%%order_class%% .date-icon.date-icon-circle';
        $timeline_icon_circle_hover_selector = '%%order_class%%:hover .date-icon.date-icon-circle,%%order_class%% .date-icon.date-icon-circle.active';

        $card_margin_responsive_status = et_pb_get_responsive_status($this->props['card_margin_last_edited']);
        $card_margin = ($this->props['card_margin']) ? $this->props['card_margin'] : '';
        $card_margin_tablet = ($card_margin_responsive_status && isset($this->props['card_margin_tablet']) && $this->props['card_margin_tablet'] !== '') ? $this->props['card_margin_tablet'] : $card_margin;
        $card_margin_phone = ($card_margin_responsive_status && isset($this->props['card_margin_phone']) && $this->props['card_margin_phone'] !== '') ? $this->props['card_margin_phone'] : $card_margin_tablet;

        $card_margin = explode("|", $card_margin);
        $card_margin_tablet = explode("|", $card_margin_tablet);
        $card_margin_phone = explode("|", $card_margin_phone);

        $card_margin = $this->replaceEmptyWith($card_margin, "0");
        $card_margin_tablet = $this->replaceEmptyWith($card_margin_tablet, "0");
        $card_margin_phone = $this->replaceEmptyWith($card_margin_phone, "0");


        $this->apply_custom_margin_padding(
            $this->slug,
            'card_margin',
            'margin',
            '%%order_class%% .dmpro_timeline_item_card'
        );
        $this->apply_custom_margin_padding(
            $this->slug,
            'card_padding',
            'padding',
            '%%order_class%% .dmpro_timeline_item_card'
        );
        $this->apply_custom_style($this->slug,
            'card_width',
            'width',
            '%%order_class%% .dmpro_timeline_item_card'
        );
        $this->apply_custom_margin_padding(
            $this->slug,
            'card_content_padding',
            'padding',
            '%%order_class%% .dmpro_timeline_item_card .dmpro_timeline_item_content'
        );
        $this->apply_custom_margin_padding(
            $this->slug,
            'date_text_margin',
            'margin',
            '%%order_class%% .dmpro_timeline_date .dmpro_timeline_date_text'
        );
        $this->apply_custom_margin_padding(
            $this->slug,
            'date_text_padding',
            'padding',
            '%%order_class%% .dmpro_timeline_date .dmpro_timeline_date_text'
        );

        if ($is_icon_placement_top) {
            $is_icon = 'on' === $use_icon;
            $icon_alignment = $this->props['icon_alignment'];
            $icon_alignment_values = et_pb_responsive_options()->get_property_values($this->props, 'icon_alignment');
            $icon_alignment_last_edited = $this->props['icon_alignment_last_edited'];
            $icon_alignment_margins = array(
                'left' => 'auto auto auto 0',
                'center' => 'auto',
                'right' => 'auto 0 auto auto',
            );

            $icon_alignment_selector = '%%order_class%% .dmpro_timeline_item_image';
            $image_alignment_selector = '%%order_class%% .dmpro_timeline_item_image .et_pb_image_wrap';

            if (et_pb_get_responsive_status($icon_alignment_last_edited) && '' !== implode('', $icon_alignment_values)) {
                et_pb_responsive_options()->generate_responsive_css(
                    $icon_alignment_values,
                    $icon_alignment_selector,
                    'text-align',
                    $render_slug,
                    '',
                    'align'
                );

                if (!$is_icon) {
                    $image_alignment_values = array();

                    foreach ($icon_alignment_values as $breakpoint => $alignment) {
                        $image_alignment_values[$breakpoint] = et_()->array_get(
                            $icon_alignment_margins,
                            $alignment,
                            ''
                        );
                    }

                    // Image alignment style
                    et_pb_responsive_options()->generate_responsive_css(
                        $image_alignment_values,
                        $image_alignment_selector,
                        'margin',
                        $render_slug,
                        '',
                        'align'
                    );
                }
            } else {

                if (in_array($icon_alignment, array('left', 'right'))) {
                    $icon_alignment_prop_value = $is_icon ? $icon_alignment : et_()->array_get($icon_alignment_margins, $icon_alignment, '');

                    $el_style = array(
                        'selector' => $icon_alignment_selector,
                        'declaration' => sprintf(
                            'text-align: %1$s;',
                            esc_html($icon_alignment)
                        ),
                    );
                    ET_Builder_Element::set_style($render_slug, $el_style);

                    if (!$is_icon) {
                        $el_style = array(
                            'selector' => $image_alignment_selector,
                            'declaration' => sprintf(
                                'margin: %1$s;',
                                esc_html(et_()->array_get($icon_alignment_margins, $icon_alignment, ''))
                            ),
                        );
                        ET_Builder_Element::set_style($render_slug, $el_style);
                    }
                }
            }
        }

        if ('off' !== $use_icon_font_size) {
            $this->generate_styles(
                array(
                    'base_attr_name' => 'icon_font_size',
                    'selector' => $icon_selector,
                    'css_property' => 'font-size',
                    'render_slug' => $render_slug,
                    'type' => 'range',
                    'important' => true,
                )
            );
        }

        if ('' !== $image_max_width_tablet || '' !== $image_max_width_phone || '' !== $image_max_width || '' !== $image_max_width_sticky || $is_image_svg) {
            $is_size_px = false;

            if (
                false !== strpos($image_max_width, 'px') ||
                false !== strpos($image_max_width_tablet, 'px') ||
                false !== strpos($image_max_width_phone, 'px')
            ) {
                $is_size_px = true;
            }
            if ('' === $image_max_width && $is_image_svg) {
                $image_max_width = '100%';
            }

            $image_max_width_selectors = array();
            $image_max_width_reset_selectors = array();
            $image_max_width_reset_values = array();

            $image_max_width_selector = $icon_placement === 'top' && $is_image_svg ? '%%order_class%% .dmpro_timeline_item_image' : '%%order_class%% .dmpro_timeline_item_image .et_pb_image_wrap';

            foreach (array('tablet', 'phone') as $device) {
                $device_icon_placement = 'tablet' === $device ? $icon_placement_tablet : $icon_placement_phone;
                if (empty($device_icon_placement)) {
                    continue;
                }

                $image_max_width_selectors[$device] = 'top' === $device_icon_placement && $is_image_svg ? '%%order_class%% .dmpro_timeline_item_image' : '%%order_class%% .dmpro_timeline_item_image .et_pb_image_wrap';

                $prev_icon_placement = 'tablet' === $device ? $icon_placement : $icon_placement_tablet;
                if (empty($prev_icon_placement) || $prev_icon_placement === $device_icon_placement || !$is_image_svg) {
                    continue;
                }

                $image_max_width_reset_selectors[$device] = '%%order_class%% .dmpro_timeline_item_image';
                $image_max_width_reset_values[$device] = array('width' => '32px');

                if ('top' === $device_icon_placement) {
                    $image_max_width_reset_selectors[$device] = '%%order_class%% .dmpro_timeline_item_image .et_pb_image_wrap';
                    $image_max_width_reset_values[$device] = array('width' => 'auto');
                }
            }

            if (!empty($image_max_width_selectors)) {
                $image_max_width_selectors['desktop'] = $image_max_width_selector;
            }

            $image_max_width_property = ($is_image_svg || $is_size_px) ? 'width' : 'max-width';

            $image_max_width_responsive_active = et_pb_get_responsive_status($image_max_width_last_edited);

            $image_max_width_values = array(
                'desktop' => $image_max_width,
                'tablet' => $image_max_width_responsive_active ? $image_max_width_tablet : '',
                'phone' => $image_max_width_responsive_active ? $image_max_width_phone : '',
            );

            $main_image_max_width_selector = $image_max_width_selector;

            if (!empty($image_max_width_selectors)) {
                $main_image_max_width_selector = $image_max_width_selectors;

                if (!empty($image_max_width_selectors['tablet']) && empty($image_max_width_values['tablet'])) {
                    $image_max_width_values['tablet'] = $image_max_width_responsive_active ? esc_attr(et_pb_responsive_options()->get_any_value($this->props, 'image_max_width_tablet', '100%', true)) : esc_attr($image_max_width);
                }

                if (!empty($image_max_width_selectors['phone']) && empty($image_max_width_values['phone'])) {
                    $image_max_width_values['phone'] = $image_max_width_responsive_active ? esc_attr(et_pb_responsive_options()->get_any_value($this->props, 'image_max_width_phone', '100%', true)) : esc_attr($image_max_width);
                }
            }

            et_pb_responsive_options()->generate_responsive_css($image_max_width_values, $main_image_max_width_selector, $image_max_width_property, $render_slug);

            if (!empty($image_max_width_selectors) && !empty($image_max_width_reset_selectors)) {
                et_pb_responsive_options()->generate_responsive_css($image_max_width_reset_values, $image_max_width_reset_selectors, $image_max_width_property, $render_slug, '', 'input');
            }

            if (!empty($image_max_width_sticky)) {
                $sticky_main_image_max_width_selector = array();
                $sticky_image_max_width_reset_selectors = array();
                $sticky_image_max_width_property = ($is_image_svg || false !== strpos($image_max_width_sticky, 'px')) ? 'width' : 'max-width';

                if (is_array($main_image_max_width_selector)) {
                    foreach ($main_image_max_width_selector as $device => $selector) {
                        $sticky_main_image_max_width_selector[$device] = $sticky->add_sticky_to_selectors($selector, $is_sticky_module);
                    }
                } else {
                    $sticky_main_image_max_width_selector = $sticky->add_sticky_to_selectors($main_image_max_width_selector, $is_sticky_module);
                }

                if (!empty($image_max_width_reset_selectors)) {
                    foreach ($image_max_width_reset_selectors as $device => $selector) {
                        $sticky_image_max_width_reset_selectors[$device] = $sticky->add_sticky_to_selectors($selector, $is_sticky_module);
                    }
                }

                et_pb_responsive_options()->generate_responsive_css(array_fill_keys(array('desktop', 'phone', 'tablet'), $image_max_width_sticky), $sticky_main_image_max_width_selector, $sticky_image_max_width_property, $render_slug);

                if (!empty($image_max_width_reset_values) && !empty($sticky_image_max_width_reset_selectors)) {
                    et_pb_responsive_options()->generate_responsive_css($image_max_width_reset_values, $sticky_image_max_width_reset_selectors, $sticky_image_max_width_property, $render_slug, '', 'input');
                }
            }
        }

        if ('' !== $card_max_width_tablet || '' !== $card_max_width_phone || '' !== $card_max_width) {
            $card_max_width_responsive_active = et_pb_get_responsive_status($card_max_width_last_edited);

            $card_max_width_values = array(
                'desktop' => $card_max_width,
                'tablet' => $card_max_width_responsive_active ? $card_max_width_tablet : '',
                'phone' => $card_max_width_responsive_active ? $card_max_width_phone : '',
            );

            et_pb_generate_responsive_css($card_max_width_values, '%%order_class%% .dmpro_timeline_item_card', 'max-width', $render_slug);
        }

        if (!empty($card_max_width_sticky)) {
            ET_Builder_Element::set_style(
                $render_slug,
                array(
                    'selector' => $sticky->add_sticky_to_selectors('%%order_class%% .dmpro_timeline_item_card', $is_sticky_module),
                    'declaration' => sprintf(
                        'max-width: %1$s;',
                        esc_html($card_max_width_sticky)
                    ),
                )
            );
        }

        if (is_rtl() && 'left' === $icon_placement) {
            $icon_placement = 'right';
        }

        if (is_rtl() && 'left' === $icon_placement_tablet) {
            $icon_placement_tablet = 'right';
        }

        if (is_rtl() && 'left' === $icon_placement_phone) {
            $icon_placement_phone = 'right';
        }

        $date_tag = 'span';
        $date_attrs = array();
        $date_attrs['class'] = "dmpro_timeline_date_text";
        $date = $multi_view->render_element(
            array(
                'tag' => $date_tag,
                'content' => '{{date}}',
                'attrs' => $date_attrs,
            )
        );

        $date = sprintf(
            '<div class="dmpro_timeline_date">%1$s</div>',
            et_core_esc_previously($date)
        );

        $title_tag = '' !== $url ? 'a' : 'span';
        $title_attrs = array();

        if ('a' === $title_tag) {
            $title_attrs['href'] = $url;

            if ('on' === $url_new_window) {
                $title_attrs['target'] = '_blank';
            }
        }

        $title = $multi_view->render_element(
            array(
                'tag' => $title_tag,
                'content' => '{{title}}',
                'attrs' => $title_attrs,
            )
        );

        if ('' !== $title) {
            $title = sprintf(
                '<%1$s class="dmpro_timeline_item_header">%2$s</%1$s>',
                et_pb_process_header_level($header_level, 'h4'),
                et_core_esc_previously($title)
            );
        }

        $image_classes = array();

        $image_attachment_class = et_pb_media_options()->get_image_attachment_class($this->props, 'image');

        if (!empty($image_attachment_class)) {
            $image_classes[] = esc_attr($image_attachment_class);
        }

        if ('off' === $use_icon) {
            $image = $multi_view->render_element(
                array(
                    'tag' => 'img',
                    'attrs' => array(
                        'src' => '{{image}}',
                        'class' => implode(' ', $image_classes),
                        'alt' => $alt,
                    ),
                    'required' => 'image',
                )
            );
        } else {
            $this->generate_styles(
                array(
                    'base_attr_name' => 'icon_color',
                    'selector' => $icon_selector,
                    'css_property' => 'color',
                    'render_slug' => $render_slug,
                    'type' => 'color',
                )
            );

            if ('on' === $use_circle) {
                $this->generate_styles(
                    array(
                        'base_attr_name' => 'circle_color',
                        'selector' => $icon_selector,
                        'css_property' => 'background-color',
                        'render_slug' => $render_slug,
                        'type' => 'color',
                    )
                );

                if ('on' === $use_circle_border) {
                    $this->generate_styles(
                        array(
                            'base_attr_name' => 'circle_border_color',
                            'selector' => $icon_selector,
                            'css_property' => 'border-color',
                            'render_slug' => $render_slug,
                            'type' => 'color',
                        )
                    );
                }
            }

            $image_classes[] = 'et-pb-icon';

            if ('on' === $use_circle) {
                $image_classes[] = 'et-pb-icon-circle';
            }

            if ('on' === $use_circle && 'on' === $use_circle_border) {
                $image_classes[] = 'et-pb-icon-circle-border';
            }

            $image = $multi_view->render_element(
                array(
                    'content' => '{{font_icon}}',
                    'attrs' => array(
                        'class' => implode(' ', $image_classes),
                    ),
                )
            );
        }

        $this->generate_styles(
            array(
                'base_attr_name' => 'date_text_bgcolor',
                'selector' => '%%order_class%% .dmpro_timeline_date .dmpro_timeline_date_text ',
                'css_property' => 'background-color',
                'render_slug' => $render_slug,
                'type' => 'color',
            )
        );
        $generate_css_image_filters = '';
        if ($image && array_key_exists('icon_settings', $this->advanced_fields) && array_key_exists('css', $this->advanced_fields['icon_settings'])) {
            $generate_css_image_filters = $this->generate_css_filters(
                $render_slug,
                'child_',
                self::$data_utils->array_get($this->advanced_fields['icon_settings']['css'], 'main', '%%order_class%%')
            );
        }

        $image = $image ? sprintf('<span class="et_pb_image_wrap">%1$s</span>', $image) : '';
        $image = $image ? sprintf(
            '<div class="dmpro_timeline_item_image%2$s">%1$s</div>',
            ('' !== $url
                ? sprintf(
                    '<a href="%1$s"%3$s>%2$s</a>',
                    esc_attr($url),
                    $image,
                    ('on' === $url_new_window ? ' target="_blank"' : '')
                )
                : $image
            ),
            esc_attr($generate_css_image_filters)
        ) : '';

        if ('off' !== $date_use_icon_font_size) {
            $this->generate_styles(
                array(
                    'base_attr_name' => 'timeline_icon_font_size',
                    'selector' => $timeline_icon_selector,
                    'css_property' => 'font-size',
                    'render_slug' => $render_slug,
                    'type' => 'range',
                )
            );
        }
        $this->generate_styles(
            array(
                'base_attr_name' => 'timeline_icon_color',
                'selector' => $timeline_icon_selector,
                'css_property' => 'color',
                'render_slug' => $render_slug,
                'type' => 'color',
            )
        );
        $this->apply_custom_style_for_hover(
            $this->slug,
            'timeline_icon_color',
            'color',
            $timeline_icon_hover_selector
        );

        if ('on' === $date_use_circle) {
            $this->generate_styles(
                array(
                    'base_attr_name' => 'date_circle_color',
                    'selector' => $timeline_icon_circle_selector,
                    'css_property' => 'background-color',
                    'render_slug' => $render_slug,
                    'type' => 'color',
                )
            );
            $this->apply_custom_style_for_hover(
                $this->slug,
                'date_circle_color',
                'background-color',
                $timeline_icon_circle_hover_selector
            );

            if ('on' === $date_use_circle_border) {
                $this->generate_styles(
                    array(
                        'base_attr_name' => 'date_circle_border_color',
                        'selector' => $timeline_icon_circle_selector,
                        'css_property' => 'border-color',
                        'render_slug' => $render_slug,
                        'type' => 'color',
                    )
                );
                $this->apply_custom_style_for_hover(
                    $this->slug,
                    'date_circle_border_color',
                    'border-color',
                    $timeline_icon_circle_hover_selector
                );
            }
        }

        $timeline_icon_classes[] = 'date-icon';

        if ('on' === $date_use_circle) {
            $timeline_icon_classes[] = 'date-icon-circle';
        }

        if ('on' === $date_use_circle && 'on' === $date_use_circle_border) {
            $timeline_icon_classes[] = 'date-icon-circle-border';
        }

        $timeline_icon = $multi_view->render_element(
            array(
                'content' => '',
                'attrs' => array(
                    'data-icon' => esc_attr(et_pb_process_font_icon($timeline_icon)),
                    'class' => implode(' ', $timeline_icon_classes),
                ),
            )
        );
        $timeline_icon = $timeline_icon ? sprintf('<div class="et_pb_image_wrap date-icon-wrap">%1$s</div>', $timeline_icon) : '';
        $video_background = $this->video_background();
        $parallax_image_background = $this->get_parallax_image_background();

        $module_custom_classes = 'dmpro_timeline_item_custom_classes';

        $module_custom_classes .= $this->get_text_orientation_classname();

        $module_custom_classes .= sprintf(' dmpro_timeline_item_position_%1$s', esc_attr($icon_placement));

        $background_layout_class_names = et_pb_background_layout_options()->get_background_layout_class($this->props);

        $module_custom_classes .= " " . implode(" ", $background_layout_class_names);

        if (!empty($icon_placement_tablet)) {
            $module_custom_classes .= " dmpro_timeline_item_position_{$icon_placement_tablet}_tablet";
        }

        if (!empty($icon_placement_phone)) {
            $module_custom_classes .= " dmpro_timeline_item_position_{$icon_placement_phone}_phone";
        }

        if ($custom_card_arrow == 'on') {
            $module_custom_classes .= " dmpro_timeline_item_custom-card-arrow";
        }

        $button = $this->render_button(
            array(
                'button_classname' => array('dmpro_timeline_item_button'),
                'button_custom' => $button_custom,
                'button_rel' => $button_rel,
                'button_text' => $button_text,
                'button_text_escaped' => true,
                'button_url' => $button_url,
                'custom_icon' => $custom_icon,
                'custom_icon_tablet' => $custom_icon_tablet,
                'custom_icon_phone' => $custom_icon_phone,
                'url_new_window' => $button_url_new_window,
                'display_button' => ('' !== $button_url && $multi_view->has_value('button_text')),
                'multi_view_data' => $multi_view->render_attrs(
                    array(
                        'content' => '{{button_text}}',
                        'visibility' => array(
                            'button_text' => '__not_empty',
                            'button_url' => '__not_empty',
                        ),
                    )
                ),
            )
        );

        $data_background_layout = et_pb_background_layout_options()->get_background_layout_attrs($this->props);

        $content = $multi_view->render_element(
            array(
                'tag' => 'div',
                'content' => '{{content}}',
                'attrs' => array(
                    'class' => 'dmpro_timeline_item_description',
                ),
            )
        );

        $this->generate_styles(
            array(
                'base_attr_name' => 'card_arrow_color',
                'selector' => '%%order_class%% .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_card-wrap:after',
                'css_property' => 'border-right-color',
                'render_slug' => $render_slug,
                'type' => 'color',
            )
        );
        $this->generate_styles(
            array(
                'base_attr_name' => 'card_arrow_color',
                'selector' => '%%order_class%% .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_card-wrap:after',
                'css_property' => 'border-left-color',
                'render_slug' => $render_slug,
                'type' => 'color',
            )
        );
        $this->generate_styles(
            array(
                'base_attr_name' => 'card_arrow_size',
                'selector' => '%%order_class%% .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_card-wrap:after',
                'css_property' => 'border-width',
                'render_slug' => $render_slug,
                'type' => 'range',
                'important' => true,
            )
        );
        $this->apply_custom_style_for_desktop(
            $this->slug,
            'card_arrow_size',
            'left',
            '.dmpro_timeline_layout_right .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item .dmpro_timeline_item_custom-card-arrow  .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       .dmpro_timeline_layout_mixed.startpos-right .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
       .dmpro_timeline_layout_mixed.startpos-left .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
      ',
            false,
            -1,
            'px'
        );

        $this->apply_custom_style_for_tablet(
            $this->slug,
            'card_arrow_size',
            'left',
            '.dmpro_timeline .dmpro_timeline_layout_right_tablet .dmpro_timeline_container .dmpro-timeline-items:nth-child(odd) %%order_class%%.dmpro_timeline_item .dmpro_timeline_item_custom-card-arrow  .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
      .dmpro_timeline .dmpro_timeline_layout_right_tablet .dmpro_timeline_container .dmpro-timeline-items:nth-child(even) %%order_class%%.dmpro_timeline_item .dmpro_timeline_item_custom-card-arrow  .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
      .dmpro_timeline .dmpro_timeline_layout_mixed_tablet.startpos-right .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
      .dmpro_timeline .dmpro_timeline_layout_mixed_tablet.startpos-left .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
      ',
            false,
            -1,
            'px'
        );
        $this->apply_custom_style_for_phone(
            $this->slug,
            'card_arrow_size',
            'left',
            'div.et_pb_module.dmpro_timeline .dmpro_timeline_layout_right_phone .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
      div.et_pb_module.dmpro_timeline .dmpro_timeline_layout_right_phone .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
      div.et_pb_module.dmpro_timeline .dmpro_timeline_layout_mixed_phone.startpos-right .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
      div.et_pb_module.dmpro_timeline .dmpro_timeline_layout_mixed_phone.startpos-left .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
      ',
            false,
            -1,
            'px'
        );
        if (isset($card_margin) && count($card_margin) >= 4) {
            ET_Builder_Element::set_style($this->slug, array(
                'selector' => '.dmpro_timeline_layout_right.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
				.dmpro_timeline_layout_mixed.startpos-right.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
				.dmpro_timeline_layout_mixed.startpos-left.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
        ',
                'declaration' => "transform: translate($card_margin[3], -50%);",
            ));
        }
        if (isset($card_margin_tablet) && count($card_margin_tablet) >= 4) {
            ET_Builder_Element::set_style($this->slug, array(
                'selector' => '.dmpro_timeline .dmpro_timeline_layout_right_tablet.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items:nth-child(odd) %%order_class%%.dmpro_timeline_item .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
				.dmpro_timeline .dmpro_timeline_layout_right_tablet.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items:nth-child(even) %%order_class%%.dmpro_timeline_item .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
				.dmpro_timeline .dmpro_timeline_layout_mixed_tablet.startpos-right.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
				.dmpro_timeline .dmpro_timeline_layout_mixed_tablet.startpos-left.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
          ',
                'declaration' => "transform: translate($card_margin_tablet[3], -50%);",
                'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
            ));
        }
        if (isset($card_margin_phone) && count($card_margin_phone) >= 4) {
            ET_Builder_Element::set_style($this->slug, array(
                'selector' => 'div.et_pb_module.dmpro_timeline .dmpro_timeline_layout_right_phone.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
				div.et_pb_module.dmpro_timeline .dmpro_timeline_layout_right_phone.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
				div.et_pb_module.dmpro_timeline .dmpro_timeline_layout_mixed_phone.dmpro_timeline_show-card-arrow.startpos-right .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
				div.et_pb_module.dmpro_timeline .dmpro_timeline_layout_mixed_phone.dmpro_timeline_show-card-arrow.startpos-left .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
          ',
                'declaration' => "transform: translate($card_margin_phone[3], -50%);",
                'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
            ));
        }

        $this->apply_custom_style_for_desktop(
            $this->slug,
            'card_arrow_size',
            'right',
            '.dmpro_timeline_layout_left .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item.dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
      .dmpro_timeline_layout_mixed.startpos-right .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
      .dmpro_timeline_layout_mixed.startpos-left .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
      ',
            false,
            -1,
            'px'
        );

        $this->apply_custom_style_for_tablet(
            $this->slug,
            'card_arrow_size',
            'right',
            '.dmpro_timeline .dmpro_timeline_layout_left_tablet .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
      .dmpro_timeline .dmpro_timeline_layout_left_tablet .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
      .dmpro_timeline .dmpro_timeline_layout_mixed_tablet.startpos-right .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
      .dmpro_timeline .dmpro_timeline_layout_mixed_tablet.startpos-left .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
      ',
            false,
            -1,
            'px'
        );
        $this->apply_custom_style_for_phone(
            $this->slug,
            'card_arrow_size',
            'right',
            'div.et_pb_module.dmpro_timeline .dmpro_timeline_layout_left_phone .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
      div.et_pb_module.dmpro_timeline .dmpro_timeline_layout_left_phone .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
      div.et_pb_module.dmpro_timeline .dmpro_timeline_layout_mixed_phone.startpos-right .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
      div.et_pb_module.dmpro_timeline .dmpro_timeline_layout_mixed_phone.startpos-left .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_custom-card-arrow .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
      ',
            false,
            -1,
            'px'
        );

        if (isset($card_margin) && count($card_margin) >= 4) {
            ET_Builder_Element::set_style($this->slug, array(
                'selector' => '.dmpro_timeline_layout_left.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
				.dmpro_timeline_layout_mixed.startpos-right.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
				.dmpro_timeline_layout_mixed.startpos-left.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd)  .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
          ',
                'declaration' => "transform: translate(-$card_margin[1], -50%);",
            ));
        }
        if (isset($card_margin_tablet) && count($card_margin_tablet) >= 4) {
            ET_Builder_Element::set_style($this->slug, array(
                'selector' => '.dmpro_timeline .dmpro_timeline_layout_left_tablet.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
				.dmpro_timeline .dmpro_timeline_layout_left_tablet.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
				.dmpro_timeline .dmpro_timeline_layout_mixed_tablet.startpos-right.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
				.dmpro_timeline .dmpro_timeline_layout_mixed_tablet.startpos-left.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
          ',
                'declaration' => "transform: translate(-$card_margin_tablet[1], -50%);",
                'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
            ));
        }
        if (isset($card_margin_phone) && count($card_margin_phone) >= 4) {
            ET_Builder_Element::set_style($this->slug, array(
                'selector' => 'div.et_pb_module.dmpro_timeline .dmpro_timeline_layout_left_phone.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
				div.et_pb_module.dmpro_timeline .dmpro_timeline_layout_left_phone.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
				div.et_pb_module.dmpro_timeline .dmpro_timeline_layout_mixed_phone.startpos-right.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(even) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after,
				div.et_pb_module.dmpro_timeline .dmpro_timeline_layout_mixed_phone.startpos-left.dmpro_timeline_show-card-arrow .dmpro_timeline_container .dmpro-timeline-items %%order_class%%.dmpro_timeline_item:nth-child(odd) .dmpro_timeline_item_container .dmpro_timeline_item_card-wrap:after
          ',
                'declaration' => "transform: translate(-$card_margin_phone[1], -50%);",
                'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
            ));
        }
        $output = sprintf(
            '<div class="%12$s">
        <div class="dmpro_timeline_item_container">
          %9$s
          %11$s
          <div class="dmpro_timeline_item_card-wrap">
            <div class="dmpro_timeline_item_card">
              %2$s
              <div class="dmpro_timeline_item_content">
                %9$s
                <div class="dmpro_timeline_item_content_text">
                  %3$s
                  %1$s
                </div>
                %10$s
              </div> <!-- .dmpro_timeline_item_content -->
            </div> <!-- .dmpro_timeline_item_card -->
          </div>
        </div>
      </div>
		',
            $content,
            et_core_esc_previously($image),
            et_core_esc_previously($title),
            $this->module_classname($render_slug),
            '', 
            $video_background,
            $parallax_image_background,
            et_core_esc_previously($data_background_layout),
            et_core_esc_previously($date),
            $button,
            et_core_esc_previously($timeline_icon),
            $module_custom_classes
        );

        return $output;
    }
    public function multi_view_filter_value($raw_value, $args, $multi_view)
    {
        $name = isset($args['name']) ? $args['name'] : '';
        $mode = isset($args['mode']) ? $args['mode'] : '';

        if ($raw_value && 'font_icon' === $name) {
            $processed_value = html_entity_decode(et_pb_process_font_icon($raw_value));
            if ('%%1%%' === $raw_value) {
                $processed_value = '"';
            }

            return $processed_value;
        }

        $fields_need_escape = array(
            'button_text',
        );

        if ($raw_value && in_array($name, $fields_need_escape, true)) {
            return $this->_esc_attr($multi_view->get_name_by_mode($name, $mode), 'none', $raw_value);
        }

        return $raw_value;
    }
}

new DMPRO_Timeline_Item();
