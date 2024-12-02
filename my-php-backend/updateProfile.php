<?php
session_start();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

$host = 'localhost';
$dbname = 'Galeria';
$username = 'root'; 
$password = 'kylepogi';  

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // Debug the session data
        error_log("Session email: " . $_SESSION['email']);
    
        $stmt = $conn->prepare("SELECT * FROM SERVICEPROVIDER WHERE ServiceProviderID = :id");
        $stmt->bindParam(':id', $_SESSION['user_id']);
        $stmt->execute();
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            // Return the user's profile, including the email from the session
            echo json_encode([
                "name" => $user['first_name'] . ' ' . $user['last_name'],
                "email" => $_SESSION['email'],  // Email from session
                "location" => $user['location'],
                "memberSince" => $user['created_at'],
                "socialMedia" => [
                    "facebook" => isset($user['facebook']) ? $user['facebook'] : '',
                    "mail" => isset($user['mail']) ? $user['mail'] : '',
                    "instagram" => isset($user['instagram']) ? $user['instagram'] : ''
                ]
            ]);
        } else {
            echo json_encode(["error" => "User not found."]);
        }
    } else {
        echo json_encode(["error" => "User is not logged in."]);
    }
    
} catch (PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
}
?>
