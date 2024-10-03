<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\BlogsModel;
use App\Models\Admin\CategoriesModel;
use App\Models\Admin\BlogCategoriesModel;

class BlogsController extends BaseController
{
    public function index()
    {
        $blogsModel = new BlogsModel();
        $categoriesModel = new CategoriesModel();
        $blogCategoriesModel = new BlogCategoriesModel();
    
        // Get the category from the query string, or set it as an empty string
        $category = $this->request->getGet('category') ? $this->request->getGet('category') : '';
        $title = $this->request->getGet('title') ? $this->request->getGet('title') : '';
    
        // Start building the query for blogs
        $blogsQuery = $blogsModel
            ->select('blogs.*, blogs.slug as sl, users.*')
            ->join('users', 'blogs.user_id = users.user_id', 'left')
            ->where('blogs.publishstatus', 'Yes');
    
        // If a category is provided, add the necessary joins and filter by the category name
        if (!empty($category)) {
            $blogsQuery = $blogsQuery
                ->select('categories.*')
                ->join('blogcategories', 'blogs.blog_id = blogcategories.blog_id', 'left')
                ->join('categories', 'blogcategories.category_id = categories.category_id', 'left')
                ->where('categories.categoryname', $category);
        }
    
        // If a title is provided, add the necessary joins and filter by the category name
        if (!empty($title)) {
            $blogsQuery = $blogsQuery
                ->where('blogs.title', $title);
        }
        // Execute the query
        $blogLists = $blogsQuery->findAll();

        $recentBlogLists = $blogsModel
        ->where('publishstatus', 'Yes')
        ->where('dateadded >=', date('Y-m-d H:i:s', strtotime('-2 days')))
        ->findAll();
    
        // Get the category list
        $categoryLists = $categoriesModel->findAll();
    
        // Pass the data to the view
        $data = [
            'title' => 'City Agenda',
            'blogLists' => $blogLists,
            'categoryLists' => $categoryLists,
            'recentBlogLists' => $recentBlogLists,
        ];
    
        // Return the view with the data
        return view('pages/blogs', $data);
    }
}
