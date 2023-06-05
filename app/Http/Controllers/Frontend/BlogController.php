<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Qna;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogs($slug = null)
    {
        if ($slug != null) {
            $qnas = Qna::where('status', true)->get();
            $blogsCategories = BlogCategory::orderBy('id', 'desc')->select('name','slug')->get();
            $blogs = Blog::with('category')->whereHas('category', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->orderBy('id', 'desc')->paginate(10);
            $lastBlogs = Blog::orderBy('id', 'desc')->take(10)->get();
            return view('frontend.blogs')->with(compact('blogs', 'blogsCategories', 'lastBlogs','qnas'));
        } else {
            $qnas = Qna::where('status', true)->get();
            $blogsCategories = BlogCategory::orderBy('id', 'desc')->select('name','slug')->get();
            $blogs = Blog::orderBy('id', 'desc')->paginate(10);
            $lastBlogs = Blog::orderBy('id', 'desc')->take(10)->get();
            return view('frontend.blogs')->with(compact('blogs', 'blogsCategories', 'lastBlogs','qnas'));
        }
    }

    public function blogDetails($category_slug , $blog_slug)
    {
        $blogsCategories = BlogCategory::orderBy('id', 'desc')->select('name','slug')->get();
        $blog = Blog::with('category')->whereHas('category', function ($query) use ($category_slug) {
            $query->where('slug', $category_slug);
        })->where('slug', $blog_slug)->first();
        $lastBlogs = Blog::orderBy('id', 'desc')->take(10)->get();
        return view('frontend.blog-details')->with(compact('blog', 'blogsCategories', 'lastBlogs'));
    }

    public function searchResult(Request $request)
    {
        if ($request->ajax()) {
                $blogs = Blog::where('title', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'desc')->get();
                return response()->json(['view' => view('frontend.search-result', compact('blogs'))->render()]);
        }
    }
}
