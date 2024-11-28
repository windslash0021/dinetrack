<?php
include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Validate POST data
if (isset($_POST['package_name'], $_POST['description'], $_POST['price'])) {
    $service_id = 1;  // Replace this with the actual service ID of the logged-in caterer
    $package_name = $_POST['package_name'];
    $package_description = $_POST['description'];
    $package_price = $_POST['price'];

    // Insert into packages table
    $sql = "INSERT INTO packages (service_id, package_name, description, price) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issd", $service_id, $package_name, $package_description, $package_price);

    if ($stmt->execute()) {
        echo "Package created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error: Missing required fields.";
}
}

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
    

<h2>Create a Package</h2>
<form id="createPackageForm" method="POST" action="create_package.php">
    <div class="mb-3">
        <label for="packageName" class="form-label">Package Name</label>
        <input type="text" id="packageName" name="package_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="packageDescription" class="form-label">Package Description</label>
        <textarea id="packageDescription" name="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label for="packagePrice" class="form-label">Package Price</label>
        <input type="number" id="packagePrice" name="price" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Package</button>
</form>
</body>
</html>