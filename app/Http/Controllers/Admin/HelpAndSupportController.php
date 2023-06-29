<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HelpAndSupport;
use Illuminate\Http\Request;

class HelpAndSupportController extends Controller
{
    public function helpAndSupport()
    {
        $helpAndSupports = HelpAndSupport::orderBy('id', 'desc')->get();
        return view('admin.help-and-support.list')->with(compact('helpAndSupports'));
    }
}
