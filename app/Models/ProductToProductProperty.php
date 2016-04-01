<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductToProductProperty extends Model{
    protected $table = 'product_to_product_property';
    public $timestamps = false;        
    protected $fillable = array(
        'product_id', 
        'product_property_id', 
        'value'        
    );
    
    public function property(){
        return $this->belongsTo('App\Models\ProductProperty', 'product_property_id');
    }
    
}
