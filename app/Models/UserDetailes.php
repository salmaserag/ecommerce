<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class UserDetailes extends Model
{

    use HasFactory, Notifiable , HasPermissions , HasRoles;


    protected $guarded = ['id'];
    protected $table = 'user_detailes';

    //return user has these detailes
    public function user()  {
        return $this->belongsTo(User::class,'user_id');
    }


}
