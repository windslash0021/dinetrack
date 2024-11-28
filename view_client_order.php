<?php

// Fetch location details
$order_id = $_GET['order_id']; 
$sql = "SELECT location, latitude, longitude FROM orders WHERE order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

$location = $order['location'];
$latitude = $order['latitude'];
$longitude = $order['longitude'];

$stmt->close();
?>
<div>
    <h3>Event Location</h3>
    <p><?php echo htmlspecialchars($location); ?></p>
    <div id="map"></div>
</div>

<script>
    function initMap() {
        const location = { lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?> };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: location,
        });

        new google.maps.Marker({
            position: location,
            map: map,
        });
    }

    window.onload = initMap;
</script>