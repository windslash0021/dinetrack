<?php
session_start();
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredOtp = trim($_POST['otp'] ?? '');
    $storedOtp = $_SESSION['otp'] ?? null;

    if (!empty($enteredOtp) && $enteredOtp === $storedOtp) { // Compare as strings
        $serviceData = $_SESSION['service_data'] ?? [];
        if (!empty($serviceData)) {
            $firstName = $serviceData['first_name'];
            $lastName = $serviceData['last_name'];
            $email = $serviceData['email'];
            $username = $serviceData['username'];
            $password = $serviceData['password'];

            $gender = $serviceData['gender'];
            $address = $serviceData['address'];
            $phone = $serviceData['phone'];
            $companyName = $serviceData['company_name'];

            $stmt = $conn->prepare("INSERT INTO services (first_name, last_name, email, username, password, gender, address, phone, company_name, code, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Active')");
            $stmt->bind_param("sssssssssi", $firstName, $lastName, $email, $username, $password, $gender, $address, $phone, $companyName, $storedOtp);

            if ($stmt->execute()) {
                $serviceId = $stmt->insert_id; // Get the inserted service ID
                $stmt->close();

                // Clear session data
                unset($_SESSION['otp'], $_SESSION['service_data']);

                // Redirect to login page
                header("Location: login.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Failed to create an account. Please try again.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Session data missing. Please try registering again.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Invalid OTP. Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>DineTrack - Verify OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Verify OTP</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="otp" class="form-label">Enter OTP</label>
                <input type="text" class="form-control" id="otp" name="otp" required>
            </div>
            <button type="submit" class="btn btn-primary">Verify</button>
        </form>
    </div>
</body>
</html>