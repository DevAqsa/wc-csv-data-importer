<?php
if (!defined('ABSPATH')) {
    exit;
}

class WC_CSV_Importer_Handler {
    
    public function handle_import($file) {
        // Add error logging
        error_log('Starting CSV import process');
        
        if (!current_user_can('manage_options')) {
            error_log('Permission denied for CSV import');
            return new WP_Error('permission_denied', __('You do not have permission to import products.', 'wc-csv-importer'));
        }
        
        // Check if file exists and is valid
        if (!isset($file['tmp_name']) || !file_exists($file['tmp_name'])) {
            error_log('No file uploaded or file does not exist');
            return new WP_Error('file_error', 'No file uploaded or file does not exist');
        }
        
        // Log file details
        error_log('File details: ' . print_r($file, true));
        
        try {
            $handle = fopen($file['tmp_name'], 'r');
            if ($handle === false) {
                error_log('Could not open file');
                return new WP_Error('file_error', 'Could not open file');
            }
            
            $header = fgetcsv($handle);
            error_log('CSV Headers: ' . print_r($header, true));
            
            $imported = 0;
            $errors = array();
            
            while (($data = fgetcsv($handle)) !== FALSE) {
                error_log('Processing row: ' . print_r($data, true));
                $result = $this->import_product($header, $data);
                if (is_wp_error($result)) {
                    $errors[] = $result->get_error_message();
                    error_log('Import error: ' . $result->get_error_message());
                } else {
                    $imported++;
                }
            }
            
            fclose($handle);
            
            error_log("Import completed. Imported: $imported, Errors: " . count($errors));
            
            return array(
                'imported' => $imported,
                'errors' => $errors
            );
            
        } catch (Exception $e) {
            error_log('Exception during import: ' . $e->getMessage());
            return new WP_Error('import_error', $e->getMessage());
        }
    }

    private function import_product($header, $data) {
        try {
            $product_data = array_combine($header, $data);
            
            $product = new WC_Product_Simple();
            $product->set_name($product_data['name']);
            $product->set_regular_price($product_data['price']);
            $product->set_description($product_data['description']);
            $product->set_sku($product_data['sku']);
            $product->set_stock_quantity($product_data['stock']);
            $product->set_stock_status($product_data['stock'] > 0 ? 'instock' : 'outofstock');
            
            $product->save();
            return true;
        } catch (Exception $e) {
            return new WP_Error('import_error', $e->getMessage());
        }
    }
}