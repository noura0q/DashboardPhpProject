<?php 
// Fetch the latest KPIs Learners Registered
$sql_LR = "SELECT COUNT(*) AS user_id FROM learner";
$result_LR = $conn->query($sql_LR);

$kpi_data_LR = [];
if ($result_LR->num_rows > 0) {
    $kpi_data_LR = $result_LR->fetch_assoc();
} else {
    echo "0 results";
}



// Fetch the latest KPIs Learners Registered
$sql_enrolled = "SELECT COUNT(*) AS user_id FROM Course WHERE status ='incompleted';";
$result_enrolled = $conn->query($sql_enrolled);

$kpi_data_Enrolled = [];
if ($result_enrolled->num_rows > 0) {
    $kpi_data_Enrolled = $result_enrolled->fetch_assoc();
} else {
    echo "0 results";
}

// Fetch the latest KPIs Certificates Issued
$sql_CI = "SELECT COUNT(*) AS status FROM course";
$result_CI = $conn->query($sql_CI);

$kpi_data_CI = [];
if ($result_CI->num_rows > 0) {
    $kpi_data_CI = $result_CI->fetch_assoc();
} else {
    echo "0 results";
}


// Fetch the latest KPIs Learners Active
$sql_AL = "SELECT COUNT(*) AS active_count FROM learner WHERE activity = 'active'";
$result_AL = $conn->query($sql_AL);

$kpi_data_AL = [];
if ($result_AL->num_rows > 0) {
    $kpi_data_AL = $result_AL->fetch_assoc();
} else {
    echo "0 results";
}



// Fetch the latest KPIs inActive
$sql_IA = "SELECT COUNT(*) AS inactive_count FROM learner WHERE activity = 'inactive'";
$result_IA = $conn->query($sql_IA);

$kpi_data_IA = [];
if ($result_IA->num_rows > 0) {
    $kpi_data_IA = $result_IA->fetch_assoc();
} else {
    echo "0 results";
}



// Fetch the latest KPIs AVG time
$sql_avg = "SELECT AVG(average_usage_hours) AS average_usage_hours FROM learner";
$result_avg = $conn->query($sql_avg);

// Check if the query was successful
if ($result_avg === FALSE) {
    echo "Error: " . $conn->error;
} else {
    $KPI_data_avg = $result_avg->fetch_assoc();
}


?>