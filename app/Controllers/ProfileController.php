<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\UsersModel;
use App\Models\Admin\EventsModel;
use App\Models\Admin\WishListModel;

class ProfileController extends BaseController
{
    public function index($id)
    {
        $usersModel = new UsersModel();
        $eventsModel = new EventsModel();

        $userDetails = $usersModel->find($id);
        $coverPhoto = !empty($userDetails['coverphoto']) ? '/' . $userDetails['coverphoto'] : 'https://via.placeholder.com/400';
        $image = !empty($userDetails['image']) ? '/' . $userDetails['image'] : 'https://via.placeholder.com/150';
        $condID = (session()->get('organizer_user_id') == $userDetails['user_id']) ? 'edit' : 'no';
        $userID = (session()->get('organizer_user_id') == $userDetails['user_id']) ? session()->get('organizer_user_id') : $id;
        $pastEventsCount = $eventsModel
        ->where('eventdate <', date('Y-m-d'))
        ->where('publishstatus', 'Yes')
        ->where('user_id', $userID)
        ->countAllResults();
        $upcomingEventsCount = $eventsModel
        ->where('eventdate >', date('Y-m-d'))
        ->where('publishstatus', 'Yes')
        ->where('user_id', $userID)
        ->countAllResults();
        $data = [
            'title' => 'City Agenda',
            'userDetails' => $userDetails,
            'coverPhoto' => $coverPhoto,
            'image' => $image,
            'condID' => $condID,
            'pastEventsCount' => $pastEventsCount,
            'upcomingEventsCount' => $upcomingEventsCount,
            'userID' => $userID
        ];
        return view('pages/profile', $data);
    }
    public function getEvents()
    {
        $eventsModel = new EventsModel();
        $wishListModel = new WishListModel(); // Load the wishlist model
        
        // Get the logged-in user's ID
        $userId = $this->request->getGet('userId');
        
        // Get the filter parameter from the request (defaults to 'past')
        $filter = $this->request->getGet('filter') ?? 'past';
        
        // Get the page parameter from the request (defaults to 1 if not provided)
        $page = $this->request->getGet('page') ?? 1;
    
        // Define the number of events per page
        $eventsPerPage = 10; // You can adjust this value as needed
    
        // Calculate the offset (i.e., how many events to skip)
        $offset = ($page - 1) * $eventsPerPage;
    
        // Start query with joins
        $eventListQuery = $eventsModel
            ->select('events.*, users.*, events.slug as sl')
            ->join('users', 'events.user_id = users.user_id')
            ->join('categories', 'events.category_id = categories.category_id')
            ->where('events.publishsetting', 'Public')
            ->where('events.publishstatus', 'Yes')
            ->where('events.user_id', $userId);
    
        // Apply filter for past or upcoming events
        $currentDate = date('Y-m-d');
        if ($filter === 'past') {
            // Past events (event date is less than the current date)
            $eventListQuery->where('events.eventdate <', $currentDate);
        } else {
            // Upcoming events (event date is greater than or equal to the current date)
            $eventListQuery->where('events.eventdate >=', $currentDate);
        }
    
        // Apply pagination (limit and offset)
        $eventList = $eventListQuery
            ->limit($eventsPerPage, $offset)  // Fetch a limited number of events based on the page
            ->findAll();
    
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
    
        // Return the results as a JSON response
        return $this->response->setJSON($eventList);
    }     
    public function updateCoverPhoto()
    {

        $usersModel = new UsersModel();

        $userId = $this->request->getPost('user_id');
        $coverPhoto = $this->request->getFile('cover_photo');

        // Get the user's current cover photo from the database
        $user = $usersModel->find($userId);
        $oldCoverPhoto = $user['coverphoto'];

        // Validate the uploaded file
        if ($coverPhoto && $coverPhoto->isValid() && !$coverPhoto->hasMoved()) {
            $fileName = $coverPhoto->getRandomName();
            $coverPhoto->move(FCPATH . 'uploads/cover-photo', $fileName); // Move to your upload directory

            // Remove the old cover photo if it exists
            if ($oldCoverPhoto && file_exists(FCPATH . 'uploads/cover-photo/' . $oldCoverPhoto)) {
                unlink(FCPATH . 'uploads/cover-photo/' . $oldCoverPhoto);
            }

            // Update the user's cover photo path in the database
            $usersModel->update($userId, ['coverphoto' => 'uploads/cover-photo/' . $fileName]);

            return $this->response->setJSON(['success' => true, 'new_cover_photo' => $fileName]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Invalid cover photo upload.']);
    }
    public function updateProfilePicture()
    {

        $usersModel = new UsersModel();

        $userId = $this->request->getPost('user_id');
        $profilePicture = $this->request->getFile('profile_picture');

        // Get the user's current profile picture from the database
        $user = $usersModel->find($userId);
        $oldProfilePicture = $user['image'];

        // Validate the uploaded file
        if ($profilePicture && $profilePicture->isValid() && !$profilePicture->hasMoved()) {
            $fileName = $profilePicture->getRandomName();
            $profilePicture->move(FCPATH . 'uploads/profile-image', $fileName); // Move to your upload directory

            // Remove the old profile picture if it exists
            if ($oldProfilePicture && file_exists(FCPATH . 'uploads/profile-image/' . $oldProfilePicture)) {
                unlink(FCPATH . 'uploads/profile-image/' . $oldProfilePicture);
            }

            // Update the user's profile picture path in the database
            $usersModel->update($userId, ['image' => 'uploads/profile-image/' . $fileName]);

            return $this->response->setJSON(['success' => true, 'new_profile_picture' => $fileName]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Invalid profile picture upload.']);
    }
    public function updateAbout()
    {
        // Ensure the request is an AJAX request
        if ($this->request->isAJAX()) {
            // Load the User model
            $userModel = new UsersModel();

            // Get the JSON payload from the AJAX request
            $data = $this->request->getJSON();

            // Get the user ID and new 'about yourself' content from the request
            $userId = $data->user_id;
            $aboutYourself = $data->aboutyourself;

            // Update the 'about yourself' section in the database
            if ($userModel->update($userId, ['aboutyourself' => $aboutYourself])) {
                // Send a success response
                return $this->response->setJSON(['success' => true, 'message' => 'About section updated successfully.']);
            } else {
                // Send a failure response if the update fails
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to update about section.']);
            }
        }

        // If the request is not AJAX, return a 404 error
        return $this->response->setStatusCode(404, 'Not Found');
    }
    public function updateFullName()
    {
        // Ensure the request is an AJAX request
        if ($this->request->isAJAX()) {
            // Load the User model
            $userModel = new UsersModel();

            // Get the JSON payload from the AJAX request
            $data = $this->request->getJSON();

            // Get the user ID and new 'about yourself' content from the request
            $userId = $data->user_id;
            $firstName = $data->firstName;
            $lastName = $data->lastName;

            // Update the 'about yourself' section in the database
            if ($userModel->update($userId, ['firstname' => $firstName, 'lastname' => $lastName])) {
                // Send a success response
                return $this->response->setJSON(['success' => true, 'message' => 'Full Name section updated successfully.']);
            } else {
                // Send a failure response if the update fails
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to update full name section.']);
            }
        }

        // If the request is not AJAX, return a 404 error
        return $this->response->setStatusCode(404, 'Not Found');
    }
}
