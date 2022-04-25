<?php

require_once plugin_dir_path(__FILE__). 'updater/dmpro_license.php';

function dmpro_admin_scripts() {
    wp_enqueue_style("dmpro_admin_css", plugin_dir_url(__FILE__) . 'scripts/css/admin.css', [], "1.0", 'all');

}
add_action( 'admin_enqueue_scripts', 'dmpro_admin_scripts' );

function divi_modules_pro() { 
    If(!check_license()) {
        $current_panel = 'license';
    }
    elseif( isset( $_GET['panel']) && !wp_verify_nonce( sanitize_key( $_GET['panel']) , 'panel' ) )  {
        $current_panel= sanitize_text_field( wp_unslash($_GET['panel']) );
    } 
    else {
        $current_panel= 'modules';
    }
    wp_enqueue_style("dmpro_admin_control_panel", plugin_dir_url(__FILE__) . 'scripts/css/admin-control-panel.css', [], "1.0", 'all');
    wp_enqueue_script( 'dmpro_admin_control_panel', plugin_dir_url(__FILE__) . 'scripts/js/admin-control-panel.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'dmpro_admin_js', plugin_dir_url(__FILE__) . 'scripts/js/on-off-switch.js', array( 'jquery' ), '', true );
    $settings_updated = false;
    $wp_token = 'divi_modules_pro_nonce';
    if ( isset( $_POST[ $wp_token ] ) ) {
        $settings_updated         = true;
        $settings_updated_success = false;
	    $message = '';
	    if ( wp_verify_nonce( sanitize_text_field( wp_unslash($_POST[$wp_token]) ), $wp_token ) && current_user_can( 'switch_themes' ) ) {
	        $dmpro_settings = maybe_serialize($_POST);
	    }
	    else {
	        $message = __( 'Authentication error, please try again.','dmpro-divi-modules-pro' );
	    }
	    if(isset($_POST['dmpro_deactivate_license'])) {
	        if(deactivate_license()) {
	            $message = __( 'License successfully deactivated.','dmpro-divi-modules-pro' );
	        }
	        else {
	            $message = __( 'Something went wrong.','dmpro-divi-modules-pro' );
	        }
	    }
	    else if(isset($_POST['dmpro_license_key'])) {
	        $license_key = activate_license($_POST['dmpro_license_key']);
	        if($license_key === true) {
	            $message = __( 'License successfully updated.','dmpro-divi-modules-pro' );
	        }
	        else if($license_key === false) {
	            $message = __( 'License key is invalid','dmpro-divi-modules-pro' );
	        }
	        else {
	            $message = __( $license_key,'dmpro-divi-modules-pro' );
	        }
	    }
	    else {
	        update_option('dmpro_settings', $dmpro_settings);
	        $message = __( 'Settings Updated.','dmpro-divi-modules-pro' );
	        $settings_updated_success = true;
	    }
    }
    if($settings_updated) { ?>
        <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible <?php echo $settings_updated_success ? '' : 'error' ?>">
			<p>
				<strong><?php echo esc_html( $message ); ?></strong>
			</p>
			<button type="button" class="notice-dismiss">
				<span class="screen-reader-text"><?php esc_attr_e( 'Dismiss this notice.' ,'dmpro-divi-modules-pro'); ?></span>
			</button>
		</div>
            
<?php   } ?>


    <div id="dmpro">
		<div class="dmpro-header">
         <img src="<?php echo plugin_dir_url(__FILE__); ?>img/dmpro-logo.png" alt="Divi Modules Pro">
		</div>
		<h2 class="dmpro-menu">

			<a href="?page=divi_modules_pro&panel=modules" class="dmpro-menu-item <?php echo ( $current_panel == 'modules')? 'dmpro-menu-item-active': ''; ?>">Modules</a> | 
			<a href="?page=divi_modules_pro&panel=license" class="dmpro-menu-item <?php echo ( $current_panel == 'license')? 'dmpro-menu-item-active': ''; ?>">License</a>
	   </h2>
		
	   <form action="" method="POST" class="et-divi-modules-pro-form" id="dmpro_settings_form" enctype="multipart/form-data">
			<div class="page-container" style="min-height: 0px;">
				<div class="dmpro-loader" style="display: none;">
					<div class="status" style="display: none;">
					<img src="#"> <!-- Get the DMPRO logo icon for loading -->
					</div>
				</div>
<div id="<?php echo $current_panel; ?>" class="tab tab-active">														
<?php 

if($current_panel == 'modules') { 
    require_once plugin_dir_path(__FILE__) . 'panels/dmpro_modules.php' ; 
} 

 else if( $current_panel == 'license' ) {
     require_once plugin_dir_path(__FILE__) . 'panels/dmpro_license.php' ; 
     
 } 
 ?>

</div>
    
</div>
			<div id="et-epanel-bottom">
				<?php wp_nonce_field( $wp_token, $wp_token ); ?>
				<button class="et-save-button" name="save" id="epanel-save">
				    <?php if($current_panel == 'license' && check_license()) { ?>
				    Deactivate license
				    <?php } else { ?>
				    Save Settings
				    <?php } ?>
				    </button>
			</div>
		</form>
	</div>
<?php }
function no_divi_installed() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'No Divi Product installed.', 'dmpro-divi-modules-pro' ); ?></p>
    </div>
    <?php
}
function dmpro_divi_menu() {
    if (defined('ET_CORE_VERSION')) {
        add_submenu_page('et_divi_options', __( 'Divi Modules Pro', 'dmpro-divi-modules-pro' ), __( 'Divi Modules Pro', 'dmpro-divi-modules-pro' ), 'manage_options', 'divi_modules_pro', 'divi_modules_pro' );
        add_submenu_page('et_extra_options', __( 'Divi Modules Pro', 'dmpro-divi-modules-pro' ), __( 'Divi Modules Pro', 'dmpro-divi-modules-pro' ), 'manage_options', 'divi_modules_pro', 'divi_modules_pro' );
    }
    else {
        add_action( 'admin_notices', 'no_divi_installed' );
    }
}
add_action('admin_menu','dmpro_divi_menu', 30);
function get_dmpro_option ($option_name) {
    $option_value = '';
    $get_settings = get_option('dmpro_settings');
    $get_settings = maybe_unserialize($get_settings);
    if(array_key_exists($option_name, $get_settings) && $option_name !='' && is_array($get_settings)) {
        $option_value = $get_settings[$option_name];
    }
    return $option_value;
}
function activate_modules() {
    $modules_list = array("dmpro_before_after"=>1,"dmpro_breadcrumbs"=>1,"dmpro_buttons_grid"=>1,"dmpro_carousel"=>1,"dmpro_countdown_timer"=>1,"dmpro_flipbox"=>1,"dmpro_hoverbox"=>1,"dmpro_image_hotspot"=>1,"dmpro_masonry_gallery"=>1,"dmpro_price_list"=>1, "dmpro_content_toggle"=>1, "dmpro_popup"=>1, "dmpro_timeline"=>1);
    update_option('dmpro_settings', maybe_serialize($modules_list));
    return;
}