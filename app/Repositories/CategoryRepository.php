<?php

namespace App\Repositories;

use App\Models\Category;
//use App\Models\Task;

class CategoryRepository
{
//Znak
    public function mainCategory(Category $category)
    {
        return Category::whereNull($category->parent_id)->get();
    }
    
    
}





 