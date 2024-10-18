<?php
/**
 * Main plugin class
 *
 * @package WooCommerce_CPanel_Account_Plugin
 */

namespace WooCommerce_CPanel_Account_Plugin;

/**
 * Plugin class
 */
class Plugin
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->includes();
        $this->init_hooks();
        Admin_Notices::display_notices();
    }

    /**
     * Include required files
     */
    private function includes()
    {
        require_once WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_DIR . 'includes/classes/Admin.php';
        require_once WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_DIR . 'includes/classes/Frontend.php';
        require_once WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_DIR . 'includes/classes/Admin_Notices.php';
    }

    /**
     * Initialize hooks
     */
    private function init_hooks()
    {
        $admin = new Admin();
        $frontend = new Frontend();

        add_action('admin_init', array($admin, 'register_settings'));
        add_action('woocommerce_product_options_general_product_data', array($admin, 'add_hosting_package_field'));
        add_action('woocommerce_process_product_meta', array($admin, 'save_custom_product_field'));
        add_action('admin_enqueue_scripts', array($admin, 'enqueue_scripts'));

        add_action('woocommerce_thankyou', array($frontend, 'create_cpanel_account'));
        add_action('woocommerce_order_status_changed', array($frontend, 'handle_order_status_change'), 10, 4);
    }

    /**
     * Run the plugin
     */
    public function run()
    {
        // Plugin code goes here
    }
}
