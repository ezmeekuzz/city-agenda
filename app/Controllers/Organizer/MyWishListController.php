<?php

namespace App\Controllers\Organizer;

use App\Controllers\Organizer\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\WishListModel;

class MyWishListController extends SessionController
{
    public function index()
    {
        $data = [
            'title' => 'City Agenda | My Wish List',
            'currentpage' => 'mywishlist'
        ];
        return view('pages/organizer/mywishlist', $data);
    }
    public function getData()
    {
        return datatables('wishlists')
            ->join('events', 'wishlists.event_id=events.event_id', 'left')
            ->join('states', 'states.state_id=events.state_id', 'left')
            ->join('cities', 'cities.city_id=events.city_id', 'left')
            ->where('wishlists.user_id', session()->get('organizer_user_id'))
            ->where('events.publishstatus', 'Yes')
            ->make();
    }
    public function delete($id)
    {
        $wishlistModel = new WishListModel(); 

        $deleted = $wishlistModel->delete($id);
    
        if ($deleted) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete the wish list from the database']);
        }
    }
}
