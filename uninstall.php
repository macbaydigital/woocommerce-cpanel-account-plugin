<?php
/**
 * Uninstall the plugin
 *
 * @package WooCommerce_CPanel_Account_Plugin
 */

// Exit if accessed directly
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Load the autoloader
require_once __DIR__ . '/includes/autoload.php';

// Uninstall the plugin
WooCommerce_CPanel_Account_Plugin\Uninstall::uninstall();
