<?php
session_set_cookie_params([
    'lifetime' => 3600,  // 1 hour
    'path' => '/',       // Allow access to the session from any page on your site
    'domain' => 'localhost',  // Match your local environment
    'secure' => false,  // Set to true if using HTTPS
    'httponly' => true   // Make the session cookie accessible only via HTTP(S)
]);

// Start the session after setting cookie parameters
session_start();

header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Credentials: true');  // Allow credentials (cookies)
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');


// Debugging: Log session info to PHP error log to track session status
error_log('Session data in getProfile.php: ' . print_r($_SESSION, true));

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    error_log("User not logged in, session ID: " . session_id());
    echo json_encode(["error" => "User not logged in"]);
    http_response_code(401);  // Unauthorized
    exit();
}

$host = 'localhost';
$dbname = 'Galeria';
$username = 'root';
$password = 'kylepogi';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userId = $_SESSION['user_id'];
    $sql = "SELECT CONCAT(first_name, ' ', last_name) AS name, email AS username FROM SERVICEPROVIDER WHERE ServiceProviderID = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($user);
    } else {
        error_log("User not found for user ID: " . $userId);
        echo json_encode(["error" => "User not found"]);
        http_response_code(404);  // Not found
    }
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
}
?>
