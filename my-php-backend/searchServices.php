<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$host = 'localhost';
$dbname = 'Galeria';
$db_username = 'root';
$db_password = 'kylepogi';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get search parameters
    $category = isset($_GET['category']) ? $_GET['category'] : null;
    $minPrice = isset($_GET['minPrice']) ? (float)$_GET['minPrice'] : null;
    $maxPrice = isset($_GET['maxPrice']) ? (float)$_GET['maxPrice'] : null;
    $minRating = isset($_GET['rating']) ? (float)$_GET['rating'] : null;
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : null;

    // Build the base query
    $query = "
        SELECT 
            s.ServicesID,
            s.SName,
            s.SPrice,
            sp.first_name,
            sp.last_name,
            sp.email,
            sp.ContactNum,
            sc.CategName,
            COALESCE(AVG(rr.Rating), 0) as AverageRating
        FROM SERVICES s
        LEFT JOIN SERVICEPROVIDER sp ON s.ServiceProviderID = sp.ServiceProviderID
        LEFT JOIN SERVICECATEG sc ON s.CategoryID = sc.CategoryID
        LEFT JOIN REVIEW_RATING rr ON sp.ServiceProviderID = rr.ServiceProviderID
    ";

    $conditions = [];
    $params = array();

    // Add search conditions
    if ($searchTerm) {
        $conditions[] = "(s.SName LIKE :search OR sp.first_name LIKE :search OR sp.last_name LIKE :search)";
        $params[':search'] = "%$searchTerm%";
    }

    if ($category) {
        $conditions[] = "sc.CategName = :category";
        $params[':category'] = $category;
    }

    if ($minPrice !== null) {
        $conditions[] = "s.SPrice >= :minPrice";
        $params[':minPrice'] = $minPrice;
    }

    if ($maxPrice !== null) {
        $conditions[] = "s.SPrice <= :maxPrice";
        $params[':maxPrice'] = $maxPrice;
    }

    // Add WHERE clause if there are conditions
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    // Group by to handle the AVG() function
    $query .= " GROUP BY s.ServicesID";

    // Add rating filter after GROUP BY
    if ($minRating !== null) {
        $query .= " HAVING AverageRating >= :minRating";
        $params[':minRating'] = $minRating;
    }

    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Format the results
    $formattedResults = array_map(function($row) {
        return [
            'id' => $row['ServicesID'],
            'name' => $row['SName'],
            'price' => (float)$row['SPrice'],
            'provider' => [
                'name' => $row['first_name'] . ' ' . $row['last_name'],
                'email' => $row['email'],
                'contact' => $row['ContactNum']
            ],
            'category' => $row['CategName'],
            'rating' => round((float)$row['AverageRating'], 1)
        ];
    }, $results);

    echo json_encode([
        'success' => true,
        'data' => $formattedResults
    ]);

} catch(PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
} catch(Exception $e) {
    error_log("General Error: " . $e->getMessage());
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
