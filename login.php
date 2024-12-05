<?php
session_start();
include 'connection.php';

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check the clients table
    $client_sql = "SELECT client_id, username, password, 'client' AS role, status FROM clients WHERE username = ? LIMIT 1";
    $client_stmt = $conn->prepare($client_sql);
    $client_stmt->bind_param("s", $username);
    $client_stmt->execute();
    $client_result = $client_stmt->get_result();

    // Check the services table if the user is not in clients
    $service_sql = "SELECT service_id, username, password, 'service' AS role, status FROM services WHERE username = ? LIMIT 1";
    $service_stmt = $conn->prepare($service_sql);
    $service_stmt->bind_param("s", $username);
    $service_stmt->execute();
    $service_result = $service_stmt->get_result();

    $user = null;
    if ($client_result->num_rows === 1) {
        $user = $client_result->fetch_assoc();
    } elseif ($service_result->num_rows === 1) {
        $user = $service_result->fetch_assoc();
    }

    if ($user) {
        // Check if the account is active
        if ($user['status'] === 'Active') {
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['client_id'] ?? $user['service_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] === 'client') {
                    $_SESSION['client_id'] = $user['client_id'];
                    $_SESSION['service_id'] = $user['service_id'];
                    header("Location: client_dashboard.php");
                } elseif ($user['role'] === 'service') {
                    $_SESSION['service_id'] = $user['service_id'];
                    header("Location: service_dashboard.php");
                }
                exit();
            } else {
                $errorMessage = "Incorrect password.";
            }
        } elseif ($user['status'] === 'Pending') {
            $errorMessage = "Your account is not yet verified. Please check your email for the OTP.";
        } else {
            $errorMessage = "Your account is not active.";
        }
    } else {
        $errorMessage = "Invalid username or password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/favicon.png" type="image/x-icon">
    <title>DineTrack - Login</title>
    
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

            <!-- Include Navbar -->
            <?php include 'navbar.php'; ?>
        </div>
</header>


<!-- Remove the borders after like idk, you fix designing-->
<body>
<main class="container my-5">

    <div class="row g-0 my-5 border shadow" style="min-height: 600px;">
		<div class="col-12 col-md-12 border ">
            <div class="p-5 bg-dark hero ">
                <h1 style="font-family: Poppins, sans-serif; color: #fff;" class="text-shadow-big"><b> Welcome Back! </b></h1>
            </div>
		
		<div class="col-6 col-md-6">
        <form method="POST">
                    <h2>Login</h2>
                    <?php if ($errorMessage): ?>
                    <div class="error-message"><?php echo htmlspecialchars($errorMessage); ?></div>
                    <?php endif; ?>
                        <div class="mb-3">
                            <input type="text" name="username" placeholder="Username" required><br>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" placeholder="Password" required><br>
                        </div>
                    <button type="submit">Login</button>
                    <div class="signup-link">
                    <p>Forgot Password? <a href="forgot-password.php">Change Password</a></p>
                    <p>Don't have an account? <a href="register_client.php">Sign Up</a></p>
                    </div>
                </form>

		</div>
	</div>
</main>
</body>
</html>