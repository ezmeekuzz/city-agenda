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
    
        $data = [
            'categoryname' => $categoryname,
            'slug' => strtolower(str_replace(
                [" ", "&", "!", ",", "?", ":", ";", "/", "'", "(", ")"], 
                ["-", "and", "", "", "", "", "", "-", "", ""], 
                htmlentities($categoryname, ENT_QUOTES, 'UTF-8')
            )),
        ];

        $result = $CategoriesModel->insert($data);
    
        if ($result) {
            $this->dynamicRoutes();
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
