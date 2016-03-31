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
    
   
}