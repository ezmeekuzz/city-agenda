<?php

namespace App\Controllers\Organizer;

use App\Controllers\Organizer\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\UsersModel;

class EditAccountController extends SessionController
{
    public function index($id)
    {
        $usersModel = new UsersModel();
        $userDetails = $usersModel->find($id);
        $data = [
            'title' => 'City Agenda | Edit Account',
            'currentpage' => 'dashboard',
            'userDetails' => $userDetails
        ];
        return view('pages/organizer/editaccount', $data);
    }
}
