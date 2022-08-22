<?php

namespace App\Http\Controllers;


// use App\Models\Auth;
use App\Models\Product;
use App\Models\Product_thumbnail;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\support\Str;
use Image;
use Auth;


class ProductController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index', [
            'products' => Product::where('user_id', auth()->id())->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         return view('product.create', [
             'active_categoris' => Category::where('status', 'show')->get()
         ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

             $request->validate([
              'category_id'=>'required',
             ]);
                //photo upload Start
                $new_product_photo_name = Auth::id().'-'.time().'-'.Str::random(5).'.'.$request->file('product_photo')->getClientOriginalextension();
                Image::make($request->file('product_photo'))->resize(270,310)->save(base_path('public/uploads/product_photo/'.$new_product_photo_name));
                //photo upload END
                $product_id = Product::insertGetId([
                    'user_id' =>auth()->id(),
                    'category_id' => $request->category_id,
                    'product_name' => $request-> product_name,
                    'product_price' => $request-> product_price,
                    'product_short_description' => $request-> product_short_description,
                    'product_long_description' => $request-> product_long_description,
                    'product_code' => $request-> product_code,
                    'product_photo' => $new_product_photo_name,
                    'product_slug' => Str::slug($request->product_name)."-".Str::random(5).auth()->id(),
                    'product_quantity' => $request-> product_quantity,
                    'created_at' => Carbon::now(),
                ]);

                      foreach($request->file('product_thumbnails') as $product_thumbnails){
                            $new_product_photo_name = $product_id.'-'.time().'-'.Str::random(5).'.'.$product_thumbnails->getClientOriginalextension();
                            Image::make($product_thumbnails)->resize(800,800)->save(base_path('public/uploads/product_thumbnails/'.$new_product_photo_name));

                            Product_thumbnail::insert([
                                'product_id' => $product_id,
                                'product_thumbnail_name' => $new_product_photo_name,

                            ]);
                    };
                return back();









            // $product = new Product;

            // $product->user_id = $request->auth()->id();
            // $product->category_id = $request->category_id;
            // $product->product_name = $request->product_name;
            // $product->product_price = $request->product_price;
            // $product->product_short_description = $request->product_short_description;
            // $product->product_long_description = $request->product_long_description;
            // $product->product_code = $request->product_code;
            // $product->product_photo = $request->product_photo;
            // $product->save();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
