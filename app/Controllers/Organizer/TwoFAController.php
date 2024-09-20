<?php

namespace App\Controllers\Organizer;

use App\Controllers\Organizer\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\UsersModel;

class TwoFAController extends SessionController
{
    public function index() 
    {
        if ($this->request->isAJAX()) {
            $twoFactorEnabled = $this->request->getPost('two_factor_enabled');
    
            // Assume you have a session or method to get the current user
            $userId = session()->get('organizer_user_id');
    
            // Update the 2FA status in the database
            $updateData = [
                'two_factor_enabled' => $twoFactorEnabled
            ];
    
            $userModel = new UsersModel();
            if ($userModel->update($userId, $updateData)) {
                // Return success response
            // Set session data
                session()->set([
                    'organizer_two_factor_enabled' => $twoFactorEnabled
                ]);
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Two-Factor Authentication status updated successfully.'
                ]);
            } else {
                // Return failure response
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to update Two-Factor Authentication status.'
                ]);
            }
        } else {
            // Handle non-AJAX request if needed
            return redirect()->to(base_url('organizer/edit-account/' . session()->get('organizer_user_id')));
        }
    }
}
