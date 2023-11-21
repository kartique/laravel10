<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard')->with('userInfo', Auth::guard('admin')->user());
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required:max:20'
            ];

            $customMessages = [
                'email.required' => 'Email is required.',
                'email.valid' => 'Invalid email address.',
                'password.required' => 'Password is required.'
            ];

            $this->validate($request, $rules, $customMessages);

            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                return redirect("admin/dashboard");
            }else{
                return redirect()->back()->with("error_message","Invalid Email/Password!");
            }
        }
        if(Auth::guard('admin')->check()){
            return redirect("admin/dashboard");
        }
        return view('admin.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/logout');
    }

    public function sample(){
        // sending userData as user cannot access these pages without login
        return view('admin.sample')->with('userInfo', Auth::guard('admin')->user());
    }
}
