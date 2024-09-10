<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\UsersModel;

class UserMasterlistController extends SessionController
{
    public function index()
    {
        $data = [
            'title' => 'City Agenda | User Masterlist',
            'currentpage' => 'usermasterlist'
        ];
        return view('pages/admin/usermasterlist', $data);
    }
    public function getData()
    {
        return datatables('users')->make();
    }
    public function delete($id)
    {
        $UsersModel = new UsersModel();
    
        // Retrieve the user details to get the image path
        $user = $UsersModel->find($id);
    
        if ($user) {
            // Check if the user has an image and if the file exists
            if (!empty($user['image']) && file_exists($user['image'])) {
                // Attempt to delete the image file
                unlink($user['image']);
            }
    
            // Proceed to delete the user
            $deleted = $UsersModel->delete($id);
    
            if ($deleted) {
                return $this->response->setJSON(['status' => 'success']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete the user from the database']);
            }
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not found']);
        }
    }   
}
