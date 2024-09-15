<?php

namespace App\Controllers\Organizer;

use App\Controllers\Organizer\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\CategoriesModel;
use App\Models\Admin\StatesModel;
use App\Models\Admin\CitiesModel;
use App\Models\Admin\EventsModel;
use App\Models\Admin\AgendasModel;
use App\Models\Admin\SpeakersModel;
use App\Models\Admin\SponsorsModel;
use App\Models\Admin\FaqsModel;

class EditEventController extends SessionController
{
    public function index($id)
    {
        $categoriesModel = new CategoriesModel();
        $stateModel = new StatesModel();
        $eventsModel = new EventsModel();
        $agendasModel = new AgendasModel();
        $speakersModel = new SpeakersModel();
        $sponsorsModel = new SponsorsModel();
        $faqsModel = new FaqsModel();
        $categoryList = $categoriesModel->findAll();
        $stateList = $stateModel->findAll();
        $agendasList = $agendasModel->where('event_id', $id)->findAll();
        $speakersList = $speakersModel->where('event_id', $id)->findAll();
        $sponsorsList = $sponsorsModel->where('event_id', $id)->findAll();
        $faqsList = $faqsModel->where('event_id', $id)->findAll();
        $eventDetails = $eventsModel
        ->join('states', 'states.state_id=events.state_id', 'left')
        ->join('cities', 'cities.city_id=events.city_id', 'left')
        ->join('users', 'users.user_id=events.user_id', 'left')
        ->join('categories', 'categories.category_id=events.category_id', 'left')
        ->where('events.event_id', $id)
        ->first();
        $data = [
            'title' => 'City Agenda | Edit Event',
            'currentpage' => 'eventmasterlist',
            'categoryList' => $categoryList,
            'stateList' => $stateList,
            'eventDetails' => $eventDetails,
            'agendasList' => $agendasList,
            'speakersList' => $speakersList,
            'sponsorsList' => $sponsorsList,
            'faqsList' => $faqsList,
        ];
        return view('pages/organizer/editevent', $data);
    }
    public function getCities()
    {
        if ($this->request->isAJAX()) {
            // Get the state_id from the AJAX request
            $stateId = $this->request->getPost('state_id');

            // Load the City model
            $cityModel = new CitiesModel();

            // Retrieve cities based on the state_id
            $cities = $cityModel->where('state_id', $stateId)->findAll();

            // Prepare the response array
            $data = [];
            foreach ($cities as $city) {
                $data[] = [
                    'city_id' => $city['city_id'], // Adjust the column names to match your database schema
                    'cityname' => $city['cityname'], // Adjust the column names to match your database schema
                ];
            }

            // Return the response in JSON format
            return $this->response->setJSON($data);
        }

        // If not an AJAX request, you can return a 404 or redirect
        return redirect()->to('/');
    }
    public function update()
    {
        $eventModel = new EventsModel();
        $agendasModel = new AgendasModel();
        $speakersModel = new SpeakersModel();
        $sponsorsModel = new SponsorsModel();
        $faqsModel = new FaqsModel();
        $event_id = $this->request->getPost('event_id');
        $eventDetails = $eventModel->find($event_id);
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
            'user_id' => session()->get('organizer_user_id'),
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
        if ($eventBannerFile && $eventBannerFile->isValid() && !$eventBannerFile->hasMoved()) {
            $newBannerName = $eventBannerFile->getRandomName();
        
            // Check if there is an existing banner file to remove
            if (!empty($eventDetails['eventbanner']) && file_exists(FCPATH . $eventDetails['eventbanner'])) {
                unlink(FCPATH . $eventDetails['eventbanner']);
            }
        
            // Move the new banner file and update event data
            $eventBannerFile->move(FCPATH . 'uploads/event_banners', $newBannerName);
            $eventData['eventbanner'] = 'uploads/event_banners/' . $newBannerName;
        }
    
        // Handle event_image file upload
        $eventImageFile = $this->request->getFile('event_image');
        if ($eventImageFile && $eventImageFile->isValid() && !$eventImageFile->hasMoved()) {
            $newImageName = $eventImageFile->getRandomName();
        
            // Check if there is an existing image file to remove
            if (!empty($eventDetails['event_image']) && file_exists(FCPATH . $eventDetails['event_image'])) {
                unlink(FCPATH . $eventDetails['event_image']);
            }
        
            // Move the new image file and update event data
            $eventImageFile->move(FCPATH . 'uploads/event_images', $newImageName);
            $eventData['event_image'] = 'uploads/event_images/' . $newImageName;
        }
        
        // Handle event_video file upload
        $eventVideoFile = $this->request->getFile('event_video');
        if ($eventVideoFile && $eventVideoFile->isValid() && !$eventVideoFile->hasMoved()) {
            $newVideoName = $eventVideoFile->getRandomName();
        
            // Check if there is an existing video file to remove
            if (!empty($eventDetails['event_video']) && file_exists(FCPATH . $eventDetails['event_video'])) {
                unlink(FCPATH . $eventDetails['event_video']);
            }
        
            // Move the new video file and update event data
            $eventVideoFile->move(FCPATH . 'uploads/event_videos', $newVideoName);
            $eventData['event_video'] = 'uploads/event_videos/' . $newVideoName;
        }
    
        // Insert event data into the database
        $eventModel->update($event_id, $eventData);
        $this->dynamicRoutes();

        $slotTitles = $this->request->getPost('slotTitle');
        $slotDescriptions = $this->request->getPost('slotDescription');
        $slotStartTimes = $this->request->getPost('slotStartTime');
        $slotEndTimes = $this->request->getPost('slotEndTime');

        if ($slotTitles && is_array($slotTitles)) {
            $agendasModel->where('event_id', $event_id)->delete();
            foreach ($slotTitles as $index => $title) {
                // Check if any of the fields are empty
                if (empty($title) || empty($slotDescriptions[$index]) || empty($slotStartTimes[$index]) || empty($slotEndTimes[$index])) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'All fields (Title, Description, Start Time, End Time) are required for each agenda slot.',
                        'errorCode' => 'MISSING_FIELD',
                    ]);
                }
        
