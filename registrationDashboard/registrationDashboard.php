<?php
include '../dbConnection.php';
include '../fetchKPIs.php';



// CHART 1 Query -------------- Ksa Region Wise Learners’ Distribution
$cities = array(); // Initialize an empty array to store cities and their counts
$res = mysqli_query($conn, "SELECT city, COUNT(*) AS Total FROM `Learner` GROUP BY city ORDER BY Total DESC LIMIT 5"); // Query to get city counts
while ($row = mysqli_fetch_assoc($res)) {
    $city = $row['city'];
    $total = $row['Total'];
    $cities[] = array(
        "label" => $city,
        "y" => $total
    );
}
// Convert PHP array to JSON for JavaScript
$cities_json = json_encode($cities, JSON_NUMERIC_CHECK);


$professions = [];
$moe_data = [];
$hr_data = [];
$defense_data = [];

// Query to get profession data
$sql = "SELECT profession, Domain, COUNT(*) as count FROM `Learner` GROUP BY profession, Domain";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $data = [
        'MoE' => ['Student' => 0, 'Job Seekers' => 0, 'Public' => 0, 'Private' => 0],
        'HR' => ['Student' => 0, 'Job Seekers' => 0, 'Public' => 0, 'Private' => 0],
        'Defense' => ['Student' => 0, 'Job Seekers' => 0, 'Public' => 0, 'Private' => 0]
    ];

    // Fetch data and update the nested array
    while ($row = mysqli_fetch_assoc($result)) {
        $profession = $row['profession'];
        $domain = $row['Domain'];
        $count = $row['count'];
        $data[$domain][$profession] = $count;
    }

    // Extract data for chart
    $professions = ['Student', 'Job Seekers', 'Public', 'Private'];
    foreach ($professions as $proficiency) {
        $moe_data[] = $data['MoE'][$proficiency];
        $hr_data[] = $data['HR'][$proficiency];
        $defense_data[] = $data['Defense'][$proficiency];
    }
} else {
    echo "0 results";
}
// Convert PHP arrays to JSON for JavaScript
$professions_json = json_encode($professions);
$moe_data_json = json_encode($moe_data);
$hr_data_json = json_encode($hr_data);
$defense_data_json = json_encode($defense_data);




// CHART 3 Query -------------- Monthly regestired users 
 // PHP code to process SQL query and fetch monthly data
 $monthly_data = array_fill(0, 12, 0); // Initialize an array for months

 // Query to get monthly registered users data
 $sql = "SELECT MONTH(registration_date) AS month, COUNT(*) AS count 
         FROM Learner 
         GROUP BY MONTH(registration_date)";
 $result = mysqli_query($conn, $sql);

 if (mysqli_num_rows($result) > 0) {
     // Fetch data and store in the array
     while($row = mysqli_fetch_assoc($result)) {
         $month = $row['month'];
         $count = $row['count'];
         $monthly_data[$month - 1] = $count; // Subtract 1 to use zero-based index
     }
 } else {
     echo "0 results";
 }




// CHART *6* Query -------------- Learners Experience Levels
// SQL query to fetch YearsOfExp data
$sqltwo = "SELECT years_of_experience, COUNT(*) AS LearnerCount FROM Learner GROUP BY years_of_experience ORDER BY years_of_experience ASC";
$result = mysqli_query($conn, $sqltwo);

$data = [
    '0-2' => 0,
    '3-4' => 0,
    '5-10' => 0,
    '10+' => 0
];

if ($result->num_rows > 0) {
    // Fetch data from each row
    while ($row = $result->fetch_assoc()) {
        $years = (int)$row['years_of_experience'];
        $count = (int)$row['LearnerCount'];

        if ($years >= 0 && $years <= 2) {
            $data['0-2'] += $count;
        } elseif ($years >= 3 && $years <= 4) {
            $data['3-4'] += $count;
        } elseif ($years >= 5 && $years <= 10) {
            $data['5-10'] += $count;
        } else {
            $data['10+'] += $count;
        }
    }
} else {
    echo "0 results";
}

