<?php

if( !class_exists( 'DMPRO_Updater' ) ) {
	include( 'dmpro_updater.php' );
}

function dmpro_plugin_updater() {
	$doing_cron = defined( 'DOING_CRON' ) && DOING_CRON;
	if ( ! current_user_can( 'manage_options' ) && ! $doing_cron ) {
		return;
	}
	$license_data = maybe_unserialize( get_option( 'dmpro_license' ) );
	
	if ( $license_data !== false ) {
		
		$license_key = $license_data['license'];
		$edd_updater = new DMPRO_Updater( DMPRO_STORE_URL,  DMPRO_FILE,
			array(
				'version' => DMPRO_VERSION,
				'license' => $license_key,             
				'item_id' => DMPRO_ITEM_ID,       
				'author'  => DMPRO_AUTHOR
			)
		);
	}

}
add_action( 'init', 'dmpro_plugin_updater' );



function check_license() {
	$dmpro_license_data = get_option('dmpro_license');
	if($dmpro_license_data) {
		$dmpro_license_data = maybe_unserialize($dmpro_license_data);
		if($dmpro_license_data['license'] != '' && $dmpro_license_data['active']) {
			return true;
		}
	}
	return false;
}

function activate_license($key) {
	$parameters = array(
		'edd_action' => 'activate_license',
		'item_id' => DMPRO_ITEM_ID,
		'license' => $key,
	);
	$response = wp_remote_post(DMPRO_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $parameters ));
	if ( is_wp_error($response) ) {
		return $response->get_error_message();
	}
	$license_data = json_decode( wp_remote_retrieve_body( $response ) );
	if($license_data->success) {
		$dmpro_license = [];
		$dmpro_license['license'] = $key;
		$dmpro_license['active'] = $license_data->success;
		update_option('dmpro_license', maybe_serialize($dmpro_license));
		return true;
	}
	else {
		return false;
	}	
}

function deactivate_license() { 
    $license = '';
    $key = get_option('dmpro_license');
    if($key) { 
        $key = maybe_unserialize($key);
        if(array_key_exists('license', $key) && is_array($key)) {
            $license = $key['license'];
            if($license != '') {
                $parameters = array(
		            'edd_action' => 'deactivate_license',
		            'item_id' => DMPRO_ITEM_ID,
		            'license' => $license,
		       );
		       $response = wp_remote_post(DMPRO_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $parameters ));
		       if ( is_wp_error($response) ) {
		           return $response->get_error_message();
		       }
		       $license_data = json_decode( wp_remote_retrieve_body( $response ) );
		       if($license_data->success) {
		           delete_option('dmpro_license');
		           return true;
		       }
		       else {
		           return false;
		       }
		           
            }
            else {
                return false;
            }
        }
    }
    else {
        return false;
    }
}