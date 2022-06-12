<?php

class DMPRO_CountDownTimer extends ET_Builder_Module {
	
	public $module_url = DMPRO_MODULES_URL . 'CountDownTimer' . '/';
    
    protected $module_credits = array(
        'module_uri' => DMPRO_MODULE . 'countdown-timer',
        'author' => DMPRO_AUTHOR,
        'author_uri' => DMPRO_WEB,
    );
    public function init() {
        $this->slug = 'dmpro_countdown';
        $this->icon_path = plugin_dir_path( __FILE__ ) . "Countdown.svg";
        $this->vb_support = 'on';
        $this->name = esc_html__(DMPRO_PREFIX . 'Countdown Timer', DMPRO_TEXTDOMAIN);
        $this->settings_modal_toggles = [
            'general' => [
                'toggles' => [
                    'date' => esc_html__('Countdown Date/Time', DMPRO_TEXTDOMAIN),
                    'style' => esc_html__('Countdown Timer Style', DMPRO_TEXTDOMAIN),
                    'text' => esc_html__('Text', DMPRO_TEXTDOMAIN),
                    'events' => esc_html__('Timer Ending Event', DMPRO_TEXTDOMAIN),
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'clock_text' => [
                        'title' => esc_html__('Countdown Text Styling', DMPRO_TEXTDOMAIN),
                        'tabbed_subtoggles' => true,
                        'sub_toggles' => [
                            'clock' => ['name' => esc_html__('Clock', DMPRO_TEXTDOMAIN)],
                            'labels' => ['name' => esc_html__('Labels', DMPRO_TEXTDOMAIN)],
                        ],
                    ],
                    'clock_face' => esc_html__('Clock Design', DMPRO_TEXTDOMAIN),
                ],
            ],
        ];
    }
    
