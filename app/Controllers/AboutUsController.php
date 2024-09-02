<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AboutUsController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'City Agenda'
        ];
        return view('pages/about-us', $data);
    }
}
