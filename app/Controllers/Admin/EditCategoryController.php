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
        $data = [
            'categoryname' => $categoryname,
            'slug' => strtolower(str_replace(
                [" ", "&", "!", ",", "?", ":", ";", "/", "'", "(", ")"], 
                ["-", "and", "", "", "", "", "", "-", "", ""], 
                htmlentities($categoryname, ENT_QUOTES, 'UTF-8')
            )),
        ];

        $result = $CategoriesModel->update($categoryId, $data);
    
        if ($result) {
            $this->dynamicRoutes();
            $response = [
                'success' => true,
                'message' => 'Category updated successfully!',
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to updated category.',
            ];
        }
    
        return $this->response->setJSON($response);
    }  
    
    private function dynamicRoutes() {
        $model = new CategoriesModel();
        $result = $model->findAll();
        $data = [];

        if (count($result)) {
            foreach ($result as $route) {
                $data[$route['slug']] = 'EventsController::index/' . $route['category_id'];
            }
        }

        $output = '<?php' . PHP_EOL;
        foreach ($data as $slug => $controllerMethod) {
            $output .= '$routes->get(\'' . $slug . '\', \'' . $controllerMethod . '\');' . PHP_EOL;
        }

        $filePath = ROOTPATH . 'app/Config/EventCategoriesRoutes.php';

        file_put_contents($filePath, $output);
    }  
}
