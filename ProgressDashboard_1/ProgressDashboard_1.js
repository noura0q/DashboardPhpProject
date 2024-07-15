var learnersCompletionStatusbyDomainChart = echarts.init(document.getElementById('Learners Completion Status by Domain'))

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
      inverse: true,  // Set inverse to true to display from right to left
      axisLabel: {
        fontWeight: 'bold', // Make the labels on the y-axis bold
        fontSize: 16
      },
      axisLine: {
        show: false // Hide the y-axis line
      }
    },
    xAxis: {
      type: 'value',
      boundaryGap: [0],
    },
    series: [
      {
        type: 'bar',
        data: [9000, 5000, 3020, 2490],
        itemStyle: {
          color: '#6069f3', // Set the bar color to a specific shade of purple
          borderRadius: [0, 8, 8 , 0]
        },
        barWidth: '40%', // Make the bar less wide
        barCategoryGap: '20%', // Reduce the space between bars
        label: {
          show: true,
          position: 'inside', // Display numbers inside the bars
          formatter: '{c}', // Format to display the actual value of the bar
          fontSize: 12,
          color: 'white' // Ensure numbers are visible on the purple bar
        }
      },
    ]
  };
  
  learnersCompletionStatusbyDomainChart.setOption(learnersCompletionStatusbyDomainChart_Options);


// Overall Learners Completion Status
var overallLearnersCompletionChart = echarts.init(document.getElementById('OverallLearnersCompletionStatus'));

var overallLearnersCompletionChart_Options = {
  title: {
      text: 'Overall Learners’ Completion Status',
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
          center: ['50%', '60%'], // Adjust center to decrease space
          startAngle: 180,
          endAngle: 360,
          data: [
              { 
                  value: 755500, 
                  name: 'Completed', 
                  itemStyle: { color: '#6069f3' },
                  label: {
                      show: true,
                      position: 'inside',
                      formatter: '755,500', // Display the number on the purple segment
                      fontSize: 12,
                      color: 'white'
                  }
              },
              { 
                  value: 244500, 
                  name: 'Uncompleted', 
                  itemStyle: { color: '#fb8d35' },
                  label: {
                      show: true,
                      position: 'inside',
                      formatter: '244,500', // Display the number on the orange segment
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
                      formatter: '1,000,000', // Display the total number
                      fontSize: 12,
                      color: '#000',
                      padding: [0, 0, 0, -25] // Adjust the padding to position the label
                  }
              }
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
              formatter: '{value}%', // Display percentage in the middle
              fontSize: 24,
              fontWeight: 'bold',
              offsetCenter: [0, '30%'] // Position percentage in the middle
          },
          data: [
              { 
                  value: (755500 / (755500 + 244500) * 100).toFixed(2) // Calculate the percentage for 'Completed'
              }
          ]
      }
  ]
};

overallLearnersCompletionChart.setOption(overallLearnersCompletionChart_Options);


// HR Enrolled V/S Completion Status
var HREnrolledVSCompletion = echarts.init(document.getElementById('HR Enrolled V/s Completion'));

 var HREnrolledVSCompletion_Options = {
  title: {
    text: 'HR Enrolled V/S Completed'
  },
  tooltip: {
    trigger: 'axis'
  },
  legend: {
    right: '10%',
    data: [
      { name: 'Enrolled', icon: 'circle', textStyle: { color: 'black' } },
      { name: 'Completed', icon: 'circle', textStyle: { color: 'black' } }
    ]
  },
  toolbox: {
    show: true,
    feature: {
      dataView: { show: true, readOnly: false },
      magicType: { show: false, type: ['line', 'bar'] },
      restore: { show: false },
      saveAsImage: { show: true }
    }
  },
  calculable: true,
  xAxis: [
    {
      type: 'category',
      data: [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
      ]
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
      barWidth: 10, // Adjust the width as needed
      data: [
        23456, 17890, 20345, 15678, 12345, 2345, 5678, 11011, 14123, 22134, 19876, 25000
      ],
      itemStyle: {
        color: '#6069f3',
        borderRadius: [8, 8, 0 , 0]
      }
    },
    {
      name: 'Completed',
      type: 'bar',
      barWidth: 10, // Adjust the width as needed
      data: [
        19876, 15432, 12456, 17890, 2345, 6789, 12123, 8123, 12345, 19987, 25000, 11000
      ],
      itemStyle: {
        color: '#fb8d35',
        borderRadius: [8, 8, 0 , 0]
      }
    }
  ]
};

HREnrolledVSCompletion.setOption(HREnrolledVSCompletion_Options);



