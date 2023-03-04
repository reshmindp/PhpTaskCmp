<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    protected $primaryKey = 'user_id';
    protected $fillable = ['login_id','firstname','lastname','position','created_at','updated_at'];
}
