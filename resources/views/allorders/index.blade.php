@extends('layouts.app')
@section('breadcrumb')
    <div class="page-title-box">
        <h4 class="page-title">Home </h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Location</a></li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        ALL Orders
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-inverse table-bordered">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Coupon Name</th>
                                    <th>Card Total</th>
                                    <th>Shipping</th>
                                    <th>Discount Amount</th>
                                    <th>Grand Total</th>
                                    <th>Payment Option</th>
                                    <th>Payment Status</th>
                                    <th>Reciving Status</th>
                                    <th>Barcode</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_summeries as $Order_summery )
                                    <tr>
                                        <td>{{ $Order_summery->id }}</td>
                                        <td>{{ $Order_summery->coupon_name }}</td>
                                        <td>{{ $Order_summery->card_total }} $</td>
                                        <td>{{ $Order_summery->shipping }} $</td>
                                        <td>{{ $Order_summery->discount_amount }} $</td>
                                        <td>{{ $Order_summery->grand_total }} $</td>
                                        <td>
                                            @if ( $Order_summery->payment_option  == 1)
                                                <p class="text-primary text-center">Cash On Delivery</p>
                                            @else
                                                <p class="text-danger text-center">Online Payment</p>
                                            @endif
                                        </td>

                                        <td>
                                            @if ( $Order_summery->payment_status  == 0)
                                                <span class="badge badge-danger">Not Paid Yet</span>
                                            @else
                                                <span class="badge badge-success">Paid</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($Order_summery->delivery_status == 0)
                                                <span class="badge badge-warning">Panding</span>
                                            @else
                                                <span class="badge badge-success">Delivered</span>
                                            @endif
                                        </td>

                                            <td>
                                                {!! DNS2D::getBarcodeHTML('emamVai', 'QRCODE', 3,3) !!}
                                            </td>
                                        <td>
                                            <a class="btn btn-dark btn-sm mt-1" href="{{ route('order.details', Crypt::encryptString($Order_summery->id)) }}">Details</a>
                                            @if ($Order_summery->payment_status  == 1 && $Order_summery->delivery_status == 0)
                                                <a class="btn btn-info btn-sm mt-1"  href="{{ route('mark.as.received', $Order_summery->id) }}">Mark as Received</a>
                                            @endif

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')

@endsection


