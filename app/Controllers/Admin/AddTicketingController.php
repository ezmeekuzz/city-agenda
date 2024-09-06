<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\SessionController;
use App\Models\Admin\TicketsModel;

class AddTicketingController extends SessionController
{
    public function index($id)
    {
        $data = [
            'title' => 'City Agenda | Add Ticketing',
            'currentpage' => 'eventmasterlist',
            'event_id' => $id
        ];
        return view('pages/admin/addticketing', $data);
    }

    public function insert()
    {
        // Load the model
        $ticketsModel = new TicketsModel();
    
        // Get the event_id from the form
        $eventId = $this->request->getPost('event_id');
    
        // Check if the event_id already exists
        $existingTicket = $ticketsModel->where('event_id', $eventId)->first();
    
        if ($existingTicket) {
            // If the event_id exists, return an error message
            return $this->response->setJSON([
                'success' => false,
                'message' => 'A ticket with this event ID already exists.'
            ]);
        }
    
        // Prepare data for insertion
        $ticketData = [
            'event_id' => $eventId,
            'tickettype' => $this->request->getPost('tickettype'),
            'ticketname' => $this->request->getPost('ticketname'),
            'ticketdescription' => $this->request->getPost('ticketdescription'),
            'availablequantity' => $this->request->getPost('availablequantity'),
            'soldquantity' => '0',
            'price' => ($this->request->getPost('price')) ? $this->request->getPost('price') : "0.00",
            'salesstart' => $this->request->getPost('salesstart'),
            'salesend' => $this->request->getPost('salesend')
        ];
    
        // Insert data into the database
        try {
            if ($ticketsModel->insert($ticketData)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Ticket details successfully added.'
                ]);
            } else {
                // Handle case where insertion fails
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to add ticket details.'
                ]);
            }
        } catch (\Exception $e) {
            // Catch any exception and return an error response
            return $this->response->setJSON([
                'success' => false,
                'message' => 'An error occurred while adding ticket details: ' . $e->getMessage()
            ]);
        }
    }    
}
