<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function categoryIndex()
    {
        $categories = BlogCategory::orderBy('id', 'desc')->get();
        return view('admin.blogs.category.list', compact('categories'));
    }
}
