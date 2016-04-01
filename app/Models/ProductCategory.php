<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    
    public $timestamps = false;
    
    protected $table = 'product_category';
    
    protected $fillable = array(
        'parent_id', 
        'title', 
        'url',
        'processed'
    );
    
    public function products(){
        return $this->hasMany('App\Models\Product', 'category_id', 'id');
    }
}
