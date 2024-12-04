<?php
// Allow requests from any origin
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

session_start(); // Start or resume the session

// Database connection
$host = 'localhost';
$dbname = 'Galeria';
$username = 'root';  // Adjust to your DB credentials
$password = 'kylepogi';  // Adjust to your DB credentials

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
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

        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['ServiceProviderID']; // Store the user ID
            $_SESSION['name'] = $user['first_name'] . ' ' . $user['last_name']; // Store the user's full name
            $_SESSION['email'] = $user['email']; // Store the user's email
            echo json_encode(["message" => "Login successful!", "redirect" => "/homepage"]);
        } else {
            echo json_encode(["error" => "Invalid email or password."]);
        }
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
}
?>
