<?php
// Включаем отображение ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== PHP Diagnostics ===\n";
echo "PHP Version: " . phpversion() . "\n";
echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "Script Name: " . $_SERVER['SCRIPT_NAME'] . "\n";
echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "\n";

echo "\n=== Session Test ===\n";
try {
    session_start();
    echo "Session started successfully\n";
    echo "Session ID: " . session_id() . "\n";
    echo "Session save path: " . session_save_path() . "\n";
} catch (Exception $e) {
    echo "Session error: " . $e->getMessage() . "\n";
}

echo "\n=== POST/GET Test ===\n";
echo "POST data: " . print_r($_POST, true) . "\n";
echo "GET data: " . print_r($_GET, true) . "\n";

echo "\n=== Headers Test ===\n";
try {
    header('Content-Type: text/plain');
    echo "Headers set successfully\n";
} catch (Exception $e) {
    echo "Headers error: " . $e->getMessage() . "\n";
}

echo "\n=== File Permissions Test ===\n";
echo "Current file: " . __FILE__ . "\n";
echo "File exists: " . (file_exists(__FILE__) ? 'Yes' : 'No') . "\n";
echo "File readable: " . (is_readable(__FILE__) ? 'Yes' : 'No') . "\n";
echo "Directory writable: " . (is_writable(dirname(__FILE__)) ? 'Yes' : 'No') . "\n";

echo "\n=== Memory & Limits ===\n";
echo "Memory limit: " . ini_get('memory_limit') . "\n";
echo "Max execution time: " . ini_get('max_execution_time') . "\n";
echo "Upload max filesize: " . ini_get('upload_max_filesize') . "\n";

echo "\n=== Extensions ===\n";
$extensions = ['curl', 'json', 'mbstring', 'openssl', 'pdo', 'session'];
foreach ($extensions as $ext) {
    echo "$ext: " . (extension_loaded($ext) ? 'Loaded' : 'Not loaded') . "\n";
}

echo "\n=== Test Complete ===\n";
?>
