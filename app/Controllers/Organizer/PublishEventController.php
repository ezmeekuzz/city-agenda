<?php

namespace App\Controllers\Organizer;

use App\Controllers\Organizer\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\EventsModel;

class PublishEventController extends SessionController
{
    public function index($id)
    {
        $eventsModel = new EventsModel();

        $eventDetails = $eventsModel
        ->join('states', 'states.state_id=events.state_id', 'left')
        ->join('cities', 'cities.city_id=events.city_id', 'left')
        ->join('tickets', 'tickets.event_id=events.event_id', 'left')
        ->find($id);

        $data = [
            'title' => 'City Agenda | Publish Event',
            'currentpage' => 'eventmasterlist',
            'eventDetails' => $eventDetails
        ];
        return view('pages/organizer/publishevent', $data);
    }
    public function update()
    {
        $eventsModel = new EventsModel();

        $eventId = $this->request->getPost('event_id');

        $data = [
            'publishsetting' => $this->request->getPost('event_visibility'),
            'refundpolicy' => $this->request->getPost('refund_policy'),
            'publishstatus' => 'Yes'
        ];

        $update = $eventsModel->update($eventId, $data);

        if($update) {
            $response = [
                'success' => true,
                'message' => 'Your event was successfully published',
            ];
        }
        else {
            $response = [
                'success' => false,
                'message' => 'Failed to publish your event',
            ];
        }
        return $this->response->setJSON($response);
    }
}
