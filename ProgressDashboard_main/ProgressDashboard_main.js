var colorPalette = ['#6169F2', '#2e9dec', '#ec3a48', '#3ba372', '#54a0da', '#e14e59', '#fbc958', '#e33992', '#fc8d36', '#0abca4'];


var KSaRegionWiseLearners = echarts.init(document.getElementById('Ksa Region Wise Learners Distribution'));

// Pie Chart Options
var KSaRegionWiseLearners_Options  =  {
    title: {
        text: 'KSA Region Wise Learners Distribution',
        left: 'left'
    },
    tooltip: {
        trigger: 'item',
        formatter: '{a} <br/>{b}: {c} ({d}%)'
    },
    legend: {
        type: 'scroll',
        orient: 'horizontal',
        bottom: '0',
        data: ['Riyadh', 'Western Region', 'Northen Borders', 'Asir', 'Madina', 'Jazan', 'Al Baha', 'Najran', 'Hail', 'Eastern Region']
    },
    series: [{
        name: 'Learner Distribution',
        type: 'pie',
        radius: ['40%', '70%'],
        center: ['50%', '50%'],
        color: colorPalette,
        data: [{
                value: 1048,
                name: 'Riyadh'
            },
            {
                value: 735,
                name: 'Western Region'
            },
            {
                value: 580,
                name: 'Northen Borders'
            },
            {
                value: 484,
                name: 'Asir'
            },
            {
                value: 300,
                name: 'Madina'
            },
            {
                value: 300,
                name: 'Jazan'
            },
            {
                value: 300,
                name: 'Al Baha'
            },
            {
                value: 300,
                name: 'Najran'
            },
            {
                value: 300,
                name: 'Hail'
            },
            {
                value: 300,
                name: 'Eastern Region'
            }
        ],
        emphasis: {
            itemStyle: {
                shadowBlur: 10,
                shadowOffsetX: 0,
                shadowColor: 'rgba(0, 0, 0, 0.5)'
            }
        }
    }]
};
  
KSaRegionWiseLearners.setOption(KSaRegionWiseLearners_Options);




var ProfessionAndProficiencyLevelRelation = echarts.init(document.getElementById('Profession And Proficiency Level Relation'));

var ProfessionAndProficiencyLevelRelation_Options = {
    title: {
        text: 'Profession And Proficiency Level Relation'
    },
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'shadow'
        }
    },
    legend: {
        data: ['MoE', 'HR', 'Defense'],
        right: '4%',
        bottom: '95%'
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '20%',
        containLabel: true
    },
    xAxis: {
        type: 'value',
        name: 'Number of Learners',
        nameLocation: 'middle',
        nameTextStyle: {
            align: 'center',
            verticalAlign: 'top'
        }
    },
    yAxis: {
        type: 'category',
        name: 'Profession',
        data: ['Private', 'Public', 'Job Seekers', 'Student']
    },
    series: [{
            name: 'MoE',
            type: 'bar',
            stack: 'total',
            label: {
                show: true
            },
            emphasis: {
                focus: 'series'
            },
            itemStyle: {
                color: '#6169f2'
            },
            data: [6490, 3020, 5000, 9000]
        },
        {
            name: 'HR',
            type: 'bar',
            stack: 'total',
            label: {
                show: true
            },
            emphasis: {
                focus: 'series'
            },
            itemStyle: {
                color: '#fc8d36'
            },
            data: [3468, 3468, 2399, 1578]
        },
        {
            name: 'Defense',
            type: 'bar',
            stack: 'total',
            label: {
                show: true
            },
            emphasis: {
                focus: 'series'
            },
            itemStyle: {
                color: '#0abca4'
            },
            data: [7678, 3245, 1568, 3245]
        }
    ]
};


ProfessionAndProficiencyLevelRelation.setOption(ProfessionAndProficiencyLevelRelation_Options);





 
var CourseComoletion = echarts.init(document.getElementById('Course Comoletion'));

 // Set up the chart options
 var CourseComoletion_Options = {
    title: {
        text: 'Course Completions',
        left: 'left',
        top: 20,
        textStyle: {
            fontSize: 18,
            fontWeight: 'bold'
        }
    },
    xAxis: {
        type: 'category',
        data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        type: 'value'
    },
    series: [{
        data: [39, 25, 37, 29, 39, 22, 41, 29, 41, 24, 38, 32],
        type: 'bar',
        barWidth: '30%', // Set the bar width to 40% of the available space
        itemStyle: {
            color: '#fd8c36' // Set the bar color to a custom color
        }
    }],
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    }
};

