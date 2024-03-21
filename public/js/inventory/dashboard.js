"use strict";

// Class definition
var KTProjectOverview = function (data) {
    // Colors
    var primary = KTUtil.getCssVariableValue('--kt-primary');
    var lightPrimary = KTUtil.getCssVariableValue('--kt-primary-light');
    var success = KTUtil.getCssVariableValue('--kt-success');
    var lightSuccess = KTUtil.getCssVariableValue('--kt-success-light');
    var gray200 = KTUtil.getCssVariableValue('--kt-gray-200');
    var gray500 = KTUtil.getCssVariableValue('--kt-gray-500');

    // Private functions
    var initChart = function (dataJson) {        
        // init chart
        var element = document.getElementById("project_overview_chart");

        if (!element) {
            return;
        }

        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: dataJson.data,
                    backgroundColor: dataJson.colors
                }],
                labels: ['Active', 'Completed', 'Yet to start']
            },
            options: {
                chart: {
                    fontFamily: 'inherit'
                },
                cutoutPercentage: 75,
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                title: {
                    display: false
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                tooltips: {
                    enabled: true,
                    intersect: false,
                    mode: 'nearest',
                    bodySpacing: 5,
                    yPadding: 10,
                    xPadding: 10,
                    caretPadding: 0,
                    displayColors: false,
                    backgroundColor: '#20D489',
                    titleFontColor: '#ffffff',
                    cornerRadius: 4,
                    footerSpacing: 0,
                    titleSpacing: 0
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        };

        var ctx = element.getContext('2d');
        var myDoughnut = new Chart(ctx, config);
    }



    // Public methods
    return {
        init: function (data) {
            
            initChart(data);
        }
    }
}();


