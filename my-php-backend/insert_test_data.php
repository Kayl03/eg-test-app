<?php
$host = 'localhost';
$dbname = 'Galeria';
$db_username = 'root';
$db_password = 'kylepogi';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // First, insert some service providers
    $serviceProviders = [
        ['John', 'Doe', 'john.doe@email.com', '09123456789', 'password123'],
        ['Jane', 'Smith', 'jane.smith@email.com', '09234567890', 'password123'],
        ['Mike', 'Johnson', 'mike.j@email.com', '09345678901', 'password123']
    ];

    $spStmt = $conn->prepare("INSERT INTO SERVICEPROVIDER (first_name, last_name, email, contact_number, password) VALUES (?, ?, ?, ?, ?)");
    
    foreach ($serviceProviders as $sp) {
        $spStmt->execute($sp);
    }

    // Then insert services for these providers
    $services = [
        // Photography services
        ['Photography', 'Wedding Photography', 'Professional wedding photography service with modern equipment', 15000, 4.8, 1],
        ['Photography', 'Portrait Photography', 'Professional portrait and headshot photography', 5000, 4.7, 1],
        ['Photography', 'Event Photography', 'Coverage for corporate events and parties', 8000, 4.6, 1],
        
        // Videography services
        ['Videography', 'Wedding Videography', 'Cinematic wedding video coverage', 20000, 4.9, 2],
        ['Videography', 'Corporate Video', 'Professional corporate video production', 12000, 4.5, 2],
        
        // Mixed services
        ['Photography', 'Product Photography', 'High-quality product photos for e-commerce', 3000, 4.4, 3],
        ['Videography', 'Music Video Production', 'Professional music video production', 25000, 4.8, 3]
    ];

    $serviceStmt = $conn->prepare("INSERT INTO SERVICES (category, service_name, description, price, rating, service_provider_id) VALUES (?, ?, ?, ?, ?, ?)");
    
    foreach ($services as $service) {
        $serviceStmt->execute($service);
    }

    echo "Test data inserted successfully!";

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
