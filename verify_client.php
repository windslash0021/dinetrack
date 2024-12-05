<?php
session_start();
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredOtp = trim($_POST['otp'] ?? '');
    $storedOtp = $_SESSION['otp'] ?? null;

    if (!empty($enteredOtp) && $enteredOtp === $storedOtp) { // Compare as strings
        $clientData = $_SESSION['client_data'] ?? [];
        if (!empty($clientData)) {
            $firstName = $clientData['first_name'];
            $lastName = $clientData['last_name'];
            $email = $clientData['email'];
            $username = $clientData['username'];
            $password = $clientData['password'];
            $gender = $clientData['gender'];
            $region = $clientData['region'];
            $province = $clientData['province'];
            $city = $clientData['city'];
            $barangay = $clientData['barangay'];
            $street_name = $clientData['street_name'];
            
            $phone = $clientData['phone'];

            $stmt = $conn->prepare("INSERT INTO clients (first_name, last_name, email, username, password, gender, region, province, city, barangay, street_name, phone, code, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Active')");
            $stmt->bind_param("ssssssssssssi", $firstName, $lastName, $email, $username, $password, $gender, $region, $province, $city, $barangay, $street_name, $phone, $storedOtp);

            if ($stmt->execute()) {
                $clientId = $stmt->insert_id; // Get the inserted client ID
                $stmt->close();

                // Clear session data
                unset($_SESSION['otp'], $_SESSION['client_data']);

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