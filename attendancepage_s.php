<?php
session_start();

$csvFile = 'users.csv';
$username = $_SESSION['username'];

$file = fopen($csvFile, 'r');

// Initialising arrays for the grades and attendances to be stored in
$moduleGrades = [];
$moduleAttendance = [];

// Looping through each line of the CSV file to find the relevant data
while (($row = fgetcsv($file)) !== false) {
    if ($row[0] === $username) {
        for ($i = 1; $i <= 3; $i++) {
            $moduleGrades[$i] = $row[6 + ($i - 1) * 2];
            $moduleAttendance[$i] = $row[7 + ($i - 1) * 2];
        }
        break;
    }
}
fclose($file);
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <title>Attendance</title>

</head>

<body>
    <?php include "navbar.php"; ?>

     <!-- Title of the Page -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center rounded" style="background:#91BDFF; margin-top:20px; margin-bottom:20px">
                <?php echo "<h1> Attendance for " . $_SESSION['firstName'] . "</h1>"; ?>
            </div>
        </div>
    </div>

    <!-- Buttons to allow users to pick which module they would like to see and 
    what type of chart they would like to see their data presented on -->
    <div class="container" style="background-color: #F0F0F0;">
        <div class="container text-center mb-4">
            <div class="btn-group">
                <button onclick="graphM(1)" type="button" class="btn btn-primary">Module 1</button>
                <button onclick="graphM(2)" type="button" class="btn btn-primary">Module 2</button>
                <button onclick="graphM(3)" type="button" class="btn btn-primary">Module 3</button>
            </div>
            <br><br>
            <div class="btn-group">
                <button onclick="changeChartType('bar')" type="button" class="btn btn-secondary">Bar Chart</button>
                <button onclick="changeChartType('polarArea')" type="button" class="btn btn-secondary">Polar Area
                    Chart</button>
                <button onclick="changeChartType('line')" type="button" class="btn btn-secondary">Line Chart</button>
            </div>
        </div>

        <div id="csvData"></div>

        <!-- Creating the container where the graphs will be placed -->
        <div class="container chart-container">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <!-- Importing Chart.js so the graphs are able to be created -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Using JavaScript to display the graphs -->
    <script>
        moduleGrades = <?php echo json_encode($moduleGrades); ?>;
        moduleAttendance = <?php echo json_encode($moduleAttendance); ?>;
        currentMod = 1;
        chartType = 'bar';
        myChart = null;

        // Function to allow the user to select which module they would like to be highlighted
        function graphM(module) {
            currentMod = module;
            updateChart();

            document.getElementById('module1').removeEventListener('click', changeModuleColor);
            document.getElementById('module2').removeEventListener('click', changeModuleColor);
            document.getElementById('module3').removeEventListener('click', changeModuleColor);

            document.getElementById('module' + module).addEventListener('click', changeModuleColor);
        }

        // Function to change the type of chart the user is viewing
        function changeChartType(type) {
            chartType = type;
            updateChart();
        }

        // Function to create/update the graph
        function updateChart() {
            if (myChart) {
                myChart.destroy();
            }

            chart = document.getElementById('myChart').getContext('2d');
            myChart = new Chart(chart, {
                type: chartType,
                data: {
                    labels: ['Module 1', 'Module 2', 'Module 3'],
                    datasets: [{
                        label: 'Grade',
                        data: [moduleGrades[1], moduleGrades[2], moduleGrades[3]],
                        backgroundColor: 'rgba(176, 254, 255, 0.8)',
                        borderColor: 'rgba(0,0,0,1)',
                        borderWidth: 1
                    }, {
                        label: 'Attendance',
                        data: [moduleAttendance[1], moduleAttendance[2], moduleAttendance[3]],
                        backgroundColor: 'rgba(242, 179, 184, 1)',
                        borderColor: 'rgba(0,0,0,1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        updateChart();

    </script>

</body>

</html>