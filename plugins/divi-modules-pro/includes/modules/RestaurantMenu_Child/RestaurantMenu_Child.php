<?php

class DMPRO_RestaurantMenu_Child extends ET_Builder_Module { 

	public $module_url = DMPRO_MODULES_URL . 'RestaurantMenu_Child' . '/';
    
    public function init()
    {
        $this->slug = 'dmpro_price_list_item';
        $this->vb_support = 'on';
        $this->name = esc_html__('Item List', DMPRO_TEXTDOMAIN);
        $this->type = 'child';
        $this->child_title_var = 'title';
        $this->child_title_fallback_var = 'admin';

        $this->settings_modal_toggles = [
            'general' => [
                'toggles' => [
                    'content' => esc_html__('Menu Item Content', DMPRO_TEXTDOMAIN),
                ],
            ],

             'advanced' => [
                'toggles' => [
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
    
    public function get_fields()
    {
        $fields = [];
            
        $fields['title'] = [
                'label' => esc_html__('Title', DMPRO_TEXTDOMAIN),
                'type' => 'text',
                'description' => esc_html__('The title of the item.', DMPRO_TEXTDOMAIN),
                'toggle_slug' => 'content',
                'default'    => esc_html__('Title', DMPRO_TEXTDOMAIN),
        ];

        $fields['price'] = [
                'label' => esc_html__('Price', DMPRO_TEXTDOMAIN),
                'type' => 'text',
                'description' => esc_html__('The price of the item.', DMPRO_TEXTDOMAIN),
                'toggle_slug' => 'content',
                'default'    => esc_html__('$9.95', DMPRO_TEXTDOMAIN),
            ];

        $fields['content'] = [
                'label' => esc_html__('Description', DMPRO_TEXTDOMAIN),
                'type' => 'tiny_mce',
                'description' => esc_html__('The (optional) description for this item.', DMPRO_TEXTDOMAIN),
                'toggle_slug' => 'content',
        ];

        $fields['image'] = [
                'label' => esc_html__('Image', DMPRO_TEXTDOMAIN),
                'type' => 'upload',
                'description' => esc_html__('The (optional) image for this item.', DMPRO_TEXTDOMAIN),
                'toggle_slug' => 'content',
                'upload_button_text' => esc_attr__('Upload Image', DMPRO_TEXTDOMAIN),
                'choose_text' => esc_attr__('Choose Image', DMPRO_TEXTDOMAIN),
                'update_text' => esc_attr__('Update Image', DMPRO_TEXTDOMAIN),
                'hide_metadata' => true,
        ];

        $fields['img_alt'] = [
                'label'       => esc_html__( 'Image Alt Text', DMPRO_TEXTDOMAIN ),
                'type'        => 'text',
                'description' => esc_html__( 'Define the HTML ALT text for your image here.', DMPRO_TEXTDOMAIN),
                'toggle_slug' => 'content',
        ];
            
        return $fields;
    }

    public function get_advanced_fields_config()
    {
        $advanced_fields = [];
        $advanced_fields['fonts'] = false;
        $advanced_fields['text'] = false;
        $advanced_fields['text_shadow'] = false;
        $advanced_fields['filters'] = false;

        $advanced_fields['fonts']['title'] = [
            'label' => esc_html__('Title', DMPRO_TEXTDOMAIN),
            'toggle_slug' => 'text',
            'sub_toggle' => 'title',
            'line_height' => array(
                'range_settings' => array(
                    'default' => '1em',
                    'min' => '1',
                    'max' => '3',
                    'step' => '0.1',
                ),
            ),
            'header_level' => [
                'default' => 'h2',
            ],
            'font_size' => array(
                'default' => '22px',
                'range_settings' => array(
                    'min' => '1',
                    'max' => '100',
                    'step' => '1',
                ),
            ),
            'css' => array(
                'main' => '%%order_class%% .dmpro_price_list_title',
            ),
        ];

        $advanced_fields['fonts']['price'] = [
            'label' => esc_html__('Price', DMPRO_TEXTDOMAIN),
            'toggle_slug' => 'text',
            'sub_toggle' => 'price',
            'line_height' => array(
                'range_settings' => array(
                    'default' => '1em',
                    'min' => '1',
                    'max' => '3',
                    'step' => '1',
                ),
            ),
            'font_size' => array(
                'default' => '22px',
                'range_settings' => array(
                    'min' => '1',
                    'max' => '100',
                    'step' => '1',
                ),
            ),
            'css' => array(
                'main' => '%%order_class%% .dmpro_price_list_price',
            ),
        ];

        $advanced_fields['fonts']['description'] = [
            'label' => esc_html__('Description', DMPRO_TEXTDOMAIN),
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
                'main' => '%%order_class%% .dmpro_price_list_content',
            ),
        ];

        $advanced_fields['margin_padding'] = [
            'css' => [
                'important' => 'all',
            ],
        ];

        return $advanced_fields;
    }

    public function render( $attrs, $content, $render_slug ) {
        wp_enqueue_style("dmpro".$this->slug, $this->module_url . 'style.css', [], "1.0.0", 'all');
        $title_level = $this->props['title_level'] ? $this->props['title_level'] : 'h2';

        return sprintf(
            '<div class="dmpro_price_list_item_wrapper">
                %1$s
                <div class="dmpro_price_list_text_wrapper">
                    <div class="dmpro_price_list_header">
                        <%5$s class="dmpro_price_list_title">%2$s</%5$s>
                        <div class="dmpro_price_list_separator"></div>
                        <div class="dmpro_price_list_price">%3$s</div>
                    </div>
                    <div class="dmpro_price_list_content">
                        %4$s
                    </div>
                </div>
            </div>',
            $this->render_the_image(),
            $this->props['title'],
            $this->props['price'],
            preg_replace('/^<\/p>(.*)<p>/s', '$1', $this->props['content']),
            esc_attr($title_level)
        );
    }

    public function apply_css($render_slug) {
        ET_Builder_Element::set_style( $render_slug, array(
            'selector' => "%%order_class%% .dmpro_price_list_separator",
            'declaration' => "border-bottom-style: 'dotted';",
        ));
    }

    public function render_the_image() {
        if (!$this->props['image'] || "" === $this->props['image']){
            return;
        } else {
            $img_alt = $this->props['img_alt'];
            $output = sprintf(
                '<div class="dmpro_price_list_image_wrapper">
                    <img src="%1$s" alt="%2$s"/>
                </div>',
                $this->props['image'],
                $img_alt
            );

            return $output;

        }
    }
}
new DMPRO_RestaurantMenu_Child;