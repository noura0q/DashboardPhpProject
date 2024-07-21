<?php



$servername = "localhost";
$username = "root";
$password = "root"; 
$dbname = "dashboarddb";

$link = new mysqli($servername, $username, $password, $dbname);
// CHART 1 Query -------------- Ksa Region Wise Learners’ Distribution

$cities = array(); // Initialize an empty array to store cities and their counts
$res = mysqli_query($link, "SELECT City, COUNT(*) AS Total FROM `randompeople` GROUP BY City ORDER BY Total DESC"); // Query to get city counts
while ($row = mysqli_fetch_assoc($res)) {
    $city = $row['City'];
    $total = $row['Total'];
    $cities[] = array(
        "label" => $city,
        "y" => $total
    );
}

// CHART 2 Query -------------- Profession And proficiency Level Relation


// Initialize arrays to store the data
$professions = [];
$moe_data = [];
$hr_data = [];
$defense_data = [];

// Query to get profession data
$sql = "SELECT Profession, ProficiencyLevelRelation, COUNT(*) as count FROM `randompeople` GROUP BY Profession, ProficiencyLevelRelation";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    $data = [
        'MoE' => ['Student' => 0, 'Job Seeker' => 0, 'Public' => 0, 'Private' => 0],
        'HR' => ['Student' => 0, 'Job Seeker' => 0, 'Public' => 0, 'Private' => 0],
        'Defence' => ['Student' => 0, 'Job Seeker' => 0, 'Public' => 0, 'Private' => 0]
    ];

    // Fetch data and update the nested array
    while ($row = mysqli_fetch_assoc($result)) {
        $profession = $row['Profession'];
        $proficiency = $row['ProficiencyLevelRelation'];
        $count = $row['count'];
        $data[$profession][$proficiency] = $count;
    }

    // Extract data for chart
    $professions = ['Student', 'Job Seeker', 'Public', 'Private'];
    foreach ($professions as $proficiency) {
        $moe_data[] = $data['MoE'][$proficiency];
        $hr_data[] = $data['HR'][$proficiency];
        $defense_data[] = $data['Defence'][$proficiency];
    }
} else {
    echo "0 results";
}

// CHART 3 Query -------------- Monthly regestired users 
// Initialize an array to store the monthly data
$monthly_data = [];
// Query to get monthly registered users data
$sql = "SELECT Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, December FROM mru LIMIT 1";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    // Fetch data and store in the array
    $row = mysqli_fetch_assoc($result);
    $monthly_data = array_values($row);
} else {
    echo "0 results";
}

// CHART *6* Query --------------  Learners Experience Levels
// SQL query to fetch YearsOfExp data
$sqltwo = "SELECT YearsOfExp, COUNT(*) AS LearnerCount FROM randompeople GROUP BY YearsOfExp ORDER BY YearsOfExp ASC";
$result = mysqli_query($link, $sqltwo);

$data = [
    '0-2' => 0,
    '3-4' => 0,
    '5-10' => 0,
    '10+' => 0
];

