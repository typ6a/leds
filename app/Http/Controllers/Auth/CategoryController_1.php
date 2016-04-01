<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Category;///
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    protected $categories;

    /**
     * Create a new controller instance.
     *
     * @param  CategoryRepository  $categories
     * @return void
     */
    public function __construct(CategoryRepository $categories)
    {
        //$this->middleware('auth');

        $this->categories = $categories;
    }

    /**
     * Display a list of all of the categories.
     *
     * @param  Request  $request
     * @return Response
     */
    
      public function index() {
        $categories = \App\Models\Category::whereNull('parent_id')->get();
        return view('categories.index', [
            'categories' => $categories,
            //'products' => $products
        ]);
    }
    
   public function category($category_id = null) {
        $category = \App\Models\ProductCategory::find($category_id);
        $categories = \App\Models\ProductCategory::where('parent_id', $category_id)->get();
        $products = \App\Models\Product::where('category_id', $category_id)->get();
        return view('categories.category', [
            'category' => $category,
            'categories' => $categories,
            'products' => $products
        ]);
    }
}