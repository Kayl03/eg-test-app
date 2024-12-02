<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$host = 'localhost';
$dbname = 'Galeria';
$username = 'root';  
$password = 'kylepogi';      // Ensure this is your actual DB password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = json_decode(file_get_contents("php://input"), true);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $firstName = htmlspecialchars($data['first_name']);  
        $lastName = htmlspecialchars($data['last_name']);    
        $email = htmlspecialchars($data['email']);
        $birthday = htmlspecialchars($data['birthday']);
        $password = password_hash($data['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO SERVICEPROVIDER (first_name, last_name, email, birthday, password) 
                VALUES (:first_name, :last_name, :email, :birthday, :password)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            // Start a session and store user data
            $userId = $conn->lastInsertId();
            $_SESSION['user_id'] = $userId; // Store the user's ID in the session

            echo json_encode(["message" => "Registration successful!", "redirect" => "/login"]);
        } else {
            echo json_encode(["error" => "Failed to register. Try again."]);
        }
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
}
?>
