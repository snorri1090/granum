<?php
class DMPRO_ButtonGridiron extends ET_Builder_Module {
    
    protected $module_credits = array(
        'module_uri' => DMPRO_MODULE . 'multi-button',
        'author'     => DMPRO_AUTHOR,
        'author_uri' => DMPRO_WEB,
    );

    public function init() {
        $this->icon_path = plugin_dir_path(__FILE__) . "ButtonGrid.svg";
        $this->slug = 'dmpro_button_grid';
        $this->vb_support = 'on';
        $this->child_slug = 'dmpro_button_grid_child';
        $this->name = esc_html__(DMPRO_PREFIX . 'Multi Button', 'dmpro-divi-modules-pro');
        $this->main_css_element = '%%order_class%%.dmpro_button_grid';
        $this->settings_modal_toggles = [
            'general' => [
                'toggles' => [
                    'flexbox' => esc_html__('Position & Alignment', 'dmpro-divi-modules-pro'),
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'text_style' => esc_html__('Text Style', 'dmpro-divi-modules-pro'),
                ],
            ],
        ];
    }

    public function get_fields() {
        $module_fields = [];

        $fields['flex_direction'] = [
            'label' => esc_html__('Grid Type', 'dmpro-divi-modules-pro'),
            'type' => 'select',
            'option_category' => 'configuration',
            'default' => 'column',
            'options' => [
                'column' => esc_html__('Column', 'dmpro-divi-modules-pro'),
                'row' => esc_html__('Row', 'dmpro-divi-modules-pro'),
            ],
            'mobile_options' => true,
            'toggle_slug' => 'flexbox',
        ];

        $module_fields['flex_wrap'] = [
            'label' => esc_html__('Responsive Grid (Flex Wrap)', 'dmpro-divi-modules-pro'),
            'type' => 'yes_no_button',
            'option_category' => 'configuration',
            'default' => 'on',
            'options' => [
                'on' => esc_html__('Yes', 'dmpro-divi-modules-pro'),
                'off' => esc_html__('No', 'dmpro-divi-modules-pro'),
            ],
            'mobile_options' => true,
            'toggle_slug' => 'flexbox',
        ];

        $module_fields['justify_content'] = [
            'label' => esc_html__('Grid Alignment', 'dmpro-divi-modules-pro'),
            'type' => 'select',
            'option_category' => 'configuration',
            'default' => 'center',
            'options' => [
                'center' => esc_html__('Center', 'dmpro-divi-modules-pro'),
                'flex-start' => esc_html__('Flex Start', 'dmpro-divi-modules-pro'),
                'flex-end' => esc_html__('Flex End', 'dmpro-divi-modules-pro'),
                'space-around' => esc_html__('Space Around', 'dmpro-divi-modules-pro'),
                'space-between' => esc_html__('Space Between', 'dmpro-divi-modules-pro'),
                'space-evenly' => esc_html__('Space Evenly', 'dmpro-divi-modules-pro'),
            ],
            'mobile_options' => true,
            'toggle_slug' => 'flexbox',
        ];

        $module_fields['align_items'] = [
            'label' => esc_html__('Align Items', 'dmpro-divi-modules-pro'),
            'type' => 'select',
            'option_category' => 'configuration',
            'default' => 'baseline',
            'options' => [
                'baseline' => esc_html__('Baseline', 'dmpro-divi-modules-pro'),
                'center' => esc_html__('Center', 'dmpro-divi-modules-pro'),
                'flex-start' => esc_html__('Flex Start', 'dmpro-divi-modules-pro'),
                'flex-end' => esc_html__('Flex End', 'dmpro-divi-modules-pro'),
            ],
            'mobile_options' => true,
            'toggle_slug' => 'flexbox',
        ];

        return $module_fields;
    }

