<?php
/**
 * Settings class
 *
 * @package WooCommerce_CPanel_Account_Plugin
 */

namespace WooCommerce_CPanel_Account_Plugin;

/**
 * Settings class
 */
class Settings
{
    /**
     * Settings key
     *
     * @var string
     */
    const SETTINGS_KEY = 'woocommerce_cpanel_account_plugin_settings';

    /**
     * Get settings
     *
     * @return array
     */
    public static function get_settings()
    {
        $settings = get_option(self::SETTINGS_KEY, array());
        return $settings;
    }

    /**
     * Update settings
     *
     * @param array $settings Settings data.
     */
    public static function update_settings($settings)
    {
        update_option(self::SETTINGS_KEY, $settings);
    }
}
