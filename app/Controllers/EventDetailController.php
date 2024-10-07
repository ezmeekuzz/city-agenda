<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\EventsModel;
use App\Models\Admin\AgendasModel;
use App\Models\Admin\SponsorsModel;
use App\Models\Admin\TicketsModel;
use App\Models\Admin\SpeakersModel;
use App\Models\Admin\FaqsModel;
use App\Models\PaymentsModel;
use App\Models\QRCodesModel;
use App\Models\Admin\WishListModel;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class EventDetailController extends BaseController
{
    public function index($id)
    {
        $eventsModel = new EventsModel();
        $agendasModel = new AgendasModel();
        $sponsorsModel = new SponsorsModel();
        $speakersModel = new SpeakersModel();
        $faqsModel = new FaqsModel();
        $WishListModel = new WishListModel();
    
        // Fetch all event listings
        $eventLists = $eventsModel
            ->join('tickets', 'events.event_id=tickets.event_id')
            ->join('users', 'events.user_id=users.user_id')
            ->join('categories', 'events.category_id=categories.category_id')
            ->findAll();
    
        foreach ($eventLists as &$event) {
            // Check if the event is in the wishlist
            $isFavorited = $WishListModel
                ->where('user_id', session()->get('organizer_user_id'))
                ->where('event_id', $event['event_id'])
                ->countAllResults() > 0;
    
            // Add the wishlist status to the event data
            $event['is_favorited'] = $isFavorited;
        }
    
        // Get details for a specific event
        $eventDetails = $eventsModel
            ->join('tickets', 'events.event_id=tickets.event_id')
            ->join('users', 'events.user_id=users.user_id')
            ->join('categories', 'events.category_id=categories.category_id')
            ->find($id);
    
        $agendasDetails = $agendasModel->where('event_id', $id)->findAll();
        $sponsorsDetails = $sponsorsModel->where('event_id', $id)->findAll();
        $speakersDetails = $speakersModel->where('event_id', $id)->findAll();
        $faqsDetails = $faqsModel->where('event_id', $id)->findAll();
    
        $eventDateTime = $eventDetails['eventdate'] . ' ' . $eventDetails['eventstartingtime'];
        $date = strtotime($eventDetails['eventdate']);
        $startingtime = strtotime($eventDetails['eventstartingtime']);
        $endingtime = strtotime($eventDetails['eventendingtime']);
    
        // Format the date and time
        $formattedDate = date('l, F j', $date);
        $formattedTime = date('g A', $startingtime) . ' - ' . date('g A', $endingtime);
        $eventSchedule =  $formattedDate . ' · ' . $formattedTime;
    
        // Prepare data to be passed to the view
        $data = [
            'title' => $eventDetails['eventname'],
            'eventDetails' => $eventDetails,
            'eventDateTime' => $eventDateTime,
            'eventSchedule' => $eventSchedule,
            'agendasDetails' => $agendasDetails,
            'sponsorsDetails' => $sponsorsDetails,
            'eventLists' => $eventLists, // Pass the event list with the wishlist status
        ];
    
        // Select the view based on the ticket type
        if ($eventDetails['tickettype'] == "Paid") {
            if (!empty($speakersDetails) && !empty($faqsDetails)) {
                $data['speakersDetails'] = $speakersDetails;
                $data['faqsDetails'] = $faqsDetails;
                return view('pages/conference-details', $data);
            } else {
                return view('pages/paid-event-details', $data);
            }
        } else if ($eventDetails['tickettype'] == "Free") {
            if (!empty($speakersDetails) && !empty($faqsDetails)) {
                $data['speakersDetails'] = $speakersDetails;
                $data['faqsDetails'] = $faqsDetails;
                return view('pages/conference-details', $data);
            } else {
                return view('pages/free-event-details', $data);
            }
        } else if ($eventDetails['tickettype'] == "Donations") {
            if (!empty($speakersDetails) && !empty($faqsDetails)) {
                $data['speakersDetails'] = $speakersDetails;
                $data['faqsDetails'] = $faqsDetails;
                return view('pages/conference-details', $data);
            } else {
                return view('pages/donations-event-details', $data);
            }
        } else {
            if (!empty($speakersDetails) && !empty($faqsDetails)) {
                $data['speakersDetails'] = $speakersDetails;
                $data['faqsDetails'] = $faqsDetails;
                return view('pages/conference-details', $data);
            } else {
                return view('pages/no-tickets-event-details', $data);
            }
        }
    }
    
    public function stripePayment()
    {
        $paymentsModel = new PaymentsModel();
        $ticketsModel = new TicketsModel();
        $qrcodesModel = new QRCodesModel(); // Assuming QRCodesModel is already imported
        
        // Load Stripe configuration (e.g., secret key)
        \Stripe\Stripe::setApiKey('sk_test_psnnxdjci1eIQuKfXhl8nrtm'); // Replace with your secret key
    
        // Load email library
        $email = \Config\Services::email();
    
        // Get POST data from the AJAX request
        $ticket_id = $this->request->getPost('ticket_id');
        $event_id = $this->request->getPost('event_id');
        $price = $this->request->getPost('price');
        $totalAmount = $this->request->getPost('total_sales');
        $quantity = $this->request->getPost('quantity');
        $ticketType = $this->request->getPost('tickettype');
        $token = $this->request->getPost('stripeToken');
        $formattedEventId = sprintf('CA%05d', $event_id);
    
        $ticketDetails = $ticketsModel->find($ticket_id);
    
        // Check if enough tickets are available
        if ($ticketDetails && $ticketDetails['availablequantity'] < $quantity) {
            return $this->response->setJSON([
                'error' => true, 
                'message' => 'We only have ' . $ticketDetails['availablequantity'] . ' available tickets!'
            ]);
        }
    
        // Insert payment record
        $data = [
            'user_id' => session()->get('organizer_user_id'),
            'event_id' => $event_id,
            'ticket_id' => $ticket_id,
            'price' => $price,
            'total_amount' => $totalAmount,
            'quantity' => $quantity,
            'ticket_type' => $ticketType,
            'paymentdate' => date('Y-m-d')
        ];
    
        $receiptNumber = $paymentsModel->insert($data);
    
        try {
            // Create a charge with Stripe
            $charge = \Stripe\Charge::create([
                'amount' => $totalAmount * 100, // Amount in cents
                'currency' => 'eur',
                'description' => "Payment for event #$formattedEventId, ticket #$ticket_id, Receipt #$receiptNumber",
                'source' => $token
            ]);
    
            // Update the ticket record
            $newAvailableQuantity = $ticketDetails['availablequantity'] - $quantity;
            $newSoldQuantity = $ticketDetails['soldticket'] + $quantity;
    
            $ticketsModel->update($ticket_id, [
                'availablequantity' => $newAvailableQuantity,
                'soldticket' => $newSoldQuantity,
            ]);
    
            // Generate a QR code for each quantity
            for ($i = 0; $i < $quantity; $i++) {
                // Create the QR code content (you can modify this as needed)
                $qrCodeContent = "Ticket #" . ($i + 1) . " for event #" . $event_id . ", ticket ID #" . $ticket_id . ", Receipt #" . $receiptNumber . ", Buyer Name : " . session()->get('organizer_firstname') . ' ' . session()->get('organizer_lastname');
    
                // Ensure the directory exists
                if (!is_dir(FCPATH . 'uploads/qrcodes')) {
                    mkdir(FCPATH . 'uploads/qrcodes', 0777, true);
                }
    
                // Generate a unique file name for the QR code
                $randomName = uniqid('qrcode_') . '.png';
                $filePath = FCPATH . 'uploads/qrcodes/' . $randomName;
    
                // Create the QR code
                $qrCode = QrCode::create($qrCodeContent);
                $writer = new PngWriter();
                $writer->write($qrCode)->saveToFile($filePath);
    
                // Save QR code path to the database
                $qrcodeData = [
                    'payment_id' => $receiptNumber,
                    'location' => 'uploads/qrcodes/' . $randomName,  // Save relative path
                ];
                $qrcodesModel->insert($qrcodeData);
            }
    
            // Step 3: Send email after successful payment
            $recipientEmail = session()->get('organizer_emailaddress');
    
            // Prepare email content using ticket.php
            $attendeeName = session()->get('organizer_firstname') . ' ' . session()->get('organizer_lastname');
            $emailContent = view('email-template/ticket', [
                'eventName' => 'Football League 2024',
                'attendeeName' => $attendeeName,
                'eventDate' => 'Friday, August 9 . 12-5AM PST',
                'eventLocation' => 'Albuquerque, New Mexico',
                'eventId' => $formattedEventId,
                'ticketType' => $ticketType,
                'price' => $price,
            ]);
    
            // Configure and send the email
            $email->setTo($recipientEmail);
            $email->setSubject('Your Ticket for Football League 2024');
            $email->setMessage($emailContent);
    
            if ($email->send()) {
                return $this->response->setJSON(['success' => true, 'message' => 'Payment successful! Ticket sent to your email.']);
            } else {
                return $this->response->setJSON(['error' => true, 'message' => 'Payment successful, but failed to send the email.']);
            }
        } catch (\Exception $e) {
            // Handle Stripe errors
            return $this->response->setJSON(['error' => true, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }    
}
