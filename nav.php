<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#">Movie Shop</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION["id"])): ?>
            <li class="nav-item">
                <a class="nav-link" href="register-user.php">Add User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add-products.php">Add Movie</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register-customer.php">Add Customer</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="logout.php">LogOut</a>
            </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Dropdown link
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Link 1</a>
                        <a class="dropdown-item" href="#">Link 2</a>
                        <a class="dropdown-item" href="#">Link 3</a>
                    </div>
                </li>



            <?php endif; ?>
        </ul>
    </div>
</nav>
