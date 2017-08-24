<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Input;

class userController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function postLogin(Request $request){
    	
		$validator = \Validator::make($request->all(), [
           'email'=>'required|email',
           'password'=>'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect('login')
                        ->withErrors($validator)
                        ->withInput();
        }
        $input=Input::all();
        $login=array(
                    'email'   => $input['email'],
                    'password'=> md5($input['password'])
                );
        $users=\DB::table('users')->where($login)->get();
        if(count($users)>0){
           // Session()->put('user_id',$users[0]->user_id);
            //Session()->put('user_name',$users[0]->user_name);
            return \Redirect::route('dashboard');
        }
        $request->session()->flash('message.level', 'danger');
        $request->session()->flash('message.content', 'Invalid Credentials!');
        return \Redirect::route('login');
	}
      
    public function logout()
    {
        Session::flush();
       return \Redirect::route('login');
    }
      
    public function dashboard()
    {
	 return view('home.dashboard');
    }
}