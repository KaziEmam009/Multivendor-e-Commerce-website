<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



     public function contact(Request $request)
     {
        return view('contact.index');
     }
     public function contact_post(Request $request)
     {
         Contact::insert([
         'name' => $request->name,
         'email' =>$request->email,
         'message' =>$request->message,
         'created_at' =>Carbon::now()
         ]);
         return back();
     }


}
