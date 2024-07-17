// Initialize your charts here (echarts initialization)

/// Initialize the echarts instance based on the prepared dom
var experienceChart = echarts.init(document.getElementById('learner experience'));

// Specify the
//configuration items and data for the chart
var experienceOption = {
    title: {
        text: 'Learners Experience Levels',
        textStyle: {
            fontSize: 16,
            fontWeight: 'bold'
        }
    },
    xAxis: {
        type: 'category',
        data: ["0-2", "3-4", "5-10", "10+"],
        axisLabel: {
            rotate: 45,
            margin: 10, // Adjust margin between label and axis
            textStyle: {
                fontSize: 12 // Adjust font size of axis labels
            }
        },
        axisTick: {
            alignWithLabel: true
        },
        name: 'Years of Experience',
        nameLocation: 'middle',
        nameGap: 25, // Adjust gap between axis name and axis
        nameTextStyle: {
            fontSize: 14,
            fontWeight: 'bold'
        }
    },
    yAxis: {
        type: 'value',
        name: 'Number of Learners',
        nameLocation: 'middle',
        nameGap: 55, // Adjust gap between axis name and axis
        nameTextStyle: {
            fontSize: 14,
            fontWeight: 'bold'
        },
        axisLabel: {
            formatter: '{value}',
            margin: 10, // Adjust margin between label and axis
            textStyle: {
                fontSize: 12 // Adjust font size of axis labels
            }
        }
    },
    grid: {
        top: 80, // Adjust top padding if needed
        left: '5%',
        right: '5%',
        bottom: '8%',
        containLabel: true
    },
    series: [
        {
            name: '0-2',
            data: [2000, 3000, 4000, 5000],
            type: 'bar',
            stack: 'learners',
            barWidth: '60%',
            itemStyle: {
                color: '#6169F3',
                barBorderRadius: [5, 5, 0, 0]

            }
        },
        {
            name: '3-4',
            data: [1000, 2000, 3000, 4000],
            type: 'bar',
            stack: 'learners',
            itemStyle: {
                color: '#E0E6FF',
                barBorderRadius: [5, 5, 0, 0]
            }
        },
        {
            name: 'Total',
            type: 'bar',
            stack: 'learners',
            label: {
                show: true,
                position: 'top',
                formatter: function(params) {
                    var sum = 0;
                    for (var i = 0; i < experienceOption.series.length - 1; i++) {
                        sum += experienceOption.series[i].data[params.dataIndex];
                    }
                    return 'Total: ' + sum;
                },
                textStyle: {
                    fontSize: 12 // Adjust font size of label text
                }
            },
            itemStyle: {
                color: 'transparent', // Transparent color for the total bar
                borderColor: 'rgba(0,0,0,0.1)',
                borderWidth: 1
            },
            emphasis: {
                itemStyle: {
                    color: 'rgba(0,0,0,0.05)' // Light color on hover for emphasis
                }
            },
            data: [] // Placeholder data for the total bar, adjust as needed
        }
    ]
};

// Display the chart using the configuration items and data just specified.
experienceChart.setOption(experienceOption);

// HR Enrolled V/s Completion chart
// Initialize the echarts instance based on the prepared dom
var HRChart = echarts.init(document.getElementById('HR Enrolled V/s Completion'));

// Specify the configuration items and data for the chart
var HROption = {
    title: {
        text: 'HR Enrolled vs Completion',
        subtext: 'Fake Data',
        textStyle: {
            fontSize: 16,
            fontWeight: 'bold'
        }
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data: ['Enrolled', 'Completion']
    },
    toolbox: {
        show: true,
        feature: {
            dataView: { show: true, readOnly: false },
            magicType: { show: true, type: ['line', 'bar'] },
            restore: { show: true },
            saveAsImage: { show: true }
        }
    },
    calculable: true,
    xAxis: [
        {
            type: 'category',
            data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        }
    ],
    yAxis: [
        {
            type: 'value'
        }
    ],
    series: [
        {
            name: 'Enrolled',
            type: 'bar',
            data: [
                2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3
            ],
            itemStyle: {  // Customize bar style
                color: '#6169F3 ' ,
                barBorderRadius: [5, 5, 0, 0]
            },
            markPoint: {
                data: [
                    { type: 'max', name: 'Max' },
                    { type: 'min', name: 'Min' }
                ]
            },
            markLine: {
                data: [{ type: 'average', name: 'Avg' }]
            }
        },
        {
            name: 'Completion',
            type: 'bar',
            data: [
                2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3
            ],
            itemStyle: {  // Customize bar style
                color: ' #FD8D35',  // Change bar color here
                barBorderRadius: [5, 5, 0, 0]
            },
            markPoint: {
                data: [
                    { name: 'Max', value: 182.2, xAxis: 7, yAxis: 183 },
                    { name: 'Min', value: 2.3, xAxis: 11, yAxis: 3 }
                ]
            },
            markLine: {
                data: [{ type: 'average', name: 'Avg' }]
            }
        }
    ]
};

