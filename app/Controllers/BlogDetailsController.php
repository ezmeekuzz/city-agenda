<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\BlogsModel;
use App\Models\Admin\CategoriesModel;

class BlogDetailsController extends BaseController
{
    public function index($id)
    {
        $blogsModel = new BlogsModel();
        $categoriesModel = new CategoriesModel();

        $blogLists = $blogsModel->findAll();

        $blogDetails = $blogsModel
        ->join('users', 'users.user_id=blogs.user_id', 'left')
        ->find($id);

        $recentBlogLists = $blogsModel
        ->where('publishstatus', 'Yes')
        ->where('dateadded >=', date('Y-m-d H:i:s', strtotime('-2 days')))
        ->findAll();

        $categoryLists = $categoriesModel->findAll();

        $data = [
            'title' => 'City Agenda',
            'blogDetails' => $blogDetails,
            'recentBlogLists' => $recentBlogLists,
            'categoryLists' => $categoryLists,
            'blogLists' => $blogLists,
        ];
        return view('pages/blogdetails', $data);
    }
}
