<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Role extends SpatieRole
{
    use HasFactory, Notifiable, HasPermissions, HasRoles;

    protected $guarded = ['id'];

    //return who created this user
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    //return who updated this user
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    


}
