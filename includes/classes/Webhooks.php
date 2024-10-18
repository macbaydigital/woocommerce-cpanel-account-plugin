<?php
/**
 * Webhooks class
 *
 * @package WooCommerce_CPanel_Account_Plugin
 */

namespace WooCommerce_CPanel_Account_Plugin;

/**
 * Webhooks class
 */
class Webhooks
{
    /**
     * Initialize webhooks
     */
    public static function init()
    {
        add_action('woocommerce_webhook_process_cpanel_account_created', array(__CLASS__, 'handle_cpanel_account_created'));
    }

    /**
     * Handle cPanel account created webhook
     *
     * @param array $payload Webhook payload.
     */
    public static function handle_cpanel_account_created($payload)
    {
        $order_id = isset($payload['order_id']) ? intval($payload['order_id']) : 0;

        if (!$order_id) {
            return;
        }

        $order = wc_get_order($order_id);

        if (!$order) {
            return;
        }

        // Perform actions when a cPanel account is created
        // For example, send a notification email to the customer
        $user_name = $order->get_meta('whm_user_name');
        $password = $order->get_meta('whm_password');
        $domain = $order->get_meta('whm_domain');

        $customer_email = $order->get_billing_email();
        $subject = __('Your cPanel Account Details', 'woocommerce-cpanel-account-plugin');
        $message = sprintf(
            __('Dear Customer,

Your cPanel account has been created successfully.

Username: %s
Password: %s
Domain: %s

Thank you for your business!

Best regards,
[Your Company Name]', 'woocommerce-cpanel-account-plugin'),
            $user_name,
            $password,
            $domain
        );

        $headers = array('Content-Type: text/html; charset=UTF-8');

        wp_mail($customer_email, $subject, $message, $headers);
    }
}
