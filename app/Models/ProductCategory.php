<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $guarded = ['id'];

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
