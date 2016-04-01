<?php

namespace App\Repositories;

use App\Models\Category;

class CatalogRepository
{

    public function mainCategory(Category $category)
    {
        return Category::whereNull($category->parent_id)->get();
    }
    
    
}





 