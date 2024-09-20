<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\UsersModel;
use App\Models\Admin\EventsModel;
use App\Models\PaymentsModel;

class DashboardController extends SessionController
{
    public function index()
    {
        $usersModel = new UsersModel();
        $eventsModel = new EventsModel();
        $paymentsModel = new PaymentsModel();

        $usersAddedToday = $usersModel->where('DATE(created_at)', date('Y-m-d'))->where('usertype', 'Event Organizer')->countAllResults();
        $allRegisteredUsers = $usersModel->where('usertype', 'Event Organizer')->countAllResults();

        $eventsAddedToday = $eventsModel->where('DATE(dateadded)', date('Y-m-d'))->countAllResults();
        $allEvents = $eventsModel->countAllResults();

        $ticketsOrderedToday = $paymentsModel
        ->selectSum('quantity')
        ->where('DATE(paymentdate)', date('Y-m-d'))
        ->get()
        ->getRow();
    
        $ticketsOrderedToday = $ticketsOrderedToday->quantity ?? 0;

        $totalEarningsToday = $paymentsModel
        ->selectSum('total_amount')
        ->where('DATE(paymentdate)', date('Y-m-d'))
        ->get()
        ->getRow();
    
        $totalEarningsToday = $totalEarningsToday->total_amount ?? "0.00";

        $overAllSales = $paymentsModel
        ->selectSum('total_amount')
        ->get()
        ->getRow();
    
        $overAllSales = $overAllSales->total_amount ?? "0.00";

        $data = [
            'title' => 'City Agenda | Dashboard',
            'currentpage' => 'dashboard',
            'usersAddedToday'  => $usersAddedToday,
            'allRegisteredUsers'  => $allRegisteredUsers,
            'eventsAddedToday'  => $eventsAddedToday,
            'allEvents'  => $allEvents,
            'ticketsOrderedToday'  => $ticketsOrderedToday,
            'totalEarningsToday'  => $totalEarningsToday,
            'overAllSales'  => $overAllSales,
        ];
        return view('pages/admin/dashboard', $data);
    }
}
