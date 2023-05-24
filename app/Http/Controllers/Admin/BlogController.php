<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    use ImageTrait;

    public function categoryIndex()
    {
        $categories = BlogCategory::orderBy('id', 'desc')->get();
        return view('admin.blogs.category.list', compact('categories'));
    }

    public function categoryCreate()
    {
        return view('admin.blogs.category.create');
    }

    public function categoryEdit($id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blogs.category.edit', compact('category'));
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:blog_categories',
        ]);

        $category = new BlogCategory();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
        return redirect()->route('blogs.categories.index')->with('message', 'Category created successfully');
    }

    public function categoryUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:blog_categories,slug,' . $request->id,
        ]);

        $category = BlogCategory::findOrFail($request->id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
        return redirect()->route('blogs.categories.index')->with('message', 'Category updated successfully');
    }

    public function categoryDelete($id)
    {
        $category = BlogCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('blogs.categories.index')->with('error', 'Category deleted successfully');
    }

    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->get();
        return view('admin.blogs.list')->with(compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::orderBy('id', 'desc')->get();
        return view('admin.blogs.create')->with(compact('categories'));
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('id', 'desc')->get();
        return view('admin.blogs.edit')->with(compact('blog', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'blog_category_id' => 'required',
            'slug' => 'required|unique:blogs',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'content' => 'required',
            'status' => 'required',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->blog_category_id = $request->blog_category_id;
        $blog->slug = $request->slug;
        $blog->image = $this->imageUpload($request->file('image'), 'blogs');
        $blog->content = $request->content;
        $blog->status = $request->status;
        $blog->save();
        return redirect()->route('blogs.index')->with('message', 'Blog created successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'blog_category_id' => 'required',
            'slug' => 'required|unique:blogs,slug,' . $request->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'content' => 'required',
            'status' => 'required',
        ]);

        $blog = Blog::findOrFail($request->id);
        $blog->title = $request->title;
        $blog->blog_category_id = $request->blog_category_id;
        $blog->slug = $request->slug;
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg',
            ]);
            if ($blog->image) {
                $currentImageFilename = $blog->image; // get current image name
                Storage::delete('app/'.$currentImageFilename);
            }
            $blog->image = $this->imageUpload($request->file('image'), 'blogs');
        }
        $blog->content = $request->content;
        $blog->status = $request->status;
        $blog->save();
        return redirect()->route('blogs.index')->with('message', 'Blog updated successfully');
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->image) {
            $currentImageFilename = $blog->image; // get current image name
            Storage::delete('app/'.$currentImageFilename);
        }                                                                                                                                                                                           
        $blog->delete();
        return redirect()->route('blogs.index')->with('error', 'Blog deleted successfully');
    }

    public function changeBlogStatus(Request $request)
    {
        $user = Blog::find($request->id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success' => 'Status change successfully.']);
    }
}
