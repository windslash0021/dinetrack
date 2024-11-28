<?php
require_once "controllerUserData.php"; 

if (!isset($_SESSION['email'])) {
    header('Location: forgot-password.php');
    exit();
}

if (isset($_POST['check-reset-otp'])) {
    $otp = mysqli_real_escape_string($conn, $_POST['otp']);
    $email = $_SESSION['email'];

    // Check if OTP matches
    $check_code = "SELECT * FROM clients WHERE email='$email' AND code='$otp'";
    $code_res = mysqli_query($conn, $check_code);

    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $_SESSION['client_id'] = $fetch_data['client_id']; // Correct column name
        header('Location: new-password.php');
        exit();
    } else {
        $errors[] = "Invalid OTP! Please try again.";
    }
    // Check if OTP matches
    $check_code = "SELECT * FROM services WHERE email='$email' AND code='$otp'";
    $code_res = mysqli_query($conn, $check_code);

    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $_SESSION['service_id'] = $fetch_data['service_id']; // Correct column name
        header('Location: new-password.php');
        exit();
    } else {
        $errors[] = "Invalid OTP! Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="reset-code.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Code Verification</h2>
                    <?php if (!empty($errors)) { ?>
                        <div class="alert alert-danger text-center">
                            <?php foreach ($errors as $error) echo $error; ?>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <input class="form-control" type="number" name="otp" placeholder="Enter code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-reset-otp" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>