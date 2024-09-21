$(document).ready(function () {
    function formatEventId(eventId, slug) {
        // Ensure eventId is a number or a string that can be converted to a number
        eventId = parseInt(eventId, 10);
        
        // Format the ID with a "CA" prefix and zero-padded to 5 digits
        return `<a href="/${slug}" target="_blank">CA${eventId.toString().padStart(5, '0')}</a>`;
    }

    // Initialize DataTable
    var table = $('#dashboard').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/organizer/dashboard/getData",  // Matches your server-side endpoint
            "type": "GET",
            "data": function (d) {
                d.date_from = $('#date_from').val();  // Pass from date filter
                d.date_to = $('#date_to').val();      // Pass to date filter
            },
            "dataSrc": function (json) {
                // Calculate total sales from the server response
                var totalSales = 0;
                json.data.forEach(function (item) {
                    totalSales += parseFloat(item.total_amount);
                });

                // Update the total sales display
                $('#total_sales_display').text(totalSales.toFixed(2));

                return json.data;
            }
        },
        "order": [[4, 'desc']],  // Sort by date (index 4)
        "columns": [
            {
                "data": "eid",  // Aliased 'event_id' as 'eid'
                "render": function (data, type, row) {
                    return formatEventId(data, row.slug);
                }
            },
            { "data": "price" },
            { "data": "quantity" },
            { "data": "total_amount" },
            { "data": "paymentdate" }
        ],
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('data-id', data.eid);  // Assign 'eid' as row data-id
        },
        "initComplete": function (settings, json) {
            $(this).trigger('dt-init-complete');
        }
    });

    // Event listener for date filtering
    $('#filter').on('click', function() {
        table.ajax.reload();  // Reload DataTable with new date filters
    });
});
