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

// Get JSON input and decode it
$data = json_decode(file_get_contents("php://input"), true);

// Validate inputs
$firstName = $data['firstName'] ?? '';
$location = $data['location'] ?? '';
$socialMedia = $data['socialMedia'] ?? '';
$aboutMe = $data['aboutMe'] ?? '';

if (empty($firstName) || empty($location) || empty($socialMedia) || empty($aboutMe)) {
    echo json_encode(["success" => false, "message" => "All fields are required."]);
    exit();
}

// Update profile in the database
try {
    $sql = "UPDATE ECLIENT
            SET 
                first_name = :first_name,
                Address = :Address,
                Weblink = :Weblink,
                Bio = :Bio
            WHERE ClientID = :ClientID";  // Use placeholders for dynamic data

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':first_name' => $firstName,
        ':Address' => $location,
        ':Weblink' => $socialMedia,
        ':Bio' => $aboutMe,
        ':ClientID' => 1  // Replace with the actual ClientID, e.g., from session or a request parameter
    ]);

    echo json_encode(["success" => true, "message" => "Profile updated successfully."]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error updating profile: " . $e->getMessage()]);
}
?>
