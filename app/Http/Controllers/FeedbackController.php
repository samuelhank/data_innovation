<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FeedbackController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function feedback(Request $request){
        $feedback =new Feedback();
        $feedback->text= $request->text;
        $feedback->save();
        Session::flash('success','Thank you for your feedback!');
        return redirect()->back();

    }
}
