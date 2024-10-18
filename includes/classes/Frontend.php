<?php
/**
 * Frontend class
 *
 * @package WooCommerce_CPanel_Account_Plugin
 */

namespace WooCommerce_CPanel_Account_Plugin;

/**
 * Frontend class
 */
class Frontend
{
    /**
     * Create cPanel account
     *
     * @param int $order_id Order ID.
     */
    public function create_cpanel_account($order_id)
    {
        if (!$order_id) {
            return;
        }

        $order = wc_get_order($order_id);
        if (!$order) {
            return;
        }

        $whm_account_created = get_option('whm_account' . $order_id);
        if ($whm_account_created) {
            return;
        }

        $payment_slug = $order->get_payment_method();

        foreach ($order->get_items() as $item_id => $item) {
            $product = $item->get_product();
            if ($product) {
                $plan = 'default';
                $product_name = $product->get_name();
                if (str_contains($product_name, ' - ')) {
                    $name_parts = explode(' - ', $product_name);
                    $product_name = $name_parts[0];
                }
                $product_id = $this->get_product_id_by_name($product_name);
                $hosting_value = get_post_meta($product_id, '_hosting_package', true);
                if (isset($hosting_value)) {
                    $plan = $hosting_value;
                }

                // Create cPanel account
                $this->create_account($order, $plan);

                // Handle account suspension/unsuspension
                $action = 'suspendacct';
                if (str_contains($payment_slug, 'strip') && !str_contains($payment_slug, 'sepa')) {
                    $action = 'unsuspendacct';
                }
                $this->suspend_unsuspend_account($order, $action);

                update_option('whm_account' . $order_id, 1);
            }
        }
    }

    /**
     * Handle order status change
     *
     * @param int    $order_id     Order ID.
     * @param string $old_status   Old order status.
     * @param string $new_status   New order status.
     * @param object $order        Order object.
     */
    public function handle_order_status_change($order_id, $old_status, $new_status, $order)
    {
        $order = wc_get_order($order_id);
        if (!$order) {
            return;
        }

        $action = 'suspendacct';
        if (str_contains($new_status, 'comp')) {
            $action = 'unsuspendacct';
        }

        $this->suspend_unsuspend_account($order, $action);
    }

    /**
     * Get product ID by name
     *
     * @param string $product_name Product name.
     * @return int Product ID.
     */
    private function get_product_id_by_name($product_name)
    {
        $product_id = 0;
        $arg_query = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            's'              => $product_name,
        );
        $single_product = get_posts($arg_query);
        if ($single_product) {
            $product_id = $single_product[0]->ID;
        }
        return $product_id;
    }

    /**
     * Create cPanel account
     *
     * @param WC_Order $order Order object.
     * @param string   $plan  Hosting package.
     */
    private function create_account($order, $plan)
    {
        $user_name = $order->get_billing_first_name() . $order->get_billing_last_name();
        $first_name = $order->get_billing_first_name();
        $last_name = $order->get_billing_last_name();
        $domain = strtolower($user_name) . '.' . $_SERVER['HTTP_HOST'];
        $domain_name = get_option('domain_value');
        if (isset($domain_name) && $domain_name != 0) {
            $domain = $domain_name;
            update_option('domain_value', 0);
        }
        $domain = 'www.' . $domain;
        $password = wp_generate_password();
        $email = $order->get_billing_email();
        $user_name = strtolower($user_name);

        $api_url = "https://cube.macbay.net:2087/json-api/createacct?api.version=2&maxaddon=10&username=$user_name&domain=$domain&password=$password&contactemail=$email&plan=$plan&quota=2048";

        $response = wp_remote_post($api_url, array(
            'headers' => array(
                'Authorization' => 'Basic ' . base64_encode('root:rootpasswordhidden'),
            ),
            'method'      => 'POST',
            'timeout'     => 45,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking'    => true,
        ));

        if (is_wp_error($response)) {
            // Handle error
        } else {
            $body = wp_remote_retrieve_body($response);
            $result_data = json_decode($body);
            $result = $result_data->metadata->result;
            $reason = $result_data->metadata->reason;
            $reason = strtolower($reason);

            if (str_contains($reason, 'already exists in')) {
                echo "<div class='custom-notification' id='custom-notification'>The domain \"$domain\" already exists.</div>";
            }

            $order->update_meta_data('whm_user_name', $user_name);
            $order->update_meta_data('whm_password', $password);
            $order->update_meta_data('whm_domain', $domain);
            $order->update_meta_data('whm_status', $reason);
            $order->save();
        }
    }

    /**
     * Suspend or unsuspend cPanel account
     *
     * @param WC_Order $order  Order object.
     * @param string   $action Action to perform (suspendacct or unsuspendacct).
     */
    private function suspend_unsuspend_account($order, $action)
    {
        $whm_user = 'root';
        $whm_pass = 'rootpasswordhidden';
        $user_name = $order->get_meta('whm_user_name');
        $user_name = strtolower($user_name);

        $api_url = "https://cube.macbay.net:2087/json-api/$action?api.version=1&user=$user_name";

        $response = wp_remote_post($api_url, array(
            'headers' => array(
                'Authorization' => 'Basic ' . base64_encode($whm_user . ':' . $whm_pass),
            ),
            'method'      => 'POST',
            'timeout'     => 45,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking'    => true,
        ));

        if (is_wp_error($response)) {
            // Handle error
        } else {
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body);
            // Handle response
        }
    }
}
