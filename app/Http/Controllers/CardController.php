<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Wishlist;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Auth;

class CardController extends Controller
{
    public function addtocardfromwishlist($wishlist_id){

        $vendor_id = Product::find(Wishlist::find($wishlist_id)->product_id)->user_id;
        if( Card::where('user_id', auth()->id())->where( 'product_id', Wishlist::find($wishlist_id)->product_id)->exists()){
            Card::where('user_id', auth()->id())->where( 'product_id', Wishlist::find($wishlist_id)->product_id)->increment('amount', 1);
        }
        else{
            Card::insert([
           'user_id' => auth()->id(),
           'vendor_id' => $vendor_id,
           'product_id' => Wishlist::find($wishlist_id)->product_id,
           'created_at' => carbon::now(),
           ]);
        }

       Wishlist::find($wishlist_id)->delete();
       return back();
    }
    public function addtocard(Request $request, $product_id){
        if(Product::find($product_id)->product_quantity < $request->qtybutton){
            return back()->with('stockout', 'Stock Is Not Available');
        }
        else{
             if( Card::where('user_id', auth()->id())->where( 'product_id', $product_id)->exists()){
                 if(Product::find($product_id)->product_quantity < (Card::where('user_id', auth()->id())->where( 'product_id', $product_id)->first()->amount + $request->qtybutton)){
                     return back()->with('stockout', 'Already in The Card');
                 }
                 else{
                    Card::where('user_id', auth()->id())->where( 'product_id', $product_id)->increment('amount', $request->qtybutton);
                 }

        }
        else{
            Card::insert([
             'user_id' => auth()->id(),
             'vendor_id' => Product::find($product_id)->user_id,
             'product_id' => $product_id,
             'amount' => $request->qtybutton,
             'created_at' => carbon::now(),
         ]);
        }
        }

        return back();


    }
    public function card(){
        if(isset($_GET['coupon_name'])){
            if($_GET['coupon_name']){
            $coupon_name = $_GET['coupon_name'];
            if(Coupon::where('coupon_name', $coupon_name)->exists()){
                $coupon_info = Coupon::where('coupon_name', $coupon_name)->first();
                if($coupon_info->limit != 0){
                    if($coupon_info->validity < Carbon::today()->format('Y-m-d')){
                        echo "sesh";
                        $discount_amount = 0;
                        return redirect('card')->with('coupon_err',$coupon_name.' '. 'Coupon validity is OVER');
                    }
                    else{
                        // $coupon_info->discount_percentage;
                        $discount_amount = (session('s_card_total')* $coupon_info->discount_percentage)/100;
                    }


                }
                else{
                   $discount_amount = 0;
                   return redirect('card')->with('coupon_err',$coupon_name.' '. 'Coupon Limit is OVER');

                }



            }
            else{
                $discount_amount = 0;
                return redirect('card')->with('coupon_err',$coupon_name.' '. 'Coupon Is NOT Available');
            }
            }
            else{
            $coupon_name = "";
            $discount_amount = 0;
            }

        }
        else{
            $coupon_name = "";
            $discount_amount = 0;
        }
       return view('frontend.card', compact('discount_amount', 'coupon_name'));
    }

    public function clearshoppingcard($user_id){
        Card::where('user_id', $user_id)->delete();
        return back();
    }
    public function cardremove ($card_id){
        Card::find($card_id)->delete();
        return back();
    }
    public function cardupdate(Request $request){
        foreach($request->qtybutton as $card_id=>$updated_amount){
            Card::find($card_id)->update([
                'amount' => $updated_amount,
            ]);
        };
         return back();
    }


}
