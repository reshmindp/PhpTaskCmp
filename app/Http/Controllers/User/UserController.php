<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\UserList;
use App\Models\Status;
use App\Models\StatusHistory;
// use App\Helpers\CommonHelper;

class UserController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('prevent-back-history'); 
         
    }

    public function create_user()
    {
        $messages= ['required' => '*This feild required'];
        $validator= Validator::make(request()->all(),
                        ['firstname' => 'required|string',
                        'lastname' => 'required|string',
                        'password' => 'required',
                        'position' => 'required|string'], $messages);

        $data = request()->except('_token');
         

        if($validator->passes())
        {
            $login_array = array('firstname'=>$data['firstname'], 'password'=>Hash::make($data['password']));
            $login_id    = DB::table('logins')->insertGetId($login_array);
        
            $userdata = array('login_id'=> $login_id, 'firstname'=> $data['firstname'], 'lastname'=>$data['lastname'], 
            'position'=> $data['position']);

            $status_data = array('login_id'=> $login_id);

            $history_data = array('login_id'=>$login_id);

            UserList::create($userdata);
            Status::create($status_data);
            StatusHistory::create($history_data);

            return back()->with('success', 'Signup completed!');
        }
        else
        {
            session()->flash('errorfound', 'Validation Error!');
            return back()->withInput()->withErrors($validator);
        }

    }

    public function createnewuser()
    {
        return view('create-user');

    }

    public function dashboard()
    {
        $login_id = Session::get('loginid');

        return view('dashboard');
    }


    public function userlist()
    {
        $users = UserList::join('statuses','statuses.login_id', '=', 'user_lists.login_id')->get();
         
        return view('user-list', compact('users'));
    }

    public function changeStatus($id)
    {
        $logindata = array('status'=>$id);

        DB::table('statuses')->where('login_id', Session::get('loginid'))->update($logindata);
        //Status::find(request('login_id'))->update($logindata);

        $history_data = array('login_id'=>Session::get('loginid'), 'status'=> $id);

        StatusHistory::create($history_data);
        
        return back()->with('success', 'Status Updated');

    }

}
