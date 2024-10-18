<?php
/**
 * Uninstall class
 *
 * @package WooCommerce_CPanel_Account_Plugin
 */

namespace WooCommerce_CPanel_Account_Plugin;

/**
 * Uninstall class
 */
class Uninstall
{
    /**
     * Uninstall the plugin
     */
    public static function uninstall()
    {
        // Uninstall code goes here
        // For example, delete plugin options
        delete_option('woocommerce_cpanel_account_plugin_settings');
    }
}
