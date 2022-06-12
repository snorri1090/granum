<?php
/*
Plugin Name: Divi Modules Pro
Plugin URI:  https://divilife.com
Description: A multimodule plugin to enhance the functionality of Divi
Version:     1.2.1
Author:      Divi Life
Author URI:  https://divilife.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: dmpro-divi-modules-pro
*/

define( 'DMPRO_VERSION', '1.2.1' );
define( 'DMPRO_ITEM_ID', 1069033 );
define( 'DMPRO_STORE_URL', 'https://divilife.com/' );
define( 'DMPRO_AUTHOR', 'Divi Life' );
define( 'DMPRO_WEB', 'https://divilife.com' );
define( 'DMPRO_MODULE', 'https://divimodules.com/modules/' );
define( 'DMPRO_PREFIX', ' Pro ' );
define( 'DMPRO_FILE', __FILE__ );
define( 'DMPRO_PLUGIN_BASENAME', plugin_basename( DMPRO_FILE ) );
define( 'DMPRO_PLUGIN_NAME', trim( dirname( DMPRO_PLUGIN_BASENAME ), '/' ) );
define( 'DMPRO_PLUGIN_DIR', plugin_dir_path( DMPRO_FILE ) );
define( 'DMPRO_PLUGIN_URL', plugin_dir_url( DMPRO_FILE ) );
define( 'DMPRO_MODULES_URL', DMPRO_PLUGIN_URL . 'includes/modules/' );
define( 'DMPRO_TEXTDOMAIN', 'dmpro-divi-modules-pro' );

require_once plugin_dir_path( DMPRO_FILE ) . 'settings.php';
register_activation_hook( DMPRO_FILE, 'activate_modules' );