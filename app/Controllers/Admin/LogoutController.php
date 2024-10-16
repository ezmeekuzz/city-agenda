<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class LogoutController extends BaseController
{
    public function index()
    {
        session()->remove([
            'user_id', 'firstname', 'lastname', 'emailaddress', 'usertype', 'username', 'AdminLoggedIn'
        ]);
        return redirect()->to('/admin');
    }
}
