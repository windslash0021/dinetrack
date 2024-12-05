<?php
session_start();
include 'connection.php';

$street_name = isset($_GET['street_name']) ? $_GET['street_name'] : 'N/A';
$barangay = isset($_GET['barangay']) ? $_GET['barangay'] : 'N/A';
$city = isset($_GET['city']) ? $_GET['city'] : 'N/A';
$region = isset($_GET['region']) ? $_GET['region'] : 'N/A';
$latitude = isset($_GET['latitude']) ? $_GET['latitude'] : 0;
$longitude = isset($_GET['longitude']) ? $_GET['longitude'] : 0;

// Fetch client ID
$client_id = $_SESSION['client_id'] ?? null;
if (!$client_id) {
    die("Client ID is not set.");
}

// Fetch the latest order details
$order_query = $conn->prepare("
   SELECT 
    client_orders.order_id,
    client_orders.client_id,
    client_orders.service_id,
    client_orders.order_date,
    client_orders.total_amount,
    services.company_name,
    packages.package_name,
    packages.price AS package_price
FROM 
    client_orders
JOIN 
    services ON client_orders.service_id = services.service_id
JOIN 
    packages ON packages.package_id = client_orders.package_id
WHERE 
    client_orders.client_id = ?
ORDER BY client_orders.order_date DESC
LIMIT 1;
");
$order_query->bind_param("i", $client_id);
$order_query->execute();
$order_result = $order_query->get_result();
$order = $order_result->fetch_assoc();

// Fetch selected meals
$package_id = $order['package_id'] ?? null;
if ($package_id) {
    $meals_query = $conn->prepare("
        SELECT meals.name, meals.price 
        FROM meals 
        JOIN package_meals ON package_meals.meal_id = meals.meal_id 
        WHERE package_meals.package_id = ?
    ");
    $meals_query->bind_param("i", $package_id);
    $meals_query->execute();
    $meals_result = $meals_query->get_result();
    $meals = $meals_result->fetch_all(MYSQLI_ASSOC);
} else {
    $meals = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Location</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbmzguZyAbhI_u077S1PWJ6iR7K9092Oo"></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
<h3>Your Order Summary</h3>
<?php if ($order): ?>
    <p><strong>Package:</strong> <?= htmlspecialchars($order['package_name']) ?> 
    (₱<?= number_format($order['package_price'], 2) ?>)</p>
    <p><strong>Total Amount:</strong> ₱<?= number_format($order['total_amount'], 2) ?></p>
<?php else: ?>
    <p>No orders found.</p>
<?php endif; ?>

<?php if ($meals): ?>
    <h4>Selected Meals:</h4>
    <ul>
        <?php foreach ($meals as $meal): ?>
            <li><?= htmlspecialchars($meal['name']) ?> - ₱<?= number_format($meal['price'], 2) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

    <h2>Confirm Your Location</h2>
    <form action="client_dashboard.php" method="POST">
    <p>Address: <strong>
    <?= htmlspecialchars("$street_name, $barangay, $city, $region") ?>
</strong></p>

        <div id="map"></div>
        <input type="hidden" name="street_name" value="<?= htmlspecialchars($street_name) ?>">
        <input type="hidden" name="barangay" value="<?= htmlspecialchars($barangay) ?>">
        <input type="hidden" name="city" value="<?= htmlspecialchars($city) ?>">
        <input type="hidden" name="region" value="<?= htmlspecialchars($region) ?>">
        <input type="hidden" name="latitude" value="<?= $latitude ?>">
        <input type="hidden" name="longitude" value="<?= $longitude ?>">

        <button type="submit">Confirm Order</button>
    </form>

<script>
    function initMap() {
        const location = { lat: <?= $latitude ?>, lng: <?= $longitude ?> };
        const map = new google.maps.Map(document.getElementById("map"), {
            center: location,
            zoom: 15,
        });

        new google.maps.Marker({
            position: location,
            map: map,
        });
    }

    google.maps.event.addDomListener(window, "load", initMap);
</script>
</body>
</html>
