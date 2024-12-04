<?php
// Allow requests from any origin (adjust for production)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Database connection
$host = 'localhost';
$dbname = 'Galeria';
$db_username = 'root';
$db_password = 'kylepogi';

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get user ID from query parameter
    $userId = isset($_GET['userId']) ? $_GET['userId'] : null;

    if (!$userId) {
        throw new Exception('User ID is required');
    }

    // Prepare and execute query
    $stmt = $conn->prepare("SELECT first_name, last_name, email FROM SERVICEPROVIDER WHERE id = :userId");
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode([
            'success' => true,
            'data' => $user
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'User not found'
        ]);
    }

} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
} catch(Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
