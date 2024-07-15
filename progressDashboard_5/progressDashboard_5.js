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
        fontSize: 14
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
        barWidth: '30%', // Make the bar less wide
        barCategoryGap: '8%', // Reduce the space between bars
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


var enrolledVSCompletedMonthly = echarts.init(document.getElementById('Enrolled V/S Completed Monthly'));

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
            data: [1000, 2000, 4000, 8500, 10000, 12000, 14000, 20000, 30000, 35000],
            showSymbol: false,
            itemStyle: {
              color: '#6069f3' // Set color to purple
            }
          },
          {
            name: 'Completed',
            type: 'line',
            data: [1000, 1500, 2000, 9500, 11000, 14000, 17000, 21000, 32000, 35000],
            showSymbol: false,
            itemStyle: {
              color: '#fb8d35' // Set color to orange
            }
          }
        ]
      };

      enrolledVSCompletedMonthly.setOption(enrolledVSCompletedMonthly_Options);