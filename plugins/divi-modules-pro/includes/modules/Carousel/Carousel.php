<?php

class DMPRO_Carousel extends ET_Builder_Module {
	
	public $module_url = DMPRO_MODULES_URL . 'Carousel' . '/';

   protected $module_credits = array(
        'module_uri' => DMPRO_MODULE . 'divi-carousel-module',
        'author' => DMPRO_AUTHOR,
        'author_uri' => DMPRO_WEB,
    );

    public function init() {
        $this->icon_path = plugin_dir_path( __FILE__ ) . "Carousel.svg";
        $this->slug = 'dmpro_carousel';
        $this->vb_support = 'on';
        $this->name = esc_html__(DMPRO_PREFIX . 'Carousel', DMPRO_TEXTDOMAIN);
        $this->child_slug = 'dmpro_carousel_child';
        $this->main_css_element = '%%order_class%%.dmpro_carousel';
        $this->settings_modal_toggles = [
            'general' => [
                'toggles' => [
                    'carousel' => esc_html__('Carousel Settings', DMPRO_TEXTDOMAIN),
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'overlay' => esc_html__('Overlay', DMPRO_TEXTDOMAIN),
                    'alignment' => esc_html__('Alignment', DMPRO_TEXTDOMAIN),
                    'carousel_text' => [
                        'sub_toggles' => [
                            'title' => array(
                                'name' => 'Title',
                            ),
                            'desc' => array(
                                'name' => 'Desc',
                            ),
                        ],
                        'tabbed_subtoggles' => true,
                        'title' => esc_html__( 'Carousel Text', DMPRO_TEXTDOMAIN),
                    ],
                    'carousel_item' => esc_html__('Carousel Item', DMPRO_TEXTDOMAIN),
                    'navigation' => esc_html__('Carousel Navigation', DMPRO_TEXTDOMAIN),
                    'pagination' => esc_html__('Carousel Pagination', DMPRO_TEXTDOMAIN),
                ],
            ],
        ];
    }
    
