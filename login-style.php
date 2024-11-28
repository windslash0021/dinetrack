
<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DineTrack - Login</title>
    <link rel="icon" href= "assets/favicon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu_book" />

    <!-- Font Awesome for icons (if needed) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <style>
 

        main {
            padding: 20px;
        }

        .login-container {
            width: 450px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #333;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            margin-bottom: 20px;
        }

        .input-field {
            position: relative;
            margin-bottom: 20px;
        }

        .input-field i {
            position: absolute;
            top: 12px;
            left: 10px;
            color: #aaa;
        }

        .input-field input {
            width: 100%;
            padding: 10px 15px;
            border: none;
            border-bottom: 1px solid #aaa;
            background-color: transparent;
            color: #fff;
        }

        button {
            width: 100%;
            font-style: poppins ;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #ff512f;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-weight: bold;
        }

        button:hover {
            background-color: #57e220;
            color: #000;
            font-weight: bold;

        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-content {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-left,
        .footer-right {
            flex: 1;
        }

        .footer-right ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .footer-right li {
            margin-right: 20px;
        }

        .footer-right a {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>

<body>

<header>
        <div class="d-flex justify-content-between align-items-center">

            <!-- Include Navbar -->
            <?php include 'navbar.php'; ?>
        </div>
    </header>

    <main>
        <div class="login-container">
            <h1>LOGIN TO YOUR ACCOUNT</h1>
            <p>Please input your account details:</p>
            <form>
                <div class="input-field">
                    <i class="fa fa-user"></i>
                    <input type="text" placeholder="Username" required>
                </div>
                <div class="input-field">
                    <i class="fa fa-lock"></i>
                    <input type="password" placeholder="Password" required>
                </div>
                <button type="submit"><a href="index.php"></a>LOGIN</button>
            </form>
        </div>


        
    </main>




    
    <footer>
        <div class="footer-content">
            <div class="footer-left">
                <p>&copy; 2024 DineTrack. All Rights Reserved.</p>
            </div>
            <div class="footer-right">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Catering Services</a></li>
                    <li><a href="#">Register</a></li>
                    <li><a href="#">Login</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>


