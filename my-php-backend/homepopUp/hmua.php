<?php

// Handle OPTIONS requests (preflight requests)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Adjust this as needed for CORS

// Database credentials
$host = 'localhost';
$dbname = 'galeria';
$username = 'root';
$password = '';

try {
    // Establish a connection to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Step 1: Get the CategoryID and name for "Make-Up Artists" from servicecateg
    $categoryStmt = $pdo->prepare('
        SELECT CategoryID, CategName 
        FROM servicecateg 
        WHERE CategName = "Make-Up Artists"');
    $categoryStmt->execute();
    $category = $categoryStmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$category) {
        echo json_encode(['error' => 'Category "Make-Up Artists" not found']);
        exit;
    }

    // SQL query to get the top 5 most rated service providers in "Make-Up Artists"
    $stmt = $pdo->prepare("
        SELECT 
            serviceprovider.ServiceProviderID,
            serviceprovider.first_name, 
            serviceprovider.last_name, 
            serviceprovider.ProfileImg, 
            AVG(review_rating.Rating) AS average_rating, 
            COUNT(review_rating.Rating) AS total_ratings
        FROM serviceprovider
        LEFT JOIN services ON serviceprovider.ServiceProviderID = services.ServiceProviderID
        LEFT JOIN review_rating ON serviceprovider.ServiceProviderID = review_rating.ServiceProviderID
        WHERE services.CategoryID = :categoryID
        GROUP BY serviceprovider.ServiceProviderID
        HAVING total_ratings > 0  
        ORDER BY average_rating DESC
        LIMIT 5
    ");

    // Bind the CategoryID to the query
    $stmt->bindParam(':categoryID', $category['CategoryID'], PDO::PARAM_INT);
    $stmt->execute();

    // Fetch results
    $providers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($providers) {
        // Map the data to the desired structure
        $formattedProviders = array_map(function($provider) use ($category) {
            return [
                'firstName' => $provider['first_name'],
                'lastName' => $provider['last_name'],
                'rating' => round($provider['average_rating'], 2),
                'imageUrl' => $provider['ProfileImg'] ?? '/path/to/placeholder-image.jpg',
                'slug' => strtolower(str_replace(' ', '-', $provider['first_name'] . '-' . $provider['last_name'])),
                'totalRatings' => $provider['total_ratings'],
                'categoryName' => $category['CategName'] // Include the category name here
            ];
        }, $providers);

        echo json_encode($formattedProviders);
    } else {
        echo json_encode(['message' => 'No providers found under "Make-Up Artists"']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
