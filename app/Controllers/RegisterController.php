<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\UsersModel;

class RegisterController extends BaseController
{
    public function index()
    {
        $logInAs = $this->request->getGet('account');
        $data = [
            'title' => 'City Agenda'
        ];
        if($logInAs == 'event_organizer') {
            return view('pages/register-event-organizer', $data);
        }
        else {
            return view('pages/register-member', $data);
        }
    }
    public function insert()
    {
        $usersModel = new UsersModel();
    
        // Get form input
        $firstname = $this->request->getPost('firstname');
        $lastname = $this->request->getPost('lastname');
        $emailaddress = $this->request->getPost('emailaddress');
        $password = $this->request->getPost('password');
    
        // Check if the email already exists in the database
        $existingUser = $usersModel->where('emailaddress', $emailaddress)->first();
    
        if ($existingUser) {
            // Email already exists, return error response
            $response = [
                'success' => false,
                'message' => 'The email address is already registered.',
            ];
        } else {
            // If the email does not exist, proceed with inserting the new user
            $data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'emailaddress' => $emailaddress,
                'password' => $password,
                'encryptedpass' => password_hash($password, PASSWORD_BCRYPT),
                'usertype' => 'Event Organizer',
            ];
    
            $inserted = $usersModel->insert($data);
    
            if ($inserted) {
                $response = [
                    'success' => true,
                    'message' => 'You successfully registered to the website!',
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to register on the website!',
                ];
            }
        }
    
        // Return JSON response
        return $this->response->setJSON($response);
    }    
}
