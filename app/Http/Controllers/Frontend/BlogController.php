<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogs()
    {
        $blogsCategories = BlogCategory::orderBy('id', 'desc')->select('name')->get();
        $blogs = Blog::orderBy('id', 'desc')->paginate(10);  
        $lastBlogs = Blog::orderBy('id', 'desc')->take(10)->get();                                                                                                                               
        return view('frontend.blogs')->with(compact('blogs','blogsCategories','lastBlogs'));
    }
}
