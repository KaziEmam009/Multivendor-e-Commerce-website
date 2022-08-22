<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ContactController, GoogleController, GithubController, HomeController, CheckoutController, CouponController, profileController, CategoryController, frontendController, vendorController, ProductController, WishlistController, CardController};
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SslCommerzPaymentController;


Auth::routes();

Route::get('/', [frontendController::class, 'index'])->name('frontend');
Route::get('product/details/{slug}', [frontendController::class, 'productdetails'])->name('productdetails');
Route::get('category/wise/{category_id}', [frontendController::class, 'categorywiseproducts'])->name('categorywiseproducts');
Route::get('shop', [frontendController::class, 'shop'])->name('shop');


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/email/offer', [HomeController::class, 'emailoffer'])->name('emailoffer');
Route::get('/single/email/offer/{id}', [HomeController::class, 'singleemailoffer'])->name('singleemailoffer');
Route::post('/check/email/offer', [HomeController::class, 'checkemailoffer'])->name('checkemailoffer');
Route::get('/location', [HomeController::class, 'location'])->name('location');
Route::post('/location/update', [HomeController::class, 'location_update'])->name('location.update');
Route::get('/my/orders', [HomeController::class, 'myorders'])->name('my.orders');
Route::get('/invoice/download', [HomeController::class, 'invoicedownload'])->name('invoice.download');
Route::get('/invoice/download/excel', [HomeController::class, 'invoicedownloadexcel'])->name('invoice.download.excel');
Route::get('/order/details/{id}', [HomeController::class, 'orderdetails'])->name('order.details');
Route::get('/all/orders', [HomeController::class, 'allorders'])->name('all.orders');
Route::get('/mark/as/received/{id}', [HomeController::class, 'markasreceived'])->name('mark.as.received');
Route::post('/rating/{id}', [HomeController::class, 'rating'])->name('rating');


Route::get('/profile', [profileController::class, 'index'])->name('profile');
Route::post('/profile/name/change', [profileController::class, 'namechange'])->name('profile.namechange');
Route::post('/profile/password/change', [profileController::class, 'passwordchange'])->name('profile.passwordchange');
Route::post('/profile/photo/change', [profileController::class, 'photochange'])->name('profile.photochange');

Route::resource('category', CategoryController::class);
Route::resource('vendor', vendorController::class);
Route::resource('product', ProductController::class);
Route::resource('wishlist', WishlistController::class);
Route::resource('coupon', CouponController::class);
Route::get('/wishlist/insert/{product_id}', [WishlistController::class, 'insert'])->name('wishlist.insert');
Route::get('/wishlist/remove/{wishlist_id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

Route::get('/addtocardfromwishlist/{wishlist_id}', [CardController::class, 'addtocardfromwishlist'])->name('addtocardfromwishlist');
Route::post('/add/to/card/{product_id}', [CardController::class, 'addtocard'])->name('addtocard');
Route::get('/card', [CardController::class, 'card'])->name('card');
Route::get('/clear/shopping/card{user_id}', [CardController::class, 'clearshoppingcard'])->name('clearshoppingcard');
Route::get('/card/remove{card_id}', [CardController::class, 'cardremove'])->name('cardremove');
Route::post('/card/update', [CardController::class, 'cardupdate'])->name('cardupdate');

Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'checkout_post'])->name('checkout_post');
Route::post('/get/city/list', [CheckoutController::class, 'get_city_list'])->name('get_city_list');


Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact/post', [ContactController::class, 'contact_post'])->name('contact_post');


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


//Login with github start
Route::get('/github/redirect', [GithubController::class, 'githubredirect'])->name('github.redirect');
Route::get('/github/callback', [GithubController::class, 'githubcallback'])->name('github.callback');
//Login with gitgub END


//Login with google start
Route::get('/google/redirect', [GoogleController::class, 'googleredirect'])->name('google.redirect');
Route::get('/google/callback', [GoogleController::class, 'googlecallback'])->name('google.callback');
//Login with google END



