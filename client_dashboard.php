<?php
// Assuming you've set up the database connection (connection.php included here)
include('connection.php');

// Fetch the most popular services
$popular_query = "SELECT * FROM services ORDER BY orders_completed DESC LIMIT 4"; // Example sorting by orders completed
$popular_services = $conn->query($popular_query);

// Fetch more services
$more_services_query = "SELECT * FROM services ORDER BY joined_at DESC LIMIT 8"; // Example sorting by latest created
$more_services = $conn->query($more_services_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DineTrack - Client Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #198754;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .search-bar input {
            border-radius: 30px;
            padding: 10px 20px;
        }
        .service-section h2 {
            font-weight: bold;
            margin-bottom: 20px;
        }
        .service-card {
            text-align: center;
        }
        .service-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
        .service-card .card-title {
            font-size: 16px;
            font-weight: bold;
        }
        .service-card .card-text {
            font-size: 14px;
            color: gray;
        }
        .divider {
            border-top: 2px solid #ddd;
            margin: 30px 0;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="#">DineTrack</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="#">Order History</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Account Settings</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Logout</a></li>
        </ul>
    </div>
</nav>

<!-- Search Bar -->
<div class="container my-4">
    <form class="search-bar d-flex">
        <input class="form-control me-2" type="text" placeholder="Search for a Catering Service or Event Tag" aria-label="Search">
    </form>
</div>

<!-- Most Popular Section -->
<div class="container mt-4">
    <h2 class="mb-4">Most Popular Services</h2>
    <div class="row">
        <?php while ($service = $popular_services->fetch_assoc()): ?>
        <div class="col-md-3">
            <div class="card">
                <img src="<?= $service['image_url'] ?>" class="card-img-top" alt="Service">
                <div class="card-body">
                    <h5 class="card-title"><?= $service['company_name'] ?></h5>
                    <p class="card-text"><?= $service['orders_completed'] ?> Orders Completed</p>
                    <a href="client_order.php?service_id=<?= $service['service_id'] ?>" class="btn btn-success">Order Now</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <h2 class="my-4">More Services</h2>
    <div class="row">
        <?php while ($service = $more_services->fetch_assoc()): ?>
        <div class="col-md-3">
            <div class="card">
                <img src="<?= $service['image_url'] ?>" class="card-img-top" alt="Service">
                <div class="card-body">
                    <h5 class="card-title"><?= $service['company_name'] ?></h5>
                    <p class="card-text">Location: <?= $service['location'] ?></p>
                    <a href="client_order.php?service_id=<?= $service['service_id'] ?>" class="btn btn-success">Order Now</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
