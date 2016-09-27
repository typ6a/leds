<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{
    
    protected $table = 'product_property';
    public $timestamps = false;
        
    protected $fillable = array(
        'name',
    );
    
}
