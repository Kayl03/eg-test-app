<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Database connection
$servername = "localhost";
$username = "root";
$password = "kylepogi";
$dbname = "Galeria";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header("Content-Type: application/json");

// Handle GET request: Fetch categories
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM SERVICECATEG";
    $result = $conn->query($sql);

    $categories = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    echo json_encode($categories);

}
// Handle POST request: Add category
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if all required fields are present
    if (isset($data['name'], $data['services'], $data['professionals'])) {
        $name = $data['name'];
        $services_count = (int)$data['services'];  // Cast to integer
        $professionals_count = (int)$data['professionals'];  // Cast to integer

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO SERVICECATEG (CategName, services_count, professionals_count) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $name, $services_count, $professionals_count);  // s = string, i = integer

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'error' => $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    }
}
// Handle DELETE request: Delete category
elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if the CategoryID is present
    if (isset($data['CategoryID'])) {
        $id = (int)$data['CategoryID'];  // Cast to integer to ensure it's numeric

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("DELETE FROM SERVICECATEG WHERE CategoryID = ?");
        $stmt->bind_param("i", $id);  // i = integer

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'error' => $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing CategoryID']);
    }
}

// Close the database connection
$conn->close();
?>
