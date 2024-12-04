<?php
// Allow requests from frontend origin
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');
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
$dbname = 'Galeria';
$db_username = 'root';
$db_password = 'kylepogi';

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
            // Set session variables
            $_SESSION['user_id'] = $user['ServiceProviderID'] ?? $user['ClientID'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_type'] = isset($user['ServiceProviderID']) ? 'provider' : 'client';
            
            // Return success response with user type
            echo json_encode([
                "success" => true,
                "message" => "Login successful",
                "user_type" => $_SESSION['user_type']
            ]);
        } else {
            http_response_code(401);
            echo json_encode([
                "success" => false,
                "message" => "Invalid email or password"
            ]);
        }
    }
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Database error: " . $e->getMessage()
    ]);
}