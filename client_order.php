<?php
include 'connection.php';

// Validate service_id from URL
if (!isset($_GET['service_id']) || empty($_GET['service_id'])) {
    die("Error: Service ID is missing in the URL.");
}
$service_id = intval($_GET['service_id']); // Sanitize service_id

// Check if the service_id exists
$service_check_query = "SELECT * FROM services WHERE service_id = ?";
$service_check_stmt = $conn->prepare($service_check_query);
$service_check_stmt->bind_param("i", $service_id);
$service_check_stmt->execute();
$service_result = $service_check_stmt->get_result();
if ($service_result->num_rows === 0) {
    die("Error: Invalid Service ID.");
}

// Fetch available packages for the dropdown
$packages_query = "SELECT * FROM packages WHERE service_id = ?";
$packages_stmt = $conn->prepare($packages_query);
$packages_stmt->bind_param("i", $service_id);
$packages_stmt->execute();
$packages = $packages_stmt->get_result();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $package_id = intval($_POST['package_id']);
    $client_id = 1; // Replace with actual client ID from session
    $location = $_POST['location'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $total_amount = floatval($_POST['total_amount']);

    // Validate inputs
    if (empty($location) || empty($latitude) || empty($longitude)) {
        die("Error: Location details are required.");
    }

    // Insert the order into the database
    $sql = "INSERT INTO orders (client_id, package_id, service_id, location, latitude, longitude, total_amount, event_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiisssd", $client_id, $package_id, $service_id, $location, $latitude, $longitude, $total_amount);

    if ($stmt->execute()) {
        echo "<script>alert('Order placed successfully!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Order</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
<h2>Place Your Order</h2>
<form method="POST">
    <label for="package">Select Package:</label>
    <select id="package" name="package_id" required>
        <?php while ($row = $packages->fetch_assoc()): ?>
            <option value="<?= $row['package_id'] ?>"><?= $row['package_name'] ?> ($<?= $row['price'] ?>)</option>
        <?php endwhile; ?>
    </select>
    <input type="hidden" id="total_amount" name="total_amount">
    <br><br>

    <label>Choose Location:</label>
    <input type="text" id="locationInput" name="location" placeholder="Search location" required>
    <div id="map"></div>
    <input type="hidden" id="lat" name="latitude">
    <input type="hidden" id="lng" name="longitude">
    <br>
    <button type="submit">Place Order</button>
</form>

<script>
    let map, marker;

    function initMap() {
        const initialLocation = { lat: -1.286389, lng: 36.817223 }; // Default location (Nairobi)
        map = new google.maps.Map(document.getElementById("map"), {
            center: initialLocation,
            zoom: 14,
        });

        const input = document.getElementById("locationInput");
        const autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener("place_changed", () => {
            const place = autocomplete.getPlace();
            if (!place.geometry) return;

            const location = place.geometry.location;
            document.getElementById("lat").value = location.lat();
            document.getElementById("lng").value = location.lng();

            if (marker) marker.setMap(null); // Clear the previous marker
            marker = new google.maps.Marker({
                position: location,
                map: map,
            });
            map.setCenter(location);
        });
    }

    // Validate the form on submission
    document.querySelector("form").onsubmit = function (event) {
        const locationInput = document.getElementById("locationInput").value;
        const latitude = document.getElementById("lat").value;
        const longitude = document.getElementById("lng").value;

        if (!locationInput || !latitude || !longitude) {
            alert("Please select a valid location using the map.");
            event.preventDefault(); // Prevent the form from submitting
        }
    };

    window.onload = initMap;
</script>
</body>
</html>
