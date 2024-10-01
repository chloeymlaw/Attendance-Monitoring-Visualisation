<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Welcome</title>

    <!-- CSS to style the webpage -->
    <style>
        body {
            z-index: -1;
        }

        .logo {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .logo h1 {
            font-size: 45px;
        }

        .welcomeimg {
            max-width: 500px;
            margin: 0 auto;
        }

        .col-md-5 h3 {
            font-size: 20px;
        }
        
        .col-md-5 {
            padding: 20px; 
            margin-bottom: 20px; 
            border-radius: 20px; 
            background-color: #f8f9fa; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
        }
    </style>

</head>

<body>
    <?php include "navbar.php"; ?>

    <!-- Title of Page -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center rounded" style="background:#91BDFF; margin-top:20px">
                <div class="logo">
                    <a class="navbar-brand">
                        <?php
                        session_start();
                        echo "<h1>Welcome, " . $_SESSION['firstName'] . "!</h1>";
                        ?>
                    </a>
                </div>
            </div>
        </div>

        <!-- Image that appears on the webpage --> 
        <br>
        <div class="row">
            <div class="col-md-12" style=margin-bottom:20px;>
                <div class="welcomeimg">
                    <img src="assets/img/sussexcampus.png" alt="Picture of Sussex Campus" class="img-fluid rounded">
                </div>
            </div>
        </div>

        <!-- Useful links for the user to see --> 
        <div class="row justify-content-center">
        <div class="col-md-5 mr-md-2">
                <h2 class="text-center">Useful Links</h2>
                <h3 class="text-left">Case Studies which show a positive correlation between grades and attendance:</h3>
                <ul>
                    <li><a
                            href="https://citeseerx.ist.psu.edu/document?repid=rep1&type=pdf&doi=b4d47a6ce23bac12418cccc3d6ca75c0273bbc70">
                            "The Effect of Attendance on Academic Performance" by Guleker and Keci</a></li>
                    <li><a
                            href="https://d1wqtxts1xzle7.cloudfront.net/37553178/The_effect_of_students_performance_on_academic_performance-libre.pdf?1430919720=&response-content-disposition=inline%3B+filename%3DTHE_EFFECT_OF_STUDENT_S_ATTENDANCE_ON_AC.pdf&Expires=1714162040&Signature=BcD1yWL8bpmI5GTbNieN19FxCwgqxetqU2ONGm0L6~T73uVRwY7Xp66Fh3fxTU~tfxf5oIzGuuQf6aAWz-Mm2RG4ElFpn~7O5EmPS83W3atjn5oWYJ7Z8mhuhDl-DD9HTf39hD8lBJ0PZsMmnNjg441bdJmDb3hT1IR~cbpIgZrM1Gt-EYziDhLG69icj96VbX4hQc~NZCZe5MMTHyAOWnXvmqp~5iHNBDK0V66hQk5dg6X-hSGbZeKT2q~H-1u8fjZt3Mp3s5uHjtsKRtPLyIQcOYjCUnjRsGG5ol2qTz99vQRn-6oAWRDD2b~dqGDE3CyCB81fp-DtUp5unBDi5g__&Key-Pair-Id=APKAJLOHF5GGSLRBV4ZA">
                            "The Effect of Student's Attendance on Academic Performance" by Aden, Yahye and Dahir</a>
                    </li>
                    <li><a
                            href="https://dspace.unza.zm/server/api/core/bitstreams/173fe023-0a59-4243-b557-89614fdda2b9/content">
                            "Class Attendance and Student Performance" by Chishimba</a></li>
                </ul>
            </div>

            <!-- Depending if they are a student or teacher, the following appears on the screen -->
            <div class="col-md-5 ml-md-2">
                <h2 class="text-center"> How to Navigate through the Website </h2>
                <?php if ($_SESSION['userType'] === 'S') { ?>
                    <h3> How to see the graph correlation of grades and attendance</h3>
                    <ol>
                        <li> Click Menu on the Navigation Bar</li>
                        <li> Select "Attendance" </li>
                        <li> Select the Module you would like to view and what type of graph</li>
                    </ol>
                    <h3> How to Contact a Teacher</h3>
                    <ol>
                        <li> Click Menu on the Navigation Bar</li>
                        <li> Select "Get Help" </li>
                        <li> Enter the details you would like to send to your tutor and specify which module it is for, then
                            select enter</li>
                    </ol>
                <?php } elseif ($_SESSION['userType'] === 'T') { ?>
                    <h3> How to see the graph correlation of grades and attendance</h3>
                    <ol>
                        <li> Click Menu on the Navigation Bar</li>
                        <li> Select "Attendance" </li>
                        <li> Select the Module you would like to view and what type of graph</li>
                    </ol><br>
                    <h3> How to see Feedback from Students</h3>
                    <ol>
                        <li> Click Menu on the Navigation Bar</li>
                        <li> Select "Student Feedback" </li>
                        <li> Select the Module you would like to view the feedback of</li>
                    </ol>
                <?php } ?>
            </div>
        </div>
    </div>



    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>

</body>

</html>