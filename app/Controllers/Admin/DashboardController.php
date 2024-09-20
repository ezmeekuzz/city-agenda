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

        $annualSales = $paymentsModel
            ->selectSum('total_amount')
            ->where('YEAR(paymentdate)', date('Y'))
            ->get()
            ->getRow();

        $annualSales = $annualSales->total_amount ?? "0.00";

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
            'annualSales'  => $annualSales,
        ];
        return view('pages/admin/dashboard', $data);
    }
    public function getMonthlySales()
    {
        $paymentsModel = new PaymentsModel();

        // Query to get monthly sales
        $monthlySales = $paymentsModel
            ->select('MONTH(paymentdate) as month, SUM(total_amount) as total_sales')
            ->where('YEAR(paymentdate)', date('Y')) // Filter by current year
            ->groupBy('MONTH(paymentdate)')
            ->orderBy('MONTH(paymentdate)', 'ASC')
            ->findAll();

        // Format the data for the chart (months and sales)
        $salesData = [
            'months' => [],
            'totals' => []
        ];

        // Loop through each month to prepare the data
        foreach ($monthlySales as $sale) {
            $salesData['months'][] = date('F', mktime(0, 0, 0, $sale['month'], 10)); // Convert month number to name
            $salesData['totals'][] = (float) $sale['total_sales'];
        }

        return $this->response->setJSON($salesData); // Return data as JSON
    }
}
