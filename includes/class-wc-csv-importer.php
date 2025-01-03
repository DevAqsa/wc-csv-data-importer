<?php
if (!defined('ABSPATH')) {
    exit;
}

class WC_CSV_Importer {
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('init', array($this, 'init'));
    }
    
    public function init() {
        // Load text domain for translations
        load_plugin_textdomain('wc-csv-importer', false, dirname(plugin_basename(__FILE__)) . '/languages');
        
        // Initialize admin if in admin area
        if (is_admin()) {
            new WC_CSV_Importer_Admin();
        }
    }
}