// Encode PHP data into JSON for use in JavaScript
$data_json = json_encode(array_values($data));
$labels_json = json_encode(array_keys($data));



// CHART *7* Query -------------- Daily Reg. Users
// Initialize an array to store the daily data
$daily_data = array_fill(0, 7, 0);

// Query to get daily registered users data
$sqlChart7 = "SELECT DAYOFWEEK(registration_date) AS day, COUNT(*) AS count 
              FROM Learner 
              GROUP BY DAYOFWEEK(registration_date)";
$resultChart7 = mysqli_query($conn, $sqlChart7);

if (mysqli_num_rows($resultChart7) > 0) {
    // Fetch data and store in the array
    while($row = mysqli_fetch_assoc($resultChart7)) {
        $day = $row['day'];
        $count = $row['count'];
        // Adjust for zero-based index and shift so that Sunday = 0, Monday = 1, ..., Saturday = 6
        $daily_data[$day - 1] = $count;
    }
} else {
    echo "0 results";
}

// Encode PHP array to JSON for use in JavaScript
$daily_data_json = json_encode($daily_data);

// CHART *8* Query -------------- Male & Female
$sqlgender = "SELECT gender, COUNT(*) as count FROM Learner GROUP BY gender";
$resultgender = mysqli_query($conn, $sqlgender);
$datagender = array("Female" => 0, "Male" => 0);

if ($resultgender->num_rows > 0) {
    // Fetch data
    while ($row = $resultgender->fetch_assoc()) {
        if (strtolower($row['gender']) == 'female') {
            $datagender['Female'] = (int)$row['count'];
        } elseif (strtolower($row['gender']) == 'male') {
            $datagender['Male'] = (int)$row['count'];
        }
    }
}

// Convert PHP array to JSON for JavaScript
$data_json = json_encode(array_values($datagender));
$labels_json = json_encode(array_keys($datagender));

// CHART *9* Query -------------- Top 5 Cities
// Initialize an array to store the top 5 cities data
$cities910 = array();

// Query to get the top 5 cities by user count
$sqlCities = "SELECT city, COUNT(*) AS population 
              FROM Learner 
              GROUP BY city 
              ORDER BY population DESC 
              LIMIT 5";
$resultChart910 = mysqli_query($conn, $sqlCities);

if ($resultChart910->num_rows > 0) {
    // Fetching data and storing in array
    while($row = $resultChart910->fetch_assoc()) {
        $cities910[] = array(
            'name' => $row['city'],
            'population' => $row['population']
        );
    }
} else {
    echo "0 results";
}

// CHART *10* Query -------------- Top 5 Universities
// Initialize an array to store the top 5 universities data
$universities = array();

// Query to get the top 5 universities by user count where Domain is 'MoE'
$sqlUniversities = "SELECT subdomain AS Uni, COUNT(*) AS StudentsOfUni 
FROM Learner 
WHERE Domain = 'MoE' 
GROUP BY subdomain 
ORDER BY StudentsOfUni DESC 
LIMIT 5;";
$resultUniversities = mysqli_query($conn, $sqlUniversities);

if ($resultUniversities->num_rows > 0) {
    // Fetching data and storing in array
    while($row = $resultUniversities->fetch_assoc()) {
        $universities[] = array(
            'uni' => $row['Uni'],
            'students' => $row['StudentsOfUni']
        );
    }
} else {
    echo "0 results";
}

// CHART *4* Query -------------- Education Details
// Query to get education details
 // PHP code to process SQL query and fetch education details
 $education_data = [];
 $sqlEducation = "SELECT educational_level, COUNT(*) AS Total FROM Learner GROUP BY educational_level";
 $resultEducation = mysqli_query($conn, $sqlEducation);

 if ($resultEducation->num_rows > 0) {
     while ($row = $resultEducation->fetch_assoc()) {
         $education_detail = $row['educational_level'];
         $total = (int)$row['Total'];
         $education_data[] = [
             "label" => $education_detail,
             "value" => $total
         ];
     }
 } else {
     echo "0 results";
 }


