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
            { "data": "eventname" },  // Event name
            { "data": "price" },      // Price
            {
                "data": "quantity",   // Quantity as anchor tag with data-id
                "render": function (data, type, row) {
                    return `<a href="javascript:void(0)" class="open-qr-modal" data-id="${row.payment_id}">${data}</a>`;
                }
            },
            { "data": "total_amount" },  // Total paid
            { "data": "paymentdate" }    // Payment date
        ],
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('data-id', data.eid);  // Assign 'eid' as the row's data-id
        },
        "initComplete": function (settings, json) {
            $(this).trigger('dt-init-complete');
        }
    });

    // Event listener for opening the QR code modal
    $(document).on('click', '.open-qr-modal', function () {
        var eventId = $(this).data('id');
        
        // Make an AJAX request to get the list of QR codes for the event
        $.ajax({
            url: `/organizer/mybookings/getQRCodes/${eventId}`,  // Adjust this URL based on your server structure
            method: 'GET',
            success: function (response) {
                let qrHtml = `
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>QR Code</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>`;

                // Loop through the QR codes and generate a table row for each
                response.forEach(function (qrCode) {
                    const qrImageUrl = `${qrCode.location}`;
                    qrHtml += `
                        <tr>
                            <td><a href="/${qrImageUrl}" class="qr-popup"><img src="/${qrImageUrl}" alt="QR Code" class="img-fluid" style="max-width: 100px;"></a></td>
                            <td><a href="javascript:void(0)" data-event-id="${eventId}" data-id="${qrCode.qrcode_id}" class="btn btn-primary download-pdf">Download</a></td>
                        </tr>`;
                });

                qrHtml += `
                        </tbody>
                    </table>`;

                // Insert the QR code table HTML into the modal
                $('#qrCodes').html(qrHtml);
                
                // Show the modal
                $('#qrcodesModal').modal('show');

                // Initialize Magnific Popup on the QR code images
                $('.qr-popup').magnificPopup({
                    type: 'image',
                    gallery: {
                        enabled: true // Enable gallery mode
                    }
                });
            },
            error: function () {
                alert('Failed to load QR codes.');
            }
        });
    });
});
$(document).on('click', '.download-pdf', function () {
    var qrcode_id = $(this).data('id');
    var eventId = $(this).data('event-id');

    // Trigger the PDF generation and download
    window.location.href = `/organizer/mybookings/generatePDF/${qrcode_id}`;
});