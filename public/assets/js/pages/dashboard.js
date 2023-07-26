//[Dashboard Javascript]

//Project:	WebkitX Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';

	var options = {
          series: [{
            name: "Revenue",
            data: [90, 71, 65, 91, 40, 112, 99, 51, 128]
        }],
          chart: {
          height: 256,
          type: 'area',
          zoom: {
            enabled: false
          },
		  toolbar: {
			show: false,
		  }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
		colors: ['#1bc5bd'],
        grid: {
			show: false,
			padding: {
			  top: 0,
			  bottom: -20,
			  right: 0,
			  left: -10
			},
        },

		 legend: {
      		show: false,
		 },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
			labels: {
          		show: false,
			},
			axisBorder: {
          		show: false,
			},
			axisTicks: {
          		show: false,
			},
        	},

        yaxis: {
          labels: {
          		show: false,
			}
        },
        };

        var chart = new ApexCharts(document.querySelector("#revenue4"), options);
        chart.render();


	var options = {
          series: [{
          name: 'PRODUCT A',
          data: [44, 55, 41, 67, 22, 43]
        }, {
          name: 'PRODUCT B',
          data: [-44, -55, -41, -67, -22, -43]
        }],
          chart: {
		  foreColor:"#bac0c7",
          type: 'bar',
          height: 350,
          stacked: true,
          toolbar: {
            show: false
          },
          zoom: {
            enabled: true
          }
        },
        responsive: [{
          breakpoint: 480,
          options: {
            legend: {
              position: 'bottom',
              offsetX: -10,
              offsetY: 0
            }
          }
        }],
		grid: {
			show: true,
			borderColor: '#f7f7f7',
		},
		colors:['#1ad0d3', '#f64e60'],
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '10%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },

        xaxis: {
          type: 'datetime',
          categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT',
            '01/05/2011 GMT', '01/06/2011 GMT'
          ],
        },
        legend: {
          show: false,
        },
        fill: {
          opacity: 1
        }
        };

        var chart = new ApexCharts(document.querySelector("#charts_widget_1_chart"), options);
        chart.render();


		var options = {
          series: [{
          name: 'Net Profit',
          data: [44, 55, 57, 56, 61, 58, 63]
        }, {
          name: 'Revenue',
          data: [76, 85, 101, 98, 87, 105, 91]
        }],
          chart: {
          type: 'bar',
		  foreColor:"#bac0c7",
          height: 388,
			  toolbar: {
        		show: false,
			  }
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '30%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false,
        },
		grid: {
			show: true,
		},
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
		colors: ['#f64e60', '#999999'],
        xaxis: {
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],

        },
        yaxis: {

        },
		 legend: {
      		show: false,
		 },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          },
			marker: {
			  show: false,
		  },
        }
        };

        var chart = new ApexCharts(document.querySelector("#recent_trend"), options);
        chart.render();

}); // End of use strict
