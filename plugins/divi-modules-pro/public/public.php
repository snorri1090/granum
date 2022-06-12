<?php
function load_scripts() {
        wp_enqueue_style("dmpro_general_style", DMPRO_PLUGIN_URL . 'public/css/general.css', [], "1.0.0", 'all');
        wp_register_style("dmpro_swiper_style", DMPRO_PLUGIN_URL . 'public/css/swiper-8.1.4.min.css', [], "8.1.4", 'all');
        
        wp_register_style("dmpro_animate_style", DMPRO_PLUGIN_URL . 'public/css/animate.css', [], "3.5.2", 'all');
        if(get_dmpro_option('dmpro_image_hover')) {
        wp_enqueue_style("dmpro_lightbox_css", DMPRO_PLUGIN_URL . 'public/css/lightbox.min.css');
        }
        wp_register_style("dmpro_magnific_popup_style", DMPRO_PLUGIN_URL . 'public/css/magnific-popup.css', [], "1.0.1", 'all');
        wp_register_script("dmpro_magnific_popup_script", DMPRO_PLUGIN_URL . 'public/js/magnific-popup.min.js', array('jquery'), "1.1.0", false);
        wp_register_script("dmpro_popper_script", DMPRO_PLUGIN_URL . 'public/js/popper.min.js', array('jquery'), "1.1.0", false);
        wp_register_script("dmpro_tippy_script", DMPRO_PLUGIN_URL . 'public/js/tippy.min.js', array('dmpro_popper_script'), "1.1.0", false);
        wp_register_script("dmpro_imagesloaded_script", DMPRO_PLUGIN_URL . 'public/js/imagesloaded.pkgd.min.js', array('jquery'), "4.1.4", false);
        wp_register_script("dmpro_resize_sensor_script", DMPRO_PLUGIN_URL . 'public/js/ResizeSensor.js', array('jquery'), "1.0.0", false);
        wp_register_script("dmpro_masonry_script", DMPRO_PLUGIN_URL . 'public/js/masonry.pkgd.min.js', array('dmpro_public','jquery', 'dmpro_imagesloaded_script', 'dmpro_throttle_debounce_script', 'dmpro_magnific_popup_script'), "4.2.2", false);
        wp_register_script("dmpro_event_move_script", DMPRO_PLUGIN_URL . 'public/js/jquery.event.move.js',"", "2.0.0", true);
        wp_register_script("dmpro_vanilla_tilt_script", DMPRO_PLUGIN_URL . 'public/js/vanilla-tilt.min.js',"", "1.7.1", true);
        wp_register_script("dmpro_countdown_script", DMPRO_PLUGIN_URL . 'public/js/jquery.countdown.min.js', "", "1.0.0", false);
        wp_register_script("dmpro_morphext", DMPRO_PLUGIN_URL . 'public/js/morphext.min.js',"", "2.4.7", true);
        wp_register_script("dmpro_throttle_debounce_script", DMPRO_PLUGIN_URL . 'public/js/jquery.throttle.debounce.min.js', array('jquery'), "1.1", true);
        wp_register_script("dmpro_pannellum_script", DMPRO_PLUGIN_URL . 'public/js/pannellum.2.5.6.min.js', array('jquery'), DMPRO_VERSION, true);
        wp_register_script("dmpro_video_script", DMPRO_PLUGIN_URL . 'public/js/video.7.0.3.min.js', array('jquery'), DMPRO_VERSION, true);
        wp_register_script("dmpro_videojs_pannellum_plugin_script", DMPRO_PLUGIN_URL . 'public/js/videojs-pannellum-plugin.min.js', ['dmpro_video_script'], DMPRO_VERSION, true);
        wp_register_style("dmpro_pannellum_style", DMPRO_PLUGIN_URL . 'public/css/pannellum.2.5.6.min.css', [], DMPRO_VERSION, 'all');
        wp_register_style("dmpro_video_style", DMPRO_PLUGIN_URL . 'public/css/video-js.7.0.3.min.css', [], DMPRO_VERSION, 'all');
        wp_register_script("dmpro_swiper_script", DMPRO_PLUGIN_URL . 'public/js/swiper-8.1.4.min.js',"", "8.1.4", true);
        wp_register_script("dmpro_public", DMPRO_PLUGIN_URL . 'public/js/public.min.js', array('jquery'), "1.0.0", false);
}
    function public_scripts () {
        if(is_user_logged_in()) {
            wp_enqueue_script('dmpro_public');
            wp_enqueue_script('dmpro_masonry_script');
            wp_enqueue_script('dmpro_resize_sensor_script');
            wp_enqueue_script('dmpro_throttle_debounce_script');
            wp_enqueue_script('dmpro_countdown_script');
            wp_enqueue_script('dmpro_morphext');
            wp_enqueue_style('dmpro_swiper_style');
            wp_enqueue_style('dmpro_animate_style');
        }
    }
    add_action('wp_enqueue_scripts', 'load_scripts');
    add_action('wp_enqueue_scripts', 'public_scripts');
    add_action('admin_enqueue_scripts', 'public_scripts');