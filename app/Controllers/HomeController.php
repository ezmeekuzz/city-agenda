<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\CategoriesModel;
use App\Models\Admin\EventsModel;
use App\Models\Admin\CitiesModel;
use App\Models\Admin\WishListModel;

class HomeController extends BaseController
{
    public function index()
    {
        $categoriesModel = new CategoriesModel();
        $citiesModel = new CitiesModel();

        $topCategories = $categoriesModel->where('is_top_category', 'Yes')->findAll();
        $categoryList = $categoriesModel->findAll();
        $cityList = $citiesModel->findAll();
        $data = [
            'title' => 'City Agenda',
            'topCategories' => $topCategories,
            'categoryList' => $categoryList,
            'cityList' => $cityList,
        ];
        return view('pages/home', $data);
    }
    public function getEvents()
    {
        $eventsModel = new EventsModel();
        $wishListModel = new WishListModel(); // Load the wishlist model
        
        // Get filter parameters from AJAX request
        $category = $this->request->getGet('category');
        $location = $this->request->getGet('location');
        $date = $this->request->getGet('date');  // Get the selected date
        
        // Get the logged-in user's ID
        $userId = session()->get('organizer_user_id') ?? session()->get('member_user_id');
        
        // Start query with joins
        $eventListQuery = $eventsModel
            ->select('events.*, users.*, states.*, cities.*, events.slug as sl')
            ->join('users', 'events.user_id=users.user_id')
            ->join('cities', 'events.city_id=cities.city_id')
            ->join('states', 'events.state_id=states.state_id')
            ->join('categories', 'events.category_id=categories.category_id')
            ->where('events.publishsetting', 'Public')
            ->where('events.publishstatus', 'Yes');
        
        // Apply category filter if provided
        if (!empty($category)) {
            $eventListQuery->where('categories.categoryname', $category);
        }
        
        // Apply location filter if provided (assuming it's based on city name)
        if (!empty($location)) {
            $eventListQuery->where('cities.cityname', $location);
        }
        
        // Apply date filter if provided (assuming 'eventdate' is the date column in the events table)
        if (!empty($date)) {
            $eventListQuery->where('events.eventdate', $date);
        }
        
        // Execute the query and get the results
        $eventList = $eventListQuery->findAll();
        
        // Check which events are in the user's wishlist
        if ($userId) {
            foreach ($eventList as &$event) {
                // Check if the event is in the wishlist
                $isFavorited = $wishListModel
                    ->where('user_id', $userId)
                    ->where('event_id', $event['event_id'])
                    ->countAllResults() > 0;
                
                // Add the wishlist status to the event data
                $event['is_favorited'] = $isFavorited;
            }
        }
        
        // Return the results as JSON response
        return $this->response->setJSON($eventList);
    }    
}
