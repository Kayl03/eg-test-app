<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// For development only - handle CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: http://localhost:5173');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Accept');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    die();
}

header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

// Set session cookie parameters
session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => 'localhost',
    'secure' => false,
    'httponly' => true
]);

// Start session
session_start();

// Debug session info
error_log("Session ID: " . session_id());
error_log("Session data: " . print_r($_SESSION, true));

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    error_log("User not logged in. Session data: " . print_r($_SESSION, true));
    http_response_code(401);
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

// Database connection
$host = 'localhost';
$dbname = 'Galeria';
$username = 'root';
$password = 'kylepogi';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userId = $_SESSION['user_id'];
    error_log("Fetching data for user ID: " . $userId);
    
    // Fetch user data from the SERVICEPROVIDER table
    $stmt = $conn->prepare("SELECT first_name, last_name, email FROM SERVICEPROVIDER WHERE ServiceProviderID = :user_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $response = [
            "name" => $row['first_name'] . ' ' . $row['last_name'],
            "email" => $row['email']
        ];
        error_log("Found user data: " . print_r($response, true));
        echo json_encode($response);
    } else {
        error_log("No user found for ID: " . $userId);
        http_response_code(404);
        echo json_encode(["error" => "User not found"]);
    }

} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}
?>
