<?php

session_start();

// Destroys session when log out clicked for security
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.html");
    exit();
}

?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/navbar.css">

</head>

<!-- Logo and Navbar -->
<nav class="navbar sticky-top navbar-expand-sm navbar-light" style="background-color: #e3f2fd;">
    <div class="container">
        <div class="title">
            <a class="navbar-title">
                <h1> University of Sussex </h1>
        </div>

        <!-- Collapsible Navbar Menu Icon -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="welcome.php">Home</a>
                </li>

                <!-- Dashboard changes whether they are a student or teacher -->
                <?php if ($_SESSION['userType'] === 'S') { ?>
                    <li class="nav-item dropdown" data-bs-toggle="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Menu</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="attendancepage_s.php">Attendance</a>
                            <a class="dropdown-item" href="help_s.php"> Get Help</a>
                        </div>
                    </li>
                <?php } elseif ($_SESSION['userType'] === 'T') { ?>
                    <li class="nav-item dropdown" data-bs-toggle="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Menu</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="attendancepage_t.php">Attendance</a>
                            <a class="dropdown-item" href="studentfeedback.php">Student Feedback</a>
                        </div>
                    </li>
                <?php } ?>

                <li class="nav-item">
                    <a class="nav-link active" href="?logout=true">Log Out</a>
                </li>

            </ul>
        </div>
    </div>
</nav>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>