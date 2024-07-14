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
                name: 'Al Baha '
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