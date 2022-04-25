<?php
function load_scripts() {
        wp_enqueue_style("dmpro_general_style", plugin_dir_url(__FILE__) . 'css/general.css', [], "1.0.0", 'all');
        wp_register_style("dmpro_swiper_style", plugin_dir_url(__FILE__) . 'css/swiper.5.3.8.min.css', [], "5.3.8", 'all');
        
        wp_register_style("dmpro_animate_style", plugin_dir_url(__FILE__) . 'css/animate.css', [], "3.5.2", 'all');
        if(get_dmpro_option('dmpro_image_hover')) {
        wp_enqueue_style("dmpro_lightbox_css", plugin_dir_url(__FILE__) . 'css/lightbox.min.css');
        }
        wp_register_style("dmpro_magnific_popup_style", plugin_dir_url(__FILE__) . 'css/magnific-popup.css', [], "1.0.1", 'all');
        wp_register_script("dmpro_magnific_popup_script", plugin_dir_url(__FILE__) . 'js/magnific-popup.min.js', array('jquery'), "1.1.0", false);
        wp_register_script("dmpro_popper_script", plugin_dir_url(__FILE__) . 'js/popper.min.js', array('jquery'), "1.1.0", false);
        wp_register_script("dmpro_tippy_script", plugin_dir_url(__FILE__) . 'js/tippy.min.js', array('dmpro_popper_script'), "1.1.0", false);
        wp_register_script("dmpro_imagesloaded_script", plugin_dir_url(__FILE__) . 'js/imagesloaded.pkgd.min.js', array('jquery'), "4.1.4", false);
        wp_register_script("dmpro_resize_sensor_script", plugin_dir_url(__FILE__) . 'js/ResizeSensor.js', array('jquery'), "1.0.0", false);
        wp_register_script("dmpro_masonry_script", plugin_dir_url(__FILE__) . 'js/masonry.pkgd.min.js', array('jquery', 'dmpro_imagesloaded_script', 'dmpro_throttle_debounce_script', 'dmpro_magnific_popup_script'), "4.2.2", false);
        wp_register_script("dmpro_event_move_script", plugin_dir_url(__FILE__) . 'js/jquery.event.move.js',"", "2.0.0", true);
        wp_register_script("dmpro_vanilla_tilt_script", plugin_dir_url(__FILE__) . 'js/vanilla-tilt.min.js',"", "1.7.1", true);
        wp_register_script("dmpro_countdown_script", plugin_dir_url(__FILE__) . 'js/jquery.countdown.min.js', "", "1.0.0", false);
        wp_register_script("dmpro_morphext", plugin_dir_url(__FILE__) . 'js/morphext.min.js',"", "2.4.7", true);
        wp_register_script("dmpro_throttle_debounce_script", plugin_dir_url(__FILE__) . 'js/jquery.throttle.debounce.min.js', array('jquery'), "1.1", true);
        wp_register_script("dmpro_pannellum_script", plugin_dir_url(__FILE__) . 'js/pannellum.2.5.6.min.js', array('jquery'), DMPRO_VERSION, true);
        wp_register_script("dmpro_video_script", plugin_dir_url(__FILE__) . 'js/video.7.0.3.min.js', array('jquery'), DMPRO_VERSION, true);
        wp_register_script("dmpro_videojs_pannellum_plugin_script", plugin_dir_url(__FILE__) . 'js/videojs-pannellum-plugin.min.js', ['dmpro_video_script'], DMPRO_VERSION, true);
        wp_register_style("dmpro_pannellum_style", plugin_dir_url(__FILE__) . 'css/pannellum.2.5.6.min.css', [], DMPRO_VERSION, 'all');
        wp_register_style("dmpro_video_style", plugin_dir_url(__FILE__) . 'css/video-js.7.0.3.min.css', [], DMPRO_VERSION, 'all');
        wp_register_script("dmpro_swiper_script", plugin_dir_url(__FILE__) . 'js/swiper.5.3.8.min.js',"", ".5.3.8", true);
        wp_register_script("dmpro_public", plugin_dir_url(__FILE__) . 'js/public.min.js', array('jquery'), "1.0.0", false);
}
    function public_scripts () {
        if(is_user_logged_in()) {
            wp_enqueue_script('dmpro_public');
            wp_enqueue_script('dmpro_masonry_script');
            wp_enqueue_script('dmpro_resize_sensor_script');
            wp_enqueue_script("dmpro_throttle_debounce_script");
            wp_enqueue_script('dmpro_countdown_script');
            wp_enqueue_script('dmpro_morphext');
            wp_enqueue_style('dmpro_swiper_style');
            wp_enqueue_style('dmpro_animate_style');
        }
    }
    add_action('wp_enqueue_scripts', 'load_scripts');
    add_action('wp_enqueue_scripts', 'public_scripts');
    add_action('admin_enqueue_scripts', 'public_scripts');
