@extends('layouts.app_frontend')


@section('content')

<!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Cart</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->


     <!-- Cart Area Start -->
    <div class="cart-main-area pt-100px pb-100px">
        <div class="container">
            <h3 class="cart-page-title">Your cart items</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Unit Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="{{ route('cardupdate') }}" method="POST">
                                    @csrf


                                    @php
                                        $card_total = 0;
                                        $flag = false;
                                    @endphp
                                    @forelse (allcards() as $card )
                                      <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img class="img-responsive ml-15px"
                                                    src="{{ asset('uploads/product_photo') }}/{{ $card->relationtoproduct->product_photo }}" alt="" /></a>
                                        </td>
                                        <td class="product-name"><a href="#">{{ $card->relationtoproduct->product_name }}<br>
                                        Vendor Name:{{ getvendorname($card->product_id) }}<br>
                                        Status:
                                        @if ( $card->amount  >  available_quantity($card->product_id) )
                                          <span class="text-danger">Stock Out</span>
                                          @php
                                              $flag = true;
                                          @endphp
                                        @else
                                            Available
                                        @endif
                                        </a></td>
                                        <td class="product-price-cart"><span class="amount">${{ $card->relationtoproduct->product_price }}</span></td>
                                        <td class="product-quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" type="text" name="qtybutton[{{ $card->id }}]"
                                                    value="{{ $card->amount }}" />
                                            </div>
                                        </td>
                                        <td class="product-subtotal">$
                                            {{ $card->amount*$card->relationtoproduct->product_price }}
                                            @php
                                                $card_total += ($card->amount*$card->relationtoproduct->product_price);
                                            @endphp
                                        </td>
                                        <td class="product-remove">
                                            <a href="{{ route('cardremove', $card->id) }}"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                   <li class="alert alert-danger">Your Cart Is Now EMPTY</li>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update">
                                        <a href="{{ route('frontend') }}">Continue Shopping</a>
                                    </div>
                                    <div class="cart-clear">
                                        <button type="submit">Update Shopping Cart</button>
                                        </form>
                                        @auth()
                                           <a href="{{ route('clearshoppingcard', auth()->id()) }}">Clear Shopping Cart</a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-lm-30px">
                            <div class="discount-code-wrapper">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                                </div>
                                <div class="discount-code">
                                    <p>Enter your coupon code if you have one.</p>
                                    <form>
                                        <input type="text" name="coupon_name" value="{{ ($coupon_name)?$coupon_name: '' }}" />
                                        @if (session('coupon_err'))
                                          <div class="alert alert-danger">
                                            {{ session('coupon_err') }}
                                        </div>
                                        @endif

                                        <button class="cart-btn-2" type="submit">Apply Coupon</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 mt-md-30px">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                </div>
                                @php
                                        if ($coupon_name){
                                        Session::put('s_coupon_name', $coupon_name);
                                        }
                                        else {
                                        Session::put('s_coupon_name', '');
                                        }
                                    Session::put('s_card_total', $card_total);
                                    Session::put('s_discount_amount', $discount_amount);
                                @endphp
                                <h5>Card Total <span>${{ $card_total }}</span></h5>
                                <h5>Discount Amount (
                                    @if ($coupon_name)
                                    {{ $coupon_name }}
                                    @else
                                    N/A
                                    @endif
                                    )<span>${{ $discount_amount }}</span></h5>
                                <h5>Sub total [Approx.]<span id="sub_total">{{ round($card_total-$discount_amount) }}</span><span>$</span></h5>
                                <div class="total-shipping">
                                    <h5>Total shipping</h5>
                                    <ul>
                                        <li><input id="shipping_btn-1" type="radio" name="shipping" /> Standard <span>$20.00</span></li>
                                        <li><input id="shipping_btn-2" type="radio" name="shipping" /> Express <span>$30.00</span></li>
                                        <li><input id="shipping_btn-3" type="radio" name="shipping" /> Free shipping <span>$00.00</span></li>
                                    </ul>
                                </div>
                                <h4 class="grand-totall-title">Grand Total <span id="grand_total">{{ round($card_total-$discount_amount) }}</span><span>$</span></h4>
                                @if ( $flag )
                                   <div class="alert alert-danger">
                                    <h5>
                                        Please remove Stock out Product first
                                    </h5>
                                </div>
                                @else
                                  <a id="checkout_btn" class="d-none" href="{{ route('checkout') }}">Proceed to Checkout</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Area End -->


@endsection
@section('footer_scripts')
    <script>
    $('#shipping_btn-1').click(function(){
     $('#grand_total').html(parseInt($('#sub_total').html())+20)
     $('#checkout_btn').removeClass('d-none');
     @php
         session(['s_shipping' => 20]);
     @endphp
    });

    $('#shipping_btn-2').click(function(){
     $('#grand_total').html(parseInt($('#sub_total').html())+30)
     $('#checkout_btn').removeClass('d-none');
     @php
         session(['s_shipping' => 30]);
     @endphp
    });


    $('#shipping_btn-3').click(function(){
     $('#grand_total').html(parseInt($('#sub_total').html())+0)
     $('#checkout_btn').removeClass('d-none');
     @php
         session(['s_shipping' => 0]);
     @endphp
    });
 </script>
@endsection

