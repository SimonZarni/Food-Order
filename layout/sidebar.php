<?php
session_name('user');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Drop</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg fixed-top bg-body-tertiary">
            <div class="container-fluid">
                <!-- Button for collapsing the navbar on smaller screens -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- FoodDrop brand, search form, and login button -->
                <a class="navbar-brand mx-auto p-3" href="index.php">
                    <h2 style="color: rgb(209, 186, 130);">FoodDrop</h2>
                </a>

                <!-- Collapsible section of the navbar -->
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 head-color text-center">
                        <li class="nav-item">
                            <a class="nav-link" href="menu.php">Menu</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Restaurants</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Vouchers</a>
                        </li> -->
                    </ul>
                </div>

                <div class="d-flex ms-auto">
                    <div>
                        <?php
                        if (isset($_SESSION['name'])) {
                        ?>
                            <div class="dropdown">
                                <a class="btn btn-link dropdown-toggle" style="color: rgb(209, 186, 130)" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person fs-4 mt-2"></i> <?php echo $_SESSION['name']; ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="edit_profile.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="mt-2">
                                <a href="login.php" class="btn login mx-2">Log In</a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <ul class="nav cartbtn" style="margin-top:12px;">
                        <li class="mx-3">
                            <a class="text-decoration-none fs-5" style="color: rgb(209, 186, 130);" href="favourite.php?user_id=<?php if (isset($_SESSION['id'])) echo $_SESSION['id']; ?>"><i class="bi bi-heart"></i></a>
                        </li>
                        <li class="mx-3">
                            <a class="text-decoration-none fs-5" style="color: rgb(209, 186, 130);" href="orders.php?id=<?php if (isset($_SESSION['id'])) echo $_SESSION['id']; ?>"><i class="bi bi-phone"></i></a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </header>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</html>