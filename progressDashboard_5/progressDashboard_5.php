<?php
include '../dbConnection.php';

//QUERY Fetch overall learners completion status (half pie chart)
$sql = "SELECT 
SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) AS total_completed,
SUM(CASE WHEN status = 'incompleted' THEN 1 ELSE 0 END) AS total_incompleted
FROM user_courses;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_completed = $row["total_completed"];
    $total_incompleted = $row["total_incompleted"];
} else {
    $total_completed = 0;
    $total_incompleted = 0;
}


//QUERY Fetch learners completion status by domain (bar chart)
$sql2 = "SELECT user_domain, COUNT(*) AS completed_count FROM learners WHERE user_id IN ( SELECT user_id FROM user_courses WHERE status = 'completed' ) GROUP BY user_domain;";

$result2 = $conn->query($sql2);

// Fetch data from SQL result
$data = array();
while ($row = $result2->fetch_assoc()) {
    $domain = $row['user_domain'];
    $completed_count = $row['completed_count'];
    $data[$domain] = $completed_count;
}

// Convert fetched data to JavaScript object
$learnersCompletionData = json_encode(array_values($data));


$sql3 = "SELECT YEAR(uc.EnrolmentDate) AS year, 
               MONTH(uc.EnrolmentDate) AS month, 
               SUM(CASE WHEN uc.status = 'completed' THEN 1 ELSE 0 END) AS completed_count, 
               SUM(CASE WHEN uc.status != 'completed' THEN 1 ELSE 0 END) AS incompleted_count 
        FROM user_courses uc 
        GROUP BY YEAR(uc.EnrolmentDate), MONTH(uc.EnrolmentDate) 
        ORDER BY year, month;";

$result3 = $conn->query($sql3);

$completed_counts = array_fill(0, 12, 0);
$enrolled_counts = array_fill(0, 12, 0);

while ($row = $result3->fetch_assoc()) {
    $month = intval($row['month']) - 1; // Adjust month to 0-indexed for JavaScript
    $completed_counts[$month] = intval($row['completed_count']);
    $enrolled_counts[$month] = intval($row['incompleted_count']);
}

$completed_counts_json = json_encode($completed_counts);
$enrolled_counts_json = json_encode($enrolled_counts);





$sql4 = "SELECT user_domain, user_subDomain, COUNT(*) AS user_count 
        FROM learners 
        WHERE user_subDomain != 'Others'
        GROUP BY user_domain, user_subDomain 
        ORDER BY user_domain, user_subDomain;";

$result4 = $conn->query($sql4);

// Organize data by domain
$data_by_domain = [];
while ($row = $result4->fetch_assoc()) {
    $domain = $row['user_domain'];
    $sub_domain = $row['user_subDomain'];
    $count = $row['user_count'];
    
    if (!isset($data_by_domain[$domain])) {
        $data_by_domain[$domain] = [];
    }
    $data_by_domain[$domain][] = ['sub_domain' => $sub_domain, 'count' => $count];
}

// SQL query to retrieve enrollment and completion counts by domain and month
$sql5 = "SELECT 
            l.user_domain,
            MONTH(uc.EnrolmentDate) AS month,
            SUM(CASE WHEN uc.status = 'completed' THEN 1 ELSE 0 END) AS completed_count,
            SUM(CASE WHEN uc.status != 'completed' THEN 1 ELSE 0 END) AS enrolled_count
        FROM 
            learners l
        JOIN 
            user_courses uc
        ON 
            l.user_id = uc.user_id
        WHERE 
            MONTH(uc.EnrolmentDate) IN (7, 8, 9, 10, 11, 12)
        GROUP BY 
            l.user_domain,
            MONTH(uc.EnrolmentDate)
        ORDER BY 
            l.user_domain,
            month;";

$result5 = $conn->query($sql5);

