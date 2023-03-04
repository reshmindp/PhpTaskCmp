<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusHistory extends Model
{
    public $timestamps = true;

    protected $primaryKey = 'history_id';
    protected $fillable = ['login_id', 'status', 'created_at','updated_at'];
}
