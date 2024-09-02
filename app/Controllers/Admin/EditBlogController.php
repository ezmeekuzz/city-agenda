<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\SessionController;
use App\Models\Admin\CategoriesModel;
use App\Models\Admin\BlogsModel;
use App\Models\Admin\BlogCategoriesModel;

class EditBlogController extends SessionController
{
    public function index($blogId)
    {
        $blogModel = new BlogsModel();
        $categoryModel = new CategoriesModel();
        $blogCategoriesModel = new BlogCategoriesModel();

        // Fetch the blog and associated categories
        $blog = $blogModel->find($blogId);
        $categories = $categoryModel->findAll();
        $selectedCategories = $blogCategoriesModel->where('blog_id', $blogId)->findColumn('category_id');

        if (!$blog) {
            // Handle blog not found scenario
            return redirect()->to('/admin/blogs')->with('error', 'Blog not found.');
        }

        $data = [
            'title' => 'City Agenda | Edit Blog',
            'currentpage' => 'blogmasterlist',
            'blog' => $blog,
            'categories' => $categories,
            'selectedCategories' => $selectedCategories
        ];

        return view('pages/admin/editblog', $data);
    }

    public function update($blogId)
    {
        $blogModel = new BlogsModel();
        $blogCategoriesModel = new BlogCategoriesModel();
    
        // Fetch the current blog data to get the old image path
        $currentBlog = $blogModel->find($blogId);
    
        // Determine publish status
        $publishstatus = $this->request->getPost('publishstatus') === 'Yes' ? 'Yes' : 'No';
    
        // Prepare data for update
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
            'dateupdated' => date('Y-m-d H:i:s'),
        ];
    
        // Handle the blog image upload
        $blogImage = $this->request->getFile('blogimage');
        if ($blogImage && $blogImage->isValid() && !$blogImage->hasMoved()) {
            // Delete the old image file if it exists
            if (!empty($currentBlog['blogimage']) && file_exists(FCPATH . $currentBlog['blogimage'])) {
                unlink(FCPATH . $currentBlog['blogimage']);
            }
    
            // Move the new image and save its path
            $newName = $blogImage->getRandomName();
            $blogImage->move(FCPATH . 'uploads/blog_images', $newName);
            $data['blogimage'] = 'uploads/blog_images/' . $newName;
        }
    
        // Update the blog in the database
        $updated = $blogModel->update($blogId, $data);
    
        if ($updated) {
            // Clear existing blog categories and insert new ones
            $blogCategoriesModel->where('blog_id', $blogId)->delete();
            $categoryIds = $this->request->getPost('category_id');
            if (!empty($categoryIds) && is_array($categoryIds)) {
                foreach ($categoryIds as $categoryId) {
                    $blogCategoriesModel->insert([
                        'blog_id' => $blogId,
                        'category_id' => $categoryId,
                    ]);
                }
            }
    
            // Optionally update dynamic routes
            $this->dynamicRoutes();
    
            // Prepare a success response
            return $this->response->setJSON(['success' => true, 'message' => 'Blog post updated successfully!']);
        } else {
            // Prepare a failure response
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to update blog post.']);
        }
    }    

    private function dynamicRoutes()
    {
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
