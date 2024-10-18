<?php
/**
 * Updates class
 *
 * @package WooCommerce_CPanel_Account_Plugin
 */

namespace WooCommerce_CPanel_Account_Plugin;

/**
 * Updates class
 */
class Updates
{
    /**
     * GitHub Repository URL
     *
     * @var string
     */
    const GITHUB_REPO_URL = 'https://github.com/macbaydigital/woocommerce-cpanel-account-plugin';

    /**
     * GitHub Personal Access Token
     *
     * @var string
     */
    const GITHUB_ACCESS_TOKEN = 'YOUR_PERSONAL_ACCESS_TOKEN_HERE';

    /**
     * Plugin slug
     *
     * @var string
     */
    const PLUGIN_SLUG = 'woocommerce-cpanel-account-plugin';

    /**
     * Initialize the updater
     */
    public static function init()
    {
        add_filter('plugins_api', array(__CLASS__, 'plugin_info'), 20, 3);
        add_filter('site_transient_update_plugins', array(__CLASS__, 'push_update'));
    }

    /**
     * Get plugin information from the GitHub repository
     *
     * @param false|object $res   Response object or false.
     * @param string       $action The type of information being requested from the Plugin Installation API.
     * @param object       $args   Plugin API arguments.
     * @return false|object
     */
    public static function plugin_info($res, $action, $args)
    {
        // Check if the request is for our plugin
        if ('plugin_information' !== $action || empty($args->slug) || self::PLUGIN_SLUG !== $args->slug) {
            return $res;
        }

        // Get the plugin information from the GitHub repository
        $remote = get_transient(self::PLUGIN_SLUG . '_remote_info');
        if (false === $remote) {
            $remote = wp_remote_get(self::GITHUB_REPO_URL . '/releases/latest', array(
                'headers' => array(
                    'Authorization' => 'token ' . self::GITHUB_ACCESS_TOKEN,
                ),
            ));
            set_transient(self::PLUGIN_SLUG . '_remote_info', $remote, DAY_IN_SECONDS);
        }

        if (!is_wp_error($remote)) {
            $remote = json_decode(wp_remote_retrieve_body($remote));
            $res = new \stdClass();
            $res->name = $remote->name;
            $res->version = $remote->tag_name;
            $res->download_link = $remote->zipball_url;
            $res->sections = array(
                'description' => $remote->body,
            );
        }

        return $res;
    }

    /**
     * Push the update notification
     *
     * @param object $transient WordPress plugin updates object.
     * @return object
     */
    public static function push_update($transient)
    {
        static $remote = null;

        if ($remote === null) {
            $remote = get_transient(self::PLUGIN_SLUG . '_remote_info');

            if ($remote === false) {
                $remote = wp_remote_get(self::GITHUB_REPO_URL . '/releases/latest', array(
                    'headers' => array(
                        'Authorization' => 'token ' . self::GITHUB_ACCESS_TOKEN,
                    ),
                ));
                set_transient(self::PLUGIN_SLUG . '_remote_info', $remote, DAY_IN_SECONDS);
            }

            if (!is_wp_error($remote)) {
                $remote = json_decode(wp_remote_retrieve_body($remote));
            }
        }

        if ($remote && version_compare(WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_VERSION, $remote->tag_name, '<')) {
            $res = new \stdClass();
            $res->slug = self::PLUGIN_SLUG;
            $res->plugin = self::PLUGIN_SLUG . '/' . self::PLUGIN_SLUG . '.php';
            $res->new_version = $remote->tag_name;
            $res->tested = $remote->tag_name;
            $res->package = $remote->zipball_url;
            $transient->response[self::PLUGIN_SLUG . '/' . self::PLUGIN_SLUG . '.php'] = $res;
        }

        return $transient;
    }
}
