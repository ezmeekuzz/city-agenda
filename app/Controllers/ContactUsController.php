<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MessagesModel;

class ContactUsController extends BaseController
{
    protected $messagesModel;

    public function __construct()
    {
        $this->messagesModel = new MessagesModel();
    }

    public function index()
    {
        $data = [
            'title' => 'City Agenda'
        ];
        return view('pages/contact-us', $data);
    }

    public function send()
    {
        // Validate input data
        if ($this->validate([
            'fullname' => 'required',
            'email' => 'required|valid_email',
            'message' => 'required',
        ])) {
            $name = $this->request->getPost('fullname');
            $email = $this->request->getPost('email');
            $message = $this->request->getPost('message');

            $emailContent = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; color: #333; }
                    .container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; }
                    .header { background-color: #f4f4f4; padding: 10px; border-bottom: 2px solid #ddd; }
                    .header h2 { margin: 0; font-size: 24px; }
                    .content { margin-top: 20px; }
                    .footer { margin-top: 20px; font-size: 12px; color: #777; }
                    .footer a { color: #007bff; text-decoration: none; }
                    .footer a:hover { text-decoration: underline; }
                    .message-box { border: 1px solid #ddd; padding: 15px; border-radius: 4px; background-color: #fafafa; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2>Contact Form Submission</h2>
                    </div>
                    <div class='content'>
                        <p><strong>Name:</strong> $name</p>
                        <p><strong>Email:</strong> $email</p>
                        <div class='message-box'>
                            <p><strong>Message:</strong></p>
                            <p>$message</p>
                        </div>
                    </div>
                    <div class='footer'>
                        <p>Thank you for your message. We will get back to you shortly.</p>
                        <p>If you need immediate assistance, please contact us directly at <a href='mailto:support@cityagenda.com'>support@cityagenda.com</a>.</p>
                    </div>
                </div>
            </body>
            </html>
            ";
            // Save the data to the database
            $this->messagesModel->insert([
                'fullname' => $name,
                'email' => $email,
                'message' => $message,
                'message_date' => date('Y-m-d')
            ]);

            // Send the email
            $emailService = \Config\Services::email();
            $emailService->setTo('rustomcodilan@gmail.com');
            $emailService->setSubject('Contact Form Submission');
            $emailService->setMessage($emailContent);
            $emailService->setMailType('html'); // Ensure email is sent as HTML

            if ($emailService->send()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Thank you for your message. We will get back to you shortly.'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to send your message. Please try again later.'
                ]);
            }
        } else {
            // Validation failed
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please fill in all required fields with valid information.'
            ]);
        }
    }
}
