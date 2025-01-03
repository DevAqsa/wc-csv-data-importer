# WooCommerce CSV Importer

A simple WordPress plugin that allows you to import product data into WooCommerce using CSV files.

## Features

- Easy-to-use interface in WooCommerce admin menu
- Support for basic product data import
- Secure file upload handling
- Basic error reporting
- Supports the following product fields:
  - Name
  - Price
  - Description
  - SKU
  - Stock quantity

## Requirements

- WordPress 5.0 or higher
- WooCommerce 5.0 or higher
- PHP 7.2 or higher

## Installation

1. Download the plugin zip file
2. Go to WordPress admin > Plugins > Add New
3. Click "Upload Plugin" and select the downloaded zip file
4. Activate the plugin after installation

## Usage

1. Go to WooCommerce > CSV Importer in your WordPress admin panel
2. Upload your CSV file using the provided form
3. Click "Import Products" to start the import process

### CSV Format

Your CSV file should have the following columns:
```
name,price,description,sku,stock
```

Example:
```
name,price,description,sku,stock
Test Product,19.99,This is a test product,TST001,10
```

## Development

### Contributing

1. Fork the repository
2. Create a new branch for your feature
3. Submit a pull request



## License

This project is licensed under the GPL v2 or later - see the [LICENSE](LICENSE) file for details.

## Support

For support, please [open an issue](https://github.com/yourusername/woocommerce-csv-importer/issues) on GitHub.