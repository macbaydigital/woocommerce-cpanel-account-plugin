<?php
/**
 * Admin class
 *
 * @package WooCommerce_CPanel_Account_Plugin
 */

namespace WooCommerce_CPanel_Account_Plugin;

/**
 * Admin class
 */
class Admin
{
    /**
     * Register settings
     */
    public function register_settings()
    {
        register_setting('woocommerce_cpanel_account_plugin_settings', 'woocommerce_cpanel_account_plugin_settings');
    }

    /**
     * Add hosting package field to product data
     */
    public function add_hosting_package_field()
    {
        global $post;

        $hosting_value = get_post_meta($post->ID, '_hosting_package', true);
        $hosting_package = isset($hosting_value) ? $hosting_value : '';

        echo '<div class="options_group">';
        woocommerce_wp_text_input(
            array(
                'id'          => '_hosting_package',
                'label'       => __('Hosting Package', 'woocommerce'),
                'placeholder' => 'Hosting Package',
                'desc_tip'    => 'true',
                'description' => __('Enter a hosting package value here.', 'woocommerce'),
                'value'       => $hosting_package
            )
        );
        echo '</div>';
    }

    /**
     * Save custom product field
     *
     * @param int $post_id Product ID.
     */
    public function save_custom_product_field($post_id)
    {
        $hosting_value = isset($_POST['_hosting_package']) ? sanitize_text_field($_POST['_hosting_package']) : '';
        update_post_meta($post_id, '_hosting_package', $hosting_value);
    }

    /**
     * Enqueue scripts
     */
    public function enqueue_scripts()
    {
        // Enqueue scripts and styles here
    }
}
