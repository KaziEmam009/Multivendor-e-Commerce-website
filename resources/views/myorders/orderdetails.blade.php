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
                        My Order Details
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered table-inverse">
                                <tbody>
                                    <tr>
                                        <td>Coupon Name</td>
                                        <td>{{ ($Order_summery->coupon_name)? $Order_summery->coupon_name:'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Card Total</td>
                                        <td>{{ $Order_summery->card_total }}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount Amount</td>
                                        <td>{{ $Order_summery->discount_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>{{ $Order_summery->sub_total }}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td>{{ $Order_summery->shipping }}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Option</td>
                                        <td>
                                            @if ($Order_summery->payment_option == 1)
                                                Cash On Delivery
                                            @else
                                                Online Payment
                                            @endif

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Payment Status</td>
                                        <td>
                                            @if ($Order_summery->payment_status == 0)
                                                <span class="badge badge-danger">Not Paid Yet</span>
                                            @else
                                                <span class="badge badge-success">Paid</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>User Name</td>
                                        <td>{{ $Order_summery->relationwithuser->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Created At</td>
                                        <td>{{ $Order_summery->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <td>Delivery Status</td>
                                        <td>
                                        @if ($Order_summery->delivery_status == 0)
                                            <span class="badge badge-warning">Panding</span>
                                        @else
                                            <span class="badge badge-success">Delivered</span>
                                        @endif
                                        </td>
                                    </tr>

                                </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        @foreach ($Order_details as $Order_detail)
                           <div class="card mb-2">
                          <div class="card-body">
                              <table class="table table-bordered table-inverse">
                                <tbody>
                                        <tr>
                                            <td>Vandor Name</td>
                                            <td>
                                                {{ $Order_detail->relationwithuser->name }}
                                                <br>
                                                <a href="callto:{{ $Order_detail->relationwithuser->phone_number }}">Call This Vendor ☏</a>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Product Name</td>
                                            <td>{{ $Order_detail->relationwithproduct->product_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Product Photo</td>
                                            <td>
                                                <img class="w-25" src="{{ asset('uploads/product_photo') }}/{{ $Order_detail->relationwithproduct->product_photo }}" alt="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Amount</td>
                                            <td>{{ $Order_detail->amount }}</td>
                                        </tr>
                                </tbody>
                              </table>
                              <hr>
                              <div class="row">
                                <div class="col-12">
                                     @if ($Order_summery->delivery_status == 1)
                                        <form action="{{ route('rating', $Order_detail->id) }}" method="POST">
                                            @csrf
                                             <div class="form-group">
                                                 <label for="">Your Review</label>
                                                <textarea name="review" class="form-control" rows="5"></textarea>
                                            </div>
                                             {{-- <div class="form-group">
                                                 <label for="">Your Rating</label>
                                                 <input class="form-control" type="range" min="1" max="5">
                                            </div> --}}
                                            <style>
                                                .rate {
                                                    float: left;
                                                    height: 46px;
                                                    padding: 0 10px;
                                                }
                                                .rate:not(:checked) > input {
                                                    position:absolute;
                                                    top:-0;
                                                    opacity: 0;
                                                }
                                                .rate:not(:checked) > label {
                                                    float:right;
                                                    width:1em;
                                                    overflow:hidden;
                                                    white-space:nowrap;
                                                    cursor:pointer;
                                                    font-size:30px;
                                                    color:#ccc;
                                                }
                                                .rate:not(:checked) > label:before {
                                                    content: '★ ';
                                                }
                                                .rate > input:checked ~ label {
                                                    color: #ffc700;
                                                }
                                                .rate:not(:checked) > label:hover,
                                                .rate:not(:checked) > label:hover ~ label {
                                                    color: #deb217;
                                                }
                                                .rate > input:checked + label:hover,
                                                .rate > input:checked + label:hover ~ label,
                                                .rate > input:checked ~ label:hover,
                                                .rate > input:checked ~ label:hover ~ label,
                                                .rate > label:hover ~ input:checked ~ label {
                                                    color: #c59b08;
                                                }
                                            </style>
                                            <div class="form-group">
                                                <div class="rate">
                                                    <input type="radio" id="star5_{{ $Order_detail->id }}" name="rate" value="5" />
                                                    <label for="star5_{{ $Order_detail->id }}" title="text">5 stars</label>
                                                    <input type="radio" id="star4_{{ $Order_detail->id }}" name="rate" value="4" />
                                                    <label for="star4_{{ $Order_detail->id }}" title="text">4 stars</label>
                                                    <input type="radio" id="star3_{{ $Order_detail->id }}" name="rate" value="3" />
                                                    <label for="star3_{{ $Order_detail->id }}" title="text">3 stars</label>
                                                    <input type="radio" id="star2_{{ $Order_detail->id }}" name="rate" value="2" />
                                                    <label for="star2_{{ $Order_detail->id }}" title="text">2 stars</label>
                                                    <input type="radio" id="star1_{{ $Order_detail->id }}" name="rate" value="1" />
                                                    <label for="star1_{{ $Order_detail->id }}" title="text">1 star</label>
                                                </div>
                                            </div>
                                            <div class="form-control">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </form>
                                     @else

                                    @endif
                                </div>
                              </div>


                          </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')

@endsection