    public function get_fields() {

        $module_fields = [];

        $module_fields['columns'] = [
            'label' => esc_html__('Number of Columns', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'default' => '4',
            'range_settings' => [
                'min'  => '1',
                'max'  => '12',
                'step' => '1'
            ],
            'unitless' => true,
            'mobile_options' => true,
            'responsive' => true,
            'toggle_slug' => 'carousel'
        ];

        $module_fields['space_between'] = [
            'label' => esc_html__('Spacing', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'default' => '30',
            'range_settings' => [
                'min'  => '5',
                'max'  => '100',
                'step' => '1'
            ],
            'unitless' => true,
            'mobile_options' => true,
            'responsive' => true,
            'toggle_slug' => 'carousel'
        ];

        $module_fields['container_padding'] = [
            'label' => esc_html__('Container Padding', DMPRO_TEXTDOMAIN),
            'type' => 'custom_margin',
            'default' => '30px|30px|30px|30px',
            'mobile_options' => true,
            'responsive' => true,
            'tab_slug' => 'advanced',
            'toggle_slug' => 'margin_padding'
        ];

        $module_fields['effect'] = [
            'label' => esc_html__( 'Transition Effect', DMPRO_TEXTDOMAIN ),
            'type' => 'select',
            'option_category' => 'layout',
            'options' => [
                'coverflow' => esc_html__( 'Coverflow', DMPRO_TEXTDOMAIN ),
                'slide' => esc_html__( 'Slide', DMPRO_TEXTDOMAIN )
            ],
            'default' => 'slide',
            'toggle_slug' => 'carousel'
        ];

        $module_fields['slide_shadows'] = [
            'label' => esc_html__( 'Slide Shadow', DMPRO_TEXTDOMAIN ),
            'type' => 'yes_no_button',
            'option_category'  => 'configuration',
            'options' => [
                'on'  => esc_html__( 'Yes', DMPRO_TEXTDOMAIN ),
                'off' => esc_html__( 'No', DMPRO_TEXTDOMAIN )
            ],
            'default' => 'on',
            'show_if' => [
                'effect' => 'coverflow',
            ],
            'toggle_slug' => 'carousel'
        ];

        $module_fields["shadow_overlay_color"] = [
            'label' => esc_html__( 'Side Item Color', DMPRO_TEXTDOMAIN ),
            'type' => 'color-alpha',
            'show_if' => [
                'effect' => 'coverflow',
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'overlay'
        ];

        $module_fields['rotate'] = [
            'label' => esc_html__( 'Rotate', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'range_settings ' => [
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ],
            'default' => '50',
            'show_if' => [
                'effect' => 'coverflow',
            ],
            'validate_unit'     => true,
            'toggle_slug'     => 'carousel'
        ];

        $module_fields['speed'] = [
            'label' => esc_html__( 'Transition Duration', DMPRO_TEXTDOMAIN ),
            'type' => 'range',
            'range_settings' => [
                'min'  => '1',
                'max'  => '5000',
                'step' => '100'
            ],
            'default' => 500,
            'validate_unit' => false,
            'toggle_slug'   => 'carousel'
        ];

        $module_fields['loop'] = [
            'label' => esc_html__( 'Enable Carousel Loop', DMPRO_TEXTDOMAIN ),
            'type' => 'yes_no_button',
            'option_category'  => 'configuration',
            'options' => [
                'on'  => esc_html__( 'Yes', DMPRO_TEXTDOMAIN ),
                'off' => esc_html__( 'No', DMPRO_TEXTDOMAIN )
            ],
            'default' => 'off',
            'toggle_slug' => 'carousel'
        ];

        $module_fields['autoplay'] = [
            'label' => esc_html__( 'Enable Carousel Autoplay', DMPRO_TEXTDOMAIN ),
            'type' =>  'yes_no_button',
            'options' => [
                'off' => esc_html__( 'No', DMPRO_TEXTDOMAIN ),
                'on'  => esc_html__( 'Yes', DMPRO_TEXTDOMAIN ),
            ],
            'default'           => 'off',
            'toggle_slug' => 'carousel'
        ];

        $module_fields['pause_on_hover'] = [
            'label' =>  esc_html__('Pause on Hover', DMPRO_TEXTDOMAIN),
            'type' =>  'yes_no_button',
            'options' => [
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
                'on'  => esc_html__('Yes', DMPRO_TEXTDOMAIN)
            ],
            'show_if' => [
                'autoplay'  => 'on',
            ],
            'toggle_slug'     => 'carousel',
            'default'           => 'on'
        ];

        $module_fields['autoplay_speed'] = [
            'label' => esc_html__( 'Autoplay Speed', DMPRO_TEXTDOMAIN ),
            'type' => 'range',
            'range_settings'  => array(
                'min'  => '1',
                'max'  => '10000',
                'step' => '500'
            ),
            'default' => 5000,
            'validate_unit' => false,
            'show_if' => array(
                'autoplay' => 'on',
            ),
            'toggle_slug' => 'carousel'
        ];

        $module_fields['navigation'] = [
            'label' =>  esc_html__( 'Enable Carousel Navigation', DMPRO_TEXTDOMAIN),
            'type' =>  'yes_no_button',
            'options' => [
                'off' => esc_html__( 'No', DMPRO_TEXTDOMAIN ),
                'on'  => esc_html__( 'Yes', DMPRO_TEXTDOMAIN ),
            ],
            'toggle_slug' => 'carousel',
            'default' => 'off'
        ];

        $module_fields['pagination'] = [
            'label' =>  esc_html__( 'Enable Carousel Pagination', DMPRO_TEXTDOMAIN),
            'type' =>  'yes_no_button',
            'options' => [
                'off' => esc_html__( 'No', DMPRO_TEXTDOMAIN ),
                'on'  => esc_html__( 'Yes', DMPRO_TEXTDOMAIN )
            ],
            'toggle_slug' => 'carousel',
            'default' => 'off'
        ];

        $module_fields['dynamic_bullets'] = [
            'label' =>  esc_html__( 'Dynamic Bullets', DMPRO_TEXTDOMAIN),
            'type' =>  'yes_no_button',
            'options' => [
                'off' => esc_html__( 'No', DMPRO_TEXTDOMAIN ),
                'on' => esc_html__( 'Yes', DMPRO_TEXTDOMAIN ),
            ],
            'toggle_slug' => 'carsousel',
            'default'           => 'on'
        ];

        $module_fields['centered'] = [
            'label' => esc_html__( 'Enable Centered Carousel', DMPRO_TEXTDOMAIN ),
            'type' => 'yes_no_button',
            'option_category'  => 'configuration',
            'options' => array(
                'on'  => esc_html__( 'Yes', DMPRO_TEXTDOMAIN ),
                'off' => esc_html__( 'No', DMPRO_TEXTDOMAIN ),
            ),
            'default'          => 'off',
            'toggle_slug'     => 'carousel'
        ];

        $module_fields['navigation_prev_icon_yn'] = [
            'label' =>  esc_html__('Prev Nav Custom Icon', DMPRO_TEXTDOMAIN),
            'type' =>  'yes_no_button',
            'options' => [
                'off' => esc_html__( 'No', DMPRO_TEXTDOMAIN ),
                'on'  => esc_html__( 'Yes', DMPRO_TEXTDOMAIN ),
            ],
            'default' => 'off',
            'tab_slug'  => 'advanced',
            'toggle_slug'   => 'navigation'
        ];

        $module_fields['navigation_prev_icon'] = [
            'label' => esc_html__( 'Select Previous Nav icon', DMPRO_TEXTDOMAIN ),
            'type'  => 'select_icon',
            'class' => array('et-pb-font-icon'),
            'default' => '8',
            'show_if' => ['navigation_prev_icon_yn' => 'on'],
            'tab_slug'  => 'advanced',
            'toggle_slug' => 'navigation'
        ];

        $module_fields['navigation_next_icon_yn'] = [
            'label' =>  esc_html__('Next Nav Custom Icon', DMPRO_TEXTDOMAIN),
            'type' =>  'yes_no_button',
            'options' => array(
                'off' => esc_html__( 'No', DMPRO_TEXTDOMAIN ),
                'on'  => esc_html__( 'Yes', DMPRO_TEXTDOMAIN ),
            ),
            'default'   => 'off',
            'tab_slug'  => 'advanced',
            'toggle_slug'   => 'navigation'
        ];

        $module_fields['navigation_next_icon'] = [
            'label' => esc_html__( 'Select Next Nav icon', DMPRO_TEXTDOMAIN ),
            'type' => 'select_icon',
            'class' => array('et-pb-font-icon'),
            'default' => '9',
            'show_if' =>['navigation_next_icon_yn' => 'on'],
            'tab_slug'  => 'advanced',
            'toggle_slug'   => 'navigation'
        ];

        $module_fields['navigation_size'] = [
            'label' => esc_html__('Icon Size', DMPRO_TEXTDOMAIN ),
            'type' => 'range',
            'range_settings'  => array(
                'min'  => '1',
                'max'  => '100',
                'step' => '1'
            ),
            'default' => 50,
            'validate_unit' => false,
            'tab_slug'  => 'advanced',
            'toggle_slug' => 'navigation'
        ];

        $module_fields['navigation_padding'] = [
            'label' => esc_html__( 'Icon Padding', DMPRO_TEXTDOMAIN ),
            'type' => 'range',
            'range_settings'  => [
                'min'  => '1',
                'max'  => '100',
                'step' => '1'
            ],
            'default' => 10,
            'validate_unit' => false,
            'tab_slug' => 'advanced',
            'toggle_slug' => 'navigation'
        ];

        $module_fields['navigation_color'] = [
            'label' => esc_html__( 'Arrow Color', DMPRO_TEXTDOMAIN ),
            'type'  =>  'color-alpha',
            'default'   => et_builder_accent_color(),
            'tab_slug'  => 'advanced',
            'toggle_slug'   => 'navigation'
        ];

        $module_fields['navigation_bg_color'] = [
            'label' => esc_html__( 'Arrow Background', DMPRO_TEXTDOMAIN ),
            'type' => 'color-alpha',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'navigation'
        ];

        $module_fields['navigation_circle'] = [
            'label' => esc_html__( 'Circle Arrow', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'options' => array(
                'off' => esc_html__( 'No', DMPRO_TEXTDOMAIN ),
                'on'  => esc_html__( 'Yes', DMPRO_TEXTDOMAIN ),
            ),
            'default' => 'off',
            'tab_slug'  => 'advanced',
            'toggle_slug' => 'navigation'
        ];

        $module_fields['navigation_position_left'] = [
            'label' => esc_html__('Left Navigation Postion', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'default' => '-66px',
            'default_on_front'=> '-66px',
            'default_unit' => 'px',
            'allowed_units' => array( '%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
            'range_settings' => [
                'min'  => '-200',
                'max'  => '200',
                'step' => '1'
            ],
            'mobile_options' => true,
            'responsive' => true,
            'tab_slug' => 'advanced',
            'toggle_slug' => 'navigation'
        ];

        $module_fields['navigation_position_right'] = [
            'label' => esc_html__('Right Navigation Postion', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'default' => '-66px',
            'default_on_front'=> '-66px',
            'default_unit' => 'px',
            'allowed_units' => array( '%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
            'range_settings' => [
                'min'  => '-200',
                'max'  => '200',
                'step' => '1'
            ],
            'mobile_options' => true,
            'responsive' => true,
            'tab_slug' => 'advanced',
            'toggle_slug' => 'navigation'
        ];

        $module_fields['pagination_position'] = [
            'label' => esc_html__('Pagination Postion', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'default' => '-40',
            'range_settings' => [
                'min'  => '-200',
                'max'  => '200',
                'step' => '1'
            ],
            'unitless' => true,
            'show_if' => ['pagination' => 'on'],
            'tab_slug' => 'advanced',
            'toggle_slug' =>  'pagination'
        ];

        $module_fields['pagination_color'] = [
            'label' => esc_html__( 'Pagination Color', DMPRO_TEXTDOMAIN ),
            'type'  =>  'color-alpha',
            'default' => '#d8d8d8',
            'show_if' => ['pagination' => 'on'],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'pagination'
        ];

        $module_fields['pagination_active_color'] = [
            'label' => esc_html__( 'Pagination Active Color', DMPRO_TEXTDOMAIN ),
            'type'  =>  'color-alpha',
            'default'   => et_builder_accent_color(),
            'show_if'   => ['pagination' => 'on'],
            'tab_slug'  => 'advanced',
            'toggle_slug' =>  'pagination'
        ];

        return $module_fields;
    }

    public function get_advanced_fields_config() {

        $advanced_fields = [];

        $advanced_fields['fonts'] = false;
        $advanced_fields['text'] = false;
        $advanced_fields['text_shadow'] = false;

        $advanced_fields['margin_padding'] = [
          'css' => [
            'margin' => '%%order_class%%',
            'padding' => '%%order_class%%',
            'important' => 'all',
          ],
        ];

        $advanced_fields["fonts"]["title"] = [
            'label'    => esc_html__('Title', DMPRO_TEXTDOMAIN),
            'css'      => [
              'main' => "%%order_class%% .dmpro_carousel_child .dmpro-carousel-item-title",
            ],
            'font_size' => [
            'default' => '22px',
            ],
            'line_height' => [
            'range_settings' => [
              'default' => '1em',
              'min'  => '1',
              'max'  => '3',
              'step' => '0.1',
             ],
            ],
            'important' => 'all',
            'hide_text_align' => true,
            'toggle_slug' => 'carousel_text',
            'sub_toggle'  => 'title'
        ];

        $advanced_fields["fonts"]["desc"] = [
            'label'    => esc_html__('Description', DMPRO_TEXTDOMAIN),
            'css'      => [
              'main' => "%%order_class%% .dmpro_carousel_child .dmpro-carousel-item-desc",
            ],
            'font_size' => [
                'default' => '15px',
            ],
            'line_height' => [
                'range_settings' => [
                'default' => '1em',
                'min'  => '1',
                'max'  => '3',
                'step' => '.1',
             ],
            ],
            'important' => 'all',
            'hide_text_align' => true,
            'toggle_slug' => 'carousel_text',
            'sub_toggle'  => 'desc'
        ];

        $advanced_fields['button']["button"] = [
            'label'    => esc_html__('Button', DMPRO_TEXTDOMAIN),
            'css' => [
                'main' => "%%order_class%% .dmpro-carousel-button",
                'alignment' => "%%order_class%% .dmpro-carousel-button-wrap",
            ],
            'use_alignment' => false,
            'hide_icon' => true,
            'box_shadow'  => [
              'css' => [
                'main' => "%%order_class%% .dmpro-carousel-button",
                'important' => true,
              ],
            ],
            'margin_padding' => [
              'css' => [
                'main' => "%%order_class%% .dmpro-carousel-button",
                'important' => 'all',
              ],
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

        $advanced_fields["borders"]["item"] = [
            'css' => [
              'main' => [
                    'border_radii' => "%%order_class%% .dmpro_carousel_child",
                    'border_styles' => "%%order_class%% .dmpro_carousel_child",
                ],
            ],
            'toggle_slug' => 'carousel_item',
        ];

        $advanced_fields["box_shadow"]["default"] = [
            'css' => [
              'main' => "%%order_class%% .dmpro_carousel_child",
            ],
            'toggle_slug' => 'carousel_item',
        ];
        
        return $advanced_fields;
    }
    
    public function get_custom_css_fields_config() {
        
        $custom_css_fields = [];

        $custom_css_fields['img'] = [
            'label'    => esc_html__('Image', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-carousel-image',
        ];

        $custom_css_fields['icon'] = [
            'label'    => esc_html__('Icon', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-carousel-icon',
        ];
        
        $custom_css_fields['title'] = [
            'label'    => esc_html__('Title', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-carousel-item-title',
        ];

        $custom_css_fields['description'] = [
            'label'    => esc_html__('Description', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-carousel-item-desc',
        ];

        $custom_css_fields['button'] = [
            'label'    => esc_html__('Button', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-carousel-button',
        ];

        $custom_css_fields['navigation'] = [
            'label'    => esc_html__('Carousel Navigation', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .swiper-arrow-button',
        ];

        $custom_css_fields['pagination'] = [
            'label'    => esc_html__('Carousel Pagination', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .swiper-pagination',
        ];

        return $custom_css_fields;
    }

    public function render($attrs, $content, $render_slug) {
        wp_enqueue_style("dmpro-".$this->slug, $this->module_url . 'style.css', ['dmpro_swiper_style'], DMPRO_VERSION , 'all');
        wp_enqueue_script("dmpro-".$this->slug, $this->module_url . 'custom.js', array('jquery', 'dmpro_swiper_script'), DMPRO_VERSION, false, true);
        
        $this->apply_css($render_slug);

        $get_carousel_content                = $this->get_carousel_content();
        $speed                               = $this->props['speed'];
        $loop                                = $this->props['loop'];
        $centered                            = $this->props['centered'];
        $autoplay                            = $this->props['autoplay'];
        $autoplay_speed                      = $this->props['autoplay_speed'];
        $pause_on_hover                      = $this->props['pause_on_hover'];
        $navigation                          = $this->props['navigation'];
        $pagination                          = $this->props['pagination'];
        $effect                              = $this->props['effect'];
        $rotate                              = $this->props['rotate'];
        $dynamic_bullets                     = $this->props['dynamic_bullets'];
        $order_class                         = self::get_module_order_class( $render_slug );
        $order_number                        = str_replace('_','',str_replace($this->slug,'', $order_class));
        $slide_shadows                       = 'on' === $this->props['slide_shadows'] ? esc_attr('true') : esc_attr('false');
        
        $data_next_icon                      = $this->props['navigation_next_icon'];
        $data_prev_icon                      = $this->props['navigation_prev_icon'];
        
        $options                             = [];
        
        $columns                             = $this->get_responsive_prop('columns');
        if($columns['desktop'] === "4" && $columns['tablet'] === "4" && $columns['phone'] === "4") {
            $columns['tablet'] = "2";
            $columns['phone'] = "1";
        }
        $options['data-columnsdesktop']      = esc_attr($columns['desktop']);
        $options['data-columnstablet']       = esc_attr($columns['tablet']);
        $options['data-columnsphone']        = esc_attr($columns['phone']);
        
        $space_between                       = $this->get_responsive_prop('space_between');
        $options['data-spacebetween']        = esc_attr($space_between['desktop']);
        $options['data-spacebetween_tablet'] = esc_attr($space_between['tablet']);
        $options['data-spacebetween_phone']  = esc_attr($space_between['phone']);
        
        $options['data-loop']                = esc_attr($loop);
        $options['data-speed']               = esc_attr($speed);
        $options['data-navigation']          = esc_attr($navigation);
        $options['data-pagination']          = esc_attr($pagination);
        $options['data-autoplay']            = esc_attr($autoplay);
        $options['data-autoplayspeed']       = esc_attr($autoplay_speed);
        $options['data-pauseonhover']        = esc_attr($pause_on_hover);
        $options['data-effect']              = esc_attr($effect);
        $options['data-rotate']              = esc_attr($rotate);
        $options['data-dynamicbullets']      = esc_attr($dynamic_bullets);
        $options['data-ordernumber']         = esc_attr($order_number);
        $options['data-centered']            = esc_attr($centered);
        $options['data-shadow']              = esc_attr($slide_shadows);

        $options = implode(
            " ", 
            array_map(
                function($k, $v){
                    return "{$k}='{$v}'";
                }, 
                array_keys($options),
                $options
            )
        );
        
        $next_icon_render = 'data-icon="9"';
        if('on' === $this->props['navigation_next_icon_yn']) {
            $next_icon_render = sprintf( 'data-icon="%1$s"', esc_attr( et_pb_process_font_icon( $data_next_icon ) ) );
        }

        $prev_icon_render = 'data-icon="8"';
        if('on' === $this->props['navigation_next_icon_yn']) {
            $prev_icon_render = sprintf( 'data-icon="%1$s"', esc_attr( et_pb_process_font_icon( $data_prev_icon ) ) );
        }

        $navigation = '';
        if( $this->props['navigation'] == 'on' ) {

            $navigation = sprintf(
                '<div class="swiper-button-next swiper-arrow-button dmpro-sbn%1$s" %2$s></div> 
                 <div class="swiper-button-prev swiper-arrow-button dmpro-sbp%1$s" %3$s></div>
                 ',
                $order_number,
                $next_icon_render,
                $prev_icon_render
            );

        }

        $pagination = '';
        if( $this->props['pagination'] == 'on' ) {
            $pagination = sprintf(
                '<div class="swiper-pagination dmpro-sp%1$s"></div>',
                $order_number
            );
        }
		
        return sprintf('
            <div class="dmpro-carousel-main" %2$s>
                <div class="swiper swiper-dmpro-container">
                    <div class="swiper-wrapper dmpro-carousel-wrapper">
                        %1$s
                    </div>
                </div>
                %3$s
                %4$s
            </div>',
            $get_carousel_content,
            $options,
			$pagination,
            $navigation
        ); 
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

    public function get_carousel_content() {
        return $this->content;
    }

    public function apply_css($render_slug) {

        $container_class                     = "%%order_class%% .swiper-dmpro-container";
        $navigation_position_left_class      = "%%order_class%% .swiper-button-prev";
        $navigation_position_right_class     = "%%order_class%% .swiper-button-next";
        
        $important                           = false;
        
        $container_padding                   = explode('|', $this->props['container_padding']);
        $container_padding_tablet            = explode('|', $this->props['container_padding_tablet']);
        $container_padding_phone             = explode('|', $this->props['container_padding_phone']);
        
        $container_padding_last_edited       = $this->props['container_padding_last_edited'];
        $container_padding_responsive_status = et_pb_get_responsive_status($container_padding_last_edited);

        if('' !== $container_padding) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => $container_class,
                'declaration' => sprintf( 'padding-top: %1$s !important; padding-right:%2$s !important; padding-bottom:%3$s !important; padding-left:%4$s !important;', $container_padding[0], $container_padding[1], $container_padding[2], $container_padding[3]),
            ) );
        }

        if('' !== $container_padding_tablet && $container_padding_responsive_status) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => $container_class,
                'declaration' => sprintf( 'padding-top: %1$s !important; padding-right:%2$s !important; padding-bottom:%3$s !important; padding-left:%4$s !important;', $container_padding_tablet[0], $container_padding_tablet[1], $container_padding_tablet[2], $container_padding_tablet[3]),
                'media_query' => ET_Builder_Element::get_media_query('max_width_980')
            ));
        }

        if('' !== $container_padding_phone && $container_padding_responsive_status) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => $container_class,
                'declaration' => sprintf( 'padding-top: %1$s !important; padding-right:%2$s !important; padding-bottom:%3$s !important; padding-left:%4$s !important;', $container_padding_phone[0], $container_padding_phone[1], $container_padding_phone[2], $container_padding_phone[3]),
                'media_query' => ET_Builder_Element::get_media_query('max_width_767')
            ));
        }

        $navigation_position_left = $this->props['navigation_position_left'];
        $navigation_position_left_tablet = $this->props['navigation_position_left_tablet'];
        $navigation_position_left_phone = $this->props['navigation_position_left_phone'];
        $navigation_position_left_last_edited = $this->props['navigation_position_left_last_edited'];
        $navigation_position_left_responsive_status = et_pb_get_responsive_status($navigation_position_left_last_edited);

        if('' !== $navigation_position_left ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => $navigation_position_left_class,
                'declaration' => sprintf('left: %1$s !important;', $navigation_position_left),
            ) );
        }

        if('' !== $navigation_position_left_tablet && $navigation_position_left_responsive_status) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => $navigation_position_left_class,
                'declaration' => sprintf( 'left: %1$s !important;', $navigation_position_left_tablet),
                'media_query' => ET_Builder_Element::get_media_query('max_width_980')
            ));
        }

        if('' !== $navigation_position_left_phone && $navigation_position_left_responsive_status) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => $navigation_position_left_class,
                'declaration' => sprintf( 'left: %1$s !important;', $navigation_position_left_phone),
                'media_query' => ET_Builder_Element::get_media_query('max_width_767')
            ));
        }

        $navigation_position_right = $this->props['navigation_position_right'];
        $navigation_position_right_tablet = $this->props['navigation_position_right_tablet'];
        $navigation_position_right_phone = $this->props['navigation_position_right_phone'];
        $navigation_position_right_last_edited = $this->props['navigation_position_right_last_edited'];
        $navigation_position_right_responsive_status = et_pb_get_responsive_status($navigation_position_right_last_edited);

        if( '' !== $navigation_position_right ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => $navigation_position_right_class,
                'declaration' => sprintf( 'right: %1$s !important;', $navigation_position_right),
            ));
        }

        if( '' !== $navigation_position_right_tablet && $navigation_position_right_responsive_status ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => $navigation_position_right_class,
                'declaration' => sprintf( 'right: %1$s !important;', $navigation_position_right_tablet),
                'media_query' => ET_Builder_Element::get_media_query('max_width_980')
            ));
        }