CourseComoletion.setOption(CourseComoletion_Options);





var EnrolledInCourse = echarts.init(document.getElementById('Enrolled In Course'));

// Set up the chart options
var EnrolledInCourse_options = {
    title: {
        text: 'Enrolled in Course',
        left: 'left',
        top: 20,
        textStyle: {
            fontSize: 18,
            fontWeight: 'bold'
        }
    },
    xAxis: {
        type: 'category',
        data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        type: 'value'
    },
    series: [{
        data: [16, 18, 12, 18, 15, 21, 14, 19, 12, 17, 12,19],
        type: 'bar',
        barWidth: '30%', // Set the bar width to 40% of the available space
        itemStyle: {
            color: '#6169f2', // Set the bar color to a custom color
            borderRadius: [10, 10, 0, 0] // Set the border radius of the bars (top-left, top-right, bottom-right, bottom-left)
        }
    }],
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    }
};

EnrolledInCourse.setOption(EnrolledInCourse_options);

















var EducationDetails = echarts.init(document.getElementById('Education Details'));

var EducationDetails_Options = {
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
    color: [
        '#0abca4', 
        '#2a7af1', 
        '#fc8d36', 
        '#2e9dec', 
        '#6169f2', 
        '#eb3f9b', 
        '#fbc958', 
        '#ec3a48'  
    ],
    series: [
        {
            name: 'Nightingale Chart',
            type: 'pie',
            radius: ['30%', '70%'],
            center: ['50%', '50%'],
            roseType: 'area',
            itemStyle: {
                borderRadius: 8
            },
            data: [
                { value: 40, name: 'rose 1' },
                { value: 38, name: 'rose 2' },
                { value: 32, name: 'rose 3' },
                { value: 30, name: 'rose 4' },
                { value: 28, name: 'rose 5' },
                { value: 26, name: 'rose 6' },
                { value: 22, name: 'rose 7' },
                { value: 18, name: 'rose 8' }
            ]
        }
    ]
};

EducationDetails.setOption(EducationDetails_Options);



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
    color: ['#e33992', '#3ba372'], // pink for female, green for male
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

























var MonthWiseActiveLearners = echarts.init(document.getElementById('Month Wise Active Learners'));

// Set up the chart options
var MonthWiseActiveLearners_options = {
    title: {
        text: 'Month Wise Active Learners',
        left: 'left',
        top: 20,
        textStyle: {
            fontSize: 18,
            fontWeight: 'bold'
        }
    },
    xAxis: {
        type: 'category',
        data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        type: 'value'
    },
    series: [{
        data: [13, 14, 10, 13, 12, 16, 12, 14, 11, 13, 10,14],
        type: 'bar',
        barWidth: '30%', // Set the bar width to 40% of the available space
        itemStyle: {
            color: '#6169f2', // Set the bar color to a custom color
            borderRadius: [10, 10, 0, 0] // Set the border radius of the bars (top-left, top-right, bottom-right, bottom-left)
        }
    }],
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    }
};

MonthWiseActiveLearners.setOption(MonthWiseActiveLearners_options);




var MonthWiseLearnerRegistration = echarts.init(document.getElementById('Month Wise Learner Registration'));

 // Set up the chart options
 var MonthWiseLearnerRegistration_Options = {
    title: {
        text: 'Month Wise Learner Registration',
        left: 'left',
        top: 20,
        textStyle: {
            fontSize: 18,
            fontWeight: 'bold'
        }
    },
    xAxis: {
        type: 'category',
        data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        type: 'value'
    },
    series: [{
        data: [14,8, 13, 9, 15, 7, 16, 9, 17, 24,8, 14, 10],
        type: 'bar',
        barWidth: '30%', // Set the bar width to 40% of the available space
        itemStyle: {
            color: '#0abca4' // Set the bar color to a custom color
        }
    }],
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    }
};

MonthWiseLearnerRegistration.setOption(MonthWiseLearnerRegistration_Options);



var Top3Domain = echarts.init(document.getElementById('top3Domains'));

