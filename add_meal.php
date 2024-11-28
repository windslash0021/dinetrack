<?php
include 'connection.php';


if (isset($_POST['service_id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['image_url'], $_POST['ingredients'])) {
    $p_service_id = $_POST['service_id']; // Ensure this is passed correctly
    $p_meal_name = $_POST['name'];
    $p_meal_description = $_POST['description'];
    $p_meal_price = $_POST['price'];
    $p_meal_image_url = $_POST['image_url'];
    $p_meal_ingredients = $_POST['ingredients']; // Comma-separated string


    $sql = "CALL sp_add_meal(?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issdss", $p_service_id, $p_meal_name, $p_meal_description, $p_meal_price, $p_meal_image_url, $p_meal_ingredients);

    if ($stmt->execute()) {
        echo "Meal added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error: Missing required fields.";
}

$conn->close();
?>
