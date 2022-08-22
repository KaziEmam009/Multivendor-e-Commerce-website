<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use Str;
use Image;
use Carbon\Carbon;


class CategoryController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('category.index', [
           'categories' => Category::all()
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
              'category_name' => 'required',
              'category_tagline' => 'required',
              'category_photo' => 'required|image',
          ]);
          //photo upload Start
          $new_category_photo_name = Auth::id().'-'.time().'-'.Str::random(5).'.'.$request->file('category_photo')->getClientOriginalextension();
          Image::make($request->file('category_photo'))->resize(600,328)->save(base_path('public/uploads/category_photos/'.$new_category_photo_name));
         //photo upload END

         //db insert start
          Category::insert([
             'category_name' => $request->category_name,
             'category_tagline' => $request->category_tagline,
             'category_photo' => $new_category_photo_name,
             'created_at' => Carbon::now(),
         ]);
         //db insert END
         return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)

    {
            $category->category_name =  $request->category_name;
            $category->status =  $request->status;
            $category->category_tagline =  $request->category_tagline;
            $category->save();

                if( $request->hasFile('new_category_photo')){
             $new_category_photo_name = Auth::id().'-'.time().'-'.Str::random(5).'.'.$request->file('new_category_photo')->getClientOriginalextension();
            //delet Old photo
             unlink(base_path('public/uploads/category_photos/'.$category->category_photo));
             //upload New photo
              $img = Image::make($request->file('new_category_photo'))->resize(600,328)->save(base_path('public/uploads/category_photos/'.$new_category_photo_name));
              //update to DB
              $category->category_photo = $new_category_photo_name;
              $category->save();
            }
                return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        unlink(base_path('public/uploads/category_photos/'.$category->category_photo));
       $category->delete();
       return back();
    }
}
