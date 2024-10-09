<?php

namespace App\Controllers\Organizer;

use App\Controllers\Organizer\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PaymentsModel;
use App\Models\QRCodesModel;
use App\Models\Admin\EventsModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class MyBookingsController extends SessionController
{
    public function index()
    {
        $data = [
            'title' => 'City Agenda | My Bookings',
            'currentpage' => 'mybookings'
        ];
        return view('pages/organizer/mybookings', $data);
    }
    public function getData()
    {
        return datatables('payments')
            ->select('payments.*, events.*, events.event_id as eid')
            ->join('events', 'events.event_id=payments.event_id', 'left')
            ->where('payments.user_id', session()->get('organizer_user_id'))
            ->make();
    }    
    public function getQRCodes($id)
    {
        $qRCodesModel = new QRCodesModel();
        
        $qrCodes = $qRCodesModel->where('payment_id', $id)->findAll();

        return $this->response->setJSON($qrCodes);
    }
    public function generatePDF($id)
    {
        // Fetch QR code and other event details
        $qRCodesModel = new QRCodesModel();
        $qrCode = $qRCodesModel->where('qrcode_id', $id)->first(); // Assuming you want one QR code for simplicity

        $eventName = "Sample Event"; // Replace with actual event name
        $attendeeName = "John Doe"; // Replace with actual attendee name
        $eventDate = "2024-10-01"; // Replace with actual event date
        $eventLocation = "Sample Location"; // Replace with actual event location
        $eventId = "12345"; // Replace with actual event ID

        // QR Code Image
        $qrImageUrl = "/{$qrCode['location']}"; // Dynamically replace the second image

        // Load the HTML content
        $html = view('email-template/ticket', [
            'eventName' => $eventName,
            'shortDescription' => 'A brief description of the event.',
            'attendeeName' => $attendeeName,
            'eventDate' => $eventDate,
            'eventLocation' => $eventLocation,
            'eventId' => $eventId,
            'qrImageUrl' => $qrImageUrl
        ]);

        // Set Dompdf options
        $options = new Options();
        $options->set('defaultFont', 'Poppins');
        $dompdf = new Dompdf($options);

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to browser for download
        return $dompdf->stream('event-details.pdf', ['Attachment' => true]);
    }
}
