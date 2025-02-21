<?php
if (!defined('ABSPATH')) exit;

add_action('wp_ajax_fetch_product_data', 'murrelektronik_fetch_product_data');
function murrelektronik_fetch_product_data() {
    check_ajax_referer('murrelektronik_nonce', 'security');
    
    $sku = isset($_POST['sku']) ? sanitize_text_field($_POST['sku']) : '';
    if (!$sku) {
        wp_send_json_error(['message' => 'Invalid SKU']);
    }
    
    $product_id = wc_get_product_id_by_sku($sku);
    if (!$product_id) {
        wp_send_json_error(['message' => 'Product not found']);
    }
    
    $product = wc_get_product($product_id);
    $stock = $product->get_stock_quantity();
    
    $args = [
        'limit' => -1,
        'status' => 'completed',
        'date_after' => date('Y-m-d', strtotime('-7 days'))
    ];
    
    $orders = wc_get_orders($args);
    $units_sold = 0;
    foreach ($orders as $order) {
        foreach ($order->get_items() as $item) {
            if ($item->get_product_id() == $product_id) {
                $units_sold += $item->get_quantity();
            }
        }
    }
    
    wp_send_json_success([
        'units_sold' => $units_sold,
        'stock_level' => $stock
    ]);
}
