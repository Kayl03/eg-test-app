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
    
    // Get the CategoryID for "Photo and Video Production" from servicecateg
    $categoryStmt = $pdo->prepare('
        SELECT CategoryID 
        FROM servicecateg 
        WHERE CategName = "Photo & Video Production"');
    $categoryStmt->execute();
    $category = $categoryStmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$category) {
        echo json_encode(['error' => 'Category "Photo & Video Production" not found']);
        exit;
    }

    // Get the ServicesID and ServiceName for all subcategories in "Photo and Video Production"
    $servicesStmt = $pdo->prepare('
        SELECT ServicesID, SName
        FROM services 
        WHERE CategoryID = :categoryID
    ');
    $servicesStmt->bindParam(':categoryID', $category['CategoryID'], PDO::PARAM_INT);
    $servicesStmt->execute();
    $services = $servicesStmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Fetches all ServiceProviderID based on subcategories
    $serviceProviderIDs = array_column($services, 'ServicesID');
    if (empty($serviceProviderIDs)) {
        echo json_encode(['message' => 'No service providers found under "Photo and Video Production"']);
        exit;
    }
    $placeholders = str_repeat('?,', count($serviceProviderIDs) - 1) . '?';
    
    // SQL query to get the top 5 most rated service providers, including their services
    $stmt = $pdo->prepare("
        SELECT 
            serviceprovider.ServiceProviderID,
            serviceprovider.first_name, 
            serviceprovider.last_name, 
            serviceprovider.ProfileImg, 
            services.SName AS serviceName, 
            AVG(review_rating.Rating) AS average_rating, 
            COUNT(review_rating.Rating) AS total_ratings
        FROM serviceprovider
        LEFT JOIN services ON serviceprovider.ServiceProviderID = services.ServiceProviderID
        LEFT JOIN review_rating ON serviceprovider.ServiceProviderID = review_rating.ServiceProviderID
        WHERE services.ServicesID IN ($placeholders)
        GROUP BY 
            serviceprovider.ServiceProviderID,
            serviceprovider.first_name,
            serviceprovider.last_name,
            serviceprovider.ProfileImg,
            services.SName
        HAVING total_ratings > 0  -- Ensure at least one rating
        ORDER BY average_rating DESC
        LIMIT 5
    ");
    
    // Bind the service provider IDs to the query
    $stmt->execute($serviceProviderIDs);
    
    // Fetch results
    $providers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Check if data exists
    if ($providers) {
        // Map the data to the desired structure
        $formattedProviders = array_map(function($provider) {
            return [
                'firstName' => $provider['first_name'],
                'lastName' => $provider['last_name'],
                'service' => $provider['serviceName'], // Include the service/subcategory name
                'rating' => round($provider['average_rating'], 2), // Round to 2 decimal places
                'imageUrl' => $provider['ProfileImg'] ? "/images/{$provider['ServiceProviderID']}.jpg" : '/path/to/placeholder-image.jpg', // Adjust image path
                'slug' => strtolower(str_replace(' ', '-', $provider['first_name'] . '-' . $provider['last_name'])), // Generate a slug
                'totalRatings' => $provider['total_ratings'] // Include total number of ratings
            ];
        }, $providers);
        
        // Send the formatted data as JSON
        echo json_encode($formattedProviders);
    } else {
        echo json_encode(['message' => 'No providers found under "Photo and Video Production"']);
    }
} catch (PDOException $e) {
    // If there's a database error
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
