<?php
/**
 * Helper class
 *
 * @package WooCommerce_CPanel_Account_Plugin
 */

namespace WooCommerce_CPanel_Account_Plugin;

/**
 * Helper class
 */
class Helper
{
    /**
     * Get WHM API credentials
     *
     * @return array
     */
    public static function get_whm_api_credentials()
    {
        $settings = Settings::get_settings();

        $credentials = array(
            'username' => 'root',
            'password' => 'rootpasswordhidden',
            'url'      => 'https://cube.macbay.net:2087',
        );

        if (isset($settings['whm_api_credentials'])) {
            $credentials = $settings['whm_api_credentials'];
        }

        return $credentials;
    }
}
