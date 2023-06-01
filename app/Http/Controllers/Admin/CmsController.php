<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Qna;
use Illuminate\Http\Request;

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
}