if ($result->num_rows > 0) {
    // Fetch data from each row
    while ($row = $result->fetch_assoc()) {
        $years = (int)$row['YearsOfExp'];
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

$daily_data = [];

// CHART *7* Query -------------- Daily Reg. Users
// Query to get Daily registered users data
$sqlChart7 = "SELECT Sat, Sun, Mon, Tue, Wed, Thu, Fri FROM dru LIMIT 1";
$resultChart7 = mysqli_query($link, $sqlChart7);

if (mysqli_num_rows($resultChart7) > 0) {
    // Fetch data and store in the array
    $row = mysqli_fetch_assoc($resultChart7);
    $daily_data = array_values($row);
} else {
    echo "0 results";
}

// CHART *9* Query -------------- Top 5 Cities
$cities910 = array();
$sqlCities = "SELECT city, population FROM chart910 ORDER BY population DESC LIMIT 5";
$resultChart910 = mysqli_query($link, $sqlCities);

if ($resultChart910->num_rows > 0) {
    // Fetching data and storing in array
    while($row = $resultChart910->fetch_assoc()) {
        $cities910[] = array(
            'name' => $row['city'],
            'population' => $row['population']
        );
    }
}

// CHART *10* Query -------------- Top 5 Universities
$universities = array();
$sqlUniversities = "SELECT Uni, StudentsOfUni FROM chart10 ORDER BY StudentsOfUni DESC LIMIT 5";
$resultUniversities = mysqli_query($link, $sqlUniversities);

if ($resultUniversities->num_rows > 0) {
    // Fetching data and storing in array
    while($row = $resultUniversities->fetch_assoc()) {
        $universities[] = array(
            'uni' => $row['Uni'],
            'students' => $row['StudentsOfUni']
        );
    }
}

// CHART *4* Query -------------- Education Details
// Query to get education details
$education_data = [];
$sqlEducation = "SELECT EducationDetails, COUNT(*) AS Total FROM randompeople GROUP BY EducationDetails";
$resultEducation = mysqli_query($link, $sqlEducation);

if ($resultEducation->num_rows > 0) {
    while ($row = $resultEducation->fetch_assoc()) {
        $education_detail = $row['EducationDetails'];
        $total = (int)$row['Total'];
        $education_data[] = [
            "label" => $education_detail,
            "value" => $total
        ];
    }
} else {
    echo "0 results";
}

// CHART *8* Query -------------- Malse & Female
$sqlgender = "SELECT gender, COUNT(*) as count FROM randompeople GROUP BY gender";
$resultgender = mysqli_query($link, $sqlgender);
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
mysqli_close($link);

// Convert PHP array to JSON
$data_json = json_encode(array_values($data));
$labels_json = json_encode(array_keys($data));
?>

<!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="Dashboard1.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <script src="db1.js"></script>
</head>

<body>
  <div class="AimsRegistrationDashboard">
    <div class="Bg bg-1"></div>
    <div class="Bg bg-2"></div>
    <div class="Domains">Domains</div>
    <div class="Group1171278483">
      <div class="Group1171278480">
        <div class="Group1171278331">
          <div class="Ellipse1162 active"></div>
          <div class="Vector4 checked"></div>
        </div>
        <div class="Moe">MoE</div>
      </div>
      <div class="Group1171278481">
        <div class="Group1171278331">
          <div class="Ellipse1162"></div>
          <div class="Vector4"></div>
        </div>
        <div class="Hr">HR</div>
      </div>
      <div class="Group1171278482">
        <div class="Group1171278331">
          <div class="Ellipse1162"></div>
          <div class="Vector4"></div>
        </div>
        <div class="Defense">Defense</div>
      </div>
      <div class="Group1171278484">
        <div class="Group1171278331">
          <div class="Ellipse1162"></div>
          <div class="Vector4"></div>
        </div>
        <div class="Others">Others</div>
      </div>
    </div>
    <div class="Bg bg-3"></div>
    <div class="Group1171278479">
      <div class="LearnersRegistered">Learners Registered</div>
      <div class="LearnerCount">156,821</div>
    </div>
    <div class="MsaiRegistrationDashboard">MSAI: Registration Dashboard</div>
  
    <!--      From here I start to divide the sections of the dashboard-->

    <div class="charts-section">
    <div class="chart-container">
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
      </div>
      <div class="chart-container">
        <canvas id="professionChart"></canvas>
      </div>
      <div class="chart-container">
        <canvas id="MonthlyRU" width="1400" height="700"></canvas>
      </div>
      <div class="chart-container">
        <canvas id="chart4"  width="1144" height="700"></canvas>
      </div>
      <div class="chart-container">
      <div class= "chartNAME">MAP</div>
        <div id="chart_div"  width: auto height: auto></div>
        </div>
        <div class="chart-container">
        <canvas id="chart6" width="1144" height="700"></canvas>
      </div>
      <div class="chart-container">
        <canvas id="chart7" width="1144" height="700"></canvas>
      </div>
      <div class="chart-container">
        <canvas id="chart8" width="1144" height="700"></canvas>
      </div>

<!--      // Chart 9 and 10 - the next two tables-->

      <div class="chart-container">
      <h2>Top 5 cities</h2>
    <table>
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
    <div class="chart-container">
        <h2>Top 5 Universities</h2>
        <table>
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
<!--      NOW FOR THE OTHER DASHBOARDS -->

  <script>
    // Chart 1 - Ksa Region Wise Learners’ Distribution
    // Extract PHP array $cities into JavaScript
    const citiesData = <?php echo json_encode($cities); ?>;
    // Extract city names and totals from PHP array
    const cities = Object.keys(citiesData);
    const totals = Object.values(citiesData);
    const cityColors = ['#FFB800', '#4582F9', '#3ABDF2', '#7B68FF', '#00BC8B', '#A02EE0', '#FAC958', '#F44749', '#E33993', '#7FBE5B'];
    // Data points with cities and their counts
    var dataPoints = <?php echo json_encode($cities, JSON_NUMERIC_CHECK); ?>;
    // Assign colors to each data point
    for (var i = 0; i < dataPoints.length; i++) {
      dataPoints[i].color = cityColors[i % cityColors.length];
    }
    var chart = new CanvasJS.Chart("chartContainer", {
      theme: "light2",
      animationEnabled: true,
      title: {
        display: true,
        text: "Ksa Region Wise Learners’ Distribution",
        fontSize: 24,
        fontFamily: 'Poppins'
      },
      data: [{
        type: "doughnut",
        indexLabel: "{label}",
        showInLegend: true,
        legendText: "{label}: {y}", // Adjusted legend text format
        dataPoints: dataPoints
      }]
    });
chart.render();

  
    //  Chart 2 - Profession and Proficiency Level Relation Chart
    const professions = <?php echo json_encode($professions); ?>;
    const moeData = <?php echo json_encode($moe_data); ?>;
    const hrData = <?php echo json_encode($hr_data); ?>;
    const defenseData = <?php echo json_encode($defense_data); ?>;

    const professionCtx = document.getElementById('professionChart').getContext('2d');
    new Chart(professionCtx, {
      type: 'bar',
      data: {
        labels: professions,
        datasets: [{
          label: 'MoE',
          data: moeData,
          backgroundColor: '#4582F9'
        }, {
          label: 'HR',
          data: hrData,
          backgroundColor: '#00BC8B'
        }, {
          label: 'Defense',
          data: defenseData,
          backgroundColor: '#FFB800'
        }]
      },
      options: {
        indexAxis: 'y', // Set the axis to be horizontal
        responsive: true,
        scales: {
          x: {
            stacked: true, // Stack bars horizontally
            ticks: {
              beginAtZero: true
            }
          },
          y: {
            stacked: true, // Stack bars vertically
            ticks: {
              callback: function(value) {
                // Map numeric values to labels
                switch (value) {
                  case 0:
                    return 'Student';
                  case 1:
                    return 'Job Seeker';
                  case 2:
                    return 'Public';
                  case 3:
                    return 'Private';
                  default:
                    return ''; // Handle unexpected values
                }
              }
            }
          }
        },
        plugins: {
          legend: {
            position: 'bottom', // Adjust legend position
          },
          title: {
            display: true,
            text: 'Profession And Proficiency Level Relation',
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

    // Chart 3 -  MRU
    window.onload = function() {
      const monthlyData = <?php echo json_encode($monthly_data); ?>;
      const MRU = document.getElementById('MonthlyRU').getContext('2d');
      new Chart(MRU, {
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
              stacked: true
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





    }

    // Chart 4 - Education Details
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


    // chart 5 - MAP (needs API key)
    google.charts.load('current', {
       'packages': ['geochart'],
       // Note: Because markers require geocoding, you'll need a mapsApiKey.
       // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
       'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
     });
     google.charts.setOnLoadCallback(drawMarkersMap);

      function drawMarkersMap() {
      var data = google.visualization.arrayToDataTable([
        ['City',   'Population', 'Area'],
        ['Riyadh',      2761477,    1285.31]
      ]);

      var options = {
        region: 'SA',
        displayMode: 'markers',
        colorAxis: {colors: ['green', 'blue']}
      };

      var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    };
    // Chart 6 - Learners Experience Levels
    
    document.addEventListener('DOMContentLoaded', (event) => {
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
                    //     barThickness: 20, // Adjust this value for desired spacing
                    //     barPercentage: 0.6, // Adjust this value to control the bar width
                    //     categoryPercentage: 0.5 // Adjust th
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
    
    // chart 7 - Daily Reg.Users
      const dailyData = <?php echo json_encode($daily_data); ?>;
      const dru = document.getElementById('chart7').getContext('2d');
      new Chart(dru, {
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
      </script>
<script>
    // Fetch the data from PHP
    const femaleCount = <?php echo $datagender['Female']; ?>;
    const maleCount = <?php echo $datagender['Male']; ?>;

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
</script>

  </body>
</html>
