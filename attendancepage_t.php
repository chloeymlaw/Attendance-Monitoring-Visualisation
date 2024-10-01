<?php
session_start();
$csvFile = 'users.csv';
$file = fopen($csvFile, 'r');

$allGrades = [[], [], []];
$allAttendance = [[], [], []];
$uniqueIDs = [];

// Looping through the CSV file to get the grade and attendance data of the students
while (($line = fgetcsv($file)) !== false) {
    if ($line[5] === "S") {
        $uniqueIDs[] = $line[0];
        for ($i = 1; $i <= 3; $i++) {
            $allGrades[$i][] = $line[6 + ($i - 1) * 2];
            $allAttendance[$i][] = $line[7 + ($i - 1) * 2];
        }
    }
}

fclose($file);
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <title>Student Attendance</title>

    <script>
        body{
            margin - bottom: 10px;
        }
    </script>
</head>

<body>
    <?php include "navbar.php"; ?>

    <!-- Title of the page -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center rounded" style="background:#91BDFF; margin-top:20px; margin-bottom:20px">
                <h1> Student's Attendance and Grades </h1>
            </div>
        </div>
    </div>

    <div class="container" style="background-color: #F0F0F0; margin-bottom: 20px;">

     <!-- Allowing the user to select which student they would like to highlight on the graph -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <label for="studentID" class="form-label">Enter student's unique ID you'd like to highlight:</label>
                <input type="text" class="form-control" id="studentID"
                    onkeyup="if(event.keyCode===13) enterStudent(this)" placeholder="Enter Unique ID">
            </div>
        </div>

         <!-- The different buttons of which module they would like to see and what type of graph -->
        <div class="container text-center mb-4">
            <div class="btn-group">
                <button onclick="displayM(1)" type="button" class="btn btn-primary"> Module 1 </button>
                <button onclick="displayM(2)" type="button" class="btn btn-primary"> Module 2 </button>
                <button onclick="displayM(3)" type="button" class="btn btn-primary"> Module 3 </button>
            </div>
            <br><br>
            <div class="btn-group">
                <button onclick="changeChartType('bar')" type="button" class="btn btn-secondary"> Bar Chart
                </button>
                <button onclick="changeChartType('polarArea')" type="button" class="btn btn-secondary"> Polar Area Chart
                </button>
                <button onclick="changeChartType('scatter')" type="button" class="btn btn-secondary"> Scatter Chart
                </button>
                <button onclick="changeChartType('radar')" type="button" class="btn btn-secondary"> Radar Chart
                </button>
            </div>
        </div>

         <!-- Creating a container for the graph to be displayed -->
        <div class="container chart-container"> <canvas id="myChart"></canvas></div>

        <!-- Installing Chart.js to make the graphs and the trendline plugin -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-trendline"></script>

        <script>
            allGrades = <?php echo json_encode($allGrades); ?>;
            allAttendance = <?php echo json_encode($allAttendance); ?>;
            uniqueIDs = <?php echo json_encode($uniqueIDs); ?>;
            currentMod = 1;
            chartType = 'bar';
            myChart = null;

            // Function which allows the entered student to be found in the database
            function enterStudent(ele) {
                enteredID = ele.value;
                found = false;

                for (i = 0; i < uniqueIDs.length; i++) {
                    if (enteredID === uniqueIDs[i]) {
                        highlightStudent(i);
                        alert("Found User");
                        found = true;
                        break;
                    }
                }
                if (!found) {
                    alert("User Not Found");
                }
            }

            // Function to highlight the specific student 
            function highlightStudent(studentIndex) {
                var datasets = myChart.data.datasets;

                datasets.forEach(function (dataset) {
                    var bars = dataset.backgroundColor;
                    dataset.backgroundColor = [];
                    bars = dataset.backgroundColor;

                    bars[studentIndex] = 'rgba(0, 255, 9, 0.8)';

                });
                myChart.update();
            }

            // Function to display the specific graph
            function displayM(module) {
                currentMod = module;
                if (chartType === 'scatter') {
                    updateScatterChart();
                } else {
                    updateChart();
                }
            }

            // Function to display the specific graph
            function changeChartType(type) {
                chartType = type;
                if (chartType === "scatter") {
                    updateScatterChart();
                } else {
                    updateChart();
                }
            }

            // Function to create the Scatter Graph data
            function generateScatterData() {
                var data = [];
                for (var i = 0; i < allGrades[currentMod].length; i++) {
                    data.push({
                        x: parseInt(allAttendance[currentMod][i]), 
                        y: parseInt(allGrades[currentMod][i])
                    });
                }
                return data;
            }

            // Function to create the actual Scatter Graph
            function updateScatterChart() {
                if (myChart) {
                    myChart.destroy();
                }

                chart = document.getElementById('myChart').getContext('2d');
                myChart = new Chart(chart, {
                    type: 'scatter',
                    data: {
                        datasets: [{
                            label: `Module ${currentMod}`,
                            data: generateScatterData(),
                            backgroundColor: 'rgba(54, 162, 235, 0.8)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            pointRadius: 5,
                            pointHoverRadius: 8,
                            pointHoverBackgroundColor: 'rgba(255, 99, 132, 0.8)',
                            pointHoverBorderColor: 'rgba(255, 99, 132, 1)',
                            trendlineLinear: {
                                style: "rgba(255, 99, 132, 0.8)",
                                lineStyle: "solid",
                                width: 3
                            }
                        }]
                    },
                    options: {
                        scales: {
                            x: [{
                                title: {
                                    display: true,
                                    text: 'Attendance'
                                },
                                type: 'linear',
                                position: 'bottom',
                                ticks: {
                                    beginAtZero: true,
                                    max: 100
                                }
                            }],
                            y: [{
                                title: {
                                    display: true,
                                    text: 'Grades'
                                },
                                ticks: {
                                    beginAtZero: true,
                                    max: 100
                                }
                            }]
                        },
                        title: {
                            display: true,
                            text: `Module ${currentMod}`
                        }
                    }
                });
            }

            // Function to create the graphs that are not Scatter Graphs
            function updateChart() {
                if (myChart) {
                    myChart.destroy();
                }

                chart = document.getElementById('myChart').getContext('2d');
                myChart = new Chart(chart, {
                    type: chartType,
                    data: {
                        labels: uniqueIDs,
                        datasets: [{
                            label: 'Grade',
                            data: allGrades[currentMod],
                            backgroundColor: 'rgba(176, 254, 255, 0.8)',
                            borderColor: 'rgba(0,0,0,1)',
                            borderWidth: 1
                        }, {
                            label: 'Attendance',
                            data: allAttendance[currentMod],
                            backgroundColor: 'rgba(242, 179, 184, 1)',
                            borderColor: 'rgba(0,0,0,1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }

        </script>

</body>

</html>