<?php
include 'connection.php';

// Fetch the meals for the specific package
$package_id = $_GET['package_id']; // Get package ID from query parameter
$service_id = 1;  // Replace with the actual service ID of the logged-in caterer

// Fetch meals from the meals table
$sql = "SELECT meals.id, meals.name FROM meals 
        LEFT JOIN package_meals ON meals.id = package_meals.meal_id
        WHERE package_meals.package_id IS NULL AND meals.service_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $service_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Meals for Package</h2>";
echo "<form method='POST' action='add_meals_to_package.php'>";
echo "<ul>";

while ($row = $result->fetch_assoc()) {
    echo "<li>";
    echo "<input type='checkbox' name='meal_ids[]' value='" . $row['id'] . "'> " . $row['name'];
    echo "</li>";
}

echo "</ul>";
echo "<input type='hidden' name='package_id' value='" . $package_id . "'>";
echo "<button type='submit' class='btn btn-primary'>Add Meals to Package</button>";
echo "</form>";

$stmt->close();
$conn->close();
?>
