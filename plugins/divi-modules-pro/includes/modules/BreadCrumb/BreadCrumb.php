<?php
class DMPRO_BreadCrumb extends ET_Builder_Module { 

    static protected $rendering = false;
	
	public $module_url = DMPRO_MODULES_URL . 'BreadCrumb' . '/';
	
    protected $module_credits = array(
        'module_uri' => DMPRO_MODULE . 'breadcrumbs',
        'author' => DMPRO_AUTHOR,
        'author_uri' => DMPRO_WEB
    );
    public function init() {
        $this->slug = 'dmpro_breadcrumbs';
        $this->icon_path = plugin_dir_path( __FILE__ ) . "Breadcrumb.svg";
        $this->vb_support = 'on';
        $this->name = esc_html__(DMPRO_PREFIX . 'Breadcrumbs', DMPRO_TEXTDOMAIN);
        $this->main_css_element = '%%order_class%%.dmpro_breadcrumbs';
        $this->settings_modal_toggles = [
            'general' => [
                'toggles' => [
                    'settings' => esc_html__('Breadcrumb Settings', DMPRO_TEXTDOMAIN),
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'settings' => esc_html__('Breadcrumb Settings', DMPRO_TEXTDOMAIN),
                    'breadcrumb_style' => [
                        'sub_toggles' => [
                            'default' => [
                                'name' => 'Default',
                            ],
                            'active' => [
                                'name' => 'Active',
                            ],
                            'hover' => [
                                'name' => 'Hover',
                            ],
                        ],
                        'tabbed_subtoggles' => true,
                        'title' => esc_html__('Breadcrum Style', DMPRO_TEXTDOMAIN),
                        'priority' => 2,
                    ],
                    'separator'         => esc_html__('Breacrumb Separator Style', DMPRO_TEXTDOMAIN),
                ],
            ],
        ];
    }
    public function get_fields() {
        $module_fields = [];
        $module_fields["bc_custom_home"] = [
            'label' => esc_html__('Customize Homepage Breadcrumb', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'configuration',
            'options' => array(
                'on'  => esc_html__('Yes', DMPRO_TEXTDOMAIN),
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
            ),
            'default_on_front'  => 'off',
            'toggle_slug' => 'settings',
        ];
        $module_fields["bc_home_text"] = [
            'label' => esc_html__('Homepage Text', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'settings',
            'depends_show_if' => 'on',
            'depends_on' => [
                'bc_custom_home'
            ],
        ];
        $module_fields["bc_home_url"] = [
            'label' => esc_html__('Homepage Url', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'option_category' => 'basic_option',
            'depends_show_if' => 'on',
            'depends_on' => [
                'bc_custom_home'
            ],
            'toggle_slug' => 'settings'
        ];
        $module_fields["bc_home_icon"] = [
            'label' => esc_html__('Enable Home Icon', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'configuration',
            'options' => array(
                'on'  => esc_html__('Yes', DMPRO_TEXTDOMAIN),
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
            ),
            'toggle_slug' => 'settings',
        ];
        $module_fields['bc_separator'] = [
            'label' => esc_html__('Breadcrumb Separator', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'option_category' => 'configuration',
            'options' => [
                'icon' => esc_html__('Icon', DMPRO_TEXTDOMAIN),
                'symbol' => esc_html__('Custom Text Symbol', DMPRO_TEXTDOMAIN),
            ],
            'default' => 'icon',
            'toggle_slug' => 'settings'
        ];
        $module_fields["bc_home_size"] = [
            'label' => esc_html__('Home Icon Size', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'validate_unit' => true,
            'default' => '16px',
            'default_unit' => 'px',
            'range_settings'  => [
                'min' => '0',
                'max' => '100',
                'step' => '1'
            ],
            'depends_show_if' => 'on',
            'depends_on' => [
                'bc_custom_home'
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'settings'
        ];
        $module_fields["bc_home_color"] = [
            'label'             => esc_html__('Home Icon Color', DMPRO_TEXTDOMAIN),
            'type'              => 'color-alpha',
            'depends_show_if'   => 'on',
            'tab_slug'          => 'advanced',
            'toggle_slug'       => 'settings'
        ];
        $module_fields["bc_hover_home_color"] = [
            'label'             => esc_html__('Home Hover Icon Color', DMPRO_TEXTDOMAIN),
            'type'              => 'color-alpha',
            'depends_show_if' => 'on',
            'depends_on' => [
                'bc_custom_home'
            ],
            'tab_slug'          => 'advanced',
            'toggle_slug'       => 'settings'
        ];
        $module_fields["bc_separator_icon"] = [
            'label'              => esc_html__('Separator Icon', DMPRO_TEXTDOMAIN),
            'type'               => 'select_icon',
            'default'            => '$',
            'toggle_slug'        => 'settings',
            'tab_slug' => 'advanced',
        ];
        $module_fields["bc_separator_sysmbol"] = [
            'label' => esc_html__('Separator Symbol', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'option_category' => 'basic_option',
            'depends_show_if' => 'symbol',
            'depends_on' => [
                'bc_separator'
            ],
            'toggle_slug' => 'settings',
        ];
        $module_fields["bc_schema"] = [
            'label' => esc_html__('Enable Schema Markup', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'configuration',
            'options' => array(
                'on'  => esc_html__('Yes', DMPRO_TEXTDOMAIN),
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
            ),
            'toggle_slug' => 'settings',
        ];
        $module_fields["bc_separator_size"] = [
            'label' => esc_html__('Separator Size', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'validate_unit' => true,
            'default' => '16px',
            'default_unit' => 'px',
            'range_settings' => [
                'min' => '0',
                'max' => '100',
                'step' => '1'
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'separator'
        ];
        $module_fields["bc_separator_color"] = [
            'label'             => esc_html__('Separator Color', DMPRO_TEXTDOMAIN),
            'type'              => 'color-alpha',
            'default'           => '#2c3d49',
            'tab_slug'          => 'advanced',
            'toggle_slug' => 'separator'
        ];
        $module_fields["bc_separator_space"] = [
            'label' => esc_html__('Separator Spacing', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'validate_unit' => true,
            'default' => '5px',
            'default_unit' => 'px',
            'range_settings' => [
                'min' => '0',
                'max' => '100',
                'step' => '1'
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'separator'
        ];
        $module_fields["bc_item_bg_color"] = [
            'label'             => esc_html__('Background Color', 'et_builder'),
            'type'              => 'color-alpha',
            'tab_slug'          => 'advanced',
            'toggle_slug'       => 'breadcrumb_style',
            'sub_toggle'        => 'default'
        ];
        $module_fields['bc_item_padding'] = [
            'label'             => esc_html__('Item Padding', DMPRO_TEXTDOMAIN),
            'type'              => 'custom_margin',
            'option_category'   => 'basic_option',
            'mobile_options'    => true,
            'responsive'        => true,
            'tab_slug'          => 'advanced',
            'toggle_slug'       => 'breadcrumb_style',
            'sub_toggle'        => 'default'
        ];
        $module_fields["bc_active_item_color"] = [
            'label'             => esc_html__('Background Color', 'et_builder'),
            'type'              => 'color-alpha',
            'tab_slug'          => 'advanced',
            'toggle_slug'       => 'breadcrumb_style',
            'sub_toggle'        => 'active'
        ];
        $module_fields['bc_active_item_padding'] = [
            'label' => esc_html__('Active Item Padding', DMPRO_TEXTDOMAIN),
            'type' => 'custom_margin',
            'option_category' => 'basic_option',
            'mobile_options' => true,
            'responsive' => true,
            'tab_slug' => 'advanced',
            'toggle_slug'       => 'breadcrumb_style',
            'sub_toggle'        => 'active'
        ];
        $module_fields["bc_hover_item_bg_color"] = [
            'label'             => esc_html__('Background Color', 'et_builder'),
            'type'              => 'color-alpha',
            'depends_show_if'   => 'on',
            'tab_slug'          => 'advanced',
            'toggle_slug'       => 'breadcrumb_style',
            'sub_toggle'        => 'hover'
        ];
        $module_fields["__breadcrumbs"] = [
            'type'  => 'computed',
            'computed_callback' => ['DMPRO_BreadCrumb', 'render_breadcrumbs'],
            'computed_depends_on' => [
                'bc_custom_home',
                'bc_home_text',
                'bc_home_url',
                'bc_home_icon',
                'bc_separator',
                'bc_separator_icon',
                'bc_separator_sysmbol'
            ]
        ];
        return $module_fields;
    }
    public function get_advanced_fields_config() {
        $advanced_fields = [];
        $advanced_fields["text"] = false;
        $advanced_fields["text_shadow"] = false;
        $advanced_fields["fonts"] = false;
        $advanced_fields['margin_padding'] = [
          'css' => [
            'margin' => '%%order_class%%',
            'padding' => '%%order_class%%',
            'important' => 'all',
          ],
        ];
        $advanced_fields["borders"]["items"] = [
            'css' => [
                'main' => [
                    'border_radii' => "%%order_class%% .dmpro-breadcrumb-item a",
                    'border_styles' => "%%order_class%% .dmpro-breadcrumb-item a",
                ],
            ],
            'toggle_slug'       => 'breadcrumb_style',
            'sub_toggle'        => 'default'
        ];
        $advanced_fields["borders"]["hover"] = [
            'css' => [
                'main' => [
                    'border_radii' => "%%order_class%% .dmpro-breadcrumb-item:hover a",
                    'border_styles' => "%%order_class%% .dmpro-breadcrumb-item:hover a",
                ],
            ],
            'toggle_slug'       => 'breadcrumb_style',
            'sub_toggle'        => 'hover'
        ];
        $advanced_fields["borders"]["active"] = [
            'css' => [
                'main' => [
                    'border_radii' => "%%order_class%% .dmpro-breadcrumb-current",
                    'border_styles' => "%%order_class%% .dmpro-breadcrumb-current",
                ],
            ],
            'toggle_slug'       => 'breadcrumb_style',
            'sub_toggle'        => 'active'
        ];
        $advanced_fields["box_shadow"]["items"] = [
            'css' => [
              'main' => "%%order_class%% .dmpro-breadcrumb-item a",
            ],
            'toggle_slug'       => 'breadcrumb_style',
            'sub_toggle'        => 'default'
        ];
        $advanced_fields["box_shadow"]["hover"] = [
            'css' => [
              'main' => "%%order_class%% .dmpro-breadcrumb-item:hover a",
            ],
            'toggle_slug'       => 'breadcrumb_style',
            'sub_toggle'        => 'hover'
        ];
        $advanced_fields["box_shadow"]["active"] = [
            'css' => [
              'main' => "$this->main_css_element .dmpro-breadcrumb-current",
            ],
            'toggle_slug'       => 'breadcrumb_style',
            'sub_toggle'        => 'active'
        ];
        $advanced_fields["fonts"]["items"] = [
          'css' => [
              'main' => "%%order_class%% .dmpro-breadcrumb-item, %%order_class%% .dmpro-breadcrumb-item a",
          ],
          'font_size' => [
            'default' => '12px',
          ],
          'line_height' => [
            'range_settings' => [
              'default' => '1em',
              'min'  => '1',
              'max'  => '3',
              'step' => '0.1',
             ],
           ],
          'hide_text_align' => true,
          'toggle_slug'       => 'breadcrumb_style',
          'sub_toggle'        => 'default'
        ];
        $advanced_fields["fonts"]["hover"] = [
          'css'      => [
              'main' => "%%order_class%% .dmpro-breadcrumb-item:hover a",
          ],
          'font_size' => [
            'default' => '12px',
          ],
          'line_height' => [
            'range_settings' => [
              'default' => '1em',
              'min'  => '1',
              'max'  => '3',
              'step' => '0.1',
             ],
           ],
          'hide_text_align' => true,
          'toggle_slug'       => 'breadcrumb_style',
          'sub_toggle'        => 'hover'
        ];
        $advanced_fields["fonts"]["active"] = [
          'css' => [
              'main' => "%%order_class%% .dmpro-breadcrumb-current, %%order_class%% .dmpro-breadcrumb-current span",
              'important' => 'all',
          ],
          'font_size' => [
            'default' => '12px',
          ],
          'line_height' => [
            'range_settings' => [
              'default' => '1em',
              'min'  => '1',
              'max'  => '3',
              'step' => '0.1',
             ],
           ],
          'hide_text_align' => true,
          'toggle_slug'       => 'breadcrumb_style',
          'sub_toggle'        => 'active'
        ];
      return $advanced_fields;
    }
    public function get_custom_css_fields_config() {
        $css_fields = [];
        $css_fields['bc_items'] = array(
            'label' => esc_html__('Breadcrumbs Items', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-breadcrumb-item',
        );
        $css_fields['bc_items_link'] = array(
            'label' => esc_html__('Breadcrumbs Items Link', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-breadcrumb-item a',
        );
         $css_fields['bc_home'] = array(
            'label' => esc_html__('Home Element', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-breadcrumb-home',
        );
        $css_fields['bc_home_link'] = array(
            'label' => esc_html__('Home Element Link', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-breadcrumb-home a',
        );
        $css_fields['bc_current_item'] = array(
            'label' => esc_html__('Current Item', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-breadcrumb-current',
        );
        $css_fields['bc_separator'] = array(
            'label' => esc_html__('Separator', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-breadcrumb-separator',
        );
        return $css_fields;
    }
    public function render($attrs, $content, $render_slug) {
        wp_enqueue_style("dmpro-".$this->slug, $this->module_url . 'style.css', [], DMPRO_VERSION, 'all');
        $bc_custom_home         = $this->props['bc_custom_home'];
        $bc_home_text           = $this->props['bc_home_text'];
        $bc_home_url            = $this->props['bc_home_url'];
        $bc_home_size           = $this->props['bc_home_size'];
        $bc_home_color          = $this->props['bc_home_color'];
        $bc_home_icon           = $this->props['bc_home_icon'];
        $bc_hover_home_color    = $this->props['bc_hover_home_color'];
        $bc_separator           = $this->props['bc_separator'];
        $bc_separator_icon      = $this->props['bc_separator_icon'];
        $bc_separator_sysmbol   = $this->props['bc_separator_sysmbol'];
        $bc_separator_size      = $this->props['bc_separator_size'];
        $bc_separator_color     = $this->props['bc_separator_color'];
        $bc_separator_space     = $this->props['bc_separator_space'];
        $bc_item_bg_color       = $this->props['bc_item_bg_color'];
        $bc_hover_item_bg_color = $this->props['bc_hover_item_bg_color'];
        $bc_active_item_color   = $this->props['bc_active_item_color'];
        $bc_schema              = $this->props['bc_schema'];
        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-separator-icon, %%order_class%% .dmpro-separator-symbol',
            'declaration' => "font-size: {$bc_separator_size};"
        ]);
        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-separator-icon, %%order_class%% .dmpro-separator-symbol',
            'declaration' => "color: {$bc_separator_color};"
        ]);
        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-separator-icon, %%order_class%% .dmpro-separator-symbol',
            'declaration' => "margin-right: {$bc_separator_space}; margin-left: {$bc_separator_space};"
        ]);
        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-breadcrumb-home .dmpro-home-icon',
            'declaration' => "font-size: {$bc_home_size};"
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => "%%order_class%% .dmpro-home-icon, %%order_class%% .dmpro-home-icon:before",
            'declaration' => "color: {$bc_home_color} !important;"
        ]);
        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-breadcrumb-home:hover .dmpro-home-icon, %%order_class%% .dmpro-breadcrumb-home:hover .dmpro-home-icon:before',
            'declaration' => "color: {$bc_hover_home_color} !important;"
        ]);
        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-breadcrumb-item a',
            'declaration' => "background-color: {$bc_item_bg_color};"
        ]);
        $bc_item_padding                   = explode('|', $this->props['bc_item_padding']);
        $bc_item_padding_tablet            = explode('|', $this->props['bc_item_padding_tablet']);
        $bc_item_padding_phone             = explode('|', $this->props['bc_item_padding_phone']);
        $bc_item_padding_last_edited       = $this->props['bc_item_padding_last_edited'];
        $bc_item_padding_responsive_status = et_pb_get_responsive_status($bc_item_padding_last_edited);
        if(!empty($bc_item_padding) && count($bc_item_padding) > 1) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => "%%order_class%% .dmpro-breadcrumb-item:not(.dmpro-breadcrumb-current) a",
                'declaration' => sprintf( 'padding-top: %1$s !important; padding-right:%2$s !important; padding-bottom:%3$s !important; padding-left:%4$s !important;', $bc_item_padding[0], $bc_item_padding[1], $bc_item_padding[2], $bc_item_padding[3]),
            ) );
        }
        if(!empty($bc_item_padding_tablet) && count($bc_item_padding_tablet) > 1 && $bc_item_padding_responsive_status) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => "%%order_class%% .dmpro-breadcrumb-item:not(.dmpro-breadcrumb-current) a",
                'declaration' => sprintf( 'padding-top: %1$s !important; padding-right:%2$s !important; padding-bottom:%3$s !important; padding-left:%4$s !important;', $bc_item_padding_tablet[0], $bc_item_padding_tablet[1], $bc_item_padding_tablet[2], $bc_item_padding_tablet[3]),
                'media_query' => ET_Builder_Element::get_media_query('max_width_980')
            ));
        }
        if(!empty($bc_item_padding_phone) && count($bc_item_padding_phone) > 1 && $bc_item_padding_responsive_status) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => "%%order_class%% .dmpro-breadcrumb-item:not(.dmpro-breadcrumb-current) a",
                'declaration' => sprintf( 'padding-top: %1$s !important; padding-right:%2$s !important; padding-bottom:%4$s !important; padding-left:%4$s !important;', $bc_item_padding_phone[0], $bc_item_padding_phone[1], $bc_item_padding_phone[2], $bc_item_padding_phone[3]),
                'media_query' => ET_Builder_Element::get_media_query('max_width_767')
            ));
        }
        $bc_active_item_padding = explode('|', $this->props['bc_active_item_padding']);
        $bc_active_item_padding_tablet = explode('|', $this->props['bc_active_item_padding_tablet']);
        $bc_active_item_padding_phone = explode('|', $this->props['bc_active_item_padding_phone']);
        $bc_active_item_padding_last_edited = $this->props['bc_active_item_padding_last_edited'];
        $bc_active_item_padding_responsive_status = et_pb_get_responsive_status($bc_active_item_padding_last_edited);
        if(!empty($bc_active_item_padding) && count($bc_active_item_padding) > 1) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => '%%order_class%% .dmpro-breadcrumb-current',
                'declaration' => sprintf( 'padding-top: %1$s !important; padding-right:%2$s !important; padding-bottom:%3$s !important; padding-left:%4$s !important;', $bc_active_item_padding[0], $bc_active_item_padding[1], $bc_active_item_padding[2], $bc_active_item_padding[3]),
            ) );
        }
        if(!empty($bc_active_item_padding_tablet) && count($bc_active_item_padding_tablet) > 1 && $bc_active_item_padding_responsive_status) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => '%%order_class%% .dmpro-breadcrumb-current',
                'declaration' => sprintf( 'padding-top: %1$s !important; padding-right:%2$s !important; padding-bottom:%3$s !important; padding-left:%4$s !important;', $bc_active_item_padding_tablet[0], $bc_active_item_padding_tablet[1], $bc_active_item_padding_tablet[2], $bc_active_item_padding_tablet[3]),
                'media_query' => ET_Builder_Element::get_media_query('max_width_980')
            ));
        }
        if(!empty($bc_active_item_padding_phone) && count($bc_active_item_padding_phone) > 1 && $bc_active_item_padding_responsive_status) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => '%%order_class%% .dmpro-breadcrumb-current',
                'declaration' => sprintf( 'padding-top: %1$s !important; padding-right:%2$s !important; padding-bottom:%4$s !important; padding-left:%4$s !important;', $bc_active_item_padding_phone[0], $bc_active_item_padding_phone[1], $bc_active_item_padding_phone[2], $bc_active_item_padding_phone[3]),
                'media_query' => ET_Builder_Element::get_media_query('max_width_767')
            ));
        }
        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-breadcrumb-item:hover a',
            'declaration' => "background-color: {$bc_hover_item_bg_color}!important;"
        ]);
        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .dmpro-breadcrumb-current',
            'declaration' => "background-color: {$bc_active_item_color}!important;"
        ]);
        global $post;
        $post_id = get_the_ID();
        $parent_id = ($post) ? $post->post_parent : '';

        if ( self::$rendering ) {
            return '';
        }
        self::$rendering = true;
        $schema_item_list = '';
        $schema_item_list_element = '';
        $schema_item = '';
        $schema_item_name = '';
        if( $bc_schema == 'on' ) :
            $schema_item_list = 'itemscope itemtype="https://schema.org/BreadcrumbList"';
            $schema_item_list_element = 'itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"';
            $schema_item = 'itemprop="item"';
            $schema_item_name = 'itemprop="name"';
        endif;
        $separator = ($bc_separator === 'icon' ) ? sprintf('
            <li class="dmpro-breadcrumb-separator"><span class="et-pb-icon dmpro-separator-icon">%1$s</span></li>',
            et_sanitized_previously(et_pb_process_font_icon($bc_separator_icon))
            ) : sprintf('
            <li class="dmpro-breadcrumb-separator">
                <span class="dmpro-separator-symbol">%1$s</span>
            </li>', $bc_separator_sysmbol);
        $home_icon = ($bc_home_icon == 'on') ? '<span class="et-pb-icon dmpro-home-icon"></span>' : '';
        ob_start();
    ?>
        <?php if ( is_home() || is_front_page() ) : ?>
            <li <?php print et_sanitized_previously( $schema_item_list_element ); ?> class="dmpro-breadcrumb-item dmpro-breadcrumb-home">
                <?php if($bc_custom_home == 'on') : ?>
                    <a <?php print et_sanitized_previously( $schema_item ); ?> href="<?php print et_sanitized_previously( $bc_home_url ); ?>">
                        <span <?php print et_sanitized_previously( $schema_item_name ); ?>>
                            <?php print et_sanitized_previously( $home_icon ); ?>
                            <?php print et_sanitized_previously( $bc_home_text ); ?>
                        </span>
                    </a>
                <?php else : ?>
                    <a href="<?php print esc_url( get_home_url() ); ?>">
                        <span <?php print et_sanitized_previously( $schema_item_name ); ?>>
                            <?php print et_sanitized_previously( $home_icon ); ?>
                            <?php echo bloginfo('name'); ?>
                        </span>
                    </a>
                <?php endif; ?>
            </li>
        <?php else : 
            $position = 0;
         ?>
            <li <?php print et_sanitized_previously( $schema_item_list_element ); ?> class="dmpro-breadcrumb-item dmpro-breadcrumb-home">
                <?php if($bc_custom_home == 'on') : ?>
                    <a <?php print et_sanitized_previously( $schema_item ); ?> href="<?php print et_sanitized_previously( $bc_home_url ); ?>">
                        <span <?php print et_sanitized_previously( $schema_item_name ); ?> >
                            <?php print et_sanitized_previously( $home_icon ); ?>
                            <?php print et_sanitized_previously( $bc_home_text ); ?>
                        </span>
                    </a>
                <?php else : ?>
                    <a <?php print et_sanitized_previously( $schema_item ); ?> href="<?php print esc_url( get_home_url() ); ?>">
                        <span <?php print et_sanitized_previously( $schema_item_name ); ?>>
                            <?php print et_sanitized_previously( $home_icon ); ?>
                            <?php echo bloginfo('name'); ?>
                        </span>
                    </a>
                <?php 
                    endif;
                    if( $bc_schema == 'on' ) : 
                ?>
                    <meta itemprop="position" content="1" />
                <?php 
                    endif;
                ?>
            </li>
            <?php print et_sanitized_previously( $separator ); ?>
            <?php if(is_page() && !$parent_id ) : ?>
                <li <?php print et_sanitized_previously( $schema_item_list_element ); ?> class="dmpro-breadcrumb-item dmpro-breadcrumb-current">
                    <span <?php print et_sanitized_previously( $schema_item_name ); ?>>
                        <?php print et_sanitized_previously( get_the_title($post_id) ); ?> 
                    </span>
                </li>
            <?php elseif(is_page() && $parent_id) :
                $parents = get_post_ancestors( get_the_ID() );
                foreach ( array_reverse( $parents ) as $pageID ) :
                $position += 1;
                if($position > 1) print et_sanitized_previously( $separator );
            ?>
                <li <?php print et_sanitized_previously( $schema_item_list_element ); ?> class="dmpro-breadcrumb-item">
                    <a <?php print et_sanitized_previously( $schema_item ); ?> href="<?php echo esc_url( get_page_link( $pageID ) ); ?>">
                        <span <?php print et_sanitized_previously( $schema_item_name ); ?>>
                            <?php print et_sanitized_previously( get_the_title( $pageID ) ); ?>
                        </span>
                    </a>
                </li>
                <?php endforeach; print et_sanitized_previously( $separator ); ?>
                <li <?php print et_sanitized_previously( $schema_item_list_element ); ?> class="dmpro-breadcrumb-item dmpro-breadcrumb-current">
                    <span <?php print et_sanitized_previously( $schema_item_name ); ?>>
                        <?php print et_sanitized_previously( get_the_title( $post_id ) ); ?>
                    </span>
                </li>
                <?php else : ?>
                <li <?php print et_sanitized_previously( $schema_item_list_element ); ?> class="dmpro-breadcrumb-item dmpro-breadcrumb-current">
                    <span <?php print et_sanitized_previously( $schema_item_name ); ?>>
                        <?php print et_sanitized_previously( get_the_title( $post_id ) ); ?>
                    </span>
                </li>

                <?php

                endif;
            endif;
        $breadcrumb = ob_get_contents();
        ob_end_clean();
        self::$rendering = false;
        $output = sprintf(
            '<div class="dmpro-breadcrumbs">
                <ul %2$s>
                    %1$s
                </ul>
            </div>',
            $breadcrumb,
            $schema_item_list
        );
        return $output;
    }
    static function render_breadcrumbs( $args = array(), $conditional_tags = array(), $current_page = array() ) {
        $bc_custom_home       = (isset($args['bc_custom_home'])) ? $args['bc_custom_home'] : 'off';
        $bc_home_text         = (isset($args['bc_home_text'])) ? $args['bc_home_text'] : '';
        $bc_home_url          = (isset($args['bc_home_url'])) ? $args['bc_home_url'] : '';
        $bc_separator         = (isset($args['bc_separator'])) ? $args['bc_separator'] : 'icon';
        $bc_separator_icon    = (isset($args['bc_separator_icon'])) ? $args['bc_separator_icon'] : '';
        $bc_separator_sysmbol = (isset($args['bc_separator_sysmbol'])) ? $args['bc_separator_sysmbol'] : '';
        $is_home              = et_fb_conditional_tag('is_home', $conditional_tags );
        $is_front_page        = et_fb_conditional_tag('is_front_page', $conditional_tags );
        $is_single            = et_fb_conditional_tag('is_single', $conditional_tags);
        $post_id              = isset($current_page['id']) ? (int) $current_page['id'] : 0;
        $page_object          = get_post($post_id);
        $is_page              = isset($page_object->post_type) && 'page' === $page_object->post_type;
        $_post                = get_post($post_id );
        $parent_id            = get_post( $_post->post_parent);
        $bc_home_icon         = (isset($args['bc_home_icon'])) ? $args['bc_home_icon'] : '';
        if ( self::$rendering ) {
            return '';
        }
        self::$rendering = true;
        $separator = ($bc_separator == 'icon') ? sprintf('
            <li class="dmpro-breadcrumb-separator">
                <span class="et-pb-icon dmpro-separator-icon">
                    %1$s
                </span>
            </li>',
            et_sanitized_previously(et_pb_process_font_icon($bc_separator_icon))) : 
            sprintf('
                <li class="dmpro-breadcrumb-separator">
                    <span class="dmpro-separator-symbol">
                        %1$s
                    </span>
                </li>
                ',
                esc_attr($bc_separator_sysmbol)
        );
        $home_icon = $bc_home_icon == 'on' ? '<span class="et-pb-icon dmpro-home-icon"></span>' : '';
        ob_start();
        ?>
        <?php if($is_home || $is_front_page) : ?>
            <li class="dmpro-breadcrumb-item dmpro-breadcrumb-home">
                <?php if($bc_custom_home == 'on') : ?>
                    <a href="<?php echo esc_url($bc_home_url); ?>">
                        <span>
                            <?php print et_sanitized_previously( $home_icon ); ?>
                            <?php print et_sanitized_previously( $bc_home_text ); ?>
                        </span>
                    </a>
                <?php else : ?>
                    <a href="<?php echo esc_url(get_home_url()); ?>">
                        <span>
                            <?php print et_sanitized_previously( $home_icon ); ?>
                            <?php echo bloginfo('name'); ?>
                        </span>
                    </a>
                <?php endif; ?>
            </li>
        <?php 
            else :
            $position = 0;
         ?>
            <li class="dmpro-breadcrumb-item dmpro-breadcrumb-home">
                <?php if($bc_custom_home == 'on') : ?>
                    <a href="<?php echo esc_url($bc_home_url); ?>">
                        <span>
                            <?php print et_sanitized_previously( $home_icon ); ?>
                            <?php print et_sanitized_previously( $bc_home_text ); ?>
                        </span>
                    </a>
                <?php else : ?>
                    <a href="<?php echo esc_url(get_home_url()); ?>">
                        <span>
                            <?php print et_sanitized_previously( $home_icon ); ?>
                            <?php echo bloginfo('name'); ?>
                        </span>
                    </a>
                <?php endif; ?>
            </li>
            <?php print et_sanitized_previously( $separator ); ?>
            <?php if($is_page && !$parent_id) : ?>
            <li class="dmpro-breadcrumb-item dmpro-breadcrumb-current">
                <span><?php print et_sanitized_previously( get_the_title($post_id ) ); ?></span>
            </li>
            <?php elseif($is_page && $parent_id) :
                $parents = get_post_ancestors($post_id);
                foreach(array_reverse($parents) as $pageID) :
                    $position += 1;
                ?>
                <li class="dmpro-breadcrumb-item">
                    <span>
                        <a href="<?php esc_url(the_permalink($pageID)); ?>">
                            <?php print et_sanitized_previously( get_the_title( $pageID ) ); ?>
                        </a>
                    </span>
                </li>
                <?php print et_sanitized_previously( $separator ); endforeach; ?>
                <li class="dmpro-breadcrumb-item dmpro-breadcrumb-current">
                    <span>
                        <?php print et_sanitized_previously( get_the_title($post_id ) ); ?>
                    </span>
                </li>
                <?php else : ?>
                <li class="dmpro-breadcrumb-item dmpro-breadcrumb-current">
                    <span>
                        <?php print et_sanitized_previously( get_the_title($post_id ) ); ?>
                    </span>
                </li>
                <?php
            endif;
        endif;
        $breadcrumb = ob_get_contents();
        ob_end_clean();
        self::$rendering = false;
        $output = sprintf(
            '<ul> %1$s </ul>',
            $breadcrumb
        );
        return $output;
    }
}
new DMPRO_BreadCrumb;