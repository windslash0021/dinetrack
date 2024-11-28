<?php
require_once "controllerUserData.php";

if (!isset($_SESSION['client_id']) && !isset($_SESSION['service_id'])) {
    header('Location: forgot-password.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a New Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="controllerUserData.php" method="POST" autocomplete="off">
                    <h2 class="text-center">New Password</h2>
                    <?php if (!empty($errors)) { ?>
                        <div class="alert alert-danger text-center">
                            <?php foreach ($errors as $error) echo $error; ?>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Create new password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password" value="Change">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>