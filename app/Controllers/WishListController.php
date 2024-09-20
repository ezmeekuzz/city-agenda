<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Admin\WishListModel;

class WishListController extends BaseController
{
    public function index()
    {
        $wishListModel = new WishListModel();
        $eventId = $this->request->getPost('event_id');
        $isFavorited = filter_var($this->request->getPost('is_favorited'), FILTER_VALIDATE_BOOLEAN); // Ensure boolean conversion
    
        // Check if the user is logged in by verifying session existence
        $userId = session()->get('organizer_user_id') ?? session()->get('member_user_id');
    
        if (!$userId) {
            // User is not logged in, return an error message
            return $this->response->setJSON(['status' => 'error', 'message' => 'You need to log in first to add this event to your wishlist.']);
        }
    
        if ($isFavorited) {
            // Add event to the wishlist
            $data = [
                'user_id' => $userId,
                'event_id' => $eventId
            ];
            $wishListModel->insert($data);
        } else {
            // Remove event from the wishlist
            $wishListModel->where('user_id', $userId)
                ->where('event_id', $eventId)
                ->delete();
        }
    
        return $this->response->setJSON(['status' => 'success']);
    }    
}
