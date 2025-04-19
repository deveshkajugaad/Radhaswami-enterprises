<?php
/**
 * Radhaswami Enterprises - Helper Functions
 * Includes database operations, security, and form handling
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Sanitize Input Data
 * @param string $data
 * @return string
 */
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Redirect to a URL
 * @param string $url
 */
function redirect($url) {
    header("Location: $url");
    exit;
}

/**
 * Display Error/Success Messages
 * @param string $message
 * @param string $type (error|success)
 */
function display_message($message, $type = 'error') {
    $class = ($type == 'error') ? 'alert-danger' : 'alert-success';
    return "<div class='alert $class'>$message</div>";
}

/**
 * Get Product Categories (from database)
 * @return array
 */
function get_product_categories() {
    global $conn;
    $categories = array();
    $sql = "SELECT * FROM categories ORDER BY name ASC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    return $categories;
}

/**
 * Get Products by Category
 * @param string $category_slug
 * @return array
 */
function get_products_by_category($category_slug) {
    global $conn;
    $products = array();
    $sql = "SELECT p.* FROM products p 
            JOIN categories c ON p.category = c.slug 
            WHERE c.slug = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category_slug);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}

/**
 * Handle File Upload (for Quotation Performa)
 * @param string $field_name
 * @return string|bool (returns file path or false)
 */
function handle_file_upload($field_name) {
    $upload_dir = 'uploads/quotations/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $allowed_types = ['application/pdf', 'image/jpeg', 'image/png'];
    $file = $_FILES[$field_name];

    // Check for errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    // Validate file type
    if (!in_array($file['type'], $allowed_types)) {
        return false;
    }

    // Validate file size (max 5MB)
    if ($file['size'] > 5 * 1024 * 1024) {
        return false;
    }

    // Generate unique filename
    $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $file_name = uniqid() . '.' . $file_ext;
    $file_path = $upload_dir . $file_name;

    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        return $file_path;
    }
    return false;
}

/**
 * Send Email Notification
 * @param string $to
 * @param string $subject
 * @param string $message
 * @return bool
 */
function send_email($to, $subject, $message) {
    $headers = "From: Radhaswami Enterprises <noreply@radhaswamienterprises.com>\r\n";
    $headers .= "Reply-To: info@radhaswamienterprises.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    return mail($to, $subject, $message, $headers);
}

/**
 * Get Brand List for a Category
 * @param string $category_slug
 * @return array
 */
function get_brands_by_category($category_slug) {
    global $conn;
    $brands = array();
    $sql = "SELECT DISTINCT p.brand FROM products p 
            JOIN categories c ON p.category = c.slug 
            WHERE c.slug = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category_slug);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $brands[] = $row['brand'];
        }
    }
    return $brands;
}

/**
 * Log Errors to a File
 * @param string $message
 */
function log_error($message) {
    $log_file = 'logs/error.log';
    $timestamp = date('Y-m-d H:i:s');
    $log_message = "[$timestamp] $message" . PHP_EOL;
    file_put_contents($log_file, $log_message, FILE_APPEND);
}

/**
 * Check if User is Logged In (for future admin panel)
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}