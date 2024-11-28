<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DineTrack - Catering Service Hub</title>
    <link rel="icon" href="assets/favicon.png" type="image/x-icon">

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

    


<style>


    /*FOOTER starts HERE*/
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

    .footer-left,.footer-right {
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
        transition: transform 0.1s ease, background-color 0.8s ease;
    }

    .footer-link-btn:hover {
        color: #fff;
        text-decoration: none;
        transform: scale(110%);
        transition: transform 0.1s ease, background-color 0.8s ease;
    }
    /*FOOTER ENDS HERE*/

    .bg-image1 {
        background-image: url('assets/mp1_food1.jpg'); 
        background-size: cover;
        background-position: center; 
        background-repeat: no-repeat; 
    }

    .bg-image2 {
        background-image: url('assets/mp1_food2.jpg'); 
        background-size: cover;
        background-position: center; 
        background-repeat: no-repeat; 
    }

    .bg-image3 {
        background-image: url('assets/mp1_food3.jpg'); 
        background-size: cover;
        background-position: center; 
        background-repeat: no-repeat; 
    }

    .bg-image1-d {
        background-image: url('assets/mp1_food1_d.jpg'); 
        background-size: cover;
        background-position: center; 
        background-repeat: no-repeat; 
    }

    .bg-image2-d {
        background-image: url('assets/mp1_food2_d.jpg'); 
        background-size: cover;
        background-position: center; 
        background-repeat: no-repeat; 
    }

    .bg-image3-d {
        background-image: url('assets/mp1_food3_d.jpg'); 
        background-size: cover;
        background-position: center; 
        background-repeat: no-repeat; 
    }


    .h-100 {
        height: 100%; 
    }

    .h-content-box {
        min-height: 400px;
    }

    .btn-home-sel {
        background-color: #3dca6c;
        border-radius: 9px;
        color: #000;
        transition: scale 0.3s ease, background-color 0.8s ease, border-radius 0.8s ease, color 0.1s ease;
    }

    .btn-home-sel:hover {
        background-color: #09f157;
        border-radius: 0px;
        scale: 110%;
        color: #fff;
        transition: scale 0.3s ease, background-color 0.8s ease, border-radius 0.8s ease, color 0.1s ease;
    }

    .hero {
        height: 400px;
    }


    .carousel-text-head {
        font-family: Poppins, sans-serif; 
        font-weight: 700;
        position: relative;
        font-size: 60px;

    }

    .carousel-caption {
        font-size: 40px;
    }

    .btn-carousel {
        background-color: #3dca6c;
        border-radius: 9px;
        font-size: 25px;
        color: #000;
        transition: scale 0.3s ease, background-color 0.8s ease, border-radius 0.8s ease, color 0.1s ease;
    }

    .btn-carousel:hover {
        background-color: #09f157;
        border-radius: 0px;
        scale: 110%;
        color: #fff;
        transition: scale 0.3s ease, background-color 0.8s ease, border-radius 0.8s ease, color 0.1s ease;
    }

    .carousel-control-prev .carousel-control-next{
        background-color: #dddddd;
        color: #dddddd;
        transition: scale 0.3s ease, background-color 0.8s ease, border-radius 0.8s ease, color 0.1s ease;
    }

    .carousel-control-prev:hover .carousel-control-next:hover{
        transition: scale 0.3s ease, background-color 0.8s ease, border-radius 0.8s ease, color 0.1s ease;
    }

    /* FASTSCROLL BUTTON STARTS HERE */
    .scroll_up {
        background-color: #09f157;
        transition: transform 0.05s ease;
        box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
    }

    .scroll_up:hover {
        background-color: #b0ffca;
        transform: scale(1.05);

    }

    .scroll_up:active {
        background-color: #ffffff;
        transform: scale(0.95);

    }

    /* FASTSCROLL BUTTON ENDS HERE */




    
