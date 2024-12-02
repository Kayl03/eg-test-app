<?php
header('Content-Type: application/json');

// Database connection
$host = 'localhost';
$dbname = 'galeria';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $e->getMessage()]);
    exit();
}

// Fetch profile data
try {
    $sql = "SELECT 
            first_name AS FIRSTNAME, 
            Address AS ADDRESS, 
            Bio AS ABOUT ME,
            Weblink AS SOCIAL MEDIA, 
            FROM ECLIENT 
            WHERE ClientID = :ClientID";
    
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([':userId' => 1]);  // Example userId, replace with actual user identifier
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result ? ["success" => true, "data" => $result] : ["success" => false, "message" => "Profile not found."]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error fetching profile: " . $e->getMessage()]);
}
?>
