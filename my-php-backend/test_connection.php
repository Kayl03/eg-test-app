<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$port = 3306;
$dbname = 'Galeria';
$db_username = 'root';
$db_password = 'kylepogi';

try {
    $conn = new PDO("mysql:host=$host;port=$port", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully to MySQL server\n";
    
    // Check if database exists
    $stmt = $conn->query("SHOW DATABASES LIKE 'Galeria'");
    if ($stmt->rowCount() > 0) {
        echo "Database 'Galeria' exists\n";
        
        // Connect to the specific database
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $db_username, $db_password);
        
        // Check if tables exist
        $stmt = $conn->query("SHOW TABLES");
        echo "Tables in database:\n";
        while ($row = $stmt->fetch()) {
            echo "- " . $row[0] . "\n";
        }
    } else {
        echo "Database 'Galeria' does not exist\n";
    }
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
?>