// MoE Enrolled V/S Completion Status
var MoEEnrolledVSCompletion = echarts.init(document.getElementById('MoE Enrolled V/s Completion'));

 var MoEEnrolledVSCompletion_Options = {
  title: {
    text: 'MoE Enrolled V/S Completed'
  },
  tooltip: {
    trigger: 'axis'
  },
  legend: {
    right: '10%',
    data: [
      { name: 'Enrolled', icon: 'circle', textStyle: { color: 'black' } },
      { name: 'Completed', icon: 'circle', textStyle: { color: 'black' } }
    ]
  },
  toolbox: {
    show: true,
    feature: {
      dataView: { show: true, readOnly: false },
      magicType: { show: false, type: ['line', 'bar'] },
      restore: { show: false },
      saveAsImage: { show: true }
    }
  },
  calculable: true,
  xAxis: [
    {
      type: 'category',
      data: [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
      ]
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
      barWidth: 10, // Adjust the width as needed
      data: [
        23456, 17890, 20345, 15678, 12345, 2345, 5678, 18011, 14123, 25000, 19876, 22134
      ],
      itemStyle: {
        color: '#6069f3',
        borderRadius: [8, 8, 0 , 0]
      }
    },
    {
      name: 'Completed',
      type: 'bar',
      barWidth: 10, // Adjust the width as needed
      data: [
        9876, 15432, 20456, 17890, 19087, 22134, 12123, 18123, 12345, 19987, 17654, 6098
      ],
      itemStyle: {
        color: '#fb8d35',
        borderRadius: [8, 8, 0 , 0]
      }
    }
  ]
};

MoEEnrolledVSCompletion.setOption(MoEEnrolledVSCompletion_Options);


//  Enrolled V/S Completion Status
var defenseEnrolledVSCompletion = echarts.init(document.getElementById('Defense Enrolled V/s Completion'));

 var defenseEnrolledVSCompletion_Options = {
  title: {
    text: 'Defense Enrolled V/S Completed'
  },
  tooltip: {
    trigger: 'axis'
  },
  legend: {
    right: '10%',
    data: [
      { name: 'Enrolled', icon: 'circle', textStyle: { color: 'black' } },
      { name: 'Completed', icon: 'circle', textStyle: { color: 'black' } }
    ]
  },
  toolbox: {
    show: true,
    feature: {
      dataView: { show: true, readOnly: false },
      magicType: { show: false, type: ['line', 'bar'] },
      restore: { show: false },
      saveAsImage: { show: true }
    }
  },
  calculable: true,
  xAxis: [
    {
      type: 'category',
      data: [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
      ]
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
      barWidth: 10, // Adjust the width as needed
      data: [
        23456, 17890, 20345, 15678, 12345, 2345, 5678, 20011, 14123, 22134, 19876, 25000
      ],
      itemStyle: {
        color: '#6069f3',
        borderRadius: [8, 8, 0 , 0]
      }
    },
    {
      name: 'Completed',
      type: 'bar',
      barWidth: 10, // Adjust the width as needed
      data: [
        19876, 1890, 20456, 17890, 12456, 6789, 12123, 18123, 20983, 19987, 17654, 21000
      ],
      itemStyle: {
        color: '#fb8d35',
        borderRadius: [8, 8, 0 , 0]
      }
    }
  ]
};

defenseEnrolledVSCompletion.setOption(defenseEnrolledVSCompletion_Options);



//  Others V/S Completion Status
var othersEnrolledVSCompletion = echarts.init(document.getElementById('Others Enrolled V/s Completion'));

 var othersEnrolledVSCompletion_Options = {
  title: {
    text: 'Others Enrolled V/S Completed'
  },
  tooltip: {
    trigger: 'axis'
  },
  legend: {
    right: '10%',
    data: [
      { name: 'Enrolled', icon: 'circle', textStyle: { color: 'black' } },
      { name: 'Completed', icon: 'circle', textStyle: { color: 'black' } }
    ]
  },
  toolbox: {
    show: true,
    feature: {
      dataView: { show: true, readOnly: false },
      magicType: { show: false, type: ['line', 'bar'] },
      restore: { show: false },
      saveAsImage: { show: true }
    }
  },
  calculable: true,
  xAxis: [
    {
      type: 'category',
      data: [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
      ]
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
      barWidth: 10, // Adjust the width as needed
      data: [
        23456, 17890, 20345, 15678, 12345, 2345, 5678, 9011, 25000, 2908, 19876, 25000
      ],
      itemStyle: {
        color: '#6069f3',
        borderRadius: [8, 8, 0 , 0]
      }
    },
    {
      name: 'Completed',
      type: 'bar',
      barWidth: 10, // Adjust the width as needed
      data: [
        19876, 2090, 3986, 17890, 2345, 16789, 1123, 12123, 12345, 2000, 17654, 21000
      ],
      itemStyle: {
        color: '#fb8d35',
        borderRadius: [8, 8, 0 , 0]
      }
    }
  ]
};

othersEnrolledVSCompletion.setOption(othersEnrolledVSCompletion_Options);




