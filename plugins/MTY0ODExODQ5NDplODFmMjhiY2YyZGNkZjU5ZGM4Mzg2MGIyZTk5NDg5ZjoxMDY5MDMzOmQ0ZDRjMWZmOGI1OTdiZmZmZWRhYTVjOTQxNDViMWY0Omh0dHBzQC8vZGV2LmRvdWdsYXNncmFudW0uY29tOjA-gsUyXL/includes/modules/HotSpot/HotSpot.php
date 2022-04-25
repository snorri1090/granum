<?php

class DMPRO_HotSpot extends ET_Builder_Module {

   protected $module_credits = array(
		'module_uri' => DMPRO_MODULE . 'image-hotspot',
		'author' => DMPRO_AUTHOR,
		'author_uri' => DMPRO_WEB,
	);

	public function init() {
	    $this->slug = 'dmpro_image_hotspot';
	    $this->icon_path = plugin_dir_path(__FILE__) . "Hotspot.svg";
        $this->vb_support = 'on';
		$this->name = esc_html__(DMPRO_PREFIX . 'Image Hotspot', 'dmpro-divi-modules-pro');
		$this->child_slug = 'dmpro_image_hotspot_child';
		$this->main_css_element = '%%order_class%%.dmpro_image_hotspot';
		$this->settings_modal_toggles = [
			'general' => [
				'toggles' => [
					'image' => esc_html__('Image', 'dmpro-divi-modules-pro'),
				],
			],
			'advanced' => [
				'toggles' => [],
			],
		];
		
	}

	public function get_fields() 
	{
	    $module_fields = [];

		$module_fields['img_src'] = [
            'type'               => 'upload',
            'option_category'    => 'basic_option',
			'hide_metadata'      => true,
			'upload_button_text' => esc_attr__('Upload an image', 'dmpro-divi-modules-pro'),
            'choose_text' => esc_attr__('Choose an Image', 'dmpro-divi-modules-pro'),
            'update_text' => esc_attr__('Set As Image', 'dmpro-divi-modules-pro'),
            'description' => esc_html__('Upload an image to display in the module.', 'dmpro-divi-modules-pro'),
            'dynamic_content'    => 'image',
            'toggle_slug'        => 'image'
        ];

        $module_fields["img_alt"] = [
			'label'       => esc_html__( 'Image Alt Text', 'dmpro-divi-modules-pro' ),
			'type'        => 'text',
			'description' => esc_html__( 'Define the HTML ALT text for your image here.', 'dmpro-divi-modules-pro'),
			'toggle_slug' => 'image'
        ];

		return $module_fields;
	}

	public function get_advanced_fields_config() 
	{

		$advanced_fields = [];

		$advanced_fields['fonts'] = false;
		$advanced_fields['text'] = false;
		$advanced_fields['text_shadow'] = false;
        $advanced_fields['link_options'] = false;

		$advanced_fields['margin_padding'] = [
		  'css' => [
			'margin' => '%%order_class%%',
			'padding' => '%%order_class%%',
			'important' => 'all',
		  ],
		];
		
		return $advanced_fields;
	}

	public function get_custom_css_fields_config() {

        $custom_css_fields = [];

        $custom_css_fields['hotspot_img'] = [
            'label'    => esc_html__('Hotspot Image', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-hotspot-image',
        ];

        $custom_css_fields['hotspot_icon'] = [
            'label'    => esc_html__('Hotspot Icon', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-hotspot-icon',
        ];

        $custom_css_fields['tooltip_img'] = [
            'label'    => esc_html__('Tooltip Image', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-tooltip-image',
        ];

        $custom_css_fields['tooltip_icon'] = [
            'label'    => esc_html__('Tooltip Icon', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-tooltip-icon',
        ];
        
        $custom_css_fields['title'] = [
            'label'    => esc_html__('Tooltip Title', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-tooltip-title',
        ];

        $custom_css_fields['description'] = [
            'label'    => esc_html__('Tooltip Desc', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-tooltip-desc',
        ];

        $custom_css_fields['button'] = [
            'label'    => esc_html__('Tooltip Button', 'dmpro-divi-modules-pro'),
            'selector' => '%%order_class%% .dmpro-tooltip-button',
        ];

        return $custom_css_fields;
    }
    public function render($attrs, $content, $render_slug) {
        wp_enqueue_style("dmpro".$this->slug, plugin_dir_url(__FILE__) . 'style.css', [], "1.0.0", 'all');
        if(!isset($this->props['img_src']) || '' === $this->props['img_src']){
            return '';
        }

		$output = sprintf('
			<div class="dmpro-image-hotspot">
				<img src="%2$s" class="dmpro-hotspot-bg-image-main" alt="%3$s">
				%1$s
			</div>',
			$this->content,
			esc_attr($this->props['img_src']),
			esc_attr($this->props['img_alt'])
		);

		return $output;
	}
}

new DMPRO_HotSpot;