                // If all fields are filled, proceed with the insertion
                $agendasModel->insert([
                    'event_id' => $event_id,
                    'agenda_title' => $title,
                    'agenda_description' => $slotDescriptions[$index] ?? '',
                    'agenda_start_time' => $slotStartTimes[$index] ?? '',
                    'agenda_end_time' => $slotEndTimes[$index] ?? ''
                ]);
            }
        }

        // Insert Speakers
        $speakerNames = $this->request->getPost('speakerName');
        $speakerJobs = $this->request->getPost('speakerJob');
        $speakerImages = $this->request->getFileMultiple('speakerImage');
        $facebookLinks = $this->request->getPost('facebookLink');
        $instagramLinks = $this->request->getPost('instagramLink');
        $youtubeLinks = $this->request->getPost('youtubeLink');
        $twitterLinks = $this->request->getPost('twitterLink');
        
        // Ensure all the required arrays are available and have the same count
        if ($speakerNames && is_array($speakerNames) && count($speakerNames) === count($speakerJobs)) {
            $speakersModel->where('event_id', $event_id)->delete();
            foreach ($speakerNames as $index => $name) {
                // Ensure that the index exists in both arrays before accessing them
                if (empty($name) || empty($speakerJobs[$index])) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Speaker name and job are required.',
                        'errorCode' => 'MISSING_FIELD',
                    ]);
                }
        
                // Validate and handle speaker image upload
                $newSpeakerImageName = '';
                if (isset($speakerImages[$index]) && $speakerImages[$index]->isValid()) {
                    $newSpeakerImageName = $speakerImages[$index]->getRandomName();
                    if (!$speakerImages[$index]->move(FCPATH . 'uploads/speaker_images', $newSpeakerImageName)) {
                        return $this->response->setJSON([
                            'success' => false,
                            'message' => 'Failed to move speaker image: ' . $speakerImages[$index]->getErrorString(),
                            'errorCode' => 'FILE_MOVE_ERROR',
                        ]);
                    }
                } elseif (empty($newSpeakerImageName) && !empty($name)) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Speaker image is required for ' . $name,
                        'errorCode' => 'MISSING_IMAGE',
                    ]);
                }
        
                // Prepare data for insertion
                $speakerData = [
                    'event_id' => $event_id,
                    'name' => $name,
                    'job' => $speakerJobs[$index],
                    'image' => $newSpeakerImageName ? 'uploads/speaker_images/' . $newSpeakerImageName : '',
                    'facebook_link' => $facebookLinks[$index] ?? '',
                    'instagram_link' => $instagramLinks[$index] ?? '',
                    'youtube_link' => $youtubeLinks[$index] ?? '',
                    'twitter_link' => $twitterLinks[$index] ?? ''
                ];
        
                // Insert speaker data
                if (!$speakersModel->insert($speakerData)) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Failed to insert speaker: ' . implode(', ', $speakersModel->errors()),
                        'errorCode' => 'INSERT_ERROR',
                    ]);
                }
            }
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Speaker names and jobs must be provided, and the number of names and jobs must match.',
                'errorCode' => 'MISMATCHED_DATA',
            ]);
        }                
        
        // Insert Sponsors
        $sponsorDescriptions = $this->request->getPost('sponsorDescription');
        $sponsorLogos = $this->request->getFileMultiple('sponsorLogo');
        if ($sponsorDescriptions && is_array($sponsorDescriptions)) {
            $sponsorsModel->where('event_id', $event_id)->delete();
            foreach ($sponsorDescriptions as $index => $description) {
                // Check if description is provided and not empty
                if (empty($description)) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Sponsor description is required.',
                        'errorCode' => 'MISSING_DESCRIPTION',
                    ]);
                }
        
                $newSponsorLogoName = '';
                if (isset($sponsorLogos[$index]) && $sponsorLogos[$index]->isValid()) {
                    $newSponsorLogoName = $sponsorLogos[$index]->getRandomName();
                    if (!$sponsorLogos[$index]->move(FCPATH . 'uploads/sponsor_logos', $newSponsorLogoName)) {
                        // Handle file move error
                        return $this->response->setJSON([
                            'success' => false,
                            'message' => 'Failed to move sponsor logo: ' . $sponsorLogos[$index]->getErrorString(),
                            'errorCode' => 'FILE_MOVE_ERROR',
                        ]);
                    }
                } elseif (empty($newSponsorLogoName)) {
                    // If a logo is required but not uploaded, return an error
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Sponsor logo is required.',
                        'errorCode' => 'MISSING_LOGO',
                    ]);
                }
        
                // Proceed with insertion if all required fields are valid
                if (!$sponsorsModel->insert([
                    'event_id' => $event_id,
                    'sponsor_description' => $description,
                    'sponsor_logo' => $newSponsorLogoName ? 'uploads/sponsor_logos/' . $newSponsorLogoName : ''
                ])) {
                    // Handle insert error
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Failed to insert sponsor: ' . implode(', ', $sponsorsModel->errors()),
                        'errorCode' => 'INSERT_ERROR',
                    ]);
                }
            }
        }

        // Insert FAQs
        $questions = $this->request->getPost('question');
        $answers = $this->request->getPost('answer');

        if ($questions && is_array($questions)) {
            $faqsModel->where('event_id', $event_id)->delete();
            foreach ($questions as $index => $question) {
                // Check if the question is provided and not empty
                if (empty($question)) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Question is required.',
                        'errorCode' => 'MISSING_QUESTION',
                    ]);
                }
        
                // Check if the answer is provided and not empty
                if (empty($answers[$index])) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Answer is required.',
                        'errorCode' => 'MISSING_ANSWER',
                    ]);
                }
        
                // Proceed with insertion if all required fields are valid
                if (!$faqsModel->insert([
                    'event_id' => $event_id,
                    'question' => $question,
                    'answer' => $answers[$index],
                ])) {
                    // Handle insert error
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Failed to insert FAQ: ' . implode(', ', $faqsModel->errors()),
                        'errorCode' => 'INSERT_ERROR',
                    ]);
                }
            }
        }
        // Prepare and return the response
        $response = [
            'success' => true,
            'message' => 'Event successfully updated',
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
