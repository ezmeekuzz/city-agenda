<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\UsersModel;

class LoginController extends BaseController
{

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }
    public function index()
    {
        if (session()->has('organizer_user_id') && session()->get('organizer_usertype') === 'Event Organizer') {
            return redirect()->to('/organizer/dashboard');
        }
        $data = [
            'title' => 'City Agenda'
        ];
        return view('pages/login', $data);
    }
    public function google_callback()
    {
        $userModel = new UsersModel();

        // Get the credential (ID token) from the POST request
        $credential = $this->request->getPost('credential');

        // Verify the ID token with Google API Client
        $client = new \Google_Client(['client_id' => '717214415755-50s2mm9uk13l9rs36jh7am6h59i8kdcn.apps.googleusercontent.com']);
        $payload = $client->verifyIdToken($credential);

        if ($payload) {
            $fullname = $payload['name'];
            $email = $payload['email'];
            $auth_type = 'google'; // For example, use 'google' as auth_type

            // Check if the user already exists
            $existingUser = $this->usersModel->where('email', $email)->where('auth_type', $auth_type)->first();

            if ($existingUser) {
                // User exists, log them in
                // Set session data or perform other login actions
                session()->set([
                    'user_id' => $existingUser['user_id'],
                    'fullname' => $existingUser['fullname'],
                    'email' => $existingUser['email'],
                    'logged_in' => true
                ]);

                return $this->response->setJSON(['success' => true, 'message' => 'Login successful']);
            } else {
                // User does not exist, insert new user
                $this->usersModel->insert([
                    'fullname' => $fullname,
                    'email' => $email,
                    'auth_type' => $auth_type
                ]);

                // After inserting, log the user in
                $newUserId = $userModel->getInsertID();
                session()->set([
                    'user_id' => $newUserId,
                    'fullname' => $fullname,
                    'email' => $email,
                    'logged_in' => true
                ]);

                return $this->response->setJSON(['success' => true, 'message' => 'Registration and login successful']);
            }
        } else {
            // Invalid token
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid token']);
        }
    }
    public function facebook_callback()
    {
        $response = $this->request->getJSON();
        return $this->response->setJSON(['success' => true]);
    }
    public function standardLogin()
    {
        $userModel = new UsersModel();
    
        $emailaddress = $this->request->getPost('emailaddress');
        $password = $this->request->getPost('password');
    
        $result = $userModel
        ->where('emailaddress', $emailaddress)
        ->where('usertype', 'Event Organizer')
        ->first();
    
        if ($result && password_verify($password, $result['encryptedpass'])) {
            // Set session data
            session()->set([
                'organizer_user_id' => $result['user_id'],
                'organizer_firstname' => $result['firstname'],
                'organizer_lastname' => $result['lastname'],
                'organizer_emailaddress' => $result['emailaddress'],
                'organizer_username' => $result['username'],
                'organizer_usertype' => $result['usertype'],
                'OrganizerLoggedIn' => true // Ensure this is set when login is successful
            ]);
            
    
            // Prepare response
            $response = [
                'success' => true,
                'redirect' => '/organizer/dashboard', // Redirect URL upon successful login
                'message' => 'Login successful'
            ];
        } else {
            // Prepare response for invalid login
            $response = [
                'success' => false,
                'message' => 'Invalid login credentials'
            ];
        }
    
        // Return JSON response
        return $this->response->setJSON($response);
    }
}
