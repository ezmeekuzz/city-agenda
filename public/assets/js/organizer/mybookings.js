$(document).ready(function () {
    function formatEventId(eventId, slug) {
        // Ensure eventId is a number or a string that can be converted to a number
        eventId = parseInt(eventId, 10);
        
        // Format the ID with a "CA" prefix and zero-padded to 5 digits
        return `<a href="/${slug}" target="_blank">CA${eventId.toString().padStart(5, '0')}</a>`;
    }

    var table = $('#mybookings').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/organizer/mybookings/getData",  // Matches your server-side endpoint
            "type": "GET"
        },
        "order": [[4, 'desc']],
        "columns": [
            {
                "data": "eid",  // Access the aliased 'event_id' as 'eid'
                "render": function (data, type, row) {
                    // Format event_id using formatEventId function, passing slug from the row
                    return formatEventId(data, row.slug);
                }
            },
            { "data": "price" },  // Assuming 'price' is part of 'payments' table
            { "data": "quantity" },  // Assuming 'quantity' is part of 'payments'
            { "data": "total_amount" },  // Assuming 'total_amount' is part of 'payments'
            { "data": "paymentdate" }  // Assuming 'paymentdate' is part of 'payments'
        ],
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('data-id', data.eid);  // Assign 'eid' as the row's data-id
        },
        "initComplete": function (settings, json) {
            $(this).trigger('dt-init-complete');
        }
    });
});
