<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    
    public $timestamps = false;
    
    protected $fillable = array(
        'category_id', 
        'title', 
        'url',
        'price',
        'processed'
    );
    
    public function category(){
        return $this->belongsTo('App\Models\ProductCategory');
    }
    
    public function images(){
        return $this->hasMany('App\Models\ProductImage', 'product_id');
    }
    
    public function properties(){
        return $this->hasMany('App\Models\ProductToProductProperty', 'product_id');
    }



    public function file()
    {
        return $this->hasMany('App\File');
    }
}
