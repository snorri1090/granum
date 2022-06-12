<?php

class DMPRO_HotSpot extends ET_Builder_Module {
	
	public $module_url = DMPRO_MODULES_URL . 'HotSpot' . '/';

   protected $module_credits = array(
		'module_uri' => DMPRO_MODULE . 'image-hotspot',
		'author' => DMPRO_AUTHOR,
		'author_uri' => DMPRO_WEB,
	);

	public function init() {
	    $this->slug = 'dmpro_image_hotspot';
	    $this->icon_path = plugin_dir_path( __FILE__ ) . "Hotspot.svg";
        $this->vb_support = 'on';
		$this->name = esc_html__(DMPRO_PREFIX . 'Image Hotspot', DMPRO_TEXTDOMAIN);
		$this->child_slug = 'dmpro_image_hotspot_child';
		$this->main_css_element = '%%order_class%%.dmpro_image_hotspot';
		$this->settings_modal_toggles = [
			'general' => [
				'toggles' => [
					'image' => esc_html__('Image', DMPRO_TEXTDOMAIN),
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
			'upload_button_text' => esc_attr__('Upload an image', DMPRO_TEXTDOMAIN),
            'choose_text' => esc_attr__('Choose an Image', DMPRO_TEXTDOMAIN),
            'update_text' => esc_attr__('Set As Image', DMPRO_TEXTDOMAIN),
            'description' => esc_html__('Upload an image to display in the module.', DMPRO_TEXTDOMAIN),
            'dynamic_content'    => 'image',
            'toggle_slug'        => 'image'
        ];

        $module_fields["img_alt"] = [
			'label'       => esc_html__( 'Image Alt Text', DMPRO_TEXTDOMAIN ),
			'type'        => 'text',
			'description' => esc_html__( 'Define the HTML ALT text for your image here.', DMPRO_TEXTDOMAIN),
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
            'label'    => esc_html__('Hotspot Image', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-hotspot-image',
        ];

        $custom_css_fields['hotspot_icon'] = [
            'label'    => esc_html__('Hotspot Icon', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-hotspot-icon',
        ];

        $custom_css_fields['tooltip_img'] = [
            'label'    => esc_html__('Tooltip Image', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-tooltip-image',
        ];

        $custom_css_fields['tooltip_icon'] = [
            'label'    => esc_html__('Tooltip Icon', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-tooltip-icon',
        ];
        
        $custom_css_fields['title'] = [
            'label'    => esc_html__('Tooltip Title', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-tooltip-title',
        ];

        $custom_css_fields['description'] = [
            'label'    => esc_html__('Tooltip Desc', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-tooltip-desc',
        ];

        $custom_css_fields['button'] = [
            'label'    => esc_html__('Tooltip Button', DMPRO_TEXTDOMAIN),
            'selector' => '%%order_class%% .dmpro-tooltip-button',
        ];

        return $custom_css_fields;
    }
    public function render($attrs, $content, $render_slug) {
        wp_enqueue_style("dmpro".$this->slug, $this->module_url . 'style.css', [], "1.0.0", 'all');
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
