<?php 

require_once DMPRO_PLUGIN_DIR . 'admin/admin.php';
require_once DMPRO_PLUGIN_DIR . 'public/public.php';

function dmpro_initialize_extension() {
	require_once DMPRO_PLUGIN_DIR . 'includes/DiviModulesPro.php';
}
add_action( 'divi_extensions_init', 'dmpro_initialize_extension' );

function smpl_deregister_styles() {
	
	wp_dequeue_style( 'divi-modules-pro-styles' );
}
add_action('init', function() {
	
	$et_fb = isset( $_GET['et_fb'] ); // phpcs:ignore WordPress.Security.NonceVerification.NoNonceVerification
	
	if ( !is_user_logged_in() || ( is_user_logged_in() && $et_fb === false ) ) {
		
		add_action( 'wp_enqueue_scripts', 'smpl_deregister_styles', 15 ); 
	}
});