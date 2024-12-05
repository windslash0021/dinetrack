<?php
session_start();
include('connection.php');

// Fetch the service_id from the URL
$service_id = isset($_GET['service_id']) ? intval($_GET['service_id']) : 0;

// Fetch packages and meals based on the service_id
$packages_query = $conn->prepare("SELECT * FROM packages WHERE service_id = ?");
$packages_query->bind_param("i", $service_id);
$packages_query->execute();
$packages_result = $packages_query->get_result();

$meals_query = $conn->prepare("SELECT * FROM meals WHERE service_id = ?");
$meals_query->bind_param("i", $service_id);
$meals_query->execute();
$meals_result = $meals_query->get_result();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_SESSION['client_id']; // Ensure the client is logged in
    $package_id = $_POST['package_id'] ?? null;
    $selected_meals = $_POST['meals'] ?? [];
    $order_date = $_POST['order_date'];

    // Calculate total amount
    $total_amount = 0;

    // Fetch package price
    if ($package_id) {
        $package_price_query = $conn->prepare("SELECT price FROM packages WHERE package_id = ?");
        $package_price_query->bind_param("i", $package_id);
        $package_price_query->execute();
        $package_price_query->bind_result($package_price);
        $package_price_query->fetch();
        $total_amount += $package_price;
        $package_price_query->close();
    }

    // Fetch meal prices
    if (!empty($selected_meals)) {
        $meal_ids = implode(",", array_map('intval', $selected_meals));
        $meal_prices_query = $conn->query("SELECT price FROM meals WHERE meal_id IN ($meal_ids)");
        while ($row = $meal_prices_query->fetch_assoc()) {
            $total_amount += $row['price'];
        }
    }

    // Insert into client_orders
    $order_insert_query = $conn->prepare("
        INSERT INTO client_orders (client_id, package_id, service_id, order_date, total_amount, invoice_status)
        VALUES (?, ?, ?, ?, ?, 'Pending')
    ");
    $order_insert_query->bind_param("iiisd", $client_id, $package_id, $service_id, $order_date, $total_amount);

    if ($order_insert_query->execute()) {
        $_SESSION['order_id'] = $conn->insert_id; // Save order ID for later steps
        header("Location: client_locations.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function calculateTotal() {
            const packagePrice = parseFloat(document.querySelector('select[name="package_id"] option:checked').dataset.price || 0);
            const mealPrices = Array.from(document.querySelectorAll('input[name="meals[]"]:checked'))
                .reduce((total, meal) => total + parseFloat(meal.dataset.price), 0);

            const total = packagePrice + mealPrices;
            document.getElementById('totalAmount').textContent = `Total: ₱${total.toFixed(2)}`;
        }
    </script>
</head>
<body>
<div class="container my-5">
    <h1>Place Your Order</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="package" class="form-label">Select a Package</label>
            <select name="package_id" class="form-select" onchange="calculateTotal()">
                <option value="">None</option>
                <?php while ($package = $packages_result->fetch_assoc()): ?>
                    <option value="<?= $package['package_id'] ?>" data-price="<?= $package['price'] ?>">
                        <?= htmlspecialchars($package['package_name']) ?> - ₱<?= number_format($package['price'], 2) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="meals" class="form-label">Select Meals</label>
            <?php while ($meal = $meals_result->fetch_assoc()): ?>
                <div class="form-check">
                    <input 
                        type="checkbox" 
                        name="meals[]" 
                        value="<?= $meal['meal_id'] ?>" 
                        class="form-check-input"
                        data-price="<?= $meal['price'] ?>" 
                        onchange="calculateTotal()">
                    <label class="form-check-label">
                        <?= htmlspecialchars($meal['name']) ?> - ₱<?= number_format($meal['price'], 2) ?>
                    </label>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="mb-3">
            <label for="order_date" class="form-label">Event Date</label>
            <input 
                type="date" 
                name="order_date" 
                class="form-control" 
                min="<?= date('Y-m-d', strtotime('+7 days')) ?>" 
                max="<?= date('Y-m-d', strtotime('+1 year')) ?>" 
                required>
        </div>
        <h3 id="totalAmount">Total: ₱0.00</h3>
        <button type="submit" class="btn btn-success">Proceed to Location</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
