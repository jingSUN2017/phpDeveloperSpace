<?php
namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class personalInfoController extends Controller
{
    public function getInfo()
    {
        return view('personalInfo.update');
    }
    public function postInfo(Request $request)
    {
        Auth::user()->update([
            'first_name'=>$request->input('first_name'),
            'last_name'=>$request->input('last_name'),
            'phone'=>$request->input('phone'),
            'position'=>$request->input('position'),
            'hobby'=>$request->input('hobby'),
            'first_address'=>$request->input('first_address'),
            'second_address'=>$request->input('second_address'),
            'status'=>$request->input('status'),

        ]);
        return redirect()->route('home');
    }
}