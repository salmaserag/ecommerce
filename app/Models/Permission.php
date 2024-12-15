<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermissions;

class Permission extends SpatiePermissions
{
    protected $guarded = ['id'];


   
}
