<?php
/**
 * Shortcodes class
 *
 * @package WooCommerce_CPanel_Account_Plugin
 */

namespace WooCommerce_CPanel_Account_Plugin;

/**
 * Shortcodes class
 */
class Shortcodes
{
    /**
     * Initialize shortcodes
     */
    public static function init()
    {
        add_shortcode('cpanel_account_details', array(__CLASS__, 'render_account_details_shortcode'));
    }

    /**
     * Render the account details shortcode
     *
     * @param array $atts Shortcode attributes.
     * @return string
     */
    public static function render_account_details_shortcode($atts)
    {
        $atts = shortcode_atts(array(
            'order_id' => 0,
        ), $atts, 'cpanel_account_details');

        $order_id = intval($atts['order_id']);

        if (!$order_id) {
            return '';
        }

        $order = wc_get_order($order_id);

        if (!$order) {
            return '';
        }

        $user_name = $order->get_meta('whm_user_name');
        $password = $order->get_meta('whm_password');
        $domain = $order->get_meta('whm_domain');

        ob_start();
        ?>
        <div class="cpanel-account-details">
            <h3><?php esc_html_e('cPanel Account Details', 'woocommerce-cpanel-account-plugin'); ?></h3>
            <p><strong><?php esc_html_e('Username:', 'woocommerce-cpanel-account-plugin'); ?></strong> <?php echo esc_html($user_name); ?></p>
            <p><strong><?php esc_html_e('Password:', 'woocommerce-cpanel-account-plugin'); ?></strong> <?php echo esc_html($password); ?></p>
            <p><strong><?php esc_html_e('Domain:', 'woocommerce-cpanel-account-plugin'); ?></strong> <?php echo esc_html($domain); ?></p>
        </div>
        <?php
        return ob_get_clean();
    }
}
