<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Cities;
use App\Models\Order_summery;
use App\Models\Billing_detail;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Card;
use App\Models\City;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class CheckoutController extends Controller
{
public function checkout ()
{
    if(strpos(url()->previous(), 'card') || strpos(url()->previous(), 'checkout') ){
      return view('frontend.checkout',[
          'countries' =>  Country::where('status', 'active')->get(['id', 'name']),

      ]);
    }
    else{
        abort(404);
    }
}
public function checkout_post (Request $request)
{
    $request->validate([
        '*' => 'required',
        'order_notes' => 'nullable',
    ]);

    $Order_summery_id = Order_summery::insertGetId([
        'coupon_name' => session('s_coupon_name'),
        'card_total' => session('s_card_total'),
        'discount_amount' => session('s_discount_amount'),
        'sub_total' =>  round(session('s_card_total')-session('s_discount_amount')),
        'shipping' => session('s_shipping'),
        'grand_total' => round(session('s_card_total')-session('s_discount_amount'))+session('s_shipping'),
        'payment_option' => $request->payment_option,
        'user_id' =>auth()->id(),
        'created_at' => Carbon::now(),
    ]);



    Billing_detail::insert([
        'order_summery_id' =>  $Order_summery_id,
        'name' =>  $request->full_name,
        'email' =>  $request->email,
        'phone_number' => $request->phone_number,
        'country_id' => $request->country,
        'city_id' =>  $request->city,
        'address' => $request->address,
        'postcode' =>  $request->postcode,
        'notes' => $request->order_notes,
        'created_at' => Carbon::now(),
    ]);
    foreach (allcards() as $card) {
       Order_detail::insert([
           'order_summery_id' =>$Order_summery_id,
           'vendor_id' =>$card->vendor_id,
           'product_id' =>$card->product_id,
           'amount' =>$card->amount,
           'created_at' => Carbon::now(),
       ]);
       //Dedaction from Product table
       Product::find($card->product_id)->decrement('product_quantity', $card->amount);

       //delete from Card
       Card::Find($card->id)->delete();
    }
    if (session('s_coupon_name')){
        Coupon::where('coupon_name', session('s_coupon_name'))->decrement('limit', 1);
    }

     if ($request->payment_option == 1){
         return redirect('home')->with('final_success', 'Purchase Complete Successfully');
     }
     else{
         Session::put('s_order_summery_id', $Order_summery_id);
        return redirect('pay');
     }







}

public function get_city_list(Request $request)
{
    $string_to_show = "<option value=''>-Select the city</option>";
   foreach (City::where('country_id', $request->country_id)->get(['id', 'name']) as $city) {
      $string_to_show .= "<option value='$city->id'>$city->name</option>";
   }
    echo $string_to_show;
}





}
