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
        
        $deleted = $CategoriesModel->delete($id);
    
        if ($deleted) {
            $this->dynamicRoutes();
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete the category from the database']);
        }
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
