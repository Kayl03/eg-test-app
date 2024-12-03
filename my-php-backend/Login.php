<?php
// Enable error reporting
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

// Database connection
$host = 'localhost';
$dbname = 'Galeria';
$db_username = 'root';
$db_password = 'kylepogi';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the POST data
    $data = json_decode(file_get_contents("php://input"), true);
    error_log("Received login request: " . print_r($data, true));

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Collect form data
        $email = htmlspecialchars($data['email']);
        $password = $data['password'];

        // Prepare SQL query to check for existing user
        $stmt = $conn->prepare("SELECT * FROM SERVICEPROVIDER WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        error_log("Found user data: " . print_r($user, true));

        // Check if user exists and password matches
        if ($user && password_verify($password, $user['password'])) {
            // Set session variables after successful login
            $_SESSION['user_id'] = $user['ServiceProviderID'];
            $_SESSION['name'] = $user['first_name'] . ' ' . $user['last_name'];
            $_SESSION['email'] = $user['email'];
            
            error_log("Login successful. Session data: " . print_r($_SESSION, true));
            echo json_encode([
                "success" => true,
                "message" => "Login successful!",
                "user" => [
                    "name" => $_SESSION['name'],
                    "email" => $_SESSION['email']
                ]
            ]);
        } else {
            error_log("Login failed: Invalid credentials for email: " . $email);
            http_response_code(401);
            echo json_encode(["error" => "Invalid email or password"]);
        }
    }
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
}
?>
