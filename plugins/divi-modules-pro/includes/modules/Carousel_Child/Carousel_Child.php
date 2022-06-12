<?php

if ( ! function_exists( 'get_library_layouts' ) ) :
function get_library_layouts() {

    $args = array(
        'post_type' => 'et_pb_layout',
        'posts_per_page' => -1
    );

    $query = new WP_Query( $args );

    $library_layouts = [];

    $library_layouts = [
        '0' => __('Select A Layout', DMPRO_TEXTDOMAIN)
    ];
  
    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
            $library_layouts[get_the_ID()] = get_the_title();
        endwhile;
    endif;

    wp_reset_postdata();

    return $library_layouts;

}

endif;

class DMPRO_Carousel_Child extends ET_Builder_Module {
	
	public $module_url = DMPRO_MODULES_URL . 'Carousel_Child' . '/';

    public function init() {

        $this->name = esc_html__( 'Carousel Slide', DMPRO_TEXTDOMAIN );
        $this->plural = esc_html__( 'Carousel Slides', DMPRO_TEXTDOMAIN );
        $this->slug = 'dmpro_carousel_child';
        $this->vb_support = 'on';
        $this->type = 'child';
        $this->child_title_var = 'title';
        $this->advanced_setting_title_text = esc_html__( 'New Slide', DMPRO_TEXTDOMAIN );
        $this->settings_text = esc_html__( 'Slide Settings', DMPRO_TEXTDOMAIN );
        $this->main_css_element = '%%order_class%%';

        $this->settings_modal_toggles = [
            'general' => [
                'toggles' => [
                    'main_content' => esc_html__('Content', DMPRO_TEXTDOMAIN),
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'icon_settings' => esc_html__( 'Icon', DMPRO_TEXTDOMAIN ),
                    'img_settings' => esc_html__('Image', DMPRO_TEXTDOMAIN ),
                    'carousel_text' => [
                        'sub_toggles' => [
                            'title' => [ 'name' => 'Title' ],
                            'desc' => [ 'name' => 'Desc' ],
                        ],
                        'tabbed_subtoggles'    => true,
                        'title' => esc_html__( 'Carousel Text', DMPRO_TEXTDOMAIN),
                    ]
                ],
            ],
        ];
    }

