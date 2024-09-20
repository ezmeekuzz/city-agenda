<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\EventsModel;
use App\Models\Admin\WishListModel;
use App\Models\Admin\CategoriesModel;
use App\Models\Admin\CitiesModel;

class EventsController extends BaseController
{
    public function index()
    {
        $categoriesModel = new CategoriesModel();
        $topCategories = $categoriesModel->where('is_top_category', 'Yes')->findAll();

        $filterType = ($this->request->getGet('category')) ? $this->request->getGet('category') : $this->request->getGet('city');
        $data = [
            'title' => 'City Agenda',
            'topCategories' => $topCategories,
        ];
        if($this->request->getGet('category') && $this->request->getGet('category') != "") {
            $data['category'] = $this->request->getGet('category');
            $categoriesModel = new CategoriesModel();
            $citiesModel = new CitiesModel();
            $categoryDetails = $categoriesModel->where('categoryname', $this->request->getGet('category'))->first();
            $cityList = $citiesModel->findAll();
            $data['categoryDetails'] = $categoryDetails;
            $data['cityList'] = $cityList;
            return view('pages/eventsCategory', $data);
        }
        else if($this->request->getGet('city') && $this->request->getGet('city') != "") {
            $data['city'] = $this->request->getGet('city');
            return view('pages/eventsCity', $data);
        }
        else {
            return view('pages/events', $data);
        }
    }
    public function getEvents()
    {
        $eventsModel = new EventsModel();
        $wishListModel = new WishListModel();
    
        // Retrieve GET parameters
        $date = $this->request->getGet('date');
        $location = $this->request->getGet('location');
        $category = $this->request->getGet('category');
        $ticket = $this->request->getGet('ticket');
    
        // Get user session
        $userId = session()->get('organizer_user_id') ?? session()->get('member_user_id');
    
        // Query for events
        $eventListQuery = $eventsModel
        ->select('events.*, users.*, states.*, cities.*, tickets.*, events.slug as sl')
        ->join('tickets', 'events.event_id=tickets.event_id')
        ->join('users', 'events.user_id=users.user_id')
        ->join('cities', 'events.city_id=cities.city_id')
        ->join('states', 'events.state_id=states.state_id')
        ->join('categories', 'events.category_id=categories.category_id')
        ->where('events.publishsetting', 'Public')
        ->where('events.publishstatus', 'Yes');
    
        // Add filters
        if (!empty($location)) {
            $eventListQuery->where('cities.cityname', $location);
        }
    
        if (!empty($date)) {
            $eventListQuery->where('events.eventdate', $date);
        }

        if (!empty($category)) {
            $eventListQuery->where('categories.categoryname', $category);
        }

        if (!empty($ticket)) {
            $eventListQuery->where('tickets.tickettype', 'Free');
        }
    
        // Execute the query
        $eventList = $eventListQuery->findAll();
    
        // Add favorite status if user is logged in
        if ($userId) {
            foreach ($eventList as &$event) {
                $isFavorited = $wishListModel
                    ->where('user_id', $userId)
                    ->where('event_id', $event['event_id'])
                    ->countAllResults() > 0;
    
                $event['is_favorited'] = $isFavorited;
            }
        }
    
        // Return the event list as JSON response
        if (!empty($eventList)) {
            return $this->response->setJSON(['status' => 'success', 'data' => $eventList]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No events found']);
        }
    }
}
