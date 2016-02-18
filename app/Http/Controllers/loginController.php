<?php namespace App\Http\Controllers;

use Cache;
use App\User;
use App\Person;
use App\Role;
use App\Privilege;
use App\Member;

use App\Http\Requests;
use App\Helpers\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
// use App\Http\Controllers\Toastr;


class loginController extends Controller {

    public function login(){
        return view('login');
    }


    public function doLogin(Request $request) {
        // dd($request);

        //get the users credentials
        $credentials = [
            'login' => $request->email,
        ];

        //check if there is a match for the email and pword provided
        $user = \Sentinel::findByCredentials($credentials);

        //if there is no match redirect to login page ith input
        if(is_null($user)){
            // dd($user);
            session()->flash('flash_message', 'Login failure.');
            session()->flash('flash_message_important', true);
            return \Redirect::back()->withInput();
        }

        //attempt to login
        $login = isset($request->remember_me) && $request->remember_me == 1 ? $user = \Sentinel::login($user) : $user = \Sentinel::login($user);

        // store user info in session
        $user = \Sentinel::getUser();
        \Session::put('user', $user);

        //store session and term info in session
        $term_info = DB::table('current_term')->orderBy('created_at', 'desc')->first();

        if (null !== $term_info) {
            \Session::put(['current_session' => $term_info->session, 'current_term' => $term_info->term]);
        }
        

        return \Redirect::intended();
    }

    public function logout(){
        \Session::flush();
        \Sentinel::logout();
        $data['title'] = 'Login';
        return \Redirect::to('/');
    }


}
