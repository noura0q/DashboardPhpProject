// here I'm
// Chart 1: Nightingale Chart
var nightingaleChartDom = document.getElementById('main');
var nightingaleChart = echarts.init(nightingaleChartDom);

var nightingaleOption = {
    title:{
        text:"Education details",
        textStyle:{
            fontSize:16,
            fontWeight:'bold'
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
            radius: [50, 250],
            center: ['50%', '50%'],
            roseType: 'area',
            itemStyle: {
                borderRadius: 8
            },
            data: [
                {value: 30, name: 'Masters' },
                { value: 15, name: 'PhDs' },
                { value: 10, name: 'Basic school '},
                { value: 20, name: 'High school' },
                {value: 26, name: 'Diploma'  },
                { value: 10, name: 'Bacherlos' }
                
            ]
        }
    ]
};

nightingaleChart.setOption(nightingaleOption);

// Chart 2: MoE Enrolled V/s Completion Chart
var enrollmentCompletionChartDom = document.getElementById('main1');
var enrollmentCompletionChart = echarts.init(enrollmentCompletionChartDom);

var enrollmentCompletionOption = {
    title: {
        text: 'MoE Enrolled V/s Completion'
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
            ]
        },
        {
            name: 'Completion',
            type: 'bar',
            data: [
                2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3
            ]
        }
    ]
};

enrollmentCompletionChart.setOption(enrollmentCompletionOption);

// Chart 3: Access From Chart
var accessFromChartDom = document.getElementById('main2');
var accessFromChart = echarts.init(accessFromChartDom);

var accessFromOption = {
    title:{
        text:"Ksa Region Wise Learners’ Distribution",
        textStyle:{
            fontSize:16,
            fontWeight:'bold'
        }
    },
    tooltip: {
        trigger: 'item'
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
                { value: 1048, name: 'Riyadh' },
                { value: 735, name: 'Najran' },
                { value: 580, name: 'Eastern Region' },
                { value: 484, name: ' Hail' },
                { value: 300, name: ' Al Baha' },
                { value: 295, name: ' Madina' },
                { value: 280, name: ' Jazan' },
                { value: 280, name: ' Asir' },
                { value: 280, name: ' Northern Borders' },
                { value: 280, name: ' Western Region' }
            ]
        }
    ]
};

accessFromChart.setOption(accessFromOption);

var colorPalette = ['#c23531', '#2f4554', '#61a0a8', '#d48265', '#91c7ae', '#749f83', '#ca8622', '#bda29a', '#6e7074', '#546570'];


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
        emphasis: {
            itemStyle: {
                shadowBlur: 10,
                shadowOffsetX: 0,
                shadowColor: 'rgba(0, 0, 0, 0.5)'
            }
        }
    
};
  
KSaRegionWiseLearners.setOption(KSaRegionWiseLearners_Options);

// Create the main container <div>
var mainDiv = document.createElement('div');
mainDiv.style.width = '915px';
mainDiv.style.height = '456px';
mainDiv.style.position = 'relative';

// Create the white background <div>
var whiteBackgroundDiv = document.createElement('div');
whiteBackgroundDiv.style.width = '915px';
whiteBackgroundDiv.style.height = '456px';
whiteBackgroundDiv.style.left = '0px';
whiteBackgroundDiv.style.top = '0px';
whiteBackgroundDiv.style.position = 'absolute';
whiteBackgroundDiv.style.background = 'white';
whiteBackgroundDiv.style.borderRadius = '10px';
mainDiv.appendChild(whiteBackgroundDiv);

// Create the horizontal lines <div>s
var lineTopPositions = [146, 216, 286, 356, 426];
lineTopPositions.forEach(function(top) {
    var lineDiv = document.createElement('div');
    lineDiv.style.width = '833px';
    lineDiv.style.height = '0px';
    lineDiv.style.left = '30px';
    lineDiv.style.top = top + 'px';
    lineDiv.style.position = 'absolute';
    lineDiv.style.border = '1px #E5E5E5 solid';
    mainDiv.appendChild(lineDiv);
});

// Create the city names <div>s
var cities = ['Riyadh', 'Jeddah', 'Dammam', 'Makkah', 'Madina'];
cities.forEach(function(city, index) {
    var cityDiv = document.createElement('div');
    cityDiv.style.left = '30px';
    cityDiv.style.top = (96 + index * 70) + 'px';
    cityDiv.style.position = 'absolute';
    cityDiv.style.color = 'black';
    cityDiv.style.fontSize = '20px';
    cityDiv.style.fontFamily = 'Poppins';
    cityDiv.style.fontWeight = '500';
    cityDiv.style.wordWrap = 'break-word';
    cityDiv.textContent = city;
    mainDiv.appendChild(cityDiv);
});

// Create the population numbers <div>s
var populations = ['53000', '51000', '20000', '12000', '10000'];
populations.forEach(function(population, index) {
    var populationDiv = document.createElement('div');
    populationDiv.style.left = '630px';
    populationDiv.style.top = (96 + index * 70) + 'px';
    populationDiv.style.position = 'absolute';
    populationDiv.style.opacity = '0.80';
    populationDiv.style.color = 'black';
    populationDiv.style.fontSize = '20px';
    populationDiv.style.fontFamily = 'Poppins';
    populationDiv.style.fontWeight = '400';
    populationDiv.style.wordWrap = 'break-word';
    populationDiv.textContent = population;
    mainDiv.appendChild(populationDiv);
});

// Create the title <div>
var titleDiv = document.createElement('div');
titleDiv.style.left = '30px';
titleDiv.style.top = '30px';
titleDiv.style.position = 'absolute';
titleDiv.style.color = 'black';
titleDiv.style.fontSize = '24px';
titleDiv.style.fontFamily = 'Poppins';
titleDiv.style.fontWeight = '600';
titleDiv.style.wordWrap = 'break-word';
titleDiv.textContent = 'City Wise Distribution';
mainDiv.appendChild(titleDiv);

// Append the main <div> to the document body
document.body.appendChild(mainDiv);

