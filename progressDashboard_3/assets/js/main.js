// Function to fetch data from PHP API
function fetchData() {
    fetch('../fetch_data.php')
        .then(response => response.json())
        .then(data => {
            // Update Learners Experience Levels chart
            experienceOption.xAxis.data = data.experience.map(item => item.experience_category);
            experienceOption.series.forEach(series => {
                series.data = data.experience.map(item => item.learner_count);
            });
            experienceChart.setOption(experienceOption);

            // Update HR Enrolled vs Completion chart
            HROption.xAxis[0].data = data.hr.map(item => item.month);
            HROption.series.forEach(series => {
                series.data = data.hr.map(item => item.enrolled);
            });
            HRChart.setOption(HROption);

            // Update Education Details chart
            // Assuming the education chart is a pie chart or any other type
            EducationOption.series[0].data = data.education.map(item => ({
                value: item.number_of_learners,
                name: item.education_level
            }));
            EducationChart.setOption(EducationOption);

            // Update Gender Distribution chart
            genderOption.series[0].data = data.gender.map(item => ({
                value: item.percentage,
                name: item.gender
            }));
            genderChart.setOption(genderOption);

            // Update KSA Region Wise Learners' Distribution chart
            regionOption.series[0].data = data.region.map(item => ({
                value: item.number_of_learners,
                name: item.region_name
            }));
            regionChart.setOption(regionOption);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

// Call fetchData function to initially populate charts
fetchData();

// Set interval to refresh data every x milliseconds if needed
// setInterval(fetchData, 60000); // Example: Refresh data every minute
