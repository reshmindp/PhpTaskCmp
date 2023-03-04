<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login_page()
    {
        return view('login');
    }

    public function login()
    {
        $message = ['required'=>'* Field is required'];
        $validator = Validator::make(request()->all(),['firstname'=>'required|string','password'=>'required|string'],$message);

            $request = request()->except('_token');

            if($validator->passes())
                {
                    if(auth()->attempt($request))
                        {
                            $login_id = Auth::user()->login_id;

                            if($login_id)
                                {
                                    session(['loginid'=>$login_id]);

                                    return redirect(route('user.dashboard'));
                                }
                            else
                                {
                                    return back()->with('error', "Invalid login credentials!");
                                }

                        }
                    else
                        {
                            return back()->with('error', "Invalid username or password!");
                        }
                }
            else
                {
                    
                    return back()->withInput()->withErrors($validator);
                }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
