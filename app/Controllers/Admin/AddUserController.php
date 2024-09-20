<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\UsersModel;

class AddUserController extends SessionController
{
    public function index()
    {
        $data = [
            'title' => 'Add City | Add User',
            'currentpage' => 'adduser'
        ];
        return view('pages/admin/adduser', $data);
    }
    public function insert()
    {
        $usersModel = new UsersModel();

        // Get form data
        $firstname = $this->request->getPost('firstname');
        $lastname = $this->request->getPost('lastname');
        $username = $this->request->getPost('username');
        $emailaddress = $this->request->getPost('emailaddress');
        $password = $this->request->getPost('password');
        $usertype = $this->request->getPost('usertype');

        // Check for existing email
        $userList = $usersModel->where('emailaddress', $emailaddress)->first();
        if ($userList) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Email is not available',
            ]);
        }

        // Handle profile image upload
        $profileImage = $this->request->getFile('image');
        $imageName = null;

        if ($profileImage && $profileImage->isValid() && !$profileImage->hasMoved()) {
            $imageName = $profileImage->getRandomName(); // Generate a random file name
            $profileImage->move('uploads/profile-image', $imageName); // Move the file to the uploads folder
        }

        // Prepare user data for insertion
        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'emailaddress' => $emailaddress,
            'password' => $password,
            'encryptedpass' => password_hash($password, PASSWORD_BCRYPT),
            'usertype' => $usertype,
            'image' => 'uploads/profile-image/' . $imageName,
            'created_at' => date('Y-m-d')
        ];

        // Insert the user
        $userId = $usersModel->insert($data);
        if ($userId) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'User added successfully!',
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to add user.',
            ]);
        }
    }
}
