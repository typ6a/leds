<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Category;///
use App\Repositories\CatalogRepository;

class CatalogController extends Controller
{
    protected $categories;

    /**
     * Create a new controller instance.
     *
     * @param  CatalogRepository  $categories
     * @return void
     */
    public function __construct(CatalogRepository $categories)
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
        return view('catalog.index', [
            'categories' => $categories,
            //'products' => $products
        ]);
    }
    
   public function category($category_id = null) {
        $category = \App\Models\ProductCategory::find($category_id);
        $categories = \App\Models\ProductCategory::where('parent_id', $category_id)->get();
        $products = \App\Models\Product::where('category_id', $category_id)->get();
        return view('catalog.category', [
            'category' => $category,
            'categories' => $categories,
            'products' => $products
        ]);
    }
     // http://products.localhost/leds/product/1123
    public function product($product_id) {
        $product = \App\Models\Product::find($product_id);
        //$category = \App\Models\Product\ProductCategory::find($category_id);
        //$properties = $product->properties;//->groupBy('product_property_id');
        //$images = $product->images;
        return view('catalog.product', [
            'product' => $product,
            //'category' => $category,
            //'properties' => $properties,
            //'images' => $images
        ]);
    }
    
    public function addProduct() {
        $product = \App\Models\Product::whereNull('parent_id')->get();
        return view('catalog.addProduct', [
            'categories' => $categories,
            //'products' => $products
        ]);
    }
}