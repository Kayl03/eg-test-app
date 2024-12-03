<?php
session_start();

header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "Not logged in"]);
    exit();
}

$host = 'localhost';
$port = 4306; // XAMPP MySQL port
$dbname = 'Galeria';
$username = 'root';
$password = 'kylepogi';

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // First try SERVICEPROVIDER table
    $stmt = $conn->prepare("SELECT first_name, last_name, email FROM SERVICEPROVIDER WHERE ServiceProviderID = :id");
    $stmt->bindParam(':id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // If not found, try CLIENT table
        $stmt = $conn->prepare("SELECT first_name, last_name, email FROM CLIENT WHERE ClientID = :id");
        $stmt->bindParam(':id', $_SESSION['user_id']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    if ($user) {
        echo json_encode([
            "name" => $user['first_name'] . ' ' . $user['last_name'],
            "email" => $user['email']
        ]);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "User not found"]);
    }
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Database error"]);
}
?>