// Organize data by domain and month
$data = [];
while ($row = $result5 ->fetch_assoc()) {
    $domain = $row['user_domain'];
    $month = $row['month'];
    $completed_count = $row['completed_count'];
    $enrolled_count = $row['enrolled_count'];
    
    if (!isset($data[$domain])) {
        $data[$domain] = [];
    }
    $data[$domain][$month] = ['completed' => $completed_count, 'enrolled' => $enrolled_count];
}



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="progressDashboard_5.css">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>
</head>
<body>
    <div class="AimsRegistrationDashboard">
    </div>
    <div class="Group1171278554">
        <div class="kpi-container">
            <div class="kpi-item">
                <div class="text-container">
                    <div class="box-content">
                        <span class="big">Learners Enrolled</span>
                        <div class="number">3,156,826</div>
                    </div>
                </div>
            </div>
            <div class="kpi-item">
                <div class="text-container">
                    <div class="box-content">
                        <span class="big">Certified Issued</span>
                        <div class="number">953,450</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-container">
            <div class="dashboard-item  " id="OverallLearnersCompletionStatus" style="width: 800px;height:350px; ">
            </div>
            
            <div class="dashboard-item  " id="Learners Completion Status by Domain" style="width: 800px;height:350px; ">
            </div>

        </div>
        <div>
        <div class="dashboard-container">
    <div class="dashboard-item" style="width: 650px; height: 400px;">
        <div class="table-container">
        <h3> Learners’ Enrolled Vs Completed Status by Domain Over Month </h3>

        <table class='Table1'>
        <thead>
            <tr>
                <th rowspan="2"></th>
                <th>Name</th>
                <th>July</th>
                <th>Aug</th>
                <th>Sep</th>
                <th>Oct</th>
                <th>Nov</th>
                <th>Dec</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $domain => $months): ?>
                <tr>
                    <td rowspan="2" class='DomainName'><?php echo htmlspecialchars($domain); ?></td>
                    <td>Enrolled</td>
                    <?php for ($month = 7; $month <= 12; $month++): ?>
                        <td><?php echo isset($months[$month]) ? htmlspecialchars($months[$month]['enrolled']) : '0'; ?></td>
                    <?php endfor; ?>
                </tr>
                <tr>
                    <td>Completed</td>
                    <?php for ($month = 7; $month <= 12; $month++): ?>
                        <td><?php echo isset($months[$month]) ? htmlspecialchars($months[$month]['completed']) : '0'; ?></td>
                    <?php endfor; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        </div>
    </div>
    <div class="dashboard-item" id="Enrolled V/S Completed Monthly" style="width: 700px; height: 400px;">
    
    </div>
</div>

