<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class FaqController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'City Agenda'
        ];
        return view('pages/faq', $data);
    }
}
