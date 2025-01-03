<?php
if (!defined('ABSPATH')) {
    exit;
}

class WC_CSV_Importer_Admin {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }
    
    public function add_admin_menu() {
        add_submenu_page(
            'woocommerce',
            __('CSV Importer', 'wc-csv-importer'),
            __('CSV Importer', 'wc-csv-importer'),
            'manage_options',
            'wc-csv-importer',
            array($this, 'render_admin_page')
        );
    }
    
    public function enqueue_admin_scripts($hook) {
        if ('woocommerce_page_wc-csv-importer' !== $hook) {
            return;
        }
        
        wp_enqueue_style(
            'wc-csv-importer-admin',
            WC_CSV_IMPORTER_PLUGIN_URL . 'assets/css/admin.css',
            array(),
            WC_CSV_IMPORTER_VERSION
        );
        
        wp_enqueue_script(
            'wc-csv-importer-admin',
            WC_CSV_IMPORTER_PLUGIN_URL . 'assets/js/admin.js',
            array('jquery'),
            WC_CSV_IMPORTER_VERSION,
            true
        );
    }
    
    public function render_admin_page() {
        include WC_CSV_IMPORTER_PLUGIN_DIR . 'templates/admin-page.php';
    }
}
