<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\CategoriesModel;
use App\Models\Admin\EventsModel;
use App\Models\Admin\CitiesModel;

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
    
        // Get filter parameters from AJAX request
        $category = $this->request->getGet('category'); // Assuming category is passed as a category name
        $location = $this->request->getGet('location'); // Assuming location is passed as a city name
    
        // Start query with joins
        $eventListQuery = $eventsModel
            ->select('events.*, users.*, states.*, cities.*, events.slug as sl')
            ->join('users', 'events.user_id=users.user_id')
            ->join('cities', 'events.city_id=cities.city_id')
            ->join('states', 'events.state_id=states.state_id')
            ->join('categories', 'events.category_id=categories.category_id')
            ->where('events.publishstatus', 'Yes');
    
        // Apply category filter if provided
        if (!empty($category)) {
            $eventListQuery->where('categories.categoryname', $category);
        }
    
        // Apply location filter if provided (assuming it's based on city name)
        if (!empty($location)) {
            $eventListQuery->where('cities.cityname', $location);
        }
    
        // Execute the query and get the results
        $eventList = $eventListQuery->findAll();
    
        // Return the results as JSON response
        return $this->response->setJSON($eventList);
    }
}
