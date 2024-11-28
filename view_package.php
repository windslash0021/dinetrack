<?php
include 'connection.php';

// Fetch packages for the caterer
$service_id = 1;  // Replace with the actual service ID of the logged-in caterer
$sql = "SELECT * FROM packages WHERE service_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $service_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/favicon.png" type="image/x-icon">
    <title>DineTrack - Add Menu</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap JS Bundle (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu_book" />
</head>
<header>
        <div class="d-flex justify-content-between align-items-center">

            <!-- Include Service/Catering Navbar -->
            <?php include 'service_navbar.php'; ?>
        </div>
</header>
<body>
<?php 
        echo "<h2>Your Packages</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h3>" . $row['package_name'] . "</h3>";
    echo "<p>" . $row['description'] . "</p>";
    echo "<p>Price: " . $row['price'] . "</p>";
    echo "<a href='view_meals_in_package.php?package_id=" . $row['package_id'] . "'>View Meals</a>";
    echo "</div>";
}
?>
</body>
</html>