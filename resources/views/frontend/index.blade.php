@extends('layouts.app_frontend')



@section('content')
    <!-- Hero/Intro Slider Start -->
<div class="section ">
    <div class="hero-slider swiper-container slider-nav-style-1 slider-dot-style-1">
        <!-- Hero slider Active -->
        <div class="swiper-wrapper">
            <!-- Single slider item -->
            <div class="hero-slide-item-2 slider-height swiper-slide d-flex bg-color1">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5 align-self-center sm-center-view">
                            <div class="hero-slide-content hero-slide-content-2 slider-animated-1">
                                <span class="category">Sale 45% Off</span>
                                <h2 class="title-1">Exclusive New<br> Offer 2022</h2>
                                <a href="{{ route('shop') }}" class="btn btn-lg btn-primary btn-hover-dark"> Shop
                                    Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div
                            class="col-xl-6 col-lg-7 col-md-7 col-sm-7 d-flex justify-content-center position-relative">
                            <div class="show-case">
                                <div class="hero-slide-image">
                                    <img src="{{ asset('frontend') }}/assets/images/slider-image/slider-2-1.png" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single slider item -->
            <div class="hero-slide-item-2 slider-height swiper-slide d-flex bg-color2">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5 align-self-center sm-center-view">
                            <div class="hero-slide-content hero-slide-content-2 slider-animated-1">
                                <span class="category">Sale 45% Off</span>
                                <h2 class="title-1">Exclusive New<br> Offer 2022</h2>
                                <a href="shop-left-sidebar.html" class="btn btn-lg btn-primary btn-hover-dark"> Shop
                                    Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div
                            class="col-xl-6 col-lg-7 col-md-7 col-sm-7 d-flex justify-content-center position-relative">
                            <div class="show-case">
                                <div class="hero-slide-image">
                                    <img src="{{ asset('frontend') }}/assets/images/slider-image/slider-2-2.png" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-white"></div>
        <!-- Add Arrows -->
        <div class="swiper-buttons">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>

<!-- Hero/Intro Slider End -->

<!-- Feature Area Srart -->
<div class="feature-area  mt-n-65px">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <!-- single item -->
                <div class="single-feature">
                    <div class="feature-icon">
                        <img src="{{ asset('frontend') }}/assets/images/icons/1.png" alt="">
                    </div>
                    <div class="feature-content">
                        <h4 class="title">Free Shipping</h4>
                        <span class="sub-title">Capped at $39 per order</span>
                    </div>
                </div>
            </div>
            <!-- single item -->
            <div class="col-lg-4 col-md-6 mb-md-30px mb-lm-30px mt-lm-30px">
                <div class="single-feature">
                    <div class="feature-icon">
                        <img src="{{ asset('frontend') }}/assets/images/icons/2.png" alt="">
                    </div>
                    <div class="feature-content">
                        <h4 class="title">Card Payments</h4>
                        <span class="sub-title">12 Months Installments</span>
                    </div>
                </div>
            </div>
            <!-- single item -->
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <div class="feature-icon">
                        <img src="{{ asset('frontend') }}/assets/images/icons/3.png" alt="">
                    </div>
                    <div class="feature-content">
                        <h4 class="title">Easy Returns</h4>
                        <span class="sub-title">Shop With Confidence</span>
                    </div>
                </div>
                <!-- single item -->
            </div>
        </div>
    </div>
</div>
<!-- Feature Area End -->

<!-- Product Area Start -->
<div class="product-area pt-100px pb-100px">
    <div class="container">
        <!-- Section Title & Tab Start -->
        <div class="row">
            <!-- Section Title Start -->
            <div class="col-12">
                <div class="section-title text-center mb-0">
                    <h2 class="title">#Products</h2>
                    <!-- Tab Start... -->
                    <div class="nav-center">
                        <ul class="product-tab-nav nav align-items-center justify-content-center">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                            href="#tab-product--all">All</a></li>
                            @foreach ($categories as $category )
                            <li class="nav-item m-1"><a class="nav-link" data-bs-toggle="tab"
                            href="#tab-product-{{ $category->category_name }}">{{ $category->category_name }}</a></li>
                            @endforeach


                        </ul>
                    </div>
                    <!-- Tab End-->

                </div>
            </div>
            <!-- Section Title End -->
        </div>
        <!-- Section Title & Tab End -->

        <div class="row">
            <div class="col">
                <div class="tab-content mb-30px0px">
                    <!-- 1st tab start -->
                    <div class="tab-pane fade show active" id="tab-product--all">
                        <div class="row">
                            @foreach ($allproducts as $allproduct)
                            @include('parts.product_thumb')
                            @endforeach

                        </div>
                    </div>
                    <!-- 1stt tab END -->

                    @foreach ( $categories as $category )
                      <div class="tab-pane fade" id="tab-product-{{ $category->category_name }}">
                        <div class="row">
                            @forelse ( App\Models\Product::where('category_id', $category->id)->get() as $allproduct)
                            @include('parts.product_thumb')

                            @empty
                                <div class="alert alert-danger text-center">
                                    <h1>Nothing To Show</h1>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    @endforeach

                </div>
                <a href="shop-left-sidebar.html" class="btn btn-lg btn-primary btn-hover-dark m-auto"> Load More <i
                        class="fa fa-arrow-right ml-15px" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Product Area End -->

