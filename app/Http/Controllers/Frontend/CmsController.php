<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->limit(4)->offset(1)->get();
        $blog = Blog::orderBy('id', 'desc')->first();
        return view('frontend.home')->with(compact('blogs','blog'));
    }

    public function aboutUs()
    {
        return view('frontend.about');
    }

    public function services()
    {
        $blogs = Blog::orderBy('id', 'desc')->limit(4)->offset(1)->get();
        $blog = Blog::orderBy('id', 'desc')->first();
        return view('frontend.services')->with(compact('blogs','blog'));
    }

    public function contactUs()
    {
        return view('frontend.contact-us');
    }

    public function contactUsSubmit(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);

        $contactUs = new ContactUs();
        $contactUs->first_name = $request->first_name;
        $contactUs->last_name = $request->last_name;
        $contactUs->email = $request->email;
        $contactUs->phone = $request->phone;
        $contactUs->message = $request->message;
        $contactUs->save();
        
        return redirect()->back()->with('message', 'Thank you for contacting us. We will get back to you soon.');
    }

    public function qna()
    {
        return view('frontend.qna');
    }

    public function membershipPlans()
    {
        return view('frontend.membership-plans');
    }

    public function telehealth()
    {
        return view('frontend.telehealth');
    }

    public function mobileHealthCoverage()
    {
        return view('frontend.mobile-health-coverage');
    }
}
