<?php

include '../db.php';

// Fetch the latest KPIs
$sql = "SELECT * FROM kpis ORDER BY kpi_id DESC LIMIT 1";
$result = $conn->query($sql);

$kpi_data = [];
if ($result->num_rows > 0) {
    $kpi_data = $result->fetch_assoc();
} else {
    echo "0 results";
}

$conn->close();
?>


<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/Hr.css">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>

</head>

<body>
    <div>
        <div class="kpi-container">
            <div class="kpi-item">
                <div class="icon Verify1"><img class="kpi-icon" src="../assets/images/learner-enrolled.png">
                </div>
                <div class="text-container">
                    <div class="box-content">
                        <span class="big">Learners Registered</span>
                        <div class="number"><?php echo number_format($kpi_data['learners_registered']); ?></div>
                    </div>
                </div>
            </div>
            <div class="kpi-item">
                <div class="icon Contract1"><img class="kpi-icon" src="../assets/images/certifactes-icon.png">
                </div>
                <div class="text-container">
                    <div class="box-content">
                        <span class="big">Certificates Issued</span>
                        <div class="number"><?php echo number_format($kpi_data['certificates_issued']); ?></div>
                    </div>
                </div>
            </div>
            <div class="kpi-item">
                <div class="icon Clock11"><img class="kpi-icon" src="../assets/images/learner-active.png">

                </div>
                <div class="text-container">
                    <div class="box-content">
                        <span class="big">Learners Active</span>
                        <div class="number"><?php echo number_format($kpi_data['learners_active']); ?></div>
                    </div>
                </div>
            </div>
            <div class="kpi-item">
                <div class="icon Clock11"><img class="kpi-icon" src="../assets/images/learner-inactive.png">


                </div>
                <div class="text-container">
                    <div class="box-content">
                        <span class="big">Learners Inactive</span>
                        <div class="number"><?php echo number_format($kpi_data['learners_inactive']); ?></div>
                    </div>
                </div>
            </div>
            <div class="kpi-item">
                <div class="icon Warning1"><img class="kpi-icon" src="../assets/images/time.png">
                </div>


                <div class="text-container">
                    <div class="box-content">
                        <span class="big">Avg Time</span>
                        <div class="number"><?php echo number_format($kpi_data['avg_time']); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-container">
            <div class="dashboard-item  " id="learner experience" style="width: 400px;height:400px; ">
            </div>
            <div class="dashboard-item  " id="HR Enrolled V/s Completion" style="width: 700px;height:400px; ">
            </div>

        </div>
        <div>
            <div class="dashboard-container">
                <div class="dashboard-item  " id="Education" style="width: 700px;height:400px; ">
                </div>
                <div class="dashboard-item  " id="gender" style="width: 700px;height:400px; ">
                </div>
                <div class="dashboard-item  " id="region" style="width: 700px;height:400px; ">
                </div>
            </div>

        </div>
        <div class="dashboard-container">
            <div class="scroll-pane dashboard-item" id="Education" style="width: 550px;height:250px; ">
                <table>
                    <caption>City Wise Distribution</caption>
                    <tr>
                        <td>Riyadh</td>
                        <td>53,000</td>
                    </tr>
                    <tr>
                        <td>Jeddah</td>
                        <td>51,000</td>
                    </tr>
                    <tr>
                        <td>Dammam</td>
                        <td>20,000</td>
                    </tr>
                    <tr>
                        <td>Makkah</td>
                        <td>10,000</td>
                    </tr>
                    <tr>
                        <td>Buraydah</td>
                        <td>15,000</td>
                    </tr>
                    <tr>
                        <td>Madina</td>
                        <td>8,000</td>
                    </tr>
                    <!-- Add more rows here as needed -->
                </table>
            </div>

            <div class="scroll-pane dashboard-item" id="Education" style="width: 550px;height:250px; ">
                <table>
                    <caption>Company Wise Distribution</caption>
                    <tr>
                        <td>IBM</td>
                        <td>53,000</td>
                    </tr>
                    <tr>
                        <td>Accenture</td>
                        <td>51,000</td>
                    </tr>
                    <tr>
                        <td>Microsoft</td>
                        <td>20,000</td>
                    </tr>
                    <tr>
                        <td>Cisco</td>
                        <td>10,000</td>
                    </tr>
                    <tr>
                        <td>Wipro</td>
                        <td>15,000</td>
                    </tr>
                    <tr>

                        <!-- Add more rows here as needed -->
                </table>
            </div>
        </div>




    </div>

    </div>
    <script src="../assets/js/HrChart.js"></script>
    <script src="../assets/js/main.js"></script>



</body>

</html>