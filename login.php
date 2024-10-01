<?php

session_start();

// Function to authenticate uniqueID, password and retrieve first name and user type 
function authenticateUser($username, $password) {
    $csvFile = 'users.csv';
    $file = fopen($csvFile, 'r');
    while (($line = fgetcsv($file)) !== FALSE) {
        if ($line[0] === $username && password_verify($password, $line[1])) {
            fclose($file);
            return array('firstName' => $line[2], 'userType' => $line[5]);
        }
    }
    fclose($file);
    return false;
}

// Sends the user to the welcome page if the login details are correct, otherwise it shows alert message 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userData = authenticateUser($username, $password);
    if ($userData !== false) {
        $_SESSION['username'] = $username;
        $_SESSION['firstName'] = $userData['firstName'];
        $_SESSION['userType'] = $userData['userType'];

        header("Location: welcome.php");
        exit();
    } else {
        echo '<script>alert("Invalid username or password");</script>';
    }
}
?>
