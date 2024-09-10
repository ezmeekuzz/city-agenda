<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\CategoriesModel;

class CategoryMasterlistController extends SessionController
{
    public function index()
    {
        $data = [
            'title' => 'City Agenda | City Masterlist',
            'currentpage' => 'categorymasterlist'
        ];
        return view('pages/admin/categorymasterlist', $data);
    }
    public function getData()
    {
        return datatables('categories')
            ->make();
    }
    public function delete($id)
    {
        $CategoriesModel = new CategoriesModel();
    
        // Fetch the category details to get the image path
        $category = $CategoriesModel->find($id);
    
        if (!$category) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Category not found.'
            ]);
        }
    
        // Get the category image path
        $imagePath = $category['categoryimage'];
    
        // Delete the image file if it exists
        if ($imagePath && file_exists($imagePath)) {
            unlink($imagePath); // Remove the image from the server
        }
    
        // Now delete the category from the database
        $deleted = $CategoriesModel->delete($id);
    
        if ($deleted) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Category deleted successfully']);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to delete the category from the database'
            ]);
        }
    }  
      
    public function updateTopCategory($id)
    {
        $CategoriesModel = new CategoriesModel();

        $category = $CategoriesModel->find($id);
        if (!$category) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Category not found.'
            ]);
        }

        $isTopCategory = $this->request->getPost('is_top_category');
        $CategoriesModel->update($id, ['is_top_category' => $isTopCategory]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Top category status updated successfully.'
        ]);
    }  
}