mysqli_close($conn);


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="registrationDashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>


</head>

<body>
<div class="MsaiRegistrationDashboard">MSAI: Registration Dashboard</div>
<br><br><br><br>
    <div class="AimsRegistrationDashboard">
    </div>
    <div class="Group1171278554">
        <div class="kpi-container">
            <div class="kpi-item" style="width: 500pxpx;">
                <div class="text-container">
                <div class="box-content">
                        <span class="big">Learners Registered</span>
                        <div class="number"> <?php echo number_format($kpi_data_LR['user_id']); ?> </div>
                    </div>
                </div>
            </div>
            <div class="kpi-item" style="width: 900px;">
        <div class="text-container">
            <div class="box-content">
                <span class="big">Domain</span>
            </div>
            <div class="options-container">
                <label class="option">
                    <input type="radio" name="domain" value="MoE" checked>
                    <span class="checkmark"></span>
                    MoE
                </label>
                <label class="option">
                    <input type="radio" name="domain" value="Defense">
                    <span class="checkmark"></span>
                    Defense
                </label>
                <label class="option">
                    <input type="radio" name="domain" value="HR">
                    <span class="checkmark"></span>
                    HR
                </label>
                <label class="option">
                    <input type="radio" name="domain" value="Others">
                    <span class="checkmark"></span>
                    Others
                </label>
            </div>
        </div>
    </div>
         </div>

        </div>

                <div>
       
                <div class="dashboard-container">
     
    <div class="dashboard-item" style="width: 700px; height: 400px;">
   
    <!-- Chart 1 - Ksa Region Wise Learners’ Distribution -->
    <div class="chart-container">
        <canvas id="chart1" width="700" height="400"></canvas>
        <ul id="chart1Legend" class="chart-legend"></ul>
    </div>

    </div>
    <div class="dashboard-item" style="width: 700px; height: 400px;">

     <!-- Chart 2 - Profession And Proficiency Level Relation -->
     <div class="chart-container">
        <canvas id="professionChart" width="700" height="400"></canvas>
    </div>
    </div>
                </div>

          


        <div class="dashboard-container">
        <div class="dashboard-item  " style="width: 700px; height: 400px;" >
        <div class="chart-container">
        <canvas id="MonthlyRU" width="700" height="400"></canvas>
    </div>
        </div>
        <div class="dashboard-item  " style="width: 700px; height: 400px;" >

        <div class="chart-container">
        <canvas id="chart4" width="700" height="400"></canvas>
    </div>
        </div>
                </div>

                <div class="dashboard-container">
        <div class="dashboard-item  " style="width: 700px; height: 400px;" >
                <div class="chart-container">
        <div id="chart_div" style="width: 700px; height: 400px;"></div>
    </div>
                </div>

                <div class="dashboard-item  " style="width: 700px; height: 400px;" >

                <div class="chart-container">
        <canvas id="chart6" width="700" height="400"></canvas>
    </div>
                </div>
                </div>

                <div class="dashboard-container">
        <div class="dashboard-item  " style="width: 700px; height: 400px;" >
                <div class="chart-container">
        <canvas id="chart7" width="700" height="400"></canvas>
    </div>
        </div>

        <div class="dashboard-item  " style="width: 700px; height: 400px;" >
        <div class="chart-container">
        <canvas id="chart8" width="700" height="400"></canvas>
    </div>
                </div>
                </div>




        <div class="dashboard-container">
        <div class="dashboard-item  " style="width: 700px; height: 400px;" >
        <table>

   <caption>  <h2>Top 5 Cities</h2> </caption>
        <tbody>
            <?php foreach ($cities910 as $city910): ?>
                <tr>
                    <td><?php echo $city910['name']; ?></td>
                    <td><?php echo $city910['population']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="dashboard-item  " style="width: 700px; height: 400px;" >
