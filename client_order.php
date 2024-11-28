<?php
include 'connection.php';

if (isset($_POST['package_id'], $_POST['location'], $_POST['latitude'], $_POST['longitude'])) {
    $package_id = $_POST['package_id'];
    $client_id = 1;  // Replace with actual logged-in client ID
    $location = $_POST['location'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $sql = "INSERT INTO orders (client_id, package_id, location, latitude, longitude, event_date) 
            VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissd", $client_id, $package_id, $location, $latitude, $longitude);

    if ($stmt->execute()) {
        echo "Order placed successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error: Missing required fields.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<form method="POST" action="place_order.php">
    <label for="package">Select Package:</label>
    <select id="package" name="package_id">
        <?php
        include 'connection.php';
        $sql = "SELECT package_id, package_name FROM packages";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['package_id'] . "'>" . $row['package_name'] . "</option>";
        }
        ?>
    </select>
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
        const initialLocation = { lat: -1.286389, lng: 36.817223 }; // Default location
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

            if (marker) marker.setMap(null);

            marker = new google.maps.Marker({
                position: location,
                map: map,
            });

            map.setCenter(location);
        });
    }

    window.onload = initMap;
</script>
</body>
</html>