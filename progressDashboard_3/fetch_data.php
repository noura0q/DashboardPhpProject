<?php
ob_start(); // Start output buffering

// Include database connection
include './db.php';

// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch data for Learners Experience Levels
$sql_experience = "SELECT experience_category, learner_count FROM learners_experience";
$result_experience = $conn->query($sql_experience);

// Fetch data for HR Enrolled vs Completion
$sql_hr = "SELECT month, enrolled, completed FROM hr_enrollment_completion";
$result_hr = $conn->query($sql_hr);

// Fetch data for Education Details
$sql_education = "SELECT education_level, number_of_learners FROM education_details";
$result_education = $conn->query($sql_education);

// Fetch data for Gender Distribution
$sql_gender = "SELECT gender, percentage FROM gender_distribution";
$result_gender = $conn->query($sql_gender);

// Fetch data for KSA Region Wise Learners' Distribution
$sql_region = "SELECT region_name, number_of_learners FROM ksa_region_distribution";
$result_region = $conn->query($sql_region);

// Prepare response data
$response = array(
    'experience' => array(),
    'hr' => array(),
    'education' => array(),
    'gender' => array(),
    'region' => array()
);

// Fetch data for Learners Experience Levels
if ($result_experience && $result_experience->num_rows > 0) {
    while ($row = $result_experience->fetch_assoc()) {
        $response['experience'][] = array(
            'experience_category' => $row['experience_category'],
            'learner_count' => $row['learner_count']
        );
    }
}

// Fetch data for HR Enrolled vs Completion
if ($result_hr && $result_hr->num_rows > 0) {
    while ($row = $result_hr->fetch_assoc()) {
        $response['hr'][] = array(
            'month' => $row['month'],
            'enrolled' => $row['enrolled'],
            'completed' => $row['completed']
        );
    }
}

// Fetch data for Education Details
if ($result_education && $result_education->num_rows > 0) {
    while ($row = $result_education->fetch_assoc()) {
        $response['education'][] = array(
            'education_level' => $row['education_level'],
            'number_of_learners' => $row['number_of_learners']
        );
    }
}

// Fetch data for Gender Distribution
if ($result_gender && $result_gender->num_rows > 0) {
    while ($row = $result_gender->fetch_assoc()) {
        $response['gender'][] = array(
            'gender' => $row['gender'],
            'percentage' => $row['percentage']
        );
    }
}

// Fetch data for KSA Region Wise Learners' Distribution
if ($result_region && $result_region->num_rows > 0) {
    while ($row = $result_region->fetch_assoc()) {
        $response['region'][] = array(
            'region_name' => $row['region_name'],
            'number_of_learners' => $row['number_of_learners']
        );
    }
}

// Close database connection
$conn->close();

// Get the content of the buffer
$output = ob_get_clean(); // Clean the output buffer and get its contents

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
