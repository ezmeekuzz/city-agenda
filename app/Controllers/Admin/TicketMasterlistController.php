<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\EventsModel;
use App\Models\Admin\TicketsModel;

class TicketMasterlistController extends SessionController
{
    public function index()
    {
        $data = [
            'title' => 'City Agenda | Ticket Masterlist',
            'currentpage' => 'ticketmasterlist'
        ];
        return view('pages/admin/ticketmasterlist', $data);
    }
    public function getData()
    {
        return datatables('tickets')
            ->join('events', 'tickets.event_id=events.event_id', 'left')
            ->make();
    }
    public function delete($id)
    {
        $ticketsModel = new TicketsModel();
        $paymentsModel = new PaymentsModel();
        $qRCodesModel = new QRCodesModel();
    
        // Get all payments related to the event
        $payments = $paymentsModel->where('ticket_id', $id)->findAll();
        foreach ($payments as $pay) {
            // Get all QR codes related to the payment
            $qrcodes = $qRCodesModel->where('payment_id', $pay['payment_id'])->findAll();
            foreach ($qrcodes as $qr) {
                if (is_file($qr['location']) && file_exists($qr['location'])) {
                    unlink($qr['location']); // Delete the QR code image
                }
            }
            // Delete QR codes related to this payment
            $qRCodesModel->where('payment_id', $pay['payment_id'])->delete();
        }
    
        // Delete all payments related to the event
        $paymentsModel->where('ticket_id', $id)->delete();
    
        // Delete the ticket related to the event
        $deleted = $ticketsModel->where('ticket_id', $id)->delete();
    
        if ($deleted) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete the ticket from the database']);
        }
    }    
    public function update()
    {
        // Load the model
        $ticketsModel = new TicketsModel();
        
        // Get the form data
        $ticketId = $this->request->getPost('ticket_id');
        $eventId = $this->request->getPost('event_id');
    
        // Ensure ticket_id is provided
        if (!$ticketId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Ticket ID is required for updating.'
            ]);
        }
    
        // Validate the required fields
        if (!$this->validate([
            'tickettype' => 'required',
            'ticketname' => 'required',
            'ticketdescription' => 'required',
            'availablequantity' => 'required|numeric',
            'price' => 'required|decimal',
            'salesstart' => 'required|valid_date',
            'salesend' => 'required|valid_date'
        ])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $this->validator->getErrors()
            ]);
        }
    
        // Prepare data for updating
        $ticketData = [
            'event_id' => $eventId,
            'tickettype' => $this->request->getPost('tickettype'),
            'ticketname' => $this->request->getPost('ticketname'),
            'ticketdescription' => $this->request->getPost('ticketdescription'),
            'availablequantity' => $this->request->getPost('availablequantity'),
            'soldquantity' => 0,  // Set to '0' since it's an update
            'price' => $this->request->getPost('price') ?? "0.00",
            'salesstart' => $this->request->getPost('salesstart'),
            'salesend' => $this->request->getPost('salesend')
        ];
    
        try {
            // Ensure the ticket_id is used as a condition in the update
            if ($ticketsModel->update($ticketId, $ticketData)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Ticket details successfully updated.'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to update ticket details.'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'An error occurred while updating ticket details: ' . $e->getMessage()
            ]);
        }
    }      
}
