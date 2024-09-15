<?php

namespace App\Controllers\Organizer;

use App\Controllers\BaseController;

class LogoutController extends BaseController
{
    public function index()
    {
        session()->remove([
            'organizer_user_id', 'organizer_firstname', 'organizer_lastname', 'organizer_emailaddress', 'organizer_usertype', 'organizer_username', 'OrganizerLoggedIn'
        ]);
        return redirect()->to('/');
    }
}
