<?php
// Assuming you've set up the database connection (connection.php included here)
include('connection.php');

// Fetch the most popular services
$popular_query = "SELECT * FROM services ORDER BY orders_completed DESC LIMIT 4"; // Example sorting by orders completed
$popular_services = $conn->query($popular_query);

// Fetch more services
$more_services_query = "SELECT * FROM services ORDER BY created_at DESC LIMIT 8"; // Example sorting by latest created
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
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">DineTrack</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">Search</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Booked Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Account</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Search Bar -->
<div class="container my-4">
    <form class="search-bar d-flex">
        <input class="form-control me-2" type="text" placeholder="Search for a Catering Service or Event Tag" aria-label="Search">
    </form>
</div>

<!-- Most Popular Section -->
<div class="container service-section">
    <h2>Most Popular</h2>
    <div class="row g-4">
        <?php while($service = $popular_services->fetch_assoc()): ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card service-card">
                <img src="<?php echo $service['image_url']; ?>" alt="Service Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $service['company_name']; ?></h5>
                    <p class="card-text"><?php echo $service['category']; ?></p>
                    <p class="card-text"><?php echo $service['location']; ?></p>
                    <p class="card-text"><?php echo $service['rating']; ?> Stars</p>
                    <p class="card-text"><?php echo $service['orders_completed']; ?> orders completed</p>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Divider -->
<div class="container">
    <div class="divider"></div>
</div>

<!-- More Services Section -->
<div class="container service-section">
    <h2>More Services</h2>
    <div class="row g-4">
        <?php while($service = $more_services->fetch_assoc()): ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card service-card">
                <img src="<?php echo $service['image_url']; ?>" alt="Service Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $service['company_name']; ?></h5>
                    <p class="card-text"><?php echo $service['category']; ?></p>
                    <p class="card-text"><?php echo $service['location']; ?></p>
                    <p class="card-text"><?php echo $service['rating']; ?> Stars</p>
                    <p class="card-text"><?php echo $service['orders_completed']; ?> orders completed</p>
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
