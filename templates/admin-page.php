<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="wrap wc-csv-importer">
    <h1><?php _e('WooCommerce CSV Importer', 'wc-csv-importer'); ?></h1>
    
    <?php
    // Handle form submission
    if (isset($_POST['submit']) && isset($_FILES['csv_file'])) {
        if (!wp_verify_nonce($_POST['wc_csv_nonce'], 'wc_csv_import')) {
            wp_die('Invalid nonce');
        }
        
        $handler = new WC_CSV_Importer_Handler();
        $result = $handler->handle_import($_FILES['csv_file']);
        
        if (is_wp_error($result)) {
            echo '<div class="error"><p>' . esc_html($result->get_error_message()) . '</p></div>';
        } else {
            echo '<div class="updated">';
            echo '<p>Import completed:</p>';
            echo '<ul>';
            echo '<li>Products imported: ' . esc_html($result['imported']) . '</li>';
            if (!empty($result['errors'])) {
                echo '<li>Errors encountered: ' . count($result['errors']) . '</li>';
                echo '<ul>';
                foreach ($result['errors'] as $error) {
                    echo '<li>' . esc_html($error) . '</li>';
                }
                echo '</ul>';
            }
            echo '</ul>';
            echo '</div>';
        }
    }
    ?>
    
    <div class="card">
        <h2><?php _e('Import Products', 'wc-csv-importer'); ?></h2>
        <form method="post" enctype="multipart/form-data">
            <?php wp_nonce_field('wc_csv_import', 'wc_csv_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="csv_file"><?php _e('Select CSV File', 'wc-csv-importer'); ?></label>
                    </th>
                    <td>
                        <input type="file" name="csv_file" id="csv_file" accept=".csv" required>
                        <p class="description">
                            <?php _e('CSV file should contain: name, price, description, sku, stock', 'wc-csv-importer'); ?>
                        </p>
                    </td>
                </tr>
            </table>
            <?php submit_button(__('Import Products', 'wc-csv-importer')); ?>
        </form>
    </div>
</div>