        if( '' !== $navigation_position_right_phone && $navigation_position_right_responsive_status) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => $navigation_position_right_class,
                'declaration' => sprintf( 'right: %1$s !important;', $navigation_position_right_phone),
                'media_query' => ET_Builder_Element::get_media_query('max_width_767')
            ));
        }

        if( '' !== $this->props['navigation_color'] ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector'    => '%%order_class%% .swiper-button-next:after, %%order_class%% .swiper-button-next:before, %%order_class%% .swiper-button-prev:after, %%order_class%% .swiper-button-prev:before',
                'declaration' => sprintf('color: %1$s!important;', $this->props['navigation_color']),
            ) );
        }

        if( '' !== $this->props['navigation_bg_color'] ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector'    => '%%order_class%% .swiper-button-next, %%order_class%% .swiper-button-prev',
                'declaration' => sprintf('background: %1$s!important;', $this->props['navigation_bg_color']),
            ) );
        }

        if( '' !== $this->props['navigation_size'] ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector'    => '%%order_class%% .swiper-button-next, %%order_class%% .swiper-button-prev',
                'declaration' => sprintf(
                    'width: %1$spx !important; height: %1$spx !important;', 
                    $this->props['navigation_size']),
            ) );
        }

        if( '' !== $this->props['navigation_size'] ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => '%%order_class%% .swiper-button-next:after, %%order_class%% .swiper-button-next:before, %%order_class%% .swiper-button-prev:after, %%order_class%% .swiper-button-prev:before',
                'declaration' => sprintf('font-size: %1$spx !important;', $this->props['navigation_size']),
            ) );
        }

        if( '' !== $this->props['navigation_padding'] ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector'    => '%%order_class%% .swiper-button-next, %%order_class%% .swiper-button-prev',
                'declaration' => sprintf(
                    'padding: %1$spx !important;', 
                    $this->props['navigation_padding']),
            ) );
        }

        if( 'on' == $this->props['navigation_circle'] ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector'    => '%%order_class%% .swiper-button-next, %%order_class%% .swiper-button-prev',
                'declaration' => 'border-radius: 50% !important;',
            ) );
        }

        if( '' !== $this->props['pagination_color'] ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector'    => '%%order_class%% .swiper-pagination-bullet',
                'declaration' => sprintf(
                    'background: %1$s!important;', $this->props['pagination_color']),
            ) );
        }

        if( '' !== $this->props['pagination_active_color'] ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector'    => '%%order_class%% .swiper-pagination-bullet.swiper-pagination-bullet-active',
                'declaration' => sprintf(
                    'background: %1$s!important;', $this->props['pagination_active_color']),
            ) );
        }

        if( '' !== $this->props['pagination_position'] ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector'    => '%%order_class%% .swiper-container-horizontal > .swiper-pagination-bullets, %%order_class%% .swiper-pagination-fraction, %%order_class%% .swiper-pagination-custom',
                'declaration' => sprintf(
                    'bottom: %1$spx !important;', 
                    $this->props['pagination_position']),
            ) );
        }

        $slideShadows = $this->props['slide_shadows'];
        $shadow_overlay_color = $this->props['shadow_overlay_color'];

        if ( $slideShadows == 'on' ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => '%%order_class%% .dmpro-carousel-main .swiper-container-3d .swiper-slide-shadow-left',
                'declaration' => 'background-image: -webkit-gradient(linear, right top, left top, from('.$shadow_overlay_color.'), to(rgba(0, 0, 0, 0))); background-image: -webkit-linear-gradient(right, '.$shadow_overlay_color.', rgba(0, 0, 0, 0)); background-image: -o-linear-gradient(right, '.$shadow_overlay_color.', rgba(0, 0, 0, 0)); background-image: linear-gradient(to left, '.$shadow_overlay_color.', rgba(0, 0, 0, 0));',
            ) );
            
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => '%%order_class%% .dmpro-carousel-main .swiper-container-3d .swiper-slide-shadow-right',
                'declaration' => 'background-image: -webkit-gradient(linear, left top, right top, from('.$shadow_overlay_color.'), to(rgba(0, 0, 0, 0))); background-image: -webkit-linear-gradient(left, '.$shadow_overlay_color.', rgba(0, 0, 0, 0));background-image: -o-linear-gradient(left, '.$shadow_overlay_color.', rgba(0, 0, 0, 0)); background-image: linear-gradient(to right, '.$shadow_overlay_color.', rgba(0, 0, 0, 0));',
            ) );
            
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => '%%order_class%% .dmpro-carousel-main .swiper-container-3d .swiper-slide-shadow-top',
                'declaration' => 'background-image: -webkit-gradient(linear, left bottom, left top, from('.$shadow_overlay_color.'), to(rgba(0, 0, 0, 0))); background-image: -webkit-linear-gradient(bottom, '.$shadow_overlay_color.', rgba(0, 0, 0, 0)); background-image: -o-linear-gradient(bottom, '.$shadow_overlay_color.', rgba(0, 0, 0, 0)); background-image: linear-gradient(to top, '.$shadow_overlay_color.', rgba(0, 0, 0, 0));',
            ) );
            
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => '%%order_class%% .dmpro-carousel-main .swiper-container-3d .swiper-slide-shadow-bottom',
                'declaration' => ' background-image: -webkit-gradient(linear, left top, left bottom, from('.$shadow_overlay_color.'), to(rgba(0, 0, 0, 0))); background-image: -webkit-linear-gradient(top, '.$shadow_overlay_color.', rgba(0, 0, 0, 0)); background-image: -o-linear-gradient(top, '.$shadow_overlay_color.', rgba(0, 0, 0, 0));background-image: linear-gradient(to bottom, '.$shadow_overlay_color.', rgba(0, 0, 0, 0));',
            ) );    
        }
                            
    }
}

new DMPRO_Carousel;