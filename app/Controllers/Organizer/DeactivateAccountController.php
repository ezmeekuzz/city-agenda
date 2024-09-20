<?php

namespace App\Controllers\Organizer;

use App\Controllers\Organizer\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\UsersModel;

class DeactivateAccountController extends SessionController
{
    public function index() 
    {
        $usersModel = new UsersModel();

        // Get the user_id from the POST request
        $user_id = $this->request->getPost('user_id');

        if ($user_id) {
            // Update the account_status to 'deactivated'
            $data = [
                'account_status' => 'deactivated'
            ];

            // Update the user data
            if ($usersModel->update($user_id, $data)) {
                // Check if the update affected any rows
                if ($usersModel->affectedRows() > 0) {
                    return $this->response->setJSON(['success' => true, 'message' => 'Account successfully deactivated.']);
                } else {
                    return $this->response->setJSON(['success' => false, 'message' => 'No changes were made.']);
                }
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to deactivate account.']);
            }
        }

        // If no user_id is provided
        return $this->response->setJSON(['success' => false, 'message' => 'Invalid request.']);
    }
}
