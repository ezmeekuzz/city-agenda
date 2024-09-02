<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TermsOfUseController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'City Agenda'
        ];
        return view('pages/terms-of-use', $data);
    }
}
