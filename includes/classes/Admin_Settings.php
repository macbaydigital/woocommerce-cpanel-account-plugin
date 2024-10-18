<?php
/**
 * Admin Settings class
 *
 * @package WooCommerce_CPanel_Account_Plugin
 */

namespace WooCommerce_CPanel_Account_Plugin;

/**
 * Admin Settings class
 */
class Admin_Settings
{
    /**
     * Register settings sections and fields
     */
    public function register_settings()
    {
        add_settings_section(
            'woocommerce_cpanel_account_plugin_general_settings',
            __('General Settings', 'woocommerce-cpanel-account-plugin'),
            array($this, 'general_settings_section_callback'),
            'woocommerce_cpanel_account_plugin_settings'
        );

        add_settings_field(
            'whm_api_credentials',
            __('WHM API Credentials', 'woocommerce-cpanel-account-plugin'),
            array($this, 'whm_api_credentials_callback'),
            'woocommerce_cpanel_account_plugin_settings',
            'woocommerce_cpanel_account_plugin_general_settings'
        );

        register_setting(
            'woocommerce_cpanel_account_plugin_settings',
            'woocommerce_cpanel_account_plugin_settings'
        );
    }

    /**
     * General settings section callback
     */
    public function general_settings_section_callback()
    {
        echo '<p>' . __('Configure the general settings for the cPanel Account Plugin.', 'woocommerce-cpanel-account-plugin') . '</p>';
    }

    /**
     * WHM API credentials callback
     */
    public function whm_api_credentials_callback()
    {
        $settings = Settings::get_settings();
        $whm_api_credentials = isset($settings['whm_api_credentials']) ? $settings['whm_api_credentials'] : array();

        echo '<table class="form-table">';
        echo '<tr>';
        echo '<th scope="row">' . __('Username', 'woocommerce-cpanel-account-plugin') . '</th>';
        echo '<td><input type="text" name="woocommerce_cpanel_account_plugin_settings[whm_api_credentials][username]" value="' . esc_attr($whm_api_credentials['username']) . '" /></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th scope="row">' . __('Password', 'woocommerce-cpanel-account-plugin') . '</th>';
        echo '<td><input type="password" name="woocommerce_cpanel_account_plugin_settings[whm_api_credentials][password]" value="' . esc_attr($whm_api_credentials['password']) . '" /></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th scope="row">' . __('URL', 'woocommerce-cpanel-account-plugin') . '</th>';
        echo '<td><input type="text" name="woocommerce_cpanel_account_plugin_settings[whm_api_credentials][url]" value="' . esc_attr($whm_api_credentials['url']) . '" /></td>';
        echo '</tr>';
        echo '</table>';
    }
}
