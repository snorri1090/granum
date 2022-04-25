<?php
/*
Plugin Name: Divi Modules Pro
Plugin URI:  https://divilife.com
Description: A multimodule plugin to enhance the functionality of Divi
Version:     1.2
Author:      Divi Life
Author URI:  https://divilife.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: dmpro-divi-modules-pro
*/

define('DMPRO_VERSION', '1.2');
define('DMPRO_ITEM_ID', 1069033);
define('DMPRO_STORE_URL', 'https://divilife.com/');
define('DMPRO_AUTHOR', 'Divi Life');
define('DMPRO_WEB', 'https://divilife.com');
define('DMPRO_MODULE', 'https://divimodules.com/modules/');
define('DMPRO_PREFIX', ' Pro ');
define('DMPRO_FILE', __FILE__);

require_once plugin_dir_path(__FILE__) . 'settings.php';
register_activation_hook( __FILE__, 'activate_modules' );