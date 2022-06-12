<?php

require_once DMPRO_PLUGIN_DIR . 'admin/updater/dmpro_license.php';

function dmpro_admin_scripts() {
    wp_enqueue_style('dmpro_admin_css', DMPRO_PLUGIN_URL . 'admin/scripts/css/admin.css', [], "1.0", 'all');

}
add_action( 'admin_enqueue_scripts', 'dmpro_admin_scripts' );

function divi_modules_pro() { 
    if(!check_license()) {
        $current_panel = 'license';
    }
    elseif( isset( $_GET['panel']) && !wp_verify_nonce( sanitize_key( $_GET['panel']) , 'panel' ) )  {
        $current_panel= sanitize_text_field( wp_unslash($_GET['panel']) );
    } 
    else {
        $current_panel= 'modules';
    }
	
    wp_enqueue_style("dmpro_admin_control_panel", DMPRO_PLUGIN_URL . 'admin/scripts/css/admin-control-panel.css', [], "1.0", 'all');
    wp_enqueue_script( 'dmpro_admin_control_panel', DMPRO_PLUGIN_URL . 'admin/scripts/js/admin-control-panel.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'dmpro_admin_js', DMPRO_PLUGIN_URL . 'admin/scripts/js/on-off-switch.js', array( 'jquery' ), '', true );
	
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
	        $message = __( 'Authentication error, please try again.',DMPRO_TEXTDOMAIN );
	    }
		
	    if(isset($_POST['dmpro_deactivate_license'])) {
	        if(deactivate_license()) {
	            $message = __( 'License successfully deactivated.',DMPRO_TEXTDOMAIN );
				$settings_updated_success = true;
	        }
	        else {
	            $message = __( 'Something went wrong.',DMPRO_TEXTDOMAIN );
	        }
	    }
	    else if(isset($_POST['dmpro_license_key'])) {
			$dmpro_license_key = sanitize_text_field( wp_unslash( $_POST['dmpro_license_key'] ) );
	        $license_key = activate_license( $dmpro_license_key );
	        if($license_key === true) {
	            $message = __( 'License successfully updated.',DMPRO_TEXTDOMAIN );
				$settings_updated_success = true;
	        }
	        else if($license_key === false) {
	            $message = __( 'License key is invalid',DMPRO_TEXTDOMAIN );
	        }
	        else {
	            $message = __( $license_key,DMPRO_TEXTDOMAIN );
	        }
	    }
	    else {
	        update_option('dmpro_settings', $dmpro_settings);
	        $message = __( 'Settings Updated.',DMPRO_TEXTDOMAIN );
	        $settings_updated_success = true;
	    }
    }
	
    if($settings_updated) { ?>
        <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible <?php echo $settings_updated_success ? '' : 'error' ?>">
			<p>
				<strong><?php echo esc_html( $message ); ?></strong>
			</p>
			<button type="button" class="notice-dismiss">
				<span class="screen-reader-text"><?php esc_attr_e( 'Dismiss this notice.' ,DMPRO_TEXTDOMAIN); ?></span>
			</button>
		</div>
            
<?php   } ?>


    <div id="dmpro">
		<div class="dmpro-header">
         <img src="<?php echo esc_html( DMPRO_PLUGIN_URL ); ?>admin/img/dmpro-logo.png" alt="Divi Modules Pro">
		</div>
		<h2 class="dmpro-menu">

			<a href="?page=divi_modules_pro&panel=modules" class="dmpro-menu-item <?php echo ( $current_panel == 'modules')? 'dmpro-menu-item-active': ''; ?>"><?php esc_html_e('Modules', DMPRO_TEXTDOMAIN ) ?></a> | 
			<a href="?page=divi_modules_pro&panel=license" class="dmpro-menu-item <?php echo ( $current_panel == 'license')? 'dmpro-menu-item-active': ''; ?>"><?php esc_html_e('License', DMPRO_TEXTDOMAIN ) ?></a>
	   </h2>
		
	   <form action="" method="POST" class="et-divi-modules-pro-form" id="dmpro_settings_form" enctype="multipart/form-data">
			<div class="page-container" style="min-height: 0px;">
				<div class="dmpro-loader" style="display: none;">
					<div class="status" style="display: none;">
					<img src="#"> <!-- Get the DMPRO logo icon for loading -->
					</div>
				</div>
<div id="<?php esc_attr_e( $current_panel ); ?>" class="tab tab-active">														
<?php 

if($current_panel == 'modules') { 
    require_once DMPRO_PLUGIN_DIR . 'admin/panels/dmpro_modules.php' ; 
} 

 else if( $current_panel == 'license' ) {
     require_once DMPRO_PLUGIN_DIR . 'admin/panels/dmpro_license.php' ; 
     
 } 
 ?>

</div>
    
</div>
			<div id="et-epanel-bottom">
				<?php wp_nonce_field( $wp_token, $wp_token ); ?>
				<button class="et-save-button" name="save" id="epanel-save">
				    <?php
					
					if($current_panel == 'license' && check_license()) {
						
						esc_html_e('Deactivate license', DMPRO_TEXTDOMAIN );
						
				    } else {
						
						esc_html_e('Save Settings', DMPRO_TEXTDOMAIN );
				    }
					?>
				    </button>
			</div>
		</form>
	</div>
<?php }
function no_divi_installed() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php esc_html_e( 'No Divi Product installed.', DMPRO_TEXTDOMAIN ); ?></p>
    </div>
    <?php
}
function dmpro_divi_menu() {
    if (defined('ET_CORE_VERSION')) {
        add_submenu_page('et_divi_options', __( 'Divi Modules Pro', DMPRO_TEXTDOMAIN ), __( 'Divi Modules Pro', DMPRO_TEXTDOMAIN ), 'manage_options', 'divi_modules_pro', 'divi_modules_pro' );
        add_submenu_page('et_extra_options', __( 'Divi Modules Pro', DMPRO_TEXTDOMAIN ), __( 'Divi Modules Pro', DMPRO_TEXTDOMAIN ), 'manage_options', 'divi_modules_pro', 'divi_modules_pro' );
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
	
	if ( get_option('dmpro_settings') == '' ) {
		
		$modules_list = array("dmpro_before_after"=>1,"dmpro_breadcrumbs"=>1,"dmpro_buttons_grid"=>1,"dmpro_carousel"=>1,"dmpro_countdown_timer"=>1,"dmpro_flipbox"=>1,"dmpro_hoverbox"=>1,"dmpro_image_hotspot"=>1,"dmpro_masonry_gallery"=>1,"dmpro_price_list"=>1, "dmpro_content_toggle"=>1, "dmpro_popup"=>1, "dmpro_timeline"=>1);
		
		update_option('dmpro_settings', maybe_serialize($modules_list));
	}
	
    return;
}