<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Subcategory;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $files = Admin::latest()->paginate(10);
      return view('Admin.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =Category::all();
        $subcategories= Subcategory::all();
        return view('Admin.create',compact(['categories', 'subcategories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' =>'required|integer',
            'subcategory_id' =>'required|integer'
        ]);
        if ($request->hasFile('file')){
            foreach ($request->file as $file){
                $filename = $file->getClientOriginalName();
                $filesize= $file->getClientSize();
//                $file->storeAs('public/file', $filename);
                $file->move(public_path('file'), $filename);

                $filemode = new Admin();
                $filemode->name = $filename;
                $filemode->size =$filesize;
                $filemode->category_id=$request->category_id;
                $filemode->subcategory_id=$request->subcategory_id;
                $filemode->save();
                Session::flash('success','files saved!!');

            }

        }

         return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file= Admin::findOrFail($id);
        $file->delete();
        return redirect()->back();
        Session::flash('message', 'file deleted');
    }
}
