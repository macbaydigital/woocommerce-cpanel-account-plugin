<?php
/**
 * Storage class
 *
 * @package WooCommerce_CPanel_Account_Plugin
 */

namespace WooCommerce_CPanel_Account_Plugin;

/**
 * Storage class
 */
class Storage
{
    /**
     * Add storage to an order
     *
     * @param int   $order_id Order ID.
     * @param int   $storage  Storage amount in MB.
     * @param float $price    Price for the storage.
     */
    public static function add_storage_to_order($order_id, $storage, $price)
    {
        $order = wc_get_order($order_id);
        if (!$order) {
            return;
        }

        $item_name = sprintf(__('Additional Storage (%s MB)', 'woocommerce-cpanel-account-plugin'), $storage);
        $item_data = array(
            'name'     => $item_name,
            'amount'   => $price,
            'quantity' => 1,
        );

        $item_id = $order->add_fee($item_data);
        $order->calculate_totals();
    }
}
