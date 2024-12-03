<?php
// Allow requests from any origin (adjust for production)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
// Start session
session_start();

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Database connection
$host = 'localhost';
$port = 4306; // XAMPP MySQL port
$dbname = 'EGDB';
$db_username = 'root';
$db_password = 'galeria';

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Get the POST data
    $data = json_decode(file_get_contents("php://input"), true);
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Collect form data
        $email = htmlspecialchars($data['email']);
        $password = $data['password'];
        
        // Prepare SQL query to check for existing user
        $stmt = $conn->prepare("SELECT * FROM SERVICEPROVIDER WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // If not found in SERVICEPROVIDER, check CLIENT table
        if (!$user) {
            $stmt = $conn->prepare("SELECT * FROM CLIENT WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        // Check if user exists and password matches
        if ($user && password_verify($password, $user['password'])) {
            // Determine which table the user is from
            $isServiceProvider = isset($user['ServiceProviderID']);
            
            // Set session variables after successful login
            $_SESSION['user_id'] = $isServiceProvider ? $user['ServiceProviderID'] : $user['ClientID'];
            $_SESSION['name'] = $user['first_name'] . ' ' . $user['last_name'];
            $_SESSION['email'] = $user['email'];
            echo json_encode(["message" => "Login successful!", "redirect" => "/homepage"]);
        } else {
            echo json_encode(["error" => "Invalid email or password."]);
        }
        
    }
} catch (PDOException $e) {
    // Handle connection failure
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
}
?>