<div class="dashboard-container">


        <div class='dashboard-item' id='University Wise Distribution' style="width: 400px;height:350px;">
        <?php if (isset($data_by_domain['Defense'])): ?>
        <div class="scroll-pane dashboard-item" style="width: 550px;height:300px;">
            <table>
                <caption>Defense</caption>
                <tr>
                    <th>Sector</th>
                    <th>Count</th>
                </tr>
                <?php foreach ($data_by_domain['Defense'] as $sub_domain_data): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($sub_domain_data['sub_domain']); ?></td>
                        <td><?php echo htmlspecialchars($sub_domain_data['count']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
        </div>
        
        <div class='dashboard-item' id='University Wise Distribution' style="width: 400px;height:350px;">
        <?php if (isset($data_by_domain['MoE'])): ?>
        <div class="scroll-pane dashboard-item" style="width: 550px;height:300px;">
            <table>
                <caption>MoE</caption>
                <tr>
                    <th>University</th>
                    <th>Count</th>
                </tr>
                <?php foreach ($data_by_domain['MoE'] as $sub_domain_data): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($sub_domain_data['sub_domain']); ?></td>
                        <td><?php echo htmlspecialchars($sub_domain_data['count']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
        </div>
       
        <div class='dashboard-item' id='University Wise Distribution' style="width: 400px;height:350px;">
        <?php if (isset($data_by_domain['HR'])): ?>
        <div class="scroll-pane dashboard-item" style="width: 550px;height:300px;">
            <table>
                <caption>HR</caption>
                <tr>
                    <th>Company</th>
                    <th>Count</th>
                </tr>
                <?php foreach ($data_by_domain['HR'] as $sub_domain_data): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($sub_domain_data['sub_domain']); ?></td>
                        <td><?php echo htmlspecialchars($sub_domain_data['count']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
        </div>

    </div>

    </div>

    </div>
    <script>     // PHP variables passed to JavaScript
    var totalCompleted = <?php echo $total_completed; ?>;
    var totalIncompleted = <?php echo $total_incompleted; ?>;
    var totalCourses = totalCompleted + totalIncompleted; // Total number of courses

    // Initialize ECharts instance
    var overallCoursesCompletionChart = echarts.init(document.getElementById('OverallLearnersCompletionStatus'));

    // Chart options
    var overallCoursesCompletionChart_Options = {
        title: {
            text: 'Overall Learners\' Completion Status',
            top: '5%'
        },
        tooltip: {
            trigger: 'item'
        },
        series: [
            {
                name: 'Completion Status',
                type: 'pie',
                radius: ['55%', '80%'],
                center: ['50%', '60%'],
                startAngle: 180,
                endAngle: 360,
                data: [
                    { 
                        value: 0, // Add a zero-value segment to place the total label
                        name: 'Total',
                        itemStyle: { color: 'transparent' },
                        label: {
                            show: true,
                            position: 'outside',
                            formatter: '0', 
                            fontSize: 12,
                            color: '#000',
                            padding: [0, -20, 0, -25] 
                        }
                    },
                    { 
                        value: totalCompleted, 
                        name: 'Completed', 
                        itemStyle: { color: '#6069f3' },
                        label: {
                            show: true,
                            position: 'inside',
                            formatter: totalCompleted.toLocaleString(), 
                            fontSize: 12,
                            color: 'white'
                        }
                    },
                    { 
                        value: totalIncompleted, 
                        name: 'Incompleted', 
                        itemStyle: { color: '#fb8d35' },
                        label: {
                            show: true,
                            position: 'inside',
                            formatter: totalIncompleted.toLocaleString(), 
                            fontSize: 12,
                            color: 'white'
                        }
                    },
                    { 
                        value: 0, // Add a zero-value segment to place the total label
                        name: 'Total',
                        itemStyle: { color: 'transparent' },
                        label: {
                            show: true,
                            position: 'outside',
                            formatter: totalCourses.toLocaleString(), 
                            fontSize: 12,
                            color: '#000',
                            padding: [0, 0, 0, -25] 
                        }
                    }
                ],
                labelLine: {
                    show: false
                },
            },
                {
            name: 'Completion Percentage',
            type: 'gauge',
            center: ['50%', '50%'], 
            radius: '60%',
            startAngle: 180,
            endAngle: 0,
            splitLine: { // Remove the split lines
                show: false
            },
            axisTick: { // Hide the axis ticks
                show: false
            },
            axisLabel: { // Hide the axis labels
                show: false
            },
            pointer: {
                show: false // Hide the pointer
            },
            detail: {
                formatter: '{value}%', // Display percentage in the middle
                fontSize: 24,
                fontWeight: 'bold',
                offsetCenter: [0, '30%'] // Position percentage in the middle
            },
            data: [
                { 
                    value: (totalCompleted / (totalCompleted + totalIncompleted) * 100).toFixed(2) // Calculate the percentage for 'Completed'
                }
            ]
            }
        ]
    };

    // Set options to the chart instance
    overallCoursesCompletionChart.setOption(overallCoursesCompletionChart_Options);





var learnersCompletionStatusbyDomainChart = echarts.init(document.getElementById('Learners Completion Status by Domain'));

  // Data fetched from PHP
  var learnersCompletionData = <?php echo $learnersCompletionData; ?>;

  var learnersCompletionStatusbyDomainChart_Options  = {
    title: {
      text: 'Learners Completions Status by Domain' 
    },
    tooltip: {
      trigger: 'axis',
      axisPointer: {
        type: 'shadow'
      }
    },
    legend: {},
    grid: {
      left: '3%',
      right: '4%',
      bottom: '3%',
      containLabel: true
    },
    yAxis: {
      type: 'category',
      data: ['MoE', 'HR', 'Defense', 'Others'],
      inverse: true,
      axisLabel: {
        fontWeight: 'bold',
        fontSize: 16
      },
      axisLine: {
        show: false
      }
    },
    xAxis: {
      type: 'value',
      boundaryGap: [0],
    },
    series: [
      {
        type: 'bar',
        data: learnersCompletionData, // Use fetched data here
        itemStyle: {
          color: '#6069f3',
          borderRadius: [0, 8, 8 , 0]
        },
        barWidth: '40%',
        barCategoryGap: '20%',
        label: {
          show: true,
          position: 'inside',
          formatter: '{c}',
          fontSize: 12,
          color: 'white'
        }
      },
    ]
  };

  learnersCompletionStatusbyDomainChart.setOption(learnersCompletionStatusbyDomainChart_Options);



  var enrolledVSCompletedMonthly = echarts.init(document.getElementById('Enrolled V/S Completed Monthly'));

// Data fetched from PHP
var completedCounts = <?php echo $completed_counts_json; ?>;
var enrolledCounts = <?php echo $enrolled_counts_json; ?>;

var enrolledVSCompletedMonthly_Options = {
  title: {
    text: 'Enrolled V/s Completed Monthly'
  },
  tooltip: {
    trigger: 'axis'
  },
  legend: {
    data: ['Completed', 'Enrolled'],
    bottom: 0, // Position the legend at the bottom
    itemWidth: 24, // Width of the legend symbol
    itemHeight: 10, // Height of the legend symbol
    icon: 'rect', // Change the symbol to circle
    itemStyle: {
      borderRadius: '50%' // Make the legend symbols circular
    }
  },
  grid: {
    left: '3%',
    right: '4%',
    bottom: '10%', // Adjusted to make space for legend
    containLabel: true
  },
  toolbox: {
    feature: {
      saveAsImage: {}
    }
  },
  xAxis: {
    type: 'category',
    boundaryGap: false,
    data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
  },
  yAxis: {
    type: 'value'
  },
  series: [
    {
      name: 'Enrolled',
      type: 'line',
      data: enrolledCounts,
      showSymbol: false,
      itemStyle: {
        color: '#6069f3' // Set color to purple
      }
    },
    {
      name: 'Completed',
      type: 'line',
      data: completedCounts,
      showSymbol: false,
      itemStyle: {
        color: '#fb8d35' // Set color to orange
      }
    }
  ]
};

enrolledVSCompletedMonthly.setOption(enrolledVSCompletedMonthly_Options);
</script>

















</body>