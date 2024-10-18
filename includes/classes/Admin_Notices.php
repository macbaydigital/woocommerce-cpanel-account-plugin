<?php
/**
 * Admin Notices class
 *
 * @package WooCommerce_CPanel_Account_Plugin
 */

namespace WooCommerce_CPanel_Account_Plugin;

/**
 * Admin Notices class
 */
class Admin_Notices
{
    /**
     * Display admin notices
     */
    public static function display_notices()
    {
        $screen = get_current_screen();

        // Check if WooCommerce is installed and active
        if (!class_exists('WooCommerce')) {
            add_action('admin_notices', array(__CLASS__, 'woocommerce_missing_notice'));
        }

        // Check if the current screen is the WooCommerce settings page
        if ($screen->id === 'woocommerce_page_woocommerce-cpanel-account-plugin-settings') {
            add_action('admin_notices', array(__CLASS__, 'settings_saved_notice'));
        }
    }

    /**
     * Display a notice if WooCommerce is not installed and active
     */
    public static function woocommerce_missing_notice()
    {
        $class = 'notice notice-error';
        $message = __('WooCommerce is not installed and activated. Please install and activate WooCommerce to use the cPanel Account Plugin.', 'woocommerce-cpanel-account-plugin');

        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }

    /**
     * Display a notice when settings are saved
     */
    public static function settings_saved_notice()
    {
        $class = 'notice notice-success';
        $message = __('Settings saved.', 'woocommerce-cpanel-account-plugin');

        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }
}
