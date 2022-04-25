<?php
class DMPRO_PopUP extends ET_Builder_Module {
	protected $module_credits = array(
		'module_uri' => DMPRO_WEB . 'popups',
		'author' => DMPRO_AUTHOR,
		'author_uri' => DMPRO_WEB,
	);

	public function init() {
		$this->name = esc_html__( DMPRO_PREFIX . 'Popup', 'dmpro-divi-modules-pro' );
		$this->icon_path = plugin_dir_path(__FILE__) . 'popup.svg';
		$this->slug = 'dmpro_popup';
		$this->vb_support = 'on';
		$this->main_css_element = '%%order_class%%';
		$this->settings_modal_toggles = [
				'general'  => [
					'toggles' => [
					'main_content' => esc_html__( 'Popup Settings', 'dmpro-divi-modules-pro' ),
					'popup_content' => [
						'sub_toggles' => [
							'popup_header' => [
								'name' => 'Header',
							],
							'popup_body' => [
								'name' => 'Body',
							],
							'popup_footer' => [
								'name' => 'Footer',
							],
						],
						'tabbed_subtoggles' => true,
						'title' => esc_html__('Popup Content', 'dmpro-divi-modules-pro'),
						'priority' => 1,
					],
					'background'   => esc_html__( 'Background', 'dmpro-divi-modules-pro' ),
				],
			],
			'advanced' => [
				'toggles' => [
					'text'               => esc_html__( 'Click Trigger Alignment', 'dmpro-divi-modules-pro' ),
					'trigger_button'     => esc_html__( 'Button Click Trigger', 'dmpro-divi-modules-pro' ),
					'trigger_text'       => esc_html__( 'Text Click Trigger', 'dmpro-divi-modules-pro' ),
					'trigger_icon'       => esc_html__( 'Icon Click Trigger', 'dmpro-divi-modules-pro' ),
					'trigger_image'      => esc_html__( 'Image Click Trigger', 'dmpro-divi-modules-pro' ),
					'popup_text' => [
						'sub_toggles' => [
							'popup_title_text' => [
								'name' => 'Header',
							],
							'popup_body_text' => [
								'name' => 'Body',
							],
						],
						'tabbed_subtoggles' => true,
						'title' => esc_html__('Popup Text', 'dmpro-divi-modules-pro'),
						'priority' => 3,
					],
					'popup_close_icon'   => esc_html__( 'Popup Close Icon', 'dmpro-divi-modules-pro' ),
					'popup_close_button' => esc_html__( 'Footer Close Button', 'dmpro-divi-modules-pro' ),
					'box_shadow'         => esc_html__( 'Popup Box Shadows', 'dmpro-divi-modules-pro' ),
					'border'             => esc_html__( 'Popup Borders', 'dmpro-divi-modules-pro' ),
					'popup_sizing'       => esc_html__( 'Popup Size & Position', 'dmpro-divi-modules-pro' ),
				],
			],
		];
	}
	public function get_fields() {
		$args     = array(
			'post_type'      => 'et_pb_layout',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'meta_query'     => array(
				array(
					'key'     => '_et_pb_predefined_layout',
					'value'   => 'on',
					'compare' => 'NOT EXISTS',
				),
			),
		);
		$list_layout    = array();
		$list_layout[0] = esc_html__( 'Select', 'dmpro-divi-modules-pro' );
		$results = new WP_Query( $args );
		if ( $results->have_posts() ) {
			while ( $results->have_posts() ) {
				$results->the_post();
				$list_layout[ intval( get_the_ID() ) ] = ucwords( esc_html( get_the_title() ) );
			}
			wp_reset_postdata();
		}
		$module_fields = [];
		$module_fields['popup_id_notice'] = [
				'label'           => '',
				'type'            => 'warning',
				'option_category' => 'configuration',
				'value'           => true,
				'display_if'      => true,
				'message'         => esc_html__( 'Please give the popup a unique name below (Example: popup-1).', 'dmpro-divi-modules-pro' ),
				'show_if'     	  => array(
					'popup_id' => array( '' ),
				),
				'tab_slug'         => 'general',
				'toggle_slug'      => 'main_content',
			];
			$module_fields['popup_close_icon_notice'] = [
				'label'           => '',
				'type'            => 'warning',
				'option_category' => 'configuration',
				'value'           => true,
				'display_if'      => true,
				'message'         => esc_html__( 'Popup close icon disabled. Please enable it to use its setting here.', 'dmpro-divi-modules-pro' ),
				'show_if'     	  => array(
					'show_close_icon' => 'off',
				),
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'popup_close_icon',
			];
			$module_fields['popup_button_trigger_notice'] = [
				'label'           => '',
				'type'            => 'warning',
				'option_category' => 'configuration',
				'value'           => true,
				'display_if'      => true,
				'message'         => esc_html__( 'You do not have a Button Click Trigger Selected (under Popup Settings), so these settings here will have no effect.', 'dmpro-divi-modules-pro' ),
				'show_if_not'     	  => array(
					'trigger_element_type' => 'button',
				),
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'trigger_button',
			];
			$module_fields['popup_text_trigger_notice'] = [
				'label'           => '',
				'type'            => 'warning',
				'option_category' => 'configuration',
				'value'           => true,
				'display_if'      => true,
				'message'         => esc_html__( 'You do not have a Text Click Trigger Selected (under Popup Settings), so these settings here will have no effect.', 'dmpro-divi-modules-pro' ),
				'show_if_not'     	  => array(
					'trigger_element_type' => 'text',
				),
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'trigger_text',
			];
			$module_fields['popup_footer_button_notice'] = [
				'label'           => '',
				'type'            => 'warning',
				'option_category' => 'configuration',
				'value'           => true,
				'display_if'      => true,
				'message'         => esc_html__( 'You do not have the footer button enabled (Under Popup Content), so these settings here will have no effect.', 'dmpro-divi-modules-pro' ),
				'show_if_not'          => array(
					'show_footer' => 'on',
				),
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'popup_close_button',
			];
			$module_fields['popup_id'] = [
					'label'            => esc_html__( 'Unique Popup Name', 'dmpro-divi-modules-pro' ),
					'type'             => 'text',
					'option_category'  => 'basic_option',
					'default' 		   => '',
					'default_on_front' => '',
					'tab_slug'         => 'general',
					'toggle_slug'      => 'main_content',
					'description'      => esc_html__( 'Enter a unique popup name. This is needed for the popup to function correctly.', 'dmpro-divi-modules-pro' ),
			];
			$module_fields['trigger_type'] = [
					'label'            => esc_html__( 'Popup Trigger Type', 'dmpro-divi-modules-pro' ),
					'type'             => 'select',
					'option_category'  => 'configuration',
					'options'          => array(
						'element'      => esc_html__( 'Click Trigger', 'dmpro-divi-modules-pro' ),
						'on_page_load' => esc_html__( 'Timed Delay Trigger', 'dmpro-divi-modules-pro' ),
						'exit_intent'  => esc_html__( 'Exit Intent Trigger', 'dmpro-divi-modules-pro' ),
					),
					'default'          => 'element',
					'default_on_front' => 'element',
					'tab_slug'         => 'general',
					'toggle_slug'      => 'main_content',
					'description'      => esc_html__( 'Select how you want your popup to be triggered.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['trigger_delay'] = [
					'label'            => esc_html__( 'Timed Delay', 'dmpro-divi-modules-pro' ),
					'type'             => 'range',
					'option_category'  => 'layout',
					'range_settings'   => array(
						'min'  => '100',
						'max'  => '15000',
						'step' => '100',
					),
					'validate_unit'    => true,
					'fixed_unit'       => 'ms',
					'fixed_range'      => true,
					'default'          => '3000ms',
					'default_on_front' => '3000ms',
					'show_if'          => array(
						'trigger_type' => 'on_page_load',
					),
					'tab_slug'         => 'general',
					'toggle_slug'      => 'main_content',
					'description'      => esc_html__( 'Set how long of a delay after the page loads until the popup triggers.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['re_rendering'] = [
					'label'            => esc_html__( 'Continuously Load Popup on Page Reload?', 'dmpro-divi-modules-pro' ),
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'off' => esc_html__( 'No', 'dmpro-divi-modules-pro' ),
						'on'  => esc_html__( 'Yes', 'dmpro-divi-modules-pro' ),
					),
					'default'          => 'on',
					'default_on_front' => 'on',
					'show_if'          => array(
						'trigger_type' => 'on_page_load',
					),
					'tab_slug'         => 'general',
					'toggle_slug'      => 'main_content',
					'description'      => esc_html__( 'Turn this option off to load the popup only once.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['trigger_element_type'] = [
					'label'            => esc_html__( 'Click Trigger Element', 'dmpro-divi-modules-pro' ),
					'type'             => 'select',
					'option_category'  => 'configuration',
					'options'          => array(
						'button'     	=> esc_html__( 'Button', 'dmpro-divi-modules-pro' ),
						'image'      	=> esc_html__( 'Image', 'dmpro-divi-modules-pro' ),
						'icon'       	=> esc_html__( 'Icon', 'dmpro-divi-modules-pro' ),
						'text'       	=> esc_html__( 'Text', 'dmpro-divi-modules-pro' ),
						'element_id' 	=> esc_html__( 'CSS ID (of another element on the page)', 'dmpro-divi-modules-pro' ),
						'element_class' => esc_html__( 'CSS Class (of another element on the page)', 'dmpro-divi-modules-pro' ),
					),
					'default'          => 'button',
					'default_on_front' => 'button',
					'show_if'          => array(
						'trigger_type' => 'element',
					),
					'tab_slug'         => 'general',
					'toggle_slug'      => 'main_content',
					'description'      => esc_html__( 'Select what type of element you would like to use to trigger the popup when clicked.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['trigger_element_id'] = [
					'label'           => esc_html__( 'Element CSS ID', 'dmpro-divi-modules-pro' ),
					'type'            => 'text',
					'option_category' => 'basic_option',
					'show_if'         => array(
						'trigger_type'         => 'element',
						'trigger_element_type' => 'element_id',
					),
					'tab_slug'        => 'general',
					'toggle_slug'     => 'main_content',
					'description'     => esc_html__( 'Enter the CSS ID (without #) of another element on the page that you want to trigger this popup when clicked.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['trigger_element_class'] = [
					'label'           => esc_html__( 'Element CSS Class', 'dmpro-divi-modules-pro' ),
					'type'            => 'text',
					'option_category' => 'basic_option',
					'show_if'         => array(
						'trigger_type'         => 'element',
						'trigger_element_type' => 'element_class',
					),
					'tab_slug'        => 'general',
					'toggle_slug'     => 'main_content',
					'description'     => esc_html__( 'Enter the CSS Class (without . ) of another element on the page that you want to trigger this popup when clicked.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['trigger_button_text'] = [
					'label'            => esc_html__( 'Button Text', 'dmpro-divi-modules-pro' ),
					'type'             => 'text',
					'option_category'  => 'basic_option',
					'default'          => 'Trigger Popup',
					'default_on_front' => 'Trigger Popup',
					'show_if'          => array(
						'trigger_type'         => 'element',
						'trigger_element_type' => 'button',
					),
					'tab_slug'         => 'general',
					'toggle_slug'      => 'main_content',
					'description'        => esc_html__( 'Input the text for the button that you want to trigger the popup when clicked.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['trigger_icon'] = [
					'label'            => esc_html__( 'Icon', 'dmpro-divi-modules-pro' ),
					'type'             => 'select_icon',
					'option_category'  => 'button',
					'class'            => array( 'et-pb-font-icon' ),
					'default'          => '%%40%%',
					'default_on_front' => '%%40%%',
					'show_if'          => array(
						'trigger_type'         => 'element',
						'trigger_element_type' => 'icon',
					),
					'tab_slug'         => 'general',
					'toggle_slug'      => 'main_content',
					'description'      => esc_html__( 'Select an icon to be used for the popup click trigger.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['trigger_image'] = [
					'label'              => esc_html__( 'Image', 'dmpro-divi-modules-pro' ),
					'type'               => 'upload',
					'option_category'    => 'basic_option',
					'upload_button_text' => esc_attr__( 'Upload an image', 'dmpro-divi-modules-pro' ),
					'choose_text'        => esc_attr__( 'Choose an Image', 'dmpro-divi-modules-pro' ),
					'update_text'        => esc_attr__( 'Set As Image', 'dmpro-divi-modules-pro' ),
					'show_if'            => array(
						'trigger_type'         => 'element',
						'trigger_element_type' => 'image',
					),
					'tab_slug'           => 'general',
					'toggle_slug'        => 'main_content',
					'description'        => esc_html__( 'Add the image that you would like to trigger the popup when clicked.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['trigger_image_alt'] = [
					'label'           => esc_html__( 'Image Alternative Text', 'dmpro-divi-modules-pro' ),
					'type'            => 'text',
					'option_category' => 'basic_option',
					'show_if'         => array(
						'trigger_type'         => 'element',
						'trigger_element_type' => 'image',
					),
					'tab_slug'        => 'general',
					'toggle_slug'     => 'main_content',
					'description'     => esc_html__( 'Input the text to be used for alternative text of the popup click trigger image.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['trigger_text'] = [
					'label'            => esc_html__( 'Text', 'dmpro-divi-modules-pro' ),
					'type'             => 'text',
					'option_category'  => 'basic_option',
					'default'          => 'This text will trigger the popup',
					'default_on_front' => 'This text will trigger the popup',
					'show_if'          => array(
						'trigger_type'         => 'element',
						'trigger_element_type' => 'text',
					),
					'tab_slug'         => 'general',
					'toggle_slug'      => 'main_content',
					'description'      => esc_html__( 'Input the text that you want to trigger the popup when clicked.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['close_on_esc'] = [
					'label'            => esc_html__( 'Allow ESC Key to Close Popup?', 'dmpro-divi-modules-pro' ),
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'off' => esc_html__( 'No', 'dmpro-divi-modules-pro' ),
						'on'  => esc_html__( 'Yes', 'dmpro-divi-modules-pro' ),
					),
					'default'          => 'off',
					'default_on_front' => 'off',
					'tab_slug'         => 'general',
					'toggle_slug'      => 'main_content',
					'description'      => esc_html__( 'Enable this option to allow the ESC key to close the popup.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['show_header'] = [
					'label'            => esc_html__( 'Enable Popup Header', 'dmpro-divi-modules-pro' ),
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'off' => esc_html__( 'No', 'dmpro-divi-modules-pro' ),
						'on'  => esc_html__( 'Yes', 'dmpro-divi-modules-pro' ),
					),
					'default'          => 'on',
					'default_on_front' => 'on',
					'toggle_slug'      => 'popup_content',
					'sub_toggle' 	   => 'popup_header',
					'description'      => esc_html__( 'Enable this option to show a header in the popup.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['show_popup_title'] = [
					'label'            => esc_html__( 'Enable Popup Header Title', 'dmpro-divi-modules-pro' ),
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'off' => esc_html__( 'No', 'dmpro-divi-modules-pro' ),
						'on'  => esc_html__( 'Yes', 'dmpro-divi-modules-pro' ),
					),
					'default'          => 'on',
					'default_on_front' => 'on',
					'show_if'          => array(
						'show_header' => 'on',
					),
					'toggle_slug'      => 'popup_content',
					'sub_toggle' 	   => 'popup_header',
					'description'      => esc_html__( 'Enable this option to show the title within the header of the popup.', 'dmpro-divi-modules-pro')
				];
			$module_fields['popup_title'] = [
					'label'           => esc_html__( 'Popup Header Title', 'dmpro-divi-modules-pro' ),
					'type'            => 'text',
					'option_category' => 'basic_option',
					'show_if'         => array(
						'show_header'      => 'on',
						'show_popup_title' => 'on',
					),
					'toggle_slug'      => 'popup_content',
					'sub_toggle' 	   => 'popup_header',
					'description'     => esc_html__( 'Input the text for the title within the header of the popup.', 'dmpro-divi-modules-pro')
				];
			$module_fields['show_close_icon'] = [
					'label'            => esc_html__( 'Show Popup Close Icon', 'dmpro-divi-modules-pro' ),
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'off' => esc_html__( 'No', 'dmpro-divi-modules-pro' ),
						'on'  => esc_html__( 'Yes', 'dmpro-divi-modules-pro' ),
					),
					'default'          => 'on',
					'default_on_front' => 'on',
					'show_if'          => array(
						'show_header' => 'on',
					),
					'toggle_slug'      => 'popup_content',
					'sub_toggle' 	   => 'popup_header',
					'description'      => esc_html__( 'Enable this option to show the popup close icon.', 'dmpro-divi-modules-pro')
				];
			$module_fields['show_footer'] = [
					'label'            => esc_html__( 'Enable Popup Footer Close Button', 'dmpro-divi-modules-pro' ),
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'off' => esc_html__( 'No', 'dmpro-divi-modules-pro' ),
						'on'  => esc_html__( 'Yes', 'dmpro-divi-modules-pro' ),
					),
					'default'          => 'on',
					'default_on_front' => 'on',
					'toggle_slug'      => 'popup_content',
					'sub_toggle' 	   => 'popup_footer',
					'description'      => esc_html__( 'Enable this option to show a footer in the popup.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['close_button_text'] = [
					'label'            => esc_html__( 'Footer Close Button Text', 'dmpro-divi-modules-pro' ),
					'type'             => 'text',
					'option_category'  => 'basic_option',
					'default'          => 'Close',
					'default_on_front' => 'Close',
					'show_if'          => array(
						'show_footer' => 'on',
					),
					'toggle_slug'      => 'popup_content',
					'sub_toggle' 	   => 'popup_footer',
					'description'      => esc_html__( 'Enter the text for the footer close button.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['popup_content_type'] = [
					'label'            => esc_html__( 'Popup Content Type', 'dmpro-divi-modules-pro' ),
					'type'             => 'select',
					'option_category'  => 'configuration',
					'options'          => array(
						'text'   => esc_html__( 'Text (or Shortcode)', 'dmpro-divi-modules-pro' ),
						'image'  => esc_html__( 'Image', 'dmpro-divi-modules-pro' ),
						'video'  => esc_html__( 'Video', 'dmpro-divi-modules-pro' ),
						'layout' => esc_html__( 'Divi Library', 'dmpro-divi-modules-pro' ),
					),
					'default'          => 'text',
					'default_on_front' => 'text',
					'toggle_slug'      => 'popup_content',
					'sub_toggle' 	   => 'popup_body',
					'description'      => esc_html__( 'Select what type of content you want to display inside of the popup body.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['content'] = [
					'label'           => esc_html__( 'Enter Text (or Shortcode)', 'dmpro-divi-modules-pro' ),
					'type'            => 'tiny_mce',
					'option_category' => 'basic_option',
					'show_if'         => array(
						'popup_content_type' => 'text',
					),
					'toggle_slug'      => 'popup_content',
					'sub_toggle' 	   => 'popup_body',
					'description'     => esc_html__( 'Enter the text that you want displayed in the body of the popup. You can also paste a shortcode in this area.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['popup_content_image'] = [
					'label'              => esc_html__( 'Image', 'dmpro-divi-modules-pro' ),
					'type'               => 'upload',
					'option_category'    => 'basic_option',
					'upload_button_text' => esc_attr__( 'Upload an image', 'dmpro-divi-modules-pro' ),
					'choose_text'        => esc_attr__( 'Choose an Image', 'dmpro-divi-modules-pro' ),
					'update_text'        => esc_attr__( 'Set As Image', 'dmpro-divi-modules-pro' ),
					'show_if'            => array(
						'popup_content_type' => 'image',
					),
					'toggle_slug'      => 'popup_content',
					'sub_toggle' 	   => 'popup_body',
					'description'        => esc_html__( 'Select the image that you would like to display in the body of the popup.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['popup_content_image_alt'] = [
					'label'           => esc_html__( 'Image Alternative Text', 'dmpro-divi-modules-pro' ),
					'type'            => 'text',
					'option_category' => 'basic_option',
					'show_if'         => array(
						'popup_content_type' => 'image',
					),
					'toggle_slug'      => 'popup_content',
					'sub_toggle' 	   => 'popup_body',
					'description'     => esc_html__( 'Input the text to be used for alternative text of the image within the body of the popup.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['popup_content_video'] = [
					'label'              => esc_html__( 'Video MP4 File Or URL', 'dmpro-divi-modules-pro' ),
					'type'               => 'upload',
					'option_category'    => 'basic_option',
					'data_type'          => 'video',
					'upload_button_text' => esc_attr__( 'Upload a video', 'dmpro-divi-modules-pro' ),
					'choose_text'        => esc_attr__( 'Choose a Video MP4 File', 'dmpro-divi-modules-pro' ),
					'update_text'        => esc_attr__( 'Set As Video', 'dmpro-divi-modules-pro' ),
					'show_if'            => array(
						'popup_content_type' => 'video',
					),
					'toggle_slug'      => 'popup_content',
					'sub_toggle' 	   => 'popup_body',
					'description'        => esc_html__( 'Upload your desired video in .MP4 format, or enter in the URL of the video you would like to display inside the body of the popup.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['autoplay_video'] = [
					'label'            => esc_html__( 'Autoplay Video', 'dmpro-divi-modules-pro' ),
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'off' => esc_html__( 'No', 'dmpro-divi-modules-pro' ),
						'on'  => esc_html__( 'Yes', 'dmpro-divi-modules-pro' ),
					),
					'default'          => 'off',
					'default_on_front' => 'off',
					'show_if'          => array(
						'popup_content_type' => 'video',
					),
					'toggle_slug'      => 'popup_content',
					'sub_toggle' 	   => 'popup_body',
					'description'      => esc_html__( 'Enable this option to auto play the video when the popup is triggered. This option works for YouTube, Vimeo, and uploaded videos from the media library.', 'dmpro-divi-modules-pro'),
				];
			$module_fields['popup_content_layout'] = [
					'label'            => esc_html__( 'Select Divi Library Layout', 'dmpro-divi-modules-pro' ),
					'type'             => 'select',
					'option_category'  => 'configuration',
					'options'          => $list_layout,
					'show_if'          => array(
						'popup_content_type' => 'layout',
					),
					'default'          => '0',
					'default_on_front' => '0',
					'toggle_slug'      => 'popup_content',
					'sub_toggle' 	   => 'popup_body',
					'description'      => esc_html__( 'Select a layout from your Divi Library to display within the body of the popup.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['trigger_icon_font_size'] = [
					'label'            => esc_html__( 'Icon Click Trigger Font Size', 'dmpro-divi-modules-pro' ),
					'type'             => 'range',
					'option_category'  => 'font_option',
					'range_settings'   => array(
						'min'  => '1',
						'max'  => '120',
						'step' => '1',
					),
					'default'          => '50px',
					'default_on_front' => '50px',
					'mobile_options'   => true,
					'show_if'          => array(
						'trigger_type'         => 'element',
						'trigger_element_type' => 'icon',
					),
					'tab_slug'         => 'advanced',
					'toggle_slug'    => 'trigger_icon',
					'description'      => esc_html__( 'Set the size of the icon for the popup click trigger.', 'dmpro-divi-modules-pro' ),

				];
			$module_fields['trigger_icon_color'] = [
					'label'            => esc_html__( 'Icon Click Trigger Color', 'dmpro-divi-modules-pro' ),
					'type'             => 'color-alpha',
					'default'          => '#8300e9',
					'default_on_front' => '#8300e9',
					'show_if'          => array(
						'trigger_type'         => 'element',
						'trigger_element_type' => 'icon',
					),
					'tab_slug'         => 'advanced',
					'toggle_slug'    => 'trigger_icon',
					'description'      => esc_html__( 'Set the color of the icon for the popup click trigger.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_custom_margin'] = [
					'label'            => esc_html__( 'Popup Margin', 'dmpro-divi-modules-pro' ),
					'type'             => 'custom_margin',
					'option_category'  => 'layout',
					'mobile_options'   => true,
					'default'          => '',
					'default_on_front' => '',
					'tab_slug'         => 'advanced',
					'toggle_slug'      => 'margin_padding',
					'description'      => esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_custom_padding'] = [
					'label'            => esc_html__( 'Popup Padding', 'dmpro-divi-modules-pro' ),
					'type'             => 'custom_padding',
					'option_category'  => 'layout',
					'mobile_options'   => true,
					'default'          => '',
					'default_on_front' => '',
					'tab_slug'         => 'advanced',
					'toggle_slug'      => 'margin_padding',
					'description'      => esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_header_custom_margin'] = [
					'label'            => esc_html__( 'Popup Header Margin', 'dmpro-divi-modules-pro' ),
					'type'             => 'custom_margin',
					'option_category'  => 'layout',
					'mobile_options'   => true,
					'default'          => '',
					'default_on_front' => '',
					'show_if'          => array(
						'show_header' => 'on',
					),
					'tab_slug'         => 'advanced',
					'toggle_slug'      => 'margin_padding',
					'description'      => esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_header_custom_padding'] = [
					'label'            => esc_html__( 'Popup Header Padding', 'dmpro-divi-modules-pro' ),
					'type'             => 'custom_padding',
					'option_category'  => 'layout',
					'mobile_options'   => true,
					'default'          => '25px|25px|25px|25px|true|true',
					'default_on_front' => '25px|25px|25px|25px|true|true',
					'show_if'          => array(
						'show_header' => 'on',
					),
					'tab_slug'         => 'advanced',
					'toggle_slug'      => 'margin_padding',
					'description'      => esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_body_custom_margin'] = [
					'label'            => esc_html__( 'Popup Body Margin', 'dmpro-divi-modules-pro' ),
					'type'             => 'custom_margin',
					'option_category'  => 'layout',
					'mobile_options'   => true,
					'default'          => '',
					'default_on_front' => '',
					'tab_slug'         => 'advanced',
					'toggle_slug'      => 'margin_padding',
					'description'      => esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_body_custom_padding'] = [
					'label'            => esc_html__( 'Popup Body Padding', 'dmpro-divi-modules-pro' ),
					'type'             => 'custom_padding',
					'option_category'  => 'layout',
					'mobile_options'   => true,
					'default'          => '25px|25px|25px|25px|true|true',
					'default_on_front' => '25px|25px|25px|25px|true|true',
					'tab_slug'         => 'advanced',
					'toggle_slug'      => 'margin_padding',
					'description'      => esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_footer_custom_margin'] = [
					'label'            => esc_html__( 'Popup Footer Margin', 'dmpro-divi-modules-pro' ),
					'type'             => 'custom_margin',
					'option_category'  => 'layout',
					'mobile_options'   => true,
					'default'          => '',
					'default_on_front' => '',
					'show_if'          => array(
						'show_footer' => 'on',
					),
					'tab_slug'         => 'advanced',
					'toggle_slug'      => 'margin_padding',
					'description'      => esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_footer_custom_padding'] = [
					'label'            => esc_html__( 'Popup Footer Padding', 'dmpro-divi-modules-pro' ),
					'type'             => 'custom_padding',
					'option_category'  => 'layout',
					'mobile_options'   => true,
					'default'          => '25px|25px|25px|25px|true|true',
					'default_on_front' => '25px|25px|25px|25px|true|true',
					'show_if'          => array(
						'show_footer' => 'on',
					),
					'tab_slug'         => 'advanced',
					'toggle_slug'      => 'margin_padding',
					'description'      => esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['trigger_element_bg_color'] = [
					'label'             => esc_html__( 'Click Trigger Background', 'dmpro-divi-modules-pro' ),
					'type'              => 'background-field',
					'base_name'         => 'trigger_element_bg',
					'context'           => 'trigger_element_bg_color',
					'option_category'   => 'button',
					'custom_color'      => true,
					'background_fields' => $this->generate_background_options( 'trigger_element_bg', 'button', 'general', 'background', 'trigger_element_bg_color' ),
					'hover'             => false,
					'mobile_options'    => true,
					'show_if_not'       => array(
						'trigger_element_type' => 'element_id',
						'trigger_type'         => 'on_page_load',
					),
					'tab_slug'          => 'general',
					'toggle_slug'       => 'background',
					'description'       => esc_html__( 'Customize the background style of the Click Trigger Element by adjusting background color, gradient, and image.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_overlay_bg_color'] = [
					'label'             => esc_html__( 'Popup Background Overlay', 'dmpro-divi-modules-pro' ),
					'type'              => 'background-field',
					'base_name'         => 'popup_overlay_bg',
					'context'           => 'popup_overlay_bg_color',
					'option_category'   => 'button',
					'custom_color'      => true,
					'background_fields' => $this->generate_background_options( 'popup_overlay_bg', 'button', 'general', 'background', 'popup_overlay_bg_color' ),
					'hover'             => false,
					'mobile_options'    => true,
					'tab_slug'          => 'general',
					'toggle_slug'       => 'background',
					'description'       => esc_html__( 'Customize the background overlay by adjusting background color, gradient, and image.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_bg_color'] = [
					'label'             => esc_html__( 'Popup Background', 'dmpro-divi-modules-pro' ),
					'type'              => 'background-field',
					'base_name'         => 'popup_bg',
					'context'           => 'popup_bg_color',
					'option_category'   => 'button',
					'custom_color'      => true,
					'background_fields' => $this->generate_background_options( 'popup_bg', 'button', 'general', 'background', 'popup_bg_color' ),
					'hover'             => false,
					'mobile_options'    => true,
					'tab_slug'          => 'general',
					'toggle_slug'       => 'background',
					'description'       => esc_html__( 'Customize the background of the popup by adjusting background color, gradient, and image.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_header_bg_color'] = [
					'label'             => esc_html__( 'Popup Header Background', 'dmpro-divi-modules-pro' ),
					'type'              => 'background-field',
					'base_name'         => 'popup_header_bg',
					'context'           => 'popup_header_bg_color',
					'option_category'   => 'button',
					'custom_color'      => true,
					'background_fields' => $this->generate_background_options( 'popup_header_bg', 'button', 'general', 'background', 'popup_header_bg_color' ),
					'hover'             => false,
					'mobile_options'    => true,
					'show_if'           => array(
						'show_header' => 'on',
					),
					'tab_slug'          => 'general',
					'toggle_slug'       => 'background',
					'description'       => esc_html__( 'Customize the background of the popup header by adjusting background color, gradient, and image.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_body_bg_color'] = [
					'label'             => esc_html__( 'Popup Body Background', 'dmpro-divi-modules-pro' ),
					'type'              => 'background-field',
					'base_name'         => 'popup_body_bg',
					'context'           => 'popup_body_bg_color',
					'option_category'   => 'button',
					'custom_color'      => true,
					'background_fields' => $this->generate_background_options( 'popup_body_bg', 'button', 'general', 'background', 'popup_body_bg_color' ),
					'hover'             => false,
					'mobile_options'    => true,
					'tab_slug'          => 'general',
					'toggle_slug'       => 'background',
					'description'       => esc_html__( 'Customize the background of the popup body by adjusting background color, gradient, and image.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_footer_bg_color'] = [
					'label'             => esc_html__( 'Popup Footer Background', 'dmpro-divi-modules-pro' ),
					'type'              => 'background-field',
					'base_name'         => 'popup_footer_bg',
					'context'           => 'popup_footer_bg_color',
					'option_category'   => 'button',
					'custom_color'      => true,
					'background_fields' => $this->generate_background_options( 'popup_footer_bg', 'button', 'general', 'background', 'popup_footer_bg_color' ),
					'hover'             => false,
					'mobile_options'    => true,
					'show_if'           => array(
						'show_footer' => 'on',
					),
					'tab_slug'          => 'general',
					'toggle_slug'       => 'background',
					'description'       => esc_html__( 'Customize the background of the popup footer by adjusting background color, gradient, and image.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_close_icon'] = [
					'type'             => 'skip',
					'default'          => '%%48%%',
					'default_on_front' => '%%48%%',
					'show_if'          => array(
						'show_header'     => 'on',
						'show_close_icon' => 'on',
					),
					'tab_slug'         => 'advanced',
					'toggle_slug' => 'popup_close_icon',
				];
			$module_fields['popup_close_icon_font_size'] = [
					'label'            => esc_html__( 'Popup Close Icon Font Size', 'dmpro-divi-modules-pro' ),
					'type'             => 'range',
					'option_category'  => 'font_option',
					'range_settings'   => array(
						'min'  => '1',
						'max'  => '120',
						'step' => '1',
					),
					'default'          => '34px',
					'default_on_front' => '34px',
					'mobile_options'   => true,
					'show_if'          => array(
						'show_header'     => 'on',
						'show_close_icon' => 'on',
					),
					'tab_slug'         => 'advanced',
					'toggle_slug' => 'popup_close_icon',
					'description'      => esc_html__( 'Set the font size of the popup close button icon.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_close_icon_color'] = [
					'label'            => esc_html__( 'Popup Close Icon Color', 'dmpro-divi-modules-pro' ),
					'type'             => 'color-alpha',
					'default'          => '#212121',
					'default_on_front' => '#212121',
					'show_if'          => array(
						'show_header'     => 'on',
						'show_close_icon' => 'on',
					),
					'tab_slug'         => 'advanced',
					'toggle_slug' => 'popup_close_icon',
					'description'      => esc_html__( 'Choose the color for the popup close button icon.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_position'] = [
					'label'            => esc_html__( 'Popup Position', 'dmpro-divi-modules-pro' ),
					'type'             => 'select',
					'option_category'  => 'configuration',
					'options'          => array(
						'top_left'      => esc_html__( 'Top Left', 'dmpro-divi-modules-pro' ),
						'top_right'     => esc_html__( 'Top Right', 'dmpro-divi-modules-pro' ),
						'top_center'    => esc_html__( 'Top Center', 'dmpro-divi-modules-pro' ),
						'bottom_left'   => esc_html__( 'Bottom Left', 'dmpro-divi-modules-pro' ),
						'bottom_right'  => esc_html__( 'Bottom Right', 'dmpro-divi-modules-pro' ),
						'bottom_center' => esc_html__( 'Bottom Center', 'dmpro-divi-modules-pro' ),
						'center'        => esc_html__( 'Center', 'dmpro-divi-modules-pro' ),
					),
					'default'          => 'center',
					'default_on_front' => 'center',
					'tab_slug'         => 'advanced',
					'toggle_slug'      => 'popup_sizing',
					'description'      => esc_html__( 'Select the position of the popup on the page.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_animation_style'] = [
					'label'           => esc_html__( 'Popup Animation Style', 'dmpro-divi-modules-pro' ),
					'type'            => 'select_animation',
					'option_category' => 'configuration',
					'options'         => array(
						'none'   => esc_html__( 'None', 'dmpro-divi-modules-pro' ),
						'fade'   => esc_html__( 'Fade', 'dmpro-divi-modules-pro' ),
						'slide'  => esc_html__( 'Slide', 'et_builder' ),
						'bounce' => esc_html__( 'Bounce', 'et_builder' ),
						'zoom'   => esc_html__( 'Zoom', 'et_builder' ),
						'flip'   => esc_html__( 'Flip', 'et_builder' ),
						'fold'   => esc_html__( 'Fold', 'et_builder' ),
						'roll'   => esc_html__( 'Roll', 'et_builder' ),
					),
					'default'         => 'zoom',
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'animation',
					'description'     => esc_html__( 'Pick an animation style to enable animations for this popup. Once enabled, you will be able to customize your animation style further. To disable animations, choose the None option.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_animation_direction'] = [
					'label'           => esc_html__( 'Popup Animation Direction', 'dmpro-divi-modules-pro' ),
					'type'            => 'select',
					'option_category' => 'configuration',
					'options'         => array(
						'center' => esc_html__( 'Center', 'et_builder' ),
						'right'  => esc_html__( 'Right', 'et_builder' ),
						'left'   => esc_html__( 'Left', 'et_builder' ),
						'up'     => esc_html__( 'Up', 'et_builder' ),
						'down'   => esc_html__( 'Down', 'et_builder' ),
					),
					'default'         => 'center',
					'show_if_not'     => array(
						'popup_animation_style' => array( 'none', 'fade' ),
					),
					'mobile_options'  => true,
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'animation',
					'description'     => esc_html__( 'Pick from up to five different animation directions, each of which will adjust the starting and ending position of your animated element.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_animation_duration'] = [
					'label'           => esc_html__( 'Popup Animation Duration', 'dmpro-divi-modules-pro' ),
					'type'            => 'range',
					'option_category' => 'configuration',
					'range_settings'  => array(
						'min'  => 0,
						'max'  => 2000,
						'step' => 50,
					),
					'default'         => '1000ms',
					'validate_unit'   => true,
					'fixed_unit'      => 'ms',
					'fixed_range'     => true,
					'show_if_not'     => array(
						'popup_animation_style' => 'none',
					),
					'reset_animation' => true,
					'mobile_options'  => true,
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'animation',
					'description'     => esc_html__( 'Speed up or slow down your animation by adjusting the animation duration. Units are in milliseconds and the default animation duration is one second.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_animation_intensity'] = [
					'label'           => esc_html__( 'Popup Animation Intensity', 'dmpro-divi-modules-pro' ),
					'type'            => 'range',
					'option_category' => 'configuration',
					'range_settings'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'default'         => '50%',
					'validate_unit'   => true,
					'fixed_unit'      => '%',
					'fixed_range'     => true,
					'show_if'         => array(
						'popup_animation_style' => array( 'slide', 'zoom', 'flip', 'fold', 'roll' ),
					),
					'reset_animation' => true,
					'mobile_options'  => true,
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'animation',
					'description'     => esc_html__( 'Intensity effects how subtle or aggressive your animation will be. Lowering the intensity will create a smoother and more subtle animation while increasing the intensity will create a snappier more aggressive animation.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_animation_starting_opacity'] = [
					'label'           => esc_html__( 'Popup Animation Starting Opacity', 'dmpro-divi-modules-pro' ),
					'type'            => 'range',
					'option_category' => 'configuration',
					'range_settings'  => array(
						'min'       => 0,
						'max'       => 100,
						'step'      => 1,
						'min_limit' => 0,
						'max_limit' => 100,
					),
					'default'         => '0%',
					'validate_unit'   => true,
					'fixed_unit'      => '%',
					'fixed_range'     => true,
					'reset_animation' => true,
					'mobile_options'  => true,
					'show_if_not'     => array(
						'popup_animation_style' => 'none',
					),
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'animation',
					'description'     => esc_html__( 'By increasing the starting opacity, you can reduce or remove the fade effect that is applied to all animation styles.', 'dmpro-divi-modules-pro' ),
				];
			$module_fields['popup_animation_speed_curve'] = [
					'label'           => esc_html__( 'Popup Animation Speed Curve', 'dmpro-divi-modules-pro' ),
					'type'            => 'select',
					'option_category' => 'configuration',
					'options'         => array(
						'ease-in-out' => esc_html__( 'Ease-In-Out', 'dmpro-divi-modules-pro' ),
						'ease'        => esc_html__( 'Ease', 'dmpro-divi-modules-pro' ),
						'ease-in'     => esc_html__( 'Ease-In', 'dmpro-divi-modules-pro' ),
						'ease-out'    => esc_html__( 'Ease-Out', 'dmpro-divi-modules-pro' ),
						'linear'      => esc_html__( 'Linear', 'dmpro-divi-modules-pro' ),
					),
					'mobile_options'  => true,
					'default'         => 'ease-in-out',
					'show_if_not'     => array(
						'popup_animation_style' => 'none',
					),
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'animation',
					'description'     => esc_html__( 'Here you can adjust the easing method of your animation. Easing your animation in and out will create a smoother effect when compared to a linear speed curve.', 'dmpro-divi-modules-pro' ),
				];
			
			$module_fields = array_merge($module_fields, $this->generate_background_options( 'trigger_element_bg', 'skip', 'general', 'background', 'trigger_element_bg_color' ));
			$module_fields = array_merge($module_fields, $this->generate_background_options( 'popup_overlay_bg', 'skip', 'general', 'background', 'popup_overlay_bg_color' ));
			$module_fields = array_merge($module_fields, $this->generate_background_options( 'popup_bg', 'skip', 'general', 'background', 'popup_bg_color' ));
			$module_fields = array_merge($module_fields, $this->generate_background_options( 'popup_header_bg', 'skip', 'general', 'background', 'popup_header_bg_color' ));
			$module_fields = array_merge($module_fields, $this->generate_background_options( 'popup_body_bg', 'skip', 'general', 'background', 'popup_body_bg_color' ));
			$module_fields = array_merge($module_fields, $this->generate_background_options( 'popup_footer_bg', 'skip', 'general', 'background', 'popup_footer_bg_color' ));
		return $module_fields;
	}
	public function get_advanced_fields_config() {
		return array(
			'fonts'=> array(
				'popup_title_text' => array(
					'label'=> esc_html__( 'Popup Title', 'dmpro-divi-modules-pro' ),
					'font_size' => array(
						'default' => '22px',
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
						'validate_unit'  => true,
					),
					'line_height' => array(
						'default' => '1.5em',
						'range_settings' => array(
							'min'  => '0.1',
							'max'  => '10',
							'step' => '0.1',
						),
					),
					'letter_spacing' => array(
						'default' => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '10',
							'step' => '1',
						),
						'validate_unit' => true,
					),
					'header_level' => array(
						'default' => 'h2',
					),
					'text_align' => array(
						'default' => 'left',
					),
					'css' => array(
						'main' => "{$this->main_css_element}_module .dmpro_popup_header_title",
						'hover' => "{$this->main_css_element}_module .dmpro_popup_header_title:hover",
						'text_align' => "{$this->main_css_element}_module .dmpro_popup_header_title_container",
					),
					'tab_slug' => 'advanced',
					'toggle_slug' => 'popup_text',
					'sub_toggle' => 'popup_title_text',

				),
				'popup_body_text' => array(
					'label' => esc_html__( 'Popup Body', 'dmpro-divi-modules-pro' ),
					'font_size' => array(
						'default' => '15px',
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
						'validate_unit' => true,
					),
					'line_height' => array(
						'default' => '1.5em',
						'range_settings' => array(
							'min'  => '0.1',
							'max'  => '10',
							'step' => '0.1',
						),
					),
					'letter_spacing' => array(
						'default' => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '10',
							'step' => '1',
						),
						'validate_unit' => true,
					),
					'text_align' => array(
						'default' => 'left',
					),
					'css' => array(
						'main'  => "{$this->main_css_element}_module .dmpro_popup_body",
						'hover' => "{$this->main_css_element}_module .dmpro_popup_body:hover",
					),
					'tab_slug' => 'advanced',
					'toggle_slug' => 'popup_text',
					'sub_toggle' => 'popup_body_text',
				),
				'popup_trigger_text' => array(
					
					'label' => esc_html__( 'Click Trigger Text', 'dmpro-divi-modules-pro' ),
					'font_size' => array(
						'default' => '18px',
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
						'validate_unit'  => true,
					),
					'line_height' => array(
						'default' => '1.5em',
						'range_settings' => array(
							'min'  => '0.1',
							'max'  => '10',
							'step' => '0.1',
						),
					),
					'letter_spacing'  => array(
						'default' => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '10',
							'step' => '1',
						),
						'validate_unit' => true,
					),
					'hide_text_align' => true,
					'css' => array(
						'main'  => "{$this->main_css_element} .dmpro_popup_trigger_text",
						'hover' => "{$this->main_css_element} .dmpro_popup_trigger_text:hover",
					),
					'tab_slug' => 'advanced',
					'toggle_slug'    => 'trigger_text',
				),
			),
			'button' => array(
				'trigger_button' => array(
					'label' => esc_html__( 'Click Trigger Button', 'dmpro-divi-modules-pro' ),
					'css' => array(
						'main' => "{$this->main_css_element} .dmpro_popup_trigger_button",
						'alignment' => "{$this->main_css_element} .dmpro_popup_trigger_element_wrapper .et_pb_button_wrapper",
						'important' => 'all',
					),
					'margin_padding' => array(
						'css' => array(
							'margin' => "{$this->main_css_element} .dmpro_popup_trigger_element_wrapper .et_pb_button_wrapper",
							'padding'   => "{$this->main_css_element} .dmpro_popup_trigger_button, {$this->main_css_element} .dmpro_popup_trigger_button:hover",
							'important' => 'all',
						),
						
					),
					'box_shadow' => array(
						'css' => array(
							'main' => "{$this->main_css_element} .dmpro_popup_trigger_button",
							'important' => 'all',
						),
						'depends_show_if' => array('trigger_element_type' => 'button'),
						
					),
					'use_alignment'  => false,
					'tab_slug'       => 'advanced',
					'toggle_slug'    => 'trigger_button',
				),
				'close_button' => array(
					'label' => esc_html__( 'Footer Close Button', 'dmpro-divi-modules-pro' ),
					'css' => array(
						'main' => "{$this->main_css_element}_module .dmpro_popup_close_button",
						'alignment' => "{$this->main_css_element}_module .dmpro_popup_footer .et_pb_button_wrapper",
						'important' => 'all',
					),
					'margin_padding' => array(
						'css' => array(
							'margin'    => "{$this->main_css_element}_module .dmpro_popup_footer .et_pb_button_wrapper",
							'padding'   => "{$this->main_css_element}_module .dmpro_popup_close_button, {$this->main_css_element}_module .dmpro_popup_close_button:hover",
							'important' => 'all',
						),
					),
					'box_shadow'     => array(
						'css' => array(
							'main' => "{$this->main_css_element}_module .dmpro_popup_close_button",
							'important' => 'all',
						),
					),
					'use_alignment'  => true,
					'tab_slug'       => 'advanced',
					'toggle_slug' => 'popup_close_button',
				),
			),
			'borders' => array(
				'default' => false,
				'popup' => array(
					'label_prefix' => 'Popup',
					'css' => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element}_module .dmpro_popup_inner_wrap",
							'border_styles' => "{$this->main_css_element}_module .dmpro_popup_inner_wrap",
							'important' => 'all',
						),
					),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'border',
				),
				'trigger_element' => array(
					'label_prefix' => 'Click Trigger Element',
					'css' => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .dmpro_popup_trigger_element_wrapper .dmpro_popup_trigger_element",
							'border_styles' => "{$this->main_css_element} .dmpro_popup_trigger_element_wrapper .dmpro_popup_trigger_element",
						),
						'important' => 'all',
					),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'border',
				),
			),
			'box_shadow' => array(
				'default' => false,
				'trigger_element' => array(
					'label' => esc_html__( 'Click Trigger Box Shadow', 'dmpro-divi-modules-pro' ),
					'show_if'        => array(
						'trigger_type'         => 'element',
					),
					'css' => array(
						'main' => "{$this->main_css_element} .dmpro_popup_trigger_element",
					),
					'tab_slug' => 'advanced',
					'toggle_slug' => 'box_shadow',
				),
				'popup' => array(
					'label'       => esc_html__( 'Popup Box Shadow', 'dmpro-divi-modules-pro' ),
					'css'         => array(
						'main' => "{$this->main_css_element}_module .dmpro_popup_inner_wrap",
						'important' => 'all',
					),
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'box_shadow',
				),
				'popup_header' => array(
					'label' => esc_html__( 'Popup Header Box Shadow', 'dmpro-divi-modules-pro' ),
					'show_if'        => array(
						'show_header'         => 'on',
					),
					'css'  => array(
						'main' => "{$this->main_css_element}_module .dmpro_popup_header",
					),
					'tab_slug' => 'advanced',
					'toggle_slug' => 'box_shadow',
				),
				'popup_footer' => array(
					'label' => esc_html__( 'Popup Footer Box Shadow', 'dmpro-divi-modules-pro' ),
					'show_if'        => array(
						'show_footer'         => 'on',
					),
					'css' => array(
						'main' => "{$this->main_css_element}_module .dmpro_popup_footer",
					),
					'priority' => 0,
					'tab_slug' => 'advanced',
					'toggle_slug' => 'box_shadow',
				),
			),
			'max_width' => array(
				'extra' => array(
					'popup' => array(
						'options' => array(
							'width' => array(
								'label' => esc_html__( 'Popup Width', 'dmpro-divi-modules-pro' ),
								'range_settings' => array(
									'min'  => 1,
									'max'  => 100,
									'step' => 1,
								),
								'hover' => false,
								'default_unit'   => '%',
								'default_tablet' => '',
								'default_phone'  => '',
								'tab_slug'       => 'advanced',
								'toggle_slug'    => 'popup_sizing',
							),
						),
						'use_max_width' => false,
						'use_module_alignment' => false,
						'css' => array(
							'main' => "{$this->main_css_element}_module .dmpro_popup_inner_wrap",
							'important' => 'all',
						),
					),
					'trigger_image' => array(
						'options' => array(
							'width' => array(
								'label' => esc_html__( 'Image Width', 'dmpro-divi-modules-pro' ),
								'range_settings' => array(
									'min'  => 1,
									'max'  => 100,
									'step' => 1,
								),
								'hover' => false,
								'default_unit'   => '%',
								'default_tablet' => '',
								'default_phone'  => '',
								'show_if'        => array(
									'trigger_element_type' => 'image',
								),
								'tab_slug' => 'advanced',
								'toggle_slug' => 'trigger_image',
							),
						),
						'use_max_width' => false,
						'use_module_alignment' => false,
						'css' => array(
							'main' => "{$this->main_css_element} .dmpro_popup_trigger_image",
						),
					),
				),
			),
			'height' => array(
				'extra' => array(
					'popup' => array(
						'options'        => array(
							'height' => array(
								'label' => esc_html__( 'Popup Height', 'dmpro-divi-modules-pro' ),
								'range_settings' => array(
									'min'  => 1,
									'max'  => 100,
									'step' => 1,
								),
								'hover' => false,
								'default_unit'   => '%',
								'default_tablet' => '',
								'default_phone'  => '',
								'tab_slug'       => 'advanced',
								'toggle_slug'    => 'popup_sizing',
							),
						),
						'use_max_height' => false,
						'use_min_height' => false,
						'css'            => array(
							'main' => "{$this->main_css_element}_module .dmpro_popup_inner_wrap",
							'important' => 'all',
						),
					),
				),
			),
			'text' => array(
				'text_orientation' => array(
					'exclude_options' => array( 'justified' ),
				),
				'options' => array(
					'text_orientation' => array(
						'label' => esc_html__( 'Click Trigger Alignment', 'dmpro-divi-modules-pro' ),
						'default'          => 'center',
						'show_if'        => array(
							'trigger_type'         => 'element',
						),
					),
				),
				'css' => array(
					'text_orientation' => $this->main_css_element,
					'important' => 'all',
				),
			),
			'popup_margin_padding' => array(
				'popup' => array(
					'margin_padding' => array(
						'css' => array(
							'margin'    => "{$this->main_css_element}_module .dmpro_popup_inner_wrap",
							'padding'   => "{$this->main_css_element}_module .dmpro_popup_inner_wrap",
							'important' => 'all',
						),
					),
				),
				'popup_header' => array(
					'margin_padding' => array(
						'css' => array(
							'margin'    => "{$this->main_css_element}_module .dmpro_popup_header",
							'padding'   => "{$this->main_css_element}_module .dmpro_popup_header",
							'important' => 'all',
						),
					),
				),
				'popup_body'   => array(
					'margin_padding' => array(
						'css' => array(
							'margin'    => "{$this->main_css_element}_module .dmpro_popup_body",
							'padding'   => "{$this->main_css_element}_module .dmpro_popup_body",
							'important' => 'all',
						),
					),
				),
				'popup_footer' => array(
					'margin_padding' => array(
						'css' => array(
							'margin'    => "{$this->main_css_element}_module .dmpro_popup_footer",
							'padding'   => "{$this->main_css_element}_module .dmpro_popup_footer",
							'important' => 'all',
						),
					),
				),
			),
			'margin_padding' => array(
				'css' => array(
					'main'      => $this->main_css_element,
					'important' => 'all',
				),
			),
			'text_shadow' => false,
			'link_options' => false,
			'filters' => false,
			'background' => false,
		);
	}

	public static function get_video( $args = array() ) {
		$defaults = array(
			'popup_content_video' => '',
		);

		$args = wp_parse_args( $args, $defaults );

		if ( empty( $args['popup_content_video'] ) ) {
			return '';
		}

		$video_src = '';

		if ( false !== et_pb_check_oembed_provider( esc_url( $args['popup_content_video'] ) ) ) {
			$video_src = wp_oembed_get( esc_url( $args['popup_content_video'] ) );
		} else {
			$video_src = sprintf(
				'
				<video controls>
					%1$s
				</video>',
				( '' !== $args['popup_content_video'] ? sprintf( '<source type="video/mp4" src="%s" />', esc_url( $args['popup_content_video'] ) ) : '' )
			);

			wp_enqueue_style( 'wp-mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
		}

		return $video_src;
	}

	public static function get_library_layout( $args = array() ) {
		$defaults = array(
			'popup_content_layout' => 0,
		);

		$args = wp_parse_args( $args, $defaults );

		if ( 0 === intval( $args['popup_content_layout'] ) ) {
			return '';
		}
		$remove_shortcode = dmpro_remove_shortcode( get_the_content( null, false, intval( $args['popup_content_layout'] ) ) );
		$layout = do_shortcode( $remove_shortcode );

		return $layout;
	}
	public function render( $attrs, $content, $render_slug ) {
		wp_enqueue_style("dmpro-".$this->slug, plugin_dir_url(__FILE__) . 'style.css', [], DMPRO_VERSION, 'all');
		wp_enqueue_script("dmpro-".$this->slug, plugin_dir_url(__FILE__) . 'custom.js', array(), DMPRO_VERSION, true);
		
		$multi_view = et_pb_multi_view_options( $this );
		$popup_id = $this->props['popup_id'];
		$trigger_type = $this->props['trigger_type'];
		$trigger_delay = $this->props['trigger_delay'];
		$re_rendering = $this->props['re_rendering'];
		$trigger_element_type = $this->props['trigger_element_type'];
		$trigger_button_text = $this->props['trigger_button_text'];
		$trigger_image_alt = $this->props['trigger_image_alt'];
		$show_header = $this->props['show_header'];
		$show_footer = $this->props['show_footer'];
		$close_button_text = $this->props['close_button_text'];
		$popup_content_type = $this->props['popup_content_type'];
		$popup_content_image_alt = $this->props['popup_content_image_alt'];
		$autoplay_video = $this->props['autoplay_video'];
		$popup_content_layout = $this->props['popup_content_layout'];
		$trigger_element_id = $this->props['trigger_element_id'];
		$trigger_element_class = $this->props['trigger_element_class'];
		$custom_trigger_button = $this->props['custom_trigger_button'];
		$trigger_button_icon = $this->props['trigger_button_icon'];
		$custom_close_button = $this->props['custom_close_button'];
		$close_button_icon = $this->props['close_button_icon'];
		$popup_title_level = $this->props['popup_title_text_level'];
		$popup_position = $this->props['popup_position'];
		$animation_style = $this->props['popup_animation_style'];
		$processed_popup_title_level = et_pb_process_header_level( $popup_title_level, 'h2' );
		$animation_durations = et_pb_responsive_options()->get_property_values( $this->props, 'popup_animation_duration' );


		$trigger_element_wrapper = '';
		if ( 'element' === $trigger_type && 'element_id' !== $trigger_element_type && 'element_class' !== $trigger_element_type ) {
			switch ( $trigger_element_type ) {
				case 'button':
					$trigger_element = $this->render_button(
						array(
							'button_text'         => esc_html( $trigger_button_text ),
							'button_text_escaped' => true,
							'button_url'          => '#',
							'button_classname'    => array( 'dmpro_popup_trigger_element dmpro_popup_trigger_button' ),
							'button_custom'       => isset( $custom_trigger_button ) ? $custom_trigger_button : 'off',
							'custom_icon'         => isset( $trigger_button_icon ) ? $trigger_button_icon : '',
							'has_wrapper'         => true,
							'button_rel'          => esc_html( $this->props['trigger_button_rel'] ),
						)
					);
					break;

				case 'image':
					$trigger_element = $multi_view->render_element(
						array(
							'tag'      => 'img',
							'attrs'    => array(
								'src'   => '{{trigger_image}}',
								'class' => 'dmpro_popup_trigger_element dmpro_popup_trigger_image',
								'alt'   => esc_html( $trigger_image_alt ),
							),
							'required' => 'trigger_image',
						)
					);
					break;

				case 'icon':
					$trigger_element = $multi_view->render_element(
						array(
							'content'  => '{{trigger_icon}}',
							'attrs'    => array(
								'class' => 'dmpro_popup_trigger_element dmpro_popup_trigger_icon et-pb-icon',
							),
							'required' => 'trigger_icon',
						)
					);
					break;

				case 'text':
					$trigger_element = $multi_view->render_element(
						array(
							'tag'      => 'div',
							'content'  => '{{trigger_text}}',
							'attrs'    => array(
								'class' => 'dmpro_popup_trigger_element dmpro_popup_trigger_text',
							),
							'required' => 'trigger_text',
						)
					);
					break;

				default:
					break;
			}
			if ( isset( $trigger_element ) && $trigger_element && '' !== $trigger_element ) {
				$trigger_element_wrapper = sprintf(
					'<div class="dmpro_popup_trigger_element_wrapper">%1$s</div>',
					et_core_intentionally_unescaped( $trigger_element, 'html' )
				);
			}
		}

		$popup_title = $multi_view->render_element(
			array(
				'tag'      => esc_html( $processed_popup_title_level ),
				'content'  => '{{popup_title}}',
				'attrs'    => array(
					'class' => 'dmpro_popup_header_title',
				),
				'required' => array(
					'show_header'      => 'on',
					'show_popup_title' => 'on',
					'popup_title',
				),
			)
		);

		$popup_close_icon = $multi_view->render_element(
			array(
				'content'  => '{{popup_close_icon}}',
				'attrs'    => array(
					'class' => 'dmpro_popup_close dmpro_popup_close_icon et-pb-icon',
				),
				'required' => array(
					'show_header'     => 'on',
					'show_close_icon' => 'on',
				),
			)
		);

		if ( '' !== $popup_title ) {
			$popup_title = sprintf(
				'<div class="dmpro_popup_header_title_container">%1$s</div>',
				$popup_title
			);
		}

		if ( '' !== $popup_title || '' !== $popup_close_icon ) {
			$popup_header = sprintf(
				'<div class="dmpro_popup_header">%1$s%2$s</div>',
				'' !== $popup_close_icon ? $popup_close_icon : '',
				'' !== $popup_title ? $popup_title : ''
			);
		}

		if ( 'on' === $show_footer ) {
			$close_button_text  = '' !== $close_button_text ? $close_button_text : esc_html__( 'Close', 'dmpro-divi-modules-pro' );
			$popup_close_button = $this->render_button(
				array(
					'button_text'         => esc_html( $close_button_text ),
					'button_text_escaped' => true,
					'button_url'          => '#',
					'button_classname'    => array( 'dmpro_popup_close dmpro_popup_close_button' ),
					'button_custom'       => isset( $custom_close_button ) ? $custom_close_button : 'off',
					'custom_icon'         => isset( $close_button_icon ) ? $close_button_icon : '',
					'has_wrapper'         => true,
					'button_rel'          => esc_html( $this->props['close_button_rel'] ),
				)
			);

			if ( '' !== $popup_close_button ) {
				$popup_footer = sprintf(
					'<div class="dmpro_popup_footer">%1$s</div>',
					$popup_close_button
				);
			}
		}

		switch ( $popup_content_type ) {
			case 'text':
				$popup_body_content = $multi_view->render_element(
					array(
						'tag'      => 'div',
						'content'  => '{{content}}',
						'attrs'    => array(
							'class' => 'dmpro_popup_content_text',
						),
						'required' => 'content',
					)
				);
				break;

			case 'image':
				$popup_body_content = $multi_view->render_element(
					array(
						'tag'      => 'img',
						'attrs'    => array(
							'src'   => '{{popup_content_image}}',
							'class' => 'dmpro_popup_content_image',
							'alt'   => esc_html( $popup_content_image_alt ),
						),
						'required' => 'popup_content_image',
					)
				);
				break;

			case 'video':
				$video_srcs = self::get_video(
					array(
						'popup_content_video' => $multi_view->get_inherit_value( 'popup_content_video', 'desktop' ),
					)
				);
				$multi_view->set_custom_prop( 'video_srcs', $video_srcs );
				$popup_body_content = $multi_view->render_element(
					array(
						'tag'      => 'div',
						'content'  => '{{video_srcs}}',
						'attrs'    => array(
							'class' => 'dmpro_popup_content_video et_pb_video_box',
						),
						'required' => 'popup_content_video',
					)
				);
				break;

			case 'layout':
				if ( 0 !== intval( $popup_content_layout ) ) {
					$popup_body_content = self::get_library_layout(
						array(
							'popup_content_layout' => intval( $popup_content_layout ),
						)
					);
				}
				break;

			default:
				break;
		}

		if ( isset( $popup_body_content ) && '' !== $popup_body_content ) {
			$popup_body = sprintf(
				'<div class="dmpro_popup_body">%1$s</div>',
				$popup_body_content
			);
		}

		if ( 'none' !== $animation_style ) {
			$data_animation_duration        = sprintf(
				' data-animation-duration="%1$s"',
				esc_attr( $animation_durations['desktop'] )
			);
			$data_animation_duration_tablet = sprintf(
				' data-animation-duration-tablet="%1$s"',
				esc_attr( $animation_durations['tablet'] )
			);
			$data_animation_duration_phone  = sprintf(
				' data-animation-duration-phone="%1$s"',
				esc_attr( $animation_durations['phone'] )
			);
		}

		if ( 'element' === $trigger_type && 'element_id' === $trigger_element_type ) {
			$data_trigger_element_id = sprintf(
				' data-trigger-element-id="%1$s"',
				esc_attr( $trigger_element_id )
			);
		}

		if ( 'element' === $trigger_type && 'element_class' === $trigger_element_type ) {
			$data_trigger_element_class = sprintf(
				' data-trigger-element-class="%1$s"',
				esc_attr( $trigger_element_class )
			);
		}

		$popup_wrapper_classes = array( 'dmpro_popup_' . $popup_position );

		if ( 'on' === $this->props['close_on_esc'] ) {
			array_push( $popup_wrapper_classes, 'dmpro_popup_close_on_esc' );
		}

		$popup_wrapper_classes = implode( ' ', $popup_wrapper_classes );

		$popup_wrapper = sprintf(
			'<div class="dmpro_popup_wrapper %4$s" data-id="%12$s" data-re-render="%13$s" data-autoplay-video="%14$s" data-trigger-type="%6$s" data-trigger-delay="%7$s" %8$s %9$s %10$s %11$s %15$s>
				<div class="dmpro_popup_inner_wrap%5$s">
					%1$s
					%2$s
					%3$s
				</div>
			</div>',
			isset( $popup_header ) ? $popup_header : '',
			isset( $popup_body ) ? $popup_body : '',
			isset( $popup_footer ) ? $popup_footer : '',
			esc_attr( $popup_wrapper_classes ),
			'none' !== $animation_style ? ' dmpro_animated' : '',
			esc_attr( $trigger_type ),
			esc_attr( $trigger_delay ),
			isset( $data_animation_duration ) ? $data_animation_duration : '',
			isset( $data_animation_duration_tablet ) ? $data_animation_duration_tablet : '',
			isset( $data_animation_duration_phone ) ? $data_animation_duration_phone : '',
			isset( $data_trigger_element_id ) ? $data_trigger_element_id : '',
			esc_attr( $popup_id ),
			esc_attr( $re_rendering ),
			'video' === $popup_content_type && 'on' === $autoplay_video ? 'on' : 'off',
			isset( $data_trigger_element_class ) ? $data_trigger_element_class : ''
		);

		if ( 'element' === $trigger_type && 'element_id' !== $trigger_element_type && 'element_class' !== $trigger_element_type ) {
			$output = $trigger_element_wrapper . $popup_wrapper;
		} else {
			$output = $popup_wrapper;
		}

		if (
			'on_page_load' === $trigger_type ||
			'exit_intent' === $trigger_type ||
			( 'element' === $trigger_type && 'element_id' === $trigger_element_type ) ||
			( 'element' === $trigger_type && 'element_class' === $trigger_element_type )
		) {
			self::set_style(
				$render_slug,
				array(
					'selector'    => $this->main_css_element,
					'declaration' => 'margin-bottom: 0 !important;',
				)
			);
		}

		if ( 'element' === $trigger_type && 'icon' === $trigger_element_type ) {
			$trigger_icon_font_sizes = et_pb_responsive_options()->get_property_values( $this->props, 'trigger_icon_font_size' );
			$trigger_icon_colors     = et_pb_responsive_options()->get_property_values( $this->props, 'trigger_icon_color' );
			et_pb_responsive_options()->generate_responsive_css( $trigger_icon_font_sizes, '%%order_class%% .dmpro_popup_trigger_icon', 'font-size', $render_slug, '', 'range' );
			et_pb_responsive_options()->generate_responsive_css( $trigger_icon_colors, '%%order_class%% .dmpro_popup_trigger_icon', 'color', $render_slug, '', 'type' );
		}

		$popup_close_icon_colors = et_pb_responsive_options()->get_property_values( $this->props, 'popup_close_icon_color' );
		et_pb_responsive_options()->generate_responsive_css( $popup_close_icon_colors, '%%order_class%%_module .dmpro_popup_close_icon', 'color', $render_slug, '', 'type' );

		$popup_close_icon_font_sizes = et_pb_responsive_options()->get_property_values( $this->props, 'popup_close_icon_font_size' );
		et_pb_responsive_options()->generate_responsive_css( $popup_close_icon_font_sizes, '%%order_class%%_module .dmpro_popup_close_icon', 'font-size', $render_slug, '!important', 'range' );

		if ( isset( $this->props['disabled_on'] ) && $this->props['disabled_on']  ) {
			$disabled_on = str_replace( array( 'on', 'off' ), array( 'none', 'block' ), $this->props['disabled_on'] );
			$disabled_on = array_combine( array( 'phone', 'tablet', 'desktop' ), explode( '|', $disabled_on ) );
			$disabled_on = array_reverse( $disabled_on );
			et_pb_responsive_options()->generate_responsive_css( $disabled_on, '%%order_class%%_module', 'display', $render_slug, '', 'display' );
		}

		$options = array(
			'normal' => array(
				'trigger_element_bg' => "{$this->main_css_element} .dmpro_popup_trigger_element",
				'popup_overlay_bg'	 => "{$this->main_css_element}_module .dmpro_popup_wrapper",
				'popup_bg'           => "{$this->main_css_element}_module .dmpro_popup_inner_wrap",
				'popup_header_bg'    => "{$this->main_css_element}_module .dmpro_popup_header",
				'popup_body_bg'      => "{$this->main_css_element}_module .dmpro_popup_body",
				'popup_footer_bg'    => "{$this->main_css_element}_module .dmpro_popup_footer",
			),
		);

		$this->process_popup_animation_css( $animation_style, $render_slug );
		$this->process_advanced_margin_padding_css( $this, $render_slug, $this->margin_padding );
		$this->process_custom_background( $render_slug, $options );

		return et_core_intentionally_unescaped( $output, 'html' );
	}

	public function process_popup_animation_css( $animation_style, $render_slug ) {
		// Animation Styles.
		if ( $animation_style && 'none' !== $animation_style ) {
			$animation_styles = et_pb_responsive_options()->get_property_values( $this->props, 'popup_animation_style' );
			if ( 'fade' !== $animation_style ) {
				$directions_list     = array( 'center', 'up', 'right', 'down', 'left' );
				$animation_direction = et_pb_responsive_options()->get_property_values( $this->props, 'popup_animation_direction' );
				// Desktop animation style.
				if ( ! empty( $animation_direction['desktop'] ) ) {
					$animation_style_desktop = in_array( $animation_direction['desktop'], $directions_list, true ) ? $animation_direction['desktop'] : '';
					if ( '' !== $animation_style_desktop ) {
						$animation_styles['desktop'] = $animation_style . '_' . $animation_style_desktop;
					}
				}

				if ( et_pb_responsive_options()->is_responsive_enabled( $this->props, 'popup_animation_direction' ) ) {
					// Tablet animation style.
					if ( ! empty( $animation_direction['tablet'] ) ) {
						$animation_style_tablet = in_array( $animation_direction['tablet'], $directions_list, true ) ? $animation_direction['tablet'] : '';
						if ( '' !== $animation_style_tablet ) {
							$animation_styles['tablet'] = $animation_style . '_' . $animation_style_tablet;
						}
					}
					// Phone animation style.
					if ( ! empty( $animation_direction['phone'] ) ) {
						$animation_style_phone = in_array( $animation_direction['phone'], $directions_list, true ) ? $animation_direction['phone'] : '';
						if ( '' !== $animation_style_phone ) {
							$animation_styles['phone'] = $animation_style . '_' . $animation_style_phone;
						}
					} elseif ( ! empty( $animation_styles['tablet'] ) ) {
						$animation_styles['phone'] = $animation_styles['tablet'];
					}
				}
			}

			$starting_opacities     = et_pb_responsive_options()->get_property_values( $this->props, 'popup_animation_starting_opacity' );
			$animation_durations    = et_pb_responsive_options()->get_property_values( $this->props, 'popup_animation_duration' );
			$animation_speed_curves = et_pb_responsive_options()->get_property_values( $this->props, 'popup_animation_speed_curve' );

			et_pb_responsive_options()->generate_responsive_css( $starting_opacities, '%%order_class%%_module .dmpro_animated', 'opacity', $render_slug, '', 'range' );
			et_pb_responsive_options()->generate_responsive_css( $animation_durations, '%%order_class%%_module .dmpro_animated', 'animation-duration', $render_slug, '', 'range' );
			et_pb_responsive_options()->generate_responsive_css( $animation_speed_curves, '%%order_class%%_module .dmpro_animated', 'animation-timing-function', $render_slug, '', 'type' );

			if ( in_array( $animation_style, array( 'slide', 'zoom', 'flip', 'fold', 'roll' ), true ) ) {
				$animation_intensities = et_pb_responsive_options()->get_property_values( $this->props, 'popup_animation_intensity' );
				if ( empty( $animation_intensities['tablet'] ) ) {
					$animation_intensities['tablet'] = $animation_intensities['desktop'];
				}
				if ( empty( $animation_intensities['phone'] ) ) {
					$animation_intensities['phone'] = $animation_intensities['tablet'];
				}
				$translate_values = array();
				foreach ( $animation_intensities as $device => $animation_intensity ) {
					if ( '' !== $animation_intensity ) {
						$animation_values = explode( '_', $animation_styles[ $device ] );
						if ( ! empty( array_filter( $animation_values ) ) ) {
							$anim_style       = isset( $animation_values[0] ) ? $animation_values[0] : 'fade';
							$anim_direction   = isset( $animation_values[1] ) ? $animation_values[1] : 'center';
							switch ( $anim_style ) {
								case 'slide':
									$translate_value = floatVal( $animation_intensity ) * 2 . '%';
									switch ( $anim_direction ) {
										case 'center':
											$translate_value             = floatval( ( 100 - floatVal( $animation_intensity ) ) / 100 );
											$translate_values[ $device ] = "scale3d( {$translate_value}, {$translate_value}, {$translate_value} )";
											break;

										case 'up':
											$translate_values[ $device ] = "translate3d( 0, {$translate_value}, 0 )";
											break;

										case 'down':
											$translate_values[ $device ] = "translate3d( 0, -{$translate_value}, 0 )";
											break;

										case 'left':
											$translate_values[ $device ] = "translate3d( {$translate_value}, 0, 0 )";
											break;

										case 'right':
											$translate_values[ $device ] = "translate3d( -{$translate_value}, 0, 0 )";
											break;

										default:
											break;
									}
									break;

								case 'flip':
									$translate_value = ceil( ( floatval( $animation_intensity ) * 90 ) / 100 ) . 'deg';
									switch ( $anim_direction ) {
										case 'center':
											$translate_values[ $device ] = "perspective(2000px)rotateX({$translate_value})";
											break;

										case 'up':
											$translate_values[ $device ] = "perspective(2000px)rotateX(-{$translate_value})";
											break;

										case 'down':
											$translate_values[ $device ] = "perspective(2000px)rotateX({$translate_value})";
											break;

										case 'left':
											$translate_values[ $device ] = "perspective(2000px)rotateY({$translate_value})";
											break;

										case 'right':
											$translate_values[ $device ] = "perspective(2000px)rotateY(-{$translate_value})";
											break;

										default:
											break;
									}
									break;

								case 'fold':
									$translate_value = ceil( ( floatval( $animation_intensity ) * 90 ) / 100 ) . 'deg';
									switch ( $anim_direction ) {
										case 'center':
											$translate_values[ $device ] = "perspective(2000px)rotateY({$translate_value})";
											break;

										case 'up':
											$translate_values[ $device ] = "perspective(2000px)rotateX({$translate_value})";
											break;

										case 'down':
											$translate_values[ $device ] = "perspective(2000px)rotateX(-{$translate_value})";
											break;

										case 'left':
											$translate_values[ $device ] = "perspective(2000px)rotateY(-{$translate_value})";
											break;

										case 'right':
											$translate_values[ $device ] = "perspective(2000px)rotateY({$translate_value})";
											break;

										default:
											break;
									}
									break;

								case 'roll':
									$translate_value = ceil( ( floatval( $animation_intensity ) * 360 ) / 100 ) . 'deg';
									switch ( $anim_direction ) {
										case 'center':
											$translate_values[ $device ] = "perspective(2000px)rotateZ({$translate_value})";
											break;

										case 'up':
											$translate_values[ $device ] = "perspective(2000px)rotateZ(-{$translate_value})";
											break;

										case 'down':
											$translate_values[ $device ] = "perspective(2000px)rotateZ({$translate_value})";
											break;

										case 'left':
											$translate_values[ $device ] = "perspective(2000px)rotateZ(-{$translate_value})";
											break;

										case 'right':
											$translate_values[ $device ] = "perspective(2000px)rotateZ({$translate_value})";
											break;

										default:
											break;
									}
									break;

								case 'zoom':
									$translate_value             = floatval( ( 100 - floatVal( $animation_intensity ) ) / 100 );
									$translate_values[ $device ] = "scale3d( {$translate_value}, {$translate_value}, {$translate_value} )";
									break;

								default:
									break;
							}
						}
					}
				}

				et_pb_responsive_options()->generate_responsive_css( $translate_values, '%%order_class%%_module .dmpro_animated', 'transform', $render_slug, '', 'type' );
			}

			$animation_names = preg_filter( '/^/', 'dmpro_animate_', array_filter( $animation_styles ) );
			et_pb_responsive_options()->generate_responsive_css( $animation_names, '%%order_class%%_module.dmpro_active_popup .dmpro_animated', 'animation-name', $render_slug, '', 'type' );
			et_pb_responsive_options()->generate_responsive_css( $animation_names, '%%order_class%%_module.dmpro_animate_reverse .dmpro_animated', 'animation-name', $render_slug, '', 'type' );
		}
	}

	public function process_advanced_margin_padding_css( $module, $function_name, $margin_padding ) {
		$utils           = ET_Core_Data_Utils::instance();
		$all_values      = $module->props;
		$advanced_fields = $module->advanced_fields;

		// Disable if module doesn't set advanced_fields property and has no VB support.
		if ( ! $module->has_vb_support() && ! $module->has_advanced_fields ) {
			return;
		}

		$allowed_advanced_fields = array( 'popup_margin_padding' );
		foreach ( $allowed_advanced_fields as $advanced_field ) {
			if ( ! empty( $advanced_fields[ $advanced_field ] ) ) {
				foreach ( $advanced_fields[ $advanced_field ] as $label => $form_field ) {
					$margin_key  = "{$label}_custom_margin";
					$padding_key = "{$label}_custom_padding";
					if ( '' !== $utils->array_get( $all_values, $margin_key, '' ) || '' !== $utils->array_get( $all_values, $padding_key, '' ) ) {
						$settings = $utils->array_get( $form_field, 'margin_padding', array() );
						// Ensure main selector exists.
						$form_field_margin_padding_css = $utils->array_get( $settings, 'css.main', '' );
						if ( empty( $form_field_margin_padding_css ) ) {
							$utils->array_set( $settings, 'css.main', $utils->array_get( $form_field, 'css.main', '' ) );
						}

						$margin_padding->update_styles( $module, $label, $settings, $function_name, $advanced_field );
					}
				}
			}
		}
	}

	
	public function multi_view_filter_value( $raw_value, $args, $multi_view ) {
		$name = isset( $args['name'] ) ? $args['name'] : '';
		$mode = isset( $args['mode'] ) ? $args['mode'] : '';

		if ( ( $raw_value && 'trigger_icon' === $name ) || ( $raw_value && 'popup_close_icon' === $name ) ) {
			$processed_value = html_entity_decode( et_pb_process_font_icon( $raw_value ) );
			if ( '%%1%%' === $raw_value ) {
				$processed_value = '"';
			}

			return $processed_value;
		}

		return $raw_value;
	}

	public function process_custom_background( $function_name, $options ) {

		$normal_fields = $options['normal'];

		foreach ( $normal_fields as $option_name => $element ) {

			$css_element           = $element;
			$css_element_processed = $element;

			if ( is_array( $element ) ) {
				$css_element_processed = implode( ', ', $element );
			}

			$processed_background_color = '';
			$processed_background_image = '';
			$processed_background_blend = '';
			$background_image_status = array(
				'desktop' => false,
				'tablet'  => false,
				'phone'   => false,
			);
			foreach ( et_pb_responsive_options()->get_modes() as $device ) {
				$background_base_name = $option_name;
				$background_prefix    = "{$option_name}_";
				$background_style     = '';
				$is_desktop           = 'desktop' === $device;
				$suffix               = ! $is_desktop ? "_{$device}" : '';

				$background_color_style = '';
				$background_image_style = '';
				$background_images      = array();

				$has_background_color_gradient         = false;
				$has_background_image                  = false;
				$has_background_gradient_and_image     = false;
				$is_background_color_gradient_disabled = false;
				$is_background_image_disabled          = false;

				$background_color_gradient_overlays_image = 'off';

				// Ensure responsive is active.
				if ( ! $is_desktop && ! et_pb_responsive_options()->is_responsive_enabled( $this->props, "{$option_name}_color" ) ) {
					continue;
				}

				// A. Background Gradient.
				$use_background_color_gradient = et_pb_responsive_options()->get_inheritance_background_value( $this->props, "{$background_prefix}use_color_gradient", $device, $background_base_name, $this->fields_unprocessed );

				if ( 'on' === $use_background_color_gradient ) {
					$background_color_gradient_overlays_image = et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}color_gradient_overlays_image{$suffix}", '', true );

					$gradient_properties = array(
						'type'             => et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}color_gradient_type{$suffix}", '', true ),
						'direction'        => et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}color_gradient_direction{$suffix}", '', true ),
						'radial_direction' => et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}color_gradient_direction_radial{$suffix}", '', true ),
						'color_start'      => et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}color_gradient_start{$suffix}", '', true ),
						'color_end'        => et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}color_gradient_end{$suffix}", '', true ),
						'start_position'   => et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}color_gradient_start_position{$suffix}", '', true ),
						'end_position'     => et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}color_gradient_end_position{$suffix}", '', true ),
					);

					$background_images[] = $this->get_gradient( $gradient_properties );

					$has_background_color_gradient = true;
				} elseif ( 'off' === $use_background_color_gradient ) {
					$is_background_color_gradient_disabled = true;
				}
				$background_image = et_pb_responsive_options()->get_inheritance_background_value( $this->props, "{$background_prefix}image", $device, $background_base_name, $this->fields_unprocessed );
				$parallax         = et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}parallax{$suffix}", 'off' );
				$is_background_image_active         = '' !== $background_image && 'on' !== $parallax;
				$background_image_status[ $device ] = $is_background_image_active;

				if ( $is_background_image_active ) {
					$has_background_image = true;
					$is_prev_background_image_active = true;
					if ( ! $is_desktop ) {
						$is_prev_background_image_active = 'tablet' === $device ? $background_image_status['desktop'] : $background_image_status['tablet'];
					}
					$background_size_default = ET_Builder_Element::$_->array_get( $this->fields_unprocessed, "{$background_prefix}size.default", '' );
					$background_size         = et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}size{$suffix}", $background_size_default, ! $is_prev_background_image_active );

					if ( '' !== $background_size ) {
						$background_style .= sprintf(
							'background-size: %1$s; ',
							esc_html( $background_size )
						);
					}
					$background_position_default = ET_Builder_Element::$_->array_get( $this->fields_unprocessed, "{$background_prefix}position.default", '' );
					$background_position         = et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}position{$suffix}", $background_position_default, ! $is_prev_background_image_active );

					if ( '' !== $background_position ) {
						$background_style .= sprintf(
							'background-position: %1$s; ',
							esc_html( str_replace( '_', ' ', $background_position ) )
						);
					}
					$background_repeat_default = ET_Builder_Element::$_->array_get( $this->fields_unprocessed, "{$background_prefix}repeat.default", '' );
					$background_repeat         = et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}repeat{$suffix}", $background_repeat_default, ! $is_prev_background_image_active );

					if ( '' !== $background_repeat ) {
						$background_style .= sprintf(
							'background-repeat: %1$s; ',
							esc_html( $background_repeat )
						);
					}
					$background_blend_default = ET_Builder_Element::$_->array_get( $this->fields_unprocessed, "{$background_prefix}blend.default", '' );
					$background_blend         = et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}blend{$suffix}", $background_blend_default, ! $is_prev_background_image_active );
					$background_blend_inherit = et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}blend{$suffix}", '', true );

					if ( '' !== $background_blend_inherit ) {
						if ( '' !== $background_blend ) {
							$background_style .= sprintf(
								'background-blend-mode: %1$s; ',
								esc_html( $background_blend )
							);
						}
						if ( $has_background_color_gradient && $has_background_image && $background_blend_inherit !== $background_blend_default ) {
							$has_background_gradient_and_image = true;
							$background_color_style            = 'initial';
							$background_style                 .= 'background-color: initial; ';
						}

						$processed_background_blend = $background_blend;
					}
					$background_images[] = sprintf( 'url(%1$s)', esc_html( $background_image ) );
				} elseif ( '' === $background_image ) {
					if ( '' !== $processed_background_blend ) {
						$background_style          .= 'background-blend-mode: normal; ';
						$processed_background_blend = '';
					}

					$is_background_image_disabled = true;
				}

				if ( ! empty( $background_images ) ) {
					if ( 'on' !== $background_color_gradient_overlays_image ) {
						$background_images = array_reverse( $background_images );
					}
					$background_image_style = join( ', ', $background_images );
					if ( $processed_background_image !== $background_image_style ) {
						$background_style .= sprintf(
							'background-image: %1$s !important;',
							esc_html( $background_image_style )
						);
					}
				} elseif ( ! $is_desktop && $is_background_color_gradient_disabled && $is_background_image_disabled ) {
					$background_image_style = 'initial';
					$background_style      .= 'background-image: initial !important;';
				}
				$processed_background_image = $background_image_style;
				if ( ! $has_background_gradient_and_image ) {
			
					$background_color_enable  = ET_Builder_Element::$_->array_get( $this->props, "{$background_prefix}enable_color{$suffix}", '' );
					$background_color_initial = 'off' === $background_color_enable && ! $is_desktop ? 'initial' : '';

					$background_color       = et_pb_responsive_options()->get_inheritance_background_value( $this->props, "{$background_prefix}color", $device, $background_base_name, $this->fields_unprocessed );
					$background_color       = '' !== $background_color ? $background_color : $background_color_initial;
					$background_color_style = $background_color;

					if ( '' !== $background_color && $processed_background_color !== $background_color ) {
						$background_style .= sprintf(
							'background-color: %1$s; ',
							esc_html( $background_color )
						);
					}
				}

				$processed_background_color = $background_color_style;
				if ( '' !== $background_style ) {
					$background_style_attrs = array(
						'selector'    => $css_element_processed,
						'declaration' => rtrim( $background_style ),
						'priority'    => $this->_style_priority,
					);
					if ( 'desktop' !== $device ) {
						$current_media_query                   = 'tablet' === $device ? 'max_width_980' : 'max_width_767';
						$background_style_attrs['media_query'] = ET_Builder_Element::get_media_query( $current_media_query );
					}

					ET_Builder_Element::set_style( $function_name, $background_style_attrs );
				}
			}
		}

		if ( isset( $options['hover'] ) ) {
			$hover_fields = $options['hover'];
		} else {
			$hover_fields = $options['normal'];
			foreach ( $hover_fields as &$value ) {
				$value = $value . ':hover';
			}
		}

		foreach ( $hover_fields as $option_name => $element ) {

			$css_element           = $element;
			$css_element_processed = $element;

			if ( is_array( $element ) ) {
				$css_element_processed = implode( ', ', $element );
			}

			// Background Hover.
			if ( et_builder_is_hover_enabled( "{$option_name}_color", $this->props ) ) {

				$background_base_name    = $option_name;
				$background_prefix       = "{$option_name}_";
				$background_images_hover = array();
				$background_hover_style  = '';

				$has_background_color_gradient_hover         = false;
				$has_background_image_hover                  = false;
				$has_background_gradient_and_image_hover     = false;
				$is_background_color_gradient_hover_disabled = false;
				$is_background_image_hover_disabled          = false;

				$background_color_gradient_overlays_image_desktop = et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}color_gradient_overlays_image", 'off', true );

				$gradient_properties_desktop = array(
					'type'             => et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}color_gradient_type", '', true ),
					'direction'        => et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}color_gradient_direction", '', true ),
					'radial_direction' => et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}color_gradient_direction_radial", '', true ),
					'color_start'      => et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}color_gradient_start", '', true ),
					'color_end'        => et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}color_gradient_end", '', true ),
					'start_position'   => et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}color_gradient_start_position", '', true ),
					'end_position'     => et_pb_responsive_options()->get_any_value( $this->props, "{$background_prefix}color_gradient_end_position", '', true ),
				);

				$background_color_gradient_overlays_image_hover = 'off';

				$use_background_color_gradient_hover = et_pb_responsive_options()->get_inheritance_background_value( $this->props, "{$background_prefix}use_color_gradient", 'hover', $background_base_name, $this->fields_unprocessed );

				if ( 'on' === $use_background_color_gradient_hover ) {
					// Desktop value as default.
					$background_color_gradient_type_desktop             = ET_Builder_Element::$_->array_get( $gradient_properties_desktop, 'type', '' );
					$background_color_gradient_direction_desktop        = ET_Builder_Element::$_->array_get( $gradient_properties_desktop, 'direction', '' );
					$background_color_gradient_radial_direction_desktop = ET_Builder_Element::$_->array_get( $gradient_properties_desktop, 'radial_direction', '' );
					$background_color_gradient_color_start_desktop      = ET_Builder_Element::$_->array_get( $gradient_properties_desktop, 'color_start', '' );
					$background_color_gradient_color_end_desktop        = ET_Builder_Element::$_->array_get( $gradient_properties_desktop, 'color_end', '' );
					$background_color_gradient_start_position_desktop   = ET_Builder_Element::$_->array_get( $gradient_properties_desktop, 'start_position', '' );
					$background_color_gradient_end_position_desktop     = ET_Builder_Element::$_->array_get( $gradient_properties_desktop, 'end_position', '' );

					// Hover value.
					$background_color_gradient_type_hover             = et_pb_hover_options()->get_raw_value( "{$background_prefix}color_gradient_type", $this->props, $background_color_gradient_type_desktop );
					$background_color_gradient_direction_hover        = et_pb_hover_options()->get_raw_value( "{$background_prefix}color_gradient_direction", $this->props, $background_color_gradient_direction_desktop );
					$background_color_gradient_direction_radial_hover = et_pb_hover_options()->get_raw_value( "{$background_prefix}color_gradient_direction_radial", $this->props, $background_color_gradient_radial_direction_desktop );
					$background_color_gradient_start_hover            = et_pb_hover_options()->get_raw_value( "{$background_prefix}color_gradient_start", $this->props, $background_color_gradient_color_start_desktop );
					$background_color_gradient_end_hover              = et_pb_hover_options()->get_raw_value( "{$background_prefix}color_gradient_end", $this->props, $background_color_gradient_color_end_desktop );
					$background_color_gradient_start_position_hover   = et_pb_hover_options()->get_raw_value( "{$background_prefix}color_gradient_start_position", $this->props, $background_color_gradient_start_position_desktop );
					$background_color_gradient_end_position_hover     = et_pb_hover_options()->get_raw_value( "{$background_prefix}color_gradient_end_position", $this->props, $background_color_gradient_end_position_desktop );
					$background_color_gradient_overlays_image_hover   = et_pb_hover_options()->get_raw_value( "{$background_prefix}color_gradient_overlays_image", $this->props, $background_color_gradient_overlays_image_desktop );

					$has_background_color_gradient_hover = true;

					$gradient_values_hover = array(
						'type'             => '' !== $background_color_gradient_type_hover ? $background_color_gradient_type_hover : $background_color_gradient_type_desktop,
						'direction'        => '' !== $background_color_gradient_direction_hover ? $background_color_gradient_direction_hover : $background_color_gradient_direction_desktop,
						'radial_direction' => '' !== $background_color_gradient_direction_radial_hover ? $background_color_gradient_direction_radial_hover : $background_color_gradient_radial_direction_desktop,
						'color_start'      => '' !== $background_color_gradient_start_hover ? $background_color_gradient_start_hover : $background_color_gradient_color_start_desktop,
						'color_end'        => '' !== $background_color_gradient_end_hover ? $background_color_gradient_end_hover : $background_color_gradient_color_end_desktop,
						'start_position'   => '' !== $background_color_gradient_start_position_hover ? $background_color_gradient_start_position_hover : $background_color_gradient_start_position_desktop,
						'end_position'     => '' !== $background_color_gradient_end_position_hover ? $background_color_gradient_end_position_hover : $background_color_gradient_end_position_desktop,
					);

					$background_images_hover[] = $this->get_gradient( $gradient_values_hover );
				} elseif ( 'off' === $use_background_color_gradient_hover ) {
					$is_background_color_gradient_hover_disabled = true;
				}

				$background_image_hover = et_pb_responsive_options()->get_inheritance_background_value( $this->props, "{$background_prefix}image", 'hover', $background_base_name, $this->fields_unprocessed );
				$parallax_hover         = et_pb_hover_options()->get_raw_value( "{$background_prefix}parallax", $this->props );

				if ( '' !== $background_image_hover && null !== $background_image_hover && 'on' !== $parallax_hover ) {
					$has_background_image_hover = true;
					$background_size_hover   = et_pb_hover_options()->get_raw_value( "{$background_prefix}size", $this->props );
					$background_size_desktop = ET_Builder_Element::$_->array_get( $this->props, "{$background_prefix}size", '' );
					$is_same_background_size = $background_size_hover === $background_size_desktop;
					if ( empty( $background_size_hover ) && ! empty( $background_size_desktop ) ) {
						$background_size_hover = $background_size_desktop;
					}

					if ( ! empty( $background_size_hover ) && ! $is_same_background_size ) {
						$background_hover_style .= sprintf(
							'background-size: %1$s; ',
							esc_html( $background_size_hover )
						);
					}
					$background_position_hover   = et_pb_hover_options()->get_raw_value( "{$background_prefix}position", $this->props );
					$background_position_desktop = ET_Builder_Element::$_->array_get( $this->props, "{$background_prefix}position", '' );
					$is_same_background_position = $background_position_hover === $background_position_desktop;
					if ( empty( $background_position_hover ) && ! empty( $background_position_desktop ) ) {
						$background_position_hover = $background_position_desktop;
					}
					if ( ! empty( $background_position_hover ) && ! $is_same_background_position ) {
						$background_hover_style .= sprintf(
							'background-position: %1$s; ',
							esc_html( str_replace( '_', ' ', $background_position_hover ) )
						);
					}

					$background_repeat_hover   = et_pb_hover_options()->get_raw_value( "{$background_prefix}repeat", $this->props );
					$background_repeat_desktop = ET_Builder_Element::$_->array_get( $this->props, "{$background_prefix}repeat", '' );
					$is_same_background_repeat = $background_repeat_hover === $background_repeat_desktop;
					if ( empty( $background_repeat_hover ) && ! empty( $background_repeat_desktop ) ) {
						$background_repeat_hover = $background_repeat_desktop;
					}

					if ( ! empty( $background_repeat_hover ) && ! $is_same_background_repeat ) {
						$background_hover_style .= sprintf(
							'background-repeat: %1$s; ',
							esc_html( $background_repeat_hover )
						);
					}
					$background_blend_hover   = et_pb_hover_options()->get_raw_value( "{$background_prefix}blend", $this->props );
					$background_blend_default = ET_Builder_Element::$_->array_get( $this->fields_unprocessed, "{$background_prefix}blend.default", '' );
					$background_blend_desktop = ET_Builder_Element::$_->array_get( $this->props, "{$background_prefix}blend", '' );
					$is_same_background_blend = $background_blend_hover === $background_blend_desktop;
					if ( empty( $background_blend_hover ) && ! empty( $background_blend_desktop ) ) {
						$background_blend_hover = $background_blend_desktop;
					}

					if ( ! empty( $background_blend_hover ) ) {
						if ( ! $is_same_background_blend ) {
							$background_hover_style .= sprintf(
								'background-blend-mode: %1$s; ',
								esc_html( $background_blend_hover )
							);
						}
						if ( $has_background_color_gradient_hover && $has_background_image_hover && $background_blend_hover !== $background_blend_default ) {
							$has_background_gradient_and_image_hover = true;
							$background_hover_style                 .= 'background-color: initial !important;';
						}
					}

					$background_images_hover[] = sprintf( 'url(%1$s)', esc_html( $background_image_hover ) );
				} elseif ( '' === $background_image_hover ) {
					$is_background_image_hover_disabled = true;
				}

				if ( ! empty( $background_images_hover ) ) {
					if ( 'on' !== $background_color_gradient_overlays_image_hover ) {
						$background_images_hover = array_reverse( $background_images_hover );
					}

					$background_hover_style .= sprintf(
						'background-image: %1$s !important;',
						esc_html( join( ', ', $background_images_hover ) )
					);
				} elseif ( $is_background_color_gradient_hover_disabled && $is_background_image_hover_disabled ) {
					$background_hover_style .= 'background-image: initial !important;';
				}
				if ( ! $has_background_gradient_and_image_hover ) {
					$background_color_hover = et_pb_responsive_options()->get_inheritance_background_value( $this->props, "{$background_prefix}color", 'hover', $background_base_name, $this->fields_unprocessed );
					$background_color_hover = '' !== $background_color_hover ? $background_color_hover : 'transparent';

					if ( '' !== $background_color_hover ) {
						$background_hover_style .= sprintf(
							'background-color: %1$s !important; ',
							esc_html( $background_color_hover )
						);
					}
				}
				if ( '' !== $background_hover_style ) {
					$background_hover_style_attrs = array(
						'selector'    => $css_element_processed,
						'declaration' => rtrim( $background_hover_style ),
						'priority'    => $this->_style_priority,
					);

					ET_Builder_Element::set_style( $function_name, $background_hover_style_attrs );
				}
			}
		}
	}

}
function dmpro_remove_shortcode( $text = '' ) {
		if ( trim($text) === '') {
			return '';
		}
		$clean_shortcodes = ['dmpro_modal','el_modal_popup'];
		foreach ( $clean_shortcodes as $single_shortcode ) {
			$format = sprintf('(\[%1$s[^\]]*\][^\[]*\[\/%1$s\]|\[%1$s[^\]]*\])', esc_html( $single_shortcode ) );
			$text = preg_replace( $format, '', $text );
		}

		return et_core_intentionally_unescaped( $text, 'html' );
	}
new DMPRO_PopUp;