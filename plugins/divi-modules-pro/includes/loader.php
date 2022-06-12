<?php

if ( ! class_exists( 'ET_Builder_Element' ) ) {
	return;
}


if(get_dmpro_option('dmpro_before_after')) {
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/BeforeAfter/BeforeAfter.php';
}

if(get_dmpro_option('dmpro_breadcrumbs')) {
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/BreadCrumb/BreadCrumb.php';
}

if(get_dmpro_option('dmpro_buttons_grid')) {
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/ButtonGridiron/ButtonGridiron.php';
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/ButtonGridiron_Child/ButtonGridiron_Child.php';
}

if(get_dmpro_option('dmpro_carousel')) {
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/Carousel/Carousel.php';
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/Carousel_Child/Carousel_Child.php';
}

if(get_dmpro_option('dmpro_content_toggle')) {
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/ContentToggle/ContentToggle.php';
}

if(get_dmpro_option('dmpro_countdown_timer')) {
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/CountDownTimer/CountDownTimer.php';
}

if(get_dmpro_option('dmpro_flipbox')) {
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/FlipBox/FlipBox.php';
}

if(get_dmpro_option('dmpro_hoverbox')) {
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/ImageHoverBox/ImageHoverBox.php';
}

if(get_dmpro_option('dmpro_image_hotspot')) {
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/HotSpot/HotSpot.php';
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/HotSpot_Child/HotSpot_Child.php';
}

if(get_dmpro_option('dmpro_masonry_gallery')) {
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/Masonry/Masonry.php';
}
if(get_dmpro_option('dmpro_price_list')) {
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/RestaurantMenu/RestaurantMenu.php';
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/RestaurantMenu_Child/RestaurantMenu_Child.php';
}
if(get_dmpro_option('dmpro_popup')) {
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/Popup/Popup.php';

}
if(get_dmpro_option('dmpro_timeline')) {
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/TimeLine/TimeLine.php';
    require_once DMPRO_PLUGIN_DIR . 'includes/modules/TimeLineItem/TimeLineItem.php';

}
