<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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

    public function categories()
    {
        return $this->belongsToMany(Category::class , 'product_categories', 'product_id' ,'category_id');
    }
        
    
}
