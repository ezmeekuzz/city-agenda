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
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;

class EventDetailController extends BaseController
{
    public function index($id)
    {
        $eventsModel = new EventsModel();
        $agendasModel = new AgendasModel();
        $sponsorsModel = new SponsorsModel();
        $speakersModel = new SpeakersModel();
        $faqsModel = new FaqsModel();

        $eventDetails = $eventsModel
        ->join('tickets', 'events.event_id=tickets.event_id')
        ->join('users', 'events.user_id=users.user_id')
        ->join('cities', 'events.city_id=cities.city_id')
        ->join('states', 'events.state_id=states.state_id')
        ->join('categories', 'events.category_id=categories.category_id')
        ->find($id);

        $agendasDetails = $agendasModel->where('event_id', $id)->findAll();

        $sponsorsDetails = $sponsorsModel->where('event_id', $id)->findAll();

        $speakersDetails = $speakersModel->where('event_id', $id)->findAll();

        $faqsDetails = $faqsModel->where('event_id', $id)->findAll();

        $eventDateTime = $eventDetails['eventdate'] . ' ' . $eventDetails['eventstartingtime'];
        $date = strtotime($eventDetails['eventdate']); // Convert date to timestamp
        $startingtime = strtotime($eventDetails['eventstartingtime']); // Convert time to timestamp
        $endingtime = strtotime($eventDetails['eventendingtime']); // Convert time to timestamp

        // Format the date as: Friday, August 9
        $formattedDate = date('l, F j', $date);

        // Format the time as: 12 - 5 AM PST (Assuming your event starts at 12 AM and ends at 5 AM)
        $formattedTime = date('g A', $startingtime) . ' - ' . date('g A', $endingtime);

        // Combine the formatted date and time
        $eventSchedule =  $formattedDate . ' · ' . $formattedTime;
        $data = [
            'title' => $eventDetails['eventname'],
            'eventDetails' => $eventDetails,
            'eventDateTime' => $eventDateTime,
            'eventSchedule' => $eventSchedule,
            'agendasDetails' => $agendasDetails,
            'sponsorsDetails' => $sponsorsDetails,
        ];
        if($eventDetails['tickettype'] == "Paid") {
            if(!empty($speakersDetails) && !empty($faqsDetails)) {
                return view('pages/conference-details', $data);
            }
            else {
                return view('pages/paid-event-details', $data);
            }
        }
        else if($eventDetails['tickettype'] == "Free") {
            if(!empty($speakersDetails) && !empty($faqsDetails)) {
                return view('pages/conference-details', $data);
            }
            else {
                return view('pages/free-event-details', $data);
            }
        }
        else if($eventDetails['tickettype'] == "Donations") {
            if(!empty($speakersDetails) && !empty($faqsDetails)) {
                return view('pages/conference-details', $data);
            }
            else {
                return view('pages/donations-event-details', $data);
            }
        }
        else {
            if(!empty($speakersDetails) && !empty($faqsDetails)) {
                return view('pages/conference-details', $data);
            }
            else {
                return view('pages/no-tickets-event-details', $data);
            }
        }
    }
    public function stripePayment()
    {
        $paymentsModel = new PaymentsModel();
        $ticketsModel = new TicketsModel();
        // Load Stripe configuration (e.g., secret key)
        \Stripe\Stripe::setApiKey('sk_test_psnnxdjci1eIQuKfXhl8nrtm'); // Replace with your secret key
    
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
    
            return $this->response->setJSON(['success' => true, 'message' => 'Payment successful!']);
        } catch (\Exception $e) {
            // Handle Stripe errors
            return $this->response->setJSON(['error' => true, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }    
}
