<?php
class DMPRO_ButtonGridiron_Child extends ET_Builder_Module
{
    public function init() {
        $this->slug = 'dmpro_button_grid_child';
        $this->vb_support = 'on';
        $this->type = 'child';
        $this->name = esc_html__('Multi Button', 'dmpro-divi-modules-pro');
        $this->main_css_element = '%%order_class%%.dmpro_button_grid_child';
        $this->child_title_var = 'button_id';
        $this->advanced_setting_title_text = esc_html__('New Button', 'dmpro-divi-modules-pro');
        $this->settings_text = esc_html__('Button Content', 'dmpro-divi-modules-pro');
        $this->settings_modal_toggles = [
            'general' => [
                'toggles' => [
                    'general' => esc_html__('General Settings', 'dmpro-divi-modules-pro'),
                    'button_info' => esc_html__('Button Content', 'dmpro-divi-modules-pro'),
                    'text_info' => esc_html__('Text Content', 'dmpro-divi-modules-pro'),
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'text_style' => esc_html__('Text Style', 'dmpro-divi-modules-pro')
                ]
            ]
        ];
    }

    public function get_fields() {
        $module_fields = [];
        $module_fields["button_id"] = [
            'label' => esc_html__('Admin Label', 'dmpro-divi-modules-pro'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'general'
        ];

        $module_fields['button_type'] = [
            'label' => esc_html__('Button Type', 'dmpro-divi-modules-pro'),
            'type' => 'select',
            'option_category' => 'configuration',
            'options' => [
                '' => esc_html__('Select Type', 'dmpro-divi-modules-pro'),
                'button' => esc_html__('Button', 'dmpro-divi-modules-pro'),
                'text'   => esc_html__('Text', 'dmpro-divi-modules-pro'),
            ],
            'toggle_slug' => 'general'
        ];

        $module_fields["button_text"] = [
            'label' => esc_html__('Button Text', 'dmpro-divi-modules-pro'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'depends_show_if' => 'button',
            'depends_on' => [
                'button_type'
            ],
            'toggle_slug' => 'button_info',
        ];

        $module_fields["button_link"] = [
            'label' => esc_html__('Button Link', 'dmpro-divi-modules-pro'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'depends_show_if' => 'button',
            'depends_on' => [
                'button_type'
            ],
            'toggle_slug' => 'button_info',
        ];

        $module_fields["button_link_target"] = [
            'label'           => esc_html__('Button Link Target', 'dmpro-divi-modules-pro'),
            'type'            => 'select',
            'option_category' => 'basic_option',
            'options'         => [
                'off'    => esc_html__('Same Window', 'dmpro-divi-modules-pro'),
                'on'  => esc_html__('New Window', 'dmpro-divi-modules-pro'),
            ],
            'depends_show_if' => 'button',
            'depends_on' => [
                'button_type'
            ],
            'toggle_slug' => 'button_info',
        ];

        $module_fields["text_info"] = [
            'label' => esc_html__('Text', 'dmpro-divi-modules-pro'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'depends_show_if' => 'text',
            'depends_on' => [
                'button_type'
            ],
            'toggle_slug' => 'text_info',
        ];

        return $module_fields;
    }

    public function get_advanced_fields_config() {
        $advanced_fields = [];
        $advanced_fields["text"] = false;
        $advanced_fields["text_shadow"] = false;
        $advanced_fields["link_options"] = false;

        $advanced_fields['margin_padding'] = [
            'css' => [
                'margin' => '%%order_class%%',
                'padding' => '%%order_class%%',
                'important' => 'all',
            ],
        ];

        $advanced_fields['fonts']['text_style'] = [
            'css' => [
                'main' => "%%order_class%% .dmpro-text-wrap",
                'important' => 'all',
            ],
            'text_align' => [
                'default' => 'center',
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

        $advanced_fields['button']["button"] = [
            'label'    => esc_html__('Button Style', 'dmpro-divi-modules-pro'),
            'css' => [
                'main' => "%%order_class%% .dmpro-button-wrap",
                'limited_main' => "%%order_class%% .dmpro-button-wrap",
                'important' => true,
            ],
            'box_shadow'  => [
                'css' => [
                    'main' => "%%order_class%% .dmpro-button-wrap",
                    'important' => true,
                ],
            ],
            'use_alignment' => false,
            'margin_padding' => [
                'css' => [
                    'main' => "%%order_class%% .dmpro-button-wrap",
                    'important' => 'all',
                ],
            ]

        ];

        return $advanced_fields;
    }

    public function get_custom_css_fields_config() {
        $custom_css_fields = [];

        $custom_css_fields['button_type'] = array(
            'label' => esc_html__('Button Style', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-button-wrap',
        );

        $custom_css_fields['text_type'] = array(
            'label' => esc_html__('Text Style', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-text-wrap',
        );

        return $custom_css_fields;
    }

    public function render($attrs, $content, $render_slug) {
        wp_enqueue_style("dmpro-".$this->slug, plugin_dir_url(__FILE__) . 'style.css', [], "1.0.0", 'all');
        $button_custom = $this->props['custom_button'];
        $button_text   = isset($this->props['button_text']) ? $this->props['button_text'] : 'Click Here';
        $button_link   = isset($this->props['button_link']) ? $this->props['button_link'] : '#';
        $button_link_target = $this->props['button_link_target'];
        $button_rel    = $this->props['button_rel'];
        $button_icon   = $this->props['button_icon'];

        if ('button' === $this->props['button_type']) {

            $button_link = trim($button_link);

            if ( $button_text === '' && $button_link === '') {
                return '';
            }

            $button = $this->render_button([
                'button_classname' => ["dmpro-button-grid", "dmpro-button-wrap"],
                'button_custom' => $button_custom,
                'button_rel' => $button_rel,
                'button_text' => $button_text,
                'button_url' => $button_link,
                'custom_icon' => $button_icon,
                'has_wrapper' => false,
                'url_new_window' => $button_link_target,
            ]);
        } 
        else {
            $text_info = $this->props['text_info'];
            $button = sprintf('<div class="dmpro-text-grid dmpro-text-wrap">%1$s</div>', esc_attr($text_info));
        }


        return $button;
    }
}

new DMPRO_ButtonGridiron_Child;