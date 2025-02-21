<?php
/**
 * Plugin Name: Murrelektronik WooCommerce Report
 * Description: A WooCommerce plugin that fetches sales data and stock level for a given SKU.
 * Version: 1.0.0
 * Author: Shaif Ahmed
 * License: GPL2
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin path
define('MURRELEKTRONIK_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Include necessary files
require_once MURRELEKTRONIK_PLUGIN_DIR . 'includes/ajax-handler.php';

// Add submenu in WooCommerce menu
function murrelektronik_add_admin_menu() {
    add_submenu_page(
        'woocommerce',
        'SKU Report',
        'SKU Report',
        'manage_woocommerce',
        'murrelektronik-sku-report',
        'murrelektronik_render_admin_page'
    );
}
add_action('admin_menu', 'murrelektronik_add_admin_menu');

// Render admin page
function murrelektronik_render_admin_page() {
    ?>
    <div class="wrap">
        <h2>SKU Sales & Stock Report</h2>
        <input type="text" id="sku_input" class="form-control w-25 d-inline-block" placeholder="Enter SKU">
        <button id="fetch_report" class="btn btn-primary">Get Report</button>
    </div>
    <div class="modal fade" id="skuReportModal" tabindex="-1" aria-labelledby="skuReportLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="skuReportLabel">Product Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Units Sold (7 days):</strong> <span id="units_sold"></span></p>
                    <p><strong>Stock Level:</strong> <span id="stock_level"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}


// Enqueue admin scripts and styles
function murrelektronik_enqueue_admin_scripts($hook) {
    if ($hook !== 'woocommerce_page_murrelektronik-sku-report') {
        return;
    }

    // Enqueue Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');

    // Enqueue Bootstrap JS (Requires jQuery)
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', ['jquery'], null, true);

    // Enqueue custom styles & script
    wp_enqueue_style('murrelektronik-admin-style', plugins_url('assets/admin-style.css', __FILE__));
    wp_enqueue_script('murrelektronik-admin-script', plugins_url('assets/admin-script.js', __FILE__), ['jquery'], null, true);

    wp_localize_script('murrelektronik-admin-script', 'murrelektronik_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('murrelektronik_nonce')
    ]);
}
add_action('admin_enqueue_scripts', 'murrelektronik_enqueue_admin_scripts');


