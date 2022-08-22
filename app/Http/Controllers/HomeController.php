<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Order_summery;
use App\Models\Order_detail;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Emailoffer;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use App\Exports\Order_summeryExport;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(strpos( url()->previous(), "product/details")){
            return redirect( url()->previous());
        }

        return view('home', [
            'total_users'=> User::count(),
            'total_admin'=> User::where('role', 2)->count(),
            'total_vendor'=> User::where('role', 3)->count(),
            'total_customers'=> User::where('role', 1)->count(),
         ]);
    }

    public function emailoffer()
    {
        return view('emailoffer', [
            'customers' => User::where('role', 1)->get()
        ]);
    }

    public function singleemailoffer($id)
    {
      Mail::to(User::find($id)->email)->send(new Emailoffer());
      return back();
    }

    public function checkemailoffer(Request $request)
    {
        foreach($request->check as $id){
            Mail::to(User::find($id)->email)->send(new Emailoffer());
        }
        return back();
    }
    public function location()
    {
         return view('location.index',[
             'countries' => Country::get(['id', 'name', 'status']),
         ]);
    }
    public function location_update (Request $request)
    {
        Country::where('status' ,'active')->update([
            'status' => 'deactive'
        ]);
        foreach ($request->countries as $country_id) {
            country::find($country_id)->update([
                'status' => 'active',
            ]);
        }
        return back();
    }
    public function myorders ()
    {
        return view('myorders.index', [
            'Order_summeries' => Order_summery::where('user_id', auth()->id())->get()
        ]);
    }
    public function invoicedownload()
    {
         $pdf = PDF::loadView('pdf.invoice');
         return $pdf->download('xanaEshop.pdf');
    }
    public function invoicedownloadexcel()
     {
         return Excel::download(new Order_summeryExport, 'xanaEshop.xlsx');
     }

    public function orderdetails ($id)
     {
        $Order_summery = Order_summery::find(Crypt::decryptString($id));
        $Order_details = Order_detail::where('order_summery_id', Crypt::decryptString($id))->get();
        return view('myorders.orderdetails', compact('Order_summery', 'Order_details'));
     }
     public function allorders ()
     {
         return view('allorders.index',[
             'order_summeries' => Order_summery::all(),
         ]);
     }

     public function markasreceived($id)
     {
        Order_summery::find($id)->update([
            'delivery_status' => 1,
        ]);
        return back();
     }

     public function rating (Request $request , $id)
     {
         Rating::insert([
             'user_id' => auth()->id(),
             'product_id' => Order_detail::find($id)->product_id,
             'order_details_id' =>$id,
             'review' =>$request->review,
             'rating' =>$request->rate,
             'created_at' =>Carbon::now(),
         ]);
         return back();
     }
}
