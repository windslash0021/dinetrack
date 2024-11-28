<!DOCTYPE html>

<div class="navbar navbar-design d-flex justify-content-between align-items-center">
    <div class="logo">  DineTrack <span class="material-symbols-outlined">menu_book</span> <p style="font-size: 15px">Catering</p></div>
    <nav class="d-flex">

    </nav>
</div>

<div class="navbar navbar-design d-flex justify-content-between align-items-center">
    <nav class="d-flex">
        <ul class="d-flex list-unstyled mb-0">
            <li>
                <a href="service_dashboard.php" 
                   class="btn btn-link text-white text-decoration-none nav-link-btn">Dashboard</a>
            </li>

            <li class="nav-item dropdown">
                <a class="btn btn-link text-white text-decoration-none nav-link-btn dropdown-toggle"
                   href="#" id="menu-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Menu
                </a>
                <ul class="dropdown-menu" aria-labelledby="menu-dropdown">
                    <li><a class="dropdown-item" href="caterer_menus.php">Add New Meal</a></li>
                    <li><a class="dropdown-item" href="view_meals_in_package.php">View Meals</a></li>
                    <li><a class="dropdown-item" href="#">Manage Meals</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="btn btn-link text-white text-decoration-none nav-link-btn dropdown-toggle"
                   href="#" id="packages-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Packages
                </a>
                <ul class="dropdown-menu" aria-labelledby="packages-dropdown">
                    <li><a class="dropdown-item" href="create_package.php">Create Package</a></li>
                    <li><a class="dropdown-item" href="view_package.php">View Packages</a></li>
                    <li><a class="dropdown-item" href="#">Manage Packages</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="btn btn-link text-white text-decoration-none nav-link-btn dropdown-toggle"
                   href="#" id="billing-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Billing
                </a>
                <ul class="dropdown-menu" aria-labelledby="billing-dropdown">
                    <li><a class="dropdown-item" href="service.php">Invoices</a></li>
                    <li><a class="dropdown-item" href="service.php">Transaction History</a></li>
                </ul>
            </li>

            <li>
                <a href="service-settings.php" 
                   class="btn btn-link text-white text-decoration-none nav-link-btn">Settings</a>
            </li>

            <li>
                <a href="index.php" 
                   class="btn btn-link text-white text-decoration-none nav-link-btn">Logout</a>
            </li>
        </ul>
    </nav>
</div>

</html>
