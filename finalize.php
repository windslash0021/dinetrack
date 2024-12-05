<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_SESSION['client_id'];
    $service_id = $_SESSION['service_id'];
    $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : null;
    $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : null;
    $street_name = isset($_POST['street_name']) ? $_POST['street_name'] : null;
    $barangay = isset($_POST['barangay']) ? $_POST['barangay'] : null;
    $city = isset($_POST['city']) ? $_POST['city'] : null;
    $region = isset($_POST['region']) ? $_POST['region'] : null;
    
    if (empty($latitude) && empty($longitude) && empty($street_name) && empty($city) && empty($region)) {
        die("Location is empty.");
    }
    
    // Prepare the SQL statement to insert a new location
    $stmt = $conn->prepare("
        INSERT INTO client_locations (client_id, street_name, region, city, barangay, latitude, longitude)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("issssss", $client_id, $street_name, $region, $city, $barangay, $latitude, $longitude);

    // Execute the query and handle the result
    if ($stmt->execute()) {
        header("Location: confirmation.php?street_name=" . urlencode($street_name) .
            "&barangay=" . urlencode($barangay) .
            "&city=" . urlencode($city) .
            "&region=" . urlencode($region) .
            "&latitude=" . urlencode($latitude) .
            "&longitude=" . urlencode($longitude));
        exit();
    } else {
        die("Error saving location: " . $stmt->error);
    }
}
?>