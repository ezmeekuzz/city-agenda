<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\SessionController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\CategoriesModel;
use App\Models\Admin\BlogsModel;
use App\Models\Admin\BlogCategoriesModel;

class AddBlogController extends SessionController
{
    public function index()
    {
        $categoryModel = new CategoriesModel();

        $categories = $categoryModel->findAll();
        $data = [
            'title' => 'City Agenda | Add Blog',
            'currentpage' => 'addblog',
            'categories' => $categories
        ];
        return view('pages/admin/addblog', $data);
    }
    public function insert()
    {
        $blogModel = new BlogsModel();
        $blogCategoriesModel = new BlogCategoriesModel(); // Assuming you have this model
    
        // Determine publish status
        $publishstatus = $this->request->getPost('publishstatus') === 'Yes' ? 'Yes' : 'No';
    
        // Prepare data for insertion
        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => strtolower(str_replace(
                [" ", "&", "!", ",", "?", ":", ";", "/", "'", "(", ")"], 
                ["-", "and", "", "", "", "", "", "-", "", ""], 
                htmlentities($this->request->getPost('title'), ENT_QUOTES, 'UTF-8')
            )),
            'description' => $this->request->getPost('description'),
            'content' => $this->request->getPost('content'),
            'tags' => $this->request->getPost('tags'),
            'publishstatus' => $publishstatus,
            'dateadded' => date('Y-m-d H:i:s'),
            'dateupdated' => date('Y-m-d H:i:s'),
        ];
    
        // Handle the blog image upload
        $blogImage = $this->request->getFile('blogimage');
        if ($blogImage && $blogImage->isValid() && !$blogImage->hasMoved()) {
            $newName = $blogImage->getRandomName();
            $blogImage->move(FCPATH . 'uploads/blog_images', $newName);
            $data['blogimage'] = 'uploads/blog_images/' . $newName;
        } else {
            $data['blogimage'] = null;
        }
    
        // Check if the blog title already exists (assuming this logic is needed)
        if ($blogModel->where('title', $data['title'])->first()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Exist']);
        }
    
        // Attempt to insert blog data into the database
        $blogId = $blogModel->insert($data);
    
        if ($blogId) {
            // Insert blog categories into the blog_categories table
            $categoryIds = $this->request->getPost('category_id');
            if (!empty($categoryIds) && is_array($categoryIds)) {
                foreach ($categoryIds as $categoryId) {
                    $blogCategoriesModel->insert([
                        'blog_id' => $blogId,
                        'category_id' => $categoryId,
                    ]);
                }
            }
    
            // Optionally call a method to update dynamic routes
            $this->dynamicRoutes();
    
            // Prepare a success response
            return $this->response->setJSON(['success' => true, 'message' => 'Blog post added successfully!']);
        } else {
            // Prepare a failure response
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to add blog post.']);
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
