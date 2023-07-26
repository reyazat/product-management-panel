//[Dashboard Javascript]

//Project:	WebkitX Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';

	var spark1 = {
	  chart: {
		id: 'spark1',
		group: 'sparks',
		type: 'line',
		height: 150,
		sparkline: {
		  enabled: true
		},
		dropShadow: {
		  enabled: true,
		  top: 5,
		  left: 1,
		  blur: 5,
		  opacity: 0.1,
		}
	  },
	  series: [{
		data: [25, 66, 41, 59, 25, 44, 12, 36, 9, 21]
	  }],
	  stroke: {
		curve: 'smooth'
	  },
	  markers: {
		size: 0
	  },
	  grid: {
		padding: {
		  top: 50,
		  bottom: 50,
		  right: 6,
		  left: 0
		}
	  },
	  colors: ['#CD3648'],
	  tooltip: {
		x: {
		  show: false
		},
		y: {
		  title: {
			formatter: function formatter(val) {
			  return '';
			}
		  }
		}
	  }
	}
	new ApexCharts(document.querySelector("#spark1"), spark1).render();



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
          height: 243,
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
          height: 395,
			  toolbar: {
        		show: false,
			  }
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '50%',
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
		colors: ['#8950fc', '#ffa800'],
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