<table> 
                <caption> <h2> Top 5 Universities </h2> </caption>
        <tbody>
            <?php foreach ($universities as $uni): ?>
                <tr>
                    <td><?php echo $uni['uni']; ?></td>
                    <td><?php echo $uni['students']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
                </div>

    </div>
    </div>

<script>
//Chart
document.addEventListener('DOMContentLoaded', (event) => {
            // Extract PHP array $cities into JavaScript
            const citiesData = <?php echo $cities_json; ?>;

            // Check if citiesData is correctly populated
            if (!Array.isArray(citiesData) || citiesData.length === 0) {
                console.error('Cities data is empty or not in the expected format.');
                return;
            }

            // Extract labels and data for Chart.js
            const labels = citiesData.map(item => item.label);
            const data = citiesData.map(item => item.y);
            const colors = ['#FFB800', '#4582F9', '#3ABDF2', '#7B68FF', '#00BC8B'];

            // Create the chart
            const ctx = document.getElementById('chart1').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Learners Count',
                        data: data,
                        backgroundColor: colors,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                generateLabels: function(chart) {
                                    const original = Chart.defaults.plugins.legend.labels.generateLabels;
                                    const labels = original.call(this, chart);

                                    // Add custom legend items
                                    labels.forEach((label, index) => {
                                        label.text += `: ${data[index]}`;
                                    });
                                    return labels;
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Ksa Region Wise Learners’ Distribution',
                            font: {
                                size: 24,
                                family: 'Poppins',
                                style: 'normal',
                                weight: 'bold'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.raw;
                                }
                            }
                        }
                    }
                }
            });
        });