<!-- Banner Area Start -->
<div class="banner-area pt-100px pb-100px plr-15px">
    <div class="row m-0">
        @foreach ($categories as $category)
            <div class="col-12 col-lg-4 mb-3">
            <div class="single-banner-2">
                <img src="{{ asset('uploads/category_photos') }}/{{ $category->category_photo }}" alt="">
                <div class="item-disc">
                    <h4 class="title">{{ $category->category_tagline}} <br>
                        {{ $category->category_name}}</h4>
                    <a href="{{ route('categorywiseproducts', $category->id) }}" class="shop-link btn btn-primary">Shop Now <i
                            class="fa fa-shopping-basket ml-5px" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
<!-- Banner Area End -->

<!-- Product Area Start -->
<div class="product-area pt-100px pb-100px">
    <div class="container">
        <!-- Section Title & Tab Start -->
        <div class="row">
            <!-- Section Title Start -->
            <div class="col-lg col-md col-12">
                <div class="section-title mb-0">
                    <h2 class="title">#newarrivals</h2>
                </div>
            </div>
            <!-- Section Title End -->

            <!-- Tab Start -->
            <div class="col-lg-auto col-md-auto col-12">
                <ul class="product-tab-nav nav">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                            href="#tab-product-all">All</a></li>
                            @foreach ($categories as $category )
                            <li class="nav-item m-1"><a class="nav-link" data-bs-toggle="tab"
                            href="#tab-product-{{ $category->category_name }}">{{ $category->category_name }}</a></li>
                            @endforeach
                </ul>
            </div>
            <!-- Tab End -->
        </div>
        <!-- Section Title & Tab End -->

        <div class="row">
            @foreach ($allproducts as $allproduct)
                @include('parts.product_thumb')
            @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Product Area End -->
<!--  Blog area Start -->
<div class="main-blog-area pb-100px pt-100px">
    <div class="container">
        <!-- section title start -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center mb-30px0px">
                    <h2 class="title">#blog</h2>
                    <p class="sub-title">Lorem ipsum dolor sit amet consectetur adipisicing eiusmod.
                    </p>
                </div>
            </div>
        </div>
        <!-- section title start -->

        <div class="row">
            <div class="col-lg-4 mb-md-30px mb-lm-30px">
                <div class="single-blog">
                    <div class="blog-image">
                        <a href="blog-single-left-sidebar.html"><img src="{{ asset('frontend') }}/assets/images/blog-image/1.jpg"
                                class="img-responsive w-100" alt=""></a>
                    </div>
                    <div class="blog-text">
                        <div class="blog-athor-date">
                            <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                    aria-hidden="true"></i> 24 Aug, 2021</a>
                            <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 1.5
                                K</a>
                        </div>
                        <h5 class="blog-heading"><a class="blog-heading-link"
                                href="blog-single-left-sidebar.html">There are many variations of
                                passages of Lorem</a></h5>

                        <a href="blog-single-left-sidebar.html" class="btn btn-primary blog-btn"> Read More<i
                                class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <!-- End single blog -->
            <div class="col-lg-4 mb-md-30px mb-lm-30px">
                <div class="single-blog ">
                    <div class="blog-image">
                        <a href="blog-single-left-sidebar.html"><img src="{{ asset('frontend') }}/assets/images/blog-image/2.jpg"
                                class="img-responsive w-100" alt=""></a>
                    </div>
                    <div class="blog-text">
                        <div class="blog-athor-date">
                            <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                    aria-hidden="true"></i> 24 Aug, 2021</a>
                            <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 1.5
                                K</a>
                        </div>
                        <h5 class="blog-heading"><a class="blog-heading-link"
                                href="blog-single-left-sidebar.html">It is a long established factoi
                                ader will be distracted</a></h5>

                        <a href="blog-single-left-sidebar.html" class="btn btn-primary blog-btn"> Read More<i
                                class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <!-- End single blog -->
            <div class="col-lg-4">
                <div class="single-blog">
                    <div class="blog-image">
                        <a href="blog-single-left-sidebar.html"><img src="{{ asset('frontend') }}/assets/images/blog-image/3.jpg"
                                class="img-responsive w-100" alt=""></a>
                    </div>
                    <div class="blog-text">
                        <div class="blog-athor-date">
                            <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                    aria-hidden="true"></i> 24 Aug, 2021</a>
                            <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 1.5
                                K</a>
                        </div>
                        <h5 class="blog-heading"><a class="blog-heading-link"
                                href="blog-single-left-sidebar.html">Contrary to popular belieflo
                                lorem Ipsum is not</a></h5>


                        <a href="blog-single-left-sidebar.html" class="btn btn-primary blog-btn"> Read More<i
                                class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <!-- End single blog -->
        </div>
    </div>
</div>
<!--  Blog area End -->

@endsection
