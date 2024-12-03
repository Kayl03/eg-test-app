<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include 'db_connection.php';

$categoryName = isset($_GET['category']) ? $_GET['category'] : die(json_encode(['error' => 'No category provided']));

// Log the received category name
error_log("Received category: " . $categoryName);

$query = "SELECT sp.ServiceProviderID, sp.first_name, sp.last_name, 
                 CASE WHEN sp.ProfileImg IS NOT NULL THEN 'data:image/jpeg;base64,'.base64_encode(sp.ProfileImg) ELSE NULL END as ProfileImg, 
                 sp.average_rating, sp.total_reviews,
                 s.SName as ServiceName,
                 sc.CategName
          FROM SERVICEPROVIDER sp
          JOIN SERVICES s ON sp.ServicesID = s.ServicesID
          JOIN SERVICECATEG sc ON s.CategoryID = sc.CategoryID
          WHERE sc.CategName LIKE ?
          ORDER BY sp.average_rating DESC
          LIMIT 5";

$searchTerm = "%{$categoryName}%";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $searchTerm);
$stmt->execute();

// Check for query execution errors
if ($stmt->errno) {
    die(json_encode(['error' => $stmt->error]));
}

$result = $stmt->get_result();

// Check if any results were found
if ($result->num_rows === 0) {
    die(json_encode(['error' => 'No service providers found for this category', 'category' => $categoryName]));
}

$topProviders = [];
while ($row = $result->fetch_assoc()) {
    $topProviders[] = $row;
}

// Log the found providers
error_log("Found providers: " . json_encode($topProviders));

echo json_encode($topProviders);

$stmt->close();
$conn->close();
?>
