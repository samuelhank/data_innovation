<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function savefile(Request $request){
        $file=$request->file('fileimage');
        $filename =$file->getClientOriginalName();
        $file->storeAs('public/frontimage', $filename);
        return redirect()->back();

    }
}
