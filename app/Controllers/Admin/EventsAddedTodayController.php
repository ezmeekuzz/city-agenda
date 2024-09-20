<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\CategoriesModel;
use App\Models\Admin\StatesModel;
use App\Models\Admin\CitiesModel;
use App\Models\Admin\EventsModel;
use App\Models\Admin\AgendasModel;
use App\Models\Admin\SpeakersModel;
use App\Models\Admin\SponsorsModel;
use App\Models\Admin\FaqsModel;
use App\Models\Admin\TicketsModel;

class EventsAddedTodayController extends SessionController
{
    public function index()
    {
        $data = [
            'title' => 'City Agenda | Events Added Today',
            'currentpage' => 'eventsaddedtoday'
        ];
        return view('pages/admin/eventsaddedtoday', $data);
    }
    public function getData()
    {
        return datatables('events')
            ->join('states', 'states.state_id=events.state_id', 'left')
            ->join('cities', 'cities.city_id=events.city_id', 'left')
            ->join('users', 'users.user_id=events.user_id', 'left')
            ->join('categories', 'categories.category_id=events.category_id', 'left')
            ->where('DATE(events.dateadded)', date('Y-m-d'))
            ->make();
    }
}
