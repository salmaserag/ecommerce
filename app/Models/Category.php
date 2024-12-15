<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Notifiable, HasPermissions, HasRoles;

    protected $guarded = ['id'];

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

    public function products()
    {
        return $this->belongsToMany(Product::class , 'product_categories' ,'category_id', 'product_id');
    }
}