var Top3Domain_options = {
    title: {
        text: 'Top 3 Domains',
        top: '5%'
    },
    tooltip: {
        trigger: 'item'
    },
    legend: {
        orient: 'horizontal',
        bottom: '20%',
        data: [
            {
                name: 'MoE: 35%',
                icon: 'circle',
                itemStyle: { color: '#6069f3' },
                textStyle: {
                    rich: {
                        name: {
                            fontSize: 14,
                            color: '#333'
                        },
                        percent: {
                            fontSize: 18,
                            fontWeight: 'bold',
                            color: '#333'
                        },
                        line: {
                            fontSize: 14,
                            color: '#333',
                            padding: [0, 5]
                        }
                    },
                    formatter: '{name|MoE: }{line| |}{percent|35%}'
                }
            },
            {
                name: 'HR: 46.7%',
                icon: 'circle',
                itemStyle: { color: '#0bbba3' },
                textStyle: {
                    rich: {
                        name: {
                            fontSize: 14,
                            color: '#333'
                        },
                        percent: {
                            fontSize: 18,
                            fontWeight: 'bold',
                            color: '#333'
                        },
                        line: {
                            fontSize: 14,
                            color: '#333',
                            padding: [0, 5]
                        }
                    },
                    formatter: '{name|HR: }{line| |}{percent|46.7%}'
                }
            },
            {
                name: 'Defense: 27.3%',
                icon: 'circle',
                itemStyle: { color: '#fb8d35' },
                textStyle: {
                    rich: {
                        name: {
                            fontSize: 14,
                            color: '#333'
                        },
                        percent: {
                            fontSize: 18,
                            fontWeight: 'bold',
                            color: '#333'
                        },
                        line: {
                            fontSize: 14,
                            color: '#333',
                            padding: [0, 5]
                        }
                    },
                    formatter: '{name|Defense: }{line| |}{percent|27.3%}'
                }
            }
        ]
    },
    series: [
        {
            name: 'Completion Status',
            type: 'pie',
            radius: ['55%', '80%'],
            center: ['50%', '60%'], // Adjust center to decrease space
            startAngle: 180,
            endAngle: 360,
            data: [
                { 
                    value: 755500, 
                    name: 'MoE: 35%', 
                    itemStyle: { 
                        color: '#6069f3',
                        borderWidth: 2,
                        borderColor: '#fff'
                    },
                    label: {
                        show: false,
                        position: 'inside',
                        formatter: '35%', // Display the percentage on the segment
                        fontSize: 14,
                        color: 'white'
                    }
                },
                { 
                    value: 566142, 
                    name: 'HR: 46.7%', 
                    itemStyle: { 
                        color: '#0bbba3',
                        borderWidth: 2,
                        borderColor: '#fff'
                    },
                    label: {
                        show: false,
                        position: 'inside',
                        formatter: '46.7%', // Display the percentage on the segment
                        fontSize: 14,
                        color: 'white'
                    }
                },
                { 
                    value: 331482, 
                    name: 'Defense: 27.3%', 
                    itemStyle: { 
                        color: '#fb8d35',
                        borderWidth: 2,
                        borderColor: '#fff'
                    },
                    label: {
                        show: false,
                        position: 'inside',
                        formatter: '27.3%', // Display the percentage on the segment
                        fontSize: 14,
                        color: 'white'
                    }
                },
            ],
            labelLine: {
                show: false
            }
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
                formatter: function(value) {
                    return '{value|' + value + '%}\n\n{label|Total}';
                }, // Display percentage and 'Total' in the middle
                rich: {
                    value: {
                        fontSize: 40,
                        fontWeight: 'bold',
                        color: '#333'
                    },
                    label: {
                        fontSize: 18,
                        color: '#333',
                        padding: [10, 0, 0, 0]
                    }
                },
                offsetCenter: [0, '10%'] // Position percentage in the middle
            },
            data: [
                { 
                    value: 100 // Total percentage
                }
            ]
        }
    ]
};






Top3Domain.setOption(Top3Domain_options);









var LearnersexperienceLevel = echarts.init(document.getElementById('Learners experience Level'));

// Specify the configuration items and data for the chart
var LearnersexperienceLevel_options = {
    title: {
        text: 'Learners experience Level',
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
            data: [22000, 12000,20000 , 15000],
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
            data: [0, 0, 0, 0] // Placeholder data for the total bar, adjust as needed
        }
    ]
};

// Display the chart using the configuration items and data just specified.
LearnersexperienceLevel.setOption(LearnersexperienceLevel_options);