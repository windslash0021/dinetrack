<div class="navbar navbar-design d-flex justify-content-between align-items-center">
    <div class="logo">  DineTrack <span class="material-symbols-outlined">menu_book</span> </div>
    <nav class="d-flex">

    </nav>
</div>

<div class="navbar navbar-design d-flex justify-content-between align-items-center">
    <nav class="d-flex">
        <ul class="d-flex list-unstyled mb-0">
            <li>
                <a href="index.php" 
                   class="btn btn-link text-white text-decoration-none nav-link-btn <?= $currentPage == 'index.php' ? 'active' : '' ?>">Home</a>
            </li>
            <li>
                <a href="about.php" 
                   class="btn btn-link text-white text-decoration-none nav-link-btn <?= $currentPage == 'about.php' ? 'active' : '' ?>">About</a>
            </li>
            <li>
                <a href="services.php" 
                   class="btn btn-link text-white text-decoration-none nav-link-btn <?= $currentPage == 'services.php' ? 'active' : '' ?>">Services</a>
            </li>
            <li class="dropdown">
            <a href="#" 
               class="btn btn-link text-white text-decoration-none dropdown-toggle nav-link-btn" 
               id="registerDropdown" 
               role="button" 
               data-bs-toggle="dropdown" 
               aria-expanded="false">
                Register
            </a>
            <ul class="dropdown-menu" aria-labelledby="registerDropdown">
                <li><a class="dropdown-item <?= $currentPage == 'register_service.php' ? 'active' : '' ?>" href="register_service.php">Caterer</a></li>
                <li><a class="dropdown-item <?= $currentPage == 'register_client.php' ? 'active' : '' ?>" href="register_client.php">Client</a></li>
            </ul>
        </li>
            <li>
                <a href="login.php" 
                   class="btn btn-link text-white text-decoration-none nav-link-btn <?= $currentPage == 'login.php' ? 'active' : '' ?>">Login</a>
            </li>
        </ul>
    </nav>
</div>

