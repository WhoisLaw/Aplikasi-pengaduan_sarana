<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>Vercel PHP Health Check</h1>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";

require_once 'config/database.php';

try {
    $database = new Database();
    echo "<h2>Environment Variables:</h2>";
    echo "DATABASE_URL: " . (getenv('DATABASE_URL') ? 'SET' : 'NOT SET') . "<br>";
    echo "DB_SSL: " . (getenv('DB_SSL') ?: 'NOT SET') . "<br>";
    echo "DB_SSL_CA: " . (getenv('DB_SSL_CA') ? 'SET (length: ' . strlen(getenv('DB_SSL_CA')) . ')' : 'NOT SET') . "<br>";

    // We won't actually connect here to avoid exposing credentials if it fails
    // but we can check if the class instantiates and parses correctly
    echo "<h2>Database Config Parsing:</h2>";
    $reflection = new ReflectionClass($database);
    $props = ['host', 'db', 'user', 'port'];
    foreach ($props as $p) {
        $prop = $reflection->getProperty($p);
        $prop->setAccessible(true);
        echo "$p: " . $prop->getValue($database) . "<br>";
    }

    echo "Temp Dir: " . sys_get_temp_dir() . "<br>";
    echo "Is Temp Writable: " . (is_writable(sys_get_temp_dir()) ? 'YES' : 'NO') . "<br>";

    echo "<h2>Attempting Connection...</h2>";
// $db = $database->connect();
// echo "Connection Successful!";
}
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
