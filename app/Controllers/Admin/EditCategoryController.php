<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\CategoriesModel;

class EditCategoryController extends SessionController
{
    public function index($id)
    {
        $CategoriesModel = new CategoriesModel();
        $details = $CategoriesModel
        ->find($id);
        $data = [
            'title' => 'City Agenda | Edit Category',
            'currentpage' => 'categorymasterlist',
            'details' => $details,
        ];
        return view('pages/admin/editcategory', $data);
    }
    public function update()
    {
        $CategoriesModel = new CategoriesModel();
        $categoryId = $this->request->getPost('category_id');
        $categoryname = $this->request->getPost('categoryname');
        
        // Fetch the existing category details to get the current image path
        $category = $CategoriesModel->find($categoryId);
        $currentImagePath = $category['categoryimage'];
        
        // Define the upload folder path
        $uploadPath = 'uploads/category-image';
        
        // Ensure the directory exists, and if not, create it with correct permissions
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        
        // Handle image upload
        $categoryImage = $this->request->getFile('categoryimage');
        $newImagePath = $currentImagePath; // Initialize with the current image path
    
        if ($categoryImage && $categoryImage->isValid()) {
            if (!$categoryImage->hasMoved()) {
                // Optionally delete the previous image if a new image is uploaded
                if ($currentImagePath && file_exists($currentImagePath)) {
                    unlink($currentImagePath); // Delete the previous image
                }
    
                // Generate a unique name for the new image
                $newImageName = $categoryImage->getRandomName();
                // Move the image to the uploads/category-image folder
                $categoryImage->move($uploadPath, $newImageName);
                // Store the new image path for saving to the database
                $newImagePath = $uploadPath . '/' . $newImageName;
            }
        }
    
        // Prepare the data for updating, including the slug and image path
        $data = [
            'categoryname' => $categoryname,
            'slug' => '/events?category=' . $categoryname,
            'categoryimage' => $newImagePath, // Update with the new image path
        ];
    
        // Update the category in the database
        $result = $CategoriesModel->update($categoryId, $data);
    
        // Return response
        if ($result) {
    
            $response = [
                'success' => true,
                'message' => 'Category updated successfully!',
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to update category.',
            ];
        }
    
        return $this->response->setJSON($response);
    }
}
