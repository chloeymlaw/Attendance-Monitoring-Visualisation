<?php

$feedbackCsvFile = 'feedback.csv';
$Ffile = fopen($feedbackCsvFile, 'r');

$UserCsvFile = 'users.csv';
$Ufile = fopen($UserCsvFile, 'r');

$allFeedback = [];
$allUsers = [];

// Reading feedback data from CSV file into an associative array
fgetcsv($Ffile);
while (($line = fgetcsv($Ffile)) !== false) {
    $feedback = [
        'uniqueID' => $line[0],
        'Module 1' => $line[1],
        'Module 2' => $line[2],
        'Module 3' => $line[3]
    ];
    $allFeedback[] = $feedback;
}
fclose($Ffile);

// Get user's email to allow the teacher to contact them
fgetcsv($Ufile);
while (($line = fgetcsv($Ufile)) !== false) {
    $user = [
        'uniqueID' => $line[0],
        'email' => $line[4]
    ];
    $allUsers[] = $user;
}
fclose($Ufile);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Student Feedback</title>
    <style>
        .feedback-box {
            border: 1px solid #D3D3D3;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php include "navbar.php"; ?>

    <!-- Title of the Page --> 
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center rounded" style="background:#91BDFF; margin-top:20px; margin-bottom:20px">
                <h1> Student Feedback </h1>
            </div>
        </div>
    </div>

    <!-- Buttons to allow the teacher to display a specific module's feedback -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center rounded"
                style="background:#C0DEFF; padding:10px; max-width: 600px; margin: 0 auto;">
                <form method="post">
                    <button type="submit" name="module" value="Module 1" class="btn btn-primary">Module 1</button>
                    <button type="submit" name="module" value="Module 2" class="btn btn-primary">Module 2</button>
                    <button type="submit" name="module" value="Module 3" class="btn btn-primary">Module 3</button>
                </form>
            </div>
        </div>
    </div>
    <br>

    <!-- Container where the teacher is able to see the feedback from students for a particular module --> 
    <div class="container rounded" style="background-color: #F8F8F8; margin-bottom: 20px; round">
        <div id="feedbackContainer">
            <?php
            if (isset($_POST['module'])) {
                $selectedModule = $_POST['module'];
                echo "<h2>Feedback for $selectedModule</h2><br>";
                $feedbackFound = false;

                // Displaying all the relevant feedback
                foreach ($allFeedback as $feedback) {
                    $moduleFeedback = $feedback[$selectedModule];
                    if (!empty($moduleFeedback)) {
                        $userEmail = '';
                        foreach ($allUsers as $user) {
                            if ($user['uniqueID'] === $feedback['uniqueID']) {
                                $userEmail = $user['email'];
                                break;
                            }
                        }
                        echo '<div class="feedback-box">';
                        echo '<p><strong>Student ID:</strong> ' . $feedback['uniqueID'] . '</p>';
                        echo '<p><strong>Email:</strong> ' . $userEmail . '</p>';
                        echo "<p><strong>$selectedModule Feedback:</strong> $moduleFeedback</p>";
                        echo '</div>';
                        $feedbackFound = true;
                    }
                }
                if (!$feedbackFound) {
                    echo "<p>No feedback available for $selectedModule</p>";
                }
            }
            ?>
        </div>
    </div>

</body>

</html>