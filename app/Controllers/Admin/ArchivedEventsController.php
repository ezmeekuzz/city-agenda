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

class ArchivedEventsController extends SessionController
{
    public function index()
    {
        $data = [
            'title' => 'City Agenda | Events Happening Today',
            'currentpage' => 'archivedevents'
        ];
        return view('pages/admin/archivedevents', $data);
    }
    public function getData()
    {
        return datatables('events')
            ->select('events.*, events.event_id as eid, users.*, events.slug as sl, tickets.*')
            ->join('users', 'users.user_id=events.user_id', 'left')
            ->join('tickets', 'tickets.event_id=events.event_id', 'left')
            ->where('DATE(events.eventdate) <', date('Y-m-d')) // Filter for events with past dates
            ->make();
    }
}
