<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\CategoriesModel;
use App\Models\Admin\EventsModel;
use App\Models\Admin\AgendasModel;
use App\Models\Admin\SpeakersModel;
use App\Models\Admin\SponsorsModel;
use App\Models\Admin\FaqsModel;
use App\Models\Admin\TicketsModel;
use App\Models\Admin\WishListModel;
use App\Models\PaymentsModel;
use App\Models\QRCodesModel;

class EventMasterlistController extends SessionController
{
    public function index()
    {
        $data = [
            'title' => 'City Agenda | Event Masterlist',
            'currentpage' => 'eventmasterlist'
        ];
        return view('pages/admin/eventmasterlist', $data);
    }
    public function getData()
    {
        return datatables('events')
            ->select('events.*, events.event_id as eid, users.*, events.slug as sl, tickets.*')
            ->join('users', 'users.user_id=events.user_id', 'left')
            ->join('tickets', 'tickets.event_id=events.event_id', 'left')
            ->make();
    }
    public function delete($id)
    {
        $eventsModel = new EventsModel();
        $agendasModel = new AgendasModel();
        $speakersModel = new SpeakersModel();
        $sponsorsModel = new SponsorsModel();
        $faqsModel = new FaqsModel();
        $ticketsModel = new TicketsModel();
        $paymentsModel = new PaymentsModel();
        $qRCodesModel = new QRCodesModel();
        $wishListModel = new WishListModel();
    
        // Delete related images and files for each table
    
        // Speakers table (image)
        $speakers = $speakersModel->where('event_id', $id)->findAll();
        foreach ($speakers as $speaker) {
            $imagePath = FCPATH . 'uploads/speaker_images/' . $speaker['image'];
            if (is_file($imagePath) && file_exists($imagePath)) {
                unlink($imagePath); // Delete the speaker image
            }
        }
        $speakersModel->where('event_id', $id)->delete();
    
        // Sponsors table (sponsor_image)
        $sponsors = $sponsorsModel->where('event_id', $id)->findAll();
        foreach ($sponsors as $sponsor) {
            $imagePath = FCPATH . 'uploads/sponsor_images/' . $sponsor['sponsor_logo'];
            if (is_file($imagePath) && file_exists($imagePath)) {
                unlink($imagePath); // Delete the sponsor image
            }
        }
        $sponsorsModel->where('event_id', $id)->delete();
    
        // Delete related payments and their associated QR codes
        $payments = $paymentsModel->where('event_id', $id)->findAll();
        foreach ($payments as $payment) {
            // Delete QR codes related to the payment
            $qrcodes = $qRCodesModel->where('payment_id', $payment['payment_id'])->findAll();
            foreach ($qrcodes as $qr) {
                if (is_file($qr['location']) && file_exists($qr['location'])) {
                    unlink($qr['location']); // Delete the QR code image
                }
            }
            // Delete the QR codes
            $qRCodesModel->where('payment_id', $payment['payment_id'])->delete();
        }
    
        // Now, delete the payments
        $paymentsModel->where('event_id', $id)->delete();
    
        // Tickets table - delete the tickets now
        $ticketsModel->where('event_id', $id)->delete();
    
        // Agendas table (no images to delete, just delete the records)
        $agendasModel->where('event_id', $id)->delete();
    
        // FAQs table (no images, just delete the records)
        $faqsModel->where('event_id', $id)->delete();
    
        // WishList table (no images, just delete the records)
        $wishListModel->where('event_id', $id)->delete();
    
        // Events table (eventbanner, event_image, event_video)
        $event = $eventsModel->find($id);
        if ($event) {
            // Delete event banner
            $bannerPath = FCPATH . $event['eventbanner'];
            if (is_file($bannerPath) && file_exists($bannerPath)) {
                unlink($bannerPath); // Delete the event banner
            }
    
            // Delete event image
            $imagePath = FCPATH . $event['event_image'];
            if (is_file($imagePath) && file_exists($imagePath)) {
                unlink($imagePath); // Delete the event image
            }
    
            // Delete event video
            $videoPath = FCPATH . $event['event_video'];
            if (is_file($videoPath) && file_exists($videoPath)) {
                unlink($videoPath); // Delete the event video
            }
        }
    
        // Finally, delete the event itself
        $deleted = $eventsModel->delete($id);
    
        if ($deleted) {
            $this->dynamicRoutes();
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete the event from the database']);
        }
    }    

