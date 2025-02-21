# Murrelektronik WooCommerce Report

## Description
**Murrelektronik WooCommerce Report** is a custom WooCommerce plugin that allows store admins to check the sales data and stock level of a product by entering its SKU. The plugin provides a user-friendly interface within the WooCommerce admin panel and displays results in a Bootstrap modal popup.

## Features
- **Search by SKU**: Enter an SKU to fetch data.
- **Units Sold (Last 7 Days)**: Retrieves the total number of units sold in the past week.
- **Current Stock Level**: Displays the available inventory for the given SKU.
- **AJAX-based**: Ensures smooth, real-time data retrieval.
- **Bootstrap Modal Popup**: Presents data in an interactive modal popup.
- **Secure & Optimized**: Uses WordPress & WooCommerce best practices for security and performance.

---

## Installation
### **Step 1: Upload & Activate the Plugin**
1. Download the plugin files and extract them.
2. Upload the `murrelektronik-woo-plugin` folder to `/wp-content/plugins/`.
3. Go to **WordPress Admin → Plugins**.
4. Activate **Murrelektronik WooCommerce Report**.

### **Step 2: Ensure WooCommerce is Installed**
- This plugin **requires WooCommerce** to function properly.
- Ensure you have WooCommerce installed and activated.

---

## Usage
1. Navigate to **WooCommerce → SKU Report** in the admin panel.
2. Enter a valid **Product SKU** in the input field.
3. Click the **"Get Report"** button.
4. A Bootstrap modal popup will appear showing:
   - **Units Sold in Last 7 Days**
   - **Current Stock Level**

---

## Technical Details
### **File Structure**
```
murrelektronik-woo-plugin/
│── includes/
│   ├── ajax-handler.php      # Handles AJAX requests to fetch product data
│── assets/
│   ├── admin-script.js       # JavaScript for frontend interactions
│   ├── admin-style.css       # Styling for the admin panel
│── murrelektronik-woo-plugin.php  # Main plugin file
│── README.md                 # Documentation
```

### **Hooks Used**
- `admin_menu`: Adds a submenu item in WooCommerce admin.
- `admin_enqueue_scripts`: Loads CSS & JS files in the admin panel.
- `wp_ajax_fetch_product_data`: Handles AJAX requests for product data.

### **WooCommerce Functions Used**
- `wc_get_product_id_by_sku()`: Gets the product ID from SKU.
- `wc_get_product()`: Fetches product details.
- `wc_get_orders()`: Queries orders to calculate units sold.

---

## Troubleshooting
### **Issue: SKU Not Found**
- Ensure the SKU entered **exists** in WooCommerce.
- Check that the **product is published** and not in draft mode.

### **Issue: No Sales Data**
- The product **may not have been sold** in the past 7 days.
- Try **another SKU** with recent sales.

### **Issue: Modal Popup Not Opening**
- Ensure **JavaScript is enabled** in the browser.
- Check for console errors in **Developer Tools (F12 → Console)**.

---

## Future Enhancements
- ✅ Add a date range selector instead of a fixed 7-day period.
- ✅ Implement caching for improved performance.
- ✅ Provide export functionality for reports.

---

## License
This plugin is licensed under **GPL-2.0 or later**.

---

## Author
Developed by **Shaif Ahmed**.

For support or feature requests, contact: **shaifjagirdar@gmail.com**