    public function get_fields() {
        $module_fields = [];

        $module_fields['date_type'] = [
            'label' => esc_html__('Date/Time Selection Method', DMPRO_TEXTDOMAIN),
            'description' => esc_html__('Choose your desired method of selecting the date/time for the countdown timer. Choose <b>Date Picker</b> to simply choose a static Date/Time. Or choose <b>Manual Text</b> for manual date/time selection & to pull from custom fields. Lastly, you can choose the <b>Evergreen</b> to always countdown the same amount of time regardless of when the user lands on the page.', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'option_category' => 'basic_option',
            'toggle_slug' => 'date',
            'tab_slug' => 'general',
            'default' => 'picker',
            'options' => [
                'picker' => esc_html__('Date Picker', DMPRO_TEXTDOMAIN),
                'text' => esc_html__('Manual Text', DMPRO_TEXTDOMAIN),
                'current_time' => esc_html__('Evergreen', DMPRO_TEXTDOMAIN),
            ],
        ];

        $module_fields['date_time_picker'] = [
            'label' => esc_html__('Date/Time', DMPRO_TEXTDOMAIN),
            'type' => 'date_picker',
            'option_category' => 'basic_option',
            'toggle_slug' => 'date',
            'tab_slug' => 'general',
            'show_if' => ['date_type' => 'picker'],
        ];

        $module_fields['date_time_text'] = [
            'label' => esc_html__('Date/Time', DMPRO_TEXTDOMAIN),
            'description' =>  esc_html__('Enter the date/time in the following format: "yyyy-MM-dd HH:mm:ss". This data can also be pulled dymcially from custom fields.= by clicking the "Use Dynamic Content" icon within the field.', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'dynamic_content' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'date',
            'tab_slug' => 'general',
            'show_if' => ['date_type' => 'text'],
        ];

        $module_fields['date_time_offset'] = [
            'label' => esc_html__('Amount of Time on Countdown (in seconds)', DMPRO_TEXTDOMAIN),
            'description' =>  esc_html__('The Evergreen countdown method will always count down the same amount of time. Provide the countdown time in seconds below. (ex: 10 minutes = 600 seconds). Enable the Cookie Feature to continue the same countdown after the user leaves the page and returns.', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'dynamic_content' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'date',
            'tab_slug' => 'general',
            'show_if' => ['date_type' => 'current_time'],
        ];

        $module_fields['use_cookie'] = [
            'label' => esc_html__('Continue After Refresh (Cookie Feature)', DMPRO_TEXTDOMAIN),
            'description' => esc_html__('Enable if you want the countdown timer to continue (instead of starting over) even after the user refreshes the page or leaves and returns.', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'basic_option',
            'toggle_slug' => 'date',
            'tab_slug' => 'general',
            'default' => 'off',
            'options' => array(
                'off' => esc_html__('Off', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('On', DMPRO_TEXTDOMAIN),
            ),
            'show_if' => ['date_type' => 'current_time'],
        ];

        $module_fields['cookie_id'] = [
            'label' => esc_html__('Cookie ID', DMPRO_TEXTDOMAIN),
            'description' =>  esc_html__('Enter an ID for your countdown module that is used for the browser cookie when the "Continue After Refresh (Cookie Feature)" is enabled. In most cases, this ID should be unique to only this specific countdown timer. However, if you want multiple countdown timers on the same website to have the same cookie (and same countdown too), then you may use the same ID across multiple countdown timers to keep the countdown timers in sync.', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'default' => 'dmpro_countdown',
            'option_category' => 'basic_option',
            'toggle_slug' => 'date',
            'tab_slug' => 'general',
            'show_if' => [
                'date_type' => 'current_time',
                'use_cookie' => 'on',
            ],
        ];
        

        $module_fields['finish_countdown'] = [
            'label' => esc_html__('When Timer Ends...', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'option_category' => 'basic_option',
            'toggle_slug' => 'events',
            'tab_slug' => 'general',
            'default' => 'continue',
            'options' => [
                'continue' => esc_html__('Continue the Clock (count up)', DMPRO_TEXTDOMAIN),
                'stop' => esc_html__('Stop the Clock', DMPRO_TEXTDOMAIN),
                'forward' => esc_html__('Forward to a URL', DMPRO_TEXTDOMAIN),
                'script' => esc_html__('Stop the clock and execute Javascript', DMPRO_TEXTDOMAIN),
                'html' => esc_html__('Stop the clock and replace with HTML', DMPRO_TEXTDOMAIN),
            ],
        ];

        $module_fields['forwarding_url'] = [
            'label' => esc_html__('URL', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'events',
            'tab_slug' => 'general',
            'show_if' => ['finish_countdown' => 'forward'],
        ];

        $module_fields['script'] = [
            'label' => esc_html__('Script', DMPRO_TEXTDOMAIN),
            'type' => 'textarea',
            'option_category' => 'basic_option',
            'toggle_slug' => 'events',
            'tab_slug' => 'general',
            'show_if' => ['finish_countdown' => 'script'],
        ];

        $module_fields['html'] = [
            'label' => esc_html__('HTML', DMPRO_TEXTDOMAIN),
            'type' => 'textarea',
            'option_category' => 'basic_option',
            'toggle_slug' => 'events',
            'tab_slug' => 'general',
            'show_if' => ['finish_countdown' => 'html'],
        ];

        $module_fields['style'] = [
            'label' => esc_html__('Countdown Timer Style', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'option_category' => 'layout',
            'toggle_slug' => 'style',
            'tab_slug' => 'general',
            'default' => 'flip_clock',
            'options' => [
                'flip_clock' => esc_html__('Flip Clock', DMPRO_TEXTDOMAIN),
                'block_clock' => esc_html__('Block Clock', DMPRO_TEXTDOMAIN),
                'custom_format' => esc_html__('Custom Format', DMPRO_TEXTDOMAIN),
            ],
        ];

        $default_custom_format = sprintf(
            '%%w %%!w:%1$s,%2$s; %%d %%!d:%3$s,%4$s; %%H %%!H:%5$s,%6$s; %%M %%!M:%7$s,%8$s; %%S %%!S:%9$s,%10$s;',
            esc_html__('Week', DMPRO_TEXTDOMAIN),
            esc_html__('Weeks', DMPRO_TEXTDOMAIN),
            esc_html__('Day', DMPRO_TEXTDOMAIN),
            esc_html__('Days', DMPRO_TEXTDOMAIN),
            esc_html__('Hour', DMPRO_TEXTDOMAIN),
            esc_html__('Hours', DMPRO_TEXTDOMAIN),
            esc_html__('Minute', DMPRO_TEXTDOMAIN),
            esc_html__('Minutes', DMPRO_TEXTDOMAIN),
            esc_html__('Second', DMPRO_TEXTDOMAIN),
            esc_html__('Seconds', DMPRO_TEXTDOMAIN)
        );

        $module_fields['custom_format'] = [
            'label' => esc_html__('Custom Format', DMPRO_TEXTDOMAIN),
            'description' => sprintf(
                'A detailed description of how to use the format can be found %1$s. You can also use HTML inside the format.',
                sprintf('<a href="http://hilios.github.io/jQuery.countdown/documentation.html#formatter">%1$s</a>', esc_html__('here', DMPRO_TEXTDOMAIN))
            ),
            'type' => 'textarea',
            'option_category' => 'basic_option',
            'toggle_slug' => 'style',
            'tab_slug' => 'general',
            'show_if' => ['style' => 'custom_format'],
            'default' => $default_custom_format,
        ];

        $module_fields['label_weeks'] = [
            'label' => esc_html__('Label Weeks', DMPRO_TEXTDOMAIN),
            'description' => esc_html__('Enter a label to be used for weeks. You can use pluralization by comma separating the singular and the plural, e. g. "Week,Weeks"', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'option_category' => 'basic_option',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_text',
            'sub_toggle' => 'labels',
            'default' => esc_html__('Week,Weeks', DMPRO_TEXTDOMAIN),
        ];

        $module_fields['label_days'] = [
            'label' => esc_html__('Label Days', DMPRO_TEXTDOMAIN),
            'description' => esc_html__('Enter a label to be used for days. You can use pluralization by comma separating the singular and the plural, e. g. "Day,Days"', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'option_category' => 'basic_option',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_text',
            'sub_toggle' => 'labels',
            'default' => esc_html__('Day,Days', DMPRO_TEXTDOMAIN),
        ];

        $module_fields['label_hours'] = [
            'label' => esc_html__('Label Hours', DMPRO_TEXTDOMAIN),
            'description' => esc_html__('Enter a label to be used for hours. You can use pluralization by comma separating the singular and the plural, e. g. "Hour,Hours"', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'option_category' => 'basic_option',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_text',
            'sub_toggle' => 'labels',
            'default' => esc_html__('Hour,Hours', DMPRO_TEXTDOMAIN),
        ];

        $module_fields['label_minutes'] = [
            'label' => esc_html__('Label Minutes', DMPRO_TEXTDOMAIN),
            'description' => esc_html__('Enter a label to be used for minutes. You can use pluralization by comma separating the singular and the plural, e. g. "Minute,Minutes"', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'option_category' => 'basic_option',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_text',
            'sub_toggle' => 'labels',
            'default' => esc_html__('Min,Mins', DMPRO_TEXTDOMAIN),
        ];

        $module_fields['label_seconds'] = [
            'label' => esc_html__('Label Seconds', DMPRO_TEXTDOMAIN),
            'description' => esc_html__('Enter a label to be used for seconds. You can use pluralization by comma separating the singular and the plural, e. g. "Second,Seconds"', DMPRO_TEXTDOMAIN),
            'type' => 'text',
            'option_category' => 'basic_option',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_text',
            'sub_toggle' => 'labels',
            'default' => esc_html__('Sec,Secs', DMPRO_TEXTDOMAIN),
        ];

        $module_fields['clock_label_position'] = [
            'label' => esc_html__('Labels Position', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'option_category' => 'layout',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'default' => 'below',
            'options' => [
                'above' => esc_html__('Above', DMPRO_TEXTDOMAIN),
                'below' => esc_html__('Below', DMPRO_TEXTDOMAIN),
            ],
            'show_if' => [
                'style' => ['flip_clock', 'block_clock'],
            ],
        ];

        $module_fields['show_weeks'] = [
            'label' => esc_html__('Show Weeks', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'basic_option',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'default' => 'on',
            'options' => array(
                'off' => esc_html__('Off', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('On', DMPRO_TEXTDOMAIN),
            ),
            'show_if' => [
                'style' => ['flip_clock', 'block_clock'],
            ],
        ];

        $module_fields['show_days'] = [
            'label' => esc_html__('Show Days', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'basic_option',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'default' => 'on',
            'options' => array(
                'off' => esc_html__('Off', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('On', DMPRO_TEXTDOMAIN),
            ),
            'show_if' => [
                'style' => ['flip_clock', 'block_clock'],
                'show_weeks' => 'off',
            ],
        ];

        $module_fields['show_hours'] = [
            'label' => esc_html__('Show Hours', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'basic_option',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'default' => 'on',
            'options' => array(
                'off' => esc_html__('Off', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('On', DMPRO_TEXTDOMAIN),
            ),
            'show_if' => [
                'style' => ['flip_clock', 'block_clock'],
                'show_weeks' => 'off',
                'show_days' => 'off',
            ],
        ];

        $module_fields['show_minutes'] = [
            'label' => esc_html__('Show Minutes', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'basic_option',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'default' => 'on',
            'options' => array(
                'off' => esc_html__('Off', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('On', DMPRO_TEXTDOMAIN),
            ),
            'show_if' => [
                'style' => ['flip_clock', 'block_clock'],
                'show_weeks' => 'off',
                'show_days' => 'off',
                'show_hours' => 'off',
            ],
        ];

        $module_fields['show_seconds'] = [
            'label' => esc_html__('Show Seconds', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'basic_option',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'default' => 'on',
            'options' => array(
                'off' => esc_html__('Off', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('On', DMPRO_TEXTDOMAIN),
            ),
            'show_if' => [
                'style' => ['flip_clock', 'block_clock'],
                'show_minutes' => 'on',
            ],
        ];

        $module_fields['clock_background'] = [
            'label' => esc_html__('Face Color', DMPRO_TEXTDOMAIN),
            'type' => 'color-alpha',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'default' => '#202020',
            'show_if' => [
                'style' => ['flip_clock', 'block_clock'],
            ],
        ];

        $module_fields['flip_clock_top_border'] = [
            'label' => esc_html__('Top Face Top Border Color', DMPRO_TEXTDOMAIN),
            'type' => 'color-alpha',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'default' => 'rgba(255, 255, 255, 0.2)',
            'show_if' => [
                'style' => ['flip_clock'],
            ],
        ];

        $module_fields['flip_clock_separator_top_border'] = [
            'label' => esc_html__('Top Face Bottom Border Color', DMPRO_TEXTDOMAIN),
            'type' => 'color-alpha',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'default' => 'rgba(255, 255, 255, 0.1)',
            'show_if' => [
                'style' => ['flip_clock'],
            ],
        ];

        $module_fields['flip_clock_separator_bottom_border'] = [
            'label' => esc_html__('Bottom Face Top Border Color', DMPRO_TEXTDOMAIN),
            'type' => 'color-alpha',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'default' => '#000000',
            'show_if' => [
                'style' => ['flip_clock'],
            ],
        ];

        $module_fields['flip_clock_bottom_border'] = [
            'label' => esc_html__('Bottom Face Bottom Border Color', DMPRO_TEXTDOMAIN),
            'type' => 'color-alpha',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'default' => '#000000',
            'show_if' => [
                'style' => ['flip_clock'],
            ],
        ];

        $module_fields['clock_face_width'] = [
            'label' => esc_html__('Face Width', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'mobile_options' => true,
            'default' => '',
            'validate_unit' => true,
            'default_unit' => 'px',
            'range_settings' => array(
                'min' => '0',
                'max' => '200',
                'step' => '1',
            ),
            'show_if' => [
                'style' => ['flip_clock'],
            ],
        ];

        $module_fields['clock_face_height'] = [
            'label' => esc_html__('Face Height', DMPRO_TEXTDOMAIN),
            'type' => 'range',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'mobile_options' => true,
            'default' => '',
            'validate_unit' => true,
            'default_unit' => 'px',
            'range_settings' => array(
                'min' => '0',
                'max' => '200',
                'step' => '1',
            ),
            'show_if' => [
                'style' => ['flip_clock'],
            ],
        ];

        

        $module_fields['clock_face_margin'] = [
            'label' => esc_html__('Face Margin', DMPRO_TEXTDOMAIN),
            'type' => 'custom_margin',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'mobile_options' => true,
            'show_if' => [
                'style' => ['flip_clock', 'block_clock'],
            ],
        ];

        $module_fields['clock_face_padding'] = [
            'label' => esc_html__('Face Padding', DMPRO_TEXTDOMAIN),
            'type' => 'custom_margin',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'mobile_options' => true,
            'show_if' => [
                'style' => ['block_clock'],
            ],
        ];

        $module_fields['block_clock_equalize_width'] = [
            'label' => esc_html__('Equalized Face Width', DMPRO_TEXTDOMAIN),
            'type' => 'yes_no_button',
            'option_category' => 'basic_option',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'default' => 'on',
            'options' => array(
                'off' => esc_html__('Off', DMPRO_TEXTDOMAIN),
                'on' => esc_html__('On', DMPRO_TEXTDOMAIN),
            ),
            'show_if' => [
                'style' => ['block_clock'],
            ],
        ];

        $module_fields['block_clock_face_alignment'] = [
            'label' => esc_html__('Block Alignment', DMPRO_TEXTDOMAIN),
            'description' => esc_html__('Choose how you want to align the face blocks in their wrapper.', DMPRO_TEXTDOMAIN),
            'type' => 'select',
            'option_category' => 'basic_option',
            'tab_slug' => 'advanced',
            'toggle_slug' => 'clock_face',
            'default' => 'center',
            'options' => [
                'center' => esc_html__('Center', DMPRO_TEXTDOMAIN),
                'flex-start' => esc_html__('Start', DMPRO_TEXTDOMAIN),
                'flex-end' => esc_html__('End', DMPRO_TEXTDOMAIN),
                'space-between' => esc_html__('Space Between', DMPRO_TEXTDOMAIN),
                'space-around' => esc_html__('Space Around', DMPRO_TEXTDOMAIN),
                'space-evenly' => esc_html__('Space Evenly', DMPRO_TEXTDOMAIN),
            ],
            'show_if' => [
                'style' => ['block_clock'],
            ],
        ];

        return $module_fields;
    }
    
    public function get_advanced_fields_config() {
        $advanced_fields = [];

        $advanced_fields["text"] = false;
        $advanced_fields["text_shadow"] = false;

        $advanced_fields['fonts']['clock'] = [
            'label' => esc_html__('Clock Face', DMPRO_TEXTDOMAIN),
            'toggle_slug' => 'clock_text',
            'sub_toggle' => 'clock',
            'css' => [
                'main' => '%%order_class%% .flip_clock div.time span.count, %%order_class%% .block_clock div.time',
            ],
        ];

        $advanced_fields['fonts']['labels'] = [
            'label' => esc_html__('Labels', DMPRO_TEXTDOMAIN),
            'toggle_slug' => 'clock_text',
            'sub_toggle' => 'labels',
            'css' => [
                'main' => '%%order_class%% .flip_clock div.label, %%order_class%% .block_clock div.label',
            ],
        ];

        return $advanced_fields;
    }

    public function get_custom_css_fields_config() {
        $custom_css_fields = [];
        
        $custom_css_fields['dmpro_countdown_flip_clock_count'] = [
            'label' => 'Flip Clock Count',
            'selector' => '%%order_class%% .flip_clock .count',
        ];
        $custom_css_fields['dmpro_countdown_flip_clock_curr_top'] = [
            'label' => 'Flip Clock Current Top',
            'selector' => '%%order_class%% .flip_clock .count.curr.top',
        ];
        $custom_css_fields['dmpro_countdown_flip_clock_next_top'] = [
            'label' => 'Flip Clock Next Top',
            'selector' => '%%order_class%% .flip_clock .count.next.top',
        ];
        $custom_css_fields['dmpro_countdown_flip_clock_curr_bot'] = [
            'label' => 'Flip Clock Current Bottom',
            'selector' => '%%order_class%% .flip_clock .count.curr.bottom',
        ];
        $custom_css_fields['dmpro_countdown_flip_clock_next_bot'] = [
            'label' => 'Flip Clock Next Bottom',
            'selector' => '%%order_class%% .flip_clock .count.next.bottom',
        ];

        $custom_css_fields['dmpro_countdown_flip_clock_label'] = [
            'label' => 'Flip/Block Clock Label',
            'selector' => '%%order_class%% .flip_clock .label, %%order_class%% .block_clock .label',
        ];

        $custom_css_fields['dmpro_countdown_flip_clock_time'] = [
            'label' => 'Flip/Block Clock Time',
            'selector' => '%%order_class%% .flip_clock .time,%%order_class%% .block_clock .time',
        ];
        $custom_css_fields['dmpro_countdown_flip_clock_weeks'] = [
            'label' => 'Flip/Block Clock Weeks',
            'selector' => '%%order_class%% .flip_clock .time.weeks, %%order_class%% .block_clock .time.weeks',
        ];
        $custom_css_fields['dmpro_countdown_flip_clock_days'] = [
            'label' => 'Flip/Block Clock Days',
            'selector' => '%%order_class%% .flip_clock .time.days, %%order_class%% .block_clock .time.days',
        ];
        $custom_css_fields['dmpro_countdown_flip_clock_hours'] = [
            'label' => 'Flip/Block Clock Hours',
            'selector' => '%%order_class%% .flip_clock .time.hours, %%order_class%% .block_clock .time.hours',
        ];
        $custom_css_fields['dmpro_countdown_flip_clock_mins'] = [
            'label' => 'Flip/Block Clock Minutes',
            'selector' => '%%order_class%% .flip_clock .time.minutes, %%order_class%% .block_clock .time.minutes',
        ];
        $custom_css_fields['dmpro_countdown_flip_clock_secs'] = [
            'label' => 'Flip/Block Clock Seconds',
            'selector' => '%%order_class%% .flip_clock .time.seconds, %%order_class%% .block_clock .time.seconds',
        ];

        $custom_css_fields['dmpro_countdown_flip_clock_weeks'] = [
            'label' => 'Flip/Block Clock Face Weeks',
            'selector' => '%%order_class%% .flip_clock .face_weeks .count, %%order_class%% .block_clock .face_weeks',
        ];
        $custom_css_fields['dmpro_countdown_flip_clock_days'] = [
            'label' => 'Flip/Block Clock Face Days',
            'selector' => '%%order_class%% .flip_clock .face_days .count, %%order_class%% .block_clock .face_days',
        ];
        $custom_css_fields['dmpro_countdown_flip_clock_hours'] = [
            'label' => 'Flip/Block Clock Face Hours',
            'selector' => '%%order_class%% .flip_clock .face_hours .count, %%order_class%% .block_clock .face_hours',
        ];
        $custom_css_fields['dmpro_countdown_flip_clock_mins'] = [
            'label' => 'Flip/Block Clock Face Minutes',
            'selector' => '%%order_class%% .flip_clock .face_minutes .count, %%order_class%% .block_clock .face_minutes',
        ];
        $custom_css_fields['dmpro_countdown_flip_clock_secs'] = [
            'label' => 'Flip/Block Clock Face Seconds',
            'selector' => '%%order_class%% .flip_clock .face_seconds .count, %%order_class%% .block_clock .face_seconds',
        ];

        return $custom_css_fields;
    }

    function apply_css($render_slug) {
		
        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .flip_clock div.time span.count, %%order_class%% .block_clock div.face',
            'declaration' => "background: {$this->props['clock_background']};",
        ]);


        if ('flip_clock' === $this->props["style"]) {
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .flip_clock div.time span.count.top',
                'declaration' => "border-top-color: {$this->props['flip_clock_top_border']};",
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .flip_clock div.time span.count.top',
                'declaration' => "border-bottom-color: {$this->props['flip_clock_separator_top_border']};",
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .flip_clock div.time span.count.bottom',
                'declaration' => "border-top-color: {$this->props['flip_clock_separator_bottom_border']};",
            ]);

            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .flip_clock div.time span.count.bottom',
                'declaration' => "border-bottom-color: {$this->props['flip_clock_bottom_border']};",
            ]);

            $this->make_responsive_style($render_slug, $this->props, "clock_face_width", "%%order_class%% .flip_clock .face .time", "width");
            $this->make_responsive_style($render_slug, $this->props, "clock_face_height", "%%order_class%% .flip_clock .face .time", "height");
            $this->make_responsive_style($render_slug, $this->props, "clock_face_margin", "%%order_class%% .flip_clock .face", "margin");
        } else if ('block_clock' === $this->props["style"]) {
            $this->make_responsive_style($render_slug, $this->props, "clock_face_margin", "%%order_class%% .block_clock .face", "margin");
            $this->make_responsive_style($render_slug, $this->props, "clock_face_padding", "%%order_class%% .block_clock .face", "padding");

            if('on' === $this->props['block_clock_equalize_width']){
                ET_Builder_Element::set_style($render_slug, [
                    'selector' => '%%order_class%% .block_clock .face',
                    'declaration' => "flex: 1;",
                ]);
            } else {
                ET_Builder_Element::set_style($render_slug, [
                    'selector' => '%%order_class%% .block_clock .face_wrapper.face_wrapper',
                    'declaration' => "justify-content: {$this->props['block_clock_face_alignment']};",
                ]);
            }
        }
    }

    public function render($attrs, $content, $render_slug) {
        wp_enqueue_style("dmpro".$this->slug, $this->module_url . 'style.css', [], DMPRO_VERSION, 'all');
        wp_enqueue_script("dmpro-".$this->slug, $this->module_url . 'custom.js', array('dmpro_countdown_script'), DMPRO_VERSION, false, true);

        $this->apply_css($render_slug);
        
        $config = [
            "style" => $this->props["style"],
            "finish_countdown" => $this->props["finish_countdown"],
            "label_weeks" => $this->props["label_weeks"],
            "label_days" => $this->props["label_days"],
            "label_hours" => $this->props["label_hours"],
            "label_minutes" => $this->props["label_minutes"],
            "label_seconds" => $this->props["label_seconds"],
        ];

        if($this->props['date_type'] === 'text'){
            $date_time_text = $this->props['date_time_text'];
            if(!$this->preg_match("/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", trim($date_time_text))) {
                return sprintf('<div>%1$s</div>', esc_html__('No Date Configured', DMPRO_TEXTDOMAIN));
            } else {
                $config["date"] = trim($date_time_text);
            }
        } else if($this->props['date_type'] === 'picker') {
            if (!$this->props["date_time_picker"] || '' === $this->props["date_time_picker"]) {
                return $this->dateNotConfigued();
            } else {
                $config["date"] = $this->props['date_time_picker'];
            }
        } else if($this->props['date_type'] === 'current_time') {
            $config["date"] = "now";
            $config["offset"] = isset($this->props['date_time_offset']) && '' !== $this->props['date_time_offset'] ? $this->props['date_time_offset'] : 0;
            if('on' === $this->props['use_cookie']){
                $config["use_cookie"] = true;
                $config["cookie_id"] = $this->props['cookie_id'];
            }
        } else {
            return $this->dateNotConfigued();
        }

        if ('custom_format' === $this->props["style"]) {
            $config["custom_format"] = $this->props["custom_format"];
        }

        if ('script' === $this->props["finish_countdown"]) {
            $config["script"] = $this->props["script"];
        }

        if ('html' === $this->props["finish_countdown"]) {
            $config["html"] = $this->props["html"];
        }

        if ('forward' === $this->props["finish_countdown"]) {
            $config["forwarding_url"] = $this->props["forwarding_url"];
        }

        if (in_array($this->props["style"], ['flip_clock', 'block_clock'])) {
            $config["show_weeks"] = 'on' === $this->props["show_weeks"];
            $config["show_days"] = 'on' === $this->props["show_days"];
            $config["show_hours"] = 'on' === $this->props["show_hours"];
            $config["show_minutes"] = 'on' === $this->props["show_minutes"];
            $config["show_seconds"] = 'on' === $this->props["show_seconds"] || 'on' !== $this->props["show_minutes"];
            $config["clock_label_position"] = $this->props["clock_label_position"];
        }
        
        return sprintf(
            '<div class="clock %1$s" data-config="%2$s"></div>',
            esc_attr($this->props["style"]),
            esc_attr(htmlspecialchars(wp_json_encode($config), ENT_QUOTES, 'UTF-8'))
        );
    }

    private function make_responsive_style($render_slug, $props, $property, $css_selector, $css_property, $important = false) {

        $responsive_active = !empty($props[$property . "_last_edited"]) && et_pb_get_responsive_status($props[$property . "_last_edited"]);

        $declaration_desktop = "";
        $declaration_tablet = "";
        $declaration_phone = "";

        switch ($css_property) {
            case "margin":
            case "padding":
                if (!empty($props[$property])) {
                    $values = explode("|", $props[$property]);
                    $declaration_desktop = "{$css_property}-top: {$values[0]};
                                           {$css_property}-right: {$values[1]};
                                           {$css_property}-bottom: {$values[2]};
                                           {$css_property}-left: {$values[3]};";
                }

                if ($responsive_active && !empty($props[$property . "_tablet"])) {
                    $values = explode("|", $props[$property . "_tablet"]);
                    $declaration_tablet = "{$css_property}-top: {$values[0]};
                                          {$css_property}-right: {$values[1]};
                                          {$css_property}-bottom: {$values[2]};
                                          {$css_property}-left: {$values[3]};";
                }

                if ($responsive_active && !empty($props[$property . "_phone"])) {
                    $values = explode("|", $props[$property . "_phone"]);
                    $declaration_phone = "{$css_property}-top: {$values[0]};
                                         {$css_property}-right: {$values[1]};
                                         {$css_property}-bottom: {$values[2]};
                                         {$css_property}-left: {$values[3]};";
                }
                break;
            default: 
                if (!empty($props[$property])) {
                    $declaration_desktop = "{$css_property}: {$props[$property]};";
                }
                if ($responsive_active && !empty($props[$property . "_tablet"])) {
                    $declaration_tablet = "{$css_property}: {$props[$property . "_tablet"]};";
                }
                if ($responsive_active && !empty($props[$property . "_phone"])) {
                    $declaration_phone = "{$css_property}: {$props[$property . "_phone"]};";
                }
        }

        ET_Builder_Element::set_style($render_slug, [
            'selector' => $css_selector,
            'declaration' => $declaration_desktop,
        ]);

        if (!empty($props[$property . "_tablet"]) && $responsive_active) {
            ET_Builder_Element::set_style($render_slug, [
                'selector' => $css_selector,
                'declaration' => $declaration_tablet,
                'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
            ]);
        }

        if (!empty($props[$property . "_phone"]) && $responsive_active) {
            ET_Builder_Element::set_style($render_slug, [
                'selector' => $css_selector,
                'declaration' => $declaration_phone,
                'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
            ]);
        }

    }
}
new DMPRO_CountDownTimer;