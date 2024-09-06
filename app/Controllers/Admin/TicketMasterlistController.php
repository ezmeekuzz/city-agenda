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

        $deleted = $ticketsModel->where('ticket_id', $id)->delete();
    
        if ($deleted) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete the ticket from the database']);
        }
    }  
}
