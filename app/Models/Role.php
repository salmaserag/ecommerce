<?php

namespace App\Models;

use App\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Role extends SpatieRole
{
    use HasFactory, Notifiable, HasPermissions, HasRoles;

    protected $guarded = ['id'];

    
    //hidden in response Json -> post
    protected $hidden = [
        'created_at' , 'updated_at'
    ];

    //return who created this user
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    //return who updated this user
    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function rolePermissions()
    {
        return $this->belongsToMany(Permission::class , 'role_has_permissions' ,'role_id', 'permission_id');
    }


}
