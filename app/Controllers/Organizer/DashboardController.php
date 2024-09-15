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
}
