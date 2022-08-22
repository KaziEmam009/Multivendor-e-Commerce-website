<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\VendorNotification;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Vendor;
use Illuminate\Support\Facades\Mail;
use Str;

class VendorController extends Controller
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
        return view('vendor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.create');
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
    'vendor_name'=>'required',
    'vendor_email'=>'required|email|unique:users,email',
]);

$random_password = Str::random(9);

$user = new User;
$user->email  = $request->vendor_email;
$user->password = bcrypt($random_password);
$user->phone_number = $request->vendor_phone_number;
$user->name = $request->vendor_name;
$user->role = 3;
$user->save();

$vendor = new Vendor;
$vendor->user_id = $user->id;
$vendor->address = $request->vendor_address;
$vendor->save();
//now sent email to the Vendor
Mail::to($request->vendor_email)->send(new VendorNotification($random_password));

return back()->with('success','Vendor Added Sucessfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
