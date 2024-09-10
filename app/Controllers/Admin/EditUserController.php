<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\UsersModel;

class EditUserController extends SessionController
{
    public function index($id)
    {
        $usersModel = new UsersModel();
        $userDetails = $usersModel->find($id);
        $data = [
            'title' => 'City Agenda | PageDuo',
            'currentpage' => 'usermasterlist',
            'userDetails' => $userDetails
        ];
        return view('pages/admin/edituser', $data);
    }
    public function update()
    {
        $usersModel = new UsersModel();
        $userId = $this->request->getPost('user_id');
        $firstname = $this->request->getPost('firstname');
        $lastname = $this->request->getPost('lastname');
        $username = $this->request->getPost('username');
        $emailaddress = $this->request->getPost('emailaddress');
        $password = $this->request->getPost('password');
        $usertype = $this->request->getPost('usertype');

        $existingUser = $usersModel->find($userId);

        // Check if the image field exists before accessing it
        $oldImagePath = isset($existingUser['image']) ? $existingUser['image'] : null;
        
        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'emailaddress' => $emailaddress,
            'usertype' => $usertype // Assuming usertype should not be updated here
        ];
    
        // Check if password is provided and update password fields accordingly
        if (!empty($password)) {
            $data['password'] = $password;
            $data['encryptedpass'] = password_hash($password, PASSWORD_BCRYPT);
        }

        $profileImage = $this->request->getFile('image');
        if ($profileImage && $profileImage->isValid() && !$profileImage->hasMoved()) {
            // Generate a random file name and move the file to the uploads folder
            $newImageName = $profileImage->getRandomName();
            $profileImage->move('uploads/profile-image', $newImageName);
            $data['image'] = 'uploads/profile-image/' . $newImageName;
    
            // Remove old image if a new one is uploaded
            if ($oldImagePath && file_exists($oldImagePath)) {
                unlink($oldImagePath); // Delete the old image from the server
            }
        }    
        
        // Check if the provided username is already in use
        $userList = $usersModel->where('emailaddress', $emailaddress)->where('user_id !=', $userId)->first();
        if ($userList) {
            $response = [
                'success' => false,
                'message' => 'Email is not available',
            ];
        } else {
            // Update the user data
            $updated = $usersModel->update($userId, $data);
    
            if ($updated) {
                $response = [
                    'success' => true,
                    'message' => 'User updated successfully!',
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to update user.',
                ];
            }
        }
    
        return $this->response->setJSON($response);
    }    
}
