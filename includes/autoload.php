<?php
/**
 * Autoloader for classes
 *
 * @package WooCommerce_CPanel_Account_Plugin
 */

spl_autoload_register('woocommerce_cpanel_account_plugin_autoload');

/**
 * Autoload classes
 *
 * @param string $class_name Class name to autoload.
 */
function woocommerce_cpanel_account_plugin_autoload($class_name)
{
    $prefix = 'WooCommerce_CPanel_Account_Plugin\\';
    $base_dir = WOOCOMMERCE_CPANEL_ACCOUNT_PLUGIN_DIR . 'includes/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class_name, $len) !== 0) {
        return;
    }

    $relative_class = substr($class_name, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
}
