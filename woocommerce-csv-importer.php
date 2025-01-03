<?php
/**
 * Plugin Name: WooCommerce CSV Data Importer
 * Plugin URI: https://github.com/yourusername/woocommerce-csv-importer
 * Description: A simple plugin to import product data from CSV files into WooCommerce
 * Version: 1.0.0
 * Author: Aqsa Mumtaz
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wc-csv-importer
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.2
 */

if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('WC_CSV_IMPORTER_VERSION', '1.0.0');
define('WC_CSV_IMPORTER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WC_CSV_IMPORTER_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include required files
require_once WC_CSV_IMPORTER_PLUGIN_DIR . 'includes/class-wc-csv-importer.php';
require_once WC_CSV_IMPORTER_PLUGIN_DIR . 'includes/class-wc-csv-importer-admin.php';
require_once WC_CSV_IMPORTER_PLUGIN_DIR . 'includes/class-wc-csv-importer-handler.php';

// Initialize the plugin
function wc_csv_importer_init() {
    // Check if WooCommerce is active
    if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        add_action('admin_notices', 'wc_csv_importer_wc_missing_notice');
        return;
    }
    
    // Initialize main plugin class
    WC_CSV_Importer::get_instance();
}
add_action('plugins_loaded', 'wc_csv_importer_init');

// Admin notice for missing WooCommerce
function wc_csv_importer_wc_missing_notice() {
    ?>
    <div class="error">
        <p><?php _e('WooCommerce CSV Importer requires WooCommerce to be installed and active.', 'wc-csv-importer'); ?></p>
    </div>
    <?php
}