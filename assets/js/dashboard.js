
/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function () {

    // 'use strict'
    /* Chart.js Charts */
    // Sales chart
    var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
    //$('#revenue-chart').get(0).getContext('2d');

    var salesChartData = {
    labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July','Agustus'],
    datasets: [
        {
            label               : 'Laptop',
            backgroundColor     : 'rgba(60,141,188,0.4)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : [28, 48, 40, 19, 86, 27, 90],
            fill                : false
        },
        {
            label               : 'Monitor',
            backgroundColor     : 'rgba(92,184,92,0.4)',
            borderColor         : 'rgba(92,184,92,1)',
            pointRadius         : false,
            pointColor          : 'rgba(92,184,92,1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : [65, 59, 80, 81, 56, 55, 40],
            fill                : false
        },
        {
            label               : 'Printer',
            backgroundColor     : 'rgba(253,207,78,0.4)',
            borderColor         : 'rgba(253,207,78,1)',
            pointRadius         : false,
            pointColor          : 'rgba(253,207,78,1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : [6, 27, 90, 81, 80, 81, 28],
            fill                : false
        },
        ]
    }

    var salesChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
        display: false
        },
        scales: {
            xAxes: [{
            gridLines : {
                display : false,
            }
            }],
            yAxes: [{
            gridLines : {
                display : false,
            }
            }]
        }
    }

    // This will get the first returned node in the jQuery collection.
    var salesChart = new Chart(salesChartCanvas, { 
        type: 'line', 
        data: salesChartData, 
        options: salesChartOptions
        }
    )

})
