<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\BlogsModel;
use App\Models\Admin\BlogCategoriesModel;

class BlogMasterlistController extends SessionController
{
    public function index()
    {
        $data = [
            'title' => 'City Agenda | Blog Masterlist',
            'currentpage' => 'blogmasterlist'
        ];
        return view('pages/admin/blogmasterlist', $data);
    }
    public function getData()
    {
        return datatables('blogs')
            ->join('blogcategories', 'blogs.blog_id = blogcategories.blog_id', 'LEFT JOIN')
            ->make();
    }
    public function delete($id)
    {
        $BlogsModel = new BlogsModel();
        $BlogCategoriesModel = new BlogCategoriesModel();
        
        // Fetch the blog entry to get the image path
        $blog = $BlogsModel->find($id);
        
        if ($blog) {
            // Delete the image file if it exists
            if (!empty($blog['blogimage']) && file_exists(FCPATH . $blog['blogimage'])) {
                unlink(FCPATH . $blog['blogimage']);
            }
            
            // Delete associated blog categories
            $BlogCategoriesModel->where('blog_id', $id)->delete();
            
            // Delete the blog entry
            $deleted = $BlogsModel->delete($id);
        
            if ($deleted) {
                $this->dynamicRoutes();
                return $this->response->setJSON(['status' => 'success']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete the blog from the database']);
            }
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Blog not found']);
        }
    }       
    
    private function dynamicRoutes() {
        $model = new BlogsModel();
        $result = $model->findAll();
        $data = [];
    
        if (count($result)) {
            foreach ($result as $route) {
                $data[$route['slug']] = 'BlogsController::index/' . $route['blog_id'];
            }
        }
    
        $output = '<?php' . PHP_EOL;
        foreach ($data as $slug => $controllerMethod) {
            $output .= '$routes->get(\'' . $slug . '\', \'' . $controllerMethod . '\');' . PHP_EOL;
        }
    
        $filePath = ROOTPATH . 'app/Config/BlogRoutes.php';
    
        file_put_contents($filePath, $output);
    } 
}
