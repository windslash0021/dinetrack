<?php
include 'connection.php';

// Validate POST data
if (isset($_POST['package_id'], $_POST['meal_ids'])) {
    $package_id = $_POST['package_id'];
    $meal_ids = $_POST['meal_ids']; // Array of selected meal IDs

    // Add each selected meal to the package_meals table
    foreach ($meal_ids as $meal_id) {
        $sql = "INSERT INTO package_meals (package_id, meal_id) VALUES (?, ?)";  // meal_id is the column in package_meals table
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $package_id, $meal_id);

        if (!$stmt->execute()) {
            echo "Error adding meal to package: " . $stmt->error . "<br>";
            $stmt->close();
            exit();
        } else {
            echo "Meal added to package with meal_id: " . $meal_id . "<br>";
        }
    }

    echo "Meals added to package successfully!";
    $stmt->close();
} else {
    echo "Error: Missing required fields.";
}

$conn->close();
?>
