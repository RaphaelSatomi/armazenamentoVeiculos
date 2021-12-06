<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except'=>[
            'login',
            'loginAction'
        ]]);
    }

    public function login(Request $request){
        return view('admin/login',[
            'error' =>  $request->session()->get('error')
        ]);
    }
    public function loginAction(Request $request){
        $param = $request->only('user', 'password');
        if( Auth::attempt($param) ){
            return redirect('/');
        }else{
            $request->session()->flash('error', 'E-mail e/ou senha incorretos');
            return redirect('/login');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function index(){
        return view('admin/index');
    }
    public function lista(){
        return view('admin/lista');
    }
}
