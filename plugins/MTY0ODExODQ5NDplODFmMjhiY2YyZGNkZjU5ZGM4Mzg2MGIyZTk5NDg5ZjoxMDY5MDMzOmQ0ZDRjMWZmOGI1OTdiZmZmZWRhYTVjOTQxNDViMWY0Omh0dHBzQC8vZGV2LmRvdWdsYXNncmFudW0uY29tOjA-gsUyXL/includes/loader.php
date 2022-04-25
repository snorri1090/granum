<?php

if ( ! class_exists( 'ET_Builder_Element' ) ) {
	return;
}


if(get_dmpro_option('dmpro_before_after')) {
    require_once plugin_dir_path(__FILE__) . 'modules/BeforeAfter/BeforeAfter.php';
}

if(get_dmpro_option('dmpro_breadcrumbs')) {
    require_once plugin_dir_path(__FILE__) . 'modules/BreadCrumb/BreadCrumb.php';
}

if(get_dmpro_option('dmpro_buttons_grid')) {
    require_once plugin_dir_path(__FILE__) . 'modules/ButtonGridiron/ButtonGridiron.php';
    require_once plugin_dir_path(__FILE__) . 'modules/ButtonGridiron_Child/ButtonGridiron_Child.php';
}

if(get_dmpro_option('dmpro_carousel')) {
    require_once plugin_dir_path(__FILE__) . 'modules/Carousel/Carousel.php';
    require_once plugin_dir_path(__FILE__) . 'modules/Carousel_Child/Carousel_Child.php';
}

if(get_dmpro_option('dmpro_content_toggle')) {
    require_once plugin_dir_path(__FILE__) . 'modules/ContentToggle/ContentToggle.php';
}

if(get_dmpro_option('dmpro_countdown_timer')) {
    require_once plugin_dir_path(__FILE__) . 'modules/CountDownTimer/CountDownTimer.php';
}

if(get_dmpro_option('dmpro_flipbox')) {
    require_once plugin_dir_path(__FILE__) . 'modules/FlipBox/FlipBox.php';
}

if(get_dmpro_option('dmpro_hoverbox')) {
    require_once plugin_dir_path(__FILE__) . 'modules/ImageHoverBox/ImageHoverBox.php';
}

if(get_dmpro_option('dmpro_image_hotspot')) {
    require_once plugin_dir_path(__FILE__) . 'modules/HotSpot/HotSpot.php';
    require_once plugin_dir_path(__FILE__) . 'modules/HotSpot_Child/HotSpot_Child.php';
}

if(get_dmpro_option('dmpro_masonry_gallery')) {
    require_once plugin_dir_path(__FILE__) . 'modules/Masonry/Masonry.php';
}
if(get_dmpro_option('dmpro_price_list')) {
    require_once plugin_dir_path(__FILE__) . 'modules/RestaurantMenu/RestaurantMenu.php';
    require_once plugin_dir_path(__FILE__) . 'modules/RestaurantMenu_Child/RestaurantMenu_Child.php';
}
if(get_dmpro_option('dmpro_popup')) {
    require_once plugin_dir_path(__FILE__) . 'modules/Popup/Popup.php';

}
if(get_dmpro_option('dmpro_timeline')) {
    require_once plugin_dir_path(__FILE__) . 'modules/TimeLine/TimeLine.php';
    require_once plugin_dir_path(__FILE__) . 'modules/TimeLineItem/TimeLineItem.php';

}
