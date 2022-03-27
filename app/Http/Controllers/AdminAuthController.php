<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use ReflectionFunctionAbstract;
use Illuminate\Support\Facades\Validator;


class AdminAuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function register(){
        return view('auth.register');
    }
    public function RegisterUser(Request $request){
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:5|max:12'
        // ]);
        // $user = new User();
        // $user->name = $request->name ;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $res = $user->save();
        // if($res){
        //     return redirect()->to('/login')->with('success', 'You have successfully registered, Login to access your dashboard');
        // }
    
        // else{
        //     return back()->with('fail','Somthings Wrong');
        // }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',   // required and email format validation
            'password' => 'required|min:8', // required and number field validation
            
        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {

            return back()->withInput()->withErrors($validator);
            // validation failed redirect back to form

        } else {
            //validations are passed, save new user in database
            $User = new Admin();
            $User->name = $request->name;
            $User->email = $request->email;
            $User->password = bcrypt($request->password);
            $User->save();

            return redirect("login")->with('success', 'You have successfully registered, Login to access your dashboard');
        }
        
        
    }
    public function loginUser(Request $request){
        $request->validate([
            'email'=>'required|email|exists:admins',
            'password' => 'required|min:5|max:12'
        ]);
        $user = Admin::where('email' , '=' , $request->email)->first();
        if($user){
            if(Hash::check($request->password , $user->password)){
                $request->session()->put('loginId' , $user->id);
                return redirect("dashboard");
            }
            else{
                return back()->with('fail','this password not matches');
            }

        }
        else{
            return back()->with('fail','this email Not Defined');
        }

    }
    public function dashboard(){
        $data = array();
        if(Session::has('loginId')){
            $data = Admin::where('id' , '=' ,  Session::get('loginId'))->first();

        }
        return view('admin.dashboard',compact('data'));
    }

    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }
}