// Display the chart using the configuration items and data just specified.
HRChart.setOption(HROption);


// Education Details chart
// Initialize the echarts instance based on the prepared dom
var EducationChart = echarts.init(document.getElementById('Education'));

// Specify the configuration items and data for the chart
var EducationOption = {
    title: {
        text: 'Education Details',
        textStyle: {
            fontSize: 16,
            fontWeight: 'bold'
        }
    },
    legend: {
        top: 'bottom'
    },
    toolbox: {
        show: true,
        feature: {
            mark: { show: true },
            dataView: { show: true, readOnly: false },
            restore: { show: true },
            saveAsImage: { show: true }
        }
    },
    series: [
        {
            name: 'Nightingale Chart',
            type: 'pie',
            radius: ['30%', '70%'], // Adjust radius for better fit within frame
            center: ['50%', '50%'],
            roseType: 'area',
            itemStyle: {
                borderRadius: 8
            },
            data: []
        }
    ]
};

// Display the chart using the configuration items and data just specified.
EducationChart.setOption(EducationOption);

//   gender chart
// Initialize the echarts instance based on the prepared dom
var genderChart = echarts.init(document.getElementById('gender'));

// Specify the configuration items and data for the chart
genderOption = {
    tooltip: {
      trigger: 'item'
    },
    title: {
        text: 'Male & Female',
        textStyle: {
            fontSize: 16,
            fontWeight: 'bold'
        }
    },
    legend: {
      top: '5%',
      left: 'center'
    },
    series: [
      {
        name: 'Access From',
        type: 'pie',
        radius: ['40%', '70%'],
        avoidLabelOverlap: false,
        itemStyle: {
          borderRadius: 10,
          borderColor: '#fff',
          borderWidth: 2
        },
        label: {
          show: false,
          position: 'center'
        },
        emphasis: {
          label: {
            show: true,
            fontSize: 40,
            fontWeight: 'bold'
          }
        },
        labelLine: {
          show: false
        },
        data: [
          { value: 70, name: 'female' },
          { value: 30, name: 'male' },

        ]
      }
    ]
  };

  // Display the chart using the configuration items and data just specified.
genderChart.setOption(genderOption);

// Ksa Region Wise Learners’ Distribution chart
// Initialize the echarts instance based on the prepared dom
var regionChart = echarts.init(document.getElementById('region'));

// Specify the configuration items and data for the chart
regionOption = {
    tooltip: {
      trigger: 'item'
    },
    legend: {
      top: '5%',
      left: 'center'
    },
    title: {
        text: 'Ksa Region Wise Learners’ Distribution',
        textStyle: {
            fontSize: 16,
            fontWeight: 'bold'
        }
    },
    series: [
      {
        name: 'Access From',
        type: 'pie',
        radius: ['40%', '70%'],
        avoidLabelOverlap: false,
        itemStyle: {
          borderRadius: 10,
          borderColor: '#fff',
          borderWidth: 2
        },
        label: {
          show: false,
          position: 'center'
        },
        emphasis: {
          label: {
            show: true,
            fontSize: 40,
            fontWeight: 'bold'
          }
        },
        labelLine: {
          show: false
        },
        data: []
      }
    ]
  };

  // Display the chart using the configuration items and data just specified.
  regionChart.setOption(regionOption);
// Function to fetch data from PHP API
function fetchData() {
    fetch('../fetch_data.php')
        .then(response => response.json())
        .then(data => {
            // Update Learners Experience Levels chart
            experienceOption.xAxis[0].data = data.experience.map(item => item.experience_category);
            experienceOption.series[0].data = data.experience.map(item => item.learner_count);
            experienceChart.setOption(experienceOption);

            // Update HR Enrolled vs Completion chart
            HROption.xAxis[0].data = data.hr.map(item => item.month);
            HROption.series[0].data = data.hr.map(item => item.enrolled);
            HRChart.setOption(HROption);

            // Update Education Details chart
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

// Optionally, set interval to refresh data every x milliseconds if needed
// setInterval(fetchData, 60000); // Example: Refresh data every minute