    public function get_advanced_fields_config() {
        $advanced_fields = [];
        $advanced_fields["text"] = false;
        $advanced_fields["text_shadow"] = false;

        $advanced_fields['margin_padding'] = [
            'css' => [
                'margin' => '%%order_class%%',
                'padding' => '%%order_class%%',
                'important' => 'all',
            ],
        ];

        $advanced_fields['fonts']['text_style'] = [
            'css' => [
                'main' => "%%order_class%% .dmpro-text-grid",
                'important' => 'all',
            ],
            'text_align' => [
                'default' => 'left',
            ],
            'font_size' => [
                'default' => '16px',
                'range_settings' => [
                    'min' => '1',
                    'max' => '50',
                    'step' => '1',
                ],
            ],
            'line_height' => [
                'default' => '1em',
                'range_settings' => [
                    'min' => '1',
                    'max' => '3',
                    'step' => '0.1',
                ],
            ],
            'toggle_slug' => 'text_style',
        ];

        $advanced_fields['button']["button_grid"] = [
            'label' => esc_html__('Button Style', 'dmpro-divi-modules-pro'),
            'css' => [
                'main' => "%%order_class%% .dmpro-button-grid",
                'important' => 'all',
            ],
            'hide_icon' => true,
            'use_alignment' => false,
            'box_shadow' => [
                'css' => [
                    'main' => "%%order_class%% .dmpro-button-grid",
                ],
            ],
            'margin_padding' => [
                'css' => [
                    'main' => "%%order_class%% .dmpro-button-grid",
                    'important' => 'all',
                ],
            ],
        ];

        return $advanced_fields;
    }

    public function get_custom_css_fields_config() {
        $custom_css_fields = [];
        return $custom_css_fields;
    }

    public function render($attrs, $content, $render_slug) {
        wp_enqueue_style("dmpro".$this->slug, plugin_dir_url(__FILE__) . 'style.css', [], "1.0.0", 'all');
        $flex_direction = $this->get_responsive_prop('flex_direction');
        $justify_content = $this->get_responsive_prop('justify_content');
        $align_items = $this->get_responsive_prop('align_items');
        $flex_wrap_on = $this->get_responsive_prop('flex_wrap');

        $css_values = array(
            'desktop' => array(
                'flex-direction' => esc_html($flex_direction['desktop']),
                'justify-content' => esc_html($justify_content['desktop']),
                'align-items' => esc_html($align_items['desktop']),
                'flex-wrap' => esc_html($flex_wrap_on['desktop'] === 'on' ? 'wrap' : 'nowrap'),
            ),
            'tablet' => array(
                'flex-direction' => esc_html($flex_direction['tablet']),
                'justify-content' => esc_html($justify_content['tablet']),
                'align-items' => esc_html($align_items['tablet']),
                'flex-wrap' => esc_html($flex_wrap_on['tablet'] === 'on' ? 'wrap' : 'nowrap'),
            ),
            'phone' => array(
                'flex-direction' => esc_html($flex_direction['phone']),
                'justify-content' => esc_html($justify_content['phone']),
                'align-items' => esc_html($align_items['phone']),
                'flex-wrap' => esc_html($flex_wrap_on['phone'] === 'on' ? 'wrap' : 'nowrap'),
            ),
        );

        et_pb_responsive_options()->generate_responsive_css($css_values, '%%order_class%%  .dmpro-button-grid-container', '', $render_slug, '', 'flex');

        $output = sprintf(
            '<div class="dmpro-button-grid-container">
                %1$s
            </div>',
            et_core_sanitized_previously($this->content)
        );

        return $output;
    }

    protected function get_responsive_prop($property, $default = '', $default_if_empty = true) {
        $responsive_prop = [];
        $responsive_enabled = isset($this->props["{$property}_last_edited"]) ? et_pb_get_responsive_status($this->props["{$property}_last_edited"]) : false;
        if (!isset($this->props[$property]) || ($default_if_empty && $this->props[$property] === '' )) {
            $responsive_prop["desktop"] = $default;
        } 
        else {
            $responsive_prop["desktop"] = $this->props[$property];
        }

        if (!$responsive_enabled || !isset($this->props["{$property}_tablet"]) || $this->props["{$property}_tablet"] === '' ) {
            $responsive_prop["tablet"] = $responsive_prop["desktop"];
        } 
        else {
            $responsive_prop["tablet"] = $this->props["{$property}_tablet"];
        }
        if (!$responsive_enabled || !isset($this->props["{$property}_phone"]) || $this->props["{$property}_phone"] === '' ) {
            $responsive_prop["phone"] = $responsive_prop["tablet"];
        } 
        else {
            $responsive_prop["phone"] = $this->props["{$property}_phone"];
        }
        return $responsive_prop;
    }
}

new DMPRO_ButtonGridiron;