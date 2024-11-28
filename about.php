<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DineTrack - About</title>
    <link rel="icon" href= "assets/favicon.png" type="image/x-icon"> 
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="style.css">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu_book" />
    

<style>

    /*FOOTER ENDS HERE*/
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


    .card-img-top {
        transition: transform 0.3s ease, z-index 0.3s ease, box-shadow 0.3s ease ;
        z-index: 1;
    }

    .card-img-top:hover {
        transform: scale(1.03);
        z-index: 4;
        box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.5);
    }

    .section_header {
        font-weight: bold;
        font-family: 'poppins';
        font-size: 60px;
        color: #000;
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

        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <div class="card">
                <div class="card-body ">
                  <h5 class="card-title">How It Works</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#customer_header" class="btn btn-primary">View For Customers</a>
                  <a href="#caterer_header" class="btn btn-primary">View For Caterers</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Mission and Vision</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#mission-vision" class="btn btn-primary">View Mission & Vision</a>
                </div>
              </div>
            </div>
          </div>
        
        <div class="row g-0 my-5 bg-image3">
            <!-- Hero Section 1 -->
            <div class="col-6 col-sm-6 col-md-3"> <!-- 12 when compressed, 6 on normal screens or smth -->
                <div class="p-5 bg-dark  hero">
                    <h1 style="font-family: Poppins, sans-serif; color: #fff;"><b>How It Works</b></h1>
                    <p style="color: #fff;">At DineTrack, we simplify the catering process for both event organizers and catering services.</p>
                </div>
            </div>
    
            <!-- Hero Section 2 with Image -->
            <div class="col-6 col-md-9"> <!-- Same stuff from above -->
                <div class="p-5  hero bg-image3 ">          
                </div>
            </div>
        </div>

    <div class="my-5">
    <h6 class="section_header" id="customer_header">FOR CUSTOMERS</h6>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card">
              <img src="assets/temp_img.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Explore Catering Options</h5>
                <p class="card-text">Browse our extensive directory of top-rated catering services tailored to suit every event type, from weddings to corporate gatherings.</p>
              </div>
            </div>
          </div>

        <div class="col">
            <div class="card">
              <img src="assets/temp_img.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Select Your Menu</h5>
                <p class="card-text">Select from a variety of delicious menu options. Filter choices by cuisine, dietary requirements, and guest count to find the perfect fit for your event.</p>
              </div>
            </div>
          </div>

            <div class="col">
              <div class="card">
                <img src="assets/temp_img.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Easy Bookings</h5>
                  <p class="card-text">Use our streamlined booking system to secure your catering services in just a few clicks.</p>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card">
                <img src="assets/temp_img.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">
                    <h5 class="card-title">Clear Invoicing</h5>
                  <p class="card-text">Receive automated, itemized invoices that keep you informed about your total costs, ensuring transparency and helping you manage your budget effectively.</p>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card">
                <img src="assets/temp_img.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Enjoy Your Event</h5>
                  <p class="card-text">Sit back and relax! Your chosen catering service will take care of all the details, allowing you to enjoy your event stress-free.</p>
                </div>
              </div>
            </div>
        </div>
        </div>
    </div>





    <h6 class="section_header" id="caterer_header" >FOR CATERERS</h6>
    <div class="row row-cols-1 row-cols-md-3 g-4 ">
        <div class="col">
            <div class="card">
              <img src="assets/temp_img.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Create Your Account</h5>
                <p class="card-text">Sign up to DineTrack and create your personalized service page, showcasing your offerings to potential clients.</p>
              </div>
            </div>
          </div>

        <div class="col">
            <div class="card">
              <img src="assets/temp_img.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Manage Bookings</h5>
                <p class="card-text">Use your dedicated dashboard to easily manage incoming event requests, track orders, and handle invoicing—all in one place.</p>
              </div>
            </div>
          </div>

            <div class="col">
              <div class="card">
                <img src="assets/temp_img.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Customize Your Menus</h5>
                  <p class="card-text">Highlight your unique culinary offerings and set prices, allowing clients to easily view and select from your menu.</p>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card">
                <img src="assets/temp_img.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">
                    <h5 class="card-title">Analyze Performance</h5>
                  <p class="card-text">Access reporting tools to gain insights into your event revenue and customer preferences, helping you refine your services and marketing strategies.</p>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card">
                <img src="assets/temp_img.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Receive Payments Securely</h5>
                  <p class="card-text">Integrate with our online payment options, allowing customers to settle invoices directly through the platform.</p>
                </div>
              </div>
            </div>
        </div>
        </div>


















        <div class="row g-0 my-5 bg-image3">
            <!-- Hero Section 2 with Image -->
            <div class="col-6 col-md-9"> <!-- Same stuff from above -->
                <div class="p-5  hero bg-image3 ">          
                </div>
            </div>
            
            <!-- Hero Section 1 -->
            <div class="col-6 col-sm-6 col-md-3"> <!-- 12 when compressed, 6 on normal screens or smth -->
                <div class="p-5 bg-dark  hero">
                    <h1 style="font-family: Poppins, sans-serif; color: #fff;"><b> Catering To Your Needs </b></h1>
                    <p style="color: #fff;">DESCRIPTION DESCRIPTION WEDSCIPTION. <br>MORE TEXT MORE TEXT MORE TEXT</p>
                </div>
            </div>
    
            
        </div>

        <div class="col-12 col-md-12 col-lg-12 bg-image1 h-content-box rounded my-5">
            <div class="p-5  rounded">
                <h1 style="font-family: Poppins, sans-serif; color: #fff;" class="text-shadow-big"><b> Book a Catering Service</b></h1>
                <p style="color: #fff;" class="text-shadow">Looking for a catering service for an event? 
                    <br>Explore a diverse selection of catering options tailored to meet your unique needs!
                    <br>At DineTrack, we connect you with top-rated caterers who can make
                    <br>your event unforgettable
                </p>

                
                <a href="#" class="btn btn-home-sel" style="font-weight: bold;">LEARN MORE</a>
            </div>
            
        </div>

        <div class="card-group"  id="mission-vision">
            <div class="card">
              <img src="assets/pexels-fauxels-3184338.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title" style="font-family: Poppins, sans-serif;">Mission</h5>
                <p class="card-text">At DineTrack, our mission is to empower catering businesses 
                    with innovative tools to seamlessly manage event bookings, optimize billing processes, 
                    and provide exceptional service through efficient and transparent operations.</p>
              </div>
            </div>
            <div class="card">
              <img src="assets/pexels-naimbic-2291367.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title" style="font-family: Poppins, sans-serif;">Vision</h5>
                <p class="card-text">Our vision at DineTrack is to become the go-to digital platform for catering companies, 
                    transforming how events are managed by fostering growth, innovation, and excellence in the catering industry.</p>
              </div>
            </div>
          </div>



    </main>
    



    

    <div class="sticky-bottom d-flex justify-content-end p-4">
        <a href="#">
            <button type="button" class="btn scroll_up">
                <img src="assets/arrow_up.svg" alt="Scroll Up Icon" style="width: 30px; height: 40px;">
            </button>
        </a>
    </div>
    
    
    



    
    <footer>
    <div class="footer-content">
        <div class="footer-left">
            <p>DineTrack &copy; 2024. All Rights Reserved.</p>
            <p>Email: support@dinetrack.com</p>
        </div>
        <div class="footer-right">
            <ul class="d-flex align-items-center justify-content-between">
                <li><a href="index.html" class="btn footer-link-btn">Home</a></li>
                <li><a href="#" class="btn footer-link-btn">About Us</a></li>
                <li><a href="#" class="btn footer-link-btn">Catering Services</a></li>
                <li><a href="#" class="btn footer-link-btn">Register</a></li>
                <li><a href="login.html" class="btn footer-link-btn">Login</a></li>
            </ul>
        </div>
    </div>
    </footer>

    <script>

    </script>
    

</html>