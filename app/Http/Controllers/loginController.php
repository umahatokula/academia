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


class loginController extends Controller {


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
            return \Redirect::back()->withInput();
        }

        //attempt to login
        $login = isset($request->remember_me) && $request->remember_me == 1 ? $user = \Sentinel::login($user) : $user = \Sentinel::login($user);

        // dd($login);
        $user = \Sentinel::getUser();
        \Session::put('user', $user);

        return \Redirect::intended();
    }

    public function logout(){
        \Session::flush();
        \Sentinel::logout();
        $data['title'] = 'Login';
        return \Redirect::to('/');
    }


}
