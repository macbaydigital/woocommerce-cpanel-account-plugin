<?php
/**
 * Assets class
 *
 * @package WooCommerce_CPanel_Account_Plugin
 */

namespace WooCommerce_CPanel_Account_Plugin;

/**
 * Assets class
 */
class Assets
{
    /**
     * Initialize assets
     */
    public static function init()
    {
        add_action('admin_enqueue_scripts', array(__CLASS__, 'enqueue_admin_scripts'));
        add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue_frontend_scripts'));
    }

    /**
     * Enqueue admin scripts
     */
    public static function enqueue_admin_scripts($hook)
    {
        $screen = get_current_screen();

        if ($screen->id === 'woocommerce_page_woocommerce-cpanel-account-plugin-settings') {
            wp_enqueue_style('woocommerce-cpanel-account-plugin-admin', WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_URL . 'assets/css/admin.css', array(), WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_VERSION);
            wp_enqueue_script('woocommerce-cpanel-account-plugin-admin', WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_VERSION, true);
        }
    }

    /**
     * Enqueue frontend scripts
     */
    public static function enqueue_frontend_scripts()
    {
        if (is_checkout() || is_account_page()) {
            wp_enqueue_style('woocommerce-cpanel-account-plugin-frontend', WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_URL . 'assets/css/frontend.css', array(), WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_VERSION);
            wp_enqueue_script('woocommerce-cpanel-account-plugin-frontend', WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_URL . 'assets/js/frontend.js', array('jquery'), WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_VERSION, true);
        }
    }
}
