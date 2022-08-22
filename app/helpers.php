<?php
use App\Models\Product;
use App\Models\User;
use App\Models\Rating;
use App\Models\Contact;

function allwishlists(){
    return App\Models\wishlist::where('user_id', auth()->id())->get();
}
function wishlistcheck($product_id){
    return App\Models\wishlist::where('user_id', auth()->id())->where('product_id', $product_id)->exists();
}
function allcards(){
    return App\Models\Card::where('user_id', auth()->id())->get();
}

function totalproductatcard(){
    return App\Models\Card::where('user_id', auth()->id())->count();
}
function totalproductatwishlist(){
    return App\Models\wishlist::where('user_id', auth()->id())->count();
}
function getvendorname($product_id){
    return User::find(Product::find($product_id)->user_id)->name;
}
function available_quantity($product_id){
    return Product::find($product_id)->product_quantity;
}
function getdataorder_summeries(){
    return App\Models\Order_summery::where('user_id', auth()->id())->get();
}
function how_many_review($product_id){
    if (App\Models\Rating::where('product_id', $product_id)->count() >= 2) {
        return App\Models\Rating::where('product_id', $product_id)->count()." ". "Reviews";
    }else{
        return App\Models\Rating::where('product_id', $product_id)->count()." ". "Review";
    }
}
function rating_percentage($product_id){
    return App\Models\Rating::where('product_id', $product_id)->avg('rating') * 20;
}
function rating_amount($product_id){
    return round(App\Models\Rating::where('product_id', $product_id)->avg('rating') *1);
}


