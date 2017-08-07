<?php
namespace App\Http\Controllers;

use Auth;
use \Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function getSignUp()
    {
        return view('auth.createAccount');
    }

    public function postSignUp(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|unique:users|email|max:255',
            'username'=>'required|unique:users|alpha_dash|max:20',
            'password'=>'required|min:2'
        ]);

        User::create([
            'email'=>$request->input('email'),
            'username'=>$request->input('username'),
            'password'=>bcrypt($request->input('password'))
        ]);

        return redirect()->route('home')->with('info','Your account has been created!');
    }

    public function getSignIn()
    {
        return view('auth.logIn');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required'
        ]);
        if(!Auth::attempt($request->only(['email','password']),$request->has('remember'))){
            return redirect()->back()->with('info','Please check out your provided information again.');
        }
        return redirect()->route('home');
    }

    public function getlogOut()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
?>