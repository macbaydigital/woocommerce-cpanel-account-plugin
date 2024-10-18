<?php
/**
 * Plugin Name: woocommerce-cpanel-account-plugin
 * Plugin URI: https://macbay.net
 * Description: This plugin creates new cPanel accounts while purchasing a hosting package from WooCommerce and allows customers to purchase additional storage space.
 * Version: 0.1
 * Author: Macbay
 * Author URI: https://macbay.net
 * Text Domain: woocommerce-cpanel-account-plugin
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define constants
define('WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_VERSION', '0.1');
define('WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_URL', plugin_dir_url(__FILE__));

// Autoload classes
require_once WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_DIR . 'includes/autoload.php';

// Initialize the plugin
function woocommerce_cpanel_account_plugin_init()
{
    $plugin = new WooCommerce_CPanel_Account_Plugin\Plugin();
    $plugin->run();
}
add_action('plugins_loaded', 'woocommerce_cpanel_account_plugin_init');

// Activation and deactivation hooks
register_activation_hook(__FILE__, array('WooCommerce_CPanel_Account_Plugin\Activation', 'activate'));
register_deactivation_hook(__FILE__, array('WooCommerce_CPanel_Account_Plugin\Deactivation', 'deactivate'));
