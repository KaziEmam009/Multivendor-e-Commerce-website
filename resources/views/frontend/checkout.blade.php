@extends('layouts.app_frontend')


@section('content')
 <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Shop</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->


    <!-- checkout area start -->
    <div class="checkout-area pt-100px pb-100px">
        <div class="container">
                <form action="{{ route('checkout_post') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="billing-info-wrap">
                                <h3>Billing Details</h3>
                                @if ($errors->any())
                                   <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error )
                                           <li>{{ $error }}</li>
                                        @endforeach
                                   </div>
                                @endif

                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-4">
                                            <label>Full Name</label>
                                            <input type="text" value="{{ auth()->user()->name }}" name="full_name" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-4">
                                            <label>Email</label>
                                            <input type="text" value="{{ auth()->user()->email }}" name="email" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-4">
                                            <label>Phone Number</label>
                                            <input type="text" value="{{ auth()->user()->phone_number }}" name="phone_number" />

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-select mb-4">
                                            <label>Country</label>
                                            <select name="country" id="country_dropdown">
                                                <option value="">Select a country</option>
                                                @foreach ($countries as $country )
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="billing-select mb-4">
                                            <label>City</label>
                                            <select name="city" id="city_dropdown" disabled>
                                                <option value="">Select The country First</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="billing-info mb-4">
                                            <label>Address</label>
                                            <input class="billing-address" placeholder="House number and street name"
                                                type="text" name="address" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-4">
                                            <label>Postcode / ZIP</label>
                                            <input type="text" name="postcode" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                        <div class="billing-select mb-4">
                                            <label>Payment Option</label>
                                            <select name="payment_option">
                                                <option value="1">Cash On delivary (COD)</option>
                                                <option value="2">Online Payment</option>
                                            </select>
                                        </div>
                                 </div>

                                <div class="additional-info-wrap">
                                    <h4>Additional information</h4>
                                    <div class="additional-info">
                                        <label>Order notes</label>
                                        <textarea placeholder="You can write somethins about your Order"
                                            name="order_notes"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                            <div class="your-order-area">
                                <h3>Your order</h3>
                                <div class="your-order-wrap gray-bg-4">
                                    <div class="your-order-product-info">
                                        <div class="your-order-top">
                                            <ul>
                                                <li>Product</li>
                                                <li>Total</li>
                                            </ul>
                                        </div>
                                        <div class="your-order-middle">
                                            <ul>
                                                @forelse (allcards() as $card )
                                                <li><span class="order-middle-left">{{ $card->relationtoproduct->product_name }} X {{ $card->amount }}</span> <span
                                                        class="order-price">${{ $card->amount*$card->relationtoproduct->product_price }}</span></li>
                                                @empty
                                                <li class="alert alert-danger">Your Cart Is Now EMPTY</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                        <div class="your-order-bottom">
                                            <ul>
                                                <li class="your-order-shipping">Card total</li>
                                                <li>${{ Session::get('s_card_total') }}</li>
                                            </ul>

                                            <ul>
                                                <li class="your-order-shipping">Discount Amount ({{ Session::get('s_coupon_name') }})</li>
                                                <li>${{ Session::get('s_discount_amount') }}</li>
                                            </ul>

                                            <ul>
                                                <li class="your-order-shipping">Sub total [Approx.]</li>
                                                <li>${{ round(Session::get('s_card_total')-Session::get('s_discount_amount')) }}</li>
                                            </ul>

                                            <ul>
                                                <li class="your-order-shipping">Shipping</li>
                                                <li>${{ Session::get('s_shipping') }}</li>
                                            </ul>
                                        <div class="your-order-total">
                                            <ul>
                                                <li class="order-total">Grand Total</li>
                                                <li>${{ round(Session::get('s_card_total')-Session::get('s_discount_amount'))+Session::get('s_shipping') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="payment-accordion element-mrg">
                                            <div id="faq" class="panel-group">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="Place-order mt-25">
                                    <input type="submit" class="btn btn-danger" value="Place Order">
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <!-- checkout area end -->
@endsection
@section('footer_scripts')
<script>
    $(document).ready(function() {
    $('#country_dropdown').select2();
    $('#country_dropdown').change(function(){
        var country_id = $(this).val();
        $('#city_dropdown').attr('disabled', false)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/get/city/list',
            data:{country_id:country_id},
            success: function(data){
                $('#city_dropdown').html(data);
            }
        })

    })
    $('#city_dropdown').select2();
    });
</script>
@endsection
