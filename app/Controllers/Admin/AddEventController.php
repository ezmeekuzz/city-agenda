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

class AddEventController extends SessionController
{
    public function index()
    {
        $categoriesModel = new CategoriesModel();
        $stateModel = new StatesModel();
        $categoryList = $categoriesModel->findAll();
        $stateList = $stateModel->findAll();
        $data = [
            'title' => 'City Agenda | Add Event',
            'currentpage' => 'addevent',
            'categoryList' => $categoryList,
            'stateList' => $stateList,
        ];
        return view('pages/admin/addevent', $data);
    }
    public function getCities()
    {
        $cityModel = new CitiesModel();
        $state_id = $this->request->getPost('state_id');
        $cities = $cityModel->where('state_id', $state_id)->findAll();

        return $this->response->setJSON($cities);
    }
    public function insert()
    {
        $eventModel = new EventsModel();
        $agendasModel = new AgendasModel();
        $speakersModel = new SpeakersModel();
        $sponsorsModel = new SponsorsModel();
        $faqsModel = new FaqsModel();

        $eventBannerFile = $this->request->getFile('eventbanner');
        if (!$eventBannerFile || !$eventBannerFile->isValid()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Event banner is required.',
                'errorCode' => 'MISSING_FILE',
            ]);
        }
        $requiredFields = [
            'category_id', 'eventname', 'shortdescription', 'eventtype',
            'eventdate', 'eventstartingtime', 'eventendingtime', 
            'locationname', 'state_id', 'city_id', 'eventdescription'
        ];
    
        // Check for missing required fields
        foreach ($requiredFields as $field) {
            if (empty($this->request->getPost($field))) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => ucfirst(str_replace('_', ' ', $field)) . ' is required.',
                    'errorCode' => 'MISSING_FIELD',
                ]);
            }
        }
        // Initialize the event data array
        $eventData = [
            'user_id' => session()->get('user_id'),
            'publishstatus' => ($this->request->getPost('publishstatus') == 'Yes') ? 'Yes' : 'No',
            'category_id' => $this->request->getPost('category_id'),
            'eventname' => $this->request->getPost('eventname'),
            'slug' => strtolower(str_replace(
                [" ", "&", "!", ",", "?", ":", ";", "/", "'", "(", ")"], 
                ["-", "and", "", "", "", "", "", "-", "", ""], 
                htmlentities($this->request->getPost('eventname'), ENT_QUOTES, 'UTF-8')
            )),
            'shortdescription' => $this->request->getPost('shortdescription'),
            'eventtype' => $this->request->getPost('eventtype'),
            'eventdate' => $this->request->getPost('eventdate'),
            'eventstartingtime' => $this->request->getPost('eventstartingtime'),
            'eventendingtime' => $this->request->getPost('eventendingtime'),
            'recurrence' => $this->request->getPost('recurrence'),
            'locationname' => $this->request->getPost('locationname'),
            'state_id' => $this->request->getPost('state_id'),
            'city_id' => $this->request->getPost('city_id'),
            'eventdescription' => $this->request->getPost('eventdescription'),
        ];
    
        // Handle eventbanner file upload
        $eventBannerFile = $this->request->getFile('eventbanner');
        if ($eventBannerFile && $eventBannerFile->isValid()) {
            $newBannerName = $eventBannerFile->getRandomName();
            $eventBannerFile->move(FCPATH . 'uploads/event_banners', $newBannerName);
            $eventData['eventbanner'] = 'uploads/event_banners/' . $newBannerName;
        }
    
        // Handle event_image file upload
        $eventImageFile = $this->request->getFile('event_image');
        if ($eventImageFile && $eventImageFile->isValid()) {
            $newImageName = $eventImageFile->getRandomName();
            $eventImageFile->move(FCPATH . 'uploads/event_images', $newImageName);
            $eventData['event_image'] = 'uploads/event_images/' . $newImageName;
        }
    
        // Handle event_video file upload
        $eventVideoFile = $this->request->getFile('event_video');
        if ($eventVideoFile && $eventVideoFile->isValid()) {
            $newVideoName = $eventVideoFile->getRandomName();
            $eventVideoFile->move(FCPATH . 'uploads/event_videos', $newVideoName);
            $eventData['event_video'] = 'uploads/event_videos/' . $newVideoName;
        }
    
        // Insert event data into the database
        $eventId = $eventModel->insert($eventData);
        $this->dynamicRoutes();

        $slotTitles = $this->request->getPost('slotTitle');
        if ($slotTitles && is_array($slotTitles)) {
            foreach ($slotTitles as $index => $title) {
                if (!empty($title)) {
                    $agendasModel->insert([
                        'event_id' => $eventId,
                        'agenda_title' => $title,
                        'agenda_description' => $this->request->getPost('slotDescription')[$index] ?? '',
                        'agenda_start_time' => $this->request->getPost('slotStartTime')[$index] ?? '',
                        'agenda_end_time' => $this->request->getPost('slotEndTime')[$index] ?? ''
                    ]);
                }
            }
        }

        // Insert Speakers
        $speakerNames = $this->request->getPost('speakerName');
        if ($speakerNames && is_array($speakerNames)) {
            foreach ($speakerNames as $index => $name) {
                if (!empty($name)) {
                    $newSpeakerImageName = '';
                    $speakerImageFile = $this->request->getFileMultiple('speakerImage')[$index] ?? null;
                    if ($speakerImageFile && $speakerImageFile->isValid()) {
                        $newSpeakerImageName = $speakerImageFile->getRandomName();
                        $speakerImageFile->move(FCPATH . 'uploads/speaker_images', $newSpeakerImageName);
                    }
    
                    $speakersModel->insert([
                        'event_id' => $eventId,
                        'name' => $name,
                        'job' => $this->request->getPost('speakerJob')[$index] ?? '',
                        'image' => $newSpeakerImageName ? 'uploads/speaker_images/' . $newSpeakerImageName : '',
                        'facebook_link' => $this->request->getPost('facebookLink')[$index] ?? '',
                        'instagram_link' => $this->request->getPost('instagramLink')[$index] ?? '',
                        'youtube_link' => $this->request->getPost('youtubeLink')[$index] ?? '',
                        'twitter_link' => $this->request->getPost('twitterLink')[$index] ?? ''
                    ]);
                }
            }
        }               
        
        // Insert Sponsors
        $sponsorDescriptions = $this->request->getPost('sponsorDescription');
        if ($sponsorDescriptions && is_array($sponsorDescriptions)) {
            foreach ($sponsorDescriptions as $index => $description) {
                if (!empty($description)) {
                    $newSponsorLogoName = '';
                    $sponsorLogoFile = $this->request->getFileMultiple('sponsorLogo')[$index] ?? null;
                    if ($sponsorLogoFile && $sponsorLogoFile->isValid()) {
                        $newSponsorLogoName = $sponsorLogoFile->getRandomName();
                        $sponsorLogoFile->move(FCPATH . 'uploads/sponsor_logos', $newSponsorLogoName);
                    }
    
                    $sponsorsModel->insert([
                        'event_id' => $eventId,
                        'sponsor_description' => $description,
                        'sponsor_logo' => $newSponsorLogoName ? 'uploads/sponsor_logos/' . $newSponsorLogoName : ''
                    ]);
                }
            }
        }

        // Insert FAQs
        $questions = $this->request->getPost('question');
        if ($questions && is_array($questions)) {
            foreach ($questions as $index => $question) {
                if (!empty($question)) {
                    $faqsModel->insert([
                        'event_id' => $eventId,
                        'question' => $question,
                        'answer' => $this->request->getPost('answer')[$index] ?? ''
                    ]);
                }
            }
        }
        // Prepare and return the response
        $response = [
            'success' => true,
            'message' => 'Event successfully added',
            'redirect' => '/admin/add-ticketing/' . $eventId
        ];
    
        return $this->response->setJSON($response);
    } 
    
    private function dynamicRoutes() {
        $model = new EventsModel();
        $result = $model->findAll();
        $data = [];
    
        if (count($result)) {
            foreach ($result as $route) {
                $data[$route['slug']] = 'EventDetailController::index/' . $route['event_id'];
            }
        }
    
        $output = '<?php' . PHP_EOL;
        foreach ($data as $slug => $controllerMethod) {
            $output .= '$routes->get(\'' . $slug . '\', \'' . $controllerMethod . '\');' . PHP_EOL;
        }
    
        $filePath = ROOTPATH . 'app/Config/EventsRoutes.php';
    
        file_put_contents($filePath, $output);
    }     
}
