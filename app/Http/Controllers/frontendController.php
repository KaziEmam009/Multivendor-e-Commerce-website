<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Rating;

class frontendController extends Controller
{
    public function index(){
        if(Category::where('status', 'show')->count() == 0){
            $categories = Category::latest()->limit(3)->get();
        }
        else{
           $categories = Category::where('status', 'show')->get();
        }
        $allproducts = Product::all();
        return view('frontend.index', compact('categories', 'allproducts'));

    }

    public function productdetails($slug){
        $product = Product::where('product_slug', $slug)->first();
         $wishlist_status = Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->exists();
          if($wishlist_status){
            $wishlist_id = Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->first()->id;
          }
          else{
            $wishlist_id = "";
          }
         $related_products = Product::where('product_slug', '!=', $slug)->where('category_id', Product::where('product_slug', $slug)->firstOrFail()->category_id )->get();
          return view('frontend.productdetails', [
              'single_product_info' => Product::where('product_slug', $slug)->firstOrFail(),
              'related_products' => $related_products,
              'wishlist_status' => $wishlist_status,
              'wishlist_id' => $wishlist_id,
              'reviews' => Rating::where('product_id', Product::where('product_slug', $slug)->firstOrFail()->id)->get(),
          ]);
    }

    public function categorywiseproducts ($category_id){

         return view('frontend.categorywiseproducts', [
             'all_count' => Product::count(),
             'category_name' => Category::find($category_id)->category_name,
             'products' => Product::where('category_id', $category_id)->get()
         ]);
    }
    public function shop ()
    {
        if(isset($_GET['min_value'])){
            $min = $_GET['min_value'];
            $max = $_GET['max_value'];
            $products = Product::whereBetween('product_price', [$_GET['min_value'], $_GET['max_value']])->get();
        }else{
            $max = "";
            $min = "";
            $products = Product::all();
        }
        return view('shop', compact('products', 'min', 'max'));
    }




}


