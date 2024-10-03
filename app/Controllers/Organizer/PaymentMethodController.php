<?php

namespace App\Controllers\Organizer;

use App\Controllers\Organizer\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\PaymentMethodsModel;

class PaymentMethodController extends SessionController
{
    public function index()
    {
        $data = [
            'title' => 'City Agenda | Payment Method',
            'currentpage' => 'paymentmethod'
        ];
        return view('pages/organizer/paymentmethod', $data);
    }
    public function insert() {
        $validation = \Config\Services::validation();
    
        // Get the form data
        $paymentType = $this->request->getPost('paymentType');
    
        // Dynamically set validation rules based on the payment type
        if ($paymentType === 'bank') {
            $validation->setRules([
                'paymentType' => 'required',
                'accountName' => 'required',
                'swift' => 'required',
                'iban' => 'required',
            ]);
        } elseif ($paymentType === 'credit') {
            $validation->setRules([
                'paymentType' => 'required',
                'cardNumber' => 'required|numeric',
                'expirationDate' => 'required', // Assuming date format is 'YYYY-MM-DD'
                'cvv' => 'required|numeric|min_length[3]|max_length[4]', // For 3-4 digit CVV codes
            ]);
        } else {
            // Handle invalid payment type
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid payment type.'
            ]);
        }
    
        // Run validation
        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed, return errors
            return $this->response->setJSON([
                'success' => false,
                'message' => $validation->getErrors()
            ]);
        }
    
        // Prepare data for insertion based on the payment type
        $data = [
            'user_id' => session()->get('organizer_user_id'),
            'payment_type' => $paymentType,
            'created_at' => date('Y-m-d H:i:s')
        ];
    
        if ($paymentType === 'bank') {
            $data['account_name'] = $this->request->getPost('accountName');
            $data['swift'] = $this->request->getPost('swift');
            $data['iban'] = $this->request->getPost('iban');
        } elseif ($paymentType === 'credit') {
            $data['card_number'] = $this->request->getPost('cardNumber');
            $data['expiration_date'] = $this->request->getPost('expirationDate');
            $data['cvv'] = $this->request->getPost('cvv');
        }
    
        // Assuming you have a model called `PaymentMethodsModel`
        $paymentModel = new PaymentMethodsModel();
        $inserted = $paymentModel->insert($data);
    
        if ($inserted) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Payment method added successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to add the payment method.'
            ]);
        }
    }    
    public function bankAccountTable()
    {
        return datatables('payment_methods')
            ->where('payment_type', 'bank')
            ->where('user_id', session()->get('organizer_user_id'))
            ->make();
    } 
    public function creditCardTable()
    {
        return datatables('payment_methods')
            ->where('payment_type', 'credit')
            ->where('user_id', session()->get('organizer_user_id'))
            ->make();
    }    
    public function toggleActive($id)
    {
        $active = $this->request->getPost('active');
        $paymentModel = new PaymentMethodsModel();

        $paymentModel->update($id, ['card_status' => $active]);

        return $this->response->setJSON(['status' => 'success']);
    }
    public function delete($id)
    {
        $paymentModel = new PaymentMethodsModel();

        $deleted = $paymentModel->where('payment_method_id', $id)->delete();
    
        if ($deleted) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete the payment method from the database']);
        }
    }  
}
