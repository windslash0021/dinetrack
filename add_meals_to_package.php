<?php
include 'connection.php';

if (isset($_POST['package_id'], $_POST['meal_ids'], $_POST['service_id'])) {
    $package_id = intval($_POST['package_id']);
    $meal_ids = $_POST['meal_ids']; // Should be an array
    $service_id = intval($_POST['service_id']);

    // Validate that meal_ids is an array and contains integers
    if (!is_array($meal_ids) || empty($meal_ids)) {
        echo "Error: Invalid meal IDs.";
        exit();
    }

    // Begin a transaction
    $conn->begin_transaction();

    try {
        foreach ($meal_ids as $meal_id) {
            $meal_id = intval($meal_id); // Ensure meal_id is an integer
            $sql = "INSERT INTO package_meals (package_id, meal_id, service_id) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iii", $package_id, $meal_id, $service_id);

            if (!$stmt->execute()) {
                throw new Exception("Error adding meal to package: " . $stmt->error);
            }
        }

        // Commit transaction
        $conn->commit();
        echo "Meals added to package successfully!";
    } catch (Exception $e) {
        // Rollback on failure
        $conn->rollback();
        echo "Failed to add meals to package: " . $e->getMessage();
    }

    $stmt->close();
} else {
    echo "Error: Missing required fields.";
}

$conn->close();
?>
