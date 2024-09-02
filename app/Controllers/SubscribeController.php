<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SubscribersModel;
use CodeIgniter\HTTP\ResponseInterface;

class SubscribeController extends BaseController
{
    protected $subscribersModel;
    protected $email;

    public function __construct()
    {
        $this->subscribersModel = new SubscribersModel();
        $this->email = \Config\Services::email(); // Load the email service with the configured settings
    }

    public function index(): ResponseInterface
    {
        $emailaddress = $this->request->getPost('emailaddress');

        // Validate the email address
        if (!filter_var($emailaddress, FILTER_VALIDATE_EMAIL)) {
            return $this->response
                        ->setStatusCode(400)
                        ->setJSON(['message' => 'Invalid email address']);
        }

        // Check if the email already exists
        if ($this->subscribersModel->where('emailaddress', $emailaddress)->first()) {
            return $this->response
                        ->setStatusCode(409)
                        ->setJSON(['message' => 'Email already subscribed']);
        }

        // Prepare data for insertion
        $data = [
            'emailaddress' => $emailaddress,
            'subscription_date' => date('Y-m-d')
        ];

        // Insert data into the database
        if ($this->subscribersModel->insert($data)) {
            // Send a thank you email
            $this->sendThankYouEmail($emailaddress);

            return $this->response
                        ->setStatusCode(200)
                        ->setJSON(['message' => 'Subscription successful']);
        }

        // Fallback for any other errors
        return $this->response
                    ->setStatusCode(500)
                    ->setJSON(['message' => 'Failed to subscribe. Please try again later.']);
    }

    private function sendThankYouEmail(string $emailaddress): void
    {
        $subject = 'Thank You for Subscribing to Our Newsletter!';
        $message = '
            <html>
            <head>
                <title>Thank You for Subscribing!</title>
            </head>
            <body>
                <h2>Welcome to Our Community!</h2>
                <p>Dear Subscriber,</p>
                <p>Thank you for subscribing to our newsletter. We are thrilled to have you with us.</p>
                <p>As a subscriber, you will receive exclusive updates, special offers, and the latest news directly in your inbox. We are committed to providing you with valuable content and keeping you informed about all the exciting things happening at our company.</p>
                <p>If you have any questions, suggestions, or feedback, please do not hesitate to contact us. We are here to help you.</p>
                <p>Once again, thank you for joining us, and we look forward to connecting with you!</p>
                <p>Best regards,</p>
                <p>City Agenda</p>
            </body>
            </html>
        ';

        // Use the configured email settings
        $this->email->setTo($emailaddress);
        $this->email->setSubject($subject);
        $this->email->setMessage($message);

        if (!$this->email->send()) {
            log_message('error', 'Failed to send subscription email to ' . $emailaddress);
        }
    }
}
