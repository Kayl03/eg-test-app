<?php
// Allow requests from any origin (adjust for production)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Start session
session_start();

// Database connection
$host = 'localhost';
$dbname = 'Galeria';
$db_username = 'root';  // Adjust to your DB credentials
$db_password = 'kylepogi';  // Adjust to your DB credentials

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
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

        // Check if user exists and password matches
        if ($user && password_verify($password, $user['password'])) {
            // Set session variables after successful login
            $_SESSION['user_id'] = $user['ServiceProviderID'];  // Store the user ID
            $_SESSION['name'] = $user['first_name'] . ' ' . $user['last_name'];  // Store the user's full name
            $_SESSION['email'] = $user['email'];  // Store the user's email
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