    public function get_fields() {

        $module_fields = [];
        $module_fields["title"] = [
            'label' => esc_html__('Admin Label', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'default' => 'Carousel',
            'toggle_slug' => 'main_content',
        ];
        $module_fields["type"] = [
            'label' => esc_html__('Content Type', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'default' => 'default',
            'options' => [
                'default' => esc_html__('Default', DMPRO_TEXTDOMAIN),
                'divi_library' => esc_html__('Divi Library', DMPRO_TEXTDOMAIN),
            ],
            'toggle_slug' => 'main_content',
            'affects' => [
                'use_icon',
                'img_src',
                'img_alt',
                'text_title',
                'desc_text',
                'show_button',
                'divi_library_id'
            ]
        ];

        $module_fields["divi_library_id"] = [
            'label' => esc_html__('Divi Library', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'option_category' => 'basic_option',
            'options' => get_library_layouts(),
            'depends_show_if' => 'divi_library',
            'computed_affects' => [
                '__divilibrary',
            ],
            'toggle_slug' => 'main_content'
        ];

        $module_fields["use_icon"] = [
            'label' => esc_html__( 'Enable Carousel Icon', DMPRO_TEXTDOMAIN ),
            'type' => 'yes_no_button',
            'option_category' => 'basic_option',
            'default_on_front'=> 'off',
            'options' => [
                'off' => esc_html__( 'No', DMPRO_TEXTDOMAIN ),
                'on'  => esc_html__( 'Yes', DMPRO_TEXTDOMAIN ),
            ],
            'toggle_slug' => 'main_content',
            'depends_show_if' => 'default',
            'affects' => array(
                'carousel_icon_align',
                'carousel_icon',
                'use_icon_font_size',
                'use_icon_circle',
                'icon_color',
                'img_src'
            ),
        ];

        $module_fields["carousel_icon"] = [
            'label' => esc_html__( 'Icon', DMPRO_TEXTDOMAIN ),
            'type' => 'select_icon',
            'toggle_slug' => 'main_content',
            'class' => array( 'et-pb-font-icon' ),
            'default' => '1',
            'depends_show_if' => 'on',
            'hover' => 'tabs'
        ];

        $module_fields["carousel_icon_align"] = [
            'label' => esc_html__('Carousel Icon Alignment', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'default' => 'center',
            'options' => [
                'left' => esc_html__('Left', DMPRO_TEXTDOMAIN),
                'center' => esc_html__('Center', DMPRO_TEXTDOMAIN),
                'right' => esc_html__('Right', DMPRO_TEXTDOMAIN),
            ],
            'tab_slug' => 'advanced',
            'toggle_slug' => 'icon_settings',
        ];

        $module_fields["icon_color"] = [
            'label' => esc_html__( 'Icon Color', DMPRO_TEXTDOMAIN ),
            'type' => 'color-alpha',
            'depends_show_if' => 'on',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'icon_settings',
            'hover' => 'tabs'
        ];

        $module_fields["use_icon_circle"] = [
            'label' => esc_html__( 'Show as Circle Icon', DMPRO_TEXTDOMAIN ),
            'type' => 'yes_no_button',
            'options' => array(
                'off' => esc_html__( 'No', DMPRO_TEXTDOMAIN ),
                'on'  => esc_html__( 'Yes', DMPRO_TEXTDOMAIN ),
            ),
            'affects' => [
                'use_icon_circle_border',
                'icon_circle_color',
            ],
            'tab_slug'         => 'advanced',
            'toggle_slug'      => 'icon_settings',
            'depends_show_if'  => 'on',
            'default_on_front'=> 'off',
        ];

        $module_fields["icon_circle_color"] = [
            'label'           => esc_html__( 'Circle Color', DMPRO_TEXTDOMAIN ),
            'type'            => 'color-alpha',
            'depends_show_if' => 'on',
            'tab_slug'        => 'advanced',
            'toggle_slug'     => 'icon_settings',
            'hover'           => 'tabs'
        ];

        $module_fields["use_icon_circle_border"] = [
            'label'           => esc_html__( 'Show Circle Border', DMPRO_TEXTDOMAIN ),
            'type'            => 'yes_no_button',
            'options'         => [
                'off' => esc_html__( 'No', DMPRO_TEXTDOMAIN ),
                'on'  => esc_html__( 'Yes', DMPRO_TEXTDOMAIN ),
            ],
            'affects'           => array(
                'icon_circle_border_color',
            ),
            'depends_show_if'   => 'on',
            'tab_slug'          => 'advanced',
            'toggle_slug'       => 'icon_settings',
            'default_on_front'  => 'off',
        ];

        $module_fields["icon_circle_border_color"] = [
            'label'           => esc_html__( 'Circle Border Color', DMPRO_TEXTDOMAIN ),
            'type'            => 'color-alpha',
            'depends_show_if' => 'on',
            'tab_slug'        => 'advanced',
            'toggle_slug'     => 'icon_settings',
            'hover'           => 'tabs',
        ];

        $module_fields["use_icon_font_size"] = [
            'label'           => esc_html__( 'Use Icon Font Size', 'et_builder' ),
            'type'            => 'yes_no_button',
            'options'         => array(
                'off' => esc_html__( 'No', DMPRO_TEXTDOMAIN ),
                'on'  => esc_html__( 'Yes', DMPRO_TEXTDOMAIN ),
            ),
            'affects'     => array(
                'icon_font_size',
            ),
            'depends_show_if'  => 'on',
            'tab_slug'         => 'advanced',
            'toggle_slug'     => 'icon_settings',
            'default_on_front' => 'off',
        ];

        $module_fields["icon_font_size"] = [
            'label'           => esc_html__( 'Icon Font Size', 'et_builder' ),
            'type'            => 'range',
            'option_category' => 'font_option',
            'default'         => '96px',
            'default_unit'    => 'px',
            'default_on_front'=> '',
            'allowed_units'   => array( '%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
            'range_settings' => array(
                'min'  => '1',
                'max'  => '120',
                'step' => '1',
            ),
            'hover'           => 'tabs',
            'tab_slug'        => 'advanced',
            'toggle_slug'     => 'icon_settings',
            'depends_show_if' => 'on',
        ];

        $module_fields['img_src'] = [
            'type'               => 'upload',
            'hide_metadata'      => true,
            'upload_button_text' => esc_attr__('Upload an image', DMPRO_TEXTDOMAIN),
            'choose_text'        => esc_attr__('Choose an Image', DMPRO_TEXTDOMAIN),
            'update_text'        => esc_attr__('Set As Image', DMPRO_TEXTDOMAIN),
            'description'        => esc_html__('Upload an image to display in the module.', DMPRO_TEXTDOMAIN),
            'depends_show_if'    => 'off',
            'toggle_slug'        => 'main_content',
        ];

        $module_fields["img_alt"] = [
            'label'       => esc_html__( 'Image Alt Text', DMPRO_TEXTDOMAIN ),
            'type'        => 'text',
            'description' => esc_html__( 'Define the HTML ALT text for your image here.', DMPRO_TEXTDOMAIN),
            'show_if'     => [
                'use_icon' => 'off',
                'type' => 'default'
            ],
            'toggle_slug' => 'main_content',
        ];

        $module_fields["text_title"] = [
            'label'           => esc_html__('Title', DMPRO_TEXTDOMAIN),
            'type'            => 'text',
            'depends_show_if' => 'default',
            'toggle_slug'     => 'main_content'
        ];
        
        $module_fields["desc_text"] = [
            'label'           => esc_html__('Description', DMPRO_TEXTDOMAIN),
            'type'            => 'tiny_mce',
            'option_category' => 'basic_option',
            'depends_show_if' => 'on',
            'dynamic_content' => 'text',
            'mobile_options'  => true,
            'depends_show_if' => 'default',
            'toggle_slug'     => 'main_content'
        ];
        
        $module_fields["show_button"] = [
            'default' => 'off',
            'label' => esc_html__('Show Button', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category'  => 'configuration',
            'options' => [
                'on' => esc_html__('Yes', DMPRO_TEXTDOMAIN),
                'off' => esc_html__('No', DMPRO_TEXTDOMAIN),
            ],
            'depends_show_if' => 'default',
            'toggle_slug' => 'main_content'
        ];

        $module_fields["carousel_button_text"] = [
            'label' => esc_html__('Button Text', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'toggle_slug' => 'main_content',
            'default' => esc_html__('Click Here', DMPRO_TEXTDOMAIN),
            'show_if' => [
               'show_button' => 'on',
               'type'   => 'default'
            ]
        ];

        $module_fields["button_link"] = [
            'label' => esc_html__('Button Link', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'toggle_slug' => 'main_content',
            'show_if' => [
               'show_button' => 'on',
               'type'   => 'default'
            ]
        ];

        $module_fields["button_link_target"] = [
            'label' => esc_html__('Button Link Target', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'default' => 'same_window',
            'options' => array(
              'off' => esc_html__('Same Window', DMPRO_TEXTDOMAIN),
              'on' => esc_html__('New Window', DMPRO_TEXTDOMAIN),
            ),
            'show_if' => [
               'show_button' => 'on',
               'type'   => 'default'
            ],
            'toggle_slug' => 'main_content'
        ];

        $module_fields['img_width'] = [
            'label' => esc_html__('Image Width', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'default' => '100',
            'default_unit' => '%',
            'default_on_front'=> '',
            'allowed_units'   => array( '%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
            'range_settings' => [
                'min'  => '1',
                'max'  => '100',
                'step' => '1'
            ],
            'mobile_options' => true,
            'responsive' => true,
            'validate_unit' => true,
            'tab_slug' => 'advanced',
            'toggle_slug' => 'img_settings'
        ];

       $module_fields["__divilibrary"] = [
            'type'  => 'computed',
            'computed_callback' => ['DMPRO_Carousel_Child', 'get_divi_library'],
            'computed_depends_on' => [
                'divi_library_id'
            ]
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
              'main' => "%%order_class%% .dmpro-carousel-item-title",
            ],
            'font_size' => [
                'default' => '18px',
            ],
            'line_height' => [
                'range_settings' => [
                      'default' => '1em',
                      'min'  => '1',
                      'max'  => '3',
                      'step' => '.1',
                 ],
            ],
            'header_level' => [
                'default' => 'h2',
            ],
            'important' => 'all',
            'hide_text_align' => true,
            'toggle_slug' => 'carousel_text',
            'sub_toggle'  => 'title'
        ];

        $advanced_fields["fonts"]["desc"] = [
            'label'    => esc_html__('Description', DMPRO_TEXTDOMAIN),
            'css'      => [
              'main' => "%%order_class%% .dmpro-carousel-item-desc, %%order_class%% .dmpro-carousel-item-desc p",
              'color'        => "%%order_class%% .dmpro-carousel-item-desc, %%order_class%% .dmpro-carousel-item-desc *",
              'line_height'  => "%%order_class%% .dmpro-carousel-item-desc p",
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

        $advanced_fields['button']["carousel_button"] = [
            'label'    => esc_html__('Button', DMPRO_TEXTDOMAIN),
            'css' => [
                'main' => "%%order_class%% .dmpro-carousel-button",
                'alignment' => "%%order_class%% .dmpro-carousel-button-wrapper",
            ],
            'use_alignment' => false,
            'box_shadow'  => [
              'css' => [
                'main' => "%%order_class%% .dmpro-carousel-button",
                'important' => true,
              ],
            ],
            'margin_padding' => [
              'css' => [
                'main' => "%%order_class%% .dmpro-carousel-button",
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

        $advanced_fields["borders"]["img"] = [
            'css' => [
              'main' => [
                    'border_radii' => "%%order_class%% .dmpro-carousel-image img",
                    'border_styles' => "%%order_class%% .dmpro-carousel-image img",
                ],
            ],
            'toggle_slug' => 'img_settings',
        ];

        $advanced_fields["box_shadow"]["default"] = [
            'css' => [
              'main' => "%%order_class%%",
            ]
        ];

        $advanced_fields["box_shadow"]["img"] = [
            'css' => [
              'main' => "%%order_class%% .dmpro-carousel-image img",
            ],
            'toggle_slug' => 'img_settings',
        ];

        return $advanced_fields;
    }

    public function render($attrs, $content, $render_slug) {
        wp_enqueue_style("dmpro-".$this->slug, $this->module_url . 'style.css', [], DMPRO_VERSION, 'all');
        $img_src = $this->props['img_src'];
        $img_alt = $this->props['img_alt'];
        $carousel_icon = $this->props['carousel_icon'];
        $use_icon = $this->props['use_icon'];
        $carousel_icon_align = $this->props['carousel_icon_align'];
        $use_icon_circle = $this->props['use_icon_circle'];
        $use_icon_circle_border = $this->props['use_icon_circle_border'];
        $use_icon_font_size  = $this->props['use_icon_font_size'];
        $icon_font_size = $this->props['icon_font_size'];
        $icon_font_size_hover = $this->get_hover_value( 'icon_font_size' );
        $icon_color = $this->props['icon_color'];
        $icon_circle_color = $this->props['icon_circle_color'];
        $icon_circle_border_color = $this->props['icon_circle_border_color'];
        $title_text = $this->props['text_title'];
        $desc_text = $this->props['desc_text'];
        $show_button = $this->props['show_button'];

        $carousel_button_text = $this->props['carousel_button_text'];
        $button_link = $this->props['button_link'];
        $button_rel = $this->props['carousel_button_rel'];
        $button_icon = $this->props['carousel_button_icon'];
        $button_custom = $this->props['custom_carousel_button'];
        $button_link_target = $this->props['button_link_target'];

        $image_class = "%%order_class%% .dmpro-carousel-image";
        $img_width = $this->props['img_width'];
        $img_width_tablet = ($this->props['img_width_tablet']) ? $this->props['img_width_tablet'] : $img_width;
        $img_width_phone = ($this->props['img_width_phone']) ? $this->props['img_width_phone'] : $img_width_tablet;
        $img_width_last_edited  = $this->props['img_width_last_edited'];
        $img_width_responsive_status = et_pb_get_responsive_status($img_width_last_edited);
        
        if('' !== $img_width) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => $image_class,
                'declaration' => sprintf( 'max-width: %1$s !important;', $img_width),
            ));
        }

        if('' !== $img_width_tablet && $img_width_responsive_status) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => $image_class,
                'declaration' => sprintf( 'max-width: %1$s !important;', $img_width_tablet),
                'media_query' => ET_Builder_Element::get_media_query('max_width_980')
            ));
        }

        if('' !== $img_width_phone && $img_width_responsive_status) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => $image_class,
                'declaration' => sprintf( 'max-width: %1$s !important;', $img_width_phone),
                'media_query' => ET_Builder_Element::get_media_query('max_width_767')
            ));
        }

        $button_render = '';

        if ('on' === $show_button) {

            $button_render = $this->render_button([
                'button_classname' => ["dmpro-carousel-button"],
                'button_rel' => $button_rel,
                'button_text' => $carousel_button_text,
                'button_url' => $button_link,
                'custom_icon' => $button_icon,
                'has_wrapper' => false,
                'url_new_window' => $button_link_target,
                'button_custom' => $button_custom,
            ]);
        }

        $carousel_icon_style_hover = '';
        if ( 'off' === $use_icon ) {

            $image_render = sprintf(
                '<span class="dmpro-carousel-image">
                    <img src="%1$s" alt="%2$s"/>
                </span>', 
                esc_attr($img_src),
                esc_attr($img_alt)
            );

        } else {
            $carousel_icon_style = sprintf( 'color: %1$s;', esc_attr($icon_color ) );
            
            if( et_builder_is_hover_enabled( 'icon_color', $this->props ) ) {
                $carousel_icon_style_hover = sprintf( 'color: %1$s;', esc_attr( $icon_color_hover ) );
            }
            if('on' === $use_icon_circle) {
                $carousel_icon_style .= sprintf( ' background-color: %1$s;', esc_attr( $icon_circle_color ) );
                if ( et_builder_is_hover_enabled( 'icon_circle_color', $this->props ) ) {
                    $carousel_icon_style_hover .= sprintf( ' background-color: %1$s;', esc_attr( $icon_circle_color_hover ) );
                }

                if ( 'on' === $use_icon_circle_border ) {
                    $carousel_icon_style .= sprintf( ' border-color: %1$s;', esc_attr( $icon_circle_border_color ) );
                    if ( et_builder_is_hover_enabled( 'icon_circle_border_color', $this->props ) ) {
                        $carousel_icon_style_hover .= sprintf( ' border-color: %1$s;', esc_attr( $icon_circle_border_color_hover ) );
                    }
                }
            }

            $carousel_icon_classes[] = 'et-pb-icon dmpro-carousel-icon';

            if ( 'on' === $use_icon_circle ) {
                $carousel_icon_classes[] = 'dmpro-carousel-icon-circle';
            }

            if ( 'on' === $use_icon_circle && 'on' === $use_icon_circle_border ) {
                $carousel_icon_classes[] = 'dmpro-carousel-icon-circle-border';
            }
            
            $this->remove_classname( 'et_pb_module' );

            $image_render = sprintf(
                '<span class="%2$s">
                %1$s
                </span>', 
                esc_attr(et_pb_process_font_icon($carousel_icon)), 
                esc_attr(implode(' ', $carousel_icon_classes))
            );

            ET_Builder_Element::set_style($render_slug, array(
                'selector'    => "%%order_class%% .dmpro-carousel-icon",
                'declaration' => $carousel_icon_style,
            ) );

            ET_Builder_Element::set_style( $render_slug, array(
                'selector'    => "%%order_class%% .dmpro-image-wrap",
                'declaration' => sprintf('text-align: %1$s!important;', $carousel_icon_align),
            ) );

            if ('' !== $carousel_icon_style_hover) {
                ET_Builder_Element::set_style( $render_slug, array(
                    'selector'    => "%%order_class%% .dmpro_carousel_child:hover .dmpro-carousel-icon",
                    'declaration' => $carousel_icon_style_hover,
                ) );
            }

            if ('off' !== $use_icon_font_size) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => "%%order_class%% .dmpro-carousel-icon",
                    'declaration' => sprintf(
                        'font-size: %1$s;',
                        esc_html( $icon_font_size )
                    ),
                ) );

                if ( et_builder_is_hover_enabled('icon_font_size', $this->props ) ) {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => "%%order_class%% .dmpro_carousel_child:hover .dmpro-carousel-icon",
                        'declaration' => sprintf(
                            'font-size: %1$s;',
                            esc_html( $icon_font_size_hover )
                        ),
                    ) );
                }
            }
        }

        $carousel_button_text_size = $this->props['carousel_button_text_size'];
        if(empty($carousel_button_text_size)) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector' => '%%order_class%% .dmpro-carousel-button',
                'declaration' => 'font-size: 20px !important;'
            ));
        }


        $title_level = $this->props['title_level'] ? $this->props['title_level'] : 'h2';
        $image_render = $image_render ? sprintf( '<div class="dmpro-image-wrap">%1$s</div>', $image_render ) : '';
        $title_text = !empty($title_text) ? sprintf('<%2$s class="dmpro-carousel-item-title">%1$s</%2$s>', $title_text, esc_attr( $title_level)) : '';

        $desc_text = !empty($desc_text) ? sprintf(
            '<div class="dmpro-carousel-item-desc">%1$s</div>',
            preg_replace('/^<\/p>(.*)<p>/s', '$1',$desc_text)
            ) : '';

        $default_output = sprintf('
            <div class="dmpro-carousel-child-wrapper">
                %1$s
                <div class="dmpro-carousel-item-content">
                    %2$s
                    %3$s
                    <div class="dmpro-carousel-button-wrapper">
                        %4$s
                    </div>
                </div>
            </div>',
            $image_render,
            $title_text,
            $desc_text,
            $button_render
        );

        $libraryId = $this->props['divi_library_id'];
        $shortcode = do_shortcode('[et_pb_section global_module="' . $libraryId . '"][/et_pb_section]');

        $divi_library_output = sprintf('
            <div class="%2$s">
                %1$s
            </div>
            ',
            $shortcode,
            'dmpro-carousel-child-wrapper'
        );

        return ($this->props['type'] == 'divi_library') ? $divi_library_output : $default_output;
    }
    public static function get_divi_library($args = array()) {
        $libraryId = isset($args['divi_library_id']) ? $args['divi_library_id'] : '';
        $divi_library_shortcode = do_shortcode('[et_pb_section global_module="' . $libraryId . '"][/et_pb_section]');
        $divi_library_shortcode .= '<style type="text/css">' . ET_Builder_Element::get_style() . '</style>';
        ET_Builder_Element::clean_internal_modules_styles( false );

        return $divi_library_shortcode;
    }
}
new DMPRO_Carousel_Child;