    public function getAttendees($id)
    {
        $paymentsModel = new PaymentsModel();

        $paymentDetails = $paymentsModel
        ->join('users', 'users.user_id=payments.user_id', 'left')
        ->where('event_id', $id)
        ->findAll();

        $response = [
            'status' => 'success',
            'data' => $paymentDetails
        ];
        
        return $this->response->setJSON($response);
    }

    public function downloadAttendees($id)
    {
        $paymentsModel = new PaymentsModel();

        // Fetch payment details for the specified event
        $paymentDetails = $paymentsModel
            ->join('users', 'users.user_id=payments.user_id', 'left')
            ->where('event_id', $id)
            ->findAll();

        // Prepare the CSV content
        $csvData = [];
        $csvData[] = ['Name', 'Email', 'Phone Number', 'Quantity', 'Amount Paid', 'Ticket ID']; // CSV Header

        foreach ($paymentDetails as $payment) {
            $formattedTicketId = 'TD' . str_pad($payment['payment_id'], 6, '0', STR_PAD_LEFT);
            $csvData[] = [
                $payment['firstname'] . ' ' . $payment['lastname'],
                $payment['emailaddress'],
                $payment['phonenumber'],
                $payment['quantity'],
                $payment['total_amount'],
                $formattedTicketId
            ];
        }

        // Convert the data to CSV format
        $filename = 'attendees_event_' . $id . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        foreach ($csvData as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
        exit();
    }

    public function shareAttendees($id)
    {
        $paymentsModel = new PaymentsModel();
        
        // Ensure the $id is an integer
        $id = (int) $id;
        log_message('debug', 'Event ID before padding: ' . $id);
        
        // Fetch payment details for the specified event
        $paymentDetails = $paymentsModel
            ->join('users', 'users.user_id=payments.user_id', 'left')
            ->where('event_id', $id)
            ->findAll();
        
        // Prepare the email content
        $formattedId = str_pad($id, 5, '0', STR_PAD_LEFT);
        log_message('debug', 'Formatted Event ID: CA' . $formattedId); // Log formatted ID
        
        $emailContent = "<h2>Attendees List for Event ID: CA" . $formattedId . "</h2>";
        if (empty($paymentDetails)) {
            $emailContent .= "<p>No attendees found for this event.</p>";
        } else {
            // Build table structure for attendees
            $emailContent .= "<table border='1' cellpadding='5'>";
            $emailContent .= "<tr><th>Name</th><th>Email</th><th>Phone Number</th><th>Quantity</th><th>Amount Paid</th><th>Ticket ID</th></tr>";
            
            foreach ($paymentDetails as $payment) {
                $formattedTicketId = 'TD' . str_pad($payment['payment_id'], 6, '0', STR_PAD_LEFT);
                $emailContent .= "<tr>
                    <td>{$payment['firstname']} {$payment['lastname']}</td>
                    <td>{$payment['emailaddress']}</td>
                    <td>{$payment['phonenumber']}</td>
                    <td>{$payment['quantity']}</td>
                    <td>{$payment['total_amount']}</td>
                    <td>{$formattedTicketId}</td>
                </tr>";
            }
            
            $emailContent .= "</table>";
        }
        
        // Set up email
        $email = \Config\Services::email();
        $email->setFrom('testing@braveegg.com', 'City Agenda');
        $email->setTo($this->request->getPost('email')); // Set the recipient email
        $email->setSubject('Attendees List');
        $email->setMessage($emailContent);
        $email->setMailType('html');
        
        // Send the email
        if (!$email->send()) {
            log_message('error', $email->printDebugger(['headers', 'subject', 'body']));
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to send email.']);
        }
        
        return $this->response->setJSON(['status' => 'success', 'message' => 'Email sent successfully!']);
    }
        
    private function dynamicRoutes() {
        $model = new EventsModel();
        $result = $model->findAll();
        $data = [];
    
        if (count($result)) {
            foreach ($result as $route) {
                $data[$route['slug']] = 'EventDetailController::index/' . $route['event_id'];
            }
        }
    
        $output = '<?php' . PHP_EOL;
        foreach ($data as $slug => $controllerMethod) {
            $output .= '$routes->get(\'' . $slug . '\', \'' . $controllerMethod . '\');' . PHP_EOL;
        }
    
        $filePath = ROOTPATH . 'app/Config/EventsRoutes.php';
    
        file_put_contents($filePath, $output);
    }   
}
