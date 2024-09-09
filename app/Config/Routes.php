<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/*Administrator*/
$routes->get('/admin', 'Admin\LoginController::index');
$routes->get('/admin/login', 'Admin\LoginController::index');
$routes->get('/admin/dashboard', 'Admin\DashboardController::index');
$routes->post('/admin/login/authenticate', 'Admin\LoginController::authenticate');
$routes->get('/admin/logout', 'Admin\LogoutController::index');
$routes->get('/admin/add-user', 'Admin\AddUserController::index');
$routes->post('/admin/adduser/insert', 'Admin\AddUserController::insert');
$routes->get('/admin/user-masterlist', 'Admin\UserMasterlistController::index');
$routes->get('/admin/usermasterlist/getData', 'Admin\UserMasterlistController::getData');
$routes->delete('/admin/usermasterlist/delete/(:num)', 'Admin\UserMasterlistController::delete/$1');
$routes->get('/admin/edit-user/(:num)', 'Admin\EditUserController::index/$1');
$routes->post('/admin/edituser/update', 'Admin\EditUserController::update');
$routes->get('/admin/add-state', 'Admin\AddStateController::index');
$routes->post('/admin/addstate/insert', 'Admin\AddStateController::insert');
$routes->get('/admin/state-masterlist', 'Admin\StateMasterlistController::index');
$routes->get('/admin/statemasterlist/getData', 'Admin\StateMasterlistController::getData');
$routes->delete('/admin/statemasterlist/delete/(:num)', 'Admin\StateMasterlistController::delete/$1');
$routes->get('/admin/edit-state/(:num)', 'Admin\EditStateController::index/$1');
$routes->post('/admin/editstate/update', 'Admin\EditStateController::update');
$routes->get('/admin/add-city', 'Admin\AddCityController::index');
$routes->post('/admin/addcity/insert', 'Admin\AddCityController::insert');
$routes->get('/admin/city-masterlist', 'Admin\CityMasterlistController::index');
$routes->get('/admin/citymasterlist/getData', 'Admin\CityMasterlistController::getData');
$routes->delete('/admin/citymasterlist/delete/(:num)', 'Admin\CityMasterlistController::delete/$1');
$routes->get('/admin/edit-city/(:num)', 'Admin\EditCityController::index/$1');
$routes->post('/admin/editcity/update', 'Admin\EditCityController::update');
$routes->get('/admin/messages', 'Admin\MessagesController::index');
$routes->get('/admin/messages/getData', 'Admin\MessagesController::getData');
$routes->delete('/admin/messages/delete/(:num)', 'Admin\MessagesController::delete/$1');
$routes->get('/admin/subscribers', 'Admin\SubscribersController::index');
$routes->get('/admin/subscribers/getData', 'Admin\SubscribersController::getData');
$routes->delete('/admin/subscribers/delete/(:num)', 'Admin\SubscribersController::delete/$1');
$routes->get('/admin/add-category', 'Admin\AddCategoryController::index');
$routes->post('/admin/addcategory/insert', 'Admin\AddCategoryController::insert');
$routes->get('/admin/category-masterlist', 'Admin\CategoryMasterlistController::index');
$routes->get('/admin/categorymasterlist/getData', 'Admin\CategoryMasterlistController::getData');
$routes->delete('/admin/categorymasterlist/delete/(:num)', 'Admin\CategoryMasterlistController::delete/$1');
$routes->get('/admin/edit-category/(:num)', 'Admin\EditCategoryController::index/$1');
$routes->post('/admin/editcategory/update', 'Admin\EditCategoryController::update');
$routes->get('/admin/add-blog', 'Admin\AddBlogController::index');
$routes->post('/admin/addblog/insert', 'Admin\AddBlogController::insert');
$routes->get('/admin/blog-masterlist', 'Admin\BlogMasterlistController::index');
$routes->get('/admin/blogmasterlist/getData', 'Admin\BlogMasterlistController::getData');
$routes->delete('/admin/blogmasterlist/delete/(:num)', 'Admin\BlogMasterlistController::delete/$1');
$routes->get('/admin/edit-blog/(:num)', 'Admin\EditBlogController::index/$1');
$routes->post('/admin/editblog/update/(:num)', 'Admin\EditBlogController::update/$1');
$routes->get('/admin/add-event', 'Admin\AddEventController::index');
$routes->post('/admin/addevent/getCities', 'Admin\AddEventController::getCities');
$routes->post('/admin/addevent/insert', 'Admin\AddEventController::insert');
$routes->get('/admin/event-masterlist', 'Admin\EventMasterlistController::index');
$routes->get('/admin/eventmasterlist/getData', 'Admin\EventMasterlistController::getData');
$routes->delete('/admin/eventmasterlist/delete/(:num)', 'Admin\EventMasterlistController::delete/$1');
$routes->get('/admin/edit-event/(:num)', 'Admin\EditEventController::index/$1');
$routes->post('/admin/editevent/getCities', 'Admin\EditEventController::getCities');
$routes->post('/admin/editevent/update', 'Admin\EditEventController::update');
$routes->get('/admin/add-ticketing/(:num)', 'Admin\AddTicketingController::index/$1');
$routes->post('/admin/addticketing/insert', 'Admin\AddTicketingController::insert');
$routes->get('/admin/ticket-masterlist', 'Admin\TicketMasterlistController::index');
$routes->get('/admin/ticketmasterlist/getData', 'Admin\TicketMasterlistController::getData');
$routes->delete('/admin/ticketmasterlist/delete/(:num)', 'Admin\TicketMasterlistController::delete/$1');
$routes->post('/admin/ticketmasterlist/update', 'Admin\TicketMasterlistController::update');
$routes->get('/admin/publish-event/(:num)', 'Admin\PublishEventController::index/$1');
$routes->post('/admin/publishevent/update', 'Admin\PublishEventController::update');
/*Administrator*/
$routes->get('/', 'HomeController::index');
$routes->post('/subscribe', 'SubscribeController::index');
$routes->get('/contact-us', 'ContactUsController::index');
$routes->get('/about-us', 'AboutUsController::index');
$routes->get('/faq', 'FaqController::index');
$routes->get('/login', 'LoginController::index');
$routes->get('/privacy-policy', 'PrivacyPolicyController::index');
$routes->get('/terms-of-use', 'TermsOfUseController::index');
$routes->get('/blogs', 'BlogsController::index');
require APPPATH . 'Config/EventCategoriesRoutes.php';
require APPPATH . 'Config/EventRoutes.php';
require APPPATH . 'Config/BlogRoutes.php';