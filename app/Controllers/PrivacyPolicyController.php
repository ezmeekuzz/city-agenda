<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PrivacyPolicyController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'City Agenda'
        ];
        return view('pages/privacy-policy', $data);
    }
}
