<?php

namespace App\Controllers\Organizer;

use App\Controllers\Organizer\SessionController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends SessionController
{
    public function index()
    {
        $data = [
            'title' => 'City Agenda | Dashboard',
            'currentpage' => 'dashboard'
        ];
        return view('pages/organizer/dashboard', $data);
    }
    public function getData()
    {
        $dateFrom = $this->request->getGet('date_from');
        $dateTo = $this->request->getGet('date_to');
    
        $builder = datatables('payments')
            ->select('payments.*, events.*, events.event_id as eid')
            ->join('events', 'events.event_id = payments.event_id', 'left')
            ->where('events.user_id', session()->get('organizer_user_id'));
    
        // Apply date filtering if provided
        if ($dateFrom && $dateTo) {
            $builder->where('payments.paymentdate >=', $dateFrom)
                    ->where('payments.paymentdate <=', $dateTo);
        }
    
        return $builder->make();
    }    
}
