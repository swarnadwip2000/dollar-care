<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\ContactPageCms;
use App\Models\ContactUs;
use App\Models\PrivacyPolicy;
use App\Models\Qna;
use Illuminate\Http\Request;
use Psy\CodeCleaner\ReturnTypePass;

class CmsController extends Controller
{
    public function qnaIndex()
    {
        $qnas = Qna::orderBy('id', 'desc')->get();
        return view('admin.cms.qna.list', compact('qnas'));
    }

    public function qnaChangeStatus(Request $request)
    {
        // return $request->all();
        $qna = Qna::find($request->id);
        $qna->status = $request->status;
        $qna->save();
        return response()->json(['status' => 'success', 'message' => 'Status has been changed successfully']);
    }

    public function qnaDelete($id)
    {
        $qna = Qna::findOrFail($id);
        $qna->delete();
        return redirect()->back()->with('success', 'Qna has been deleted successfully');
    }

    public function qnaStore(Request $request)
    {
       $request->validate([
           'question' => 'required',
           'answer' => 'required',
       ]);

        $qna = new Qna();
        $qna->question = $request->question;
        $qna->answer = $request->answer;
        $qna->status = true;
        $qna->save();
        return redirect()->back()->with('message', 'Qna has been added successfully');
    }

    public function qnaEdit(Request $request)
    {
        $qna = Qna::find($request->id);
        return response()->json(['qna' => $qna, 'message' => 'Qna details found successfully.']);
    }

    public function qnaUpdate(Request $request)
    {
       $request->validate([
        'edit_question' => 'required',
        'edit_answer' => 'required',
       ]);

        $qna = Qna::find($request->id);
        $qna->question = $request->edit_question;
        $qna->answer = $request->edit_answer;
        $qna->save();
        return redirect()->back()->with('message', 'Qna has been updated successfully');
    }

    public function contactUsIndex()
    {
        $contactUs = ContactPageCms::orderBy('id', 'desc')->first();
       return view('admin.cms.contact-us.update')->with(compact('contactUs'));
    }

    public function contactUsUpdate(Request $request)
    {
        $request->validate([
            'contact_page_title' => 'required',
            'visit_us' => 'required',
            'call_us' => 'required',
            'mail_us' => 'required',
        ]);

        try {
            $contactUs = ContactPageCms::orderBy('id', 'desc')->first();
            $contactUs->contact_page_title = $request->contact_page_title;
            $contactUs->visit_us = $request->visit_us;
            $contactUs->call_us = $request->call_us;
            $contactUs->mail_us = $request->mail_us;
            $contactUs->save();
            return redirect()->back()->with('message', 'Contact us page details has been updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function aboutUsIndex()
    {
        $aboutUs = AboutUs::orderBy('id', 'desc')->first();
        return view('admin.cms.about-us.update')->with(compact('aboutUs'));
    }

    public function aboutUsUpdate(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $aboutUs = AboutUs::findOrFail($request->id);
        $aboutUs->content = $request->content;
        $aboutUs->save();
        return redirect()->back()->with('message', 'About us page details has been updated successfully');
    }

    public function privacyPolicyIndex()
    {
        $privacyPolicy = PrivacyPolicy::orderBy('id', 'desc')->first();
        return view('admin.cms.privacy-policy.update')->with(compact('privacyPolicy'));
    }

    public function privacyPolicyUpdate(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $privacyPolicy = PrivacyPolicy::findOrFail($request->id);
        $privacyPolicy->content = $request->content;
        $privacyPolicy->save();
        return redirect()->back()->with('message', 'Privacy policy page details has been updated successfully');
    }
}