//Chart 2
document.addEventListener('DOMContentLoaded', (event) => {
            // PHP to JavaScript data transfer
            const professions = <?php echo $professions_json; ?>;
            const moeData = <?php echo $moe_data_json; ?>;
            const hrData = <?php echo $hr_data_json; ?>;
            const defenseData = <?php echo $defense_data_json; ?>;

            const ctx = document.getElementById('professionChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: professions,
                    datasets: [
                        {
                            label: 'MoE',
                            data: moeData,
                            backgroundColor: '#4582F9',
                        },
                        {
                            label: 'HR',
                            data: hrData,
                            backgroundColor: '#00BC8B',
                        },
                        {
                            label: 'Defense',
                            data: defenseData,
                            backgroundColor: '#FFB800',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Profession and Proficiency Level Relation',
                            font: {
                                size: 24,
                                family: 'Poppins',
                                style: 'normal',
                                weight: 'bold'
                            },
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.raw;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            stacked: true,
                            title: {
                                display: true,
                                text: 'Proficiency Level'
                            }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Count'
                            },
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });

//Chart 3
           // JavaScript to render the chart
           window.onload = function() {
            const monthlyData = <?php echo json_encode($monthly_data); ?>;
            const ctx = document.getElementById('MonthlyRU').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Registered Users',
                        data: monthlyData,
                        backgroundColor: '#00BC8B'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            stacked: true,
                            barThickness: 20, // Adjust this value for desired spacing
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true // Ensure the y-axis starts at zero
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Monthly Registered Users',
                            font: {
                                size: 24,
                                family: 'Poppins',
                                style: 'normal',
                                weight: 'bold'
                            },
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.raw;
                                }
                            }
                        }
                    }
                }
            });
        };


  // Chart 4 - Education Details
  document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('chart4').getContext('2d');

            Chart.register({
                id: 'customCutout',
                beforeDraw: function(chart) {
                    const { width, height } = chart.chartArea;
                    const data = chart.data.datasets[0].data;
                    const total = data.reduce((a, b) => a + b, 0);

                    data.forEach((value, index) => {
                        const cutoutPercent = 100 - (value / total * 100);
                        const dataset = chart.getDatasetMeta(0).data[index];
                        dataset.outerRadius = Math.min(width, height) / 2;
                        dataset.innerRadius = (Math.min(width, height) / 2) * (cutoutPercent / 100);
                    });
                }
            });

            var educationChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode(array_column($education_data, 'label')); ?>,
                    datasets: [{
                        label: 'Education Details',
                        data: <?php echo json_encode(array_column($education_data, 'value')); ?>,
                        backgroundColor: [
                            '#FFA726',  // Basic School
                            '#42A5F5',  // High School
                            '#26A69A',  // Diploma
                            '#66BB6A',  // Bachelors
                            '#FFCA28',  // Masters
                            '#7E57C2'   // PhDs
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                          display: true,
                          text: 'Education Details',
                          font: {
                            size: 24,
                            family: 'Poppins',
                            style: 'normal',
                            weight: 'bold'
                          },
                        },
                        tooltip: {
                            enabled: true
                        },
                        customCutout: true
                    }
                }
            });
        });

               // Chart 5 - Google GeoChart (Map)
               google.charts.load('current', {
            'packages': ['geochart'],
            'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
        });
        google.charts.setOnLoadCallback(drawMarkersMap);

        function drawMarkersMap() {
            var data = google.visualization.arrayToDataTable([
                ['City', 'Population', 'Area'],
                ['Riyadh', 2761477, 1285.31]  // Example data
            ]);

            var options = {
                region: 'SA',
                displayMode: 'markers',
                colorAxis: { colors: ['green', 'blue'] }
            };

            var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

 // Chart 6 - Learners Experience Levels
 document.addEventListener('DOMContentLoaded', (event) => {
            // Use PHP to pass data to JavaScript
            const data = <?php echo $data_json; ?>;
            const labels = <?php echo $labels_json; ?>;

            var ctx = document.getElementById('chart6').getContext('2d');
            var experienceChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of Learners',
                        data: data,
                        backgroundColor: '#FFB800',
                        hoverBackgroundColor: '#FFB74D'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Years of Experience'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Learners'
                            },
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Learners Experience Levels',
                            font: {
                                size: 24,
                                family: 'Poppins',
                                style: 'normal',
                                weight: 'bold'
                            },
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += context.parsed.y.toLocaleString();
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });


               // Chart 7 - Daily Registered Users
               document.addEventListener('DOMContentLoaded', (event) => {
            // Use PHP to pass data to JavaScript
            const dailyData = <?php echo $daily_data_json; ?>;
            const ctx = document.getElementById('chart7').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
                    datasets: [{
                        label: 'Registered Users',
                        data: dailyData,
                        backgroundColor: '#4582F9'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            stacked: true,
                            maxBarThickness: 10, // Adjust this value for desired bar thickness
                        },
                        y: {
                            stacked: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Daily Registered Users',
                            font: {
                                size: 24,
                                family: 'Poppins',
                                style: 'normal',
                                weight: 'bold'
                            },
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.raw;
                                }
                            }
                        }
                    }
                }
            });
        });

         // Chart 8 - Male & Female
         document.addEventListener('DOMContentLoaded', (event) => {
            // Use PHP to pass data to JavaScript
            const femaleCount = <?php echo json_encode($datagender['Female']); ?>;
            const maleCount = <?php echo json_encode($datagender['Male']); ?>;

            const datas = {
                labels: ['Female', 'Male'],
                datasets: [{
                    data: [femaleCount, maleCount],
                    backgroundColor: ['#00b894', '#fdcb6e'],
                    hoverBackgroundColor: ['#00b894', '#fdcb6e']
                }]
            };

            const ksaRegionCtx = document.getElementById('chart8').getContext('2d');
            const myDoughnutChart = new Chart(ksaRegionCtx, {
                type: 'doughnut',
                data: datas,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                            display: true,
                            text: 'Male & Female',
                            font: {
                                size: 24,
                                family: 'Poppins',
                                style: 'normal',
                                weight: 'bold'
                            },
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.raw + ' people';
                                }
                            }
                        }
                    },
                    cutout: '70%',
                }
            });
        });

</script>

</body>
</html>



