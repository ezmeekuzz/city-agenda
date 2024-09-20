function loadMonthlySalesChart() {
    $.ajax({
        url: "/admin/dashboard/getMonthlySales", // URL to the controller method
        type: "GET",
        dataType: "json",
        success: function(data) {
            var currentYear = new Date().getFullYear();
            // Prepare the chart options
            var options = {
                chart: {
                    type: 'bar',
                    height: 350
                },
                series: [{
                    name: 'Sales',
                    data: data.totals // Sales data
                }],
                xaxis: {
                    categories: data.months // Months data
                },
                yaxis: {
                    title: {
                        text: 'Total Sales'
                    }
                },
                title: {
                    text: 'Monthly Sales for ' + currentYear,
                    align: 'left'
                },
                fill: {
                    opacity: 1
                }
            };
            // Create the chart
            var chart = new ApexCharts(document.querySelector("#monthlySales"), options);
            chart.render();
        },
        error: function(xhr, status, error) {
            console.error("Error fetching sales data:", error);
        }
    });
}

// Call the function to load the chart when the page loads
$(document).ready(function() {
    loadMonthlySalesChart();
});