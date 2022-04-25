<?php

class DMPRO_RestaurantMenu extends ET_Builder_Module { 

    protected $module_credits = array(
        'module_uri' => DMPRO_MODULE,
        'author' => DMPRO_AUTHOR,
        'author_uri' => DMPRO_WEB,
    );

    public function init() {
        $this->slug = 'dmpro_price_list';
        $this->icon_path = plugin_dir_path(__FILE__) . "Restaurant.svg";
        $this->vb_support = 'on';
        $this->name = esc_html__(DMPRO_PREFIX . 'Restaurant Menu', 'dmpro-divi-modules-pro');
        $this->child_slug = 'dmpro_price_list_item';
        $this->settings_modal_toggles = [
            'general' => [
                'toggles' => [
                    'title' => esc_html__('Title', 'dmpro-divi-modules-pro'),
                    'price' => esc_html__('Price', 'dmpro-divi-modules-pro'),
                    'description' => esc_html__('Desription', 'dmpro-divi-modules-pro'),
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'layout' => esc_html__('Vertical Alignment', 'dmpro-divi-modules-pro'),
                    'image' => esc_html__('Image', 'dmpro-divi-modules-pro'),
                    'separator' => esc_html__('Title & Price Separator', 'dmpro-divi-modules-pro'),
                    'text' => [
                        'title' => esc_html__('Text', 'et_builder'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles' => [
                            'title' => [
                                'name' => 'Title',
                                'icon' => 'title',
                            ],
                            'price' => [
                                'name' => 'Price',
                                'icon' => 'price',
                            ],
                            'description' => [
                                'name' => 'Description',
                                'icon' => 'description',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
    
    public function get_fields() {

        $fields = [];

        $fields['image_flex_align_items'] = [
            'label' => esc_html__('Image Vertical Alignment', 'dmpro-divi-modules-pro'),
            'description' => esc_html__('How the image is vertically aligned inside each item.', 'dmpro-divi-modules-pro'),
            'type' => 'select',
            'options' => [
                'flex-start' => 'Top',
                'center' => 'Center',
                'flex-end' => 'Bottom',
                'baseline' => 'Baseline',
            ],
            'default' => 'flex-start',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'layout',
        ];

        $fields['header_flex_align_items'] = [
            'label' => esc_html__('Header Vertical Alignment', 'dmpro-divi-modules-pro'),
            'description' => esc_html__('How the title, separator and price is vertically aligned inside the header.', 'dmpro-divi-modules-pro'),
            'type' => 'select',
            'options' => [
                'flex-start' => 'Top',
                'center' => 'Center',
                'flex-end' => 'Bottom',
                'baseline' => 'Baseline',
            ],
            'default' => 'baseline',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'layout',
        ];

        $fields['item_spacing'] = [
            'label' => esc_html__('Item Spacing', 'dmpro-divi-modules-pro'),
            'description' => esc_html__('The vertical spacing between each item.', 'dmpro-divi-modules-pro'),
            'type' => 'range',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'margin_padding',
            'range_settings' => array(
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ),
            'mobile_options' => true,
            'default_unit' => 'px',
            'default' => '',
        ];

        $fields["item_padding"] = [
            'label' => esc_html__('Item Padding', 'dmpro-divi-modules-pro'),
            'description' => esc_html__('The padding inside each item.', 'dmpro-divi-modules-pro'),
            'type' => 'custom_margin',
            'mobile_options' => true,
            'option_category' => 'layout',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'margin_padding',
        ];

        $fields["item_text_padding"] = [
            'label' => esc_html__('Item Text Wrapper Padding', 'dmpro-divi-modules-pro'),
            'description' => esc_html__('The padding of the text container.', 'dmpro-divi-modules-pro'),
            'type' => 'custom_margin',
            'mobile_options' => true,
            'option_category' => 'layout',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'margin_padding',
        ];

        $fields['image_spacing'] = [
            'label' => esc_html__('Image Spacing', 'dmpro-divi-modules-pro'),
            'description' => esc_html__('The spacing between the image and the text container.', 'dmpro-divi-modules-pro'),
            'type' => 'range',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'image',
            'default' => '0px',
            'range_settings' => array(
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ),
            'mobile_options' => true,
            'default_unit' => 'px',
            'default' => '',
        ];

        $fields['image_width'] = [
            'label' => esc_html__('Image Width', 'dmpro-divi-modules-pro'),
            'description' => esc_html__('The width of the image of each item.', 'dmpro-divi-modules-pro'),
            'type' => 'range',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'image',
            'range_settings' => array(
                'min' => '1',
                'max' => '100',
                'step' => '1',
            ),
            'mobile_options' => true,
            'default' => '25%',
        ];

        $fields['separator_style'] = [
            'label' => esc_html__('Separator Style', 'dmpro-divi-modules-pro'),
            'description' => esc_html__('The CSS border-style used for the separator.', 'dmpro-divi-modules-pro'),
            'type' => 'select',
            'options' => [
                'none' => 'none',
                'dotted' => 'dotted',
                'dashed' => 'dashed',
                'double' => 'double',
                'groove' => 'groove',
                'hidden' => 'hidden',
                'inherit' => 'inherit',
                'initial' => 'initial',
                'inset' => 'inset',
                'outset' => 'outset',
                'ridge' => 'ridge',
                'solid' => 'solid',
                'unset' => 'unset',
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'separator',
            'default' => 'dotted',
            'mobile_options' => true,

        ];

        $fields['separator_weight'] = [
            'label' => esc_html__('Separator Height', 'dmpro-divi-modules-pro'),
            'description' => esc_html__('The CSS border-width used for the separator.', 'dmpro-divi-modules-pro'),
            'type' => 'range',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'image',
            'default' => '2px',
            'range_settings' => array(
                'min' => '1',
                'max' => '100',
                'step' => '1',
            ),
            'toggle_slug' => 'separator',
            'mobile_options' => true,
            'validate_unit' => true,
        ];

        $fields['separator_color'] = [
            'label' => esc_html__('Separator Color', 'dmpro-divi-modules-pro'),
            'description' => esc_html__('The CSS border-color used for the separator.', 'dmpro-divi-modules-pro'),
            'type' => 'color-alpha',
            'custom_color' => true,
            'default' => et_builder_accent_color(),
            'tab_slug' => 'advanced',
            'toggle_slug' => 'separator',
        ];

        $fields['separator_spacing'] = [
            'label' => esc_html__('Separator Spacing', 'dmpro-divi-modules-pro'),
            'description' => esc_html__('The spacing between the title/price and the separator.', 'dmpro-divi-modules-pro'),
            'type' => 'range',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'separator',
            'default' => '5px',
            'range_settings' => array(
                'min' => '1',
                'max' => '100',
                'step' => '1',
            ),
            'mobile_options' => true,
        ];
        return $fields;
    }

    public function get_advanced_fields_config() {
        
        $advanced_fields = [];
        $advanced_fields['fonts'] = false;
        $advanced_fields['text'] = false;
        $advanced_fields['text_shadow'] = false;

        $advanced_fields['fonts']['title'] = [
            'label' => esc_html__('Title', 'dmpro-divi-modules-pro'),
            'toggle_slug' => 'text',
            'sub_toggle' => 'title',
            'line_height' => array(
                'default' => '1em',
                'range_settings' => array(
                    'min' => '1',
                    'max' => '3',
                    'step' => '0.1',
                ),
            ),
            'font_size' => array(
                'range_settings' => array(
                    'default' => '22px',
                    'min' => '1',
                    'max' => '100',
                    'step' => '1',
                ),
            ),
            'css' => array(
                'main' => '%%order_class%% .dmpro_price_list_item .dmpro_price_list_title',
            ),
        ];

        $advanced_fields['fonts']['price'] = [
            'label' => esc_html__('Price', 'dmpro-divi-modules-pro'),
            'toggle_slug' => 'text',
            'sub_toggle' => 'price',
            'line_height' => array(
                'range_settings' => array(
                    'default' => '1em',
                    'min' => '1',
                    'max' => '3',
                    'step' => '0.1',
                ),
            ),
            'font_size' => array(
                'default' => '24px',
                'range_settings' => array(
                    'min' => '1',
                    'max' => '100',
                    'step' => '1',
                ),
            ),
            'css' => array(
                'main' => '%%order_class%% .dmpro_price_list_item .dmpro_price_list_price',
            ),
        ];

        $advanced_fields['fonts']['description'] = [
            'label' => esc_html__('Description', 'dmpro-divi-modules-pro'),
            'toggle_slug' => 'text',
            'sub_toggle' => 'description',
            'line_height' => array(
                'default' => '1em',
                'range_settings' => array(
                    'min' => '1',
                    'max' => '3',
                    'step' => '0.1',
                ),
            ),
            'font_size' => array(
                'default' => '16px',
                'range_settings' => array(
                    'min' => '1',
                    'max' => '100',
                    'step' => '1',
                ),
            ),
            'css' => array(
                'main' => '%%order_class%% .dmpro_price_list_item .dmpro_price_list_content',
            ),
        ];

        $advanced_fields["box_shadow"]["images"] = [
            'label' => esc_html__('Image Box Shadow', 'dmpro-divi-modules-pro'),
            'toggle_slug' => 'image',
            'tab_slug' => 'advanced',
            'css' => [
                'main' => "%%order_class%% .dmpro_price_list_item .dmpro_price_list_image_wrapper img",
            ],
        ];

        $advanced_fields["borders"]["default"] = [
            'css' => [
                'main' => [
                    'border_radii' => "%%order_class%%",
                    'border_styles' => "%%order_class%%",
                ],
            ],
        ];

        $advanced_fields["borders"]["images"] = [
            'label_prefix' => esc_html__('Image', 'dmpro-divi-modules-pro'),
            'toggle_slug' => 'image',
            'tab_slug' => 'advanced',
            'css' => [
                'main' => [
                    'border_radii' => "%%order_class%% .dmpro_price_list_item .dmpro_price_list_image_wrapper img",
                    'border_styles' => "%%order_class%% .dmpro_price_list_item .dmpro_price_list_image_wrapper img",
                ],
            ],
        ];

        return $advanced_fields;
    }

    public function get_custom_css_fields_config() {
        $custom_css_fields = [];

        $custom_css_fields['price_list_item'] = [
            'label' => esc_html__('Price List Items', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro_price_list_item',
        ];

        $custom_css_fields['img_wrap'] = [
            'label' => esc_html__('Image Wrapper', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro_price_list_image_wrapper',
        ];

        $custom_css_fields['img'] = [
            'label' => esc_html__('Image', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro_price_list_image_wrapper img',
        ];

        $custom_css_fields['txt_wrap'] = [
            'label' => esc_html__('Text Wrapper', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro_price_list_text_wrapper',
        ];

        $custom_css_fields['title'] = [
            'label' => esc_html__('Title', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro_price_list_title',
        ];

        $custom_css_fields['price'] = [
            'label' => esc_html__('Price', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro_price_list_price',
        ];

        $custom_css_fields['separator'] = [
            'label' => esc_html__('Title & Price Separator', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro_price_list_separator',
        ];

        $custom_css_fields['description'] = [
            'label' => esc_html__('Description', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro_price_list_content',
        ];

        return $custom_css_fields;
    }

    public function render($attrs, $content, $render_slug) {
        wp_enqueue_style("dmpro".$this->slug, plugin_dir_url(__FILE__) . 'style.css', [], "1.0.0", 'all');
        $this->apply_css($render_slug);

        $mobile_enabled = et_pb_get_responsive_status($this->props['image_width_last_edited']);
        $mobile_enabled2 = et_pb_get_responsive_status($this->props['image_spacing_last_edited']);

        $image_width_values = [
            'desktop' => $this->props['image_width'],
            'tablet' => $mobile_enabled ? $this->props['image_width_tablet'] : '',
            'phone' => $mobile_enabled ? $this->props['image_width_phone'] : '',
        ];

        $image_spacing_values = [
            'desktop' => $this->props['image_spacing'],
            'tablet' => $mobile_enabled ? $this->props['image_spacing_tablet'] : '',
            'phone' => $mobile_enabled ? $this->props['image_spacing_phone'] : '',
        ];

        et_pb_generate_responsive_css($image_width_values, '%%order_class%%', 'image_spacing', $render_slug);
        et_pb_generate_responsive_css($image_spacing_values, '%%order_class%%', 'image_spacing', $render_slug);

        return sprintf('
            <div>
                %1$s
            </div>',
            $this->props['content']
        );

    }

    public function apply_css($render_slug) {
        $this->apply_image_css($render_slug);
        $this->apply_item_spacing_css($render_slug);
        $this->apply_item_padding_css($render_slug);
        $this->apply_item_text_padding_css($render_slug);

        $image_flex_align_items = $this->props['image_flex_align_items'];
        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro_price_list_item_wrapper',
            'declaration' => "align-items: {$image_flex_align_items};",
        ]);

        $header_flex_align_items = $this->props['header_flex_align_items'];
        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro_price_list_header',
            'declaration' => "align-items: {$header_flex_align_items};",
        ]);

        $separator_style = $this->props['separator_style'];
        $separator_weight = $this->props['separator_weight'];
        $separator_color = $this->props['separator_color'];
        $separator_spacing = $this->props['separator_spacing'];
        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro_price_list_separator',
            'declaration' => "
                border-bottom-style: {$separator_style};
                border-bottom-width: {$separator_weight};
                border-bottom-color: {$separator_color};
                margin-left: {$separator_spacing};
                margin-right: {$separator_spacing};
            ",
        ]);

    }

    private function apply_item_spacing_css($render_slug) {
        if (!isset($this->props['item_spacing']) || '' === $this->props['item_spacing']) {
            return;
        }

        $item_spacing = $this->get_responsive_prop('item_spacing');
        
        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro_price_list_item:not(:last-child)',
            'declaration' => "margin-bottom: {$item_spacing['desktop']};",
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro_price_list_item:not(:last-child)',
            'declaration' => "margin-bottom: {$item_spacing['tablet']};",
            'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro_price_list_item:not(:last-child)',
            'declaration' => "margin-bottom: {$item_spacing['phone']};",
            'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
        ]);
    }

    private function apply_item_padding_css($render_slug) {
        if (!isset($this->props['item_padding']) || '' === $this->props['item_padding']) {
            return;
        }

        $item_padding = $this->get_responsive_prop('item_padding');
        $item_padding_desktop = explode("|", $item_padding['desktop']);
        $item_padding_tablet = explode("|", $item_padding['tablet']);
        $item_padding_phone = explode("|", $item_padding['phone']);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro_price_list_item',
            'declaration' => "padding-top: {$item_padding_desktop[0]};
                              padding-right: {$item_padding_desktop[1]};
                              padding-bottom: {$item_padding_desktop[2]};
                              padding-left: {$item_padding_desktop[3]};",
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro_price_list_item',
            'declaration' => "padding-top: {$item_padding_tablet[0]};
                              padding-right: {$item_padding_tablet[1]};
                              padding-bottom: {$item_padding_tablet[2]};
                              padding-left: {$item_padding_tablet[3]};",
            'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro_price_list_item',
            'declaration' => "padding-top: {$item_padding_phone[0]};
                              padding-right: {$item_padding_phone[1]};
                              padding-bottom: {$item_padding_phone[2]};
                              padding-left: {$item_padding_phone[3]};",
            'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
        ]);
    }

    private function apply_item_text_padding_css($render_slug) {
        if (!isset($this->props['item_text_padding']) || '' === $this->props['item_text_padding']) {
            return;
        }

        $item_text_padding = $this->get_responsive_prop('item_text_padding');
        $item_text_padding_desktop = explode("|", $item_text_padding['desktop']);
        $item_text_padding_tablet = explode("|", $item_text_padding['tablet']);
        $item_text_padding_phone = explode("|", $item_text_padding['phone']);


        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro_price_list_item .dmpro_price_list_text_wrapper',
            'declaration' => "padding-top: {$item_text_padding_desktop[0]};
                              padding-right: {$item_text_padding_desktop[1]};
                              padding-bottom: {$item_text_padding_desktop[2]};
                              padding-left: {$item_text_padding_desktop[3]};",
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro_price_list_item .dmpro_price_list_text_wrapper',
            'declaration' => "padding-top: {$item_text_padding_tablet[0]};
                              padding-right: {$item_text_padding_tablet[1]};
                              padding-bottom: {$item_text_padding_tablet[2]};
                              padding-left: {$item_text_padding_tablet[3]};",
            'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro_price_list_item .dmpro_price_list_text_wrapper',
            'declaration' => "padding-top: {$item_text_padding_phone[0]};
                              padding-right: {$item_text_padding_phone[1]};
                              padding-bottom: {$item_text_padding_phone[2]};
                              padding-left: {$item_text_padding_phone[3]};",
            'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
        ]);
    }

    private function apply_image_css($render_slug) {


        $image_width = $this->get_responsive_prop('image_width');
        $image_spacing = $this->get_responsive_prop('image_spacing');

        ET_Builder_Element::set_style($render_slug, array(
            'selector' => "%%order_class%% .dmpro_price_list_image_wrapper",
            'declaration' => "width: {$image_width['desktop']}; margin-right: {$image_spacing['desktop']};",
        ));

        ET_Builder_Element::set_style($render_slug, array(
            'selector' => "%%order_class%% .dmpro_price_list_image_wrapper",
            'declaration' => "width: {$image_width['tablet']}; margin-right: {$image_spacing['tablet']};",
            'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
        ));

        ET_Builder_Element::set_style($render_slug, array(
            'selector' => "%%order_class%% .dmpro_price_list_image_wrapper",
            'declaration' => "width: {$image_width['phone']}; margin-right: {$image_spacing['phone']};",
            'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
        ));
    }

    protected function get_responsive_prop($property, $default = '', $default_if_empty = true) {
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

}
new DMPRO_RestaurantMenu;
