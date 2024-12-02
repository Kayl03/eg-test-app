<?php
// Database connection details
$host = 'localhost';
$dbname = 'Galeria';
$username = 'root';
$password = 'kylepogi';


// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CORS headers
header("Access-Control-Allow-Origin: *"); // Allow requests from any origin
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allow specific methods
header("Access-Control-Allow-Headers: Content-Type"); // Allow specific headers


try {
    // Create a new PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
    exit();
}

// Get the JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Initialize an array for parameters and the base query
$params = [];
$sql = "SELECT 
    sp.first_name AS FIRSTNAME,
    sp.last_name AS LASTNAME,
    COALESCE(sp.Bio, '') AS BIO,  
    s.SName AS SERVICES,
    s.SPrice AS PRICE,
    COALESCE(rr.Rating, 0) AS RATING  -- Use COALESCE to handle NULL values
FROM SERVICES s
LEFT JOIN SERVICEPROVIDER sp ON s.ServiceProviderID = sp.ServiceProviderID
LEFT JOIN SERVICECATEG sc ON s.CategoryID = sc.CategoryID
LEFT JOIN REVIEW_RATING rr ON s.RevRateID = rr.RevRateID
WHERE 1=1"; // Start with WHERE clause for dynamic conditions

// Dynamically build the query based on user input

// Price Filter
if (isset($data['minPrice']) && is_numeric($data['minPrice'])) {
    $minPrice = floatval($data['minPrice']);
    $sql .= " AND s.SPrice >= ?";
    $params[] = $minPrice;
}

if (isset($data['maxPrice']) && is_numeric($data['maxPrice'])) {
    $maxPrice = floatval($data['maxPrice']);
    $sql .= " AND s.SPrice <= ?";
    $params[] = $maxPrice;
}

// Rating Filter
if (isset($data['minRating']) && is_numeric($data['minRating'])) {
    $minRating = floatval($data['minRating']);
    $sql .= " AND COALESCE(rr.Rating, 0) >= ?"; // Ensure to check for COALESCE
    $params[] = $minRating;
}

// Category Filter
if (isset($data['category']) && is_array($data['category']) && !empty($data['category'])) {
    $placeholders = implode(',', array_fill(0, count($data['category']), '?'));
    $sql .= " AND sc.CategName IN ($placeholders)";
    $params = array_merge($params, $data['category']);
}

// Search Term Filter
if (!empty($data['searchTerm'])) {
    $searchTerm = "%" . $data['searchTerm'] . "%"; // Use wildcards for partial matching
    $sql .= " AND s.SName LIKE ?"; // Assuming you are searching by service name
    $params[] = $searchTerm; // Add the search term to the parameters
}

// Ensure ORDER BY clause is added correctly
$sql .= " GROUP BY sp.ServiceProviderID ORDER BY s.SPrice ASC"; // Group by provider ID to get unique entries

// Prepare the statement


// Log the constructed SQL query and parameters for debugging
error_log("Constructed SQL: $sql");
error_log("Parameters: " . json_encode($params));

// Execute the statement with the parameters

// Return the results in JSON format