</style> 
</head>

    <header>
        <div class="d-flex justify-content-between align-items-center">

            <!-- Include Navbar -->
            <?php include 'navbar.php'; ?>
        </div>
    </header>

    <body>
    <main class="container my-5">

        <div class="row g-0 my-5 ">
            <!-- Hero Section 1 -->
            <div class="col-6 col-md-6"> <!-- 12 when compressed, 6 on normal screens or smth -->
                <div class="p-5 bg-dark hero">
                    <h1 style="font-family: Poppins, sans-serif; color: #fff;" class="text-shadow-big"><b> Welcome to DineTrack! </b></h1>
                    <p style="color: #fff;" class="text-shadow">Your ultimate catering experience awaits. <br>Manage or Book a catering for special events</p>
    
                    <a href="#" class="btn btn-home-sel" style="font-weight: bold;">GET STARTED</a>
                </div>
            </div>
    
            <!-- Hero Section 2 with Image -->
            <div class="col-6 col-md-6"> <!-- Same stuff from above -->
                <div class="p-5  hero bg-image3-d ">
                    <h1 style="font-family: Poppins, sans-serif; color: #fff;"><b> Catering to your needs </b></h1>
                    <p style="color: #fff;">Create an account to book a catering service or to register your catering service. <br>Wanna Learn more?</p>

                    
                    <a href="#" class="btn btn-home-sel " style="font-weight: bold;">LEARN MORE</a>
                </div>
            </div>
        </div>


        <div class="col-12 col-md-12 col-lg-12 bg-image1-d h-content-box rounded my-5">
            <div class="p-5  rounded">
                <h1 style="font-family: Poppins, sans-serif; color: #fff;"><b> Book a Catering Service</b></h1>
                <p style="color: #fff;">Looking for a catering service for an event? 
                    <br>Explore a diverse selection of catering options tailored to meet your unique needs!
                    <br>At DineTrack, we connect you with top-rated caterers who can make
                    <br>your event unforgettable
                </p>

                
                <a href="#" class="btn btn-home-sel" style="font-weight: bold;">LEARN MORE</a>
            </div>
        </div>

        <div class="col-12 col-md-12 col-lg-12 bg-image3-d h-content-box rounded my-5">
            <div class="p-5  rounded">
                <h1 style="font-family: Poppins, sans-serif; color: #fff;"><b> Book a Catering Service</b></h1>
                <p style="color: #fff;">Looking for a catering service for an event? 
                    <br>Explore a diverse selection of catering options tailored to meet your unique needs!
                    <br>At DineTrack, we connect you with top-rated caterers who can make
                    <br>your event unforgettable
                </p>

                
                <a href="#" class="btn btn-home-sel" style="font-weight: bold;">LEARN MORE</a>
            </div>
        </div>


    </main>
    
    <main class="container  rounded my-5">
    <!-- TEMPORARY IMAGES//REPLACE WITH UI AFTER FINISHING THE WEBSITE -->
    <div id="carouselElement" class="carousel slide container-fluid my-3 rounded" data-bs-ride="carousel" >
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselElement" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselElement" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselElement" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner rounded ">
          <div class="carousel-item active" data-bs-interval="10000">
            <img src="assets/mp1_food1_d.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1 class="carousel-text-head">First slide label</h1>
              <p>Some representative placeholder content for the first slide.</p>
              <a href="#" class="btn btn-carousel" style="font-weight: bold;">GET STARTED</a>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="10000">
            <img src="assets/mp1_food2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1 class="carousel-text-head">Second slide label</h1>
              <p>Some representative placeholder content for the second slide.</p>
              <a href="#" class="btn btn-carousel" style="font-weight: bold;">GET STARTED</a>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="10000">
            <img src="assets/mp1_food3.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1 class="carousel-text-head">Third slide label</h1>
              <p>Some representative placeholder content for the third slide.</p>
              <a href="#" class="btn btn-carousel" style="font-weight: bold;">GET STARTED</a>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselElement" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselElement" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>


      
    </main>


    

    <div class="sticky-bottom d-flex justify-content-end p-4">
        <a href="#">
            <button type="button" class="btn scroll_up">
                <img src="assets/arrow_up.svg" alt="Scroll Up Icon" style="width: 30px; height: 40px;">
            </button>
        </a>
    </div>
<?php include 'footer.php'; ?>

</html>