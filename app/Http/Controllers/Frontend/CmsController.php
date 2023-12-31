<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\ContactPageCms;
use App\Models\ContactUs;
use App\Models\HomePage;
use App\Models\Plan;
use App\Models\Qna;
use App\Models\Location;
use App\Models\PrivacyPolicy;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CmsController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->limit(4)->offset(1)->get();
        $blog = Blog::orderBy('id', 'desc')->first();
        $banners = HomePage::orderBy('id', 'desc')->where('type', 1)->get();
        $homeBodies = HomePage::orderBy('id', 'desc')->where('type', 2)->get(); 
        return view('frontend.home')->with(compact('blogs','blog', 'banners', 'homeBodies'));
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
        $detail = ContactPageCms::first();
        return view('frontend.contact-us')->with(compact('detail'));
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
        $qnas = Qna::where('status', true)->get();
        return view('frontend.qna')->with(compact('qnas'));
    }

    public function membershipPlans()
    {
        $plans = Plan::with('specifications')->orderBy('id', 'asc')->get();
        return view('frontend.membership-plans')->with(compact('plans'));
    }

    public function mobileHealthCoverage()
    {
        return view('frontend.mobile-health-coverage');
    }

    public function storeLocation(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        
        $location = new Location();
        if(auth()->check()) {
            $location->user_id = auth()->user()->id;
            $location->session_id = null;
        } else {
            $session_id = Session::getId();
            $location->user_id = null;
            $location->session_id = $session_id;
            $request->session()->put('session_id', $session_id);
        }        
        $location->ip_address = $request->ip_address;
        $location->address = $request->address;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        $location->save();

       
        $request->session()->put('latitude', $request->latitude);
        $request->session()->put('longitude', $request->longitude);
        $request->session()->put('address', $request->address);

        
        // return response()->json(['success' => true]);
        // return response()->json(['session' => $request->session()->all()]);
    }

    public function privacyPolicy()
    {
        $privacyPolicy = PrivacyPolicy::first();
        return view('frontend.privacy-policy')->with(compact('privacyPolicy'));
    }

    public function termsAndConditions()
    {
        $terms = TermsAndCondition::first();
        return view('frontend.terms-and-conditions')->with(compact('terms'));
    }
}  

