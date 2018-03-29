<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users=User::all();
        return view('home')->withUsers($users);
    }
public function profile(){
        return view('profile.index',['user' =>Auth::user()]);
}
public function update(Request $request){
        $user =Auth::user();
        $user->name=$request['name'];
        $user->course= $request['course'];
        $user->update();
        $file=$request->file('image');
       $filename =$request['name']. '-'. $user->id;
       if ($file){
           Storage::disk('local')->put($filename, File::get($file));
       }
       return redirect()->back();

}
public function userimage($filename){
        $file =Storage::disk('local')->get($filename);
        return new Response($file,200);
}
//public function pdf(){
//        $pdf =\PDF::loadview('pdf.index');
//        $pdf->download('invoice.pdf');
//
//}
public function getpdf(){
       return view('pdf.index');

}
public function generatepdf(Request $request){
$html=$request['text'];
$pdf=new Dompdf();
$pdf->loadHtml($html);
$pdf->setPaper('A4','portrait');
$pdf->render();
$pdf->stream();
}
}
