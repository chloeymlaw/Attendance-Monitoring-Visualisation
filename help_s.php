<?php
session_start();

// Checking if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feedback = $_POST['feedback'];
    $selected_module = $_POST['module'];
    $user = $_SESSION['username'];

    // Opening the file for writing
    $file = fopen('feedback.csv', 'a+');
    if ($file === false) {
        die("Error: Unable to open file.");
    }

    $data = array(
        'uniqueID' => $_SESSION['username'],
        'module1' => '',
        'module2' => '',
        'module3' => ''
    );

    // Setting the feedback in the corresponding module column
    if ($selected_module == "Module 1") {
        $data['module1'] = $feedback;
    } elseif ($selected_module == "Module 2") {
        $data['module2'] = $feedback;
    } elseif ($selected_module == "Module 3") {
        $data['module3'] = $feedback;
    }

    fclose($file);

    header("Location: help_s.php?success=1");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Help</title>

    <style>
        body {
            font-family: "Fira Sans";
        }
    </style>
</head>

<body>
    <?php include "navbar.php"; ?>

    <!-- Title of the Page -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center rounded" style="background:#91BDFF; margin-top:20px; margin-bottom:20px">
                <h1> Get Help </h1>
            </div>
        </div>
    </div>

    <!-- Once the user enters their concerns, a pop up alert will appear -->
    <script>
        function showAlertAndRedirect() {
            alert("Successfully sent!");
            window.location.href = "help_s.php";
        }
    </script>

    <!-- Allows the user to enter any concerns they might have -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center rounded" style="background:#F6F6F6; margin-top:20px; margin-bottom:20px">
                <form method="post" onsubmit="showAlertAndRedirect()">
                    <label for="feedback">Enter your any concerns you have:</label><br>
                    <textarea id="feedback" name="feedback" rows="4" cols="50"></textarea><br><br>
                    <a>And then select which module this is for (this will automatically enter as you press):</a><br>
                    <input type="submit" name="module" class="btn btn-primary" value="Module 1">
                    <input type="submit" name="module" class="btn btn-primary" value="Module 2">
                    <input type="submit" name="module" class="btn btn-primary" value="Module 3">
                </form>
            </div>
        </div>
    </div>
</body>

</html>