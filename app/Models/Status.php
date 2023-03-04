<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = true;

    protected $primaryKey = 'status_id';
    protected $fillable = ['login_id','status','created_at','updated_at'];
}
