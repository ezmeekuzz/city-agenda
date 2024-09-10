<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\CategoriesModel;

class AddCategoryController extends SessionController
{
    public function index()
    {
        $data = [
            'title' => 'City Agenda | Add Category',
            'currentpage' => 'addcategory'
        ];
        return view('pages/admin/addcategory', $data);
    }
    public function insert()
    {
        $CategoriesModel = new CategoriesModel();
        $categoryname = $this->request->getPost('categoryname');
    
        // Define the upload folder path
        $uploadPath = 'uploads/category-image';
    
        // Ensure the directory exists, and if not, create it with correct permissions
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
    
        // Handle image upload
        $categoryImage = $this->request->getFile('categoryimage');
        $imagePath = '';
    
        if ($categoryImage && $categoryImage->isValid()) {
            if (!$categoryImage->hasMoved()) {
                // Generate a unique name for the image
                $newImageName = $categoryImage->getRandomName();
                // Move the image to the uploads/category-image folder
                $categoryImage->move($uploadPath, $newImageName);
                // Store the image path for saving to the database
                $imagePath = $uploadPath . '/' . $newImageName;
            }
        } else {
            // Optional: Handle image upload errors or log them
            if ($categoryImage) {
                log_message('error', 'Image Upload Error: ' . $categoryImage->getErrorString());
            }
        }
    
        // Prepare data for insertion, including the slug and image path
        $data = [
            'categoryname' => $categoryname,
            'slug' => '/events?category=' . $categoryname,
            'categoryimage' => $imagePath, // Save the image path in the database
            'is_top_category' => 'No'
        ];
    
        // Insert the category into the database
        $result = $CategoriesModel->insert($data);
    
        // Return response
        if ($result) {
    
            $response = [
                'success' => true,
                'message' => 'Category added successfully!',
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to add category.',
            ];
        }
    
        return $this->response->setJSON($response);
    }
}
