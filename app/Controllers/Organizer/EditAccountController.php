<?php

namespace App\Controllers\Organizer;

use App\Controllers\Organizer\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\UsersModel;

class EditAccountController extends SessionController
{
    public function index($id)
    {
        $usersModel = new UsersModel();
        $userDetails = $usersModel->find($id);
        $image = ($userDetails['image'] != "") ? '/' . $userDetails['image'] : base_url() . "assets/img/avatar.png";
        $coverphoto = ($userDetails['coverphoto'] != "") ? '/' . $userDetails['coverphoto'] : "https://via.placeholder.com/500";
        $data = [
            'title' => 'City Agenda | Edit Account',
            'currentpage' => 'editaccount',
            'userDetails' => $userDetails,
            'image' => $image,
            'coverphoto' => $coverphoto,
        ];
        return view('pages/organizer/editaccount', $data);
    }
    public function update()
    {
        $validation = \Config\Services::validation();
    
        // Set validation rules for the form fields
        $validation->setRules([
            'firstname' => 'required',
            'lastname' => 'required',
            'jobtitle' => 'required',
            'emailaddress' => 'required|valid_email',
            'phonenumber' => 'required',
            'aboutyourself' => 'required'
        ]);
    
        if (!$this->validate($validation->getRules())) {
            return $this->response->setStatusCode(400)->setBody('Validation failed!');
        }
    
        // Load user details
        $userId = session()->get('organizer_user_id');  // Assuming you have the user ID in the session
        $userModel = new UsersModel();  // Assuming UserModel handles user data
        $user = $userModel->find($userId);
    
        if (!$user) {
            return $this->response->setStatusCode(404)->setBody('User not found!');
        }
    
        // Update user details
        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'lastname' => $this->request->getPost('lastname'),
            'jobtitle' => $this->request->getPost('jobtitle'),
            'emailaddress' => $this->request->getPost('emailaddress'),
            'phonenumber' => $this->request->getPost('phonenumber'),
            'aboutyourself' => $this->request->getPost('aboutyourself')
        ];
    
        // Handle image upload (optional)
        $file = $this->request->getFile('profilePicture');
        $coverPhoto = $this->request->getFile('coverPhoto');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Delete the old profile image if it exists
            if (!empty($user['image']) && file_exists(FCPATH . 'uploads/profile-image/' . $user['image'])) {
                unlink(FCPATH . 'uploads/profile-image/' . $user['image']);
            }
    
            // Save the new profile image
            $newFileName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/profile-image', $newFileName);
            $data['image'] = 'uploads/profile-image/' . $newFileName;
        }
        
        if ($coverPhoto && $coverPhoto->isValid() && !$coverPhoto->hasMoved()) {
            // Delete the old profile image if it exists
            if (!empty($user['coverphoto']) && file_exists(FCPATH . 'uploads/cover-photo/' . $user['coverphoto'])) {
                unlink(FCPATH . 'uploads/profile-image/' . $user['image']);
            }
    
            // Save the new profile image
            $newFileName2 = $coverPhoto->getRandomName();
            $coverPhoto->move(FCPATH . 'uploads/cover-photo', $newFileName2);
            $data['coverphoto'] = 'uploads/cover-photo/' . $newFileName2;
        }
    
        // Update user in the database
        $userModel->update($userId, $data);
    
        return $this->response->setStatusCode(200)->setBody('Account updated successfully!');
    }     
}
