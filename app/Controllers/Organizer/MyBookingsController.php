<?php

namespace App\Controllers\Organizer;

use App\Controllers\Organizer\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PaymentsModel;

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
}
