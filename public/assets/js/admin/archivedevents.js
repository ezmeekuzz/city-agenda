$(document).ready(function () {
    function formatEventId(eventId) {
        // Ensure eventId is a number or a string that can be converted to a number
        eventId = parseInt(eventId, 10);
        
        // Format the ID with a "CA" prefix and zero-padded to 5 digits
        return `CA${eventId.toString().padStart(5, '0')}`;
    }
    var table = $('#archivedevents').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/admin/archivedevents/getData",
            "type": "GET"
        },
        "columns": [
            { 
                data: null,
                render: function (data, type, row) {
                    return `${row.firstname} ${row.lastname}`;
                }
            },
            { "data": "emailaddress" },
            {
                "data": "event_id",
                "render": function (data, type, row) {
                    // Format event_id using formatEventId function
                    return formatEventId(data);
                }
            },
            { "data": "eventname" },
            { "data": "eventtype" },
            { "data": "eventdate" },
            { "data": "eventstartingtime" },
            { "data": "eventendingtime" },
            { "data": "recurrence" },
            { "data": "locationname" },
            { "data": "state_name" },
            { "data": "cityname" },
            { "data": "publishstatus" },
        ],
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('data-id', data.event_id);
        },
        "initComplete": function (settings, json) {
            $(this).trigger('dt-init-complete');
        }
    });
});
