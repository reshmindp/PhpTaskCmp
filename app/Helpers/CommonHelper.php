<?php 
namespace App\Helpers;
use App\Models\Login;
use App\Models\Status;
use Illuminate\Support\Facades\Session;


class CommonHelper
{
    public function sidebar_user()
    {
        $login_id = Session::get('loginid');
        $userData = Login::join('status_histories','status_histories.login_id','=','logins.login_id')->where('logins.login_id', '=' , $login_id)->orderBy('status_histories.updated_at','DESC')->first();
        
        return $userData;
    }

    public static function instance()
    {
        return new CommonHelper();
    }

}